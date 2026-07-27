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
      margin-right: 955px;
    }

    .right_area {
      display: flex;
      align-items: center;
      color: darkblue;
      font-size: 18px;
      font-weight: 700;
    }

    .sidebar {
      background: #f8f9fa;
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

    .sidebar a {
      display: block;
      color: blue;
      padding: 15px 20px;
      text-decoration: none;
      font-size: 18px;
    }

    .sidebar a:hover {
      background:blue;
      color: white;
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
      <i class="fas fa-user-circle"></i> <span style="margin-left: 10px;">User</span>
    </div>
  </header>

  <div class="sidebar" id="sidebar">
   
    <a href="st_dashboard.php"><i class="fas fa-home"></i> Dashboard</a>
    <a href="aboutus.php"><i class="fas fa-users"></i> About Us</a>
    <a href="teachers.php"><i class="fas fa-chalkboard-teacher"></i> Teachers</a>
    <a href="Time table.php"><i class="fas fa-calendar-alt"></i> Time Table</a>
    <a href="contactus.php"><i class="fas fa-envelope"></i> Contact Us</a>
    <a href="st_resources.php"><i class="fa fa-book" ></i> Resources</a>
     <a href="st_profile.php"><i class="fa fa-user-circle"></i> Profile</a>
    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Log Out</a>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const sidebar = document.getElementById('sidebar');
const sidebarBtn = document.getElementById('sidebar_btn');

sidebarBtn.addEventListener('click', () => {
  sidebar.classList.toggle('active');
});

  </script>

</body>
</html>
