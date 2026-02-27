<?php
session_start();

// 1. SECURITY CHECK: Must stay at the very top
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// 2. DATABASE CONNECTION: Load this before running queries
include "db.php";

// 3. DATA FETCHING: Get all your numbers ready before the HTML starts
$clients = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM clients"))['c'];
$services = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM services"))['c'];
$bookings = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM bookings"))['c'];

$revRow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT IFNULL(SUM(amount_paid),0) AS s FROM payments"));
$revenue = $revRow['s'];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include "nav.php"; ?>

<div class="container">
    <header>
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
        <p>Dashboard Overview</p>
    </header>
    
    <hr>

    <div class="stats-grid">
        <div class="card">
            <h3>Total Clients</h3>
            <p><?php echo $clients; ?></p>
        </div>
        <div class="card">
            <h3>Total Services</h3>
            <p><?php echo $services; ?></p>
        </div>
        <div class="card">
            <h3>Total Bookings</h3>
            <p><?php echo $bookings; ?></p>
        </div>
        <div class="card">
            <h3>Total Revenue</h3>
            <p>₱<?php echo number_format($revenue, 2); ?></p>
        </div>
    </div>

    <div style="background: #f1f5f9; padding: 20px; border-radius: 8px; margin-top: 20px;">
        <strong>Quick Actions:</strong><br><br>
        <a href="/assessment_beginner/pages/clients_add.php" class="btn-add" style="margin-right:10px;">+ Add Client</a>
        <a href="/assessment_beginner/pages/bookings_create.php" class="btn-add" style="background:var(--primary-color, #007bff); color: white; padding: 8px 12px; text-decoration: none; border-radius: 4px;">+ Create Booking</a>
    </div>
</div>

</body>
</html>