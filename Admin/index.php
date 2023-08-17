<?php
// Database configuration
$host = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'users';

// Create a database connection
$conn = new mysqli('localhost', 'root', '', 'users');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve data from the "user" table
$query = "SELECT * FROM user";
$result = $conn->query($query);

// Check if there are any rows returned
if ($result->num_rows > 0) {
    // Generate table rows dynamically
    $tableRows = '';
    while ($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $lastName = $row['last_name'];
        $email = $row['email'];
        $phoneNumber = $row['phone_number'];

        $tableRows .= '<tr>';
        $tableRows .= '<td>' . $id . '</td>';
        $tableRows .= '<td>' . $lastName . '</td>';
        $tableRows .= '<td>' . $email . '</td>';
        $tableRows .= '<td>' . $phoneNumber . '</td>';
        $tableRows .= '<td><button class="btn btn-sm btn-primary">Edit</button> <button class="btn btn-sm btn-danger">Delete</button></td>';
        $tableRows .= '</tr>';
    }

    // Return the table rows as the response
    echo $tableRows;
} else {
    // No rows found
    echo '<tr><td colspan="5">No data found.</td></tr>';
}

// Close the database connection
$conn->close();
?>
