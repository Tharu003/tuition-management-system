<?php
session_start();


$student_id = $_SESSION['student_id'] ?? null;
if (!$student_id) {
  echo "You must be logged in to edit your profile.";
  exit;
}

$conn = new mysqli("localhost", "root", "", "sigma_db");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $full_name = $_POST['full_name'];
  $email = $_POST['email'];
  $whatsapp_no = $_POST['whatsapp_no'];
  $address = $_POST['address'];
  $dob = $_POST['dob'];
  $guardian_name = $_POST['guardian_name'];
  $guardian_contact = $_POST['guardian_contact'];

  
  $profile_pic = null;
  if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['profile_pic']['tmp_name'];
    $fileName = basename($_FILES['profile_pic']['name']);
    $uploadPath = "uploads/" . time() . "_" . $fileName;

    $allowedExt = ['jpg', 'jpeg', 'png'];
    $ext = strtolower(pathinfo($uploadPath, PATHINFO_EXTENSION));
    if (in_array($ext, $allowedExt)) {
      move_uploaded_file($fileTmpPath, $uploadPath);
      $profile_pic = $uploadPath;
    }
  }

  
  $query = $profile_pic
    ? "UPDATE Student SET full_name=?, email=?, whatsapp_no=?, address=?, dob=?, guardian_name=?, guardian_contact=?, profile_pic=? WHERE st_id=?"
    : "UPDATE Student SET full_name=?, email=?, whatsapp_no=?, address=?, dob=?, guardian_name=?, guardian_contact=? WHERE st_id=?";

  $stmt = $conn->prepare($query);

  if ($profile_pic) {
    $stmt->bind_param("ssssssssi", $full_name, $email, $whatsapp_no, $address, $dob, $guardian_name, $guardian_contact, $profile_pic, $student_id);
  } else {
    $stmt->bind_param("sssssssi", $full_name, $email, $whatsapp_no, $address, $dob, $guardian_name, $guardian_contact, $student_id);
  }

  if ($stmt->execute()) {
    header("Location: student_profile.php");
    exit;
  } else {
    echo "Error updating profile: " . $stmt->error;
  }
}


$stmt = $conn->prepare("SELECT * FROM Student WHERE st_id = ?");
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();
if (!$student) {
  echo "Student not found.";
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Profile</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .form-container {
      max-width: 700px;
      margin: 40px auto;
      background: #fff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
    }
    h2 {
      color: #1c0b6c;
    }
  </style>
</head>
<body>

<div class="container form-container">
  <h2>Edit Your Profile</h2>
  <form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
      <label>Full Name</label>
      <input type="text" name="full_name" class="form-control" value="<?= htmlspecialchars($student['full_name']) ?>" required>
    </div>
    <div class="mb-3">
      <label>Email</label>
      <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($student['email']) ?>" required>
    </div>
    <div class="mb-3">
      <label>WhatsApp Number</label>
      <input type="text" name="whatsapp_no" class="form-control" value="<?= htmlspecialchars($student['whatsapp_no']) ?>" required>
    </div>
    <div class="mb-3">
      <label>Address</label>
      <input type="text" name="address" class="form-control" value="<?= htmlspecialchars($student['address']) ?>" required>
    </div>
    <div class="mb-3">
      <label>Date of Birth</label>
      <input type="date" name="dob" class="form-control" value="<?= htmlspecialchars($student['dob']) ?>" required>
    </div>
    <div class="mb-3">
      <label>Guardian Name</label>
      <input type="text" name="guardian_name" class="form-control" value="<?= htmlspecialchars($student['guardian_name']) ?>" required>
    </div>
    <div class="mb-3">
      <label>Guardian Contact</label>
      <input type="text" name="guardian_contact" class="form-control" value="<?= htmlspecialchars($student['guardian_contact']) ?>" required>
    </div>
    <div class="mb-3">
      <label>Profile Picture (optional)</label><br>
      <?php if (!empty($student['profile_pic'])): ?>
        <img src="<?= htmlspecialchars($student['profile_pic']) ?>" width="100" class="mb-2 rounded-circle"><br>
      <?php endif; ?>
      <input type="file" name="profile_pic" accept=".jpg,.jpeg,.png">
    </div>
    <button type="submit" class="btn btn-success">Update Profile</button>
    <a href="st_profile.php" class="btn btn-secondary">Cancel</a>
  </form>
</div>

</body>
</html>

<?php $conn->close(); ?>
