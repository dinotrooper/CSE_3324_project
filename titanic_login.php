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
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="uname" required>
    <br>
    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>
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

  <div class="container" style="background-color:#f1f1f1">
    <span class="psw"><a href="#">Forgot password?</a></span><br>
  </div>
</form>

</body>
</html>
