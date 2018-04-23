<!DOCTYPE html>
<html>
<!-- Source code originates from https://www.w3schools.com/howto/howto_css_login_form.asp -->
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
form {border: 3px solid #f1f1f1;}

input[type=text], input[type=password] {
    width: 25%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

button {
    background-color: #f4da70;
    color: black;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 15%;
}

button:hover {
    opacity: 0.8;
}


.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
}

img.avatar {
    width: 20%;
    border-radius: 20%;
}

.container {
    padding: 16px;
}

span.psw {
    float: right;
    padding-top: 16px;
}

/* Change styles for span button on extra small screens */
@media screen and (max-width: 300px) {
    span.psw {
       display: block;
       float: none;
    }
}
</style>
</head>
<body>

<h2 style="text-align:center"><font face="garamond" size ="8" >Titanic Treasures</font></h2>

<form action="/action_page.php">
  <div class="imgcontainer">
    <img src="iceberg.jpg" alt="Avatar" class="avatar">
  </div>

  <div class="container">
  <center>
    <input type="text" placeholder="Username" name="uname" required>
    <br>
    <input type="password" placeholder="Password" name="psw" required>
    <br>
    <input type="text" placeholder="Email" name="email" required>
    <br>
    <input type="text" placeholder="Street Address 1" name="stradd1" required>
    <br>
    <input type="text" placeholder="Street Address 2 (optional)" name="stradd2">
    <br>
    <input type="text" placeholder="City" name="city" required>
    <br>
    <input type="text" placeholder="State" name="state" required>
    <br>
    <input type="text" placeholder="Zip" name="zip" required>
    <br>
    <input type="password" placeholder="Card Number" name="cardnum" required>
    <br>
    <input type="password" placeholder="Card Expiration Date" name="cardexp" required>
    <br>
    <input type="password" placeholder="Card Security Code" name="cardsec" required>
    <br>
    Upload a JPG file for your Avatar: <input type='file' name='filename' size='10'>
    <input type='submit' value='Upload'>
<br>
<p>
<?php

if ($_FILES)
{
    $name = basename($_FILES['filename']['name']);
    $target_dir = 'uploads/';
    
    if (is_dir($target_dir)){
    
    if($_FILES['filename']['type']=='application/jpg')
    {
        $file_location = $target_dir.$name;
        if (file_exists($file_location)){
            echo "The file '$name' already exists.";
        }
        else move_uploaded_file($_FILES['filename']['tmp_name'], $file_location);

    }

}

}

?>
    <button type="submit">Create Profile</button>
    <br>
    </center>
  </div>
</form>

</body>
</html>
