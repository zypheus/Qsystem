<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: /login.php");
    exit();
}

// Include necessary files
require_once '../../config/database.php';
require_once '../../src/models/Queue.php';

// Create a new Queue instance
$queue = new Queue($pdo);

// Fetch user-specific queue data
$userId = $_SESSION['user_id'];
$userQueues = $queue->getUserQueues($userId);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/style.css">
    <title>User Dashboard</title>
</head>
<body>
    <header>
        <h1>Welcome to Your Dashboard</h1>
        <a href="/logout.php">Logout</a>
    </header>
    <main>
        <h2>Your Queues</h2>
        <?php if (empty($userQueues)): ?>
            <p>You have no active queues.</p>
        <?php else: ?>
            <ul>
                <?php foreach ($userQueues as $queue): ?>
                    <li><?php echo htmlspecialchars($queue['name']); ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </main>
</body>
</html>