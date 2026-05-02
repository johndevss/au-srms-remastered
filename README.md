# Student Result Management System Remastered

A full remaster of an original college-era project, rebuilt from the ground up using **Laravel**, **Filament**, and **MySQL**. Improves on the original XAMPP-based system with a modern tech stack, cleaner architecture, and a significantly better UI across all user roles.

## Features

- **Admin Panel** — Manage teachers, students, and sections
- **Teacher Panel** — View assigned sections and submit quarterly grades per student
- **Student Panel** — View grades across all enrolled subjects
- Role-based access for admins, faculty, and students
- Auto-generated user accounts for teachers and students upon creation
- Quarterly grading system with automatic final grade computation

## Tech Stack

- [Laravel 12](https://laravel.com/)
- [Filament v4](https://filamentphp.com/)
- MySQL
- PHP 8.4

---

## Getting Started

### Prerequisites

- PHP 8.4+
- Composer
- Node.js & NPM
- MySQL

### Installation

#### 1. Clone the repository

```bash
git clone https://github.com/johndevss/srms-remastered.git
cd srms-remastered
```

#### 2. Install dependencies

```bash
composer install
npm install
```

#### 3. Configure environment

```bash
cp .env.example .env
php artisan key:generate
```

Then open `.env` and update your MySQL connection:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=au_srms_remastered
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

#### 4. Build frontend assets

```bash
npm run build
```

#### 5. Run migrations and seed the database

```bash
php artisan migrate:fresh --seed
```

This will create all tables and seed:
- An admin account
- 50 sample students with auto-generated user accounts
- 20 sample teachers with auto-generated user accounts

#### 6. Start the development server

```bash
php artisan serve
```

Visit [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## Default Accounts

| Role    | Email                  | Password                          |
|---------|------------------------|-----------------------------------|
| Admin   | admin@au.edu.ph        | password                          |
| Teacher | (see seeded teachers)  | `lastname` + birthdate (MMDDYYYY) |
| Student | (see seeded students)  | `lastname` + birthdate (MMDDYYYY) |

---

## Panels

| Panel   | URL      | Access          |
|---------|----------|-----------------|
| Admin   | /admin   | Admin only      |
| App     | /app     | Teachers & Students |

---

## License

This project is open source and available under the [MIT License](LICENSE).