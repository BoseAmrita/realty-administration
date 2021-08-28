<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" type="text/css" href="forgot_password.css">
</head>
<body>
<nav id="nav_bar">
        <div id="logo">
            <img src="logo.jpg" alt="Real Estate">
        </div>
        <ul>
            <li class="items"><a href="index.html">Home</a></li>
            <li class="items"><a href="about.html">About</a></li>
            <li class="items"><a href="services.html">Services</a></li>
            <li class="items"><a href="contactus.html">Contact Us</a></li>
            <li class="items"><a href="login.html">Login</a></li>
            <li class="items"><a href="sign_up.html">Signup</a></li>
        </ul>
    </nav>
    <br>
    <form action="forgotPassword.php" method="POST" id="fp">
        <br><br>
        <h1>Input Email</h1><br>
        <input type="email" name="username" placeholder="Your Email...." required><br><br>
        <input type="submit" value="Forget Password" name="submit" id="submit">
        <br><br>
    </form>

    <footer>
        <div >
            Copyright &copy; www.realestate.com. All rights reserved!
        </div>
    </footer>
</body>
</html>
<?php
    $servername="localhost"; // Host name
    $username="root"; // mysqli username
    $password=""; // mysqli password
    $db_name="realestate"; // Database name
    $tbl_name="Users"; // Table name
    // Connect to server and select databse.
    $connection=mysqli_connect("$servername", "$username", "$password","$db_name")or die("cannot connect");
    if(isset($_POST) & !empty($_POST))
    {
        $username = mysqli_real_escape_string($connection, $_POST['username']);
        $sql = "SELECT * FROM `Email` WHERE Emailids = '$username'";
        $sql1= "SELECT Password FROM Users U, Email E WHERE U.Uids=E.Uids AND E.Emailids='$username'";
        $res = mysqli_query($connection, $sql);
        $res1 = mysqli_query($connection, $sql1);
        $row = mysqli_fetch_row($res1);
        $count = mysqli_num_rows($res);
        if($count == 1)
        {
            $r = mysqli_fetch_assoc($res);
            $password = $row[0];
           
            $subject = "Your Recovered Password";
            $message = "Please use this password to login " . $password;
            // $headers = 'MIME-Version: 1.0' . "\r\n";
            // $headers .= 'From: saksham.patel2019@vitstudent.ac.in' . "\r\n";
            // $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            // ini_set("SMTP","smtp.gmail.com");
            // ini_set("smtp_port","465");
            // ini_set('sendmail_from', 'saksham.patel2019@vitstudent.ac.in');
            $to = $r['Emailids'];
            if(mail($to, $subject, $message))
            {
                echo "<script>alert('Your Password has been sent to your email id! You can login now')</script>";
                echo '<script language="javascript">window.location = "http://localhost/iwp_project/login.html"</script>';
                echo '<body style="background-color: rgb(196, 181, 181);">';
            }
            else
            {
                echo "<script>alert('Failed to Recover your password, try again')</script>";
                echo '<script language="javascript">window.location = "http://localhost/iwp_project/forgotPassword.php"</script>';
                echo '<body style="background-color: rgb(196, 181, 181);">';
            }
        }
        else
        {
            echo "<script>alert('User name does not exist')</script> ";
            echo '<script language="javascript">window.location = "http://localhost/iwp_project/forgotPassword.php"</script>';
            echo '<body style="background-color: rgb(196, 181, 181);">';
            
        }
    }
?>

    
 


