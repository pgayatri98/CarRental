<?php
require("dbconn.php");

session_start();
$u_id = $_SESSION["u_id"];

$db = new CarRentals_Database();

if (isset($_POST["cancel"])) {
	if ($db->cancel_booking($u_id) == False) {
		header("Location: error.html");
	}
}

$booking_history = $db->get_booking_history($u_id);
?>

<!DOCTYPE html>
<html>
<head>
	<title>
		Booking History
	</title>

	<style type="text/css">
		table.display-booking-history {
			border-radius: 15px;
			border-width: 3px;
			border-color: white;
			font-family: Arial, Helvetica, sans-serif;
			color: #FFFFFF;
			border-spacing: 5px;
		    border-style: solid;
		}
	</style>

	<marquee behavior="scroll" direction="right" bgcolor=#7477AF text=#000000>Car Rentals</marquee>
</head>
<body background="royce.jpg">
	<form method="POST" action="booking_history.php">
		<table class="display-booking-history" cellpadding="20">
			<?php
				$car_counter = 0;

				echo "<tr>";
				echo "<td>Car</td> <td>Start Time</td> <td>Return Time</td>";
				echo "</tr>";
				while ($row = mysqli_fetch_assoc($booking_history)) {
					echo "<tr>";
					foreach ($row as $attr) {
						echo "<td>$attr</td>";
					}

					$car_counter += 1;
					echo "</tr>";
				}

				if ($car_counter != 0) {
					echo '<tr><td><input type="submit" name="cancel" value="cancel"></td></tr>';
				} else {
					echo "<tr><td>Cars will appear once you book</td></tr>";
				}
			?>
		</table>
	</form>
</body>
</html>