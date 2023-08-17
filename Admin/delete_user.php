<?php
// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Check if the 'id' parameter is provided
  if (isset($_POST['id'])) {
    // Retrieve the user ID from the POST data
    $id = $_POST['id'];

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

    // Prepare the SQL statement to delete the user
    $sql = 'DELETE FROM user WHERE id = ?';

    // Create a prepared statement
    $stmt = $conn->prepare($sql);

    // Bind the user ID parameter to the prepared statement
    $stmt->bind_param('i', $id);

    // Execute the prepared statement
    if ($stmt->execute()) {
      // Return a success message if the user is deleted successfully
      echo 'User deleted successfully.';
    } else {
      // Return an error message if there's an issue with deleting the user
      echo 'Error deleting user.';
    }

    // Close the prepared statement and database connection
    $stmt->close();
    $conn->close();
  } else {
    // Return an error message if the 'id' parameter is not provided
    echo 'User ID is required.';
  }
} else {
  // Return an error message if the request method is not POST
  echo 'Invalid request method.';
}
