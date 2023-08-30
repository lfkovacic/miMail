import time
import os

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
    apache_error_log_path = "E:/xampp/apache/logs/error.log"  # Replace with the actual path
    read_and_print_log(apache_error_log_path)