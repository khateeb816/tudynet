# Order & Referral Management System

A pure Laravel application for managing orders and referrals with role-based access control.

## Features

- **4 User Roles**: Super Admin, Manager, Writer, Client
- **Order Management**: Complete order lifecycle from creation to completion
- **Referral System**: Referral codes, rewards, and withdrawal management
- **Notifications**: Real-time notifications for order status changes
- **Reviews & Feedback**: Comment system for orders
- **Meeting Requests**: Client can request meetings with managers

## Installation

1. Clone the repository
2. Install dependencies:
   ```bash
   composer install
   ```

3. Copy environment file:
   ```bash
   cp .env.example .env
   ```

4. Generate application key:
   ```bash
   php artisan key:generate
   ```

5. Configure your database in `.env`:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

6. Run migrations:
   ```bash
   php artisan migrate
   ```

7. Seed initial data:
   ```bash
   php artisan db:seed
   ```

8. Create storage link:
   ```bash
   php artisan storage:link
   ```

9. Start the development server:
   ```bash
   php artisan serve
   ```

## Default Login Credentials

After seeding, you can use these accounts:

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

## User Roles

### Super Admin
- Full system access
- Can create managers and writers
- Can manage all settings
- Approves referral withdrawals

### Manager
- Can approve orders
- Can assign writers
- Can verify payments
- Can disable clients and writers

### Writer
- Can view assigned orders
- Can upload half and full files
- Can update order status
- Cannot approve payments

### Client
- Can create orders
- Can upload payments
- Can view files (based on permissions)
- Can submit feedback and request meetings

## Order Flow

1. Client creates an order
2. Client uploads half payment
3. Manager approves the order
4. Manager assigns order to a writer
5. Writer uploads half file
6. Writer uploads full file
7. Writer marks order as completed
8. Manager allows client to view half file
9. Client uploads full payment
10. Manager verifies full payment
11. Client gets access to complete files

## Referral System

- Any user can generate a unique referral code
- When a referred user pays for an order, the referrer gets a reward
- Users can request withdrawals for their referral earnings
- Super Admin processes withdrawal requests

## File Structure

- `app/Http/Controllers/` - All controllers
- `app/Models/` - Eloquent models
- `database/migrations/` - Database migrations
- `resources/views/` - Blade templates
- `routes/web.php` - Application routes

## Notes

- This is a pure Laravel project without Vite or npm dependencies
- Uses Bootstrap CDN for styling
- File uploads are stored in `storage/app/public`
- Make sure to run `php artisan storage:link` to create the symbolic link

## License

This project is open-sourced software.
# tudynet
