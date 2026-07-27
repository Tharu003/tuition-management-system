<?php
$conn = new mysqli("localhost", "root", "", "sigma_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['subject_id'])) {
    $subject_id = $conn->real_escape_string($_GET['subject_id']);
    $sql_delete = "DELETE FROM subject WHERE subject_id='$subject_id'";
    if ($conn->query($sql_delete) === TRUE) {
        header("Location: managesubject.php?msg=deleted");
        exit();
    } else {
        echo "Error deleting subject: " . $conn->error;
    }
} else {
    echo "Invalid subject ID.";
}
?>
