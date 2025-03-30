

# OAuth2 Passport Authentication in Laravel

OAuth2 authentication using Laravel Passport in a PHP project with API token-based authentication. 

📌 Project Overview

This project implements OAuth2 authentication using Laravel Passport for API authentication. It includes user registration, login, and token-based authentication.

---
## 📂 Project Structure

```
C:\Users\Asus\Desktop\git project\php project\oauth2-passport\oauth2-passport
│   .env
│   .gitignore
│   README.md
│   artisan
│   composer.json
│   composer.lock
│   package.json
│   phpunit.xml
│
├───app
│   ├───Http
│   │   ├───Controllers
│   │   │   ├── AuthController.php
│   │   │   ├── HomeController.php
│   │   ├───Middleware
│   │   │   ├── Authenticate.php
│   ├───Models
│   │   ├── User.php
│   ├───Providers
│   │   ├── AuthServiceProvider.php
│
├───config
│
├───database
│   ├───migrations
│   │   ├── 2024_03_30_000000_create_users_table.php
│
├───routes
│   ├── api.php
│   ├── web.php
│
├───storage
│
└───tests
```
---
## 🛠️ Setup Instructions

### 📌 1. Install Laravel & Dependencies

Ensure you have [Composer](https://getcomposer.org/) installed. Then, run the following commands:

```sh
composer install
```

### 📌 2. Configure Environment

Copy `.env.example` to `.env` and update database details:

```sh
cp .env.example .env
```

Then, generate an application key:

```sh
php artisan key:generate
```

### 📌 3. Setup Database

Run migrations to create required tables:

```sh
php artisan migrate
```

### 📌 4. Install Laravel Passport

```sh
composer require laravel/passport
```

Run Passport migrations:

```sh
php artisan migrate
```

Generate encryption keys:

```sh
php artisan passport:install
```

> **⚠️ Note:** `Passport::routes();` is commented out in `AuthServiceProvider.php` because it caused issues. Ensure it's uncommented if required.

Register Passport in `AuthServiceProvider.php`:

```php
use Laravel\Passport\Passport;
public function boot()
{
    $this->registerPolicies();
    // Passport::routes(); // Uncomment if necessary
}
```

### 📌 5. Configure Authentication Guards

Modify `config/auth.php`:

```php
'guards' => [
    'api' => [
        'driver' => 'passport',
        'provider' => 'users',
    ],
],
```

### 📌 6. Run Development Server

Start Laravel's built-in server:

```sh
php artisan serve
```

---
## 🚀 API Endpoints

| Method | Endpoint | Description |
|--------|----------|-------------|
| POST | `/api/register` | User Registration |
| POST | `/api/login` | User Login |
| GET | `/api/user` | Get Authenticated User |

---
## ⚡ Running XAMPP

Ensure Apache and MySQL are running in XAMPP:

1. Open **XAMPP Control Panel**
2. Start **Apache** & **MySQL**
3. Access phpMyAdmin at `http://localhost/phpmyadmin`

---
## 🎯 Run Passport Token Generation

```sh
php artisan passport:install --uuids
```

---
## ✅ Testing API Endpoints

Use **Postman** or **cURL** to test endpoints:

#### 📌 Register User
```sh
curl -X POST "http://localhost:8000/api/register" -d "name=John&email=john@example.com&password=123456"
```

#### 📌 Login User
```sh
curl -X POST "http://localhost:8000/api/login" -d "email=john@example.com&password=123456"
```

#### 📌 Get Authenticated User
```sh
curl -X GET "http://localhost:8000/api/user" -H "Authorization: Bearer {token}"
```

---
## 📢 Contributing

Feel free to submit issues or pull requests for improvements!

---
## 📜 License

This project is open-source under the [MIT License](LICENSE).

---
### 🎉 Happy Coding! 🚀


