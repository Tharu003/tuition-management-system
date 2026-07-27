<?php
include 'ad_home.php';
$conn = new mysqli("localhost", "root", "", "sigma_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch students (users)
$students = $conn->query("SELECT id, name FROM users");

// Fetch teachers
$teachers = $conn->query("SELECT teacher_id, full_name FROM teacher");

// Fetch payments with proper JOIN aliases
$payments = $conn->query("
    SELECT 
        p.payment_id, 
        s.name AS student_name, 
        t.full_name AS teacher_name, 
        p.subject, 
        p.amount, 
        p.payment_date, 
        p.payment_month 
    FROM payment p 
    JOIN users s ON p.student_id = id 
    JOIN teacher t ON p.teacher_id = t.teacher_id
");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Payments</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <style>
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
    <div class="container mt-4">
        <h3>Manage Payments</h3>

        <div class="row mb-3">
            <div class="col-md-3">
                <label for="studentFilter" class="form-label">Student:</label>
                <select id="studentFilter" class="form-select">
                    <option value="">All</option>
                    <?php while ($row = $students->fetch_assoc()): ?>
                        <option value="<?= htmlspecialchars($row['name']) ?>"><?= htmlspecialchars($row['name']) ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="teacherFilter" class="form-label">Teacher:</label>
                <select id="teacherFilter" class="form-select">
                    <option value="">All</option>
                    <?php while ($row = $teachers->fetch_assoc()): ?>
                        <option value="<?= htmlspecialchars($row['full_name']) ?>"><?= htmlspecialchars($row['full_name']) ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="monthFilter" class="form-label">Payment Month:</label>
                <input type="text" id="monthFilter" class="form-control" placeholder="e.g., June 2025">
            </div>
        </div>

        <table id="paymentsTable" class="display table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Student</th>
                    <th>Teacher</th>
                    <th>Subject</th>
                    <th>Amount</th>
                    <th>Payment Date</th>
                    <th>Payment Month</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $payments->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['payment_id']) ?></td>
                        <td><?= htmlspecialchars($row['student_name']) ?></td>
                        <td><?= htmlspecialchars($row['teacher_name']) ?></td>
                        <td><?= htmlspecialchars($row['subject']) ?></td>
                        <td><?= htmlspecialchars($row['amount']) ?></td>
                        <td><?= htmlspecialchars($row['payment_date']) ?></td>
                        <td><?= htmlspecialchars($row['payment_month']) ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>


<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    var table = $('#paymentsTable').DataTable();

    $('#studentFilter').on('change', function () {
        table.column(1).search(this.value).draw();
    });

    $('#teacherFilter').on('change', function () {
        table.column(2).search(this.value).draw();
    });

    $('#monthFilter').on('keyup change', function () {
        table.column(6).search(this.value).draw();
    });
});
</script>

</body>
</html>



<?php

$conn = new mysqli("localhost", "root", "", "sigma_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "
    SELECT 
        t.full_name AS teacher_name,
        SUM(p.amount) AS total_amount
    FROM payment p
    JOIN teacher t ON p.teacher_id = t.teacher_id
    WHERE p.payment_month = 'June'
    GROUP BY t.teacher_id
    ORDER BY t.full_name ASC
";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Payments</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
   
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
   
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
</head>
<body>
<div class="container mt-4">
    <h3>June Payments Summary</h3>
    <table id="paymentsTable" class="table table-bordered">
        <thead>
            <tr>
                <th>Teacher Name</th>
                <th>Total Amount</th>
                <th>10% Deduction</th>
                <th>Net Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): 
                $deduction = $row['total_amount'] * 0.10;
                $net_amount = $row['total_amount'] - $deduction;
            ?>
                <tr>
                    <td><?= htmlspecialchars($row['teacher_name']) ?></td>
                    <td><?= number_format($row['total_amount'], 2) ?></td>
                    <td><?= number_format($deduction, 2) ?></td>
                    <td><?= number_format($net_amount, 2) ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
            </div>

<script>
$(document).ready(function() {
    $('#paymentsTable').DataTable({
        "paging": true,
        "searching": true,
        "ordering": true,
        "info": true
    });
});
</script>

</body>
</html>
