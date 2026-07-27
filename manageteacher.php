<?php include "ad_home.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Manage Teachers</title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/select/1.7.0/css/select.dataTables.min.css" />

  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>

  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      padding: 20px;
    }
    .card {
      background-color: #fff;
      margin: auto;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 8px 16px rgba(0,0,0,0.1);
    }
    .main-content {
      margin-left: 80px;
      margin-top: 60px;
      padding: 20px;
      transition: margin-left 0.3s ease;
    }
    .sidebar.active ~ .main-content {
      margin-left: 250px;
    }
    .main-content h2 {
      font-size: 30px;
      color: rgb(22, 8, 87);
      margin-bottom: 10px;
    }
    img.teacher-photo {
      width: 60px;
      height: 60px;
      object-fit: cover;
      border-radius: 50%;
    }
  </style>
</head>
<body>

<div class="main-content" id="mainContent">
  <h2>Manage Teachers</h2>
  <p>Home / Teachers / Manage Teachers</p>

  <div class="card">
    <table id="teacherTable" class="display nowrap" style="width:100%">
      <thead>
        <tr>
          <th>Photo</th>
          <th>ID</th>
          <th>Full Name</th>
          <th>Address</th>
          <th>Date of Birth</th>
          <th>Contact No</th>
          <th>Email</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
      
        $conn = new mysqli("localhost", "root", "", "sigma_db");
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        $result = $conn->query("SELECT * FROM teacher");
        if ($result) {
          while ($row = $result->fetch_assoc()) {
            $photoPath = !empty($row['photo']) ? "uploads/{$row['photo']}" : "default.png";
            echo "<tr>
              <td><img src='$photoPath' class='teacher-photo' alt='Photo'></td>
              <td>{$row['teacher_id']}</td>
              <td>{$row['full_name']}</td>
              <td>{$row['address']}</td>
              <td>{$row['dob']}</td>
              <td>{$row['contact_no']}</td>
              <td>{$row['email']}</td>
              <td>
                <a href='edit_teacher.php?teacher_id={$row['teacher_id']}' class='btn btn-sm btn-success'>Edit</a>
                <a href='delete_teacher.php?teacher_id={$row['teacher_id']}' class='btn btn-sm btn-danger' onclick=\"return confirm('Are you sure?')\">Delete</a>
              </td>
            </tr>";
          }
        } else {
          echo "<tr><td colspan='8'>No teachers found.</td></tr>";
        }
        $conn->close();
        ?>
      </tbody>
    </table>
  </div>
</div>

<script>
  $(document).ready(function () {
    $('#teacherTable').DataTable({
      responsive: true
    });
  });
</script>

</body>
</html>