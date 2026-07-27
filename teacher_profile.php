<?php

$conn = new mysqli("localhost", "root", "", "sigma_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (!isset($_GET['teacher_id'])) {
    echo "Invalid request.";
    exit();
}
$teacher_id = intval($_GET['teacher_id']);


$stmt = $conn->prepare("SELECT * FROM teacher WHERE teacher_id = ?");
$stmt->bind_param("i", $teacher_id);
$stmt->execute();
$teacher = $stmt->get_result()->fetch_assoc();
if (!$teacher) {
    echo "Teacher not found.";
    exit();
}


$sub_sql = "
    SELECT s.name
    FROM Te_teach_sub tts
    JOIN Subject s ON s.subject_id = tts.subject_id
    WHERE tts.teacher_id = ?
    ORDER BY s.name
";
$sub_stmt = $conn->prepare($sub_sql);
$sub_stmt->bind_param("i", $teacher_id);
$sub_stmt->execute();
$sub_res = $sub_stmt->get_result();

$subjects = [];
while ($row = $sub_res->fetch_assoc()) {
    $subjects[] = $row['name'];          
}
?>
<?php include "st_home.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Teacher Profile</title>
<style>
  body{
    font-family:'Segoe UI',sans-serif;
    background:#f4f4f4;
    padding:40px;
    display:flex;
    justify-content:center
  }
  .main-content{
    margin-left:80px;
    margin-top:60px;
    padding:20px
  }
  .profile-card{
    background:#fff;
    border-radius:12px;
    box-shadow:0 6px 18px rgba(0,0,0,.1);
    padding:40px 60px;
    max-width:1000px;
    width:100%;
  }
  h2{
    text-align:center;
    color:#2c3e50;
    margin-bottom:20px;
  }
  .info{
    margin:10px 0;
    font-size:16px;
  }
  .info strong{
    color:#555;
  }
  .badge{
    display:inline-block;
    background:#3498db;
    color:#fff;
    padding:6px 12px;
    border-radius:20px;
    margin:5px 8px 0 0;
    font-size:14px;
  }
  img{
    display:block;
    margin:0 auto 20px;
    width:300px;
    height:400px;
    border-radius:12px;
    object-fit:cover;
  }
  a{
    display:inline-block;
    margin-top:20px;
    text-decoration:none;
    color:#2980b9;
    }
</style>
</head>
<body>
  <div class="main-content">
    <div class="profile-card">
      
      <img src="uploads/<?= htmlspecialchars($teacher['photo']) ?>" alt="Teacher Photo">
      <h2><?= htmlspecialchars($teacher['full_name']) ?></h2>

      
      <div class="info"><strong>Subjects:</strong><br>
        <?php if ($subjects): ?>
            <?php foreach ($subjects as $sub): ?>
              <span class="badge"><?= htmlspecialchars($sub) ?></span>
            <?php endforeach; ?>
        <?php else: ?>
            <span style="color:gray">No subjects assigned</span>
        <?php endif; ?>
      </div>
      <p class="info"><strong>Contact No:</strong> <?= htmlspecialchars($teacher['contact_no']) ?></p>
      <p class="info"><strong>Qualification:</strong> <?= htmlspecialchars($teacher['qualification']) ?></p>

      

      <a href="teachers.php">← Back to Teachers</a>
    </div>
  </div>
</body>
</html>
