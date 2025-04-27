# Cinema-Booking-Systems

A modern single-page cinema booking application built with Laravel, Inertia.js, and Vue 3.

## Overview

This application uses:
- [Laravel](https://laravel.com/) as the backend framework
- [Inertia.js](https://inertiajs.com/) as the bridge between Laravel and Vue
- [Vue 3](https://v3.vuejs.org/) with Composition API for the frontend
- [Vite](https://vitejs.dev/) for frontend asset bundling
- [Tailwind CSS](https://tailwindcss.com/) for styling

## Requirements

- PHP 8.1 or higher
- Node.js 16+ and npm/yarn
- Composer
- Database (MySQL, PostgreSQL, SQLite)

## Installation

### 1. Clone the repository

```bash
git clone https://github.com/VirithHeang12/Cinema-Booking-Systems.git
cd Cinema-Booking-Systems
```

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Install JavaScript dependencies

```bash
npm install
# or if you use yarn
yarn install
```

### 4. Set up environment variables

```bash
cp .env.example .env
php artisan key:generate
```

Open the `.env` file and configure your database connection:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```

### 5. Run database migrations and seeders

```bash
# Run migrations
php artisan migrate

# Run database seeders to populate the database with sample data
php artisan db:seed
```

This will populate your database with:
- Sample movies and showtimes
- Theater configurations and seating arrangements
- User roles and demo accounts

### 6. Build frontend assets

For development:
```bash
npm run dev
# or with yarn
yarn dev
```

For production:
```bash
npm run build
# or with yarn
yarn build
```

### 7. Start the development server

```bash
php artisan serve
```

Your application should now be running at http://localhost:8000

## Demo Accounts

After running the seeders, you can use the following demo accounts:

| Role      | Email                   | Password  |
|-----------|-------------------------|-----------|
| Admin     | admin@gmail.com         | 12345678  |
| User      | user@gmail.com          | 12345678  |


## Features

- **Movie Management**: Add, edit, and manage movies with details and showtimes
- **Theater Management**: Configure theaters, screens, and seating arrangements
- **Booking System**: End-to-end ticket booking with seat selection
- **User Management**: Role-based access control (Admin, User)
- **Reports & Analytics**: Booking statistics and revenue reports

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Acknowledgments

- [Laravel](https://laravel.com/)
- [Inertia.js](https://inertiajs.com/)
- [Vue.js](https://vuejs.org/)
- [Tailwind CSS](https://tailwindcss.com/)

## Contact

If you have any questions, feel free to open an issue or contact the repository owner.
