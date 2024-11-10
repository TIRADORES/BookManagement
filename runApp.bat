@echo off

::setup laravel 
start /B "" cmd /C "cd /d %cd%\backend && php artisan migrate"

IF EXIST "./seeded.txt" (
    start /B "" cmd /C "cd /d %cd%\backend && php -S localhost:8000 -t public"
) ELSE (
    start /B "" cmd /C "cd /d %cd%\backend && php artisan db:seed"
    start /B "" cmd /C "cd /d %cd%\backend" echo seeded > seeded.txt
    start /B "" cmd /C "cd /d %cd%\backend && php -S localhost:8000 -t public"
)

::installing dependencies
start /B "" cmd /C "cd /d %cd%\frontend && npm install"

::Waiting for the server to connect to the database
timeout /t 1

:: Starting express server
start /B "" cmd /C "cd /d %cd%\frontend && npm run dev"


::Waiting for the server to connect to the database
timeout /t 1

::Launch webpage
start http://localhost:3000

