# Inventory Management System

<p align="center">
A modern inventory management system built with Laravel, Tailwind CSS, and Alpine.js
</p>

## About This Project

**Inventory Management System** is a comprehensive web-based solution for managing product inventory, categories, suppliers, and stock transactions. Designed for businesses that need real-time inventory tracking, stock alerts, and transaction history.

### Key Features

- ✅ **Product Management** — Create, update, and organize products by category
- ✅ **Inventory Tracking** — Real-time stock level monitoring
- ✅ **Low Stock Alerts** — Automatic notifications when items fall below reorder levels
- ✅ **Transaction History** — Complete audit trail of all inventory movements
- ✅ **Supplier Management** — Manage supplier information and relationships
- ✅ **Role-Based Access** — Admin and Staff user roles with appropriate permissions
- ✅ **Responsive Dashboard** — Works on desktop, tablet, and mobile devices
- ✅ **Data Export** — Generate reports and transaction records

### Technology Stack

- **Backend**: Laravel 11 (PHP 8.1+)
- **Frontend**: Blade templates with Alpine.js
- **Styling**: Tailwind CSS
- **Database**: MySQL 8.0+
- **Build Tool**: Vite

---

## Quick Start

### Prerequisites
- PHP 8.1 or higher
- Composer
- Node.js & npm
- MySQL database
- Git

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/YOUR_USERNAME/inventory-system.git
   cd inventory-system
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node dependencies**
   ```bash
   npm install
   ```

4. **Set up environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure database** — Edit `.env` file:
   ```
   DB_HOST=localhost
   DB_PORT=3306
   DB_DATABASE=inventory_system
   DB_USERNAME=root
   DB_PASSWORD=
   ```

6. **Run migrations**
   ```bash
   php artisan migrate
   ```

7. **Seed sample data (optional)**
   ```bash
   php artisan db:seed
   ```

8. **Build assets**
   ```bash
   npm run dev
   ```

9. **Start development server**
   ```bash
   php artisan serve
   ```

10. **Access the application**
    - URL: `http://localhost:8000`
    - Admin Email: `admin@inventory.com` | Password: `Admin@1234`
    - Staff Email: `staff@inventory.com` | Password: `Staff@1234`

---

## Documentation

- [Admin User Guide](./ADMIN_GUIDE.md) — Complete guide for administrators
- [Staff User Guide](./STAFF_GUIDE.md) — User guide for staff members
- [Deployment Guide](./DEPLOYMENT_GUIDE.md) — Production deployment instructions
- [System Documentation](./SYSTEM_DOCUMENTATION.md) — Technical architecture and database schema

---

## Directory Structure

```
inventory-system/
├── app/                    # Application code
│   ├── Http/              # Controllers, middleware, requests
│   ├── Models/            # Eloquent models
│   └── Mail/              # Mailable classes
├── database/              # Migrations, seeders, factories
├── resources/             # Views and assets
│   ├── views/            # Blade templates
│   ├── js/               # Alpine.js scripts
│   └── css/              # Tailwind styles
├── routes/               # Web and API routes
├── storage/              # Uploaded files and logs
├── tests/                # Unit and feature tests
└── config/               # Application configuration
```

---

## Available Commands

```bash
# Development
php artisan serve              # Start development server
npm run dev                    # Build assets (watch mode)

# Build & Optimize
npm run build                 # Build for production
php artisan optimize         # Optimize application

# Database
php artisan migrate          # Run migrations
php artisan migrate:rollback # Rollback migrations
php artisan db:seed         # Seed database
php artisan tinker          # Interactive shell

# Testing
php artisan test            # Run test suite

# Maintenance
php artisan cache:clear     # Clear application cache
php artisan log:clear       # Clear log files
```

---

## User Roles

### Administrator
- Full system access
- Manage all products, categories, suppliers
- Create and modify inventory records
- View all transactions and reports
- Manage user accounts

### Staff
- View-only access
- Browse products and inventory
- View transaction history
- Cannot create, edit, or delete records

---

## Browser Support

- Chrome/Edge (latest 2 versions)
- Firefox (latest 2 versions)
- Safari (latest 2 versions)
- Minimum resolution: 320px (mobile-friendly)

---

## Security Considerations

- All user inputs are validated and sanitized
- SQL injection prevention through parameterized queries
- CSRF protection on all forms
- Password hashing with bcrypt
- Row-level access control by user role
- Audit trail for all transactions

---

## Container Support

Docker deployment available. See [DEPLOYMENT_GUIDE.md](./DEPLOYMENT_GUIDE.md#docker-deployment) for details.

---

## Support & Issues

For bugs, feature requests, or questions:
1. Check existing [Issues](https://github.com/YOUR_USERNAME/inventory-system/issues)
2. Create a new issue with detailed description
3. Include screenshots or error logs when relevant

---

## License

This project is open source and available under the [MIT License](LICENSE).

---

## Contributing

Contributions are welcome! Please follow these steps:
1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit changes (`git commit -m 'Add amazing feature'`)
4. Push to branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

**Note**: Replace `YOUR_USERNAME` with your actual GitHub username throughout this file.

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
