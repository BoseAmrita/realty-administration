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

    $sql1 = "SELECT Uids FROM Email WHERE Emailids='$name'";
    $result1 = mysqli_query($connect,$sql1);
    $row1=mysqli_fetch_array($result1);
    $id = $row1[0];

    $sql2 = "SELECT *FROM Estate WHERE Uids='$id'";
    $result2 = mysqli_query($connect,$sql2);

    $sql3 = "SELECT city from Location l, Estate e where l.Eids=e.Eids";
    $result3 =  mysqli_query($connect,$sql3);
    $sql4 = "SELECT Idata from Upload u, Estate e where u.Eids=e.Eids";
    $result4 =  mysqli_query($connect,$sql4);
    ?>
        <html>
        <head>
            <title>My Advertisement Display</title>
            <link rel="stylesheet" type="text/css" href="search_action.css">
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
            <h1>Your Advertisement</h1>
            <br><br>

                <table border="1" cellspacing="1" cellpadding="5">
                        <tr>
                            <th >Image</th>
                            <th>Price</th>
                            <th>Rooms</th>
                            <th>Bathrooms</th>
                            <th>Area(sq meter)</th>
                            <th>Location</th>
                            <th>Surface</th>
                            <th>Type</th>
                        </tr>
                    <?php
                    While(($row2=mysqli_fetch_array($result2)) && ($row3=mysqli_fetch_array($result3)) && ($row4=mysqli_fetch_array($result4)))
                    {
                    ?>
                                <tr>
                                    <td><img src="upload/<?php echo $row4[0] ?>" alt="Image" width="80" height="80"></td>
                                    <td><?php echo $row2['Price'] ?></td>
                                    <td><?php echo $row2['Room'] ?></td>
                                    <td><?php echo $row2['Bathroom'] ?></td>
                                    <td><?php echo $row2['Area'] ?></td>
                                    <td><?php echo $row3[0] ?></td>
                                    <td><?php echo $row2['Surface'] ?></td>
                                    <td><?php echo $row2['Etype'] ?></td>
                                </tr>
                    
                
                <?php
                };
            ?>
            </table>
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
    
