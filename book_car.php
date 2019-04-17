<?php
require("dbconn.php");
$db = new CarRentals_Database();

session_start();
$c_ids = $_SESSION["c_ids"];
$u_id = $_SESSION["u_id"];

$start_time = $_SESSION["start-time"];
$return_time = $_SESSION["return-time"];

foreach ($c_ids as $c_id) {
	if (isset($_POST["$c_id"])) {
		if ($db->book_car($c_id, $u_id, $start_time, $return_time)) {
			header("Location: booking_history.php");
		} else {
			header("Location: error.html");
		}
	}
}
?>