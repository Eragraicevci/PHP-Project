<?php
session_start();

$allowed_users = ['ee1', 'manager1', 'manager2'];
if (!isset($_SESSION['username']) || !in_array($_SESSION['username'], $allowed_users)) {
    header("Location: login.php");
    exit();
}

include '../config/connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $slot_date = $_POST['slot_date'];
    $slot_time = $_POST['slot_time'];

    $stmt = $con->prepare("INSERT INTO available_slots (slot_date, slot_time) VALUES (?, ?)");
    $stmt->bind_param("ss", $slot_date, $slot_time);
    $stmt->execute();
    $message = "Slot added!";
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Add Time Slot</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body class="container mt-5">
    <h2>Add Appointment Slot</h2>
    <?php if (!empty($message)) echo "<div class='alert alert-success'>$message</div>"; ?>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Date</label>
            <input type="date" name="slot_date" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Time</label>
            <input type="time" name="slot_time" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Slot</button>
    </form>
</body>

</html>