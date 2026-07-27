<?php
session_start();
include "db.php";

if (isset($_GET['clear']) && $_GET['clear'] == 1) {
    header("Location: check3.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $grade = $_POST['grade'];
    $subject_id = $_POST['subject_id'];
    $year = $_POST['year'];
    $students = $_POST['students'] ?? [];

    $class_q = mysqli_query($conn, "SELECT class_id FROM class WHERE grade = '$grade' LIMIT 1");
    $class = mysqli_fetch_assoc($class_q);

    if ($class) {
        $class_id = $class['class_id'];
        $inserted_students = [];

        foreach ($students as $st_id) {
            $check = mysqli_query($conn, "SELECT * FROM register WHERE st_id='$st_id' AND class_id='$class_id' AND subject_id='$subject_id' AND year='$year'");
            if (mysqli_num_rows($check) == 0) {
                mysqli_query($conn, "INSERT INTO register (st_id, class_id, subject_id, year) VALUES ('$st_id', '$class_id', '$subject_id', '$year')");
                $name_q = mysqli_query($conn, "SELECT full_name FROM student WHERE st_id='$st_id'");
                $row = mysqli_fetch_assoc($name_q);
                $inserted_students[] = [
                    'st_id' => $st_id,
                    'full_name' => $row['full_name'],
                    'class_id' => $class_id,
                    'subject_id' => $subject_id,
                    'year' => $year
                ];
            }
        }

        $_SESSION['last_registered'] = $inserted_students;
        $_SESSION['success'] = true;
    }

    header("Location: check3.php?grade=$grade&subject_id=$subject_id&year=$year");
    exit;
}


if (isset($_POST['undo'])) {
    if (!empty($_SESSION['last_registered'])) {
        foreach ($_SESSION['last_registered'] as $entry) {
            mysqli_query($conn, "DELETE FROM register WHERE st_id='{$entry['st_id']}' AND class_id='{$entry['class_id']}' AND subject_id='{$entry['subject_id']}' AND year='{$entry['year']}'");
        }
        unset($_SESSION['last_registered']);
        $_SESSION['undo_done'] = true;
    }
    header("Location: check3.php");
    exit;
}


$grades = mysqli_query($conn, "SELECT DISTINCT grade FROM class");
$subjects = mysqli_query($conn, "SELECT * FROM subject");
$students = mysqli_query($conn, "SELECT st_id, full_name FROM student");

// Get filters
$selected_grade = $_GET['grade'] ?? '';
$selected_subject = $_GET['subject_id'] ?? '';
$selected_year = $_GET['year'] ?? date('Y');

// Fetch registered students
$registered_students = [];
if ($selected_grade && $selected_subject && $selected_year) {
    $class_q = mysqli_query($conn, "SELECT class_id FROM class WHERE grade = '$selected_grade' LIMIT 1");
    if ($class_row = mysqli_fetch_assoc($class_q)) {
        $class_id = $class_row['class_id'];
        $result = mysqli_query($conn, "SELECT student.full_name 
                                       FROM register 
                                       JOIN student ON register.st_id = student.st_id 
                                       WHERE register.class_id = '$class_id' 
                                       AND register.subject_id = '$selected_subject' 
                                       AND register.year = '$selected_year'");
        while ($row = mysqli_fetch_assoc($result)) {
            $registered_students[] = $row['full_name'];
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Register Students</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .student-list label { display: block; padding: 5px 10px; }
    .student-list label:hover { background: #f1f1f1; }
  </style>
</head>
<body class="bg-light">
<?php include "check_nav.php"; ?>
<div class="container mt-5">
  <h3>Register Students</h3>

  <?php if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success">
      ✅ <strong><?= count($_SESSION['last_registered']) ?></strong> student(s) registered successfully!
      <ul>
        <?php foreach ($_SESSION['last_registered'] as $s): ?>
          <li><?= htmlspecialchars($s['full_name']) ?></li>
        <?php endforeach; ?>
      </ul>
      <form method="post" class="d-inline">
        <button type="submit" name="undo" class="btn btn-danger btn-sm">Undo</button>
      </form>
      <a href="check3.php" class="btn btn-secondary btn-sm">Close</a>
    </div>
    <?php unset($_SESSION['success']); ?>
  <?php endif; ?>

  <?php if (isset($_SESSION['undo_done'])): ?>
    <div class="alert alert-info">Undo successful!</div>
    <?php unset($_SESSION['undo_done']); ?>
  <?php endif; ?>

  <form method="get" class="row g-3">
    <div class="col-md-3">
      <label>Grade:</label>
      <select name="grade" class="form-select" required onchange="this.form.submit()">
        <option value="">Select grade</option>
        <?php while ($g = mysqli_fetch_assoc($grades)) { ?>
          <option value="<?= $g['grade'] ?>" <?= ($selected_grade == $g['grade']) ? 'selected' : '' ?>>
            <?= $g['grade'] ?>
          </option>
        <?php } ?>
      </select>
    </div>

    <div class="col-md-3">
      <label>Subject:</label>
      <select name="subject_id" class="form-select" required onchange="this.form.submit()">
        <option value="">Select subject</option>
        <?php mysqli_data_seek($subjects, 0); while ($s = mysqli_fetch_assoc($subjects)) { ?>
          <option value="<?= $s['subject_id'] ?>" <?= ($selected_subject == $s['subject_id']) ? 'selected' : '' ?>>
            <?= $s['name'] ?>
          </option>
        <?php } ?>
      </select>
    </div>

    <div class="col-md-2">
      <label>Year:</label>
      <input type="number" name="year" class="form-control" value="<?= $selected_year ?>" onchange="this.form.submit()">
    </div>
    <div class="col-md-2 mt-4 ms-5">
    <a href="check3.php?clear=1" class="btn btn-secondary">Clear Filters</a>
    </div>

  </form>

  <div class="row mt-4">
    <div class="col-md-8">
      <form method="post">
        <input type="hidden" name="grade" value="<?= $selected_grade ?>">
        <input type="hidden" name="subject_id" value="<?= $selected_subject ?>">
        <input type="hidden" name="year" value="<?= $selected_year ?>">

        <div class="mb-3">
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#studentModal">
            Select Students
          </button>
        </div>

        <div id="selected-students" class="mb-3"></div>
        <input type="submit" name="submit" class="btn btn-success" value="Register Students">
      </form>
    </div>

    <div class="col-md-4">
      <?php if (!empty($registered_students)): ?>
        <div class="card">
          <div class="card-header bg-info text-white">Already Registered Students</div>
          <div class="card-body">
            <ul class="list-group">
              <?php foreach ($registered_students as $name): ?>
                <li class="list-group-item"><?= htmlspecialchars($name) ?></li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="studentModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Select Students</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="text" id="student-search" class="form-control mb-3" placeholder="Search student name...">
        <ul class="list-group student-list" id="student-list">
          <?php mysqli_data_seek($students, 0); while ($st = mysqli_fetch_assoc($students)) { ?>
            <label class="list-group-item">
              <input type="checkbox" class="form-check-input me-1 student-checkbox" value="<?= $st['st_id'] ?>" data-name="<?= htmlspecialchars($st['full_name']) ?>">
              <?= htmlspecialchars($st['full_name']) ?>
            </label>
          <?php } ?>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Done</button>
      </div>
    </div>
  </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  document.getElementById('student-search').addEventListener('input', function () {
    const keyword = this.value.toLowerCase();
    document.querySelectorAll('#student-list label').forEach(label => {
      const name = label.textContent.toLowerCase();
      label.style.display = name.includes(keyword) ? '' : 'none';
    });
  });

  const checkboxes = document.querySelectorAll('.student-checkbox');
  const selectedContainer = document.getElementById('selected-students');

  function updateSelected() {
    selectedContainer.innerHTML = '';
    checkboxes.forEach(cb => {
      if (cb.checked) {
        const name = cb.dataset.name;
        const st_id = cb.value;
        selectedContainer.innerHTML += `<input type="hidden" name="students[]" value="${st_id}">
        <span class="badge bg-primary me-1">${name}</span>`;
      }
    });
  }

  checkboxes.forEach(cb => cb.addEventListener('change', updateSelected));
</script>

</body>
</html>