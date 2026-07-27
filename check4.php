<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <title>View Registrations</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .card { border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
    .section-title { background-color: #f0f0f0; padding: 10px; border-radius: 5px; margin-bottom: 15px; }
  </style>
</head>
<body >
<?php include "check_nav.php"; ?>

<div class="container mt-5">

  <h2 class="mb-4">View Registered Student</h2>


  <form method="GET" class="mb-4">
    <div class="row g-2">
      <div class="col-md-3">
        <select name="class_id" class="form-select">
          <option value="">Select Class (Grade)</option>
          <?php
          $res = $conn->query("SELECT DISTINCT class_id, grade FROM class ORDER BY grade ASC");
          $selected_class = $_GET['class_id'] ?? '';
          while ($row = $res->fetch_assoc()) {
            $selected = ($selected_class == $row['class_id']) ? 'selected' : '';
            echo "<option value='{$row['class_id']}' $selected>Grade {$row['grade']}</option>";
          }
          ?>
        </select>
      </div>

      <div class="col-md-3">
        <select name="subject_id" class="form-select">
          <option value="">Select Subject</option>
          <?php
          $selected_subj = $_GET['subject_id'] ?? '';
          $subjects = $conn->query("SELECT subject_id, name FROM subject ORDER BY name ASC");
          while ($row = $subjects->fetch_assoc()) {
            $selected = ($selected_subj == $row['subject_id']) ? 'selected' : '';
            echo "<option value='{$row['subject_id']}' $selected>{$row['name']}</option>";
          }
          ?>
        </select>
      </div>

      <div class="col-md-3">
        <select name="year" class="form-select">
          <option value="">Select Year</option>
          <?php
          $selected_year = $_GET['year'] ?? '';

          $years = $conn->query("SELECT DISTINCT year FROM register ORDER BY year DESC");
          while ($row = $years->fetch_assoc()) {
            $selected = ($selected_year == $row['year']) ? 'selected' : '';
            echo "<option value='{$row['year']}' $selected>{$row['year']}</option>";
          }
          ?>
        </select>
      </div>

      <div class="col-md-3">
        <button type="submit" class="btn btn-primary">Filter</button>
        <a href="check4.php" class="btn btn-secondary ms-2">Reset</a>
      </div>
    </div>
  </form>


  <div class="section-title"><h4>Search Student's Classes</h4></div>
  <form method="GET" class="mb-4">
    <div class="input-group">
      <input type="text" name="student_search" class="form-control" placeholder="Enter student name..."
             value="<?= htmlspecialchars($_GET['student_search'] ?? '') ?>">
      <button class="btn btn-secondary" type="submit">Search</button>
    </div>
  </form>

  <?php
  if (isset($_GET['delete_id'])) {
    $del_id = (int)$_GET['delete_id'];
    $conn->query("DELETE FROM register WHERE st_id = $del_id");
    echo "<div class='alert alert-warning'>Registration deleted. <a href='check4.php'>Undo</a></div>";
  }


  if (!empty($_GET['student_search'])) {
    $search = $conn->real_escape_string($_GET['student_search']);
    $sql = "SELECT r.st_id, s.full_name, c.grade, sub.name AS subject, r.year
            FROM register r
            JOIN student s ON r.st_id = s.st_id
            JOIN class c ON r.class_id = c.class_id
            JOIN subject sub ON r.subject_id = sub.subject_id
            WHERE s.full_name LIKE '%$search%'
            ORDER BY r.year DESC";
    $result = $conn->query($sql);
    echo "<h5>Classes joined by <mark>" . htmlspecialchars($search) . "</mark>:</h5>";
    if ($result->num_rows > 0) {
      echo "<ul class='list-group mb-4'>";
      while ($row = $result->fetch_assoc()) {
        echo "<li class='list-group-item d-flex justify-content-between align-items-center'>
                Grade {$row['grade']} - {$row['subject']} ({$row['year']})
                <a href='?student_search=" . urlencode($search) . "&delete_id={$row['st_id']}' class='btn btn-sm btn-danger'>Delete</a>
              </li>";
      }
      echo "</ul>";
    } else {
      echo "<p>No classes found for this student.</p>";
    }
  }


  if (!empty($_GET['class_id']) || !empty($_GET['subject_id']) || !empty($_GET['year'])) {
    $class_id = isset($_GET['class_id']) && $_GET['class_id'] !== '' ? (int)$_GET['class_id'] : null;
    $subject_id = isset($_GET['subject_id']) && $_GET['subject_id'] !== '' ? (int)$_GET['subject_id'] : null;
    $year = isset($_GET['year']) && $_GET['year'] !== '' ? (int)$_GET['year'] : null;


    $limit = 5; 
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $limit;


    $conditions = [];
    if ($class_id) $conditions[] = "r.class_id = $class_id";
    if ($subject_id) $conditions[] = "r.subject_id = $subject_id";
    if ($year) $conditions[] = "r.year = $year";

    $where_sql = '';
    if (count($conditions) > 0) {
      $where_sql = 'WHERE ' . implode(' AND ', $conditions);
    }


    $count_sql = "SELECT COUNT(DISTINCT CONCAT(r.subject_id, '_', r.year)) as total
                  FROM register r
                  $where_sql";
    $count_result = $conn->query($count_sql);
    $total_rows = $count_result->fetch_assoc()['total'];
    $total_pages = ceil($total_rows / $limit);


    $sql = "SELECT DISTINCT r.subject_id, r.year, sub.name AS subject
            FROM register r
            JOIN subject sub ON r.subject_id = sub.subject_id
            $where_sql
            ORDER BY r.year DESC
            LIMIT $limit OFFSET $offset";

    $result = $conn->query($sql);


    $grade = '';
    if ($class_id) {
      $res_grade = $conn->query("SELECT grade FROM class WHERE class_id = $class_id LIMIT 1");
      if ($res_grade->num_rows) {
        $grade = $res_grade->fetch_assoc()['grade'];
      }
    }

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $subject = $row['subject'];
        $subject_id = $row['subject_id'];
        $year = $row['year'];

        echo "<div class='card mb-3'>
                <div class='card-header bg-success text-white'>Grade: " . ($grade ?: 'Any') . " | Subject: $subject | Year: $year</div>
                <div class='card-body'>";


        $student_conditions = [];
        if ($class_id) $student_conditions[] = "r.class_id = $class_id";
        if ($subject_id) $student_conditions[] = "r.subject_id = $subject_id";
        if ($year) $student_conditions[] = "r.year = $year";

        $student_where = count($student_conditions) > 0 ? "WHERE " . implode(' AND ', $student_conditions) : '';

        $students_sql = "SELECT r.st_id, s.full_name
                         FROM register r
                         JOIN student s ON r.st_id = s.st_id
                         WHERE r.class_id = " . ($class_id ?? 'r.class_id') . "
                           AND r.subject_id = $subject_id
                           AND r.year = $year
                         ORDER BY s.full_name ASC";


        if (!$class_id) {
          $students_sql = "SELECT r.st_id, s.full_name
                           FROM register r
                           JOIN student s ON r.st_id = s.st_id
                           WHERE r.subject_id = $subject_id AND r.year = $year
                           ORDER BY s.full_name ASC";
        }

        $student_res = $conn->query($students_sql);

        if ($student_res->num_rows > 0) {
          echo "<ul class='list-group'>";
          while ($s = $student_res->fetch_assoc()) {
            echo "<li class='list-group-item d-flex justify-content-between align-items-center'>
                    {$s['full_name']}
                    <a href='?class_id={$class_id}&subject_id={$subject_id}&year={$year}&delete_id={$s['st_id']}' class='btn btn-sm btn-outline-danger'>Remove</a>
                  </li>";
          }
          echo "</ul>";
        } else {
          echo "<p>No student registered yet.</p>";
        }

        echo "</div></div>";
      }


      echo "<nav>";
      echo "<ul class='pagination'>";
      $query_params = $_GET;
      for ($p = 1; $p <= $total_pages; $p++) {
        $query_params['page'] = $p;
        $url = '?' . http_build_query($query_params);
        $active = ($p == $page) ? 'active' : '';
        echo "<li class='page-item $active'><a class='page-link' href='$url'>$p</a></li>";
      }
      echo "</ul>";
      echo "</nav>";

    } else {
      echo "<p>No classes found with the selected filters.</p>";
    }
  }

  $conn->close();
  ?>

</div>

</body>
</html>