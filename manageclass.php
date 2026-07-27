<?php include "ad_home.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Classes</title>
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/select/1.7.0/css/select.dataTables.min.css">

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
    }
  </style>
</head>
<body>

<div class="main-content" id="mainContent">
  <h2>Manage Classes</h2>
  <p>Home / Classes / Manage Classes</p>

  <div class="card">
    <table id="studentTable" class="display nowrap" style="width:100%">
  <thead>
    <tr>
      <th>ID</th>
      <th>Grade</th>
      <th>Teacher Name</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
   <?php
$conn = new mysqli("localhost", "root", "", "sigma_db");

$result = $conn->query("SELECT * FROM class_for_teacher");

while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$row['class_id']}</td>
            <td>{$row['grade']}</td>
            <td>{$row['full_name']}</td>
            <td>
                <a href='edit_class.php?class_id={$row['class_id']}' class='btn btn-sm btn-success'>Edit</a>
                <a href='delete_class.php?class_id={$row['class_id']}' class='btn btn-sm btn-danger' onclick=\"return confirm('Are you sure you want to delete this class?')\">Delete</a>
            </td>
          </tr>";
}
?>

  </tbody>
</table>

  </div>
</div>

<script>
  $(document).ready(function () {
    $('#studentTable').DataTable({
      dom: 'Plfrtip',
      searchPanes: {
        cascadePanes: true,
        viewTotal: true
      },
    });
  });
</script>

</body>
</html>
