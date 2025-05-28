# OS_Training_Management_System
A software that helps organizations plan, deliver, track, and manage training programs. It streamlines scheduling, automates admin tasks, tracks learner progress, and supports both in-person and online training for improved efficiency and compliance.making it an essential tool for boosting workforce performance and operational efficiency.


## Project Overview
The AFLEX TMS, developed by the African Leadership Excellence Academy, is a web-based platform to manage training programs efficiently. Built with PHP, JavaScript, and MySQL, it automates trainee management, scheduling, and document handling. Using the Dashgrin 1.1 template (upgraded from 1.0), it features a green and white UI. Updated on May 28, 2025, at 06:08 PM CEST, it now includes bug fixes, performance improvements, and testing data: 10 customers, 5 trainings, 50 trainees.

## Key Features
- **Dashboard**: Shows metrics (10 customers, 5 trainings, 50 trainees) and trainee stats (by year, gender, region).
- **Trainee Management**: View, add, and search trainees with details like name, education, and contact info.
- **Training Management**: Schedule and manage training rounds with key details.
- **Training Documents**: Search and upload training materials.
- **Scheduling**: Calendar-based room scheduling (highlighted for May 28, 2025).
- **Organization Management**: Tracks customer organization details.
- **User Management**: Role-based access control and permissions.
- **Real-Time Updates**: Data updates in real time for accuracy.

## Installation & Setup
1. Clone the repo: `git clone https://github.com/your-username/aflex-tms.git`
2. Set up a local server (e.g., XAMPP) and place the project in the root directory.
3. Create a MySQL database `aflex_tms` and import `database/aflex_tms.sql`.
4. Update `config/db_connect.php` with your database credentials.

## Dependencies
- PHP 7.4+
- MySQL 5.7+
- JavaScript
- Dashgrin 1.1 (MIT License, Bootstrap 4)
- Apache Server (via XAMPP/WAMP)
- Bootstrap 4

## How to Run
1. Start XAMPP/WAMP (Apache and MySQL).
2. Access `http://localhost/aflex-tms` in a browser.
3. Log in with default credentials (username: `admin`, password: `password123`).
4. Explore via the sidebar menu.

## Authors
- Gezaw Alemayehu Kassahun (ID: 2120246019): Backend, database optimization.
- Han Nway Nyein (ID: 2120246021): Frontend, UI enhancements.
- Both collaborated on database design and testing as of May 28, 2025.
