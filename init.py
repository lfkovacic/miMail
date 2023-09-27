import threading
import subprocess
from time import sleep

# putanje do procesa

SMTPTranslator_path = "php/mailServer/python/SMTPTranslator.py"
Apache2_path = "../../apache/bin/httpd.exe"
MySQL_path = "../../mysql/bin/mysqld.exe"
logger_path = "logger.py"

# funkcija za izvršavanje - svaka dretva izvodi proces


def run(command):
    try:
        result = subprocess.run(command, check=True)
        if result.returncode == 0:
            print(f"Process - {command} stopped succesfuly.")
        else:
            print(
                f"Process - {command} stopped unexpectedly. Error code: ${result.returncode}")
    except subprocess.CalledProcessError:
        print(f"Error: Failed to run {command}")
        exit(1)


def main():

    # TODO: provjeriti rade li već komponente prije pokretanja

    # paralelizam

    thread1 = threading.Thread(target=run, args=(
        ["python", SMTPTranslator_path],))
    thread2 = threading.Thread(target=run, args=([Apache2_path],))
    thread3 = threading.Thread(target=run, args=(
        [MySQL_path, "--defaults-file=../../mysql/bin/my.ini"],))
    #thread4 = threading.Thread(target=run, args=(["python", logger_path],))

    # asinhrono pokretanje

    thread1.start()
    thread2.start()
    thread3.start()
   # thread4.start()

    # čekanje određenog vremena (vrijednost 1 odabrana za testiranje)

    sleep(1)

    # ispis stanja dretvi

    print(thread1)
    print(thread2)
    print(thread3)
    #print(thread4)

    # nakon izvršavanja dretvi joinanje s timeout-om. dretva se i dalje izvodi, ali kod gleda koji je status serverâ

    thread1.join(timeout=1)
    thread2.join(timeout=1)
    thread3.join(timeout=1)
    #thread4.join(timeout=1)

    # ako su sve dretve pokrenute, sve komponente servera rade.

    if thread1.is_alive() and thread2.is_alive() and thread3.is_alive():
        print("Server started successfully!")

    # ako nisu, server nema sve potrebne funkcionalnosti te je potrebna provjera i ponovno pokretanje

    else:
        print("One or more threads have failed to start. Please check the output and try again.")


if __name__ == "__main__":
    main()
