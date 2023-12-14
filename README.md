### Hexlet tests and linter status:
[![Actions Status](https://github.com/Ludmila398/php-project-57/workflows/hexlet-check/badge.svg)](https://github.com/Ludmila398/php-project-57/actions)
[![Linter and Tests](https://github.com/Ludmila398/php-project-57/actions/workflows/main.yml/badge.svg)](https://github.com/Ludmila398/php-project-57/actions/workflows/main.yml)
[![Maintainability](https://api.codeclimate.com/v1/badges/3e4d60b407cfd036d487/maintainability)](https://codeclimate.com/github/Ludmila398/php-project-57/maintainability)

### Project description

[Task Manager](https://task-manager-php.onrender.com/) is a web application that allows various users to create, manage and track tasks. Each task is assigned a status and can have an optional executor and labels (tags). Registration and authentication are required to use the system. Only authenticated users are authorized to create and edit tasks. Once a task is established and appears in the overall list, it can be edited and its status updated by all users, but only the original creator has the ability to delete it.

### Requirements

- PHP >= 8.1
- Composer
- PostgreSQL

### Installation

Clone the repo and enter the project folder
```
git clone git@github.com:Ludmila398/php-project-57.git

cd php-project-57
```
Install the app
```
make setup
```

Connect DB 

Define environment variables

Run the web server
```
php artisan migrate:refresh --seed --force
php artisan serve
```
Open your browser and navigate to http://127.0.0.1:8000/ to view the pages