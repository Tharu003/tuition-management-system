<?php
include 'ad_home.php';
$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = new mysqli("localhost", "root", "", "sigma_db");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $type = $_POST['type'];

    $file_path = null;
    $link_url = null;

    if ($type == 'link') {
        $link_url = trim($_POST['link']);
    } else {
        if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['file']['tmp_name'];
            $fileName = basename($_FILES['file']['name']);
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            $allowedTypes = ['pdf', 'jpg', 'jpeg', 'png'];
            if (!in_array($fileExtension, $allowedTypes)) {
                $message = "Invalid file type. Allowed: PDF, JPG, PNG.";
            } else {
                $newFileName = uniqid() . '.' . $fileExtension;
                $uploadPath = 'uploads/' . $newFileName;

                if (!move_uploaded_file($fileTmpPath, $uploadPath)) {
                    $message = "File upload failed.";
                } else {
                    $file_path = $newFileName;
                }
            }
        } else {
            $message = "File is required for PDF/Image.";
        }
    }

  
    if ($message === "") {
        $stmt = $conn->prepare("INSERT INTO resources (title, description, type, file_path, link_url) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $title, $description, $type, $file_path, $link_url);

        if ($stmt->execute()) {
            $message = "✅ Resource added successfully!";
        } else {
            $message = "DB Error: " . $stmt->error;
        }
        $stmt->close();
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Resource</title>
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
  <h2 class="mb-4">Add New Resource</h2>

  <?php if (!empty($message)): ?>
    <div class="alert alert-info"><?= $message ?></div>
  <?php endif; ?>

  <form action="" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="title" class="form-label">Resource Title</label>
      <input type="text" class="form-control" id="title" name="title" required>
    </div>

    <div class="mb-3">
      <label for="description" class="form-label">Description</label>
      <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
    </div>

    <div class="mb-3">
      <label for="type" class="form-label">Resource Type</label>
      <select class="form-select" id="type" name="type" required>
        <option value="">Select type</option>
        <option value="pdf">PDF</option>
        <option value="image">Image</option>
        <option value="link">External Link</option>
      </select>
    </div>

    <div class="mb-3" id="fileInput">
      <label for="file" class="form-label">Upload File</label>
      <input class="form-control" type="file" id="file" name="file">
    </div>

    <div class="mb-3 d-none" id="linkInput">
      <label for="link" class="form-label">Resource Link</label>
      <input type="url" class="form-control" id="link" name="link">
    </div>

    <button type="submit" class="btn btn-primary">Add Resource</button>
  </form>
</div>

<script>
  const typeSelect = document.getElementById('type');
  const fileInput = document.getElementById('fileInput');
  const linkInput = document.getElementById('linkInput');

  typeSelect.addEventListener('change', function () {
    if (this.value === 'link') {
      linkInput.classList.remove('d-none');
      fileInput.classList.add('d-none');
    } else {
      linkInput.classList.add('d-none');
      fileInput.classList.remove('d-none');
    }
  });
</script>
</body>
</html>
