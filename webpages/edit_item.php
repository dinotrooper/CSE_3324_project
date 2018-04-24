<!DOCTYPE html>
<html>
<!-- Source code originates from https://www.w3schools.com/howto/howto_css_login_form.asp -->
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href='https://fonts.googleapis.com/css?family=Bubbler One' rel='stylesheet'>
<style>
body {font-family: 'Bubbler One', Arial, Helvetica, sans-serif; 
    background-color: #333;
    }

form {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    width: 700px;
    border: 16px solid #f1f1f1;
    background-color: white;
    margin: auto;
}
input[type=text], input[type=password] {
    width: 25%;
    padding: 12px 12px;
    margin: 8px 0;
    font-family: "Bubbler One";
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
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



<form action="/action_page.php">
  <div class="imgcontainer">
    <img src="./images/NewItemBerg.png" alt="Avatar" class="avatar">
  </div>

  <div class="container">
  <center>
    Upload a New JPG file for your Item: <input type='file' name='filename' size='10'>
    <input type='submit' value='Upload'>
    <br>
    <p>New Category:  <br><select name="itemCateg">
		<option value="elecMedia">Electronic Media</option>
		<option value="liter">Literature</option>
		<option value="art">Artwork</option>
        <option value="clothes">Clothing and Accessories</option>
		<option value="merch">Merchandise</option>
		<option value="otheritem">Other</option>
	</select></p>
    <input type="text" placeholder="Enter New Item Name" name="itemName" required>
    <br>
    <input type="text" placeholder="Enter New Item Description" name="itemDesc" required>
    <br>
    <input type="text" placeholder="Enter New Item Quantity" name="itemQuan" required>
    <br>
    Enter New Item Price:  <br><input type="number" placeholder="0.00" step="0.01">
    <br>
<br>

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
    <button type="submit">Finish</button>
    <br><BR>
    <button type="submit" value="deleteProf">Delete Item</button>
    </center>
  </div>
</form>

</body>
</html>