<?php
session_start();
include 'dbase.php'; // Make sure this connects properly to $bdd (PDO instance)

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Receive user input
    $full_name = $_POST['full_name'];
    $address = $_POST['address'];
    $dob = $_POST['dob'];
    $whatsapp_no = $_POST['whatsapp_no'];
    $guardian_name = $_POST['guardian_name'];
    $guardian_contact = $_POST['guardian_contact'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = isset($_POST['role']) ? $_POST['role'] : 'student'; 
    $status = 'pending'; 
    $admission_date = date("Y-m-d"); 

    try {
        // Insert into users table
        $stmt1 = $bdd->prepare("INSERT INTO users (name, email, password, role, status,address,dob,whatsapp_no,guardian_name,guardian_contact,admission_date) VALUES (?, ?, ?, ?, ?,?, ?, ?, ?, ?,?)");
        $stmt1->execute([$full_name, $email, $password, $role, $status,$address, $dob, $whatsapp_no, $guardian_name, $guardian_contact, $admission_date]);

        // Insert into student table
        $stmt2 = $bdd->prepare("INSERT INTO student (full_name, address, dob, whatsapp_no, guardian_name, guardian_contact, email, password, admission_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt2->execute([$full_name, $address, $dob, $whatsapp_no, $guardian_name, $guardian_contact, $email, $password, $admission_date]);

        // Success message
        echo '<script>
            alert("Registration successful. Awaiting admin approval.");
            window.location.href = "home.php";
        </script>';
    } catch (PDOException $e) {
        echo '<script>
            alert("Error: ' . $e->getMessage() . '");
            window.location.href = "student_reg.php";
        </script>';
    }
}
?>