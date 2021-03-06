<?php
// change the value of $dbuser and $dbpass to your username and password
	include 'connectvarsEECS.php'; 

	// Add a user to the database.
	
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}

	// Sanitize inputs.
	$email = $_POST['email'];
	$email = mysqli_real_escape_string($conn, $email);
	$password = $_POST['password'];
	$password = mysqli_real_escape_string($conn, $password);

	if ($email == NULL)
		exit("No email provided");

	if ($password == NULL)
		exit("No password provided");

	function clean_input($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	$email = clean_input($email);
	$password = clean_input($password);

	$query = "INSERT INTO UserFinal (email, password) VALUES ('$email', '$password')";

	if (mysqli_query($conn, $query)) {
		//echo "Record added.";
		header("location: login.php");
	}

	else {
		$error = mysqli_error($conn);
		echo $error;
	}

	mysqli_free_result($query);
	mysqli_close($conn);
?>
