<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "sigma_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch teachers for the dropdown
$teachers = $conn->query("SELECT teacher_id, full_name FROM teacher");

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $teacher_id = $_POST['teacher_id'];
    $payment_month = $_POST['payment_month'];
    $total_amount = $_POST['total_amount'];

    // Calculate 10% deduction
    $deduction = $total_amount * 0.10;
    $net_amount = $total_amount - $deduction;

    // Insert payment record
    $stmt = $conn->prepare("INSERT INTO teacher_payments (teacher_id, payment_month, total_amount, deduction, net_amount, payment_date) VALUES (?, ?, ?, ?, ?, NOW())");
    $stmt->bind_param("isddd", $teacher_id, $payment_month, $total_amount, $deduction, $net_amount);
    $stmt->execute();
    $stmt->close();

    $message = "✅ Payment submitted successfully!";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Submit Teacher Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h3>Submit Teacher Payment</h3>

    <?php if (!empty($message)): ?>
        <div class="alert alert-success"><?= $message ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Teacher</label>
            <select name="teacher_id" class="form-select" required>
                <option value="">Select Teacher</option>
                <?php while($row = $teachers->fetch_assoc()): ?>
                    <option value="<?= $row['teacher_id'] ?>"><?= $row['full_name'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Payment Month</label>
            <input type="text" name="payment_month" class="form-control" placeholder="e.g., June 2025" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Total Amount</label>
            <input type="number" step="0.01" name="total_amount" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Submit Payment</button>
    </form>
</div>
</body>
</html>
