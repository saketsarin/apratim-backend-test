<?php

$connection = mysqli_connect("localhost", "root", "", "backend_test");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$token = $_GET['token'];

$check = "SELECT * FROM `sessions` WHERE `token` = '$token' AND `status` = 'active'";

$result = mysqli_query($connection, $check);
$num = mysqli_num_rows($result);

if ($num == 1) {
    $sql = "UPDATE `sessions` SET `status` = 'inactive' WHERE `token` = '$token'";
    if (mysqli_query($connection, $sql)) {
        echo "You have logged out successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connection);
    }
} else {
    echo "No active session found.";
}

mysqli_close($connection);
