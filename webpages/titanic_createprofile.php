<!DOCTYPE html>
<?php
session_start();
?>
<html>
<!-- Source code originates from https://www.w3schools.com/howto/howto_css_login_form.asp -->
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
.error {
	color: #FF0000;
	}
body {font-family: 'Bubbler One', Arial, Helvetica, sans-serif; 
    background-color: #333;}
form {box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    width: 700px;
    border: 16px solid #f1f1f1;
    background-color: white;
    margin: auto;}

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
<?php

	$emailerror= $nameerror= "";
	$valid = true;
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		require_once '../backend/login.php';
		$conn = new mysqli($GLOBALS['hn'], $GLOBALS['un'], $GLOBALS['pw'], $GLOBALS['db']);
		if($conn->connect_error)
			die($conn->connect_error);
		
		require_once '../backend/user.php';
		$picture = $_POST['filename'];
		$uname = $_POST['uname'];
		$query = "SELECT * FROM user WHERE username = '$uname'";
		$result = $conn->query($query);
		$rows = $result->num_rows;
		if($rows){
			$nameerror = "Already in use. Please choose another";
			$uname = '';
			$valid = false;
		}
		else{
			$nameerror = "";
		}
		$psw = $_POST['psw'];
		$email = $_POST['email'];
		$query = "SELECT * FROM user WHERE email = '$email'";
		$result2 = $conn->query($query);
		$rows2 = $result2->num_rows;
		$email = filter_var($email, FILTER_SANITIZE_EMAIL);
		if($rows2){
			$emailerror = "Invalid email format or the email is already used";
			$email = "";
			$valid = false;
		}
		
		elseif ((!filter_var($email, FILTER_VALIDATE_EMAIL) === false) and !$rows2){
					$emailErr = "";
					
		}

		else{
			$emailerror = "Invalid email format or the email is already used";
			$email = "";
			$valid = false;
		}
		$stradd1 = $_POST['stradd1'];
		$stradd2 = $_POST['stradd2'];
		$city = $_POST['city'];
		$state = $_POST['state'];
		$zip = $_POST['zip'];
		$cardnum = $_POST['cardnum'];
		$cardexp = $_POST['cardexp'];
		$cardsec = $_POST['cardsec'];
		if($valid){
			$newUser = User::createNewUser($uname,$psw,$email,$stradd1,$stradd2,$city,$state,$zip,$picture,$cardnum,$cardexp,$cardsec,0);
			
			$query3 = "SELECT * FROM user WHERE username = '$uname'";
			$result3 = $conn->query($query3);
			if (!$result) die($conn->error);
			$result3->data_seek(0);
			$row = $result3->fetch_array(MYSQLI_ASSOC);
	
			$_SESSION["sessionID"] = $row['userID'];

			header("Location: firstPage.php");
		}
		
	}
	?>

<form action="titanic_createprofile.php" method = "POST">
<div class="imgcontainer">
    <img src="../images/greyAvatar.jpg" alt="Avatar" class="avatar">
  </div>

  <div class="container">
  <center>
  <p><span class="error">All form fields must be filled except Address 2</span></p>
  Upload a JPG file for your Avatar: <input type='file' name='filename' size='10'>
    <input type='submit' value='Upload'>
    <input type="text" placeholder="Username" name="uname" value="<?php echo isset($_POST["uname"]) ? $_POST["uname"] :'';?>" required>
	<span class="error"><?php echo $nameerror;?></span>
    <br>
    <input type="password" placeholder="Password" name="psw"value="<?php echo isset($_POST["psw"]) ? $_POST["psw"] :'';?>" required>
	
    <br>
    <input type="text" placeholder="Email" name="email" value="<?php echo isset($_POST["email"]) ? $_POST["email"] :'';?>"required>

	<span class="error"><?php echo $emailerror;?></span>
    <br>
    <input type="text" placeholder="Street Address 1" name="stradd1"value="<?php echo isset($_POST["stradd1"]) ? $_POST["stradd1"] :'';?>" required>

    <br>
    <input type="text" placeholder="Street Address 2 (optional)" name="stradd2" value="<?php echo isset($_POST["stradd2"]) ? $_POST["stradd2"] :'';?>">

    <br>
    <input type="text" placeholder="City" name="city" value="<?php echo isset($_POST["city"]) ? $_POST["city"] :'';?>" required>

    <br>
    <input type="text" placeholder="State" name="state" value="<?php echo isset($_POST["state"]) ? $_POST["state"] :'';?>" required>

    <br>
    <input type="text" placeholder="Zip" name="zip" value="<?php echo isset($_POST["zip"]) ? $_POST["zip"] :'';?>" required>

    <br>
    <input type="password" placeholder="Card Number" name="cardnum" value="<?php echo isset($_POST["cardnum"]) ? $_POST["cardnum"] :'';?>" required>

    <br>
    <input type="password" placeholder="Card Expiration Date" name="cardexp"  value="<?php echo isset($_POST["cardexp"]) ? $_POST["cardexp"] :'';?>" required>

    <br>
    <input type="password" placeholder="Card Security Code" name="cardsec" value="<?php echo isset($_POST["cardsec"]) ? $_POST["cardsec"] :'';?>" required>

<br>
<p>
<?php

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
    <button type="submit">Create Profile</button>
    <br>
    </center>
  </div>
</form>

</body>
</html>