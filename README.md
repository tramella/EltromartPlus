# EltromartPlus - Technological Equipment E-Commerce Platform

[![Pest Tests](https://github.com/Tramella/EltromartPlus/actions/workflows/tests.yml/badge.svg)](https://github.com/Tramella/EltromartPlus/actions/workflows/tests.yml)
[![Laravel 11](https://img.shields.io/badge/Laravel-v11.x-FF2D20?logo=laravel)](https://laravel.com)
[![PHP Version](https://img.shields.io/badge/PHP-8.2%2B-777BB4?logo=php)](https://php.net)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-v3.x-38BDF8?logo=tailwind-css)](https://tailwindcss.com)
[![Alpine.js](https://img.shields.io/badge/Alpine.js-v3.x-8BC0D0?logo=alpine.js)](https://alpinejs.dev)
[![Figma Design](https://img.shields.io/badge/Figma-Design_Board-F24E1E?logo=figma)](https://www.figma.com/design/ENZCfSOjGzmMYdH9dOSRDk/Eltromart%2B?node-id=0-1&t=uzkSrSFB6gzIhhlJ-1)

EltromartPlus is a high-performance, modern Laravel 11 e-commerce web application tailored for selling flagship smartphones, laptops, workstations, headsets, power banks, and technological accessories.

---

## 🌟 Key Features & Capabilities

- **Modern Product Catalog**:
  - Filter by Categories, Brands, and Product Search query strings.
  - Custom sliding pagination with ellipsis (`...`) formatting for large catalog datasets.
  - Mobile slide-over filter modal component built with Alpine.js.

- **Unified Shopping Cart & Wishlist**:
  - Instant session-backed Cart & Wishlist counters with badge notifications in navigation headers.
  - Symmetrical quantity steppers (`+` / `-`) for instant cart quantity modifications.
  - Mobile-optimized responsive cart item layout cards for smartphone displays.

- **Responsive Mobile First UI**:
  - Sticky mobile bottom navigation app bar (**Home**, **Catalog**, **Wishlist**, **Cart**, **Profile**).
  - Integrated mobile search bar input row in header.
  - Edge-to-edge full-width top announcement bar with zero border radius.
  - Glassmorphic hero slideshow with LCP optimization.

- **Enterprise Technical Architecture**:
  - Eager loading on Eloquent queries to prevent N+1 query overhead.
  - Pest 3 PHP test suite covering unit, authentication, registration, profile, and verification features.
  - Production deployment pipeline configured for Railway with automated migrations & database seeders.

---

## 🛠️ Technology Stack

| Layer | Technology |
| :--- | :--- |
| **Backend Framework** | Laravel 11 (PHP 8.2+) |
| **Test Framework** | Pest 3 / PHPUnit |
| **Frontend Utilities** | Tailwind CSS v3, Alpine.js v3 |
| **Icons & Fonts** | FontAwesome 6, Plus Jakarta Sans |
| **Build Pipeline** | Vite 5, Node.js |
| **Database** | MySQL (Production) / SQLite In-Memory (Test Runs) |
| **Deployment** | Railway PaaS (Nixpacks & Procfile) |

---

## 🚀 Local Installation & Setup

Follow these steps to run EltromartPlus locally on your workstation:

### Prerequisites
- **PHP** >= 8.2 with PDO & SQLite extensions enabled
- **Composer** >= 2.x
- **Node.js** >= 18.x & **npm**

### Step 1: Clone Repository & Install Dependencies
```bash
git clone https://github.com/Tramella/EltromartPlus.git
cd EltromartPlus

# Install PHP composer dependencies
composer install

# Install Frontend JavaScript/CSS packages
npm install
```

### Step 2: Configure Environment
```bash
cp .env.example .env
php artisan key:generate
```

Ensure your `.env` database parameters are set up (e.g. MySQL credentials):
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=eltromart
DB_USERNAME=root
DB_PASSWORD=
```

### Step 3: Run Database Migrations & Seed Data
```bash
php artisan migrate:fresh --seed
```

### Step 4: Compile Assets & Start Local Server
```bash
# Terminal 1: Vite dev server
npm run dev

# Terminal 2: Laravel development server
php artisan serve
```

Access the application in your web browser at `http://127.0.0.1:8000`.

---

## 🧪 Running Automated Test Suite

EltromartPlus uses **Pest 3** for unit and feature testing. Execute the test suite with:

```bash
./vendor/bin/pest
```

*Note: Automated tests run using isolated in-memory SQLite configured in [`phpunit.xml`](file:///e:/eltromartplus_project/phpunit.xml).*

---

## 🚢 Deployment (Railway)

EltromartPlus includes pre-configured deployment artifacts for Railway PaaS:

- **[`Procfile`](file:///e:/eltromartplus_project/Procfile)**: Runs database migrations, seeders, and binds `php artisan serve` to `$PORT`.
- **[`nixpacks.toml`](file:///e:/eltromartplus_project/nixpacks.toml)**: Builds composer autoloaders and compiles production assets with `npm run build`.

When deploying to Railway:
1. Connect your GitHub repository `Tramella/EltromartPlus`.
2. Add MySQL database service and link variables (`DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).
3. Set `APP_ENV=production` and `APP_KEY`. Railway will automatically execute builds, run database seeders, and serve traffic over HTTPS.

---

## 🎨 Figma Design Reference

View the original UI/UX design board on [Figma](https://www.figma.com/design/ENZCfSOjGzmMYdH9dOSRDk/Eltromart%2B?node-id=0-1&t=uzkSrSFB6gzIhhlJ-1).

---

## 📄 License

This project is open-sourced software licensed under the [MIT license](LICENSE).
