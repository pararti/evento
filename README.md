# Event Manager Web Application

[View Russian version](README.ru.md)

[![License](https://img.shields.io/badge/License-MIT-blue.svg)](https://opensource.org/licenses/MIT)

## Description
Web application for event publishing and registration (coursework project).
![Main](docs/images/screen.png)

## Technologies
- Docker
- PHP 8.2
- MySQL 8.4
- Nginx
- Yii Framework

## Requirements
- Docker >= 20.10
- Docker Compose >= 1.29

## Installation
1. Clone repository:
```bash
git clone https://github.com/yourusername/web-course.git
cd web-course
```

2. Create environment:
```bash
make env  # make env from .env.example
```

3. Installation:
```bash
make install  # start container and install depends
```

## Usage
Makefile commands:
```makefile
up       # start containers
down     # stop containers
migrate  # migrate
```

web app url: http://localhost:8080

## Application structure
```
├── docker-compose.yaml
├── Makefile
├── .env.example
└── web/            # web root
```

## Additional information
This project is a term paper and was created for educational purposes.