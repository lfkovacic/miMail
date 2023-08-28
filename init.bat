@echo off
echo test 

rem Pokreni Python skriptu za SMTP prevoditelja
python "php\mailServer\python\SMPTTranslator.py"

rem Provjeri izlaz Python skripte i pauziraj prije pokretanja servera ako je uspješno završila
if %ERRORLEVEL% == 0 (
    echo Python skripta uspješno završila.
    rem Pauziraj 5 sekundi
    timeout /t 8888 
    rem Ovdje pokrenite server, npr.:
    start "" "..\..\apache\bin\httpd.exe"
) else (
    echo Python skripta nije uspjela.
)

echo Gotovo.

timeout /t 8888 