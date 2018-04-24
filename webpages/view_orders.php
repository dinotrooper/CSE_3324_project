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
    font-family: "Bubbler One";
    border: 1px solid #ccc;
    box-sizing: border-box;
}

button {
    background-color: #f4da70;
    color: black;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    font-family: "Bubbler One";
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


<h2 style="text-align:center"><font face="Bubbler One" size ="8" >Orders</font></h2>

<!-- php inject a while loop to check database -->
<form action="/action_page.php">
  <div class="imgcontainer" style="display: flex">
    <img src="NewItemBerg.png" alt="Avatar" class="avatar">  <!-- php inject item image -->
    
  <center>
  <div class = "container">
  <br>
    <p>Item: </p><!-- php inject item name -->
    <p>Price: </p><!-- php inject item price -->
    <p>Shipping Address: </p><!-- php inject shipping address -->
    <p>Quantity Remaining in Stock:  </p><!-- php inject item quantity -->
    <p>Date Shipped:  </p><!-- php inject date -->
    <p>Seller:  </p><!-- php inject seller userid -->
    <textarea name="comment" rows="10" cols="48">Leave a comment!</textarea>  
    <br> 
    <br> 
    <br>
    <!-- php inject check if image has been rated and change to goldberg -->
    Rating:  <br><a href="view_orders.php"><img src="noberg.png" alt="rate1" height="48" width="48"></a><a href="view_orders.php"><img src="noberg.png" alt="rate2" height="48" width="48"></a><a href="view_orders.php"><img src="noberg.png" alt="rate3" height="48" width="48"></a><a href="view_orders.php"><img src="noberg.png" alt="rate4" height="48" width="48"></a><a href="view_orders.php"><img src="noberg.png" alt="rate5" height="48" width="48"></a>
    </div>
    </center>
    <br>
  </div>
</form>

</body>
</html>
