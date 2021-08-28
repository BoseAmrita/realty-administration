<?php
$sess1 = session_id();
if ($sess1 == '') session_start();
if((!isset($_SESSION['username'])))
{
    header("location: login.html");

}
else
{
    $host="localhost"; // Host name
    $username="root"; // mysqli username
    $password=""; // mysqli password
    $db_name="realestate"; // Database name
    $tbl_name="Users"; // Table name
    $name=$_SESSION['username'];
    // Connect to server and select database.
    $connect=mysqli_connect("$host", "$username", "$password","$db_name")or die("cannot connect");
    $sql="SELECT * FROM Users U, email E, contact C WHERE U.Uids=E.Uids AND C.Uids=U.Uids AND E.Emailids='$name'";
    $result=mysqli_query($connect,$sql);
    $result1=mysqli_fetch_array($result);
    $sql1="SELECT U.Uids FROM Users U, email E WHERE U.Uids=E.Uids AND E.Emailids='$name'";
    $result2=mysqli_query($connect,$sql1);
    $result3=mysqli_fetch_array($result2);
    $_SESSION['userid'] = $result3[0];
    $_SESSION['name'] = $result1['F_name'];
    $_SESSION['lname']=$result1['L_name'];
    $_SESSION['email']=$result1['Emailids'];
    $_SESSION['mobile']=$result1['Mobile'];
?>
    <!Doctype html>
    <html lang="en">
    <head>
        <title>My Profile</title>
        <meta charset="utf-8" />
        <link href="myprofile.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
    <nav id="nav_bar">
            <div id="logo">
                <img src="logo.jpg" alt="Real Estate">
            </div>
            <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="about.html">About</a></li>
                    <li><a href="services.html">Services</a></li>
                    <li><a href="contactus.html">Contact Us</a></li>
                    <li><a href="my_profile.php">My Profile</a></li>
                    <li><a href="search.html">Search Advertisement</a></li>
                    <li><a href="create_advertisement.php">Create Advertisement</a></li>
                    <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
        <div class="welcome">
            <p> 
                <h3>Your Details are : </h3> <br>
                <b>Name :</b> <?php echo $_SESSION['name']." ".$result1['L_name']; ?><br><br>
                <b>Email Id:</b> <?php echo $_SESSION['email']?> <br><br>
                <b>Contact No:</b> <?php echo $_SESSION['mobile']?><br>
            </P>
            
        </div> 
        <footer>
                    <div >
                        Copyright &copy; www.realestate.com. All rights reserved!
                    </div>
                </footer>
    </body>
</html>
<?php
}
?>
