# Task Management System API

This is a simple RESTful API for a Task Management System built using Lumen. The API allows users to manage tasks by performing basic CRUD (Create, Read, Update, Delete) operations.

## Table of Contents

- [Features](#features)
- [Technologies Used](#technologies-used)
- [Installation](#installation)
- [Database Configuration](#database-configuration)
- [Running the Application](#running-the-application)
- [API Endpoints](#api-endpoints)
- [Testing with Postman](#testing-with-postman)
- [Validation](#validation)
- [Contributing](#contributing)
- [License](#license)

## Features

- Create, read, update, and delete tasks
- Filter tasks by status and due date
- Search for tasks by title
- Pagination for task listing

## Technologies Used

- PHP 8.x
- Lumen (Micro-framework by Laravel)
- PostgreSQL (Database)
- Composer (Dependency Management)

## Installation

### Prerequisites

Before you begin, ensure you have the following installed:

- PHP (8.x)
- Composer
- PostgreSQL
- Git

### Steps

1. **Clone the repository:**

   Open your terminal and run the following command:

   ```bash
   git clone https://github.com/Jkiruri/task-manager
   cd task-manager

2. **Install dependencies:**
    Make sure you have Composer installed. Run the following command to install the necessary dependencies:
    `composer install`

3. **Set up your environment file:**
    Copy the .env.example file to .env using the following command
    `cp .env.example .env`

4. **Configure the environment:**
    Open the .env file and set up your database connection details:
    DB_CONNECTION=pgsql
    DB_HOST=127.0.0.1
    DB_PORT=5432
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_user
    DB_PASSWORD=your_database_password

5. **Create the database:**
    Open your PostgreSQL command line or any GUI tool and create a new database for your project. For example:
    `CREATE DATABASE task_management;`

6. **Run migrations:**

    Create the tasks table in your database using the following command

    `php artisan migrate`

7. **Running the Application:**

    To run the application, you can use the built-in PHP server. Make sure you are in the root directory of your project and run:
    `php -S localhost:8000 -t public`

