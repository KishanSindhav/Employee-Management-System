<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <style>
          .bc,nav{
  background-color:lightyellow;
 }
 .active{
  text-decoration: underline;
 }

    h1 {
      text-align: center;
    }
    ul {
      list-style-type: none;
      margin: 0;
      padding: 0;
    }
    li {
      margin-bottom: 10px;
    }
  </style>

</head>
<body style="background-color:aliceblue">
<nav class="navbar navbar-expand-lg  " >
  <div class="container" >
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="photos\logo.jpg" alt="Logo" width="45" height="35" class="d-inline-block align-text-top">
      HR INDUSTRY
    </a>
  </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-1">
        <li class="nav-item">
          <a class="nav-link " aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-capitalize" href="login.php">Notification</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-capitalize" href="login.php">Project</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active text-capitalize" href="p4.php">About</a>
        </li>
        <li class="nav-item">
        <div class="dropdown">
  <button class="btn dropdown-toggle "  type="button" data-bs-toggle="dropdown" aria-expanded="false">
       More Option    
  </button>
  <ul class="dropdown-menu bc ">
    
    <li><a class="dropdown-item" href="sign_up.php">Sign Up</a></li>
    <li><hr class="dropdown-divider"></li>
    <li><a class="dropdown-item" href="login.php">Log In</a></li>
  </ul>
</div>
</li>
      </ul>
      
    </div>
  </div>
</nav>

<section class="py-5" style="background-color:#f8f9fa;">
  <div class="container">

    <div class="text-center mb-5">
      <h1 class="fw-bold">Employee Management System</h1>
      <p class="lead">A Complete Role-Based Organizational Management Platform</p>
    </div>

    <!-- Project Overview -->
    <div class="mb-4">
      <h3>📌 Project Overview</h3>
      <p>
        The <strong>Employee Management System</strong> is a web-based application developed to manage employees, managers, projects, notifications, attendance, leave management, and internal communication within an organization.
      </p>
      <p>
        The system is designed using <strong>Role-Based Access Control (RBAC)</strong> and includes three main roles:
      </p>
      <ul>
        <li>👑 CTO (Admin)</li>
        <li>👨‍💼 Manager</li>
        <li>👨‍💻 Employee</li>
      </ul>
      <p>
        The system ensures secure authentication and controlled access to functionalities based on user roles.
      </p>
    </div>

    <!-- Key Features -->
    <div class="mb-4">
      <h3>🎯 Key Features</h3>
      <ul>
        <li>Role-based login authentication</li>
        <li>Signup request approval system</li>
        <li>Project allocation and tracking</li>
        <li>Task assignment and analysis</li>
        <li>Leave application & approval system</li>
        <li>Attendance monitoring (CTO only)</li>
        <li>Notification approval workflow</li>
        <li>Internal communication (Chat System)</li>
        <li>Growth tracking (Managed by Manager)</li>
        <li>Secure page access restriction</li>
        <li>Real-time message notification (dot indicator)</li>
        <li>Profile photo upload</li>
        <li>Session management</li>
      </ul>
    </div>

    <!-- CTO Module -->
    <div class="mb-4">
      <h3>👑 CTO (Admin) Module</h3>
      <p>The CTO has complete system control.</p>
      <ul>
        <li>View all company notifications</li>
        <li>Approve or reject new employee/manager signup requests</li>
        <li>Add or delete managers and employees</li>
        <li>View all employee & manager details</li>
        <li>Add new project details</li>
        <li>Assign managers and employees to projects</li>
        <li>Approve or reject leave applications (Manager & Employee)</li>
        <li>Monitor attendance records (Managers & Employees)</li>
        <li>Approve manager notifications before publishing</li>
        <li>Monitor manager-employee communication</li>
        <li>Communicate only with managers</li>
        <li>View chat notifications (dot indicator for new messages)</li>
      </ul>
    </div>

    <!-- Manager Module -->
    <div class="mb-4">
      <h3>👨‍💼 Manager Module</h3>
      <ul>
        <li>Add new notifications (requires CTO approval)</li>
        <li>Assign and manage tasks</li>
        <li>Track and manage project growth (Table & Chart View)</li>
        <li>Manage employee details</li>
        <li>Manage attendance records (data entry only)</li>
        <li>Apply for leave</li>
        <li>Communicate with CTO and Employees</li>
        <li>Update own profile details</li>
      </ul>
    </div>

    <!-- Employee Module -->
    <div class="mb-4">
      <h3>👨‍💻 Employee Module</h3>
      <ul>
        <li>View company notifications</li>
        <li>View assigned projects</li>
        <li>Submit assigned tasks</li>
        <li>Provide feedback</li>
        <li>Apply for leave</li>
        <li>View & update own details</li>
        <li>Upload profile photo</li>
        <li>Chat with Manager only</li>
        <li>Receive message notification (dot alert)</li>
      </ul>
    </div>

    <!-- Security -->
    <div class="mb-4">
      <h3>🔐 Security & Access Control</h3>
      <ul>
        <li>Without login/signup, users cannot access system pages</li>
        <li>Only "Home" and "About Us" pages are publicly accessible</li>
        <li>All other pages require authentication</li>
        <li>Signup request must be approved by CTO before login access</li>
        <li>Role-based dashboard redirection after login</li>
        <li>Password stored in hashed format</li>
        <li>Session-based authentication system</li>
      </ul>
    </div>

    <!-- Communication -->
    <div class="mb-4">
      <h3>💬 Communication System</h3>
      <ul>
        <li>Internal chat system</li>
        <li>CTO ↔ Manager communication</li>
        <li>Manager ↔ Employee communication</li>
        <li>Unread message indicator (dot alert)</li>
      </ul>
    </div>

    <!-- Growth Tracking -->
    <div class="mb-4">
      <h3>📊 Project Management & Growth Tracking</h3>
      <ul>
        <li>Project task progress tracking</li>
        <li>Task allocation system</li>
        <li>Growth tracking managed by Manager</li>
        <li>Tabular view of project progress</li>
        <li>Visual charts for progress representation</li>
        <li>Performance monitoring by CTO</li>
      </ul>
    </div>

    <!-- Technologies -->
    <div class="mb-4">
      <h3>🛠️ Technologies Used</h3>
      <ul>
        <li>PHP (Backend logic & authentication)</li>
        <li>MySQL (Database management)</li>
        <li>HTML5 (Web structure)</li>
        <li>CSS3 (UI design)</li>
        <li>JavaScript & jQuery (Dynamic operations)</li>
        <li>Bootstrap 5 (Responsive UI)</li>
        <li>XAMPP (Local server environment)</li>
        <li>Visual Studio Code (Code editor)</li>
      </ul>
    </div>

    <!-- Academic Info -->
    <div class="mb-4">
      <h3>📚 Academic Information</h3>
      <p>
        Department of Computer Science<br>
        Gujarat University<br>
        5-Year Integrated M.Sc. (Computer Science)<br>
        Semester V
      </p>
    </div>

    <!-- Team -->
    <div class="mb-4">
      <h3>👥 Team Members</h3>
      <ul>
        <li>Sindhav Kishan</li>
        <li>Vaghela Hirensinh</li>
      </ul>
    </div>

    <!-- Duration -->
    <div class="mb-4">
      <h3>📅 Project Duration</h3>
      <p>6 Months</p>
    </div>

    <!-- Future Enhancements -->
    <div class="mb-4">
      <h3>🚀 Future Enhancements</h3>
      <ul>
        <li>Email notification system</li>
        <li>Advanced analytics dashboard</li>
        <li>Real-time chat using WebSockets</li>
        <li>Cloud deployment</li>
        <li>JWT-based authentication</li>
        <li>Two-factor authentication (2FA)</li>
        <li>API integration</li>
        <li>Salary management module</li>
        <li>Mobile responsive improvements</li>
      </ul>
    </div>

  </div>
</section>
<!-- GitHub Repository Section -->
<div class="container my-5">
  <div class="p-5 text-center rounded-4 shadow"
       style="background: linear-gradient(135deg, #24292e, #3a3f44); color: white;">

    <h3 class="fw-bold mb-3">
      🔗 Source Code Available on GitHub
    </h3>

    <p class="mb-4 fs-5">
      <strong>Check the complete source code of the Employee Management System on GitHub Repository.</strong>
    </p>

    <a href="https://github.com/KishanSindhav" target="_blank"
       class="btn btn-light btn-lg fw-semibold px-4 py-2 d-inline-flex align-items-center gap-2"
       style="border-radius: 50px;">

      <!-- GitHub SVG Icon -->
      <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
           class="bi bi-github" viewBox="0 0 16 16">
        <path d="M8 0C3.58 0 0 3.58 0 8a8 8 0 0 0 5.47 7.59c.4.07.55-.17.55-.38
        0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13
        -.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87
        2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95
        0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12
        0 0 .67-.21 2.2.82A7.65 7.65 0 0 1 8 4.69c.68.003 1.37.092
        2.01.27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08
        2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65
        3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2
        0 .21.15.46.55.38A8.01 8.01 0 0 0 16 8c0-4.42-3.58-8-8-8z"/>
      </svg>

      View Repository
    </a>

    <p class="mt-4 mb-0">
      ⭐ If you like this project, don't forget to give it a star on GitHub!
    </p>

  </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</body>
</html>