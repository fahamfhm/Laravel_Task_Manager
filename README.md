# 📝 Laravel Task Management Web Application

A simple yet powerful **Task Management System** built using **Laravel**.  
This web application allows users to efficiently manage their tasks, categorize them, and track progress with an intuitive interface.  
Developed as part of an internship assignment project.

---

## 🚀 Features

- 🔐 **User Authentication** – Login, Register, Logout  
- 👥 **User Roles** – Admin and Intern  
- 📋 **Task Management (CRUD)** – Create, view, update, and delete tasks easily  
- 🗂️ **Category Management** – Manage categories and assign them to tasks  
- 📆 **Task Deadlines & Status Tracking**  
- 📊 **Dashboard Overview**  
- 📄 **PDF Report Generation**  
- 🌐 **Responsive Layout** built with **Tailwind CSS**  
- ☁️ **Clean and Scalable Laravel Architecture**

---

## 🛠️ Tech Stack

| Layer | Technology |
|-------|-------------|
| Framework | Laravel 11 |
| Frontend | Blade Templates + Tailwind CSS |
| Database | MySQL |
| Authentication | Laravel Breeze / Fortify |
| PDF Generation | barryvdh/laravel-dompdf |
| Version Control | Git & GitHub |

---

## ⚙️ Installation Guide

Follow these steps to set up and run the project locally 👇


### 1. Clone the Repository
```bash
git clone https://github.com/fahamfhm/laravel-taskmanager.git
cd laravel-taskmanager
```

### 2. Install Dependencies
```bash
composer install
npm install
npm run dev
```

### 3. Create Environment File
```bash
cp .env.example .env
```

### 4. Configure Database
Open the .env file and update your database credentials:
```bash
DB_DATABASE=taskmanager
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Generate Application Key
```bash
php artisan key:generate
```

### 6. Run Migrations and Seeders
```bash
php artisan migrate --seed
```

### 7. Start the Development Server
```bash
php artisan serve
```
Now open your browser and visit:
👉 http://localhost:8000
```

```
### 🧑‍💻 User Roles
Role	Description
Admin	Can manage all tasks, categories, and users.
Intern	Can manage only their assigned tasks.

```
```

### 📂 Folder Structure Overview
swift
Copy code
├── app/
│   ├── Http/Controllers/
│   ├── Models/
│   └── ...
├── resources/views/
│   ├── tasks/
│   ├── categories/
│   └── layouts/
├── routes/
│   └── web.php
├── database/
│   ├── migrations/
│   └── seeders/
└── public/
```
```
### 🧰 Useful Artisan Commands

Command	Description
php artisan migrate	Run all migrations
php artisan serve	Start local server
php artisan make:model ModelName -mcr	Create model, migration, controller, and resource
npm run dev	Compile frontend assets
php artisan tinker	Launch interactive Laravel shell

🤝 Contributing
Contributions, issues, and feature requests are welcome!

To contribute:

Fork the repository

Create a new branch (git checkout -b feature-name)

Commit your changes (git commit -m "Add new feature")

Push to your branch (git push origin feature-name)

Create a Pull Request

📄 License
This project is licensed under the MIT License.
You’re free to modify and distribute it with proper credit.

👨‍💻 Developer
Developed by: Faham
🎓 NEST Academy | 💻 University of Sri Jayewardenepura
🚀 Passionate about web development and Laravel-based applications.

