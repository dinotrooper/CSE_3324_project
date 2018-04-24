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
    font-family: "Bubbler One";
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


<h2 style="text-align:center"><font face="Bubbler One" size ="8" >Checkout</font></h2>

<!-- php inject a while loop to check database -->
<form action="/action_page.php">
  <div class="imgcontainer" style="display: flex">
    <img src="../images/NewItemBerg.png" alt="Avatar" class="avatar" height="200" >  <!-- php inject item image -->
  <center>
  <div class = "container">
    <p>Item: 1</p><!-- php inject item name -->
    <p>Price: $7.39</p><!-- php inject item price -->
    <p>Quantity Remaining in Stock:  15</p><!-- php inject item quantity -->
    <p>Seller: Leo1 </p><!-- php inject seller userid -->
   </div>
    </center>
    <br>
  </div>
  <h2 style="text-align:center"><font face="Bubbler One" size ="5" >Total:  </font></h2><!-- php add all item prices -->
   <center>
   <button type="submit">Shipping Address Same as Billing Address</button><br>
    <input type="text" placeholder="shipping Street Address 1" name="stradd1" required>
    <br>
    <input type="text" placeholder="Shipping Street Address 2 (optional)" name="stradd2">
    <br>
    <input type="text" placeholder="Shipping City" name="city" required>
    <br>
    <input type="text" placeholder="Shipping State" name="state" required>
    <br>
    <input type="text" placeholder="Shipping Zip" name="zip" required>
    <br>
   <button type="submit">Place Order</button></center>
</form>

</body>
</html>
