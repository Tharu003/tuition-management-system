<?php

$conn = mysqli_connect("localhost", "root", "", "sigma_db");

if (isset($_POST['req_email'])) {
    $email = mysqli_real_escape_string($conn, $_POST['req_email']);


    $sql = "INSERT INTO password_requests (user_email) VALUES ('$email')";
    
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Informed Admin.Please Stay Tunned'); window.location.href='login.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>