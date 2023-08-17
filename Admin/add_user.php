<?php
// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Check if the required parameters are provided
  if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['phone_number']) && isset($_POST['password'])) {
    // Retrieve the user details from the POST data
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phone_number'];
    $password = $_POST['password'];

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

    // Prepare the SQL statement to insert a new user
    $sql = 'INSERT INTO user (first_name, last_name, email, phone_number, password) VALUES (?, ?, ?, ?, ?)';

    // Create a prepared statement
    $stmt = $conn->prepare($sql);

    // Hash the password before storing it in the database (optional but recommended)
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Bind the parameters to the prepared statement
    $stmt->bind_param('sssss', $firstName, $lastName, $email, $phoneNumber, $hashedPassword);

    // Execute the prepared statement
    if ($stmt->execute()) {
      // Return a success message if the user is added successfully
      echo 'User added successfully.';
    } else {
      // Return an error message if there's an issue with adding the user
      echo 'Error adding user.';
    }

    // Close the prepared statement and database connection
    $stmt->close();
    $conn->close();
  } else {
    // Return an error message if the required parameters are not provided
    echo 'First name, last name, email, phone number, and password are required.';
  }
} else {
  // Return an error message if the request method is not POST
  echo 'Invalid request method.';
}
