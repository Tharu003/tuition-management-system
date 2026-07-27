<?php
include 'st_home.php';
$conn = new mysqli("localhost", "root", "", "sigma_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM resources ORDER BY uploaded_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Student Resources</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
  <h2 class="mb-4">Available Resources</h2>
  <?php if ($result->num_rows > 0): ?>
    <div class="row row-cols-1 row-cols-md-2 g-4">
      <?php while($row = $result->fetch_assoc()): ?>
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title"><?= htmlspecialchars($row['title']) ?></h5>
              <p class="card-text"><?= nl2br(htmlspecialchars($row['description'])) ?></p>
              <?php if ($row['type'] === 'link'): ?>
                <a href="<?= htmlspecialchars($row['link_url']) ?>" target="_blank" class="btn btn-primary">Visit Link</a>
              <?php else: ?>
                <a href="uploads/<?= htmlspecialchars($row['file_path']) ?>" target="_blank" class="btn btn-success">View / Download</a>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  <?php else: ?>
    <p class="alert alert-info">No resources available.</p>
  <?php endif; ?>
</div>
    </div>
<br>

<?php include 'footer.php';?>
</body>
</html>
