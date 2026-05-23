# UTS Pemrograman Web

A simple academic dashboard web application built as a course project for **Pemrograman Web Lanjut** (Advanced Web Programming) at STMIK Antar Bangsa. It demonstrates Laravel's MVC architecture, Blade templating, and modern frontend tooling.

## Stack

| Layer     | Technology                        |
|-----------|-----------------------------------|
| Backend   | PHP 8.4, Laravel 13               |
| Frontend  | Blade, Tailwind CSS    |
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

# 3. Install dependencies via Composer
# Jika punya Composer lokal:
composer install
# Jika via Docker:
docker run --rm -v $(pwd):/app -w /app composer install

# 4. Jalankan Docker Containers
just up
# Alternatif tanpa just:
docker compose up -d

# 5. Setup Aplikasi (Generate Key, Migrasi, & Seeder)
just artisan key:generate
just migrate
just artisan db:seed

# Alternatif tanpa just (menjalankan perintah di dalam container):
docker compose exec app php artisan key:generate
docker compose exec app php artisan migrate
docker compose exec app php artisan db:seed
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
