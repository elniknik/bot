@echo off
rem Створюємо основний каталог проекту
mkdir chatbot
cd chatbot

rem Створюємо каталоги для контролерів, моделей і конфігурацій
mkdir app
mkdir app\controllers
mkdir app\models
mkdir app\config

rem Створюємо каталог для публічного доступу
mkdir public

rem Створюємо каталог для логів
mkdir logs

rem Створюємо файли контролерів
echo. > app\controllers\BotController.php
echo. > app\controllers\ApplicantsController.php
echo. > app\controllers\ConsultantsController.php
echo. > app\controllers\ChatsController.php
echo. > app\controllers\MessagesController.php
echo. > app\controllers\FacultiesController.php
echo. > app\controllers\ProgramsController.php
echo. > app\controllers\ApplicationsController.php
echo. > app\controllers\ExamsController.php

rem Створюємо файли моделей
echo. > app\models\Applicant.php
echo. > app\models\Consultant.php
echo. > app\models\Chat.php
echo. > app\models\Message.php
echo. > app\models\Faculty.php
echo. > app\models\Program.php
echo. > app\models\Application.php
echo. > app\models\Exam.php

rem Створюємо файли конфігурації та публічного доступу
echo. > app\config\config.php
echo. > public\index.php

rem Створюємо файл для логів
echo. > logs\loaders.log

echo Структура проекту успішно створена!
pause
