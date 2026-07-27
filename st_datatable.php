<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Data Table</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.7.0/css/select.dataTables.min.css">

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
<h1>Student Data Table</h1>
<div class="container">
    <table id="studentTable" class="display nowrap" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Address</th>
                <th>DOB</th>
                <th>WhatsApp</th>
                <th>Guardian</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $conn = new mysqli("localhost", "root", "", "sigma_db");
            $result = $conn->query("SELECT * FROM student");
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['st_id']}</td>
                    <td>{$row['full_name']}</td>
                    <td>{$row['address']}</td>
                    <td>{$row['dob']}</td>
                    <td>{$row['whatsapp_no']}</td>
                    <td>{$row['guardian_name']} ({$row['guardian_contact']})</td>
                    <td>{$row['email']}</td>
                     <td>
            <a href='edit_student.php?id={$row['st_id']}' class='btn btn-sm btn-success'>Edit</a>
            <a href='delete_student.php?id={$row['st_id']}' class='btn btn-sm btn-danger' onclick=\"return confirm('Are you sure?')\">Delete</a>
        </td>

                </tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script>
$(document).ready(function () {
    $('#studentTable').DataTable({
        dom: 'Plfrtip',
        searchPanes: {
            cascadePanes: true,
            viewTotal: true
        },
       
    });
});
</script>

</body>
</html>