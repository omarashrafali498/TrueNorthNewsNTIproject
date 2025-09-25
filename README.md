# 📰 TrueNorthNews

A modern, feature-rich news platform built with Laravel 12 and Bootstrap 5. TrueNorthNews provides a comprehensive content management system with user authentication, role-based permissions, and a beautiful administrative dashboard.

![Laravel](https://img.shields.io/badge/Laravel-12.0-red?style=flat-square&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.2+-blue?style=flat-square&logo=php)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-purple?style=flat-square&logo=bootstrap)
![SQLite](https://img.shields.io/badge/Database-SQLite-green?style=flat-square&logo=sqlite)

## ✨ Features

### 🎯 **Core Functionality**

-   **Article Management** - Create, edit, delete, and view articles
-   **User Authentication** - Secure login/registration system
-   **User Profiles** - Customizable user profiles with photo uploads
-   **Comment System** - Interactive commenting with like functionality
-   **Category Management** - Organize articles by categories
-   **Tag System** - Tag articles for better organization

### 🛡️ **Admin Dashboard**

-   **User Management** - CRUD operations for users
-   **Article Management** - Manage all articles from admin panel
-   **Role-Based Access** - Admin and user role permissions
-   **Beautiful UI** - Professional Bootstrap-based interface
-   **Confirmation Modals** - Safe delete operations with warnings

### 🎨 **User Experience**

-   **Responsive Design** - Mobile-friendly interface
-   **Profile Management** - Edit profiles and upload photos
-   **View Tracking** - Article view counter
-   **Interactive Elements** - Hover effects and smooth transitions
-   **Professional Modals** - Beautiful confirmation dialogs

## 🚀 Quick Start

### Prerequisites

-   PHP 8.2 or higher
-   Composer
-   Node.js & NPM (optional, for asset compilation)

### Installation

1. **Clone the repository**

    ```bash
    git clone https://github.com/omarashrafali498/truenorthnews.git
    cd truenorthnews
    ```

2. **Install dependencies**

    ```bash
    composer install
    ```

3. **Environment setup**

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. **Database setup**

    ```bash
    php artisan migrate
    php artisan db:seed
    ```

5. **Storage link**

    ```bash
    php artisan storage:link
    ```

6. **Start the server**
    ```bash
    php artisan serve
    ```

Visit `http://localhost:8000` to see your application!

## 📁 Project Structure

```
app/
├── Http/Controllers/
│   ├── AuthController.php      # Authentication logic
│   ├── PostController.php      # Article management
│   ├── ProfileController.php   # User profiles
│   ├── CommentController.php   # Comment system
│   └── DashboardController.php # Admin dashboard
├── Models/
│   ├── User.php               # User model
│   ├── Post.php               # Article model
│   ├── Comment.php            # Comment model
│   ├── Category.php           # Category model
│   └── Tag.php                # Tag model
resources/
├── views/
│   ├── dashboard/             # Admin panel views
│   ├── posts/                 # Article views
│   ├── profile/               # Profile views
│   └── auth/                  # Authentication views
public/
├── assets/
│   ├── css/                   # Stylesheets
│   ├── js/                    # JavaScript files
│   └── uploads/               # User uploads
```

## 🎯 Key Features Breakdown

### Authentication System

-   Secure user registration and login
-   Password hashing with bcrypt
-   Session management
-   Role-based access control (Admin/User)

### Article Management

-   Rich text editing capabilities
-   Image upload support
-   Category and tag assignment
-   View tracking system
-   SEO-friendly URLs

### Admin Dashboard

-   **User Management**: Create, edit, delete users with confirmation modals
-   **Article Management**: Manage all articles with bulk operations
-   **Analytics**: View statistics and user engagement
-   **Professional UI**: Bootstrap-based responsive design

### User Profiles

-   Customizable profile information
-   Photo upload functionality
-   Personal article management
-   Profile editing capabilities

## 🛠️ Technologies Used

### Backend

-   **Laravel 12** - PHP framework
-   **PHP 8.2+** - Server-side language
-   **SQLite** - Database (easily switchable)
-   **Eloquent ORM** - Database interactions

### Frontend

-   **Bootstrap 5.3** - CSS framework
-   **JavaScript (Vanilla)** - Client-side functionality
-   **FontAwesome** - Icons
-   **Custom CSS** - Enhanced styling

### Development Tools

-   **Composer** - PHP dependency management
-   **Artisan** - Laravel command-line tool
-   **Migration System** - Database version control
-   **Factory & Seeders** - Test data generation

## 🔒 Security Features

-   **CSRF Protection** - All forms protected
-   **SQL Injection Prevention** - Eloquent ORM protection
-   **XSS Protection** - Input sanitization
-   **Authentication Middleware** - Route protection
-   **Role-based Authorization** - Admin-only features
-   **Secure File Uploads** - Validated image uploads

## 📱 Responsive Design

The application is fully responsive and works perfectly on:

-   **Desktop** (1920px+)
-   **Laptop** (1024px - 1919px)
-   **Tablet** (768px - 1023px)
-   **Mobile** (320px - 767px)

## 🎨 UI/UX Features

-   **Professional Modals** - Beautiful confirmation dialogs
-   **Hover Effects** - Interactive button animations
-   **Loading States** - User feedback during operations
-   **Toast Notifications** - Success/error messages
-   **Consistent Design** - Unified color scheme and typography

## 🚀 Deployment

### Production Setup

1. Set `APP_ENV=production` in `.env`
2. Set `APP_DEBUG=false`
3. Configure your production database
4. Run `php artisan optimize`
5. Set up proper file permissions
6. Configure web server (Apache/Nginx)

### Recommended Hosting

-   **Shared Hosting** - cPanel with PHP 8.2+
-   **VPS** - Ubuntu/CentOS with LAMP/LEMP
-   **Cloud** - AWS, DigitalOcean, Linode
-   **Platform** - Laravel Forge, Vapor

## 🤝 Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📋 Requirements

-   PHP >= 8.2
-   OpenSSL PHP Extension
-   PDO PHP Extension
-   Mbstring PHP Extension
-   Tokenizer PHP Extension
-   XML PHP Extension
-   Ctype PHP Extension
-   JSON PHP Extension
-   BCMath PHP Extension

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 👨‍💻 Author

**Omar Ashraf Ali**

-   GitHub: [@omarashrafali498](https://github.com/omarashrafali498)
-   Email: omarashrafali498@gmail.com

## 🙏 Acknowledgments

-   Laravel community for the amazing framework
-   Bootstrap team for the UI components
-   FontAwesome for the beautiful icons
-   All contributors who helped improve this project

---

⭐ **Star this repository if you found it helpful!**

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
