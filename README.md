# Установка проекта после git clone
### <p>1: composer install</p>
### <p>2: настройка env файла</p>
#### 2:1 cp .env.example .env
#### sail artisan key:generate

### <p>3: настройка env файла</p>
#### 3:1 cp .env.example .env.testing
#### 3:1 поменять DB_DATABASE с laravel на testing

# Поднятие Docker контейнера
### <p>1: sail up -d</p>
### <p>2: sail artisan migrate</p>
### <p>3: sail artisan db:seed</p>

# Тесты
### <p>3: sail artisan test</p>


