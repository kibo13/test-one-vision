## Quick Start

```bash
# Клонирование репозитория
git clone git@github.com:kibo13/test-one-vision.git

# Переходим в папку с проектом 
cd /test-one-vision

# Копирование файла .env
copy .env.example .env

# Запуск проекта через Laravel Sail
./vendor/bin/sail up

# Генерация ключа для JSON Web Token (JWT)
./vendor/bin/sail artisan jwt:secret

# Выполнение миграций для создания таблиц в базе данных
./vendor/bin/sail artisan migrate

# Опционально: заполнение таблицы фиктивными данными 
./vendor/bin/sail artisan db:seed

# Опционально: посмотреть список роутов 
./vendor/bin/sail artisan route:list
# 
```
