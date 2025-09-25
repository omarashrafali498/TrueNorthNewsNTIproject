#!/bin/bash

# TrueNorthNews Setup Script
# This script helps set up the development environment

echo "🚀 TrueNorthNews Setup Script"
echo "================================"

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Function to print colored output
print_status() {
    echo -e "${GREEN}[INFO]${NC} $1"
}

print_warning() {
    echo -e "${YELLOW}[WARNING]${NC} $1"
}

print_error() {
    echo -e "${RED}[ERROR]${NC} $1"
}

print_step() {
    echo -e "${BLUE}[STEP]${NC} $1"
}

# Check if running on Windows (Git Bash/WSL)
if [[ "$OSTYPE" == "msys" || "$OSTYPE" == "cygwin" ]]; then
    print_warning "Detected Windows environment. Some commands may need adjustment."
fi

# Step 1: Check dependencies
print_step "1. Checking dependencies..."

# Check PHP
if command -v php &> /dev/null; then
    PHP_VERSION=$(php -r "echo PHP_VERSION;")
    print_status "PHP version: $PHP_VERSION"
    
    if php -r "exit(version_compare(PHP_VERSION, '8.2.0', '<') ? 1 : 0);"; then
        print_error "PHP 8.2 or higher is required. Current version: $PHP_VERSION"
        exit 1
    fi
else
    print_error "PHP is not installed or not in PATH"
    exit 1
fi

# Check Composer
if command -v composer &> /dev/null; then
    COMPOSER_VERSION=$(composer --version --no-ansi | head -1)
    print_status "Composer found: $COMPOSER_VERSION"
else
    print_error "Composer is not installed or not in PATH"
    exit 1
fi

# Step 2: Install PHP dependencies
print_step "2. Installing PHP dependencies..."
if composer install; then
    print_status "PHP dependencies installed successfully"
else
    print_error "Failed to install PHP dependencies"
    exit 1
fi

# Step 3: Environment setup
print_step "3. Setting up environment..."

if [ ! -f .env ]; then
    if cp .env.example .env; then
        print_status "Environment file created"
    else
        print_error "Failed to create environment file"
        exit 1
    fi
else
    print_warning "Environment file already exists"
fi

# Step 4: Generate application key
print_step "4. Generating application key..."
if php artisan key:generate; then
    print_status "Application key generated"
else
    print_error "Failed to generate application key"
    exit 1
fi

# Step 5: Database setup
print_step "5. Setting up database..."

# Create SQLite database file if it doesn't exist
if [ ! -f database/database.sqlite ]; then
    touch database/database.sqlite
    print_status "SQLite database file created"
fi

# Run migrations
if php artisan migrate; then
    print_status "Database migrations completed"
else
    print_error "Database migrations failed"
    exit 1
fi

# Ask if user wants to seed the database
read -p "Do you want to seed the database with sample data? (y/N): " -n 1 -r
echo
if [[ $REPLY =~ ^[Yy]$ ]]; then
    print_step "6. Seeding database..."
    if php artisan db:seed; then
        print_status "Database seeded successfully"
    else
        print_warning "Database seeding failed, but setup can continue"
    fi
fi

# Step 7: Storage link
print_step "7. Creating storage link..."
if php artisan storage:link; then
    print_status "Storage link created"
else
    print_warning "Storage link creation failed, but setup can continue"
fi

# Step 8: Set permissions (Unix-like systems)
if [[ "$OSTYPE" != "msys" && "$OSTYPE" != "cygwin" ]]; then
    print_step "8. Setting file permissions..."
    chmod -R 775 storage bootstrap/cache
    print_status "File permissions set"
fi

# Step 9: Check if everything is working
print_step "9. Running final checks..."

# Test if artisan commands work
if php artisan --version &> /dev/null; then
    print_status "Laravel installation is working correctly"
else
    print_error "Laravel installation check failed"
    exit 1
fi

# Final success message
echo
echo "================================"
print_status "🎉 Setup completed successfully!"
echo
echo "Next steps:"
echo "1. Review your .env file and update configuration as needed"
echo "2. Start the development server: php artisan serve"
echo "3. Visit http://localhost:8000 to view your application"
echo
echo "Default admin credentials (if seeded):"
echo "Email: admin@truenorthnews.com"
echo "Password: password"
echo
echo "For production deployment, see DEPLOYMENT.md"
echo "================================"