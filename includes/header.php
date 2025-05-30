<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username'])) {
    header('Location: ../views/login.php');
    exit;
}
?>

<div class="navbar">

    <div id="kiss-container"></div>

    <div class="profile">
        <h1>
            Welcome, <?= htmlspecialchars($_SESSION['username']); ?>
            <img src="/registrations/signup/assets/images/pink-cheetah-heart.png" alt="cheetah-icon" width="30">
        </h1>
        <a href="/registrations/signup/views/logout.php" class="btn logout-btn text-white">Log Out</a>
    </div>

    <?php
    $allowed_users = ['ee1', 'manager1'];

    if (in_array($_SESSION['username'], $allowed_users)) {
        echo '
    <div class="dashboard-link">
        <a href="/registrations/signup/views/dashboard.php" class="">Dashboards</a>
    </div>';
    }
    ?>

</div>