<!DOCTYPE html>
<html>
<head>
	<title>WebTech Registration Form</title>
	<link rel="stylesheet" type="text/css" href="./style.css">
	<script type="text/javascript" src="./script.js"></script>
</head>
<body>
	<div class="container">
		<h1>WebTech Registration Form</h1>
		<?php include 'seats.php'; ?>
		<table>
			<thead>
			  <tr>
				<th>Time Slot</th>
				<th>Available Seats</th>
			  </tr>
			</thead>
			<tbody>
			  <tr>
				<td>Morning (9am-12pm)</td>
				<td id="morning-seats"><?php echo $morning_seats > 0 ? $morning_seats : 'Sold Out'; ?></td>
			  </tr>
			  <tr>
				<td>Afternoon (1pm-4pm)</td>
				<td id="afternoon-seats"><?php echo $afternoon_seats > 0 ? $afternoon_seats : 'Sold Out'; ?></td>
			  </tr>
			  <tr>
				<td>Evening (5pm-8pm)</td>
				<td id="evening-seats"><?php echo $evening_seats > 0 ? $evening_seats : 'Sold Out'; ?></td>
			  </tr>
			</tbody>
		  </table>
		<form method="POST" action="./action.php" onsubmit="return validateForm()" data-netlify="true">
			<label for="id">ID:</label>
			<input type="text" id="id" name="id" placeholder="Enter your ID number">

			<label for="first_name">First Name:</label>
			<input type="text" id="first_name" name="first_name" placeholder="Enter your first name">

			<label for="last_name">Last Name:</label>
			<input type="text" id="last_name" name="last_name" placeholder="Enter your last name">

			<label for="project_title">Project Title:</label>
			<input type="text" id="project_title" name="project_title" placeholder="Enter your project title">

			<label for="email">Email Address:</label>
			<input type="email" id="email" name="email" placeholder="Enter your email address">

			<label for="phone_number">Phone Number:</label>
			<input type="tel" id="phone_number" name="phone_number" placeholder="Enter your phone number">

			<label for="time_slot">Preferred Time Slot:</label>
			<select id="time_slot" name="time_slot">
				<option value="morning">Morning (9am-12pm)</option>
				<option value="afternoon">Afternoon (1pm-4pm)</option>
				<option value="evening">Evening (5pm-8pm)</option>
			</select>

			<input type="submit" value="Submit">
		</form>
	</div>
</body>
</html>
