<html>
    <head>
       <title>Welcome page</title>
</head>
<body style="background-color:rgb(246, 176, 240);">
    <center style=padding:40px;>
        <h1 style=font-size:50px;>welcome</h1>
    
    <?php
// Start the session to access session variables
session_start();

// Display the welcome message along with user information
echo 'Hiii...!!!, ' . $_SESSION['first_name'] . ' ' . $_SESSION['last_name'] . '!';
echo '<br><br>';
echo 'Email: ' . $_SESSION['email'];
echo '<br><br>';
echo 'Phone Number: ' . $_SESSION['phone_number'];
echo '<br><br>';
echo 'Gender: ' . $_SESSION['gender'];

// You can also use the user_id session variable to retrieve additional information from the database if needed

// Other welcome page content goes here...
?>
</center>
</body>
</html>