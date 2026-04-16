# LaraLearn Academic

A simple academic dashboard web application built as a course project for **Pemrograman Web Lanjut II** (Advanced Web Programming) at STMIK Antar Bangsa. It demonstrates Laravel's MVC architecture, Blade templating, and modern frontend tooling.

## Stack

| Layer     | Technology                        |
|-----------|-----------------------------------|
| Backend   | PHP 8.3, Laravel 13               |
| Frontend  | Blade, Tailwind CSS 4, Vite 8     |
| Database  | MySQL 8.4                         |
| Dev Env   | Laravel Sail (Docker)             |
| Task Runner | Just                            |

## Pages

- `/` — Course dashboard (subject info & syllabus)
- `/about` — App metadata (name, version, author)
- `/profile` — Student profile page

## Setup

### Prerequisites

- Docker & Docker Compose
- [`just`](https://github.com/casey/just) (optional, but recommended)

### Steps

```bash
# 1. Clone the repo
git clone https://gitlab.com/nyfelle-school/akademik-app.git
cd akademik-app

# 2. Copy environment file
cp .env.example .env

# 3. Install PHP dependencies (host machine, one-time bootstrap)
composer install

# 4. Start containers
just up
# or: ./vendor/bin/sail up -d

# 5. Generate app key & run migrations
just artisan key:generate
just migrate

# 6. Install JS dependencies & start Vite
just install
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