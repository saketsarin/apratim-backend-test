<?php

$connection = mysqli_connect("localhost", "root", "", "backend_test");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$email = $_POST['email'];
$password = $_POST['password'];

$token = bin2hex(random_bytes(32));

$check = "SELECT * FROM `sessions` WHERE `username` = '$email' AND `status` = 'active'";
$result = mysqli_query($connection, $check);
$num = mysqli_num_rows($result);

// if ($num == 1) {
//     echo "You are already logged in.";
// } else {
$check = "SELECT * FROM `user_details` WHERE `username` = '$email' AND `password` = '$password'";
$result = mysqli_query($connection, $check);
$num = mysqli_num_rows($result);

if ($num == 1) {
    $sql = "INSERT INTO `sessions` (`username`, `password`, `token`, `login/time`, `status`) VALUES ('$email', '$password', '$token', NOW(), 'active')";
    if (mysqli_query($connection, $sql)) {
        header('Content-Type: application/json');
        echo json_encode(array("token" => $token));
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connection);
    }
} else {
    echo "Email or password is incorrect, please try again.";
}
// }


mysqli_close($connection);
