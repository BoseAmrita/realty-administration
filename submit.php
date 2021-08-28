<?php
    $host="localhost"; // Host name
    $username="root"; // mysqli username
    $password=""; // mysqli password
    $db_name="realestate"; // Database name
    $tbl_name="Users"; // Table name
    $tbl_name1="U_Address";
    $tbl_name2="Contact";
    $tbl_name3="Email";
    $connect=mysqli_connect("$host","$username","$password","$db_name") or die("cannot connect");
    // Get values from form
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $name=$_POST["firstname"];
        $lastname=$_POST["lastname"];
        $email=$_POST["email"];
        $pwd=$_POST["pwd"];
        $pwd=md5($pwd);
        $gender=$_POST["gender"];
        $contact=$_POST["contact"];
        $street=$_POST["street"];
        $city=$_POST["city"];
        $house=$_POST["house"];
        $zip=$_POST["zip"];

        $sql4="SELECT EMAILIDS FROM $tbl_name3 where EMAILIDS='$email'";
        $result4 = mysqli_query($connect,$sql4);
        $count=mysqli_num_rows($result4);
        if($count==0)
        {
            // Insert data into mysqlii
            $sql="INSERT INTO $tbl_name(F_name, L_name, Gender, Password)VALUES('$name', '$lastname','$gender', '$pwd')";
            $sql1="INSERT INTO $tbl_name1(Street, House, Zip, City, Uids)VALUES('$street', '$house', '$zip', '$city',
            (SELECT Uids FROM Users WHERE Users.Uids=(SELECT max(Uids) FROM Users)))";
            $sql2="INSERT INTO $tbl_name2(Mobile, Uids)VALUES('$contact', (SELECT Uids FROM Users
            WHERE Users.Uids=(SELECT max(Uids) FROM Users)))";
            $sql3="INSERT INTO $tbl_name3(Emailids, Uids)VALUES('$email', (SELECT Uids FROM Users
            WHERE Users.Uids=(SELECT max(Uids) FROM Users)))"; 
            $result=mysqli_query($connect,$sql);
            $result1=mysqli_query($connect,$sql1);
            $result2=mysqli_query($connect,$sql2);
            $result3=mysqli_query($connect,$sql3);
            // if successfully insert data into database, displays message "Successful".
            if($result && $result1 && $result2 && $result3)
            {
                echo '<script language="javascript">alert("You are successfully registered! You can login now")</script>';
                echo '<script language="javascript">window.location = "http://localhost/iwp_project/login.html"</script>';
                echo '<body style="background-color: rgb(196, 181, 181);">';
                
            }
            else 
            {
                echo '<script language="javascript">alert("SIGN UP FAILED DUE TO SOME ERROR, TRY AGAIN")</script>';
                echo '<script language="javascript">window.location = "http://localhost/iwp_project/sign_up.html"</script>'; 
                echo '<body style="background-color: rgb(196, 181, 181);">';
                
            }
        }
        else{
            echo '<script language="javascript">confirm("USER ALREADY EXIST, TRY WITH ANOTHER EMAIL ID")</script>';
            echo '<script language="javascript">window.location = "http://localhost/iwp_project/sign_up.html"</script>';
            echo '<body style="background-color: rgb(196, 181, 181);">';
            
        }
        
    }

    // close connection
    mysqli_close($connect);
?>
