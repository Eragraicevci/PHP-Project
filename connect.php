<?php

$HOSTNAME = 'localhost';
$USERNAME = 'root';
$PASSWORD = '';
$DATABaSE = 'signupforms';

//variable to connect php with database
$con = mysqli_connect($HOSTNAME, $USERNAME, $PASSWORD, $DATABaSE);

//if connections works well
if (!$con) {
    die(mysqli_error($con));
}
