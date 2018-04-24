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

<h2 style="text-align:center"><font face="Bubbler One" size ="6" >Random User</font></h2>  <!-- php inject user name -->

<form action="/action_page.php">
  <div class="imgcontainer">
    <img src="gay.jpg" alt="Avatar" class="avatar">  <!-- php inject user avatar -->
  </div>
  <div class="container">
  <center>
    <p>Username:  </p><!-- php inject username -->
    <p>Email:  </p><!-- php inject email -->
    <p>Billing Address:  </p><!-- php inject address stuff -->
    <button type="submit">Add Item To Cart</button>
    <br>
    <button type="submit">Edit Profile</button>
    <br>
    </center>
  </div>
</form>

</body>
</html>
