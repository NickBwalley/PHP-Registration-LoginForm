<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Registration</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
<?php
    require('db.php');
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['submit'])) {
        // removes backslashes
        $firstname = stripslashes($_REQUEST['firstname']);
        $lastname = stripslashes($_REQUEST['lastname']);
        $username = stripslashes($_REQUEST['username']);
        $email    = stripslashes($_REQUEST['email']);
        $phonenumber    = stripslashes($_REQUEST['phonenumber']);
        $password = stripslashes($_REQUEST['password']);
        //escapes special characters in a string
        $firstname = mysqli_real_escape_string($con, $firstname);
        $lastname = mysqli_real_escape_string($con, $lastname);
        $username = mysqli_real_escape_string($con, $username);
        $email    = mysqli_real_escape_string($con, $email);

        $password = mysqli_real_escape_string($con, $password);
        // $create_datetime = date("Y-m-d H:i:s");
        $query    = "INSERT into `users` (firstname, lastname, username, email, phonenumber, password)
                     VALUES ('$firstname', '$lastname', '$username', '$email', '$phonenumber', '" . md5($password) . "')";
        $result   = mysqli_query($con, $query);
        if ($result) {
            echo "<div class='form'>
                  <h3>You are registered successfully.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a></p>
                  </div>";
        } else {
            echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
                  </div>";
        }
    } else {
?>
    <form class="form" action="" method="post">
        <h1 class="login-title">Registration</h1>
        <input type="text" class="login-input" name="firstname" placeholder="FirstName" required />
        <input type="text" class="login-input" name="lastname" placeholder="LastName" required />
        <input type="text" class="login-input" name="username" placeholder="Username" required />
        <input type="text" class="login-input" name="email" placeholder="EmailAdress">
        <input type="text" class="login-input" name="phonenumber" placeholder="PhoneNumber">
        <input type="password" class="login-input" name="password" placeholder="Password">
        <input type="submit" name="submit" value="Register" class="login-button">
        <p class="link">Already have an account? <a href="login.php">Login here</a></p>
    </form>
<?php
    }
?>
</body>
</html>
