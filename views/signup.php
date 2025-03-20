<?php

$success = 0;
$user = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') { //if anything we request (in this case submit button) equals to post, show the below, in this case whatever is on connection.php
  include '../config/connect.php';
  $username = $_POST['username'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];
  $name = $_POST['name'];
  $surname = $_POST['surname'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];

  $sql = "SELECT * FROM `registration` WHERE username='$username' OR email='$email'";

  $result = mysqli_query($con, $sql);

  if ($result) {
    $num = mysqli_num_rows($result); //here we are counting the rows //if the variables such as username is already on DB
    if ($num > 0) {
      // echo "This user already exists. Please try again!";
      $user = 1;
    } else {

      //inserting the data into DB
      $sql = "INSERT INTO `registration` (username, password, phone, email, surname, name, confirm_password) 
        VALUES('$username', '$password', '$phone', '$email', '$surname', '$name', '$confirm_password')";


      $result = mysqli_query($con, $sql);
      if ($result) {
        // echo "You’ve successfully signed up!";
        $success = 1;
        header('location:login.php');
      } else {
        die(mysqli_error($con));
      }
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
  if ($user) { //if user already exists on the DB
    echo
    '<div class="alert alert-danger
   alert-dismissible fade show" role="alert">
  <strong>This user already exists.</strong> Please try again!
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
   </div>';
  }
  ?>

  <?php
  if ($success) {
    echo
    '<div class="alert alert-success
   alert-dismissible fade show" role="alert">
  <strong>You’ve successfully signed up!</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
   </div>';
  }
  ?>

  <h1 class="text-center mt-5">Sign Up</h1>
  <div class="container mt-5">
    <form action="signup.php" method="post">
      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" placeholder="Enter your name" name="name" required>
      </div>
      <div class="mb-3">
        <label for="surname" class="form-label">Surname</label>
        <input type="text" class="form-control" placeholder="Enter your surname" name="surname" required>
      </div>
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" placeholder="Enter your username" name="username" required>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" placeholder="Enter your email" name="email" required>
      </div>
      <div class="mb-3">
        <label for="phone" class="form-label">Phone</label>
        <input type="text" class="form-control" placeholder="Enter your phone number" name="phone" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" placeholder="Enter your password" name="password" required>
      </div>
      <div class="mb-3">
        <label for="confirmPassword" class="form-label">Confirm Password</label>
        <input type="password" class="form-control" placeholder="Confirm your password" name="confirm_password" required>
      </div>
      <button type="submit" class="btn btn-primary mb-5">Sign Up</button>
    </form>
  </div>


</body>

</html>