<?php
session_start();
?>
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
<?php 
forwardPage();
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
<h2 style="text-align:center"><font face="garamond" size ="8" >Titanic Treasures</font></h2>

<form method = "POST" form action="/git/blublubluh.php">
  <div class="imgcontainer">
    <img src="iceberg.jpg" alt="Avatar" class="avatar">
  </div>
        <p style="color: red">
        <?php echo $loginError?>
        </p>
  <div class="container">
  <center>
    <label for="username"><b>Username</b></label>
    <input type="text" value="<?php echo isset($_POST["username"]) ? $_POST["username"] :'';?> " placeholder="Enter Username" name="username" required>
    <br>
    <label for="password"><b>Password</b></label>
    <input type="password" value="<?php echo isset($_POST["password"]) ? $_POST["password"] :'';?>" placeholder="Enter Password" name="password" required>
    <br>
    <button type="submit">Login</button>
    <br>
    <button type="submit">New User</button>
    <br>
    <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label>
    </center>
  </div>
<?php
function saltThat($dataToHash){
		$salt1 = "https://walkoffwin55.files.wordpress.com";
		$salt2 = "/2012/11/kate-drawinga-e1354056007277.jpg";
		$hashedValue = hash('ripemd128', "$salt1$dataToHash$salt2");
		return $hashedValue;
	}
	function forwardPage(){
	/*	if($_SESSION["loggedIn"] && $_SESSION["sessionType"] == 'admin'){
			header("Location: http://pluto.cse.msstate.edu/~car602/lab05/admin_page.php");
			
		}
		elseif($_SESSION["loggedIn"] && $_SESSION["sessionType"] == 'user'){
			header("Location: http://pluto.cse.msstate.edu/~car602/lab05/user_page.php");
			
	}*/
	}
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
  <div class="container" style="background-color:#f1f1f1">
    <span class="psw"><a href="#">Forgot password?</a></span><br>
  </div>
</form>

</body>
</html>
