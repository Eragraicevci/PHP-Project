<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('location:views/login.php');
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to Radiance Beauty</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <h1 class="text-center mb-5 mt-5">Pure Bliss Salon</h1>
    <div class="container mt-5 mb-5">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
        <p class="lead text-muted">You're now logged in to Radiance Beauty Salon.</p>
        <a href="views/logout.php" class="btn logout-btn text-white mt-4">Log Out</a>
    </div>
</body>

</html>