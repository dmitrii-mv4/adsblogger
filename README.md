# ADS Blogger Media
Сервис на framework Yii2

### Первичная настройка
1. Залить папку `vendor` с framework Yii2 отдельно

2. Залить файл `config/db.php` с framework Yii2 и подключиться к БД

3. Создать в корне папку `logs`

4. Чтобы файлы не создавали конфликты на github, в консоли нужно прописать следующие команды:

Изолировать папку `logs`

`git add -f logs`

`git commit -m "logs"`

Изолировать файл к `БД`

`git add -f config/db.php`

`git commit -m "config db.php"`
