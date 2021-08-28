<?php
$sess1 = session_id();
if ($sess1 == '') session_start();
if((!isset($_SESSION['username'])))
{
    echo '<script language="javascript">confirm("Please Login/Register to buy any Estate")</script>';
    echo '<script language="javascript">window.location = "http://localhost/iwp/login.html"</script>';
}
else
{
    $host="localhost"; // Host name
    $username="root"; // mysqli username
    $password=""; // mysqli password
    $db_name="realestate"; // Database name
    $eid=$_POST['Eid'];
    $buy=$_POST['Buy'];
    // Connect to server and select database.
    $connect=mysqli_connect("$host","$username","$password","$db_name")or die("cannot connect");
    $sql="SELECT S.AdId FROM sell S, placed_for P WHERE P.Eids=$eid AND S.AdId=P.AdId";
    $result = mysqli_query($connect,$sql) or die(mysqli_error($connect));
    $row=mysqli_fetch_array($result);
    $Ad=$row['AdId'];
    $Uid=$_SESSION['userid'];
    $check="SELECT * FROM Buy B WHERE B.Uids=$Uid AND B.AdId=$Ad";
    $check1=mysqli_query($connect,$check);
    $count=mysqli_num_rows($check1);
    if($count==0)
    {
        $sql1="INSERT INTO Buy(AdId, Uids)VALUES('$Ad', '$Uid')";
        $result1 = mysqli_query($connect,$sql1) or die(mysqli_error($connect));
        if($result1)
        {
            ?>

                <html >
                    <head>
                        
                        <title>Estate Buy Status</title>
                        <link href="estate.css" rel="stylesheet" type="text/css" />
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
                        <br><br>
                        <div id="buy_status">
                            <fieldset style="width:fit-content;font-weight:bold;font-size:1.5rem;">
                                <legend style="text-align:center;">
                                    <b>Information Sending Status</b> 
                                </legend>
                                <br>
                                        
                                <p >
                                    <b>
                                        <i>Your Contact Information Has Been Sent To The Owner Of This Advertisement. He Will Contact You Soon</i>
                                    </b> 
                                </p>
                                <br>
                                <div>
                                    <a href="search.html">Click here to search another advertisement</a>
                                </div>
                                <br>
                                
                            </fieldset>
                            <br>
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
        else
        {
            ?>
                <html >
                    <head>
                        
                        <title>Estate Buy Status</title>
                        <link href="estate.css" rel="stylesheet" type="text/css" />
                        
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
                        <br><br>
                        <div id="buy_status">
                            <fieldset style="width:fit-content;font-weight:bold;font-size:1.5rem;">
                                <legend style="text-align:center;">
                                    <b>Information Sending Status</b> 
                                </legend>
                                <br>
                                        
                                <p >
                                    <b>
                                        <i>Error in Sending Data</i></b> 
                                            
                                </p>
                                <br>
                                <div>
                                    <a href="search.html">Click here to search advertisement again</a>
                                 </div>

                                <br>
                            </fieldset>
                            <br>
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
    }
    else
    {
        ?>
            <html >
                <head>
                    <title>Estate Buy Status</title>
                        <link href="estate.css" rel="stylesheet" type="text/css" />
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
                    <br><br>
                    <div id="buy_status" >
                        <fieldset style="width:fit-content;font-weight:bold;font-size:1.5rem;">
                            <legend style="text-align:center;">
                                <b>Information Sending Status</b> 
                            </legend>
                            <br>
                                        
                            <p >
                                <b><i>You have already applied for this estate the owner have your information he will contact you soon</i></b> 

                            </p>
                           
                            <br>
                            <div>
                                <a href="search.html">Click here to search another advertisement</a>
                            </div>
                            <br>
                        </fieldset>
                        <br>
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
}
?>
