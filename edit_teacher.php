<?php
include "ad_home.php";


$conn = new mysqli("localhost", "root", "", "sigma_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$teacher = [];
if (isset($_GET['teacher_id'])) {
    $teacher_id = intval($_GET['teacher_id']);
    $result = $conn->query("SELECT * FROM teacher WHERE teacher_id = $teacher_id");
    if ($result && $result->num_rows > 0) {
        $teacher = $result->fetch_assoc();
    } else {
        echo "Teacher not found.";
        exit();
    }
} else {
    echo "Invalid request.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $contact_no = $_POST['contact_no'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $qualification = $_POST['qualification'];
    $photo = $teacher['photo']; 

    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "uploads/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $photo_name = time() . "_" . basename($_FILES["photo"]["name"]);
        $target_file = $target_dir . $photo_name;
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            $photo = $photo_name;
        }
    }

    $stmt = $conn->prepare("UPDATE teacher SET full_name=?, email=?, contact_no=?, dob=?, address=?, qualification=?, photo=? WHERE teacher_id=?");
    $stmt->bind_param("sssssssi", $full_name, $email, $contact_no, $dob, $address, $qualification, $photo, $teacher_id);

    if ($stmt->execute()) {
        header("Location: manageteacher.php");
        exit();
    } else {
        echo "Error updating: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Edit Teacher</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f4f8;
            margin: 0;
            padding: 40px;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
        }
        .main-content {
            margin-left: 80px;
            margin-top: 60px;
            padding: 20px;
            transition: margin-left 0.3s ease;
        }
        .sidebar.active ~ .main-content {
            margin-left: 250px;
        }
        form {
            background: #fff;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            width: 1000px;
        }
        h2 {
            margin-bottom: 25px;
            color: #161857;
            text-align: center;
        }
        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            color: #444;
        }
        input[type="text"],
        input[type="email"],
        input[type="date"],
        textarea {
            width: 100%;
            padding: 1px 5px;
            margin-bottom: 18px;
            border: 1.8px solid #ccc;
            border-radius: 10px;
            font-size: 15px;
            font-family: inherit;
            transition: border-color 0.3s ease;
            resize: vertical;
            min-height: 50px;
        }
        input[type="file"] {
            margin-bottom: 18px;
        }
        input:focus, textarea:focus {
            border-color: #5baaef;
            outline: none;
            box-shadow: 0 0 6px #5baaefa0;
        }
        button {
            background-color: #07666d;
            color: white;
            border: none;
            border-radius: 10px;
            padding: 12px 20px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #04504f;
        }
        a {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #555;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s ease;
        }
        a:hover {
            color: #07666d;
        }
        img {
            margin-bottom: 10px;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div class="main-content" id="mainContent">
        <form method="post" enctype="multipart/form-data">
            <h2>Edit Teacher</h2>

            <label>Name:</label>
            <input type="text" name="full_name" value="<?= htmlspecialchars($teacher['full_name']) ?>" required>

            <label>Email:</label>
            <input type="email" name="email" value="<?= htmlspecialchars($teacher['email']) ?>" required>

            <label>Contact Number:</label>
            <input type="text" name="contact_no" value="<?= htmlspecialchars($teacher['contact_no']) ?>" required>

            <label>Date of Birth:</label>
            <input type="date" name="dob" value="<?= htmlspecialchars($teacher['dob']) ?>" required>

            <label>Address:</label>
            <textarea name="address" required><?= htmlspecialchars($teacher['address']) ?></textarea>

            <label>Qualification:</label>
            <input type="text" name="qualification" value="<?= htmlspecialchars($teacher['qualification']) ?>" required>

            <label>Current Photo:</label>
            <?php if (!empty($teacher['photo'])): ?>
                <img src="uploads/<?= htmlspecialchars($teacher['photo']) ?>" width="100" height="100">
            <?php else: ?>
                <p>No photo uploaded.</p>
            <?php endif; ?>

            <label>Change Photo:</label>
            <input type="file" name="photo" accept="image/*">

            <button type="submit">Update</button>
            <a href="manageteacher.php">Cancel</a>
        </form>
    </div>
</body>
</html>