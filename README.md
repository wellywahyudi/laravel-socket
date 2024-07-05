# Laravel Real-Time User Registration with Laravel Reverb, Echo, and Alpine.js

This project demonstrates how to set up a Laravel application to handle real-time user registrations using Laravel Reverb, Echo, and Alpine.js with a Tailwind CSS slide-up transition effect.

## Prerequisites

- PHP 8.2 or higher
- Composer
- Node.js and npm

## Installation

### 1. Clone the Repository

```bash
git clone https://github.com/wellywahyudi/laravel-socket.git
cd laravel-socket
```

### 2. Install PHP Dependencies
```sh
composer install
```

### 3. Install JavaScript Dependencies
```sh
npm install
```

### 4. Set Up Environment Variables
Copy the .env.example file to .env and update the necessary environment variables:
```sh
cp .env.example .env
```

Update the following variables in the .env file with your database credentials:
```sh
DB_CONNECTION=pgsql
DB_HOST=localhost
DB_PORT=5432
DB_DATABASE=lara-socket
DB_USERNAME=postgres
DB_PASSWORD=
```

### 5. Run Database Migrations
```sh
php artisan migrate
```

### 6. Run the Application
```sh
php artisan serve
```

### 7. Running the Laravel Reverb
```sh
php artisan reverb:start
```
