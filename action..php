<?php

// Connect to MySQL database
$servername = "webtechrregistration.cd980i6aedie.us-east-2.rds.amazonaws.com:3306";
$username = "root";
$password = "12345678";
$dbname = "webtechRregistration";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Define the number of seats available for each time slot
$seats_available = array(
  "10:00 AM - 11:00 AM" => 50,
  "11:00 AM - 12:00 PM" => 50,
  "12:00 PM - 1:00 PM" => 50,
  "1:00 PM - 2:00 PM" => 50,
  "2:00 PM - 3:00 PM" => 50,
  "3:00 PM - 4:00 PM" => 50
);

// Get the number of registered users for each time slot
$sql = "SELECT timeslot, COUNT(*) AS count FROM registration GROUP BY timeslot";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $timeslot = $row["timeslot"];
    $count = $row["count"];
    $seats_available[$timeslot] -= $count;
  }
}

// Display the number of available seats for each time slot
echo "<h2>Available time slots:</h2>";
foreach ($seats_available as $timeslot => $seats) {
  if ($seats > 0) {
    echo "<p>$timeslot ($seats seats available)</p>";
  } else {
    echo "<p>$timeslot (fully booked)</p>";
  }
}

// Process user input data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = test_input($_POST["id"]);
    $first_name = test_input($_POST["first_name"]);
    $last_name = test_input($_POST["last_name"]);
    $project_title = test_input($_POST["project_title"]);
    $email = test_input($_POST["email"]);
    $phone = test_input($_POST["phone"]);
    $timeslot = test_input($_POST["timeslot"]);
  
    // Validate user input data
    $id_pattern = "/^[0-9]{8}$/";
    $name_pattern = "/^[a-zA-Z ]*$/";
    $email_pattern = "/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
    $phone_pattern = "/^[0-9]{10}$/";
  
    $id_error = "";
    $name_error = "";
    $email_error = "";
    $phone_error = "";
  
    if (!preg_match($id_pattern, $id)) {
      $id_error = "Invalid ID format. Please enter an 8-digit ID number.";
    }
  
    if (!preg_match($name_pattern, $first_name)) {
      $name_error = "Invalid first name format. Please enter letters only.";
    }
  
    if (!preg_match($name_pattern, $last_name)) {
      $name_error = "Invalid last name format. Please enter letters only.";
    }
  
    if (!preg_match($email_pattern, $email)) {
      $email_error = "Invalid email format. Please enter a valid email address.";
    }
  
    if (!preg_match($phone_pattern, $phone)) {
      $phone_error = "Invalid phone number format. Please enter a 10-digit phone number.";
    }
// Close MySQL connection
$conn->close();

?>
