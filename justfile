# Use Sail to run commands (Shortcut: 'just s')
alias s := sail

# Helper recipe to pass arguments to the sail binary
sail *args:
    ./vendor/bin/sail {{args}}

# Start the development environment
up:
    @just s up -d

# Stop the development environment
stop:
    @just s stop

# Completely tear down the containers and volumes
destroy:
    @just s down -v

# Run database migrations
migrate:
    @just s artisan migrate

# Run any artisan command (e.g., 'just artisan make:controller MyController')
artisan *args:
    @just s artisan {{args}}

# Install/Update dependencies
install:
    @just s composer install
    @just s npm install

# Start the Vite development server
dev:
    @just s npm run dev

# Build assets for production
build:
    @just s npm run build

# Open a shell inside the PHP container
shell:
    @just s shell