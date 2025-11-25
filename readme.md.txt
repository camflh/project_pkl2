# Project PKL2 - Initial Setup Complete

## Setup Summary

This Laravel 12 application has been successfully initialized with the following steps:

### ✅ Completed Setup Tasks

1. **Environment Configuration**
   - Created `.env` file from `.env.example`
   - Configured database to use SQLite for easier development
   - Generated application encryption key

2. **Dependencies Installation**
   - Installed PHP dependencies via Composer (127 packages)
   - Installed Node.js dependencies via NPM (202 packages)
   - All packages installed successfully with no vulnerabilities

3. **Database Setup**
   - Created SQLite database file at `database/database.sqlite`
   - Ran all database migrations successfully
   - Removed duplicate migration (id_sekolah was already in initial schema)

4. **Frontend Assets**
   - Built production assets using Vite
   - Assets compiled successfully (CSS: 34.58 kB, JS: 80.95 kB)

5. **Code Cleanup**
   - Fixed `routes/web.php` - removed accidentally appended Blade template content

## Technology Stack

- **Framework**: Laravel 12.24.0
- **PHP**: ^8.2
- **Database**: SQLite (configured)
- **Frontend**: 
  - Vite 7.2.2
  - Tailwind CSS 3.x
  - Alpine.js 3.x
- **Testing**: Pest 3.8.2 with PHPUnit
- **Auth**: Laravel Breeze 2.3.8

## Application Features

Based on the routes and models, this application manages:

- **Users & Authentication** (with email verification and password reset)
- **Schools** (Sekolah)
- **Departments** (Jurusan)
- **Internship Sections** (Bagian PKL)
- **Students** (Siswa)
- **School Supervisors** (Pembimbing Sekolah)
- **Internship Supervisors** (Pembimbing PKL)
- **Internship Placements** (Penempatan PKL)

## User Roles

- **Admin**: Full CRUD access to all resources
- **User**: Read-only access to all resources + profile management

## Next Steps

To run the application:

1. **Start the development server**:
   ```bash
   docker run --rm -v /workspaces/project_pkl2:/app -w /app -p 8000:8000 composer:latest php artisan serve --host=0.0.0.0
   ```

2. **Or use the built-in dev script** (runs server + queue + vite):
   ```bash
   composer dev
   ```

3. **Access the application**:
   - Landing page: http://localhost:8000
   - Login: http://localhost:8000/login
   - Register: http://localhost:8000/register

## Database Credentials

- **Type**: SQLite
- **Location**: `database/database.sqlite`
- No username/password required

## Important Notes

- Email verification is enabled but uses log driver (check `storage/logs/laravel.log`)
- Session driver is set to database
- Cache driver is set to database
- Queue connection is set to database

---

**Setup completed on**: November 25, 2025
**Environment**: Dev Container (Ubuntu 24.04.3 LTS)
