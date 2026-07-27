<?php
include 'db.php';

if (isset($_POST['action']) && $_POST['action'] === 'fetch_teachers' && isset($_POST['grade'])) {
    header('Content-Type: application/json');
    $grade = mysqli_real_escape_string($conn, $_POST['grade']);

    $sql = "SELECT class_id FROM class WHERE grade = '$grade'";
    $res = mysqli_query($conn, $sql);
    $class_ids = [];

    while ($row = mysqli_fetch_assoc($res)) {
        $class_ids[] = $row['class_id'];
    }

    if (empty($class_ids)) {
        echo json_encode([]);
        exit;
    }

    $class_ids_str = implode(',', $class_ids);

    $sql_teachers = "
        SELECT t.teacher_id, t.full_name, t.photo, s.name AS subject_name
        FROM teach_sub_reg tsr
        JOIN teacher t ON tsr.teacher_id = t.teacher_id
        JOIN subject s ON tsr.subject_id = s.subject_id
        WHERE tsr.class_id IN ($class_ids_str)
        ORDER BY t.full_name, s.name
    ";
    $res_teachers = mysqli_query($conn, $sql_teachers);
    $teachers = [];

    while ($row = mysqli_fetch_assoc($res_teachers)) {
        $id = $row['teacher_id'];
        if (!isset($teachers[$id])) {
            $teachers[$id] = [
                'teacher_id' => $id,
                'full_name' => $row['full_name'],
                'photo' => $row['photo'],
                'subjects' => []
            ];
        }
        $teachers[$id]['subjects'][] = $row['subject_name'];
    }

    foreach ($teachers as &$teacher) {
        $teacher['subjects'] = implode(', ', $teacher['subjects']);
    }

    echo json_encode(array_values($teachers));
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Scheduled Assignments with Teachers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <style>
        

        .teacher-photo {
            width: 40px; height: 40px; object-fit: cover; border-radius: 50%;
            margin-right: 10px;
        }

        .grade-card {
  background: linear-gradient(135deg, #e3f2fd, #bbdefb);
  border: 1.5px solid rgb(255, 255, 255); /* lighter blue border */
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(100, 181, 246, 0.25);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  cursor: pointer;
}

.grade-card:hover {
  box-shadow: 0 10px 20px rgba(100, 181, 246, 0.4);
  transform: translateY(-7px);
}

.grade-card .card-body {
  padding: 2rem 1.5rem;
}

.grade-card .card-title {
  font-size: 1.6rem;
  font-weight: 700;
  margin-bottom: 1.2rem;
  color: #1e88e5; /* medium blue */
  text-shadow: 0 1px 2px rgba(30, 136, 229, 0.3);
}

.grade-card .view-teachers-btn {
  background-color: #42a5f5; /* medium light blue */
  color: white;
  border: none;
  padding: 10px 28px;
  font-weight: 600;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(66, 165, 245, 0.4);
  transition: background-color 0.3s ease, box-shadow 0.3s ease;
}

.grade-card .view-teachers-btn:hover {
  background-color: #1e88e5; /* darker blue */
  box-shadow: 0 6px 15px rgba(30, 136, 229, 0.6);
}

    </style>
</head>
<body>

<?php include "check_nav.php"; ?>
<div class="container mt-5">
    <h2>Scheduled Assignments</h2>

    <!-- Filters -->
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="filterTeacher" class="form-label">Filter by Teacher</label>
            <select id="filterTeacher" class="form-select">
                <option value="">All Teachers</option>
                <?php
                $res = mysqli_query($conn, "SELECT DISTINCT teacher_id, full_name FROM teacher ORDER BY full_name");
                while ($row = mysqli_fetch_assoc($res)) {
                    echo "<option value=\"" . htmlspecialchars($row['full_name']) . "\">" . htmlspecialchars($row['full_name']) . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="col-md-4">
            <label for="filterSubject" class="form-label">Filter by Subject</label>
            <select id="filterSubject" class="form-select">
                <option value="">All Subjects</option>
                <?php
                $res = mysqli_query($conn, "SELECT DISTINCT name FROM subject ORDER BY name");
                while ($row = mysqli_fetch_assoc($res)) {
                    echo "<option value=\"" . htmlspecialchars($row['name']) . "\">" . htmlspecialchars($row['name']) . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="col-md-4">
            <label for="filterGrade" class="form-label">Filter by Grade</label>
            <select id="filterGrade" class="form-select">
                <option value="">All Grades</option>
                <?php
                $res = mysqli_query($conn, "SELECT DISTINCT grade FROM class ORDER BY grade");
                while ($row = mysqli_fetch_assoc($res)) {
                    echo "<option value=\"" . htmlspecialchars($row['grade']) . "\">" . htmlspecialchars($row['grade']) . "</option>";
                }
                ?>
            </select>
        </div>
    </div>

    <!-- DataTable -->
    <table id="scheduleTable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Teacher Name</th>
                <th>Subject</th>
                <th>Grade</th>
                <th>Schedule</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT tsr.teacher_id, t.full_name, tsr.subject_id, s.name as subject_name,
                        tsr.class_id, c.grade, tsr.schedule
                    FROM teach_sub_reg tsr
                    JOIN teacher t ON tsr.teacher_id = t.teacher_id
                    JOIN subject s ON tsr.subject_id = s.subject_id
                    JOIN class c ON tsr.class_id = c.class_id
                    ORDER BY t.full_name, s.name, c.grade";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['full_name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['subject_name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['grade']) . "</td>";
                echo "<td>" . htmlspecialchars($row['schedule']) . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- Grades Section -->
    <hr />
    <h3>Grades</h3>
    <div class="row">
    <?php
    $res_grades = mysqli_query($conn, "SELECT DISTINCT grade FROM class ORDER BY grade");
    while ($grade_row = mysqli_fetch_assoc($res_grades)) {
        $grade_val = htmlspecialchars($grade_row['grade']);
        echo "
        <div class='col-md-4 mb-4'>
          <div class='card grade-card shadow-sm'>
            <div class='card-body text-center'>
              <h5 class='card-title'>Grade {$grade_val}</h5>
              <button class='btn view-teachers-btn btn-sm' data-grade='{$grade_val}'>View Teachers</button>
            </div>
          </div>
        </div>";
    }
    ?>
</div>


</div>

<!-- Teachers Modal -->
<div class="modal fade" id="teachersModal" tabindex="-1" aria-labelledby="teachersModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="teachersModalLabel">Teachers in Grade</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <ul id="teachersList" class="list-group"></ul>
      </div>
    </div>
  </div>
</div>

<!-- JS Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script>
$(document).ready(function() {
    var table = $('#scheduleTable').DataTable();

    $.fn.dataTable.ext.search.push(function(settings, data) {
        var teacher = $('#filterTeacher').val().toLowerCase();
        var subject = $('#filterSubject').val().toLowerCase();
        var grade = $('#filterGrade').val().toLowerCase();

        return (!teacher || data[0].toLowerCase() === teacher) &&
               (!subject || data[1].toLowerCase() === subject) &&
               (!grade || data[2].toLowerCase() === grade);
    });

    $('#filterTeacher, #filterSubject, #filterGrade').on('change', function() {
        table.draw();
    });

    $('.view-teachers-btn').on('click', function() {
        var grade = $(this).data('grade');
        $('#teachersList').empty();
        $('#teachersModalLabel').text('Teachers in Grade: ' + grade);

        $.post('', { action: 'fetch_teachers', grade: grade }, function(data) {
            if (data.length === 0) {
                $('#teachersList').append('<li class="list-group-item">No teachers found for this grade.</li>');
            } else {
                data.forEach(function(teacher) {
                    var photo = teacher.photo ? 'uploads/' + teacher.photo : 'placeholder.jpg';
                    $('#teachersList').append(
                        '<li class="list-group-item d-flex align-items-center">' +
                        '<img src="' + photo + '" class="teacher-photo me-2">' +
                        '<div><strong>' + teacher.full_name + '</strong><br>' +
                        '<small>' + teacher.subjects + '</small></div>' +
                        '</li>'
                    );
                });
            }
            new bootstrap.Modal('#teachersModal').show();
        }, 'json');
    });
});
</script>
</body>
</html>
