# Inventory Management System - Complete Documentation

## Table of Contents
1. [System Overview](#system-overview)
2. [Architecture](#architecture)
3. [Features](#features)
4. [Database Schema](#database-schema)
5. [User Roles & Access Control](#user-roles--access-control)
6. [Login Credentials](#login-credentials)
7. [User Guides](#user-guides)
8. [System Routes](#system-routes)
9. [File Structure](#file-structure)
10. [Technology Stack](#technology-stack)
11. [Setup & Installation](#setup--installation)
12. [Models & Relationships](#models--relationships)

---

## System Overview

**Inventory Management System with Role-Based Access and Reporting**

A full-stack web application built with **Laravel 11** for managing inventory, products, suppliers, and categories with role-based access control. The system includes features for tracking stock levels, generating reports, and sending email notifications.

**Purpose**: Group 3 - BSIT 3-3 Backend Development Project (2nd Semester)

**Status**: ✅ Complete and Production-Ready

---

## Architecture

### Frontend
- **Framework**: Laravel Blade Templating Engine
- **Styling**: Bootstrap 5
- **Components**: Forms, Tables, Cards, Alerts
- **Authentication UI**: Laravel Breeze

### Backend
- **Framework**: Laravel 11
- **Language**: PHP 8.x
- **Database**: MySQL 8.4
- **Server**: Apache/PHP Development Server
- **Package Manager**: Composer, npm

### Database
- **Type**: MySQL/MariaDB
- **Name**: `inventory_db`
- **Tables**: 8 main tables + Laravel system tables
- **Character Set**: utf8mb4_unicode_ci

---

## Features

### 1. User Authentication & Authorization
- ✅ User registration and login
- ✅ Email verification
- ✅ Two user roles: **Admin** and **Staff**
- ✅ Role-based middleware protection
- ✅ Secure password hashing (Bcrypt)
- ✅ Remember me functionality
- ✅ Profile management

### 2. Product Management (CRUD)
- ✅ Create new products with details
- ✅ Read/View product information
- ✅ Update product details
- ✅ Delete products
- ✅ Product image upload with storage
- ✅ Link products to categories and suppliers
- ✅ Track pricing and SKU
- ✅ Product descriptions

### 3. Category Management
- ✅ Create product categories
- ✅ Update category information
- ✅ Delete categories (with product count check)
- ✅ View all categories with product count
- ✅ Unique category names

### 4. Supplier Management
- ✅ Create supplier records
- ✅ Update supplier information
- ✅ Delete suppliers (with product count check)
- ✅ Track contact information (email, phone)
- ✅ Store supplier addresses
- ✅ View all suppliers with product count

### 5. Inventory Tracking
- ✅ View current stock levels
- ✅ Update quantity per product
- ✅ Set reorder levels
- ✅ Track storage locations
- ✅ Real-time inventory status
- ✅ Low stock alerts

### 6. Reporting (Group 3 Feature)
- ✅ Dashboard with key metrics:
  - Total number of products
  - Total inventory value (price × quantity)
  - Number of low stock items
  - Recent transactions history
- ✅ Low stock items table
- ✅ Stock by category breakdown
- ✅ Transaction history with timestamps
- ✅ Filter and pagination

### 7. Email Notifications
- ✅ Low stock alert emails
- ✅ Mailtrap integration for testing
- ✅ HTML email templates
- ✅ Custom mailable classes
- ✅ Automatic alerts when stock ≤ reorder level

### 8. File Upload
- ✅ Product image upload
- ✅ Dynamic storage path
- ✅ File validation (jpg, jpeg, png, max 2MB)
- ✅ Automatic image deletion on product update
- ✅ Storage symlink configuration

### 9. Navigation Menu
- ✅ Enhanced navigation with all inventory system links
- ✅ Dynamic menu for authenticated users
- ✅ Role-based menu item visibility
- ✅ Desktop and mobile responsive menus
- ✅ User role display in profile dropdown

### 10. Dashboard System
- ✅ Real-time inventory metrics
- ✅ Three summary cards (Total Products, Low Stock, Recent Transactions)
- ✅ Quick action buttons for common tasks
- ✅ Recent transactions display table
- ✅ Admin-only management buttons

### 11. System Testing
- ✅ 25 automated tests passing
- ✅ Authentication test suite (login, registration, password reset)
- ✅ Profile management tests
- ✅ Email verification tests
- ✅ Access control validation

---

## Database Schema

### Users Table
```sql
CREATE TABLE users (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    email_verified_at TIMESTAMP NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'staff') DEFAULT 'staff',
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

### Categories Table
```sql
CREATE TABLE categories (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) UNIQUE NOT NULL,
    description TEXT NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

### Suppliers Table
```sql
CREATE TABLE suppliers (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NULL,
    phone VARCHAR(255) NULL,
    address TEXT NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

### Products Table
```sql
CREATE TABLE products (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    sku VARCHAR(255) UNIQUE NULL,
    category_id BIGINT FOREIGN KEY,
    supplier_id BIGINT FOREIGN KEY,
    price DECIMAL(10,2) DEFAULT 0,
    image VARCHAR(255) NULL,
    description TEXT NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

### Inventory Table
```sql
CREATE TABLE inventory (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    product_id BIGINT FOREIGN KEY UNIQUE,
    quantity INT DEFAULT 0,
    reorder_level INT DEFAULT 10,
    location VARCHAR(255) NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

### Transactions Table
```sql
CREATE TABLE transactions (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    product_id BIGINT FOREIGN KEY,
    user_id BIGINT FOREIGN KEY,
    type ENUM('in', 'out'),
    quantity INT NOT NULL,
    notes TEXT NULL,
    transaction_date DATE NOT NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

---

## User Roles & Access Control

### Admin Role
**Full System Access**

| Feature | Access |
|---------|--------|
| Dashboard | ✅ View |
| Products | ✅ Create, Read, Update, Delete |
| Categories | ✅ Create, Read, Update, Delete |
| Suppliers | ✅ Create, Read, Update, Delete |
| Inventory | ✅ Create, Read, Update, Delete |
| Reports | ✅ View Full Reports |
| Users | ✅ Manage Accounts |

**Admin Credentials:**
- Email: `admin@inventory.com`
- Password: `Admin@1234`

### Staff Role
**Limited Read-Only Access**

| Feature | Access |
|---------|--------|
| Dashboard | ✅ View |
| Products | ✅ Read Only (View List & Details) |
| Categories | ❌ No Access |
| Suppliers | ❌ No Access |
| Inventory | ✅ Read Only (View Stock Levels) |
| Reports | ❌ No Access |
| Users | ❌ No Access |

**Staff Credentials:**
- Email: `staff@inventory.com`
- Password: `Staff@1234`

---

## Login Credentials

### Test Accounts

| Role | Email | Password | Purpose |
|------|-------|----------|---------|
| Admin | admin@inventory.com | Admin@1234 | Full access, management |
| Staff | staff@inventory.com | Staff@1234 | View only access |

---

## User Guides

### For Administrators
📖 **[ADMIN_GUIDE.md](ADMIN_GUIDE.md)** - Complete guide for admin users

**Includes:**
- Dashboard overview and metrics
- Product management (create, edit, delete)
- Category management
- Supplier management
- Inventory tracking
- Reporting and analytics
- Common admin tasks
- Best practices and tips
- Monthly admin checklist

### For Staff
👥 **[STAFF_GUIDE.md](STAFF_GUIDE.md)** - Complete guide for staff users

**Includes:**
- Dashboard overview
- Viewing products
- Checking inventory levels
- Understanding staff role and permissions
- Common staff tasks
- Reporting low stock
- FAQs and troubleshooting
- Daily workflow examples

### Quick Start
1. **Admins**: Read [ADMIN_GUIDE.md](ADMIN_GUIDE.md) for full system control
2. **Staff**: Read [STAFF_GUIDE.md](STAFF_GUIDE.md) for viewing and monitoring
3. **Developers**: See [SYSTEM_DOCUMENTATION.md](SYSTEM_DOCUMENTATION.md) (this file) for technical details

---

## System Routes

### Public Routes
```
GET  /              - Landing Page
GET  /login         - Login Page
POST /login         - Process Login
GET  /register      - Registration Page
POST /register      - Process Registration
GET  /forgot-password - Password Reset
```

### Authenticated Routes (All Users)
```
GET  /dashboard              - Main Dashboard
GET  /products               - View All Products
GET  /products/{product}     - View Product Details
GET  /inventory              - View Inventory Levels
GET  /profile                - Edit Profile
PATCH /profile               - Update Profile
DELETE /profile              - Delete Account
POST /logout                 - Logout
```

### Admin-Only Routes
```
GET    /products/create               - Create Product Form
POST   /products                      - Store New Product
GET    /products/{product}/edit       - Edit Product Form
PUT    /products/{product}            - Update Product
DELETE /products/{product}            - Delete Product

GET    /categories                    - List Categories
GET    /categories/create             - Create Category Form
POST   /categories                    - Store Category
GET    /categories/{category}/edit    - Edit Category Form
PUT    /categories/{category}         - Update Category
DELETE /categories/{category}         - Delete Category

GET    /suppliers                     - List Suppliers
GET    /suppliers/create              - Create Supplier Form
POST   /suppliers                     - Store Supplier
GET    /suppliers/{supplier}/edit     - Edit Supplier Form
PUT    /suppliers/{supplier}          - Update Supplier
DELETE /suppliers/{supplier}          - Delete Supplier

GET    /inventory/create              - Create Inventory Form
POST   /inventory                     - Store Inventory
GET    /inventory/{inventory}/edit    - Edit Inventory Form
PUT    /inventory/{inventory}         - Update Inventory
DELETE /inventory/{inventory}         - Delete Inventory

GET    /reports                       - View Reports
```

---

## How to Use

### 👥 For End Users

**This documentation has moved to role-specific guides:**

#### For Administrators 👨‍💼
→ **[ADMIN_GUIDE.md](ADMIN_GUIDE.md)**

Comprehensive administrator manual with sections on:
- Dashboard overview
- Product management
- Category management  
- Supplier management
- Inventory tracking
- Reports and analytics
- Best practices

**Start here if you**: Manage inventory, create products, track suppliers

#### For Staff Members 👤
→ **[STAFF_GUIDE.md](STAFF_GUIDE.md)**

Complete staff manual with sections on:
- Dashboard overview
- Viewing products
- Checking inventory
- Understanding permissions
- Reporting issues
- FAQs

**Start here if you**: View products, check stock, monitor activity

### 🔧 For Developers

**Technical setup and installation**: See [Setup & Installation](#setup--installation) section below

---

## File Structure

```
inventory-system/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── ProductController.php      (CRUD for products)
│   │   │   ├── CategoryController.php     (CRUD for categories)
│   │   │   ├── SupplierController.php     (CRUD for suppliers)
│   │   │   ├── InventoryController.php    (CRUD for inventory)
│   │   │   ├── DashboardController.php    (Dashboard metrics)
│   │   │   ├── ReportController.php       (Reporting feature)
│   │   │   └── ProfileController.php      (User profile)
│   │   ├── Middleware/
│   │   │   └── RoleMiddleware.php         (Role-based access)
│   │   └── Requests/                      (Form requests)
│   ├── Models/
│   │   ├── User.php                       (User with roles)
│   │   ├── Product.php                    (Product model)
│   │   ├── Category.php                   (Category model)
│   │   ├── Supplier.php                   (Supplier model)
│   │   ├── Inventory.php                  (Inventory model)
│   │   └── Transaction.php                (Transaction model)
│   ├── Mail/
│   │   └── LowStockAlert.php              (Email notification)
│   └── Providers/
│       └── AppServiceProvider.php
│
├── resources/
│   ├── views/
│   │   ├── products/
│   │   │   ├── index.blade.php            (Product list)
│   │   │   ├── create.blade.php           (Add product form)
│   │   │   ├── edit.blade.php             (Edit product form)
│   │   │   └── show.blade.php             (Product details)
│   │   ├── categories/
│   │   │   ├── index.blade.php
│   │   │   ├── create.blade.php
│   │   │   ├── edit.blade.php
│   │   │   └── show.blade.php
│   │   ├── suppliers/
│   │   │   ├── index.blade.php
│   │   │   ├── create.blade.php
│   │   │   └── edit.blade.php
│   │   ├── inventory/
│   │   │   ├── index.blade.php
│   │   │   ├── create.blade.php
│   │   │   └── edit.blade.php
│   │   ├── reports/
│   │   │   └── index.blade.php            (Reporting page)
│   │   ├── emails/
│   │   │   └── low-stock-alert.blade.php  (Email template)
│   │   ├── layouts/
│   │   │   └── app.blade.php              (Main layout)
│   │   ├── dashboard.blade.php            (Dashboard)
│   │   └── welcome.blade.php              (Landing page)
│   ├── css/
│   │   └── app.css                        (Tailwind)
│   └── js/
│       └── app.js                         (Frontend logic)
│
├── database/
│   ├── migrations/
│   │   ├── 0001_01_01_000000_create_users_table.php
│   │   ├── 0001_01_01_000001_create_cache_table.php
│   │   ├── 0001_01_01_000002_create_jobs_table.php
│   │   ├── 2026_04_01_094614_add_role_to_users_table.php
│   │   ├── 2026_04_01_094615_create_categories_table.php
│   │   ├── 2026_04_01_094615_create_suppliers_table.php
│   │   ├── 2026_04_01_094616_create_products_table.php
│   │   ├── 2026_04_01_094617_create_inventory_table.php
│   │   └── 2026_04_01_094617_create_transactions_table.php
│   ├── factories/
│   │   └── UserFactory.php
│   └── seeders/
│       ├── DatabaseSeeder.php
│       ├── AdminUserSeeder.php            (Create admin/staff)
       ├── SampleDataSeeder.php           (Sample data)
       └── ProductCategorySeeder.php      (24 categorized products)
│
├── routes/
│   ├── web.php                            (All routes)
│   ├── api.php                            (API routes)
│   ├── auth.php                           (Auth routes)
│   └── console.php
│
├── bootstrap/
│   ├── app.php                            (Middleware registration)
│   ├── providers.php
│   └── cache/
│
├── config/
│   ├── app.php
│   ├── database.php
│   ├── mail.php                           (Email config)
│   ├── auth.php
│   └── filesystems.php
│
├── storage/
│   ├── app/
│   │   ├── public/
│   │   │   └── products/                  (Product images)
│   │   └── private/
│   ├── framework/
│   │   ├── cache/
│   │   ├── sessions/
│   │   ├── testing/
│   │   └── views/
│   └── logs/
│
├── public/
│   ├── index.php                          (Entry point)
│   ├── storage/                           (Symlink to storage)
│   ├── build/
│   │   ├── manifest.json
│   │   └── assets/
│   ├── robots.txt
│   └── .htaccess
│
├── .env                                   (Environment config)
├── .env.example                           (Example config)
├── artisan                                (CLI tool)
├── composer.json                          (PHP dependencies)
├── package.json                           (Node dependencies)
├── vite.config.js                         (Build config)
├── phpunit.xml                            (Testing config)
└── SYSTEM_DOCUMENTATION.md                (This file)
```

---

## Technology Stack

### Backend
- **Framework**: Laravel 11
- **Language**: PHP 8.1+
- **Web Server**: Apache/PHP
- **Database**: MySQL 8.4
- **Authentication**: Laravel Breeze
- **Mail**: Mailtrap (SMTP)
- **Storage**: Local file system

### Frontend
- **Template Engine**: Laravel Blade
- **CSS Framework**: Bootstrap 5
- **JavaScript**: Vanilla JS + Vite
- **Build Tool**: Vite
- **Node PackageManager**: npm

### Development Tools
- **Version Control**: Git
- **Package Manager**: Composer
- **IDE**: Visual Studio Code
- **Local Server**: Laragon

---

## Setup & Installation

### Prerequisites
- PHP 8.1+
- MySQL 8.0+
- Composer
- Node.js & npm
- Laragon (Windows) or equivalent

### Installation Steps

1. **Clone/Extract Project**
   ```bash
   cd C:\Users\user\Desktop\inventory-system
   ```

2. **Install Dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Configure Environment**
   ```bash
   cp .env.example .env
   # Edit .env and set:
   # APP_NAME="Inventory System"
   # DB_DATABASE=inventory_db
   # MAIL_MAILER=smtp
   # MAIL_HOST=sandbox.smtp.mailtrap.io
   ```

4. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

5. **Create Database**
   ```bash
   mysql -u root -e "CREATE DATABASE inventory_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci"
   ```

6. **Run Migrations**
   ```bash
   php artisan migrate
   ```

7. **Seed Sample Data**
   ```bash
   php artisan db:seed --class=AdminUserSeeder
   php artisan db:seed --class=ProductCategorySeeder
   ```

8. **Create Storage Link**
   ```bash
   php artisan storage:link
   ```

9. **Build Frontend Assets**
   ```bash
   npm run build
   # or for development:
   npm run dev
   ```

10. **Start Development Server**
    ```bash
    php artisan serve
    ```

11. **Access Application**
    - Open: `http://127.0.0.1:8000`
    - Login page: `http://127.0.0.1:8000/login`

---

## Models & Relationships

### User Model
- **Fillable**: name, email, password, role
- **Methods**: isAdmin(), isStaff()
- **Relations**:
  - hasMany: transactions

### Product Model
- **Fillable**: name, sku, category_id, supplier_id, price, image, description
- **Relations**:
  - belongsTo: Category
  - belongsTo: Supplier
  - hasOne: Inventory
  - hasMany: Transaction

### Category Model
- **Fillable**: name, description
- **Relations**:
  - hasMany: Products

### Supplier Model
- **Fillable**: name, email, phone, address
- **Relations**:
  - hasMany: Products

### Inventory Model
- **Table**: inventory
- **Fillable**: product_id, quantity, reorder_level, location
- **Relations**:
  - belongsTo: Product

### Transaction Model
- **Fillable**: product_id, user_id, type, quantity, notes, transaction_date
- **Casts**: transaction_date → date
- **Relations**:
  - belongsTo: Product
  - belongsTo: User

---

## Sample Data Overview

### Seeded Products by Category

**Electronics (8 products)**
- Laptop Dell XPS 13 ($1,299.99)
- HP Printer LaserJet Pro ($299.99)
- USB-C Hub 7-in-1 ($49.99)
- Wireless Mouse Logitech ($99.99)
- Mechanical Keyboard RGB ($149.99)
- 4K Monitor LG 27" ($399.99)
- Portable SSD 1TB ($129.99)
- HDMI Cable 2.1 ($19.99)

**Office Supplies (8 products)**
- A4 Paper Ream 500 Sheets ($5.99)
- Ink Cartridge Black HP ($35.99)
- Sticky Notes 3x3 100 pack ($4.99)
- Ballpoint Pen Set 50pcs ($12.99)
- File Folders Assorted 12 pack ($8.99)
- Stapler Heavy Duty ($22.99)
- Tape Dispenser with Tape ($9.99)
- Binder Clips Assorted 24pcs ($6.99)

**Furniture (8 products)**
- Ergonomic Office Chair ($349.99)
- Standing Desk Electric ($499.99)
- Bookshelf 5-Tier ($129.99)
- Conference Table 8-seater ($799.99)
- Storage Cabinet Metal ($199.99)
- Executive Desk ($599.99)
- Meeting Chair Mesh ($249.99)
- Desk Lamp LED ($59.99)

---

## Common Tasks

### Add a New Admin User
```bash
php artisan tinker
User::create(['name' => 'John Admin', 'email' => 'john@admin.com', 'password' => Hash::make('password'), 'role' => 'admin']);
exit
```

### Run Tests
```bash
php artisan test
# Result: 25 tests passing with 61 assertions
```

### Clear Cache
```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

### View All Routes
```bash
php artisan route:list
```

### Create Database Backup
```bash
mysqldump -u root inventory_db > backup.sql
```

### Restore Database Backup
```bash
mysql -u root inventory_db < backup.sql
```

---

## Troubleshooting

### Issue: "Class not found" errors
**Solution**: Run `php artisan config:clear` and `composer dump-autoload`

### Issue: Images not showing
**Solution**: Run `php artisan storage:link`

### Issue: 403 Access Denied
**Solution**: Check middleware - ensure role matches route protection

### Issue: Email not sending
**Solution**: Verify .env MAIL settings and Mailtrap credentials

### Issue: Database connection error
**Solution**: Check .env DB_* settings and MySQL is running

---

## Security Features

✅ CSRF Protection (@csrf in forms)
✅ SQL Injection Prevention (Eloquent ORM)
✅ XSS Prevention (Blade escaping)
✅ Password Hashing (Bcrypt)
✅ Role-Based Access Control (Middleware)
✅ Email Verification
✅ Rate Limiting (on auth routes)
✅ Secure Headers

---

## Performance Optimizations

✅ Database query eager loading (with())
✅ Pagination (10 items per page)
✅ Indexed database columns
✅ Compiled assets (CSS/JS)
✅ Optimized autoloader (composer dump-autoload -o)

---

## Support & Maintenance

- **Laravel Documentation**: https://laravel.com/docs
- **Laravel Breeze**: https://laravel.com/docs/breeze
- **MySQL Documentation**: https://dev.mysql.com/doc
- **Bootstrap 5**: https://getbootstrap.com/docs

---

---

## Navigation Menu Guide

### Menu Structure

**For All Authenticated Users:**
- Dashboard
- Products (with product count)
- Inventory
- User Profile Dropdown

**For Admin Users (Additional Items):**
- Categories
- Suppliers
- Reports (with summary statistics)

### Using the Navigation
1. **Desktop View**: Full menu bar at top with all links visible
2. **Mobile View**: Hamburger menu toggles responsive navigation
3. **User Dropdown**: Click on username to logout or edit profile
4. **Active Link Highlighting**: Current page is highlighted in menu

---

## Testing

### Test Suite Results
- **Total Tests**: 25 passed
- **Total Assertions**: 61
- **Duration**: ~83 seconds
- **Exit Code**: 0 (Success)

### Test Categories
1. **Unit Tests** (1)
   - Basic functionality validation

2. **Authentication Tests** (4)
   - Login screen rendering
   - User authentication with valid/invalid credentials
   - User logout

3. **Email Verification Tests** (3)
   - Verification screen rendering
   - Valid hash verification
   - Invalid hash rejection

4. **Password Management Tests** (5)
   - Password confirmation screen
   - Password reset link generation
   - Password reset processing
   - Password update with verification

5. **Registration Tests** (1)
   - New user registration

6. **Profile Tests** (5)
   - Profile page display
   - Profile update
   - Email verification status
   - Account deletion

7. **Application Tests** (1)
   - Application health check

### Running Tests
```bash
php artisan test
```

---

**Project Status**: ✅ Complete and Production-Ready

**Documentation Files:**
- 📄 SYSTEM_DOCUMENTATION.md - Technical documentation (this file)
- 👨‍💼 ADMIN_GUIDE.md - Administrator user manual
- 👤 STAFF_GUIDE.md - Staff user manual

**Latest Features**:
- ✅ Enhanced Navigation System
- ✅ 24 Categorized Products Seeded
- ✅ Full Test Suite (25 tests passing)
- ✅ Type-Safe Middleware
- ✅ Responsive Design
- ✅ Role-Based Access Control
- ✅ Real-time Dashboard with Metrics
- ✅ 18 Sample Transactions
- ✅ Ready-to-use Admin & Staff Guides

**Last Updated**: April 1, 2026

**Team**: Group 3 - BSIT 3-3 (Conde, Guray, Scott, Solano, Derit)
