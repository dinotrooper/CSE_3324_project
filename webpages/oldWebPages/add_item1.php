<!DOCTYPE html>
<?php
session_start();

if(isset($_SESSION["sessionID"])){
    if($_SESSION["sessionID"]){
        $sessionID = $_SESSION["sessionID"];
    }
    else{
        $sessionID = 0;
    }
    if($sessionID>0){
        require_once '../backend/user.php';
        $userItem = User::getExistingUser($sessionID);
    }
} else {
    forwardLoginPage();
}

function forwardLoginPage() {
    header("Location: titanic_login.php");
}

function forwardInventoryPage() {
    header("Location :titanic_login.php");
}

require_once '../backend/item.php';

if ($_FILES)
{
    $name = basename($_FILES['filename']['name']);
    $target_dir = '../images/';
    
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

<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['filename'])) $itemImage = $_POST['filename'];
    if (isset($_POST['itemCateg'])) {
        switch($_POST['itemCateg']) {
            case 0:
                $itemCategory = 'Electronic Media';
                break;
            case 1:
                $itemCategory = 'Literature';
                break;
            case 2:
                $itemCategory = 'Artwork';
                break;
            case 3:
                $itemCategory = 'Clothing and Accessories';
                break;
            case 4:
                $itemCategory = 'Merchandise';
                break;
            default:
                $itemCategory = 'Other';
            
        }
    }

    if (isset($_POST['itemName'])) $itemName = $_POST['itemName']; 
    if (isset($_POST['itemDesc'])) $itemDesc = $_POST['itemDesc'];
    if (isset($_POST['itemQuan'])) $itemQuan = $_POST['itemQuan'];
    if (isset($_POST['itemDesc'])) $itemDesc = $_POST['itemDesc'];
    if (isset($_POST['itemPrice'])) $itemPrice = $_POST['itemPrice'];

$localItem = Item::newItem($userItem->getUserID(), $itemName, $itemDesc, $itemCategory, $itemImage, $itemQuantity, $itemPrice);
}



?>

<h2 style="text-align:center"><font face="Bubbler One" size ="8" >Add Item</font></h2>

<form method= "post" action="add_item.php">
  <div class="imgcontainer">
    <img src="../images/NewItemBerg.png" alt="Avatar" class="avatar">
  </div>

  <div class="container">
  <center>
    <br>
    Upload a JPG file for your Item: <input type='file' name='filename' size='10'>
    <br>
    <p>Category: <br> <select name="itemCateg" value="<?php echo isset($_POST["cat"]) ? $_POST["cat"] :'';?>">
		<option value="0" >Electronic Media</option>
		<option value="1">Literature</option>
		<option value="2">Artwork</option>
        <option value="3">Clothing and Accessories</option>
		<option value="4">Merchandise</option>
		<option value="5">Other</option>
	</select></p>
    <br>
    <input type="text" placeholder="Item Name" name="itemName" required value="<?php echo isset($_POST["itemName"]) ? $_POST["itemName"] :'';?>">
    <br>
    <input type="text" placeholder="Item Description" name="itemDesc" required value="<?php echo isset($_POST["itemDesc"]) ? $_POST["itemDesc"] :'';?>">
    <br>
    <input type="text" placeholder="Item Quantity" name="itemQuan" required value="<?php echo isset($_POST["itemQuan"]) ? $_POST["itemQuan"] :'';?>"> 
    <br>
    <br>
    Enter Item Price:  
    <br>
    <input type="number" placeholder="0.00" name = "itemPrice" step="0.01" value="<?php echo isset($_POST["itemPrice"]) ? $_POST["itemPrice"] :'';?>">
    <br>
<p>
    <button type="submit">Add Item</button>
    <br>
    </center>
  </div>
</form>

</body>
</html>
