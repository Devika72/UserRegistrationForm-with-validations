<?php
// Assuming you have a database connection established

// Get the email from the request
$email = $_POST['email'];

// Check if the email already exists in the user table
$query = "SELECT COUNT(*) FROM user WHERE email = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$email]);
$count = $stmt->fetchColumn();

// Return the response
if ($count > 0) {
    echo 'exists';
} else {
    echo 'not_exists';
}
?>