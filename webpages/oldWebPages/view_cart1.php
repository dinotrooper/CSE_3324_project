<?php
session_start();
?>
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
    font-family: "Bubbler One";
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100px;
}

button:hover {
    opacity: 0.8;
}


.imgcontainer {
    width: 50%;
    text-align: left;
    margin: 24px 0 12px 0;
}

img.avatar {
    width: 20%;
    height: 20%;
    border-radius: 20%;
}

.container {
    padding: 16px;
}

span.psw {
    float: right;
    padding-top: 16px;
}

a{
	color: hotpink;
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


<h2 style="text-align:center"><font face="Bubbler One" size ="8" >Cart</font></h2>

<form action="/action_page.php">
	<?php
	if(isset($_SESSION["sessionID"])){
		if($_SESSION["sessionID"]){
			$sessionID = $_SESSION["sessionID"];
			require_once '../backend/user.php';
		$userItem = User::getExistingUser($sessionID);
		}else{
			$sessionID=0;
		}
	
	require_once '../backend/login.php';
	$connection = new mysqli($GLOBALS['hn'], $GLOBALS['un'], $GLOBALS['pw'], $GLOBALS['db']);
	$query = "SELECT * FROM CART_ITEMS WHERE userID = $sessionID";
	$result = $connection->query($query);
	$rows = $result->num_rows;
	if($rows){
	  for($j = 0; $j<$rows ; ++$j){
	  $result->data_seek($j);
	  $row= $result->fetch_array(MYSQLI_ASSOC);
	  $singlePrice = $row['priceTotal']/$row['cartQuantity'];
  echo'<div class="imgcontainer" style="display: flex">';
    echo'<img src="NewItemBerg.png" alt="Avatar" class="avatar" height="200" >';  
  echo'<center>';
  echo'<div class = "container">';

   echo' <p>Item: '.$row['itemID'].'</p><';
    echo'<p>Price: '.$singlePrice.' </p>';
    echo'<p>Quantity '.$row['cartQuantity'].' </p>';
    echo'<button type ="submit">Delete Item</button>';
  echo' </div>';
    echo'</center>';
    echo'<br>';
  echo'</div>';
  }
  echo'<h2 style="text-align:center"><font face="Bubbler One" size ="5" >'.$row['priceTotal'].' </font></h2>';
   echo"<center>";
  echo'<button type="submit">Checkout</button>';
  echo'</center>';
	}
	else{
		echo"<center>";
		echo'<a href="../webpages/firstPage.php">Your Cart is Empty... You should fill it!</a>';
		
	}
	}
	else{
		echo"<center>";
		echo'  <a href="../webpages/titanic_login.php">Please login</a>';
	}
	?>
</form>

</body>
</html>
