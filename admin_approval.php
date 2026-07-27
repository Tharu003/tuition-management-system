
<?php
include 'ad_home.php';
include 'dbase.php';

if (isset($_GET['approve'])) {
    $id = $_GET['approve'];
    $stmt = $bdd->prepare("UPDATE users SET status = 'approved' WHERE id = ?");
    $stmt->execute([$id]);


    echo "<script>
            alert('Student approved successfully!');
            window.location.href = 'admin_approval.php';
          </script>";
    exit;
}

$stmt = $bdd->query("SELECT * FROM users WHERE status = 'pending'");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="si">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Approval Panel</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
        }
         .main-content {
        margin-left: 80px;
        margin-top: 60px;
        padding: 20px;
        transition: margin-left 0.3s ease;
    }
.sidebar.active ~ .main-content {
        margin-left: 250px;
    }
        .container {
            width: 80%;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .approve-btn {
            background-color: #28a745;
            color: white;
            padding: 6px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        .approve-btn:hover {
            background-color: #218838;
        }
        .status {
            font-weight: bold;
        }
        .status.pending {
            color: #ffc107;
        }
        .status.approved {
            color: #28a745;
        }
        .status.rejected {
            color: #dc3545;
        }
    </style>
</head>
<body>
<div class="main-content" id="mainContent">
<div class="container">
    <h2>Pending User Approvals</h2>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user['name']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td><?= htmlspecialchars($user['role']) ?></td>
                    <td class="status <?= strtolower($user['status']) ?>"><?= ucfirst($user['status']) ?></td>
                    <td><a href="?approve=<?= $user['id'] ?>" class="approve-btn">Approve</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</div>
</body>
</html>
