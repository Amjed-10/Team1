# Ahmed Daif Allah International Applied School Management System

## Overview

This is a comprehensive web-based school management system built for *Ahmed Daif Allah International Applied School*. The system helps administrators efficiently manage daily operations, track student attendance, share news and events, and more. The platform provides both user-friendly interfaces and secure admin functionalities to manage various aspects of the school's digital presence.

## Key Features

### 1. *Attendance System*
   - *Admin-Only Upload*: Only administrators can upload daily attendance records using a CSV file format.
   - *Daily Attendance Display*: Users can view student attendance by selecting a specific date and class.
   - *Database-Driven*: Attendance data is stored in a MySQL database for easy retrieval and management.

### 2. *Main Page*
   - *Campus News*: Displays a real-time scrolling marquee with campus news and updates.
   - *Event Listings*: Shows upcoming school events, with customizable dates and descriptions.
   - *Notice Board*: A visual section where important school announcements are posted.
   - *About Us Section*: Contains detailed information about the school, its mission, vision, and key personnel.
   - *Gallery*: A photo gallery showcasing important school events and achievements.

### 3. *Admin Panel*
   - *Content Management*: Admins can log in and update the text fields for news, events, and school information.
   - *Image Management*: Admins can upload and replace images for the gallery, event banners, and other visuals across the website.
   - *Secure Access*: Only authorized users can access the admin panel after logging in.

### 4. *Login System*
   - *Secure Admin Login*: The system includes a login page to restrict access to the admin panel.
   - *Session Management*: Sessions are managed securely, preventing unauthorized access once logged in.

---

## Technology Stack

- *Frontend*: HTML5, CSS3, JavaScript
- *Backend*: PHP 7.x
- *Database*: MySQL
- *Web Server*: Apache (via XAMPP or LAMP stack)
- *Version Control*: Git/GitHub

---

## Installation Instructions

### Prerequisites

- XAMPP or LAMP stack installed (for Apache & MySQL).
- Git version control installed.

### Steps to Set Up

1. *Clone the Repository*:
   ```bash
   git clone https://github.com/your-repo/school-management-system.git
Move to the XAMPP/LAMP Directory:

bash
Copy code
mv school-management-system /path/to/xampp/htdocs/
Create a MySQL Database:

Open phpMyAdmin and create a database named attendance_db.
Import the SQL file located at db/attendance_db.sql to set up the database schema.
Configure the Database Connection:

Open the db_connect.php file and provide your MySQL username, password, and database name:
php
Copy code
$host = 'localhost';
$user = 'root'; // Your MySQL username
$pass = ''; // Your MySQL password
$db_name = 'attendance_db';
Start the Apache Server:

Start Apache from the XAMPP/LAMP control panel.
Access the System:

Open a browser and visit http://localhost/school-management-system to start using the platform.
Pages and Functionalities
1. Main Page (index.php)
Displays the school's welcome message, current news, and a list of upcoming events.
Includes navigation to the attendance, schedule, and chatbot pages.
2. Admin Panel (admin_page.php)
Admins can upload attendance data in CSV format.
Admins can modify various content, such as campus news, event details, and school images.
Secure login ensures only authorized access.
3. Attendance Page (attendance.php)
Allows viewing of attendance for a specific date and class.
Students' names and statuses (Present/Absent) are fetched from the MySQL database and displayed in a table.
4. Login Page (login.php)
Admin login page for accessing the admin panel.
Future Enhancements
The following features can be added to extend the current system's functionalities:

1. Parent Notifications
Feature: Automatically notify parents via SMS or email about student attendance, schedule updates, and school announcements.
Benefit: Keeps parents informed in real-time.
2. Multilingual Support
Feature: Add support for multiple languages to cater to a wider audience.
Benefit: Ensures that non-English speaking students and parents can navigate the site easily.
3. Admin Dashboard
Feature: A visual dashboard for admin users, displaying charts and analytics on attendance trends, student performance, and events.
Benefit: Provides actionable insights for school administrators.
4. Mobile Application
Feature: A mobile app for accessing the school management system on-the-go.
Benefit: Extends accessibility for both parents and staff members.
5. Online Payment Gateway
Feature: Introduce online fee collection and payment tracking.
Benefit: Simplifies the fee management process for both the school and parents.
6. Online Class and Exam Management
Feature: Support for scheduling and managing online exams and classes.
Benefit: Ideal for distance learning environments, enabling remote education.
7. Automated Report Generation
Feature: Generate and export student performance, attendance reports, and event summaries in PDF/Excel formats.
Benefit: Simplifies report creation for official purposes.
Contributing
If you'd like to contribute to the project, feel free to open an issue or create a pull request on GitHub. Whether you're fixing a bug, adding a new feature, or improving documentation, all contributions are welcome!

License
This project is licensed under the MIT License - see the LICENSE file for details.