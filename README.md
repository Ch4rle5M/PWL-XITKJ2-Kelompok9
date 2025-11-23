# 🔐 Ciphera v2

*A Comprehensive Cryptography Learning & CTF Training Platform*

Ciphera is an educational platform designed to explore the world of
**cryptography**, from basic Linux CLI commands to solving complex
**Capture The Flag (CTF)** challenges.
It provides structured learning modules, real-time challenge
interaction, and a full admin control panel --- built for beginners and
cybersecurity enthusiasts.

> *"Unlock the secrets, understand the logic, and master the art of
> hidden messages."*

------------------------------------------------------------------------

## 🌟 Features

### 🎓 Learning Modules

-   **Easy** --- Basic Linux CLI, permissions, introductory navigation
-   **Medium** --- Classical ciphers, Base64/Hex encoding, CyberChef
    basics
-   **Hard** --- Modern cryptography with Python + real security case
    studies

### 🚩 Capture The Flag (CTF) System

-   Secure challenge downloads (ZIP/Image)
-   Real-time flag submission & verification
-   Dynamic scoring based on difficulty

### 🛠️ Admin Panel

-   Centralized dashboard
-   Complete challenge CRUD (upload ZIP/TXT or use external links)\
-   User role management (promote, demote, kick, reset passwords)

### 🏆 Community & Gamification

-   Live leaderboard
-   User profiles with progress tracking

------------------------------------------------------------------------

## 🛠️ Tech Stack

-   **Frontend**: HTML5, CSS3 (Glassmorphism UI), JavaScript.
-   **Backend**: PHP Native (OOP DB Connection)
-   **Database**: MySQL
-   **Server Environment**: Apache (Laragon/XAMPP)

------------------------------------------------------------------------

## 🏗️ Project Structure

    PWL-XITKJ2-Kelompok9/
    │── action/
    │   ├── admin/        # Admin handlers (CRUD, uploads)
    │   ├── auth/         # Login, Register, Logout
    │   ├── challenge/    # Challenge logic
    │   └── secret/       # Flag verification
    │       └── chall/    # Main CTF challenge logic
    │
    │── assets/
    │   ├── homepage/
    │   ├── login/
    │   └── uploads/      # Challenge attachments
    │
    │── index.php
    │── README.md

------------------------------------------------------------------------

## 📦 Installation & Setup

### 1️⃣ Clone the Repository

``` bash
git clone https://github.com/Ch4rle5M/PWL-XITKJ2-Kelompok9.git
cd PWL-XITKJ2-Kelompok9
```

### 2️⃣ Move Project to Server Folder

-   **Laragon:** `C:/laragon/www/`
-   **XAMPP:** `C:/xampp/htdocs/`

Start **Apache** and **MySQL**.

### 3️⃣ Database Setup (PhpMyAdmin)

1.  Open PhpMyAdmin → **New**

2.  Create database named:

        ta_pwl

3.  Go to **Import** and select the `ta_pwl.sql` file

4.  Done ✔️

### 4️⃣ Update PHP Upload Configuration

Open `php.ini` and edit:

    upload_max_filesize = 100M
    post_max_size = 100M

Restart Apache.

------------------------------------------------------------------------

## 🚀 Usage

### Access the Website

    http://localhost/PWL-XITKJ2-Kelompok9/

### Default Admin Login

    Username: User
    Password: admin123

### Creating a Challenge (Admin)

-   Go to **Profile → Admin Panel**
-   Fill in "Create Challenge" form
-   Upload physical file (ZIP/TXT) or insert external link (Google
    Drive, GitHub, etc.)

------------------------------------------------------------------------

## 📝 Technical Notes

### 🔧 Upload Handler

-   Uses `__DIR__` for accurate absolute pathing
-   Auto-creates `uploads` folder
-   Sanitizes file paths (path traversal protection)
-   Auto-detects local file vs external link in frontend

### 🔒 Security

-   Session-based authentication
-   Prepared statements (SQL Injection defense)
-   Sanitized download handler
-   Admin-only access restrictions

------------------------------------------------------------------------

## 🤝 Contributing

We welcome contributions from anyone who wants to help improve Ciphera!

### How to Contribute

1.  **Fork** the repository
2.  Create a new **branch**
3.  **Commit** changes with clear messages
4.  **Push** your branch
5.  Open a **Pull Request**

### Contribution Guidelines

-   Keep code clean & documented
-   Test new features properly
-   Respect collaborative discussions

> Together, we can make Ciphera a better cryptography learning platform!
> 🚀

------------------------------------------------------------------------

## 👥 Team Members

  **Charles Marselino |  UI Design, Backend Design, Frontend Development**       

  **ClarenceCristiano | Frontend Development**       

  **Fani              | Frontend Development, UI Design**        


------------------------------------------------------------------------

## 📄 License

This project is licensed under the **MIT License**.
You may use, modify, and redistribute it as long as proper credit is
provided.

------------------------------------------------------------------------
