
<?php
$conn = new mysqli("localhost", "root", "", "sigma_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $full_name = $conn->real_escape_string($_POST['teacherName']);
    $email = $conn->real_escape_string($_POST['teacherEmail']);
    $contact_no = $conn->real_escape_string($_POST['teacherContact']);
    $dob = $conn->real_escape_string($_POST['teacherdob']);
    $address = $conn->real_escape_string($_POST['teacheradd']);
    $password = password_hash($_POST['teacherpword'], PASSWORD_DEFAULT); 
    $qualification = $conn->real_escape_string($_POST['teacherQualification']);
    
    $targetDir = "uploads/"; 
$photoName = basename($_FILES["teacherPhoto"]["name"]);
$targetFilePath = $targetDir . $photoName;
$imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));


$allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
if (in_array($imageFileType, $allowedTypes)) {
    if (move_uploaded_file($_FILES["teacherPhoto"]["tmp_name"], $targetFilePath)) {
      
        $sql = "INSERT INTO teacher (full_name, email, contact_no, dob, address, password, qualification, photo)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssss", $full_name, $email, $contact_no, $dob, $address, $password, $qualification, $photoName);
    } else {
        echo "Error uploading image.";
        exit();
    }
} else {
    echo "Invalid image type.";
    exit();
}
  
    $sql = "INSERT INTO teacher (full_name, email, contact_no, dob, address, password, qualification) VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("sssssss", $full_name, $email, $contact_no, $dob, $address, $password, $qualification);

    if ($stmt->execute()) {
     
        header("Location: manageteacher.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>
