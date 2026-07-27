<?php
$conn = new mysqli("localhost", "root", "", "sigma_db");

if (isset($_GET['class_id'])) {
    $class_id = $_GET['class_id'];
    $conn->query("DELETE FROM class WHERE class_id = '$class_id'");
}

header("Location: manageclass.php");
exit();
