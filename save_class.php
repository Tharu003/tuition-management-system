<?php
$conn = new mysqli("localhost", "root", "", "sigma_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $class_id = $_POST['classid'];
    $grade = $_POST['grade'];

    $sql = "INSERT INTO class (class_id, grade) VALUES ('$class_id', '$grade')";
    if ($conn->query($sql) === TRUE) {
        header("Location: manageclass.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
