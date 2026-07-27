<?php
include 'db.php';
include 'ad_home.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $teacher_id = mysqli_real_escape_string($conn, $_POST['teacher_id']);
    $subject_id = mysqli_real_escape_string($conn, $_POST['subject_id']);
    $grade = mysqli_real_escape_string($conn, $_POST['grade']);
    $schedule = mysqli_real_escape_string($conn, $_POST['schedule']);

   
    $sql_class = "SELECT class_id FROM class WHERE grade = '$grade' LIMIT 1";
    $res_class = mysqli_query($conn, $sql_class);

    if ($res_class && mysqli_num_rows($res_class) > 0) {
        $row_class = mysqli_fetch_assoc($res_class);
        $class_id = $row_class['class_id'];

     
        $sql_insert = "INSERT INTO teach_sub_reg (teacher_id, class_id, subject_id, schedule)
                       VALUES ('$teacher_id', '$class_id', '$subject_id', '$schedule')";

        if (mysqli_query($conn, $sql_insert)) {
            $message = "Data successfully saved!";
        } else {
            $message = "Error: " . mysqli_error($conn);
        }
    } else {
        $message = "Grade not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Assign Schedule</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
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
<?php include "check_nav.php"; ?>
<div class="container mt-5">
  <h2>Assign Schedule</h2>

  <?php if ($message): ?>
    <div class="alert alert-info"><?= htmlspecialchars($message) ?></div>
  <?php endif; ?>

  <form method="POST" action="">
  
    <div class="mb-3">
      <label for="teacher" class="form-label">Choose Teacher:</label>
      <select class="form-select" id="teacher" name="teacher_id" required>
        <option value="">-- Select Teacher --</option>
        <?php
        $sql = "SELECT teacher_id, full_name FROM teacher";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<option value='{$row['teacher_id']}'>{$row['full_name']}</option>";
        }
        ?>
      </select>
    </div>

    <div class="mb-3">
      <label for="subject" class="form-label">Choose Subject:</label>
      <select class="form-select" id="subject" name="subject_id" required>
        <option value="">-- Select Subject --</option>
        <?php
        $sql = "SELECT subject_id, name FROM subject";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<option value='{$row['subject_id']}'>{$row['name']}</option>";
        }
        ?>
      </select>
    </div>

   
    <div class="mb-3">
      <label for="grade" class="form-label">Choose Grade:</label>
      <select class="form-select" id="grade" name="grade" required>
        <option value="">-- Select Grade --</option>
        <?php
        $sql = "SELECT class_id, grade FROM class";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<option value='{$row['grade']}'>{$row['grade']}</option>";
        }
        ?>
      </select>
    </div>

   
    <div class="mb-3">
      <label for="schedule" class="form-label">Enter Schedule:</label>
      <input type="text" class="form-control" id="schedule" name="schedule" placeholder="e.g., Monday 9AM - 11AM" required />
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
