<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sigma Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"/>

  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: "Roboto", sans-serif;
    }

    header {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 60px;
      background: white;
      z-index: 1000;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 20px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .left_area {
      display: flex;
      align-items: center;
    }

    .left_area img {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      margin-right: 10px;
    }

    .left_area h3 {
      color: darkblue;
      margin: 0;
      text-transform: uppercase;
      font-size: 22px;
      font-weight: 900;
      
    }

    #sidebar_btn {
      font-size: 24px;
      color: darkblue;
      cursor: pointer;
      margin-left: 50px;
    }

    .right_area {
      display: flex;
      align-items: center;
      color: darkblue;
      font-size: 18px;
      font-weight: 700;
      margin-left:auto;
    }

    .sidebar {
      background:rgb(255, 255, 255);
      position: fixed;
      top: 0;
      left: -250px;
      width: 250px;
      height: 100%;
      padding-top: 60px;
      box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
      transition: left 0.3s ease;
      z-index: 999;
    }

    .sidebar.active {
      left: 0;
    }

    .sidebar ul {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .sidebar ul li {
      position: relative;
    }

    .sidebar ul li a,
    .dropdown-btn {
      display: flex;
      align-items: center;
      padding: 12px 20px;
      text-decoration: none;
      color: blue;
      background-color: white;
      border: none;
      width: 100%;
      text-align: left;
      cursor: pointer;
      font-size: 16px;
    }

    .sidebar ul li a:hover,
    .dropdown-btn:hover {
      background-color: blue;
      color: white;
    }

   .submenu {
  display: none;
  padding-left: 10px;
  border-left: 25px solid rgb(255, 255, 255); 
  background-color: #f0f0f0;
}

   .submenu li a {
  padding: 30px 20px 10px 60px; 
  font-size: 15px;
  color: #333;
  display: block;
}


    .submenu li a:hover {
      background-color: #007bff;
      color: white;
    }

    .fas {
      margin-right: 10px;
    }

    .fa-chevron-down {
      margin-left: auto;
    }
  </style>
</head>
<body>

  <header>
    <div class="left_area">
      <img src="images/logo.png" alt="Logo">
      <h3>Sigma</h3>
    </div>
    <i class="fas fa-bars" id="sidebar_btn"></i>
    <div class="right_area">
      <i class="fas fa-user-circle"></i> <span style="margin-left: 10px;">Admin</span>
    </div>
  </header>

  <div class="sidebar" id="sidebar">
    <ul>
      <li><a href="ad_dashboard.php"><i class="fas fa-home"></i> Home</a></li>

      <li class="dropdown">
        <button class="dropdown-btn"><i class="fas fa-chalkboard-teacher"></i> Teachers <i class="fas fa-chevron-down"></i></button>
        <ul class="submenu">
          <li><a href="addteacher.php"><i class="fas fa-user-plus"></i> Add Teacher</a></li>
          <li><a href="manageteacher.php"><i class="fas fa-tasks"></i> Manage Teacher</a></li>
        </ul>
      </li>

       <li><a href="check.php"><i class="fas fa-user-circle"></i> Assign Schedule</a></li>

      <li class="dropdown">
        <button class="dropdown-btn"><i class="fas fa-book"></i> Subjects <i class="fas fa-chevron-down"></i></button>
        <ul class="submenu">
          <li><a href="addsubject.php"><i class="fas fa-plus-circle"></i> Add Subject</a></li>
          <li><a href="managesubject.php"><i class="fas fa-edit"></i> Manage Subject</a></li>
        </ul>
      </li>

      <li class="dropdown">
        <button class="dropdown-btn"><i class="fas fa-money-check-alt"></i> Payment <i class="fas fa-chevron-down"></i></button>
        <ul class="submenu">
          <li><a href="add_payment.php"><i class="fas fa-dollar-sign"></i> Add Payment</a></li>
          <li><a href="manage_payment.php"><i class="fas fa-file-invoice-dollar"></i> Manage Payment</a></li>
        </ul>
      </li>

      <li class="dropdown">
        <button class="dropdown-btn"><i class="fas fa-money-check-alt"></i> Resources <i class="fas fa-chevron-down"></i></button>
        <ul class="submenu">
          <li><a href="add_resource.php"><i class="fas fa-dollar-sign"></i> Add Resources</a></li>
          <li><a href="manage_resources.php"><i class="fas fa-file-invoice-dollar"></i> Manage Resources</a></li>
        </ul>
      </li>
     
       <li><a href="admin_approval.php"><i class="fas fa-user-circle"></i> Approved Students</a></li>
        <li><a href="admin_request.php"><i class="fas fa-user-circle"></i> Password Reset Request</a></li>
      <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Log Out</a></li>
    </ul>
  </div>

  <script>
    const sidebar = document.getElementById('sidebar');
    const sidebarBtn = document.getElementById('sidebar_btn');
    sidebarBtn.addEventListener('click', () => {
      sidebar.classList.toggle('active');
    });

    const dropdowns = document.querySelectorAll('.dropdown');
    dropdowns.forEach(dropdown => {
      const button = dropdown.querySelector('.dropdown-btn');
      const menu = dropdown.querySelector('.submenu');

      button.addEventListener('click', () => {
        document.querySelectorAll('.submenu').forEach(sub => {
          if (sub !== menu) sub.style.display = 'none';
        });

        const isVisible = menu.style.display === 'block';
        menu.style.display = isVisible ? 'none' : 'block';
      });
    });
  </script>

</body>
</html>
