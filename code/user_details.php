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
    $row = mysqli_fetch_assoc($result);
    $email = $row['username'];
    $password = $row['password'];

    $check = "SELECT * FROM `user_details` WHERE `username` = '$email' AND `password` = '$password'";
    $result = mysqli_query($connection, $check);
    $num = mysqli_num_rows($result);

    if ($num == 1) {
        header('Content-Type: application/json');
        $row = mysqli_fetch_assoc($result);
        echo json_encode($row);
    } else {
        echo "User not found.";
    }
} else {
    echo "No active session found.";
}


mysqli_close($connection);
