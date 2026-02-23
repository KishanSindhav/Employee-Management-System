# 🏢 Employee Management System

## 📌 Project Overview

The **Employee Management System** is a web-based application developed to manage employees, managers, projects, notifications, attendance, leave management, and internal communication within an organization.

The system is designed using **Role-Based Access Control (RBAC)** and includes three main roles:

- 👑 CTO (Admin)
- 👨‍💼 Manager
- 👨‍💻 Employee

The system ensures secure authentication and controlled access to functionalities based on user roles.

---

## 🎯 Key Features

- Role-based login authentication
- Signup request approval system
- Project allocation and tracking
- Task assignment and analysis
- Leave application & approval system
- Attendance monitoring (CTO only)
- Notification approval workflow
- Internal communication (Chat System)
- Growth tracking (Managed by Manager)
- Secure page access restriction
- Real-time message notification (dot indicator)
- Profile photo upload
- Session management

---

# 👑 CTO (Admin) Module

The CTO has complete system control.

### 🔹 Main Features:

- View all company notifications
- Approve or reject new employee/manager signup requests
- Add or delete managers and employees
- View all employee & manager details
- Add new project details
- Assign managers and employees to projects
- Approve or reject leave applications (Manager & Employee)
- Monitor attendance records (Managers & Employees)
- Approve manager notifications before publishing
- Monitor manager-employee communication
- Communicate only with managers
- View chat notifications (dot indicator for new messages)

---

# 👨‍💼 Manager Module

### 🔹 Main Features:

- Add new notifications (requires CTO approval)
- Assign and manage tasks
- Track and manage project growth (Table & Chart View)
- Manage employee details
- Manage attendance records (data entry only)
- Apply for leave
- Communicate with:
  - CTO
  - Employees
- Update own profile details

> ⚠ Manager **cannot approve leave applications**

---

# 👨‍💻 Employee Module

### 🔹 Main Features:

- View company notifications
- View assigned projects
- Submit assigned tasks
- Provide feedback
- Apply for leave
- View & update own details
- Upload profile photo
- Chat with Manager only
- Receive message notification (dot alert)

---

# 🔐 Security & Access Control

- Without login/signup, users cannot access system pages.
- Only "Home" and "About Us" pages are publicly accessible.
- All other pages require authentication.
- Signup request must be approved by CTO before login access.
- Role-based dashboard redirection after login.
- Password stored in hashed format.
- Session-based authentication system.

---

# 💬 Communication System

- Internal chat system
- CTO ↔ Manager communication
- Manager ↔ Employee communication
- Employees cannot chat directly with CTO
- Unread message indicator (dot alert)

---

# 📊 Project Management & Growth Tracking

- Project task progress tracking
- Task allocation system
- Growth tracking managed by Manager
- Tabular view of project progress
- Visual charts for progress representation
- Performance monitoring by CTO

---

# 🛠️ Technologies Used

| Technology | Purpose |
|------------|----------|
| PHP | Backend logic & authentication |
| MySQL | Database management |
| HTML5 | Web structure |
| CSS3 | UI design |
| JavaScript | Client-side validation |
| jQuery | Dynamic operations |
| Bootstrap 5 | Responsive UI |
| XAMPP | Local server environment |
| Visual Studio Code | Code editor |

---

# 🗄️ Core Functionalities Implemented

- Role-Based Access Control (RBAC)
- Approval Workflow System
- CRUD Operations (Create, Read, Update, Delete)
- Project Assignment Logic
- Task Allocation & Analysis
- Leave Management System (CTO Approval)
- Attendance Monitoring (CTO Access Only)
- Notification Approval System
- Chat System with Alert Indicator
- Secure Authentication System

---

# ▶️ How to Run the Project

1. Install XAMPP.
2. Move the project folder to:
3. Start Apache and MySQL.
4. Import the database using phpMyAdmin.
5. Open browser: http://localhost/project-folder-name


---

# 📚 Academic Information

Department of Computer Science  
Gujarat University  
5-Year Integrated M.Sc. (Computer Science)  
Semester V  

---

# 👥 Team Members

- Sindhav Kishan
- Vaghela Hirensinh

---

# 📅 Project Duration

6 Months

---

# 🚀 Future Enhancements

- Email notification system
- Advanced analytics dashboard
- Real-time chat using WebSockets
- Cloud deployment
- JWT-based authentication
- Two-factor authentication (2FA)
- API integration
- Salary management module
- Mobile responsive improvements

---

⭐ If you like this project, give it a star!
