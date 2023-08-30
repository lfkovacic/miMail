import socket
import json
import requests
import re
import threading
import sys

# SMTP server configuration
SMTP_HOST = ''  # Listen on all available interfaces
SMTP_PORT = 25
# Max request duration before interrupt
TTL = 10

# HTTP server configuration
HTTP_ENDPOINT = 'http://localhost:80/api/mail/receiveMail'

# SMTP Parsing through regex
HELO_REGEX = r"(EHLO|HELO) (\w+).(\w+)"
MAIL_FROM_REGEX = r"(MAIL FROM:) <(\w+)@(\w+\.\w+)>"
MAIL_TO_REGEX = r"(RCPT TO:) <(\w+)@(\w+\.\w+|\w+)>"
DATA_REGEX = r"(DATA)"
SUBJECT_REGEX = r"Subject: (.*)"
FROM_REGEX = r"From: (.*)"
TO_REGEX = r"To: (.*)"
QUIT_REGEX = r"QUIT"

# TCP command definitions

def get(client_socket):
    request = client_socket.recv(1024).decode().strip()
    print(request)
    return request

def send(client_socket, response):
    client_socket.sendall(response.encode())
    response = get(client_socket)
    return response

def put(client_socket, response):
    client_socket.sendall(response.encode())
server_socket = None
server_socket_lock = threading.Lock() # Locking the server thread
running = True
running_lock = threading.Lock() # Locking the running flag


# Client socket function
def handle_smtp_request():
    try:
        with server_socket_lock:
            if server_socket.fileno() != -1 and server_socket:
                print(server_socket)
                client_socket, client_address = server_socket.accept()
                print(
                    f"Incoming SMTP connection from {client_address[0]}:{client_address[1]}")
            else:
                sys.exit(0)
    except Exception:
        sys.exit(0)
    mail_from = ""
    mail_to = ""
    mail_subject = ""
    mail_content = ""

    put(client_socket, "220 Hello there...\n")
    # Receive SMTP request
    request = get(client_socket)
    match_result = re.match(HELO_REGEX, request)
    if match_result:
        host = match_result.group(2)
        domain = match_result.group(3)
        put(client_socket, f"Sup {host}.{domain}!\n")
    else:
        put(client_socket, "Go away...\n")
        client_socket.close()

    request = get(client_socket)
    match_result = re.match(MAIL_FROM_REGEX, request)

    if match_result:
        mail_from = match_result.group(2)
        host = match_result.group(3)
        put(client_socket, "250 OK\n")
    else:
        put(client_socket, "Go away...\n")
        client_socket.close()

    request = get(client_socket)
    match_result = re.match(MAIL_TO_REGEX, request)

    if match_result:
        mail_to = match_result.group(2)
        host = match_result.group(3)
        put(client_socket, "250 OK\n")
    else:
        put(client_socket, "Go away...\n")
        client_socket.close()

    request = get(client_socket)
    match_result = re.match(DATA_REGEX, request)

    if match_result:
        mail_subject = re.match(SUBJECT_REGEX, get(client_socket)).group(1)
        mail_from = re.match(FROM_REGEX, get(client_socket)).group(1)
        mail_to = re.match(TO_REGEX, get(client_socket)).group(1)
        get(client_socket)
        mail_content = get(client_socket)
        request = get(client_socket)
        while (request != '.'):
            mail_content += request
            request = get(client_socket)
        put(client_socket, '250 Yeah, sure')
    else:
        put(client_socket, "Go away...\n")
        client_socket.close()
    request = get(client_socket)
    put(client_socket, 'See ya!\n')
    client_socket.close()

    payload = {
        'sender': mail_from,
        'recipient': mail_to,
        'subject': mail_subject,
        'body': mail_content
        # todo: blob
    }
    json_payload = json.dumps(payload)

    # Call the API
    headers = {'Content-Type': 'application/json'}
    response = requests.post(HTTP_ENDPOINT, data=json_payload, headers=headers)

    if response.status_code == 200:
        print("API call successful")
        print(response.content)
    else:
        print("API call failed")
        print(response.content)

    print(json_payload)
    client_socket.close()
    return 0

# Stop function for keyboard interrupt
def stop_server():
    global running
    with running_lock:
        running = False
# Start function for the server socket
def start_server():
    global server_socket
    server_socket = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
    server_socket.bind((SMTP_HOST, SMTP_PORT))
    server_socket.listen(1)

def run_smtp_translator():
    global running, server_socket

    # Start the server thread
    server_thread = threading.Thread(target=start_server)
    server_thread.start()
    server_thread.join()

    print(f"SMTP server started: {server_socket}")

    try:

        while running:
            # Start a client thread for every request
            client_thread = threading.Thread(target=handle_smtp_request)
            client_thread.start()
            client_thread.join(timeout=TTL)

    finally:
        # If the server is still running, close it
        if server_socket:
            server_socket.close()

running_thread = threading.Thread(target=stop_server)

# Run the SMTP translator in the main thread
try:
    run_smtp_translator()
except KeyboardInterrupt:
    print("Received KeyboardInterrupt. Stopping the SMTP server...")
    running_thread.start()
    running_thread.join()
    sys.exit(0)
