<?php

$login = 0;
$invalid = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '../config/connect.php';
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "Select * from `registration` where 
    username='$username' and password='$password'";

    $result = mysqli_query($con, $sql);
    if ($result) {
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            $login = 1;
            session_start(); //to store data so that user doesnt have to login each time they are on the platform
            $_SESSION['username'] = $username;
            header('location:../index.php');
        } else {
            $invalid = 1;
        }
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>

    <?php
    if ($login) { // If login is successful
        echo
        '<div class="alert alert-success
   alert-dismissible fade show" role="alert">
  <strong>You are successfully logged in.</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
   </div>';
    }
    ?>

    <?php
    if ($invalid) { // If invalid credentials
        echo
        '<div class="alert alert-danger
   alert-dismissible fade show" role="alert">
  <strong>Invalid credentials.</strong> Please try again!
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
   </div>';
    }
    ?>

    <h1 class="text-center mb-5 mt-5">Pure Bliss Salon</h1>
    <div class="container mt-5">
        <h2 class="text-center">
            <img src="../assets/images/pink cheetah heart.png" alt="cheetah-icon" width="40">
            Welcome Back <img src="../assets/images/pink cheetah heart.png" alt="cheetah-icon" width="40">
        </h2>
        <form action="login.php" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" placeholder="Enter your username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" placeholder="Enter your password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary mb-3">Log In</button>
        </form>

        <p class="text-center">
            Don’t have an account?
            <a href="signup.php" class="">Register</a>
        </p>

    </div>


</body>

</html>