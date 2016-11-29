<?php
	// Sets time zone
	date_default_timezone_set("Pacific/Auckland");
	
	// Get pickup date
	$pickupDate = $_POST["pickupDate"];
	
	// Sets up the pickup date, time and +2hour info to check against.
	$pickupDate = date("Y-m-d");
	$pickupTime = date("H:i:s");
	$timeX2 = date("H:i:s", strtotime("+2 hours"));
	require_once("settings.php");
			
	// The @ operator suppresses the display of any error messages
	// mysqli_connect returns false if connection failed, otherwise a connection value
	$conn = @mysqli_connect($host,
		$user,
		$pswd,
		$dbnm);
	
	// Checks if connection is successful				
	if (!$conn) {
		// Displays an error message
		echo "<p>Database connection failure</p>";
	} else {
		// Upon successful connection
		// Select all information from table
		$query = "Select bookingNumber, firstName, lastName, phoneNumber, suburb, destinationSuburb, pickupDate, pickupTime From bookings Where genStatus = 'unassigned' AND pickupDate = '$pickupDate' AND pickupTime BETWEEN '$pickupTime' AND '$timeX2'";
	
		// Executes the query and store result into the result pointer
		$result = mysqli_query($conn, $query);
		if(!$result) {
			echo "Error with database query";
		}
		else {
			$rowCount = mysqli_num_rows($result);

			// Creates the table to display the output of the query
			if($rowCount === 0) {
				echo "No results to display";
			} else {
				echo "<table border='1' style='text-align:center;' class='center'>
					<thead>
						<tr style ='color: black;'>
							<th>
								Booking Number
							</th>
							<th>
								Customer First Name
							</th>
							<th>
								Customer Last Name
							</th>
							<th>
								Customer Phone
							</th>
							<th>
								Pick Up Suburb
							</th>
							<th>
								Destination Suburb
							</th>
							<th>
								Pick Up Date
							</th>
							<th>
								Pick Up Time
							</th>
						</tr>
					</thead>
					<tbody>";

					// If the query works, then find the information relevant to the query and display it.
					if($result)	{
						while($row = mysqli_fetch_array($result))	{
								echo "<tr>";
									for($i = 0; $i < 8; $i++)	{
										echo "<td style='text-align:center; max-width: 350px; word-wrap: break-word;'>";
										echo "<p>".$row[$i]."</p>";
									}
								echo "</td></tr>";	
							}
							mysqli_free_result($result);
						}
							mysqli_close($conn);
					echo"</tbody></table>";
			}
		}
	}
?>