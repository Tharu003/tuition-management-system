<?php include "ad_home.php"; ?>
<?php
$conn = new mysqli("localhost", "root", "", "sigma_db");

if (isset($_GET['class_id'])) {
    $class_id = $_GET['class_id'];
    $result = $conn->query("SELECT * FROM class WHERE class_id = '$class_id'");
    $row = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $class_id = $_POST['class_id'];
    $grade = $_POST['grade'];

    $conn->query("UPDATE class SET grade = '$grade' WHERE class_id = '$class_id'");
    header("Location: manageclass.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Class</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
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
<body class="p-4">
    <div class="main-content" id="mainContent">
    <div class="container">
        <h2>Edit Class</h2>
        <form method="POST">
            <div class="form-group">
                <label>Class ID</label>
                <input type="text" name="class_id" class="form-control" value="<?= $row['class_id'] ?>" readonly>
            </div>
            <div class="form-group">
                <label>Grade</label>
                <input type="text" name="grade" class="form-control" value="<?= $row['grade'] ?>" required>
            </div>
            <button type="submit" class="btn btn-success">Update</button>
            <a href="manageclass.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
