<?php
session_start();

// Check if the user is logged in as an admin
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: /login.php');
    exit();
}

// Include necessary files
require_once '../../config/database.php';
require_once '../../src/controllers/AdminController.php';

$adminController = new AdminController();

// Fetch admin statistics or any necessary data
$adminStats = $adminController->getAdminStatistics();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/style.css">
    <title>Admin Dashboard</title>
</head>
<body>
    <header>
        <h1>Admin Dashboard</h1>
        <nav>
            <ul>
                <li><a href="/public/index.php">Home</a></li>
                <li><a href="/public/login.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Statistics</h2>
        <div>
            <p>Total Users: <?php echo $adminStats['total_users']; ?></p>
            <p>Total Queues: <?php echo $adminStats['total_queues']; ?></p>
        </div>
    </main>
</body>
</html>