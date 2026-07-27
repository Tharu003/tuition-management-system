<?php
include "db.php"; 
include "ad_home.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Class</title>
  <style>
  
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      padding: 20px;
    }
    .main-content {
        margin-left: 80px;
        margin-top: 60px;
        padding: 20px;
        transition: margin-left 0.3s ease;
    }
    .main-content h2{
      font-size: 30px;
      margin-left:auto;
      color:rgb(22, 8, 87);
    }
    .card {
      background-color:rgb(255, 255, 255);
      max-width: 500px;
      margin: auto;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 8px 8px rgba(189, 182, 182, 0.1);
    }
    .form-group {
      margin-bottom: 15px;
    }
    .form-group label {
      display: block;
      margin-bottom: 5px;
    }
    select, input[type="text"] {
      width: 100%;
      padding: 10px;
      border-radius: 12px;
      border: 1px solid #ccc;
      background-color: rgb(235, 226, 237);
      height: 40px;
      box-sizing: border-box;
      outline: none;
    }
    select:focus, input[type="text"]:focus {
      border-color: rgb(91, 174, 243);
    }
    .button-group {
      display: flex;
      justify-content: left;
      gap: 15px;
      margin-top: 20px;
    }
    .button-group button {
      width: 100px;
      padding: 8px;
      font-size: 14px;
      border: none;
      border-radius: 10px;
      color: white;
      cursor: pointer;
    }
    .submit-btn {
      background-color: rgb(7, 125, 13);
    }
    .clear-btn {
      background-color: rgb(239, 16, 31);
    }
    .button-group button:hover {
      opacity: 0.9;
    }
  </style>
</head>
<body>

<div class="main-content" id="mainContent">
  <h2>Add Classes</h2>
  <p>Home / Classes / Class For Teacher </p>
  <div class="card">
    
    <form action="save_class.php" method="POST">

      <div class="form-group">
        <label for="grade">Grade:</label>
        <select name="grade" id="grade" required>
          <option value="">-- Select Grade --</option>
          <?php
            $grades = mysqli_query($conn, "SELECT DISTINCT grade FROM class");
            while($grade_row = mysqli_fetch_assoc($grades)) {
                echo "<option value='" . htmlspecialchars($grade_row['grade']) . "'>" . htmlspecialchars($grade_row['grade']) . "</option>";
            }
          ?>
        </select>
      </div>

      <div class="form-group">
        <label for="teacher_id">Teacher Name:</label>
        <select name="teacher_id" id="teacher_id" required>
          <option value="">-- Select Teacher --</option>
          <?php
            $teachers = mysqli_query($conn, "SELECT teacher_id, full_name FROM teacher");
            while($teacher_row = mysqli_fetch_assoc($teachers)) {
                echo "<option value='" . $teacher_row['teacher_id'] . "'>" . htmlspecialchars($teacher_row['full_name']) . "</option>";
            }
          ?>
        </select>
      </div>

      <div class="button-group">
        <button type="submit" class="submit-btn">Submit</button>
        <button type="reset" class="clear-btn">Clear</button>
      </div>
    </form>
  </div>
</div>

</body>
</html>
