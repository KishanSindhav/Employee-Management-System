# 🏢 Employee Management System

## 📌 Project Overview

The **Employee Management System** is a web-based application developed to manage employees, managers, projects, notifications, and internal communication within an organization.

This system is designed with **Role-Based Access Control (RBAC)** and includes three main roles:

- 👑 CTO (Admin)
- 👨‍💼 Manager
- 👨‍💻 Employee

The system ensures secure authentication and controlled access to functionalities based on user roles.

---

## 🎯 Key Features

- Role-based login authentication
- Signup request approval system
- Project allocation and tracking
- Salary management
- Notification approval system
- Internal communication (Chat System)
- Growth tracking using diagrams
- Secure page access restriction
- Real-time message notification (dot indicator)

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
- Track project growth (tables & visual diagrams)
- Approve manager notifications before publishing
- Monitor manager-employee communication
- Communicate only with managers (not employees directly)
- View chat notifications (dot indicator for new messages)

---

# 👨‍💼 Manager Module

### 🔹 Main Features:

- Add new notifications (requires CTO approval)
- Manage employee salary
- Manage employee details
- Assign and manage tasks
- View project growth (table & visual chart)
- Communicate with:
  - CTO
  - Employees
- View & manage employee feedback
- Update own profile details

---

# 👨‍💻 Employee Module

### 🔹 Main Features:

- View company notifications
- View assigned projects
- Submit tasks
- Provide feedback
- View & update own details
- Chat with Manager only
- Receive message notification (dot alert)

---

# 🔐 Security & Access Control

- Without login/signup, users cannot access any system pages.
- Only "Home" and "About Us" pages are publicly accessible.
- All other pages require authentication.
- Signup request must be approved by CTO before login access.
- Role-based dashboard redirection after login.

---

# 💬 Communication System

- Internal chat system
- CTO ↔ Manager communication
- Manager ↔ Employee communication
- Employees cannot chat directly with CTO
- Real-time notification indicator (dot alert) for unread messages

---

# 📊 Project Growth Tracking

- Project task progress tracking
- Tabular view of growth
- Visual diagrams for progress representation
- Performance monitoring by CTO and Manager

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
| XAMPP | Local server environment |
| Visual Studio Code | Code editor |

---

# 🗄️ Core Functionalities Implemented

- Role-Based Access Control (RBAC)
- Approval Workflow System
- CRUD Operations (Create, Read, Update, Delete)
- Project Assignment Logic
- Salary Management System
- Notification Approval System
- Chat System with Alert Indicator
- Secure Authentication System

---

# ▶️ How to Run the Project

1. Install XAMPP.
2. Move the project folder to:
   C:\xampp\htdocs\
3. Start Apache and MySQL.
4. Import the database in phpMyAdmin.
5. Open browser:
   http://localhost/project-folder-name

---

# 📚 Department Details

Department of Computer Science  
Gujarat University  
Ahmedabad, Gujarat  

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
- Password encryption using hashing
- Role-based API integration
- Real-time chat using WebSockets
- Cloud deployment

---

# 🎓 Learning Outcomes

- Advanced Role-Based Access Control implementation
- Workflow approval logic design
- Multi-user authentication system
- Project tracking with visual representation
- Secure internal communication architecture

---

⭐ If you like this project, give it a star!
