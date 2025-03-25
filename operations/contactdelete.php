<?php

include '../config/connect.php';

if (isset($_GET['contactDeleteId'])) {
    $id = $_GET['contactDeleteId'];

    $sql = "delete from `contact` where id=$id";

    $result = mysqli_query($con, $sql);

    if ($result) {
        header('location:../cruds/contactcrud.php');
    } else {
        (mysqli_error($con));
    }
}
