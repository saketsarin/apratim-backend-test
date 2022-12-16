<?php

$connection = mysqli_connect("localhost", "root", "", "backend_test");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$college = $_POST['college'];
$email = $_POST['email'];
$password = $_POST['password'];

$sql = "INSERT INTO `user_details` (`firstName`, `lastName`, `collegeName`, `username`, `password`) VALUES ('$fname', '$lname', '$college', '$email', '$password')";

// check if username/email already exists
$check = "SELECT * FROM `user_details` WHERE `username` = '$email'";
$result = mysqli_query($connection, $check);
$num = mysqli_num_rows($result);

if ($num == 1) {
    echo "Email already exists, please try again.";
} else {
    if (mysqli_query($connection, $sql)) {
        echo "You have signed up successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connection);
    }
}

mysqli_close($connection);
