<?php
// Database configuration
$host = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'users';

// Create a database connection
$conn = new mysqli('localhost', 'root','','users');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$firstName = $_POST['first_name'];
$lastName = $_POST['last_name'];
$email = $_POST['email'];
$phoneNumber = $_POST['phone_number'];
$profilePic = $_FILES['profile_pic']['name'];
$gender = $_POST['gender'];
$password = $_POST['password'];

// Perform form validation
$errors = array();
/*
if (count($errors) > 0) {
    // Display validation errors and redirect back to the registration form
    echo "<h2>Error:</h2><ul>";
    foreach ($errors as $error) {
        echo "<li>$error</li>";
    }
    echo "</ul>";
    echo '<a href="main.php">Back to Registration Form</a>';
} else {
    // Check if email already exists in the user table
    $query = "SELECT * FROM user WHERE email = '$email'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        // Email already exists, display error message
        echo "Email already exists. Please choose a different email.";
        echo '<a href="main.php">Back to Registration Form</a>';
    } else {
  */      // Save user data in the user table
        $query = "INSERT INTO user (first_name, last_name, email, phone_number, profile_pic, gender, password) VALUES ('$firstName', '$lastName', '$email', '$phoneNumber', '$profilePic', '$gender', '$password')";
        
        
        if ($conn->query($query) === TRUE) {
        // Registration successful, do any further processing here

        // Send email to the user with the successfully registered message
        
        
        // Redirect to another page or display a success message
        header("Location: welcome.html");
        exit();
    } 
    else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
  /*          // Registration successful, send email to the user
            $subject = "Registration Successful";
            $message = "Dear $firstName $lastName,\n\nYou have successfully registered.";
            $headers = "From: your_email@example.com";

            // Uncomment the following line to send the email (requires a mail server setup)
            // mail($email, $subject, $message, $headers);

            echo "SUCCESSFULLY REGISTERED...!!! \n An email has been sent to your email address.";
        } else {
            echo "Error: " . $query . "<br>" . $conn->error;
        }
        echo '<a href="main.html">Back to Login and Registration Form</a>';
*/
// Close database connection
$conn->close();
?>
