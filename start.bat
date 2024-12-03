@echo off
for /f "tokens=2 delims=:" %%a in ('ipconfig ^| findstr /c:"IPv4 Address"') do set ip=%%a
set ip=%ip:~1%
start http://%ip%:8000
php artisan serve --host=%ip% --port=8000
pause
