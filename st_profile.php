<?php
include "st_home.php";

session_start();
$conn = new mysqli("localhost", "root", "", "sigma_db");
if ($conn->connect_error) {
    die("DB Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email']) && !isset($_POST['update'])) {
    $email = $_POST['email'];
    $sql = "SELECT * FROM users WHERE email = ? AND role = 'student'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();
    if ($student) {
        $_SESSION['student'] = $student;
    } else {
        $error = "Student not found for the given email.";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $id = $_SESSION['student']['id'];

    $profile_pic = $_SESSION['student']['profile_pic'] ?? '';

    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['profile_pic']['tmp_name'];
        $fileName = $_FILES['profile_pic']['name'];
        $fileSize = $_FILES['profile_pic']['size'];
        $fileType = $_FILES['profile_pic']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $allowedfileExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($fileExtension, $allowedfileExtensions)) {
            $newFileName = 'profile_' . $id . '_' . time() . '.' . $fileExtension;
            $uploadFileDir = './uploads/';
            if (!is_dir($uploadFileDir)) {
                mkdir($uploadFileDir, 0755, true);
            }
            $dest_path = $uploadFileDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                if (!empty($profile_pic) && file_exists($uploadFileDir . $profile_pic)) {
                    unlink($uploadFileDir . $profile_pic);
                }
                $profile_pic = $newFileName;
            } else {
                $error = 'There was some error moving the file to upload directory.';
            }
        } else {
            $error = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
        }
    }

    if (isset($_POST['delete_pic']) && $_POST['delete_pic'] == '1') {
        if (!empty($profile_pic) && file_exists('./uploads/' . $profile_pic)) {
            unlink('./uploads/' . $profile_pic);
        }
        $profile_pic = '';
    }

    $address = $_POST['address'];
    $dob = $_POST['dob'];
    $whatsapp_no = $_POST['whatsapp_no'];
    $guardian_name = $_POST['guardian_name'];
    $guardian_contact = $_POST['guardian_contact'];
    $admission_date = $_POST['admission_date'];

    $sql = "UPDATE users SET address=?, dob=?, whatsapp_no=?, guardian_name=?, guardian_contact=?, admission_date=?, profile_pic=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssi", $address, $dob, $whatsapp_no, $guardian_name, $guardian_contact, $admission_date, $profile_pic, $id);

    if ($stmt->execute()) {
        $res = $conn->query("SELECT * FROM users WHERE id = $id");
        $_SESSION['student'] = $res->fetch_assoc();
        $success = "Profile updated successfully.";
    } else {
        $error = "Failed to update profile.";
    }
}

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: st_profile.php");
    exit();
}

$editMode = isset($_GET['edit']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .main-content { margin-top: 60px; padding: 20px; }
        .card { border-radius: 15px; margin-bottom: 30px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08); }
        .table th { background-color: #f1f1f1; font-weight: bold; }
        .btn { border-radius: 8px; }
        .profile-pic { width: 120px; height: 120px; object-fit: cover; border-radius: 50%; box-shadow: 0 0 8px rgba(0,0,0,0.2); }
        .main-content {
            margin-left: 80px;
            margin-top: 60px;
            padding: 20px;
            transition: margin-left 0.3s ease;
        }
        .sidebar.active ~ .main-content {
            margin-left: 250px;
        }
    </style>
</head>
<body>
<div class="main-content" id="mainContent">
<div class="container main-content">

<?php if (!isset($_SESSION['student'])): ?>
    <div class="col-md-6 offset-md-3">
        <h3 class="text-center mb-4">Enter Student Email</h3>
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <form method="POST" class="bg-white p-4 shadow rounded">
            <div class="mb-3">
                <label>Email Address</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <button class="btn btn-success w-100">View Profile</button>
        </form>
    </div>
<?php else: ?>
    <?php $s = $_SESSION['student']; ?>
    <?php
        $student_id = $s['id'];
        $enrolled_subjects = [];
        $sub_sql = "SELECT subject.name FROM enrollments JOIN subject ON enrollments.subject_id = subject.subject_id WHERE enrollments.student_id = ?";
        $sub_stmt = $conn->prepare($sub_sql);
        $sub_stmt->bind_param("i", $student_id);
        $sub_stmt->execute();
        $sub_result = $sub_stmt->get_result();
        while ($row = $sub_result->fetch_assoc()) {
            $enrolled_subjects[] = $row['name'];
        }

        $payment_history = [];
        $payment_sql = "SELECT p.amount, p.payment_date, p.payment_month, p.subject, t.full_name AS teacher_name FROM payment p LEFT JOIN teacher t ON p.teacher_id = t.teacher_id WHERE p.student_id = ?";
        $payment_stmt = $conn->prepare($payment_sql);
        $payment_stmt->bind_param("i", $student_id);
        $payment_stmt->execute();
        $payment_result = $payment_stmt->get_result();
        while ($row = $payment_result->fetch_assoc()) {
            $payment_history[] = $row;
        }

        $profile_pic = '';
        if (!empty($s['profile_pic']) && file_exists("uploads/" . $s['profile_pic'])) {
            $profile_pic = "uploads/" . $s['profile_pic'];
        } else {
            $profile_pic = "https://ui-avatars.com/api/?name=" . urlencode($s['name']) . "&background=0D8ABC&color=fff&size=128&rounded=true";
        }
    ?>

    <div class="card p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">Student Profile: <?= htmlspecialchars($s['name']) ?></h4>
            <div>
                <?php if ($editMode): ?>
                    <a href="st_profile.php" class="btn btn-secondary">Cancel</a>
                <?php else: ?>
                    <a href="?edit=1" class="btn btn-primary">Edit Profile</a>
                <?php endif; ?>
                <a href="?logout=1" class="btn btn-danger">Logout</a>
            </div>
        </div>

        <?php if (!empty($success)): ?>
            <div class="alert alert-success"><?= $success ?></div>
        <?php endif; ?>
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <?php if ($editMode): ?>
            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="update" value="1">
                <div class="mb-3 d-flex align-items-center gap-3">
                    <img src="<?= $profile_pic ?>" alt="Profile Picture" class="profile-pic">
                    <div>
                        <label for="profile_pic" class="form-label mb-1">Upload New Profile Picture</label>
                        <input type="file" name="profile_pic" id="profile_pic" class="form-control" accept=".jpg,.jpeg,.png,.gif">
                        <?php if (!empty($s['profile_pic'])): ?>
                            <div class="form-check mt-2">
                                <input type="checkbox" name="delete_pic" value="1" class="form-check-input" id="deletePicCheck">
                                <label for="deletePicCheck" class="form-check-label">Delete current picture</label>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <table class="table table-bordered">
                    <tr><th>Email</th><td><?= htmlspecialchars($s['email']) ?></td></tr>
                    <tr><th>Address</th><td><input type="text" name="address" class="form-control" value="<?= htmlspecialchars($s['address']) ?>"></td></tr>
                    <tr><th>Date of Birth</th><td><input type="date" name="dob" class="form-control" value="<?= htmlspecialchars($s['dob']) ?>"></td></tr>
                    <tr><th>WhatsApp No</th><td><input type="text" name="whatsapp_no" class="form-control" value="<?= htmlspecialchars($s['whatsapp_no']) ?>"></td></tr>
                    <tr><th>Guardian Name</th><td><input type="text" name="guardian_name" class="form-control" value="<?= htmlspecialchars($s['guardian_name']) ?>"></td></tr>
                    <tr><th>Guardian Contact</th><td><input type="text" name="guardian_contact" class="form-control" value="<?= htmlspecialchars($s['guardian_contact']) ?>"></td></tr>
                    <tr><th>Admission Date</th><td><input type="date" name="admission_date" class="form-control" value="<?= htmlspecialchars($s['admission_date']) ?>"></td></tr>
                </table>
                <button class="btn btn-success">Update Profile</button>
            </form>
        <?php else: ?>
            <div class="mb-3">
                <img src="<?= $profile_pic ?>" alt="Profile Picture" class="profile-pic mb-3">
            </div>
            <table class="table table-bordered">
                <tr><th>Email</th><td><?= $s['email'] ?></td></tr>
                <tr><th>Address</th><td><?= $s['address'] ?? 'N/A' ?></td></tr>
                <tr><th>Date of Birth</th><td><?= $s['dob'] ?? 'N/A' ?></td></tr>
                <tr><th>WhatsApp No</th><td><?= $s['whatsapp_no'] ?? 'N/A' ?></td></tr>
                <tr><th>Guardian Name</th><td><?= $s['guardian_name'] ?? 'N/A' ?></td></tr>
                <tr><th>Guardian Contact</th><td><?= $s['guardian_contact'] ?? 'N/A' ?></td></tr>
                <tr><th>Admission Date</th><td><?= $s['admission_date'] ?? 'N/A' ?></td></tr>
            </table>
        <?php endif; ?>
    </div>

    <div class="card p-4">
        <h5 class="mb-3">Enrolled Subjects</h5>
        <?php if (!empty($enrolled_subjects)): ?>
            <ul>
                <?php foreach ($enrolled_subjects as $subject): ?>
                    <li><?= htmlspecialchars($subject) ?></li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No subjects enrolled.</p>
        <?php endif; ?>
    </div>

    <div class="card p-4">
        <h5 class="mb-3">Payment History</h5>
        <?php if (!empty($payment_history)): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Teacher</th>
                        <th>Amount</th>
                        <th>Payment Date</th>
                        <th>Month</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($payment_history as $payment): ?>
                        <tr>
                            <td><?= htmlspecialchars($payment['subject']) ?></td>
                            <td><?= htmlspecialchars($payment['teacher_name'] ?? 'N/A') ?></td>
                            <td>Rs. <?= number_format($payment['amount'], 2) ?></td>
                            <td><?= htmlspecialchars($payment['payment_date']) ?></td>
                            <td><?= htmlspecialchars($payment['payment_month']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No payment records found.</p>
        <?php endif; ?>
    </div>
<?php endif; ?>
</div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const emailForm = document.querySelector('form');
    if (emailForm) {
        emailForm.addEventListener('submit', function(event) {
            const emailInput = emailForm.querySelector('input[name="email"]');
            const emailValue = emailInput.value;
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(emailValue)) {
                event.preventDefault();
                alert("Please enter a valid email address.");
            }
        });
    }
});
</script>
</body>
</html>
