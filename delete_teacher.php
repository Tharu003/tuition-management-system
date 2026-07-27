<?php
$conn = new mysqli("localhost", "root", "", "sigma_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['teacher_id'])) {
    $teacher_id = intval($_GET['teacher_id']);

    $sql = "DELETE FROM teacher WHERE teacher_id = $teacher_id";

    if ($conn->query($sql) === TRUE) {
        header("Location: manageteacher.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}
?>
