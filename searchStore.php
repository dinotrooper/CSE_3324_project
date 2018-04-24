<!DOCTYPE html>
<!Source code researched on www.w3schools.com>
<html>
<head>
<?php
//include_once "test_index.php";
?>
<title>Titanic Treasures | Search Results</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
* {
    box-sizing: border-box;
}

body {
    font-family: Arial;
    padding: 10px;
    background: #f1f1f1;
}

/* Header */
.header {
    text-align: center;
    background: #333;
	height: 160px;
	border: 2px solid #333;  
	border-radius: 12px;
}

.header a {
  float: left;
}

.header img{
  position: absolute;
  width: 165x;
  height: 165px;
  padding: 0px;
  margin: 0px;

}
  
.header h1 {
    font-size: 50px;
	color: white;
}

/* Style the top navigation bar */
.topnav {
    overflow: hidden;
    background-color: #333;
	width: 100%;
	vertical-align: center;
	padding: 50px;
	border: 2px solid #333;  
	border-radius: 12px;
}

/* Style the topnav links */
.topnav a {
    float: right;
    display: block;
    color: #f2f2f2;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
	vertical-align: center;
}

.topnav .search-container {
  float: right;
  vertical-align: center;
  
}

.topnav input[type=text] {
  padding: 6px;
  margin-top: 8px;
  font-size: 17px;
  border: none;
  width: 580px;
}

.topnav .search-container button {
  float: right;
  padding: 6px 10px;
  margin-top: 8px;
  margin-right: 16px;
  background: #ddd;
  font-size: 17px;
  border: none;
  cursor: pointer;
}

.topnav .search-container button:hover{
  background: #cccccc;
}

.dropdown:hover .dropbtn {
  background: #cccccc;
}

@media screen and (max-width: 600px) {
  .topnav .search-container {
    float: none;
  }
  .topnav a, .topnav input[type=text], .topnav .search-container button {
    float: none;
    display: block;
    text-align: left;
    width: 100%;
    margin: 0;
    padding: 14px;
  }
  .topnav input[type=text] {
    border: 1px solid #ccc;  
  }
}
.dropdown {
    float: right;
    overflow: hidden;
}

.dropdown .dropbtn {
    font-size: 16px;    
    border: none;
    outline: none;
    color: #f2f2f2;
    padding: 14px 16px;
    background-color: inherit;
    font-family: inherit;
    margin: 0;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #333;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content a {
    float: none;
    color: white;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: left;
}

.dropdown-content a:hover {
    background-color: #ddd;
}

.dropdown:hover .dropdown-content {
    display: block;
}

.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
}

img.avatar {
    box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    width: 80%;
    opacity: 0.6;
    border-radius: 20%;
}

img.logo {
    box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    width: 35%;
    border-radius: 5%;
}

a {
    text-decoration: none;
    display: inline-block;
    padding: 8px 16px;
}
* {box-sizing: border-box}
body {font-family: Verdana, sans-serif; margin:0}
.mySlides {display: none}
img {vertical-align: middle;}

/* Slideshow container */
.slideshow-container {
  max-width: 10000px;
  position: relative;
  margin: auto;
  border: 2px solid #333;  
  border-radius: 12px;
}

/* Next & previous buttons */
.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -22px;
  color: white;
  font-weight: bold;
  font-size: 18px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover, .next:hover {
  background-color: rgba(0,0,0,0.8);
}

/* Caption text */
.text {
  color: floralwhite;
  font-size: 30px;
  padding: 0px 1px;
  position: absolute;
  bottom: 8px;
  width: 100%;
  text-align: center;
}

/* Fading animation */
.fade {
  -webkit-animation-name: fade;
  -webkit-animation-duration: 1.5s;
  animation-name: fade;
  animation-duration: 1.5s;
}

@-webkit-keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

@keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

/* On smaller screens, decrease text size */
@media only screen and (max-width: 300px) {
  .prev, .next,.text {font-size: 11px}
}



/* Change color on hover */
.topnav a:hover {
    background-color: #ddd;
    color: black;
}

/* Create two unequal columns that floats next to each other */
/* Left column */
.leftcolumn {   
    float: right;
    width: 37%;
	padding: 10px;
}

/* Right column */
.rightcolumn {
    float: left;
    width: 25%;
    padding-right: 20px;
  
}

.content {
  padding: 16px;
}

.sticky {
  position: fixed;
  top: 0;
  width: inherit;
}

.sticky + .content {
  padding-top: 60px;
}

/* Add a card effect for articles */
.card {
    background-color: white;
    padding: 20px;
    margin-top: 20px;
	border: 2px solid #ccc;  
	border-radius: 12px;
}

/* Clear floats after the columns */
.row:after {
    content: "";
    display: table;
    clear: both;
}

/* Footer */
.footer {
    padding: 2px;
    text-align: center;
    background: #ddd;
    margin-top: 2px;
	float: bottom;
}

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 800px) {
    .leftcolumn, .rightcolumn {   
        width: 100%;
        padding: 0;
    }
	.topnav a {
        float: none;
        width: 100%;
		overflow: auto;
    }
	.topnav  {
        float: none;
        width: 100%;
		overflow: auto;
    }
	.header {
		float: none;
		width: 100%;
		overflow: auto;
		}
	
}

/* Responsive layout - when the screen is less than 400px wide, make the navigation links stack on top of each other instead of next to each other */
@media screen and (max-width: 400px) {
    .topnav a {
        float: none;
        width: 100%;
		overflow: auto;
    }
	.topnav  {
        float: none;
        width: 100%;
		overflow: auto;
    }
	}
.alignleft {
	float: left;
}
.alignright {
	float: right;
	font-size: 15.75px;
}

</style>
</head>
<body>

<div class="header">

    <a href="#.html"><img  src="WhiteLogoRedo.png" alt="logo"/></a>



<div class="topnav">
  <a href="#">Cart</a>
  <a href="#">Orders</a>
  <a href="#">Account</a>
  <div class="search-container">
    <form action="/action_page.php">
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

<div class='row'>
		  <h2 style = float:right;>Search Results</h2><br><br><br><br><hr width="75%" align="right">
<div class='rightcolumn'>
		<div  id='navbar'>
			<div class='card'>
				<h3>Search Filters</h3><hr>
				<form action="http://pluto.cse.msstate.edu/~jjc52/get_test.php" method="get">
				    
				      Electronic Media: &emsp;&emsp;&emsp;<input type="checkbox" name="electronicMedia" value="y"><br><br>
					  Literature: &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;<input type="checkbox" name="literature" value="y"><br><br>
					  Artwork: &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;<input type="checkbox" name="artwork" value="y"><br><br>
					  Clothing & Accessories: <input type="checkbox" name="clothing" value="y"><br><br>
					  Merchandise:&emsp;&emsp;&emsp;&emsp;&emsp; <input type="checkbox" name="merch" value="y"><br><br>
					  Other:&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp; <input type="checkbox" name="other" value="y"><br><br>
				      Price: <input type="text" name="minPrice" placeholder="$$$" size=3> - <input type="text" name="maxPrice" placeholder="$$$" size=3>
				  <br><br>
				  <input type="submit" value="Filter">                &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
				  <input type="reset" value="Reset">
				</form> 
</div>
			</div>
		</div>
		
<?php	
	for($i=0;$i<10;++$i)
	{
		include_once "item.php";
				
		$conn = new mysqli("localhost","root","","group7_project_database");
		$query = "SELECT itemID FROM items ORDER BY RAND() LIMIT 1";
		$result = $conn->query($query);
		if(!$result) die ($conn->error);
				
		$result->data_seek(0);
				
		$home_item = Item::existingItem($result->fetch_array(MYSQLI_ASSOC)["itemID"]);
		echo "
		<div class='leftcolumn'>
		<div class='card'>
		<!Item Name Goes Here>
		  <h2>".$home_item->getitemName()."</h2>
		  <!Item Image Goes Here>
		  <img src='titanicTit.jpg' alt='tit' style='height:200px;'/>
		  <p class='alignright'>
		  <!Item Data Goes Here>
		  <p><b>Description:</b> Something, something, something...</p>
		  <p><b>Category:</b> Erotic-literature</p>
		  <p><b>Price:</b> $24.99</p>
		  <p><b>Avg. Rating:</b> 4.5 Icebergs</p>
		  </p>
		</div>
	</div>";
	}
	?>
</div>
<script>
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

/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }
  });
}
</script>

<div class="footer">
  <h5>&copy; 2018<script>new Date().getFullYear()>2010&&document.write("-"+new Date().getFullYear());</script>, Titanic Treasures. All rights resevered.</h5>
</div>

</body>
</html>
