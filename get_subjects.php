<?php
$conn = new mysqli("localhost", "root", "", "sigma_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['teacher_id'])) {
    $teacher_id = $_GET['teacher_id'];

    $stmt = $conn->prepare("SELECT subject_id, name FROM subject WHERE teacher_id = ?");
    $stmt->bind_param("i", $teacher_id);
    $stmt->execute();
    $result = $stmt->get_result();

    echo '<option value="">Select Subject</option>';
    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['subject_id'] . '">' . htmlspecialchars($row['name']) . '</option>';
    }

    $stmt->close();
}
?>
