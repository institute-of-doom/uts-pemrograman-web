# UTS Pemrograman Web

A simple academic dashboard web application built as a course project for **Pemrograman Web Lanjut** (Advanced Web Programming) at STMIK Antar Bangsa. It demonstrates Laravel's MVC architecture, Blade templating, and modern frontend tooling.

## Stack

| Layer     | Technology                        |
|-----------|-----------------------------------|
| Backend   | PHP 8.4, Laravel 13               |
| Frontend  | Blade, Tailwind CSS 4, Vite 8     |
| Database  | Sqlite                         |
| Dev Env   | Docker             |
| Task Runner | Just                            |

## Setup

### Prerequisites

- Docker & Docker Compose
- [`just`](https://github.com/casey/just) (optional, but recommended)

### Steps

```bash
# 1. Clone the repo
git clone https://github.com/Isvane/uts-pemrograman-web.git
cd uts-pemrograman-web

# 2. Copy environment file
cp .env.example .env

# 3. Composer install
composer install # or docker run --rm -v .:/app -w /app composer install

# 3. Start containers
just up # or docker compose up -d

# 5. Generate app key & run migrations
just artisan key:generate # you can use the normal php artisan command instead.
just migrate

# 6. Install JS dependencies & start Vite
just install # you can use the normal npm command instead.
just dev
```

## Common Commands

```
just up          # Start containers
just stop        # Stop containers
just destroy     # Tear down containers + volumes
just migrate     # Run migrations
just dev         # Start Vite dev server
just build       # Build assets for production
just shell       # Open shell in PHP container
just artisan ... # Run any Artisan command
```
