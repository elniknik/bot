@echo off
xcopy 1.php C:\xampp\htdocs /Y /I
xcopy 2.php C:\xampp\htdocs /Y /I


start "" "http://localhost/1.php?email=alex@email.com&password=qwerty"
start "" "http://localhost/2.php"

