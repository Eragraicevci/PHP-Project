<?php

include '../config/connect.php';
$id = $_GET['updateId'];

$sql = "SELECT * FROM `registration` WHERE id=$id";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);

$username = $row['username'];
$name = $row['name'];
$surname = $row['surname'];
$email = $row['email'];
$phone = $row['phone'];

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Check if password is entered
    if (!empty($_POST['password']) && $_POST['password'] === $_POST['confirm_password']) {
        $password = $_POST['password'];
        $sql = "UPDATE `registration` SET username='$username', password='$password', 
                name='$name', surname='$surname', email='$email', phone='$phone' WHERE id=$id";
    } else {
        $sql = "UPDATE `registration` SET username='$username', 
                name='$name', surname='$surname', email='$email', phone='$phone' WHERE id=$id";
    }

    $result = mysqli_query($con, $sql);

    if ($result) {
        header('location:usercrud.php');
    } else {
        echo "fail";
        die(mysqli_error($con));
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>

    <h1 class="text-center mt-5">Update User</h1>
    <div class="container mt-5">
        <form method="post">
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" class="form-control" name="name" value="<?php echo $name; ?>" ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Surname</label>
                <input type="text" class="form-control" name="surname" value="<?= htmlspecialchars($surname) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" class="form-control" name="username" value="<?= htmlspecialchars($username) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($email) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input type="text" class="form-control" name="phone" value="<?= htmlspecialchars($phone) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">New Password (optional)</label>
                <input type="password" class="form-control" name="password">
            </div>
            <div class="mb-3">
                <label class="form-label">Confirm Password</label>
                <input type="password" class="form-control" name="confirm_password">
            </div>
            <button type="submit" name="submit" class="btn btn-primary mb-5">Update</button>
        </form>
    </div>

</body>

</html>