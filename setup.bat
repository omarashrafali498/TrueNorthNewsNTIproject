@echo off
REM TrueNorthNews Setup Script for Windows
REM This script helps set up the development environment on Windows

echo.
echo 🚀 TrueNorthNews Setup Script (Windows)
echo ========================================

REM Step 1: Check PHP
echo [STEP] 1. Checking PHP installation...
php --version >nul 2>&1
if %errorlevel% neq 0 (
    echo [ERROR] PHP is not installed or not in PATH
    echo Please install PHP 8.2 or higher and add it to your PATH
    pause
    exit /b 1
)

for /f "tokens=2" %%i in ('php -r "echo PHP_VERSION;"') do set PHP_VERSION=%%i
echo [INFO] PHP version: %PHP_VERSION%

REM Step 2: Check Composer
echo [STEP] 2. Checking Composer installation...
composer --version >nul 2>&1
if %errorlevel% neq 0 (
    echo [ERROR] Composer is not installed or not in PATH
    echo Please install Composer and add it to your PATH
    pause
    exit /b 1
)
echo [INFO] Composer is installed

REM Step 3: Install dependencies
echo [STEP] 3. Installing PHP dependencies...
composer install
if %errorlevel% neq 0 (
    echo [ERROR] Failed to install PHP dependencies
    pause
    exit /b 1
)
echo [INFO] PHP dependencies installed successfully

REM Step 4: Environment setup
echo [STEP] 4. Setting up environment...
if not exist .env (
    copy .env.example .env
    echo [INFO] Environment file created
) else (
    echo [WARNING] Environment file already exists
)

REM Step 5: Generate application key
echo [STEP] 5. Generating application key...
php artisan key:generate
if %errorlevel% neq 0 (
    echo [ERROR] Failed to generate application key
    pause
    exit /b 1
)
echo [INFO] Application key generated

REM Step 6: Database setup
echo [STEP] 6. Setting up database...

REM Create SQLite database file if it doesn't exist
if not exist database\database.sqlite (
    type nul > database\database.sqlite
    echo [INFO] SQLite database file created
)

REM Run migrations
php artisan migrate
if %errorlevel% neq 0 (
    echo [ERROR] Database migrations failed
    pause
    exit /b 1
)
echo [INFO] Database migrations completed

REM Step 7: Ask about seeding
set /p SEED="Do you want to seed the database with sample data? (y/N): "
if /i "%SEED%"=="y" (
    echo [STEP] 7. Seeding database...
    php artisan db:seed
    if %errorlevel% neq 0 (
        echo [WARNING] Database seeding failed, but setup can continue
    ) else (
        echo [INFO] Database seeded successfully
    )
)

REM Step 8: Storage link
echo [STEP] 8. Creating storage link...
php artisan storage:link
if %errorlevel% neq 0 (
    echo [WARNING] Storage link creation failed, but setup can continue
) else (
    echo [INFO] Storage link created
)

REM Step 9: Final checks
echo [STEP] 9. Running final checks...
php artisan --version >nul 2>&1
if %errorlevel% neq 0 (
    echo [ERROR] Laravel installation check failed
    pause
    exit /b 1
)
echo [INFO] Laravel installation is working correctly

REM Success message
echo.
echo ========================================
echo [INFO] 🎉 Setup completed successfully!
echo.
echo Next steps:
echo 1. Review your .env file and update configuration as needed
echo 2. Start the development server: php artisan serve
echo 3. Visit http://localhost:8000 to view your application
echo.
echo Default admin credentials (if seeded):
echo Email: admin@truenorthnews.com
echo Password: password
echo.
echo For production deployment, see DEPLOYMENT.md
echo ========================================
echo.
pause