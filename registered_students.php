<!DOCTYPE html>
<html>
<head>
	<title>List of Registered Students</title>
	<style>
		table, th, td {
			border: 1px solid black;
			border-collapse: collapse;
			padding: 5px;
		}
	</style>
</head>
<body>
	<h1>List of Registered Students</h1>

	<?php
		// Connect to the MySQL database
		$servername = "192.168.1.35:3306";
		$username = "root";
		$password = "123456";
		$dbname = "webtech_registration";
		$conn = new mysqli($servername, $username, $password, $dbname);

		// Check if the connection was successful
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		// Query the database to get the list of registered students
		$sql = "SELECT id, first_name, last_name, project_title, email, phone, time_slot FROM students";
		$result = $conn->query($sql);

		// Check if there are any registered students
		if ($result->num_rows > 0) {
			echo "<table>";
			echo "<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Project Title</th><th>Email Address</th><th>Phone Number</th><th>Time Slot</th></tr>";
			// Output data of each row
			while($row = $result->fetch_assoc()) {
				echo "<tr>";
				echo "<td>" . $row["id"] . "</td>";
				echo "<td>" . $row["first_name"] . "</td>";
				echo "<td>" . $row["last_name"] . "</td>";
				echo "<td>" . $row["project_title"] . "</td>";
				echo "<td>" . $row["email"] . "</td>";
				echo "<td>" . $row["phone"] . "</td>";
				echo "<td>" . $row["time_slot"] . "</td>";
				echo "</tr>";
			}
			echo "</table>";
		} else {
			echo "No registered students yet.";
		}

		// Close the database connection
		$conn->close();
	?>
</body>
</html>
