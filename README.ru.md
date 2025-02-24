# Event Manager Web Application
[English version](README.md)

[![License](https://img.shields.io/badge/License-MIT-blue.svg)](https://opensource.org/licenses/MIT)

## Описание
Веб-приложение для публикации и записи на мероприятия (курсовая работа).
![Главная](docs/images/screen.png)


## Технологии
- Docker
- PHP 8.2
- MySQL 8.4
- Nginx
- Yii Framework

## Требования
- Docker >= 20.10
- Docker Compose >= 1.29

## Установка
1. Клонировать репозиторий:
```bash
git clone https://github.com/yourusername/web-course.git
cd web-course
```

2. Настроить окружение:
```bash
make env  # создаст .env из примера
```

3. Запустить сервисы:
```bash
make install  # запуск контейнеров и установка зависимостей
```

## Использование
Основные команды Makefile:
```makefile
up       # Запуск контейнеров
down     # Остановка контейнеров
migrate  # Применить миграции БД
```

Приложение доступно по адресу: http://localhost:8080

## Структура проекта
```
├── docker-compose.yaml
├── Makefile
├── .env.example
└── web/            # Веб-корень
```

## Примечание
Данный проект является курсовой работой и создан в учебных целях.