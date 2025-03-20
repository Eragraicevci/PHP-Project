<?php

$success = 0;
$user = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') { //if anything we request (in this case submit button) equals to post, show the below, in this case whatever is on connection.php
  include 'connect.php';
  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql = "Select * from `registration` where username='$username'";

  $result = mysqli_query($con, $sql);

  if ($result) {
    $num = mysqli_num_rows($result); //here we are counting the rows //if the variables such as username is already on DB
    if ($num > 0) {
      // echo "This user already exists. Please try again!";
      $user = 1;
    } else {

      //inserting the data into DB
      $sql = "insert into `registration` (username, password) values('$username', '$password')";

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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
  } else {
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
        <label for="exampleInputEmail1" class="form-label">Username</label>
        <input type="text" class="form-control"
          placeholder="Enter your username" name="username">
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control"
          placeholder="Enter your password" name="password">
      </div>
      <button type="submit" class="btn btn-primary w-100">Sign In</button>
    </form>
  </div>

</body>

</html>