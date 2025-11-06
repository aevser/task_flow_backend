# TASK FLOW

API для управления задачами с поддержкой мультиязычности (ru / en)

## Описание

Task Flow - это RESTful API для управления проектами и задачами с расширенными возможностями:
- Управление пользователями и ролями
- Создание и управление проектами
- Создание и отслеживание задач
- Работа с медиафайлами (Spatie Media Library)
- Мультиязычность (русский и английский)
- Email уведомления

## Технологический стек

- **Backend**: Laravel 11.x
- **База данных**: PostgreSQL 15
- **Контейнеризация**: Docker & Docker Compose
- **Медиафайлы**: Spatie Media Library
- **API**: RESTful API

---

## Быстрый старт

### 1. Клонирование репозитория
```bash
git clone <ссылка-на-репозиторий>
cd task_flow
```

### 2. Создание файла окружения
```bash
cp .env.example .env
```

Настройте следующие параметры в `.env`:

#### Настройки базы данных
```env
DB_CONNECTION=pgsql
DB_HOST=db
DB_PORT=5432
DB_DATABASE=task_flow_db
DB_USERNAME=task_flow_user
DB_PASSWORD=8rip88lizL
```

#### Настройки файлового хранилища
```env
FILESYSTEM_DISK=public
```

### 3. Запуск Docker-контейнеров
```bash
docker-compose up -d --build
```

Проверка запущенных контейнеров:
```bash
docker-compose ps
```

### 4. Установка зависимостей
```bash
docker exec -it task_flow_app composer install
docker exec -it task_flow_app php artisan key:generate
```

### 5. Настройка Spatie Media Library
```bash
# Публикация конфигурации и миграций
docker exec -it task_flow_app php artisan vendor:publish --provider="Spatie\MediaLibrary\MediaLibraryServiceProvider" --tag="medialibrary-migrations"

docker exec -it task_flow_app php artisan vendor:publish --provider="Spatie\MediaLibrary\MediaLibraryServiceProvider" --tag="medialibrary-config"

# Создание символической ссылки для storage
docker exec -it task_flow_app php artisan storage:link
```

### 6. Миграции и начальные данные
```bash
docker exec -it task_flow_app php artisan migrate --seed
```

### 7. Установка прав доступа
```bash
docker exec -it task_flow_app chmod -R 775 storage bootstrap/cache
docker exec -it task_flow_app chown -R www-data:www-data storage bootstrap/cache
```

---

## Основные команды

### Работа с контейнерами
```bash
# Запуск контейнеров
docker-compose up -d

# Остановка контейнеров
docker-compose down

# Просмотр логов
docker-compose logs -f app

# Перезапуск контейнеров
docker-compose restart
```

### Работа с приложением
```bash
# Вход в контейнер приложения
docker exec -it task_flow_app bash

# Запуск Artisan команд
docker exec -it task_flow_app php artisan <command>

# Очистка кэша
docker exec -it task_flow_app php artisan cache:clear
docker exec -it task_flow_app php artisan config:clear
docker exec -it task_flow_app php artisan route:clear
docker exec -it task_flow_app php artisan view:clear

# Запуск тестов
docker exec -it task_flow_app php artisan test

# Создание нового контроллера
docker exec -it task_flow_app php artisan make:controller <ControllerName>

# Создание новой миграции
docker exec -it task_flow_app php artisan make:migration <migration_name>
```

### Работа с базой данных
```bash
# Подключение к PostgreSQL
docker exec -it task_flow_db psql -U task_flow_user -d task_flow_db

# Сброс и повторный запуск миграций
docker exec -it task_flow_app php artisan migrate:fresh

# Сброс миграций с сидами
docker exec -it task_flow_app php artisan migrate:fresh --seed

# Откат последней миграции
docker exec -it task_flow_app php artisan migrate:rollback
```

---

## API Endpoints

### Аутентификация
```
POST   /api/login           # Вход
POST   /api/logout          # Выход
```

### Задачи
```
GET    /api/tasks           # Список задач
GET    /api/tasks/{id}      # Просмотр задачи
POST   /api/tasks           # Создание задачи
PUT    /api/tasks/{id}      # Обновление задачи
DELETE /api/tasks/{id}      # Удаление задачи
```

---

## Мультиязычность

Приложение поддерживает русский и английский языки.

Файлы переводов находятся в `lang/`:
```
lang/
├── en/
│   └── messages.php
└── ru/
    └── messages.php
```
