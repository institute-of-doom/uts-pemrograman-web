# UTS Pemrograman Web

A comprehensive student management and academic dashboard web application built as a mid-term exam project (UTS) for **Pemrograman Web Lanjut** at STMIK Antar Bangsa. 

The application demonstrates advanced Laravel concepts including Eloquent relationships, MVC architecture, interactive Blade component templating all optimized to run inside a lightweight containerized environment.

## Stack

- Backend: PHP 8.4, Laravel 13
- Frontend: Blade, Tailwind CSS
- Database: SQlite
- Dev Tools: Docker, Just
- 
## Getting Started

### Prerequisites

- Docker & Docker Compose
- [`just`](https://github.com/casey/just) (optional, but recommended)

### Steps

```bash
# 1. Clone the repo
git clone https://github.com/institute-of-doom/uts-pemrograman-web.git
cd uts-pemrograman-web

# 2. Copy environment file
cp .env.example .env

# 3. Install dependencies via Composer
# Local composer install:
composer install
# Using Docker:
docker run --rm -v $(pwd):/app -w /app composer install

# 4. Run the Docker container
just up
# Alternative:
docker compose up -d

# 5. Setup (Generate Key, Migrasi, & Seeder)
just artisan key:generate
just migrate
just artisan db:seed

# Alternatively you can execute commands through Docker:
docker compose exec app php artisan key:generate
docker compose exec app php artisan migrate
docker compose exec app php artisan db:seed

# Access the site
# If this port is already in use on your machine, simply open the docker-compose.yml file and change the first number in the port sections
http://localhost:8888/
```

## Common Commands

```
just up             # Start containers
just stop           # Stop containers
just destroy        # Tear down containers + volumes
just migrate        # Run migrations
just shell          # Open shell in PHP container
just artisan {args} # Run any Artisan command
```
