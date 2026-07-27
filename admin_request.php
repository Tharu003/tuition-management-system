<?php
include "ad_home.php";
?>
<br>
<br>
<?php
$conn = mysqli_connect("localhost", "root", "", "sigma_db");


if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM password_requests WHERE id=$id");
    header("Location: admin_requests.php");
}
?>

<!DOCTYPE html>
<html lang="si">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel | Password Requests</title>
    <style>
        body { font-family: sans-serif; background: #f4f7f6; padding: 40px; }
        .admin-container { max-width: 800px; margin: auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h2 { color: #333; border-bottom: 2px solid #06124d; padding-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #06124d; color: white; }
        tr:hover { background-color: #f9f9f9; }
        .btn-delete { color: white; background: #dc3545; padding: 5px 10px; text-decoration: none; border-radius: 4px; font-size: 13px; }
        .status-badge { background: #ffc107; padding: 3px 8px; border-radius: 12px; font-size: 12px; }
    </style>
</head>
<body>

<div class="admin-container">
    <h2>Password Reset Requests</h2>
    <table>
        <thead>
            <tr>
                <th>User Email</th>
                <th>Requested Time</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = mysqli_query($conn, "SELECT * FROM password_requests ORDER BY request_time DESC");
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>{$row['user_email']}</td>
                            <td>{$row['request_time']}</td>
                            <td><span class='status-badge'>{$row['status']}</span></td>
                            <td>
                                <a href='admin_requests.php?delete={$row['id']}' class='btn-delete' onclick='return confirm(\"Are you sure you want to delete this?\")'>Done / Remove</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='4' style='text-align:center;'>Not available Request Yet.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>