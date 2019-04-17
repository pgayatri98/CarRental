<html>
	<head>
		<title>
			Search Cars
		</title>

		<style>
			table.search-cars {
				border-radius: 15px;
				border-width: 3px;
				border-color: white;
				font-family: Arial, Helvetica, sans-serif;
				text-decoration-color: white;
				border-spacing: 5px;
			    border-style: solid;
			}

			td {
				color: white;
			}

			h1 {
				color: white;
			}
		</style>

		<marquee behavior="scroll" direction="right" bgcolor=#7477AF text=#000000  >CAR RENTAL</marquee>
	</head>

	<body background="royce.jpg">

		<h1>Search your Destiny</h1>
		<form action="display_cars.php" method="POST">
			<table class="search-cars" cellpadding="10">
				<tr>
					<td>
						Enter Location
					</td>
					<td>
						<input type="text" placeholder="enter location" name="location"><br>
					</td>
				</tr>
				
				<tr>
					<td>
						Enter Start Time
					</td>
					<td>
						<input type="text" placeholder="enter start time" name="start-time"><br>
					</td>
				</tr>

				<tr>
					<td>
						Enter Return Time
					</td>
					<td>
						<input type="text" placeholder="enter return date" name="return-time"><br>
					</td>
				</tr>
			
				<tr>
					<td colspan="2">
						<button type="submit">Search</button>
					</td>
				</tr>
			</table>
		</form>
	</body>
</html>