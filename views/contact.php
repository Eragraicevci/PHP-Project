<?php

$success = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '../config/connect.php';
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $comment = $_POST['comment'];

    if ($con) {
        $sql = "INSERT INTO `contact` (name, surname, email, phone, comment) 
        VALUES('$name', '$surname', '$email', '$phone', '$comment')";
        $result = mysqli_query($con, $sql);
        if ($result) {
            $success = 1;
        } else {
            die(mysqli_error($con));
        }
    } else {
        die(mysqli_error($con));
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>

    <?php
    if ($success) {
        echo
        '<div class="alert alert-success
   alert-dismissible fade show" role="alert">
  <strong>We have successfully received your message. We will contact you soon :).</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
   </div>';
    }
    ?>

    <h1 class="text-center mt-5">Contact Us</h1>

    <div class="container">
        <div class="contact-container">
            <form action="contact.php" method="post">
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter your name">
                </div>
                <div class="mb-3">
                    <label class="form-label">Surname</label>
                    <input type="text" class="form-control" name="surname" placeholder="Enter your surname">
                </div>
                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email" class="form-control" name="email" placeholder="Enter your email address">
                </div>
                <div class="mb-3">
                    <label class="form-label">Phone Number</label>
                    <input type="text" class="form-control" name="phone" placeholder="Enter your phone number">
                </div>
                <div class="mb-3">
                    <label class="form-label">Comment</label>
                    <textarea class="form-control" name="comment" rows="4" placeholder="Enter your comment"></textarea>
                </div>
                <button type="submit" class="btn btn-custom">Submit</button>
            </form>
        </div>
    </div>

</body>

</html>