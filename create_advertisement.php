<?php
$sess1 = session_id();
if ($sess1 == '') session_start();
if((!isset($_SESSION['username'])))
{
    header("location:login.html");
    exit();
}
else
{
    ?>
    <!Doctype html>
    <html lang="en">
    <head>
        <title>Create Advertisement or Give Estate Information</title>
        <link href="estate.css" rel="stylesheet" type="text/css" />
        <script>
            $(function() {
                $( "#radio" ).buttonset();
            });
        </script>
        <script>
            function ValidateContactForm()
            {
                var price = document.estate_input.price;
                var area = document.estate_input.area;
                var city = document.estate_input.city;
                if (price.value == "")
                {
                    window.alert("Please enter price for your estate.");
                    price.focus();
                    return false;
                }
                if (area.value == "")
                {
                    window.alert("Please enter area of your estate.");
                    area.focus();
                    return false;
                if (city.value == "")
                {
                    window.alert("Please enter city in which the estate is located.");
                    city.focus();
                    return false;
                }
                return true;
            }
        </script>
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
        <div class="estateinfo">
            <form method="POST" name="estate_input" action="estate_input.php" id="create" onsubmit="return ValidateContactForm();" enctype="multipart/form-data">
                <br>
                <h2>Create Advertisement</h2>
                <br><br>
                <div id="radio">
                    <input type="radio" id="radio1" name="radio" checked="checked" value="sale" /><b>For Sale</b>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" id="radio2" name="radio" value="rent" /><b>For Rent</b>
                </div>
                <br>
                Price (in Rs.): <input type="text" name="price"><br><br>
                Area (in square meters): <input type="text" name="area">
                &nbsp;&nbsp;
                Rooms: <select name="room">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                <br><br>    
                Bathrooms: <select name="bathroom">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    
                Surface: <select name="surface">
                            <option value="tile">Tile</option>
                            <option value="wooden">Wooden</option>
                            <option value="marbel">Marbels</option>
                            <option value="carpet">Carpet</option>
                        </select>
                <br><br>
                Image: <input type="file" name="file" id="file">
                Title: <input type="text" name="title"><br>
                <br>
                Estate Type: <select name="etype">
                                <option value="house">House</option>
                                <option value="office">Office</option>
                            </select><br>
                <br>
                <caption>Additional Info:</caption>
                <TEXTAREA NAME="additional"> </TEXTAREA>
                <label for="">(Optional)</label>
                <br><br>
                <fieldset>
                    <legend style="margin-left:30px"><b>Location:</b></legend>
                        House: <input type="text" name="house">
                        City: <input type="text" name="city"><br><br>
                        Street: <input type="text" name="street">
                        Zip: <input type="text" name="zip">
                        <br><br>
                </fieldset>
                <br>
                
                <input type="submit" value="Send" id="submit">
                <input type="reset" value="Reset" id="reset">
                <br><br>
            </form>
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
