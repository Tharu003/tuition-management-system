<?php
include 'dbase.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $bdd->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['user_id'];
    $full_name = $_POST['full_name'];
    $address = $_POST['address'];
    $dob = $_POST['dob'];
    $whatsapp_no = $_POST['whatsapp_no'];
    $guardian_name = $_POST['guardian_name'];
    $guardian_contact = $_POST['guardian_contact'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Insert into student table
    $stmt = $bdd->prepare("INSERT INTO student (full_name, address, dob, whatsapp_no, guardian_name, guardian_contact, email, password, admission_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())");
    $stmt->execute([$full_name, $address, $dob, $whatsapp_no, $guardian_name, $guardian_contact, $email, $password]);

    // Update users table
    $update = $bdd->prepare("UPDATE users SET status = 'approved' WHERE id = ?");
    $update->execute([$id]);

    echo "<script>alert('Student approved and added successfully!'); window.location.href='ad_dashboard.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Complete Student Registration</title>
</head>
<body>
    <h2>Complete Student Registration</h2>
    <form method="post">
        <input type="hidden" name="user_id" value="<?= $user['id'] ?>">

        <label>Full Name:</label>
        <input type="text" name="full_name" value="<?= htmlspecialchars($user['name']) ?>" required><br>

        <label>Address:</label>
        <input type="text" name="address" value="<?= htmlspecialchars($user['address'] ?? '') ?>" required><br>

        <label>Date of Birth:</label>
        <input type="date" name="dob" value="<?= htmlspecialchars($user['dob'] ?? '') ?>" required><br>

        <label>WhatsApp No:</label>
        <input type="text" name="whatsapp_no" value="<?= htmlspecialchars($user['whatsapp_no'] ?? '') ?>" required><br>

        <label>Guardian Name:</label>
        <input type="text" name="guardian_name" value="<?= htmlspecialchars($user['guardian_name'] ?? '') ?>" required><br>

        <label>Guardian Contact:</label>
        <input type="text" name="guardian_contact" value="<?= htmlspecialchars($user['guardian_contact'] ?? '') ?>" required><br>

        <label>Email:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required><br>

        <label>Password:</label>
        <input type="text" name="password" value="<?= htmlspecialchars($user['password']) ?>" required><br>

        <button type="submit">Approve & Save Student</button>
    </form>
</body>
</html>
