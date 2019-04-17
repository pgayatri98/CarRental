<?php
require("dbconn.php");

$username = $_POST["username"];
$password = $_POST["password"];

$db = new CarRentals_Database();

session_start();
$_SESSION["u_id"] = $db->login($username, $password);

if ($_SESSION["u_id"]) {
	header("Location: search_cars.php");
} else {
	header("Location: error.html");
}
?>