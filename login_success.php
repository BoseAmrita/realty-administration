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
    <!doctype html>
    <html lang="en">
    <head>
        <title>Login Success</title>
        <meta charset="utf-8" />
        <link href="loginsuccess.css" rel="stylesheet" type="text/css" />
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
        <br>
        <div class="myadvertisement" style="float:right;font-size:1.5rem;font;style:bold;">
            <a style="color:black;background-color:white;" href="my_advertisement.php">My Advertisement</a>
        </div>
        <br>

                <?php
                $sql2="SELECT C.Mobile FROM contact C WHERE C.Uids IN (SELECT B.Uids FROM Sell S, buy B WHERE S.Uids='$result3[0]' AND S.AdId=B.AdId)";
                $sql3="SELECT E.Emailids FROM email E WHERE E.Uids IN (SELECT B.Uids FROM Sell S, buy B WHERE S.Uids='$result3[0]' AND S.AdId=B.AdId)";
                $mobile=mysqli_query($connect,$sql2) or die(mysqli_error($connect));
                $email=mysqli_query($connect,$sql3) or die(mysqli_error($connect));
                $count=mysqli_num_rows($email);
                if($count>0)
                {
                ?>
                    
                    <div class=sidebar>
                        <p>
                            <b>Contact Information of people who are interested in buying your property:</b>
                        </p>
                        <br>
                        <table border="2" cellspacing="2" cellpadding="5" id="interest">
                            <tr>
                                <th>Mobile</th>
                                <th>Email Id</th>
                            </tr>
                            <?php
                            While($mobile1=mysqli_fetch_array($mobile) AND $email1=mysqli_fetch_array($email))
                            {
                            ?>
                                <tr>
                                    <td><?php echo $mobile1['Mobile'] ?></td>
                                    <td><a href="mailto:<?php echo $email1['Emailids'] ?>"><?php echo $email1['Emailids'] ?></a></td>
                                </tr>
                            <?php
                            };
                            ?>
                        </table>
                    </div>
                <?php
                }
                
                
                else
                {
                ?>
                   <div class=sidebar>
                        <p>
                            <b>Contact Information of people who are interested in buying your property:</b>
                        </p>
                        <br>
                        <table border="2" cellspacing="2" cellpadding="5" id="interest">
                            <tr>
                                <th>Mobile</th>
                                <th>Email Id</th>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                            </tr>
                            
                        </table>
                        <br>
                    </div>
                   
                <?php

                } 
                ?>
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
