@echo off
rem Створюємо основний каталог проекту
mkdir chatbot
cd chatbot

rem Створюємо каталоги для моделей, контролерів і переглядів
mkdir app
mkdir app\controllers
mkdir app\models
mkdir app\views

rem Створюємо каталоги для конфігурацій та публічного доступу
mkdir config
mkdir public
mkdir vendor

rem Створюємо файли
echo. > app\controllers\BotController.php
echo. > app\models\Message.php
echo. > app\models\User.php
echo. > app\views\bot_view.php
echo. > config\config.php
echo. > public\index.php
echo. > composer.json

echo Структура проекту успішно створена!
pause