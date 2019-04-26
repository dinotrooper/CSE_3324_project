<?php
session_start();

?>
<!DOCTYPE html>
<!-- Source code researched on www.w3schools.com --> 
<html>
<head>
  <link rel="stylesheet" href="css/slideshow.css">
  <link rel="stylesheet" href="css/header_top_nav.css">
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<title>Titanic Treasures | Home</title>
</head>
<body>

<div class="header">

  <a href="index.php"><img  src="images/WhiteLogoRedo.png" alt="logo"/></a>

  <div class="topnav">
    <a href="webpages/titanic_logout.php">Logout</a>
    <a href="webpages/view_cart.php">Cart</a>
    <a href="webpages/view_orders.php">Orders</a>
    <a href="webpages/inventory_page.php">Inventory</a>
    <a href="webpages/titanic_login.php">Account</a>
  
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
<div class="slideshow-container">

<div class="mySlides fade">
  <img src="images/titanicMain.jpg" style="width:100%" height = "250">
  <div class="text">Win a trip to Eat Brunch with Kate and Leo</div>
</div>

<div class="mySlides fade">
  <img src="images/titanicIce.jpg" style="width:100%" height = "250">
  <div class="text">Iceberg Ice Cubes: Best Selling Item 3 Months Running</div>
</div>

<div class="mySlides fade">
  <img src="images/titanicNeck.jpg" style="width:100%" height = "250">
  <div class="text">Own the Heart of the Sea! Only 3 payments of $74.99</div>
</div>

<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
<a class="next" onclick="plusSlides(1)">&#10095;</a>

</div>
<br>

<script>
/*var slideIndex = 1;
showSlides1(slideIndex);
*/
function plusSlides(n) {
  showSlides1(slideIndex += n);
}

function currentSlide(n) {
  showSlides1(slideIndex = n);
}

function showSlides1(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
  
}

var slideIndex = 0;
showSlides();

function showSlides() {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none"; 
    }
    slideIndex++;
    if (slideIndex > slides.length) {slideIndex = 1} 
    slides[slideIndex-1].style.display = "block"; 
    setTimeout(showSlides, 4000); // Change image every 2 seconds
}
audio { 
   display:none;
}
window.onscroll = function() {myFunction()};

var navbar = document.getElementById("navbar");
var sticky = navbar.offsetTop;

function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}

</script>

	<div class='row'>
		  <h2>Items of the Day</h2><hr width="75%" align="left">
		
	<div class='rightcolumn'>
		<div  id='navbar'>
			<div class='card'>
				<h2>Account Snapshot</h2>
				<?php 
				if(isset($_SESSION["sessionID"])){
				if($_SESSION["sessionID"]){
					$sessionID = $_SESSION["sessionID"];
				}
				else{
					$sessionID = 0;
				}
				if($sessionID>0){
				require_once 'backend/user.php';
				$userItem = User::getExistingUser($sessionID);
				
				echo "<div class='imgcontainer'>
					<img src='images/".$userItem->getAvatarImg()."' alt='Avatar' class='avatar'>
					</div>";
				echo "<p>".$userItem->getEmail()."</p>";
				}
				
				}
				else{
					echo "<div class='imgcontainer'>
					<img src='images/greyAvatar.jpg' alt='Avatar' class='avatar'>
					</div>";
				echo "<p>You are a guest. Please Log in</p>";
				}
				?>
			</div>
		</div>
		</div>
<?php	
	$counter = 0;
	$randomItemList = [];
	$conn = new mysqli("localhost","root","","group7_project_database");
	while($counter < 2){
		$query = "SELECT * FROM items ORDER BY RAND() LIMIT 1";
		$result = $conn->query($query);
		$result->data_seek(0);
		$itemID = $result->fetch_array(MYSQLI_ASSOC)["itemID"];
		if(($key = array_search($itemID, $randomItemList))=== false){
			$randomItemList[$counter] = $itemID;
			$counter+=1;
		}
		
	}
	foreach($randomItemList as $listItemID)
	{
	    include_once "backend/item.php";
				
		$home_item = Item::existingItem($listItemID);
				
		$itemID = $home_item->getItemID();
		$query = "SELECT * FROM item_ratings WHERE itemID = $itemID";
		$result = $conn-> query($query);
		if(!$result) die ($conn->error);
		$result->data_seek(0);
		$row = $result->fetch_array(MYSQLI_ASSOC);
		
		if ($row['ratingNumber'] == 0) {
			$itemRating = 'N/A';
		} else {
			$itemRating = $row['ratingNumber'];
		}		
		echo "
		<div class='leftcolumn'>
		<div class='card'>
		<!Item Name Goes Here>
		  <h2>".$home_item->getitemName()."</h2>
		  <!Item Image Goes Here>
		  <img src='".$home_item->getItemImage()."' alt='".$home_item->getItemName()."' style='height:200px;'/>
		  <p class='alignright'>
		  <!Item Data Goes Here>
		  <p><b>Description: </b>".$home_item->getItemDescription()." </p>
		  <p><b>Category: </b>".$home_item->getItemCategory()."</p>
		  <p><b>Price: </b>$".$home_item->getItemPrice()."</p>
		  <p><b>Avg. Rating: </b>".$itemRating."</p>
		  </p>
		</div>
	</div>";
	}
	$conn->close();
	?>
	  </div>

<div class="footer">
  <h5>&copy; 2018<script>new Date().getFullYear()>2010&&document.write("-"+new Date().getFullYear());</script>, Titanic Treasures. All rights resevered.</h5>
  <audio autoplay="true" loop = "true" src="audio/my_heart_wil_go_on.mp3" type="audio/mpeg"/>
</div>

</body>
</html>
