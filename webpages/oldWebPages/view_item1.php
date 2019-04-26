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


<h2 style="text-align:center"><font face="Bubbler One" size ="8" >Winslet Art</font></h2>  <!-- php inject item name -->

<form action="/action_page.php">
  <div class="imgcontainer">
    <img src="../images/NewItemBerg.png" alt="Avatar" class="avatar">  <!-- php inject item image -->
  </div>
  <div class="container">
  <center>
  <h2 style="text-align:center"><font face="Bubbler One" size ="5" >Item Price: $5666.82 </font></h2>  <!-- php inject item price -->
    <p>Description: Beautiful. Wow.  <br>  </p><!-- php inject item description -->
    <p>Amount Left:  34 </p><!-- php inject item quantity -->
    <p>Category:  Other </p><!-- php inject item category -->
    <button type="submit">Add Item To Cart</button>
    <br>
    </center>
  </div>
</form>

</body>
</html>
