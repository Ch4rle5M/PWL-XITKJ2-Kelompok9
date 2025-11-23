# 🔐 Ciphera
### A Comprehensive Cryptography Learning & CTF Training Platform

![License](https://img.shields.io/badge/License-MIT-blue.svg)
![PHP](https://img.shields.io/badge/PHP-8.0%2B-purple)
![MySQL](https://img.shields.io/badge/Database-MySQL-orange)
![Status](https://img.shields.io/badge/Status-Active-brightgreen)

> **"Unlock the secrets, understand the logic, and master the art of hidden messages."**

---

## 📖 Table of Contents
1. [About the Project](#-about-the-project)
2. [Key Features](#-key-features)
3. [Tech Stack](#-tech-stack)
4. [Project Architecture](#-project-structure)
5. [Installation & Setup](#-installation--setup)
6. [Database Configuration](#-database-setup)
7. [Technical Highlights](#-technical-notes)
8. [Team & Task Division](#-team-members--task-division)
9. [Contributing](#-contributing)
10. [License](#-license)

---

## 💡 About the Project

**Ciphera** is an educational platform designed to bridge the gap between theory and practice in cybersecurity. From basic Linux CLI usage to solving real Capture The Flag (CTF) challenges, Ciphera serves as a training ground for beginners and enthusiasts.

It features a robust system for managing challenges, tracking user progress via leaderboards, and providing a hands-on environment for learning modern cryptography.

---

## 🌟 Key Features

### 🎓 Learning Modules
* **Easy:** Introduction to Linux CLI, file permissions, and basic navigation.
* **Medium:** Classical ciphers (Caesar, Vigenère), Base64/Hex encoding, and CyberChef usage.
* **Hard:** Modern cryptography, Python scripting, and real-world case studies.

### 🚩 CTF System
* **Secure Attachments:** Download challenge files safely (ZIP/Image).
* **Real-time Verification:** Instant flag checking system.
* **Dynamic Scoring:** Points awarded based on difficulty.
* **Modal Interface:** Clean, popup-style challenge details.

### 🛠️ Admin Panel
* **CRUD Management:** Create, Read, Update, and Delete challenges easily.
* **File Management:** Upload local files or attach external resource links.
* **User Control:** Role management (Promote/Demote), kick users, or reset passwords.
* **Dashboard:** Visual overview of platform activity.

### 🏆 Community & Gamification
* **Leaderboard:** Real-time ranking of top players.
* **User Profiles:** Track completion statistics and solved challenges.

---

## 🛠️ Tech Stack

| Component | Technology | Description |
| :--- | :--- | :--- |
| **Frontend** | HTML5, CSS3, JS | Glassmorphism UI design, Responsive layout |
| **Backend** | PHP Native | Object-Oriented Programming (OOP), Secure routing |
| **Database** | MySQL / MariaDB | Relational database for users and challenges |
| **Server** | Apache | Tested on Laragon and XAMPP |

---

## 🏗️ Project Structure

The project follows a structured MVC-style organization for maintainability.

```text
PWL-XITKJ2-Kelompok9/
│── action/
│   ├── admin/        # Admin handlers (CRUD, uploads, user mgmt)
│   ├── auth/         # Authentication (Login, Register, Logout)
│   ├── challenge/    # Challenge logic and display
│   └── secret/       # Flag verification logic
│       └── chall/    # Main challenge processing
│
│── assets/
│   ├── homepage/     # Landing page assets
│   ├── login/        # Auth page styles
│   └── uploads/      # Auto-created directory for challenge files
│
│── index.php         # Entry point / Router
│── README.md         # Documentation