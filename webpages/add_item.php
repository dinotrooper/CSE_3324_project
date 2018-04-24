<!DOCTYPE html>
<html>
<!-- Source code originates from https://www.w3schools.com/howto/howto_css_login_form.asp -->
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href='https://fonts.googleapis.com/css?family=Bubbler One' rel='stylesheet'>
<style>
body {font-family: 'Bubbler One', Arial, Helvetica, sans-serif;
    background-color: #333;
    color: white;
    }
    
form {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    width: 700px;
    border: 16px solid #f1f1f1;
    background-color: #333;
    margin: auto;
}

input[type=text], input[type=password] {
    width: 25%;
    padding: 12px 12px;
    margin: 4px 0;
    display: inline-block;
    color: black;
    font-family: "Bubbler One";
    border: 1px solid #ccc;
    box-sizing: border-box;
}

button {
    background-color: #f4da70;
    color: black;
    padding: 14px 20px;
    margin: 8px 0;
    font-family: "Bubbler One";
    border: none;
    cursor: pointer;
    width: 100px;
}

button:hover {
    opacity: 0.8;
}

/* Dropdown Button */
.dropbtn {
    width:100%;
    background-color: #f4da70;
    color: black;
    padding: 14px;
    font-family: "Bubbler One";
    font-size: 14px;
    border: none;
    cursor: pointer;
}

/* Dropdown button on hover & focus */
.dropbtn:hover, .dropbtn:focus {
    background-color: #2980B9;
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
    position: relative;
    display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f1f1f1;
    color: black;
    font-family: "Bubbler One";
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content button {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {background-color: #ddd}

/* Show the dropdown menu (use JS to add this class to the .dropdown-content container when the user clicks on the dropdown button) */
.show {display:block;}

.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
}

img.avatar {
    width: 300px;
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

<h2 style="text-align:center"><font face="Bubbler One" size ="8" >Add Item</font></h2>

<form action="/action_page.php">
  <div class="imgcontainer">
    <img src="NewItemBerg.png" alt="Avatar" class="avatar">
  </div>

  <div class="container">
  <center>
    <br>
    Upload a JPG file for your Item: <input type='file' name='filename' size='10'>
    <input type='submit' value='Upload File'>
    <br>
    <p>Category: <br> <select name="itemCateg">
		<option value="elecMedia">Electronic Media</option>
		<option value="liter">Literature</option>
		<option value="art">Artwork</option>
        <option value="clothes">Clothing and Accessories</option>
		<option value="merch">Merchandise</option>
		<option value="otheritem">Other</option>
	</select></p>
    <br>
    <input type="text" placeholder="Item Name" name="itemName" required>
    <br>
    <input type="text" placeholder="Item Description" name="itemDesc" required>
    <br>
    <input type="text" placeholder="Item Quantity" name="itemQuan" required>
    <br>
    <br>
    Enter Item Price:  
    <br>
    <input type="number" placeholder="0.00" step="0.01">
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
    <button type="submit">Add Item</button>
    <br>
    </center>
  </div>
</form>

</body>
</html>
