<?php
    $sess1 = session_id();
    if ($sess1 == '') session_start();
    $host="localhost"; // Host name
    $username="root"; // mysqli username
    $password=""; // mysqli password
    $db_name="realestate"; // Database name
    $tbl_name="Users"; // Table name
    // Connect to server and select database.
    $connect=mysqli_connect("$host", "$username", "$password","$db_name")or die("cannot connect");
    // Get values from form
    $type=$_POST['radio'];
    $min_price=$_POST['min'];
    $max_price=$_POST['max'];
    $rooms=$_POST['rooms'];
    $bathrooms=$_POST['bathrooms'];
    $area=$_POST['area'];
    $location=$_POST['location'];
    $surface=$_POST['surface'];
    $text=$_POST['search'];
    if($location && $text)
    {
        $sql="SELECT E.* , U.Idata, L.City, S.Uids FROM Estate AS E LEFT JOIN Upload AS U ON U.Eids=E.Eids
        LEFT JOIN placed_for AS P ON P.Eids=E.Eids LEFT JOIN sell AS S ON S.AdId=P.AdId LEFT JOIN location
        AS L ON L.Eids=E.Eids WHERE S.AdType='$type' AND L.City='$location' AND E.Surface='$surface' AND
        E.Room>='$rooms' AND E.Bathroom>='$bathrooms' AND E.Area>='$area' AND E.Etype='$text' AND
        E.Price<='$max_price' AND E.Price>='$min_price' ORDER BY E.Price ASC";
    }
    else if($location && !$text)
    {
        $sql="SELECT E.* , U.Idata, L.City, S.Uids FROM Estate AS E LEFT JOIN Upload AS U ON U.Eids=E.Eids
        LEFT JOIN placed_for AS P ON P.Eids=E.Eids LEFT JOIN sell AS S ON S.AdId=P.AdId LEFT JOIN location
        AS L ON L.Eids=E.Eids WHERE S.AdType='$type' AND L.City='$location' AND E.Surface='$surface' AND
        E.Room>='$rooms' AND E.Bathroom>='$bathrooms' AND E.Area>='$area' AND E.Price<='$max_price' AND
        E.Price>='$min_price' ORDER BY E.Price ASC";
    }
    else if($text && !$location)
    {
        $sql="SELECT E.* , U.Idata, L.City, S.Uids FROM Estate AS E LEFT JOIN Upload AS U ON U.Eids=E.Eids
        LEFT JOIN placed_for AS P ON P.Eids=E.Eids LEFT JOIN sell AS S ON S.AdId=P.AdId LEFT JOIN location
        AS L ON L.Eids=E.Eids WHERE S.AdType='$type' AND E.Surface='$surface' AND E.Room>='$rooms' AND
        E.Bathroom>='$bathrooms' AND E.Area>='$area' AND E.Etype='$text' AND E.Price<='$max_price' AND
        E.Price>='$min_price' ORDER BY E.Price ASC";
    }
    else
    {
        $sql="SELECT E.* , U.Idata, L.City, S.Uids FROM Estate AS E LEFT JOIN Upload AS U ON U.Eids=E.Eids
        LEFT JOIN placed_for AS P ON P.Eids=E.Eids LEFT JOIN sell AS S ON S.AdId=P.AdId LEFT JOIN location
        AS L ON L.Eids=E.Eids WHERE S.AdType='$type' AND E.Surface='$surface' AND E.Room>='$rooms' AND
        E.Bathroom>='$bathrooms' AND E.Area>='$area' AND E.Price<='$max_price' AND E.Price>='$min_price'
        ORDER BY E.Price ASC";
    }
    $result = mysqli_query($connect,$sql) or die(mysqli_error());
    $count=mysqli_num_rows($result);
    if($count==0)
    {
        echo '<script language="javascript">confirm("Sorry no estate match your specification try reducing some constraints")</script>';
        echo '<script language="javascript">window.location = "http://localhost/iwp_project/search.html"</script>';
    }
    else
    {
        ?>
        <html>
        <head>
            <title>Advertisement Display</title>
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
            <h1>Matched Advertisement</h1>
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
                    <th >Apply</th>
                </tr>
            <?php
            While($row=mysqli_fetch_array($result))
            {
            ?>
                        <tr>
                            <td><img src="upload/<?php echo $row['Idata'] ?>" alt="Image" width="80" height="80"></td>
                            <td><?php echo $row['Price'] ?></td>
                            <td><?php echo $row['Room'] ?></td>
                            <td><?php echo $row['Bathroom'] ?></td>
                            <td><?php echo $row['Area'] ?></td>
                            <td><?php echo $row['City'] ?></td>
                            <td><?php echo $row['Surface'] ?></td>
                            <td><?php echo $row['Etype'] ?></td>
                        <?php
                        if((isset($_SESSION['username'])))
                        {
                            if($_SESSION['userid']!=$row['Uids'])
                            {
                                ?>
                                <td>
                                    <form method="POST" action="buy.php" name="buyer">
                                        <input type="submit" value="BUY" name="Buy">
                                        <input type="hidden" name="Eid" value="<?php echo $row['Eids'] ?>">
                                    </form>
                                </td>
                                <?php
                            }
                            else
                            {
                                ?>
                                <td>
                                    You'r Owner
                                </td>
                                <?php
                            }
                        }
                        else
                        {
                            ?>
                            <td>
                                Login to buy
                            </td>
                            <?php
                        }
                        ?>
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


