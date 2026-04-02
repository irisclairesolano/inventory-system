# Deployment Guide

**Inventory Management System - Production Deployment**

---

## Table of Contents
1. [Deployment Overview](#deployment-overview)
2. [Pre-Deployment Checklist](#pre-deployment-checklist)
3. [GitHub Setup](#github-setup)
4. [Shared Hosting Deployment](#shared-hosting-deployment)
5. [VPS Deployment](#vps-deployment)
6. [Docker Deployment](#docker-deployment)
7. [PaaS Deployment (Railway/Render)](#paas-deployment)
8. [Environment Configuration](#environment-configuration)
9. [Database Migration](#database-migration)
10. [Post-Deployment Steps](#post-deployment-steps)
11. [Troubleshooting](#troubleshooting)

---

## GitHub Setup

### Initial Git Configuration

Before deploying, initialize git and push to GitHub:

```bash
cd project-directory
git init
git add .
git commit -m "Initial commit: inventory system"
git branch -M main
git remote add origin https://github.com/YOUR_USERNAME/inventory-system.git
git push -u origin main
```

**Required:** Replace `YOUR_USERNAME` with your GitHub username.

### Cloning in Production

Instead of manual deployment, simply clone from GitHub:

```bash
git clone https://github.com/YOUR_USERNAME/inventory-system.git
cd inventory-system
composer install --no-dev
npm ci
npm run build
```

### Pulling Updates

When deploying updates from GitHub:

```bash
git pull origin main
composer install --no-dev
npm ci
npm run build
php artisan migrate --force
php artisan cache:clear
```

---

## Deployment Overview

### System Requirements for Production

**Server:**
- PHP 8.1 or higher
- MySQL 8.0+ or MariaDB 10.4+
- Composer
- Node.js & npm (or pre-compiled assets)
- OpenSSL extension
- PDO extension
- Mbstring extension

**Resources (Minimum):**
- CPU: 1 core
- RAM: 512MB (1GB recommended)
- Disk: 5GB
- Bandwidth: Shared recommended

### Deployment Options

| Option | Best For | Cost | Difficulty |
|--------|----------|------|------------|
| **Shared Hosting** | Small teams, budget | $5-15/month | Easy |
| **VPS** | Control & scalability | $5-50/month | Medium |
| **Docker** | Modern deployment | Varies | Medium-Hard |
| **PaaS** | Quick deployment | $7-50/month | Easy |

---

## Pre-Deployment Checklist

### Development Preparation

- [ ] Test all features locally
- [ ] Run `php artisan test` - ensure all tests pass
- [ ] Run `php artisan migrate` - verify migrations work
- [ ] Compile assets: `npm run build`
- [ ] Update `.env.example` with all required variables
- [ ] Remove debug code and `dd()` statements
- [ ] Check for hardcoded paths or credentials

### Security Review

- [ ] `APP_DEBUG=false` in production `.env`
- [ ] `APP_ENV=production` in production `.env`
- [ ] Strong `APP_KEY` generated
- [ ] Database credentials are complex
- [ ] CORS configured properly
- [ ] CSRF tokens enabled
- [ ] Rate limiting configured
- [ ] File permissions correct

### Code Optimization

```bash
# Optimize Laravel
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Optimize autoloader
composer install --optimize-autoloader --no-dev

# Compile assets
npm run build
```

### Backup Local Development

```bash
# Create database backup
mysqldump -u root inventory_db > backup-dev.sql

# Create code backup
git commit -m "Pre-deployment backup"
git push origin main
```

---

## Shared Hosting Deployment

### Perfect For: Budget-conscious deployment with FTP/SFTP access

### Prerequisites
- Shared hosting account with SSH access (preferred) or FTP
- PHP 8.1+
- MySQL 5.7+
- Composer command available

### Step-by-Step Deployment

#### 1. Connect via SSH

```bash
ssh username@your-domain.com
cd public_html
```

#### 2. Clone or Upload Repository

**Option A: Git Clone (with SSH key)**
```bash
git clone https://github.com/your-username/inventory-system.git .
```

**Option B: Upload via FTP**
- Use FileZilla or cPanel File Manager
- Upload all project files to `public_html/`
- Make sure `.env` file is included (not `.env.example`)

#### 3. Install Dependencies

```bash
cd /var/www/html/your-domain
composer install --no-dev --optimize-autoloader
npm install
npm run build
```

#### 4. Create `.env` File

```bash
cp .env.example .env
nano .env
```

**Update these values:**
```env
APP_NAME="Inventory System"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com

DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=your_db_name
DB_USERNAME=your_db_user
DB_PASSWORD=strong_password_here

MAIL_MAILER=smtp
MAIL_HOST=your_smtp_host
MAIL_PORT=587
MAIL_USERNAME=your_email@domain.com
MAIL_PASSWORD=your_email_password
MAIL_FROM_ADDRESS=noreply@your-domain.com
```

#### 5. Generate Application Key

```bash
php artisan key:generate
```

#### 6. Create Database

```bash
mysql -u your_db_user -p
CREATE DATABASE inventory_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;
```

#### 7. Run Migrations

```bash
php artisan migrate --force
php artisan db:seed --class=AdminUserSeeder --force
php artisan db:seed --class=ProductCategorySeeder --force
```

#### 8. Create Storage Link

```bash
php artisan storage:link
chmod -R 775 storage bootstrap/cache
chmod -R 755 public
```

#### 9. Configure Web Server (.htaccess)

Create `/public/.htaccess` (Laravel includes this by default):

```apache
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On

    # Handle Authorization Header
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    # Redirect Trailing Slashes If Not A Folder...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.*)/$ /$1 [L,R=301]

    # Handle Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
```

#### 10. Set Directory Permissions (Important!)

```bash
sudo chown -R www-data:www-data /var/www/html/your-domain
chmod -R 755 /var/www/html/your-domain
chmod -R 775 /var/www/html/your-domain/storage
chmod -R 775 /var/www/html/your-domain/bootstrap/cache
```

### Verify Deployment

1. Visit: `https://your-domain.com`
2. Should see Laravel welcome page
3. Go to `/login`
4. Login with: `admin@inventory.com` / `Admin@1234`

---

## VPS Deployment

### Perfect For: Full control, scalability, custom configurations

### Prerequisites
- VPS running Ubuntu 20.04 LTS or higher
- SSH access with sudo privileges
- Domain DNS configured to point to VPS IP

### Step-by-Step Deployment

#### 1. Initial Server Setup

```bash
# SSH into VPS
ssh root@your_vps_ip

# Update system
apt update && apt upgrade -y

# Install required packages
apt install -y curl wget git composer
apt install -y php8.1 php8.1-cli php8.1-fpm php8.1-mysql php8.1-mbstring php8.1-xml php8.1-bcmath php8.1-json php8.1-gd php8.1-opcache
apt install -y mysql-server mysql-client
apt install -y nginx
apt install -y nodejs npm
```

#### 2. Configure PHP

```bash
nano /etc/php/8.1/fpm/php.ini
```

Update these settings:
```ini
upload_max_filesize = 20M
post_max_size = 20M
memory_limit = 256M
max_execution_time = 300
```

Restart PHP-FPM:
```bash
systemctl restart php8.1-fpm
```

#### 3. Configure MySQL

```bash
mysql -u root -p

CREATE DATABASE inventory_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'inventory_user'@'localhost' IDENTIFIED BY 'Strong_Password_123';
GRANT ALL PRIVILEGES ON inventory_db.* TO 'inventory_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

#### 4. Clone Project

```bash
cd /var/www
git clone https://github.com/your-username/inventory-system.git inventory
cd inventory
```

#### 5. Install Dependencies

```bash
composer install --no-dev --optimize-autoloader
npm install
npm run build
```

#### 6. Configure Environment

```bash
cp .env.example .env
nano .env
```

Update `.env`:
```env
APP_NAME="Inventory System"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com

DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=inventory_db
DB_USERNAME=inventory_user
DB_PASSWORD=Strong_Password_123

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=587
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_token
```

#### 7. Setup Laravel

```bash
php artisan key:generate
php artisan migrate --force
php artisan db:seed --class=AdminUserSeeder --force
php artisan db:seed --class=ProductCategorySeeder --force
php artisan storage:link
```

#### 8. Set Permissions

```bash
chown -R www-data:www-data /var/www/inventory
chmod -R 755 /var/www/inventory
chmod -R 775 /var/www/inventory/storage
chmod -R 775 /var/www/inventory/bootstrap/cache
```

#### 9. Configure Nginx

Create `/etc/nginx/sites-available/inventory`:

```nginx
server {
    listen 80;
    listen [::]:80;
    
    server_name your-domain.com www.your-domain.com;
    
    root /var/www/inventory/public;
    index index.php index.html index.htm;

    gzip on;
    gzip_types text/plain text/css text/xml text/javascript application/x-javascript application/xml+rss;

    location ~ \.php$ {
        try_files $uri =404;
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_index index.php;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    client_max_body_size 20M;
}
```

Enable the site:
```bash
ln -s /etc/nginx/sites-available/inventory /etc/nginx/sites-enabled/
nginx -t
systemctl restart nginx
```

#### 10. SSL Certificate (Let's Encrypt)

```bash
apt install -y certbot python3-certbot-nginx
certbot --nginx -d your-domain.com -d www.your-domain.com
```

#### 11. Setup Firewall

```bash
ufw allow 22/tcp
ufw allow 80/tcp
ufw allow 443/tcp
ufw enable
```

#### 12. Create Scheduled Tasks (for reports)

```bash
crontab -e
```

Add:
```
* * * * * /usr/bin/php /var/www/inventory/artisan schedule:run >> /dev/null 2>&1
```

---

## Docker Deployment

### Perfect For: Consistent environments, containerized deployment

### Create Docker Files

#### Dockerfile

```dockerfile
FROM php:8.1-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    mysql-client \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd xml

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /app

# Copy project files
COPY . .

# Install dependencies
RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run build

# Set permissions
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache

EXPOSE 9000

CMD ["php-fpm"]
```

#### docker-compose.yml

```yaml
version: '3.8'

services:
  app:
    build: .
    container_name: inventory_app
    working_dir: /app
    volumes:
      - ./:/app
      - ./storage:/app/storage
      - ./bootstrap/cache:/app/bootstrap/cache
    environment:
      - APP_ENV=production
      - APP_DEBUG=false
      - DB_HOST=db
      - DB_DATABASE=inventory_db
      - DB_USERNAME=inventory_user
      - DB_PASSWORD=Strong_Password_123
    depends_on:
      - db
    networks:
      - inventory-network

  db:
    image: mysql:8.0
    container_name: inventory_db
    environment:
      MYSQL_ROOT_PASSWORD: root_password
      MYSQL_DATABASE: inventory_db
      MYSQL_USER: inventory_user
      MYSQL_PASSWORD: Strong_Password_123
    volumes:
      - db_data:/var/lib/mysql
    networks:
      - inventory-network

  nginx:
    image: nginx:alpine
    container_name: inventory_nginx
    ports:
      - "80:80"
      - "443:443"
    volumes:
      - ./:/app
      - ./nginx.conf:/etc/nginx/nginx.conf:ro
    depends_on:
      - app
    networks:
      - inventory-network

volumes:
  db_data:

networks:
  inventory-network:
    driver: bridge
```

#### nginx.conf

```conf
events {
    worker_connections 1024;
}

http {
    server {
        listen 80;
        server_name _;
        root /app/public;
        index index.php;

        location / {
            try_files $uri $uri/ /index.php?$query_string;
        }

        location ~ \.php$ {
            fastcgi_pass app:9000;
            fastcgi_index index.php;
            fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
            include fastcgi_params;
        }
    }
}
```

### Deploy with Docker

```bash
# Build images
docker-compose build

# Start containers
docker-compose up -d

# Run migrations
docker-compose exec app php artisan migrate --force

# Seed data
docker-compose exec app php artisan db:seed --class=AdminUserSeeder --force

# Check logs
docker-compose logs -f app
```

---

## PaaS Deployment

### Perfect For: Quick deployment without server management (Railway, Heroku, Render)

### Railway Deployment (Recommended)

#### 1. Create Railway Account
- Visit: https://railway.app
- Sign up with GitHub

#### 2. Prepare Repository

```bash
git init
git add .
git commit -m "Initial commit"
git push -u origin main
```

#### 3. Create Procfile

```
web: vendor/bin/heroku-php-apache2 public/
```

#### 4. Create .env.production

```bash
cp .env.example .env.production
# Update with production values
```

#### 5. Deploy on Railway

1. Go to Railway dashboard
2. Click "New Project"
3. Select "Deploy from GitHub"
4. Choose your repository
5. Add environment variables
6. Deploy button will appear

#### 6. Database Setup

1. Add MySQL service from Railway dashboard
2. Copy connection string
3. Run migrations: `railway run php artisan migrate --force`

---

## Environment Configuration

### Production .env Variables

```env
# Application
APP_NAME=Inventory System
APP_ENV=production
APP_KEY=base64:your_generated_key_here
APP_DEBUG=false
APP_URL=https://your-domain.com

# Database
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=inventory_db
DB_USERNAME=inventory_user
DB_PASSWORD=strong_password_here

# Mail
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=587
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_FROM_ADDRESS=noreply@your-domain.com
MAIL_FROM_NAME="Inventory System"

# Cache
CACHE_DRIVER=file
SESSION_DRIVER=file

# Queue
QUEUE_CONNECTION=sync

# Logging
LOG_CHANNEL=single
LOG_LEVEL=notice
```

### Security Best Practices

1. **Never commit `.env` to repository**
   ```bash
   echo ".env" >> .gitignore
   ```

2. **Use environment variables for secrets**
   ```bash
   # VPS: Set in Nginx/Apache headers
   # PaaS: Use dashboard environment variables
   # Docker: Use docker-compose env or secrets
   ```

3. **Rotate credentials regularly**
   - Database passwords
   - API keys
   - Email passwords

---

## Database Migration

### Migrate Development Database to Production

#### 1. Create Migration Dump

```bash
# Local development
mysqldump -u root inventory_db > production_dump.sql

# Remove admin users (recreate on production)
mysqldump -u root inventory_db --ignore-table=inventory_db.users > data_only.sql
```

#### 2. Import to Production

```bash
# SSH to production server
ssh user@your-domain.com

# Import data
mysql -u inventory_user -p inventory_db < data_only.sql

# Or use Laravel migrations (preferred)
php artisan migrate --force
php artisan db:seed --class=ProductCategorySeeder --force
```

#### 3. Verify Migration

```bash
# Connect to production database
mysql -u inventory_user -p inventory_db

# Check tables
SHOW TABLES;

# Check data
SELECT * FROM categories;
SELECT * FROM products;

EXIT;
```

---

## Post-Deployment Steps

### 1. Final Verification

```bash
# Cache configuration
php artisan config:cache

# Cache routes
php artisan route:cache

# Cache views
php artisan view:cache

# Test application
curl https://your-domain.com/login
```

### 2. Monitoring & Logging

```bash
# Check Laravel logs
tail -f storage/logs/laravel.log

# Check Nginx logs
tail -f /var/log/nginx/error.log
tail -f /var/log/nginx/access.log

# Check PHP-FPM logs
tail -f /var/log/php-fpm.log
```

### 3. SSL Certificate

```bash
# Using Certbot
certbot --nginx -d your-domain.com

# Check renewal
certbot renew --dry-run

# View certificates
certbot certificates
```

### 4. Backup Strategy

```bash
# Daily database backup
0 2 * * * mysqldump -u inventory_user -p$PASS inventory_db | gzip > /backups/db_$(date +\%Y\%m\%d).sql.gz

# Weekly file backup
0 3 * * 0 tar -czf /backups/files_$(date +\%Y\%m\%d).tar.gz /var/www/inventory

# Backup to cloud (AWS S3, Google Cloud, etc.)
aws s3 cp /backups/ s3://your-bucket/ --recursive
```

### 5. Set Admin Credentials

```bash
# SSH to production
ssh user@your-domain.com
cd /var/www/inventory

# Update admin credentials
php artisan tinker

# In tinker:
$user = User::where('email', 'admin@inventory.com')->first();
$user->password = Hash::make('your_new_secure_password');
$user->save();
exit
```

---

## Troubleshooting

### Issue: "500 Internal Server Error"

**Check logs:**
```bash
tail -50 storage/logs/laravel.log
tail -50 /var/log/nginx/error.log
```

**Common causes:**
- `.env` file missing or incorrect
- Missing database
- File permissions wrong
- PHP extensions missing

### Issue: "Connection refused" (Database)

**Solution:**
```bash
# Check MySQL is running
systemctl status mysql

# Check database credentials
mysql -u inventory_user -p inventory_db

# Verify .env DB settings
cat .env | grep DB_
```

### Issue: Images not showing

**Solution:**
```bash
# Create storage link
php artisan storage:link

# Check symlink
ls -la public/storage

# Fix permissions
chmod -R 775 storage
chown -R www-data:www-data storage
```

### Issue: "Class not found" errors

**Solution:**
```bash
# Clear cache
php artisan config:clear
php artisan cache:clear

# Regenerate composer autoloader
composer dump-autoload -o
```

### Issue: 403 Forbidden (Staff/Admin access)

**Check middleware:**
```bash
# Verify user role
php artisan tinker
$user = User::find(1);
echo $user->role;
exit
```

### Issue: CORS errors

**Update `.env`:**
```env
SESSION_DOMAIN=.your-domain.com
```

---

## Quick Deployment Checklist

- [ ] All tests passing locally
- [ ] `.env` file created with production values
- [ ] `APP_DEBUG=false` and `APP_ENV=production`
- [ ] Database created and migrated
- [ ] Storage symlink created
- [ ] Permissions set correctly (755/775)
- [ ] SSL certificate installed
- [ ] Admin credentials changed
- [ ] Backups configured
- [ ] Logging verified
- [ ] Email sending tested
- [ ] Domain DNS updated
- [ ] Application accessible
- [ ] Login working
- [ ] Dashboard loading data

---

## Support & Resources

### Laravel Documentation
- **Deployment**: https://laravel.com/docs/11.x/deployment
- **Configuration**: https://laravel.com/docs/11.x/configuration
- **Database**: https://laravel.com/docs/11.x/database

### Hosting Providers
- **Shared Hosting**: Bluehost, SiteGround, DreamHost
- **VPS**: DigitalOcean, Linode, AWS Lightsail, Vultr
- **PaaS**: Railway, Render, Heroku
- **Containers**: Docker Hub, AWS ECR

### Monitoring Tools
- **Error Tracking**: Sentry, Rollbar
- **Performance**: New Relic, Datadog
- **Uptime**: Pingdom, StatusPage

---

**Status**: Ready for deployment

**Last Updated**: April 1, 2026

**Questions?** Refer to Laravel documentation or your hosting provider's support.
