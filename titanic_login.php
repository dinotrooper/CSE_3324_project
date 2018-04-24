<!DOCTYPE html>
<?php
session_start();
?>
<html>
<!-- Source code originates from https://www.w3schools.com/howto/howto_css_login_form.asp -->
<head>
<link href='https://fonts.googleapis.com/css?family=Bowlby One SC' rel='stylesheet'>
<link href='https://fonts.googleapis.com/css?family=Bubbler One' rel='stylesheet'>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: 'Bubbler One', Arial, Helvetica, sans-serif;}
form {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    width: 700px;
    border: 16px solid #f1f1f1;
    margin: auto;
}

input[type=text], input[type=password] {
    width: 300px;
    padding: 12px 12px;
    font-family: "Bubbler One";
    margin: 4px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

button {
    background-color: #333;
    color: white;
    font-family: "Bubbler One";
    padding: 14px 20px;
    margin: 4px 0;
    border: none;
    cursor: pointer;
    width: 90px;
}

button:hover {
    background-color: #636363;
    opacity: 0.8;
    box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}


.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
}

img.avatar {
    box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    width: 20%;
    opacity: 0.6;
    border-radius: 20%;
}

img.logo {
    box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    width: 35%;
    border-radius: 5%;
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
//forwardPage();
		$loginError = "";
          // Is someone already logged in? If so, forward them to the correct
          // page. (HINT: Implement this last, you cannot test this until
          //              someone can log in.)
          if($_SERVER["REQUEST_METHOD"] =="POST"){
			  $loginError = "";
			  $username = $_POST["username"];
			  $password = $_POST["password"];
			  if(checkLogin($username,$password)){
				$loginError="";
				forwardPage();

				}
			
				else{
			  $loginError = "The username / password combination is not correct";
		  }
		  
          }
?>
<!-- <h2 style="text-align:center"><font face="Bowlby One SC" size ="8" ><b>Titanic Treasures</b></font></h2> -->
<div class="imgcontainer">
    <img src="logo.jpg" alt="Avatar" class="logo">
  </div>
<form method = "POST" form action="/git/blublubluh.php">
  <div class="imgcontainer">
    <img src="greyAvatar.jpg" alt="Avatar" class="avatar">
  </div>

  <div class="container">
  <center>
     <p style="color: red">
        <?php echo $loginError?>
     </p>
    <input type="text" placeholder="Username" name="username" required value="<?php echo isset($_POST["username"]) ? $_POST["username"] :'';?>">
    <br>
    
    <input type="password" placeholder="Password" name="password" required value="<?php echo isset($_POST["password"]) ? $_POST["password"] :'';?>">
    <br>
    <button type="submit">Login</button>
    <button type="submit">New User</button>
    <br>
    <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label>
    </center>
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <span class="psw"><a href="#">Forgot password?</a></span><br>
  </div>
</form>
<?php
function saltThat($dataToHash){
		$salt1 = "https://walkoffwin55.files.wordpress.com";
		$salt2 = "/2012/11/kate-drawinga-e1354056007277.jpg";
		$hashedValue = hash('ripemd128', "$salt1$dataToHash$salt2");
		return $hashedValue;
	}
	/*function forwardPage(){
		if($_SESSION["loggedIn"] && $_SESSION["sessionType"] == 'admin'){
			header("Location: /git/blublubluh.php");
			
		}
		elseif($_SESSION["loggedIn"] && $_SESSION["sessionType"] == 'user'){
			header("Location: /git/blublubluh.php");
			
	}
	}*/
	function checkLogin($username, $password){
		$salt1 = "https://walkoffwin55.files.wordpress.com";
		$salt2 = "/2012/11/kate-drawinga-e1354056007277.jpg";
		require_once 'login.php';
		$connection = new mysqli($hn, $un, $pw, $db);
		if($connection->connect_error)
			die($connection->connect_error);

		$checkPassword = saltThat($password);
		$query = "SELECT username,password FROM user WHERE username = '".$username."' AND password = '".$checkPassword."'";
		$result = $connection->query($query);
		$rows = $result->num_rows;
		$queryType = "SELECT type FROM user WHERE username = '".$username."'
		AND password = '".$checkPassword."'";
		$resultType = $connection->query($queryType);
		$rowType = $resultType->fetch_assoc();
		if($rows > 0)
		{
			$_SESSION["loggedIn"] = true;
			$_SESSION["sessionId"] = $username;
			$_SESSION["sessionType"] = $rowType['type'];
			return true;
		}
		else
		{
			$_SESSION["loggedIn"] = false;
			return false;
		}

		$result->close();
		$resultType->close();
		$connection->close();
	}
?>
</body>
</html>
