<!DOCTYPE html>
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

<!-- <h2 style="text-align:center"><font face="Bowlby One SC" size ="8" ><b>Titanic Treasures</b></font></h2> -->
<div class="imgcontainer">
    <img src="logo.jpg" alt="Avatar" class="logo">
  </div>
<form action="/action_page.php">
  <div class="imgcontainer">
    <img src="greyAvatar.jpg" alt="Avatar" class="avatar">
  </div>

  <div class="container">
  <center>
    
    <input type="text" placeholder="Username" name="uname" required>
    <br>
    
    <input type="password" placeholder="Password" name="psw" required>
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

</body>
</html>
