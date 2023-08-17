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

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the "password" key exists in $_POST array
    if (isset($_POST['password'])) {
        // Retrieve form data
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Retrieve user data from the "user" table
        $query = "SELECT * FROM user WHERE email = '$email'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            session_start();
            $_SESSION['email'] = $row['email'];
            $_SESSION['first_name'] = $row['first_name'];
            $_SESSION['last_name'] = $row['last_name'];
            $_SESSION['phone_number'] = $row['phone_number'];
            $_SESSION['gender'] = $row['gender'];



            if ($password === $row['password']) {
                // Redirect to the welcome page
                header("Location: welcome.php");
                exit();
            } else {
                // Show alert message for wrong password
                echo '<script>
                        alert("Invalid password. Please try again.");
                        window.location.href = "login.html";
                      </script>';
            }
        } else {
            // Show alert message for email not found
            echo '<script>
                    alert("Email not found. Please try again.");
                    window.location.href = "login.html";
                  </script>';
        }
    }
}

// Close the database connection
$conn->close();
?>
