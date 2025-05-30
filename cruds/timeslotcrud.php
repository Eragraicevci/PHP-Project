<?php
session_start();
include '../config/connect.php';

$allowed_users = ['ee1', 'manager1'];
if (!in_array($_SESSION['username'], $allowed_users)) {
    header('Location: ../views/login.php');
    exit;
}

if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    $stmt = $con->prepare("DELETE FROM available_slots WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: timeslotcrud.php");
    exit;
}

$result = $con->query("
    SELECT a.id, a.slot_date, a.slot_time 
    FROM available_slots a
    WHERE NOT EXISTS (
        SELECT 1 FROM appointments ap WHERE ap.slot_id = a.id
    )
    ORDER BY a.slot_date, a.slot_time
");
?>

<!DOCTYPE html>
<html>

<?php include '../includes/header.php'; ?>

<head>
    <title>Time Slot Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Available Timeslots</h2>

        <?php if (!$result): ?>
            <div class="alert alert-danger">
                SQL Error: <?= $con->error ?>
            </div>
        <?php endif; ?>

        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= htmlspecialchars($row['slot_date']) ?></td>
                            <td><?= htmlspecialchars($row['slot_time']) ?></td>
                            <td>
                                <a href="timeslotcrud.php?delete_id=<?= $row['id'] ?>"
                                    class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this slot?');">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">No available timeslots.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="timeslot-container">
            <a href="../views/timeslot.php" class="btn add-timeslot-btn">Add a new timeslot</a>
        </div>

</body>

</html>