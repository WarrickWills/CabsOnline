<?php
	$bookingNum = $_POST["bookingNum"];
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
		
		// Select the requested booking number
		$query = "SELECT * FROM bookings WHERE bookingNumber = '$bookingNum'";
		
		// Executes the query and store result into the result pointer
		$result = mysqli_query($conn, $query);
		if(!$result) {
			// Display error message if database query does not execute
			echo "Error with database query 1";
		} else {
			// Checks the number of rows present in database
			$rowCount = @mysqli_num_rows($result);
			
			// If there are any inputs into the database check if taxi already assigned
			if($rowCount > 0) {
				$query = "SELECT * FROM bookings WHERE bookingNumber = '$bookingNum' AND genStatus = 'assigned'";
				$result = mysqli_query($conn, $query);
				if(!$result) {
					// Display error message if SQL query does not execute
					echo "Error with database query 2";
				} else {
					// Count rows
					$rowCount =@mysqli_num_rows($result);
					
					// If there are inputs present the booking number has already been assigned
					if($rowCount > 0) {
						echo "This taxi has already been assigned.";
					} else {
						// Otherwise update the booking number to assigned
						$query = "UPDATE bookings SET genStatus = 'assigned' WHERE bookingNumber = $bookingNum";
						$result = mysqli_query($conn, $query);
						if(!$result) {
							// Display error message if SQL query does not execute
							echo "Error with database query 3";
						} else {
							// Otherwise state that the booking number has been assigned
							echo "The booking request $bookingNum has been properly assigned!";
						}
					} 
				}
			} else {
				// Otherwise the nooking number was not found
				echo "Booking number not found";
			}
		}
	}
?>