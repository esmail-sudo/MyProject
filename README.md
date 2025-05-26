# 🎓 Student Activity Management System

A simple PHP-based web application to manage student activities, including training and visit registration.

---

## 📌 Project Purpose

This project was developed to help academic institutions manage student participation in either **training programs** or **external visits**. It tracks training duration (90 days), limits the number of allowed visits (maximum 4), and stores relevant data securely in a database. The system simplifies administrative tasks and enhances data accessibility for search and reporting.

---

## 🔧 Features

- Register students for either **Training** or **Visit**
- Automatically calculate remaining days from 90 (for training)
- Automatically decrease from 4 allowed visits (for visits)
- Upload and store training certificate files
- Search for registered students
- MySQL database integration

---

## 📁 Project Structure

- `form.php` — Main registration form  
- `submit.php` — Handles form submission and data processing  
- `search.php` — Search functionality for student records  
- `student_activity_v2.sql` — Database schema (import this file)  
- `README.md` — Project documentation  
- `database-setup.docx` — Setup guide (if needed)

---

## ⚙️ Setup Instructions

1. Import the database using `student_activity_v2.sql` into your MySQL server (via phpMyAdmin or MySQL CLI).
2. Place the project folder in your local server directory (`htdocs` if using XAMPP).
3. Start Apache and MySQL from XAMPP control panel.
4. Open your browser and navigate to:  
   `http://localhost/MyProject/form.php`
5. Start registering students and testing functionality.

---

## 📷 Screenshots

*Screenshots are currently not included in this version. You can take screenshots of the form and search pages and add them to a `screenshots/` folder if needed in future updates.*

---

## 💡 Notes

- This project is developed for educational and training purposes.
- You can extend it by adding:
  - Authentication (admin login)
  - Dashboard with statistics
  - Notification or email system


## 🗄️ Database Setup

1. Open phpMyAdmin
2. Create a new database named `student_activity_v2`
3. Import the file `student_activity_v2.sql` located in the project root folder






