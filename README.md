# Task Management System (Laravel)

## 📌 Overview
A simple task management system to create, update, delete, and track tasks with status control.

## 🚀 Features
- Create, edit, delete tasks
- Track status: pending, in progress, completed
- Clean UI with Tailwind CSS
- Validation using Form Requests
- Feature tests included

## 🛠 Tech Stack
- Laravel 10+
- MySQL
- Blade Templates
- Tailwind CSS
- PHPUnit Testing

## ⚙️ Setup Instructions

```bash
git clone <repo-url>
cd project
composer install
npm install && npm run dev
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve