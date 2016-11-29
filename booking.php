<?php
	// Make sure these fields are not null
	if(isset($_POST["firstName"]) && isset($_POST["lastName"]) && isset($_POST["mobileNumber"])
        && isset($_POST["streetNum"]) && isset($_POST["streetAdd"]) && isset($_POST["suburb"])
        && isset($_POST["pickupDate"]) && isset($_POST["pickupTime"]) && isset($_POST["destinationSuburb"])) {
	
		// Initiating variables
		date_default_timezone_set("Pacific/Auckland");
		$bookingDate = date("Y-m-d");
		$bookingTime = date("h:i:sa");
		$fName = $_POST["firstName"];
		$lName = $_POST["lastName"];
		$mobileNum = $_POST["mobileNumber"];
		$unitNum = $_POS["unitNum"];
		$streetNum = $_POST["streetNum"];
		$streetAdd = $_POST["streetAdd"];
		$suburb = $_POST["suburb"];
		$pickupDate = $_POST["pickupDate"];
		$pickupTime = $_POST["pickupTime"];
		$destinationSuburb = $_POST["destinationSuburb"];
		
		// Checking patterns for inputs
		$fnamePattern = "/[A-Za-z-]/";
		$lnamePattern = "/[A-Za-z-]/";
		$mobilePattern = "/[0-9]/";
		$streetNumPattern = "/[0-9]/";
		$streetAddPattern = "/[A-Za-z]/";
		$suburbPattern = "/[A-Za-z]/";
		$destinationPattern = "/[A-Za-z]/";
		
		// Generated error messages
		$fnameError = $lnameError = $mobileError = $streetNumError = $streetAddError = $suburbError = $destinationError = "";
		
		// Matches first name with the pattern and sets error message if criteria not satisfied
         if(!preg_match($fnamePattern, $fName)) {
         	$fnameError = "<p>First name input is invalid, must be text input</p>";
         }
		 
		 // Matches last name with the pattern and sets error message if criteria not satisfied
         if(!preg_match($lnamePattern, $lName)) {
         	$lnameError = "<p>Last name input is invalid, nust be text input</p>";
         }
		 
		 // Matches mobile number with the pattern and sets error message if criteria not satisfied
         if(!preg_match($mobilePattern, $mobileNum)) {
         	$mobileError = "<p>Mobile number input is invalid, must be number input</p>";
         }
		 
		 // Matches street number with the pattern and sets error message if criteria not satisfied
         if(!preg_match($streetNumPattern, $streetNum)) {
         	$streetAddError = "<p>Street number input is invalid, must be number input</p>";
         }
		 
		 // Matches street name with the pattern and sets error message if criteria not satisfied
         if(!preg_match($streetAddPattern, $streetAdd)) {
         	$streetAddError = "<p>Street name input is invalid, must be text input</p>";
         }
		 
		 // Matches suburb with the pattern and sets error message if criteria not satisfied
         if(!preg_match($suburbPattern, $suburb)) {
         	$suburbError = "<p>Suburb input is invalid, must be text input</p>";
         }
		 
		 // Matches destination suburb with the pattern and sets error message if criteria not satisfied
         if(!preg_match($destinationPattern, $destinationSuburb)) {
         	$destinationError = "<p>Destination suburb input is invalid, must be text input</p>";
         }

		// Prints the error message(s)
		if(!empty($fnameError) || !empty($lnameError) || !empty($mobileError) || !empty($streetNumError) || !empty($streetAddError) || !empty($suburbError) || !empty($destinationError)) {
			echo $fnameError . $lnameError . $mobileError . $streetNumError . $streetAddError . $suburbError . $destinationError;
		} else {
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
				// insert everything into the table
				$query = "INSERT INTO bookings(bookingDate, bookingTime, firstName, lastName, phoneNumber, unitNumber, streetNumber, streetName, suburb, destinationSuburb, pickupDate, pickupTime, genStatus) VALUES ('$bookingDate', '$bookingTime', '$fName', '$lName', '$mobileNum', '$unitNum', '$streetNum', '$streetAdd', '$suburb', '$destinationSuburb', '$pickupDate', '$pickupTime', 'unassigned')";
				// Executes the query and store result into the result pointer
				$result = mysqli_query($conn, $query);
				// Checks if the execuion was successful
				if(!$result) {
					// Displays an error message
					echo "<p>Booking was unsuccessful, please try again!</p>";
				} else {
					// Execution was successful so success message displays
					echo "<p>Booking successful! Your booking number is ". mysqli_insert_id($conn) ." <br> You will be picked up at $pickupTime on $pickupDate</p>";
				}
				// Close the database connection
				mysqli_close($conn);
			}
		}
	} else {
		// Display error message if any error occurs
		echo "An error occurred, please try again." ;
	}
?>
