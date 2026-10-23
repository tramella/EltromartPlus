# EltromartPlus — Technology E-Commerce Platform

A modern, responsive e-commerce web application built with Laravel 11, designed for browsing and shopping for smartphones, laptops, workstations, headsets, power banks, and technology accessories.

[![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2%2B-777BB4?logo=php&logoColor=white)](https://www.php.net)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.x-38BDF8?logo=tailwindcss&logoColor=white)](https://tailwindcss.com)
[![Alpine.js](https://img.shields.io/badge/Alpine.js-3.x-8BC0D0?logo=alpinedotjs&logoColor=white)](https://alpinejs.dev)
[![Vite](https://img.shields.io/badge/Vite-5.x-646CFF?logo=vite&logoColor=white)](https://vite.dev)
[![Pest](https://img.shields.io/badge/Testing-Pest_3-6366F1)](https://pestphp.com)
[![License: MIT](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

## Overview

EltromartPlus is a Laravel-based e-commerce project focused on delivering a clean shopping experience across desktop and mobile devices. It combines a responsive product catalog, session-based shopping features, optimized product imagery, and a modern frontend powered by Tailwind CSS and Alpine.js.

## Features

### Product Catalog
- Browse technology products by category and brand.
- Search products using query parameters.
- Navigate large product catalogs with custom pagination and ellipsis.
- Filter products using a mobile-friendly slide-over interface.

### Shopping Cart & Wishlist
- Session-backed shopping cart and wishlist.
- Navigation badges displaying cart and wishlist counts.
- Quantity controls for adjusting cart items.
- Responsive cart layouts optimized for mobile screens.

### Responsive UI & Interactions
- Mobile-first layouts for different screen sizes.
- Sticky mobile navigation for Home, Catalog, Wishlist, Cart, and Profile.
- Integrated mobile search in the header.
- Page progress indicator for navigation and form submissions.
- Hero slideshow with glassmorphism styling and loading optimizations.

### Product Images & Performance
- Cloudinary-hosted product images through the `CLOUDINARY_IMAGE_URL` environment variable.
- Local fallback support for product images.
- White product-card backgrounds for clean presentation of transparent product images.
- Eloquent eager loading to help reduce N+1 database queries.

### Testing
- Pest 3 test suite.
- Tests covering unit functionality, authentication, registration, profiles, and verification.
- SQLite in-memory database configuration for isolated test runs.

## Tech Stack

| Layer | Technology |
|---|---|
| Backend | Laravel 11 |
| Language | PHP 8.2+ |
| Database | MySQL |
| Testing | Pest 3 / PHPUnit |
| Frontend | Blade, Tailwind CSS 3, Alpine.js 3 |
| Build Tool | Vite 5 |
| Images | Cloudinary |
| Icons & Typography | Font Awesome 6, Plus Jakarta Sans |
| Design | Figma |
| Deployment | Render with Docker |
| Database Hosting | Aiven MySQL |

## UI/UX Design

Explore the original design board:

**[View EltromartPlus on Figma](https://www.figma.com/design/ENZCfSOjGzmMYdH9dOSRDk/Eltromart%2B?node-id=0-1)**

## Getting Started

### Prerequisites

Make sure the following tools are installed:

- PHP 8.2 or later
- Composer 2.x
- Node.js 18 or later
- npm
- MySQL, or another database configured for Laravel

PHP extensions required by your environment should include the appropriate PDO database driver.

### 1. Clone the Repository

```bash
git clone https://github.com/Tramella/EltromartPlus.git
cd EltromartPlus
```

### 2. Install Dependencies

```bash
composer install
npm install
```

### 3. Configure Environment Variables

Create your local environment file:

```bash
cp .env.example .env
php artisan key:generate
```

On Windows PowerShell, use:

```powershell
Copy-Item .env.example .env
php artisan key:generate
```

Configure your local `.env` file with the appropriate database and image settings:

```env
APP_NAME=EltromartPlus
APP_ENV=local
APP_DEBUG=true

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=eltromart
DB_USERNAME=root
DB_PASSWORD=

CLOUDINARY_IMAGE_URL=https://res.cloudinary.com/dalrsrbw0/image/upload/v1786957890/
```

Replace the database values with your actual local configuration. Keep credentials and other secrets in environment variables; never commit your real `.env` file.

### 4. Run Database Migrations

To create the database tables:

```bash
php artisan migrate
```

To reset the local database and seed sample data, if your seeders are configured for this purpose:

```bash
php artisan migrate:fresh --seed
```

**Warning:** `migrate:fresh` drops all existing tables. Use it only when resetting a local or disposable database.

### 5. Build Frontend Assets

For development with hot reload:

```bash
npm run dev
```

In a separate terminal, start Laravel:

```bash
php artisan serve
```

Open [http://127.0.0.1:8000](http://127.0.0.1:8000).

To build production assets instead:

```bash
npm run build
```

## Running Tests

Run the automated test suite with Pest:

```bash
./vendor/bin/pest
```

On Windows:

```powershell
.\vendor\bin\pest
```

The project is configured to use an isolated in-memory SQLite database for tests through `phpunit.xml`. Ensure the required SQLite PHP extension is enabled.

## Deployment

The application is configured for Docker-based deployment on Render, with Aiven MySQL as the production database.

### Render Configuration

1. Connect the `Tramella/EltromartPlus` GitHub repository to a Render Web Service.
2. Configure the service to build using the repository's `Dockerfile`.
3. Add the required production environment variables in the Render dashboard.

At minimum, configure the following variables with your actual production values:

```env
APP_ENV=production
APP_DEBUG=false
APP_KEY=<your-existing-generated-app-key>

DB_CONNECTION=mysql
DB_HOST=<your-aiven-mysql-host>
DB_PORT=<your-aiven-mysql-port>
DB_DATABASE=<your-aiven-database-name>
DB_USERNAME=<your-aiven-username>
DB_PASSWORD=<your-aiven-password>

MYSQL_ATTR_SSL_CA=/var/www/html/storage/certs/ca.pem
SESSION_DRIVER=file

CLOUDINARY_IMAGE_URL=https://res.cloudinary.com/dalrsrbw0/image/upload/v1786957890/
```

**Deployment notes:**
- Use the actual connection details provided by Aiven.
- Keep the Aiven CA certificate at `storage/certs/ca.pem` and ensure it is included in the Docker image.
- Configure `config/database.php` to read `MYSQL_ATTR_SSL_CA`.
- Keep `APP_DEBUG=false` in production.
- Preserve your existing `APP_KEY` when redeploying an established application.
- Ensure the database exists and the configured database user has the necessary permissions.
- Run migrations against the intended production database before serving traffic.

Never commit production credentials, private keys, or your real `.env` file to source control.

## Project Structure

The application follows Laravel's conventional project organization:

```text
EltromartPlus/
├── app/             # Application logic
├── config/          # Application configuration
├── database/        # Migrations, factories, and seeders
├── public/          # Public entry point and static assets
├── resources/       # Blade views and frontend source files
├── routes/          # Application routes
├── storage/         # Logs, cache, and application storage
├── tests/           # Automated tests
├── Dockerfile       # Container build configuration
├── composer.json    # PHP dependencies
├── package.json     # Frontend dependencies
└── vite.config.js   # Vite configuration
```

## License

This project is licensed under the [MIT License](LICENSE).
