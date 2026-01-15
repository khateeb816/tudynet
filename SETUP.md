# Quick Setup Guide

## Prerequisites
- PHP 8.2 or higher
- Composer
- MySQL/MariaDB database

## Installation Steps

1. **Install Dependencies**
   ```bash
   composer install
   ```

2. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

3. **Database Configuration**
   Edit `.env` file and set your database credentials:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

4. **Run Migrations**
   ```bash
   php artisan migrate
   ```

5. **Seed Initial Data**
   ```bash
   php artisan db:seed
   ```
   This will create:
   - Super Admin user (admin@example.com / password)
   - Default settings

6. **Create Storage Link**
   ```bash
   php artisan storage:link
   ```
   This is required for file uploads to work properly.

7. **Start Development Server**
   ```bash
   php artisan serve
   ```

8. **Access the Application**
   - Open browser: http://localhost:8000
   - Login with: admin@example.com / password

## Default Login Credentials

**Super Admin:**
- Email: `admin@example.com`
- Password: `password`

**Manager:**
- Email: `manager@example.com`
- Password: `password`

**Writer:**
- Email: `writer@example.com`
- Password: `password`

**Client:**
- Email: `client@example.com`
- Password: `password`

**Additional Test Accounts:**
- Writer 2 (disabled): `writer2@example.com` / `password`
- Client 2: `client2@example.com` / `password`

## Important Notes

- Make sure your `storage/app/public` directory is writable
- The storage link must be created for file uploads to work
- All file uploads are stored in `storage/app/public/orders/`
- PDF security features (blur, watermark) would require additional packages if needed in the future

## Next Steps

1. Login as Super Admin
2. Create Subjects (required for orders)
3. Create Managers and Writers
4. Clients can register from the frontend
5. Start creating and managing orders!

