<?php
include 'ad_home.php';
$conn = new mysqli("localhost", "root", "", "sigma_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    $conn->query("DELETE FROM resources WHERE id = $id");
    header("Location: manage_resources.php");
    exit();
}

$sql = "SELECT * FROM resources ORDER BY uploaded_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>

  <title>Manage Resources</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <style>
    .main-content {
      margin-left: 80px;
      margin-top: 60px;
      padding: 20px;
      transition: margin-left 0.3s ease;
    }
    .sidebar.active ~ .main-content {
      margin-left: 250px;
    }
    </style>
</head>
<body>
    <div class="main-content" id="mainContent">
<div class="container mt-5">
  <h2 class="mb-4">Admin: Manage Resources</h2>
  <table id="resourceTable" class="table table-striped">
    <thead>
      <tr>
        <th>Title</th>
        <th>Type</th>
        <th>Date</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    <?php while($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($row['title']) ?></td>
        <td><?= htmlspecialchars($row['type']) ?></td>
        <td><?= $row['uploaded_at'] ?></td>
        <td>
          <?php if ($row['type'] == 'link'): ?>
            <a href="<?= $row['link_url'] ?>" class="btn btn-sm btn-primary" target="_blank">Visit</a>
          <?php else: ?>
            <a href="uploads/<?= $row['file_path'] ?>" class="btn btn-sm btn-success" target="_blank">Download</a>
          <?php endif; ?>
          <a href="manage_resources.php?delete_id=<?= $row['id'] ?>" onclick="return confirm('Delete this resource?')" class="btn btn-sm btn-danger">Delete</a>
        </td>
      </tr>
    <?php endwhile; ?>
    </tbody>
  </table>
</div>

<!-- JS -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
  $(document).ready(function () {
    $('#resourceTable').DataTable();
  });
</script>
</body>
</html>
