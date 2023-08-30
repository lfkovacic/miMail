import time
import os
import threading

def read_and_print_log(log_path):
    last_position = 0
    
    # Delete the old log file if it exists
    if os.path.exists(log_path):
        os.remove(log_path)
    
    while True:
        if os.path.exists(log_path):
            with open(log_path, "r") as log_file:
                log_file.seek(last_position)
                new_lines = log_file.readlines()
                if new_lines:
                    last_position = log_file.tell()
                    for line in new_lines:
                        print(line.strip())
            time.sleep(1)  # Adjust the delay as needed
        else:
            print(f"Log file '{log_path}' not found. Waiting for it to be created.")
            time.sleep(5)  # Adjust the delay as needed

if __name__ == "__main__":
    apache_error_log_path = "E:/xampp/apache/logs/error.log" 
    apache_access_log_path = "E:/xampp/apache/logs/access.log"  
    
    error_log_thread = threading.Thread(target=read_and_print_log, args=(apache_error_log_path,))
    access_log_thread = threading.Thread(target=read_and_print_log, args=(apache_access_log_path,))
    
    error_log_thread.start()
    access_log_thread.start()
    
    error_log_thread.join()
    access_log_thread.join()