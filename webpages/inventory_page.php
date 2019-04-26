<?php
session_start();

?>
<!DOCTYPE html>
<!-- Source code researched on www.w3schools.com -->
<html>
<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../css/main.css">
  <link rel="stylesheet" href="../css/header_top_nav.css">
<title>Inventory | Titanic Treasures</title>
</head>
</head>
<body>

<div class="header">
    <a href="../index.php"><img  src="../images/WhiteLogoRedo.png" alt="logo"/></a>

  <div class="topnav">
    <a href="../webpages/titanic_logout.php">Logout</a>
    <a href="../webpages/view_cart.php">Cart</a>
    <a href="../webpages/view_orders.php">Orders</a>
    <a href="../webpages/inventory_page.php">Inventory</a>
    <a href="../webpages/titanic_login.php">Account</a>
    
    <div class="search-container">
      <form method= "get" action="searchStore.php">
        <input type="text" placeholder="Search..." name="search">
        <button type="submit"><i class="fa fa-search"></i></button>
      </form>
    </div>
    <div class="dropdown">
      <button class="dropbtn">Categories 
        <i class="fa fa-caret-down"></i>
      </button>
      <div class="dropdown-content">
        <a href="#">Electronic Media</a>
        <a href="#">Literature</a>
        <a href="#">Artwork</a>
        <a href="#">Clothing & Accessories</a>
        <a href="#">Merchandise</a>
        <a href="#">Other</a>
      </div>
    </div> 
  </div>
</div>
<br>

<button class="button1" onclick="window.location.href='../webpages/add_item.php'">Add Another Item</button>

<div class='row'>
	<h2>My Inventory</h2><hr width="75%" align="left">
	<div class='card'>
	<!-- php inject a while loop to check database -->
  <form action="/action_page.php">
    <div class="imgcontainer">
      <img src="../images/NewItemBerg.png" alt="Avatar" class="avatar" height="200" >  <!-- php inject item image -->
      <div class = "container">
        <p>Item 1</p><!-- php inject item name -->
        <p>Price: $5.56</p><!-- php inject item price -->
        <p>Quantity Remaining in Stock:  17</p><!-- php inject item quantity -->
        <p>Category: Artwork </p><!-- php inject item category -->
        <button class="button1" type ="submit">Edit Item</button>
        <button class="button1" type ="submit">Delete Item</button>
      </div>
    </div>
  </form>
  </div>
  <div class='card'>
  <!-- php inject a while loop to check database -->
  <form action="/action_page.php">
    <div class="imgcontainer">
      <img src="../images/NewItemBerg.png" alt="Avatar" class="avatar" height="200" >  <!-- php inject item image -->
      <div class = "container">
        <p>Item 2</p><!-- php inject item name -->
        <p>Price: $5.56</p><!-- php inject item price -->
        <p>Quantity Remaining in Stock:  17</p><!-- php inject item quantity -->
        <p>Category: Artwork </p><!-- php inject item category -->
        <button class="button1" type ="submit">Edit Item</button>
        <button class="button1" type ="submit">Delete Item</button>
      </div>
    </div>
  </form>
  </div>
  <div class='card'>
  <!-- php inject a while loop to check database -->
  <form action="/action_page.php">
    <div class="imgcontainer">
      <img src="../images/NewItemBerg.png" alt="Avatar" class="avatar" height="200" >  <!-- php inject item image -->
      <div class = "container">
        <p>Item 2</p><!-- php inject item name -->
        <p>Price: $5.56</p><!-- php inject item price -->
        <p>Quantity Remaining in Stock: 17</p><!-- php inject item quantity -->
        <p>Category: Artwork </p><!-- php inject item category -->
        <button class="button1" type ="submit">Edit Item</button>
        <button class="button1" type ="submit">Delete Item</button>
      </div>
    </div>
  </form>
  </div>
</div>

<div class="footer">
  <h5>&copy; 2018<script>new Date().getFullYear()>2010&&document.write("-"+new Date().getFullYear());</script>, Titanic Treasures. All rights resevered.</h5>
</div>

</body>
</html>
