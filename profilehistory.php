<?php include('session.php');
?>

<html>
	<head>
		<title>Profile History</title>
		<link rel="stylesheet" href="index.css">
	</head>
<body>

<div class="navHeader" align="center" width=100%>
<div class="dropdown">
	<button class="dropbtn"><a href="http://web.engr.oregonstate.edu/~hoffera/cs340/Final/home.php">Home</a></button>
</div>

<!-- <a href="http://web.engr.oregonstate.edu/~hoffera/cs340/Final/account.php">Account</a> !-->
<div class="dropdown">
	<button class="dropbtn">Account</button>
	<div class="dropdown-content">
		<a href="http://web.engr.oregonstate.edu/~hoffera/cs340/Final/login.php">Login</a>
		<a href="http://web.engr.oregonstate.edu/~hoffera/cs340/Final/signup.php">Signup</a>
		<a href="http://web.engr.oregonstate.edu/~hoffera/cs340/Final/profilehistory.php">Profile History</a>
		<a href="http://web.engr.oregonstate.edu/~hoffera/cs340/Final/logout.php">Logout</a>
	</div>
</div>

<div class="dropdown">
	<button class="dropbtn"><a href="http://web.engr.oregonstate.edu/~hoffera/cs340/Final/voteOnCourse.php">Vote on Course</a></button>
</div>

<div class="dropdown">
	<button class="dropbtn"><a href="http://web.engr.oregonstate.edu/~hoffera/cs340/Final/discussACourse.php">Discuss a Course</a></button>
</div>

<div class="dropdown">
	<button class="dropbtn"><a href="http://web.engr.oregonstate.edu/~hoffera/cs340/Final/visualizedCourseComparison.php">Visualized Course Comparison</a></button>
</div>

<div class="dropdown">
<button class="dropbtn"><a href="rankings.php">Course Classifications</a>
</button>
</div>

<div class="titleHeader">
<h2 align="center">Profile History</h2>
</div>
</div>

</body>
</html>

<?php
	include 'connectvarsEECS.php'; 	
	
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}

	if ($email)
	{
		$query = "SELECT Course_Title, Difficulty, Quality, Dependence FROM CourseStatsFinal, UserFinal WHERE User_Email = '$email' AND User_Email = email";
		$result = mysqli_query($conn, $query);

		$courseTitles = array();
		$courseTitleCounter = 0;
		$difficulties = array();
		$difficultyCounter = 0;
		$qualities = array();
		$qualityCounter = 0;
		$dependences = array();
		$dependenceCounter = 0;

		while ($row = mysqli_fetch_assoc($result))
		{
			$courseTitles[$courseTitleCounter] = $row["Course_Title"];
			$courseTitleCounter = $courseTitleCounter + 1;

			

			$difficulties[$difficultyCounter] = $row["Difficulty"];
			$difficultyCounter = $difficultyCounter + 1;

			$qualities[$qualityCounter] = $row["Quality"];
			$qualityCounter = $qualityCounter + 1;
			
			$dependences[$dependenceCounter] = $row["Dependence"];
			$dependenceCounter = $dependenceCounter + 1;
		}

		echo "User Email: " . $email;
		echo "<br><br>";
		echo "<table><caption>Voting History</caption>";
		echo "<tr><th>Course Title</th><th>Difficulty</th><th>Quality of Online Lecture</th><th>Dependence on Prior Knowledge</th></tr>";
		
		for ($x = 0; $x < $courseTitleCounter; $x++)
		{
			echo "<tr>";
			echo "<td>";
			echo "" . $courseTitles[$x];
			echo "</td>";
			echo "<td>";
			echo "" . $difficulties[$x];
			echo "</td>";
			echo "<td>";
			echo "" . $qualities[$x];
			echo "</td>";
			echo "<td>";
			echo "" . $dependences[$x];
			echo "</td>";
			echo "</tr>";
		}

		echo "</table>";
		echo "</div>";

		$query = "SELECT C.Message_Content, C.Course_Title FROM CommentFinal C, UserFinal U WHERE C.User_Email = '$email' AND C.User_Email = U.email";
		$result = mysqli_query($conn, $query);
		

		$courseTitles = array();
		$courseTitleCounter = 0;
		$contents = array();
		$contentsCounter = 0;

		while ($row = mysqli_fetch_assoc($result))
		{
			$courseTitles[$courseTitleCounter] = $row["Course_Title"];
			$courseTitleCounter = $courseTitleCounter + 1;

			$contents[$contentsCounter] = $row["Message_Content"];
			$contentsCounter = $contentsCounter + 1;
		}

		echo "<div><br><br>";
		echo "<table><caption>Post History</caption>";
		echo "<tr><th>Course Title</th><th>Comment</th></tr>";
		
		for ($x = 0; $x < $courseTitleCounter; $x++)
		{
			echo "<tr>";
			echo "<td>";
			echo "" . $courseTitles[$x];
			echo "</td>";
			echo "<td>";
			echo "" . $contents[$x];
			echo "</td>";
			echo "</tr>";
		}

		echo "</table>";
		echo "</div><br><br>";
	}

	else
		echo "<h4 align='center'>You're not logged in. Click on account and then log in to do so.</h4>";

	mysqli_free_result($result);
	mysqli_close($conn);
?>
