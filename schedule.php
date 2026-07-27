<?php
$conn = new mysqli("localhost", "root", "", "sigma_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get selected class (default Grade 7)
$class_id = $_GET['class_id'] ?? 7;

// Fetch all classes for the dropdown
$class_result = $conn->query("SELECT * FROM class");

// Fetch timetable for selected class
$sql = "SELECT t.*, s.name AS name, te.full_name AS name 
        FROM timetable t
        JOIN subject s ON t.subject_id = s.subject_id
        JOIN teacher te ON t.teacher_id = te.teacher_id
        WHERE t.class_id = ?
        ORDER BY FIELD(t.day, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'), t.start_time";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $class_id);
$stmt->execute();
$timetable = $stmt->get_result();

// Group sessions by day
$grouped = [];
while ($row = $timetable->fetch_assoc()) {
    $grouped[$row['day']][] = $row;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Class Timetable</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #eef1f5;
            padding: 40px;
        }
        h2 {
            text-align: center;
            color: #2a2a72;
            margin-bottom: 20px;
        }
        .filter-form {
            text-align: center;
            margin-bottom: 30px;
        }
        select {
            padding: 8px;
            font-size: 16px;
            border-radius: 6px;
        }
        .day-section {
            margin-bottom: 30px;
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 12px rgba(0,0,0,0.1);
        }
        .day-title {
            font-size: 20px;
            color: #1e1e6d;
            margin-bottom: 15px;
        }
        .session {
            display: flex;
            justify-content: space-between;
            border-bottom: 1px solid #ddd;
            padding: 8px 0;
        }
        .session:last-child {
            border-bottom: none;
        }
        .session span {
            flex: 1;
        }
        .no-data {
            text-align: center;
            color: #888;
        }
    </style>
</head>
<body>

<h2>Class Timetable</h2>

<form method="GET" class="filter-form">
    <label>Select Class:
        <select name="class_id" onchange="this.form.submit()">
            <?php while ($cls = $class_result->fetch_assoc()): ?>
                <option value="<?= $cls['class_id'] ?>" <?= ($cls['class_id'] == $class_id) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($cls['name']) ?>
                </option>
            <?php endwhile; ?>
        </select>
    </label>
</form>

<?php if (!empty($grouped)): ?>
    <?php foreach ($grouped as $day => $sessions): ?>
        <div class="day-section">
            <div class="day-title"><?= htmlspecialchars($day) ?></div>
            <?php foreach ($sessions as $session): ?>
                <div class="session">
                    <span><?= date("h:i A", strtotime($session['start_time'])) ?> - <?= date("h:i A", strtotime($session['end_time'])) ?></span>
                    <span><?= htmlspecialchars($session['name']) ?></span>
                    <span><?= htmlspecialchars($session['name']) ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <div class="no-data">No timetable available for this class.</div>
<?php endif; ?>

</body>
</html>

<?php $conn->close(); ?>