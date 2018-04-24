<!DOCTYPE html>
<html>
<!-- Source code originates from https://www.w3schools.com/howto/howto_css_login_form.asp -->
<head>
<title>Titanic Treasures | Home</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>

body {font-family: 'Bubbler One', Arial, Helvetica, sans-serif;
    background-color: #333;
    color: black;
    }

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
    padding: 14px 10px;
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
    float: left;
    width: 66%;
	padding: 10px;
}

/* Right column */
.rightcolumn {
    float: right;
    width: 25%;
    padding-left: 20px;
  
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
    background-color: #333;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    font-family: "Bubbler One";
    border: none;
    cursor: pointer;
    width: 100px;
}
button:hover {
     background: #cccccc;
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

<div class="header">

    <a href="../images/firstPage.php"><img  src="../images/WhiteLogoRedo.png" alt="logo"/></a>



<div class="topnav">
  <a href="#">Cart</a>
  <a href="#">Orders</a>
  <a href="../webpages/titanic_login.php">Account</a>
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
		
			<h2 style="text-align:left"><font face="Bubbler One" size ="8" >Random User</font></h2><hr width="75%" align="left"> 
				 
				<div class='leftcolumn'>
					<div class='card'>
		
						<form action="/action_page.php">
							<div class="../images/imgcontainer">
								<img src="../images/greyAvatar.jpg" alt="Avatar" class="avatar">  <!-- php inject user avatar -->
							</div>
							<div class="container">
								<center>
									<p>Username: Leo1 </p><!-- php inject username -->
									<p>Email: ColdGuy@BottomOfTheOcean.com </p><!-- php inject email -->
									<p>Billing Address: Atlantic Ocean </p><!-- php inject address stuff -->

									<button type="submit">Edit Profile</button>
									<br>
								</center>
							</div>
						</form>
					</div>
				</div>			
</div>

</body>
</html>
