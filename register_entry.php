<?php
$username = $_POST["username"];
$email = $_POST["email"];
$license = $_POST["license"];
$phone = $_POST["phone"];
$password = $_POST["password"];
$confirm_password = $_POST["confirm_password"];

if (strcmp($password, $confirm_password)) {
	header("Location: register.html");
}

require("dbconn.php");
$db = new CarRentals_Database();

$u_id = mt_rand(1, 100000);
session_start();
$_SESSION["u_id"] = $u_id;

if ($db->register($u_id, $password, $username, $email, $phone, $license)) {
	header("Location: index.html");
} else {
	header("Location: error.html");
}

?>