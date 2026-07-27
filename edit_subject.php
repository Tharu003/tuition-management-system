<?php
$conn = new mysqli("localhost", "root", "", "sigma_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $subject_id = $conn->real_escape_string($_POST['subject_id']);
    $name = $conn->real_escape_string($_POST['name']);

    $sql_update = "UPDATE subject SET name='$name' WHERE subject_id='$subject_id'";
    if ($conn->query($sql_update) === TRUE) {
        header("Location: managesubject.php?msg=updated");
        exit();
    } else {
        echo "Update error: " . $conn->error;
        exit();
    }
}


if (isset($_GET['subject_id'])) {
    $subject_id = $conn->real_escape_string($_GET['subject_id']);
    $result = $conn->query("SELECT * FROM subject WHERE subject_id='$subject_id'");

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Subject not found.";
        exit();
    }
} else {
    echo "Invalid request.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Edit Subject</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      padding: 40px 0;
      display: flex;
      justify-content: center;
      align-items: flex-start;
      min-height: 100vh;
    }
    .card {
      background: white;
      width: 400px;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 8px 16px rgba(0,0,0,0.1);
    }
    h2 {
      text-align: center;
      margin-bottom: 30px;
      color: #161257;
      font-weight: 700;
    }
    label {
      display: block;
      margin-bottom: 8px;
      font-weight: 600;
      color: #333;
    }
    input[type="text"] {
      width: 100%;
      padding: 10px 15px;
      margin-bottom: 20px;
      border: 1.5px solid #ccc;
      border-radius: 12px;
      font-size: 16px;
      transition: border-color 0.3s ease;
    }
    input[type="text"]:focus {
      border-color: #5baaef;
      outline: none;
      box-shadow: 0 0 6px #5baaefaa;
    }
    button {
      width: 100%;
      padding: 12px 0;
      background-color: #077d0d;
      border: none;
      border-radius: 12px;
      color: white;
      font-size: 18px;
      font-weight: 700;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    button:hover {
      background-color: #065a08;
    }
  </style>
</head>
<body>
  <div class="card">
    <h2>Edit Subject</h2>
    <form method="post" action="edit_subject.php">
      <label for="subject_id">Subject ID:</label>
      <input type="text" id="subject_id" name="subject_id"
             value="<?php echo htmlspecialchars($row['subject_id']); ?>" readonly />

      <label for="name">Subject Name:</label>
      <input type="text" id="name" name="name"
             value="<?php echo htmlspecialchars($row['name']); ?>" required />

      <button type="submit">Update</button>
    </form>
  </div>
</body>
</html>
