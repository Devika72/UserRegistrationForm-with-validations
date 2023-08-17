<?php
// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Check if the required parameters are provided
  if (isset($_POST['id']) && isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['phone_number'])) {
    // Retrieve the user ID and other details from the POST data
    $id = $_POST['id'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $phoneNumber = $_POST['phone_number'];

    // Connect to the database (replace with your own database credentials)
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'users';

    $conn = new mysqli('localhost', 'root', '', 'users');

    // Check the database connection
    if ($conn->connect_error) {
      // Return an error message if the connection fails
      die('Database connection failed: ' . $conn->connect_error);
    }

    // Prepare the SQL statement to update the user details
    $sql = 'UPDATE user SET first_name = ?, last_name = ?, phone_number = ? WHERE id = ?';

    // Create a prepared statement
    $stmt = $conn->prepare($sql);

    // Bind the parameters to the prepared statement
    $stmt->bind_param('sssi', $firstName, $lastName, $phoneNumber, $id);

    // Execute the prepared statement
    if ($stmt->execute()) {
      // Return a success message if the user details are updated successfully
      echo 'User details updated successfully.';
    } else {
      // Return an error message if there's an issue with updating the user details
      echo 'Error updating user details.';
    }

    // Close the prepared statement and database connection
    $stmt->close();
    $conn->close();
  } else {
    // Return an error message if the required parameters are not provided
    echo 'User ID, first name, last name, and phone number are required.';
  }
} else {
  // Return an error message if the request method is not POST
  echo 'Invalid request method.';
}
