<?php
include '../config/connect.php';

if (isset($_GET['deleteId'])) {
    $id = $_GET['deleteId'];

    $sql = "delete from `registration` where id=$id";

    $result = mysqli_query($con, $sql);

    if ($result) {
        header('location:usercrud.php');
    } else {
        die(mysqli_error($con));
    }
}
