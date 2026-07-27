<?php include "st_home.php";
?>
<?php
$conn = new mysqli("localhost", "root", "", "sigma_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM teacher";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Our Teachers</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f9f9f9;
            margin: 0;
            padding: 20px;
        }
        h2{
          font-size: 3em;
        }
        .teacher-container {
            display: flex;
            flex-wrap: wrap;
            gap: 25px;
            justify-content: center;
        }
        .teacher-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            width: 300px;
            height: 375px;
            text-align: center;
            padding: 20px;
            transition: transform 0.3s ease;
        }
        .teacher-card:hover {
            transform: translateY(-5px);
        }
        .teacher-card img {
            width: 175px;
            height: 175px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
        }
        .teacher-card h3 {
            margin: 10px 0 5px;
            color: #222;
        }
        .teacher-card p {
            color: #666;
            margin: 0 0 10px;
        }
        .teacher-card a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
            display: inline-block;
            margin-top: 10px;
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
      
    </style>
</head>
<body>
<div class="main-content" id="mainContent">
<h2 style="text-align:center;">Our Teachers</h2><br><br>
<div class="teacher-container">
<?php
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $imagePath = "uploads/" . htmlspecialchars($row['photo']);
        echo "<div class='teacher-card'>
                <img src='$imagePath' alt='Teacher Photo'>
                <h3>" . htmlspecialchars($row['full_name']) . "</h3>
                <p>" . htmlspecialchars($row['qualification']) . "</p>
                <a href='teacher_profile.php?teacher_id=" . $row['teacher_id'] . "'>View Profile</a>
              </div>";
    }
} else {
    echo "<p>No teachers available.</p>";
}
$conn->close();
?>
</div>
</div>
<?php include 'footer.php';
?>
</body>
</html>