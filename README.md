# 📚 Sigma Institute - Tuition Class Management System

A web-based Tuition Class Management System developed for managing student registrations, class schedules, fee payments, and learning resources efficiently.

---

## ✨ Key Features

- **User Roles & Authentication:**
  - Multi-role support for Students, Teachers, and Admin users.
  - Registration, login, profile management, and password reset requests.

- **Student Management:**
  - Complete student profiles with guardian and contact details.
  - Class and subject enrollment tracking across academic years.

- **Teacher & Schedule Management:**
  - Managing teacher qualifications, profiles, and contact details.
  - Assigning subjects and classes to teachers with specific time schedules.

- **Payment System:**
  - Monthly fee payment recording for students per subject and teacher.
  - Payment history tracking by date and month.

- **Resource & Material Sharing:**
  - Uploading learning materials such as PDFs, images, and reference links for students.

- **Inquiries & Communication:**
  - Public contact/message form for visitor inquiries.

---

## 🛠️ Tech Stack

- **Frontend:** HTML5, CSS3, JavaScript, Bootstrap
- **Backend:** PHP
- **Database:** MySQL / MariaDB (`sigma_db`)
- **Server Environment:** XAMPP (Apache & MySQL)

---

## 🗄️ Database Architecture

The system uses `sigma_db` database, containing the following core relational tables:
- `users`: Stores user accounts, credentials, roles, and approval statuses.
- `student`: Stores detailed student demographic and guardian information.
- `teacher`: Stores instructor profiles, qualifications, and photos.
- `class` & `subject`: Defines grade levels and available subjects.
- `enrollments` & `register`: Tracks student subject registrations by year.
- `teach_sub_reg`: Maps teachers to specific classes, subjects, and weekly schedules.
- `payment`: Records fee transactions.
- `resources`: Stores uploaded study papers and educational materials.
- `contact_messages`: Handles inquiries sent via the contact page.
- `password_requests`: Handles password recovery requests.

---

## ⚙️ Local Installation & Setup

1. **Clone the Repository:**
   ```bash
   git clone [https://github.com/Tharu003/tuition-management-system.git](https://github.com/Tharu003/tuition-management-system.git)
