# 🚀 Deployment Guide for TrueNorthNews

This guide covers various deployment options for your TrueNorthNews Laravel application.

## 📋 Pre-Deployment Checklist

-   [ ] All features tested # 4. Clone repository
        git clone https://github.com/omarashrafali498/truenorthnews.git .cally
-   [ ] Database migrations are up to date
-   [ ] Environment variables configured
-   [ ] File permissions set correctly
-   [ ] SSL certificate ready (for production)
-   [ ] Backup strategy in place

## 🌐 Production Environment Setup

### 1. Server Requirements

**Minimum Requirements:**

-   PHP 8.2 or higher
-   MySQL 5.7+ / PostgreSQL 10+ / SQLite 3.8.8+
-   Nginx or Apache web server
-   Composer
-   Node.js (for asset compilation)

**Recommended Specifications:**

-   2+ CPU cores
-   4GB+ RAM
-   20GB+ SSD storage
-   Ubuntu 20.04+ or CentOS 8+

### 2. Environment Configuration

Create `.env` file for production:

```bash
APP_NAME="TrueNorthNews"
APP_ENV=production
APP_KEY=base64:your-generated-key-here
APP_DEBUG=false
APP_URL=https://yourdomain.com

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=truenorthnews
DB_USERNAME=your_db_user
DB_PASSWORD=your_secure_password

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MAIL_MAILER=smtp
MAIL_HOST=your-smtp-host
MAIL_PORT=587
MAIL_USERNAME=your-email@domain.com
MAIL_PASSWORD=your-email-password
MAIL_ENCRYPTION=tls
```

## 🐳 Docker Deployment

### Dockerfile

```dockerfile
FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u 1000 -d /home/www www
RUN mkdir -p /home/www/.composer && \
    chown -R www:www /home/www

# Set working directory
WORKDIR /var/www

# Copy existing application directory contents
COPY . /var/www

# Copy existing application directory permissions
COPY --chown=www:www . /var/www

# Change current user to www
USER www

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Generate key
RUN php artisan key:generate

# Create storage link
RUN php artisan storage:link

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
```

### Docker Compose

```yaml
version: "3.8"

services:
    app:
        build:
            context: .
            dockerfile: Dockerfile
        container_name: truenorthnews-app
        restart: unless-stopped
        working_dir: /var/www
        volumes:
            - ./:/var/www
        networks:
            - truenorthnews

    webserver:
        image: nginx:alpine
        container_name: truenorthnews-webserver
        restart: unless-stopped
        ports:
            - "80:80"
            - "443:443"
        volumes:
            - ./:/var/www
            - ./docker/nginx:/etc/nginx/conf.d
        networks:
            - truenorthnews

    database:
        image: mysql:8.0
        container_name: truenorthnews-db
        restart: unless-stopped
        environment:
            MYSQL_DATABASE: truenorthnews
            MYSQL_ROOT_PASSWORD: root_password
            MYSQL_USER: laravel_user
            MYSQL_PASSWORD: laravel_password
        volumes:
            - dbdata:/var/lib/mysql
        networks:
            - truenorthnews

networks:
    truenorthnews:
        driver: bridge

volumes:
    dbdata:
        driver: local
```

## ☁️ Cloud Deployment Options

### 1. AWS EC2

```bash
# 1. Launch EC2 instance (Ubuntu 20.04)
# 2. Connect via SSH
ssh -i your-key.pem ubuntu@your-ec2-ip

# 3. Install LAMP stack
sudo apt update
sudo apt install apache2 mysql-server php8.2 php8.2-mysql php8.2-xml php8.2-mbstring php8.2-curl php8.2-zip php8.2-gd

# 4. Install Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# 5. Clone repository
git clone https://github.com/omarashrafali498/truenorthnews.git
cd truenorthnews

# 6. Install dependencies
composer install --no-dev --optimize-autoloader

# 7. Set permissions
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 755 storage bootstrap/cache

# 8. Configure Apache virtual host
sudo nano /etc/apache2/sites-available/truenorthnews.conf
```

### 2. DigitalOcean Droplet

```bash
# 1. Create droplet with LAMP stack
# 2. SSH into droplet
ssh root@your-droplet-ip

# 3. Navigate to web directory
cd /var/www/html

# 4. Clone repository
git clone https://github.com/omarashrafali498/truenorthnews.git .

# 5. Install dependencies
composer install --no-dev

# 6. Set up environment
cp .env.example .env
php artisan key:generate

# 7. Run migrations
php artisan migrate --force

# 8. Set permissions
chown -R www-data:www-data .
chmod -R 755 storage bootstrap/cache
```

### 3. Laravel Forge (Recommended)

1. **Connect your server** (AWS, DigitalOcean, Linode, etc.)
2. **Create new site** in Forge dashboard
3. **Connect Git repository**
4. **Set environment variables** in Forge
5. **Deploy automatically** with Git push

## 🔧 Manual Deployment Steps

### 1. Server Setup

```bash
# Update system
sudo apt update && sudo apt upgrade -y

# Install required packages
sudo apt install nginx mysql-server php8.2-fpm php8.2-mysql php8.2-xml php8.2-mbstring php8.2-curl php8.2-zip php8.2-gd php8.2-bcmath

# Install Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# Install Node.js (for asset compilation)
curl -fsSL https://deb.nodesource.com/setup_18.x | sudo -E bash -
sudo apt-get install -y nodejs
```

### 2. Application Deployment

```bash
# Clone repository
git clone https://github.com/omarashrafali498/truenorthnews.git /var/www/truenorthnews
cd /var/www/truenorthnews

# Install PHP dependencies
composer install --no-dev --optimize-autoloader

# Set up environment
cp .env.example .env
nano .env  # Edit with production values

# Generate application key
php artisan key:generate

# Run database migrations
php artisan migrate --force

# Create storage link
php artisan storage:link

# Compile assets (if using)
npm install
npm run build

# Set permissions
sudo chown -R www-data:www-data .
sudo chmod -R 755 storage bootstrap/cache
```

### 3. Web Server Configuration

**Nginx Configuration:**

```nginx
server {
    listen 80;
    server_name yourdomain.com www.yourdomain.com;
    root /var/www/truenorthnews/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

## 🔒 Security Hardening

### 1. SSL Certificate

```bash
# Install Certbot
sudo apt install certbot python3-certbot-nginx

# Obtain SSL certificate
sudo certbot --nginx -d yourdomain.com -d www.yourdomain.com

# Auto-renewal
sudo crontab -e
# Add: 0 12 * * * /usr/bin/certbot renew --quiet
```

### 2. Firewall Configuration

```bash
# Enable UFW
sudo ufw enable

# Allow necessary ports
sudo ufw allow 22    # SSH
sudo ufw allow 80    # HTTP
sudo ufw allow 443   # HTTPS

# Check status
sudo ufw status
```

### 3. Application Security

```bash
# Set secure file permissions
find /var/www/truenorthnews -type f -exec chmod 644 {} \;
find /var/www/truenorthnews -type d -exec chmod 755 {} \;
chmod -R 775 storage bootstrap/cache

# Secure sensitive files
chmod 600 .env
```

## 📊 Monitoring & Maintenance

### 1. Log Monitoring

```bash
# View Laravel logs
tail -f storage/logs/laravel.log

# View Nginx logs
sudo tail -f /var/log/nginx/access.log
sudo tail -f /var/log/nginx/error.log
```

### 2. Database Backup

```bash
# Create backup script
#!/bin/bash
DATE=$(date +%Y%m%d_%H%M%S)
mysqldump -u username -p password truenorthnews > backup_$DATE.sql
```

### 3. Automated Updates

```bash
# Create update script
#!/bin/bash
cd /var/www/truenorthnews
git pull origin main
composer install --no-dev --optimize-autoloader
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## 🚨 Troubleshooting

### Common Issues

1. **Permission Errors**

    ```bash
    sudo chown -R www-data:www-data storage bootstrap/cache
    sudo chmod -R 775 storage bootstrap/cache
    ```

2. **500 Internal Server Error**

    - Check `storage/logs/laravel.log`
    - Verify `.env` configuration
    - Ensure proper file permissions

3. **Database Connection Issues**

    - Verify database credentials in `.env`
    - Check MySQL service status
    - Test connection manually

4. **Asset Loading Issues**
    - Run `php artisan storage:link`
    - Check web server configuration
    - Verify file permissions

## 📞 Support

For deployment issues:

-   Check the documentation
-   Review server logs
-   Test in staging environment first
-   Contact support team

---

Happy Deploying! 🚀
