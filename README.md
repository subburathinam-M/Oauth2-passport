

# OAuth2 Passport Authentication in Laravel

OAuth2 authentication using Laravel Passport in a PHP project with API token-based authentication. 

## 📌 Project Overview
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
## 🚀 Installation Guide

### 1️⃣ Clone the Repository
```bash
$ git clone https://github.com/your-username/oauth2-passport.git
$ cd oauth2-passport
```

### 2️⃣ Install Dependencies
```bash
$ composer install
```

### 3️⃣ Set Up Environment
```bash
$ cp .env.example .env

- Set up database details in `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=root
DB_PASSWORD=
```
### Generate Application Key

$ php artisan key:generate
```

### 4️⃣ Configure Database
- Update `.env` file with your database credentials.
- Run migrations:
```bash
$ php artisan migrate
```

### 5️⃣ Install & Configure Laravel Passport( Install Passport Encryption Keys)
```bash
$ php artisan passport:install
```

### 6️⃣ Clear and Cache Configurations
```bash
$ php artisan config:clear
$ php artisan cache:clear
$ php artisan view:clear
```

### 7️⃣ Start the Development Server
```bash
$ php artisan serve
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

###  📌  5. Update `User.php` Model
```php
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
}
```


### 📌 6. Configure Authentication Guards

Modify `config/auth.php`:

```php
'guards' => [
    'api' => [
        'driver' => 'passport',
        'provider' => 'users',
    ],
],
```

### 📌 7. Run Development Server

Start Laravel's built-in server:

```sh
php artisan serve
By default, the app runs at `http://127.0.0.1:8000`

### Run Vite for Frontend Assets
```sh
npm run dev
```

---
## 🔑 API Endpoints
| Method | Endpoint        | Description       |
|--------|----------------|------------------|
| 📝 POST  | `/api/register` | Register a new user |
| 🔑 POST  | `/api/login`    | User login       |
| 🔍 GET   | `/api/user`     | Get user details (Auth required) |

---

## Testing API with Postman
1. Register a new user:
   - Endpoint: `POST /api/register`
   - Body:
     ```json
     {
       "name": "John Doe",
       "email": "johndoe@example.com",
       "password": "password123"
     }
     ```

2. Login and get an access token:
   - Endpoint: `POST /api/login`
   - Response:
     ```json
     {
       "access_token": "your-access-token",
       "token_type": "Bearer",
       "expires_in": 3600
     }
     ```

3. Access user profile (Authenticated Request):
   - Endpoint: `GET /api/user`
   - Headers:
     ```json
     {
       "Authorization": "Bearer your-access-token"
     }
     ```

## Additional Commands

### Clear Cache
```sh
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Run Tests
```sh
php artisan test
```

### Stop Server
```sh
CTRL + C
```

## Pushing to GitHub
```sh
git add .
git commit -m "Initial commit"
git push origin main
```

## ⚙️ Useful Commands
| Command | Description |
|---------|-------------|
| 🛠️ `php artisan serve` | Start Laravel development server |
| 📦 `composer install` | Install project dependencies |
| 🎯 `php artisan key:generate` | Generate app key |
| 📊 `php artisan migrate` | Run migrations |
| 🔄 `php artisan passport:install` | Install Laravel Passport |
| 🧹 `php artisan config:clear` | Clear configuration cache |
| 🗑️ `php artisan cache:clear` | Clear application cache |
| 👁️ `php artisan view:clear` | Clear compiled views |
| ⚡ `npm run dev` | Compile front-end assets (if applicable) |

## 🖥️ Running on XAMPP

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


---
## 📜 License

This project is open-source under the [MIT License](LICENSE).

## Conclusion
This project demonstrates Laravel Passport authentication for API-based user login, registration, and profile retrieval. You can extend it further to include features like email verification and password reset.

---
Feel free to customize the project or contribute to improve it!

---
### 🎉 Happy Coding! 🚀


