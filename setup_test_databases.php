<?php

require_once 'login.php';
$connection = new mysqli('localhost', 'root', '', '');
if ($connection->connect_error) {
    echo("Connection to database failed. <br>"); 
    die();
}
else echo("Successfully connected to mySQL server. <br>");

$query = "CREATE DATABASE group7_project_database";

sendQuery($connection, $query);
echo("Successfully created database group7_project_database. <br>");

$connection->close();

$connection = new mysqli('localhost', 'root', '', 'group7_project_database');
if ($connection->connect_error) {
    echo("Connection to database failed. <br>");
    die();
}
else echo("Succesfully connected to mySQL server and group7_project_database. <br>");

//create user table
$query = "CREATE TABLE user (
    userID INT UNSIGNED AUTO_INCREMENT,
    username  VARCHAR(32) NOT NULL UNIQUE,
    password  VARCHAR(10) NOT NULL,
    email VARCHAR(32) NOT NULL UNIQUE,
    billingStreetOne VARCHAR(64),
    billingStreetTwo VARCHAR(64),
    billingState VARCHAR(32),
    billingCity VARCHAR(32),
    billingZip  INT(32),
    avatarImg   VARCHAR(64) DEFAULT 'default location',
    cardNumber INT(32),
    cardExpDate VARCHAR(32),
    cardSecureCode INT(32),
    isAdmin INT(1) NOT NULL,
    PRIMARY KEY (userID)
  )";

sendQuery($connection, $query);
checkTableColumns($connection, "user", 13);

//create orders table
//TODO: either add a shippingName field 
//or delete the shippingName class member from the order class
//TODO: add field for orderTotal
$query = "CREATE TABLE orders (
    orderID INT UNSIGNED NOT NULL AUTO_INCREMENT,
    userID INT UNSIGNED NOT NULL,
    shippingStreetOne VARCHAR(64) NOT NULL,
    shippingStreetTwo VARCHAR(64) NULL,
    shippingCity VARCHAR(32) NOT NULL,
    shippingState VARCHAR(32) NOT NULL,
    shippingZip VARCHAR(32) NOT NULL,
    orderDate DATETIME NOT NULL,
    PRIMARY KEY (orderID),
    FOREIGN KEY (userID) REFERENCES user(userID)
)";

sendQuery($connection, $query);
checkTableColumns($connection, "orders", 8);

//create items table
$query = "CREATE TABLE items (
    itemID INT UNSIGNED AUTO_INCREMENT,
    userID INT UNSIGNED NOT NULL,
    itemImage VARCHAR(64) DEFAULT 'default item image',
    itemName VARCHAR(32) NOT NULL,
    itemDescription VARCHAR(1024) NOT NULL,
    itemQuantity INT(32) NOT NULL,
    itemCategory VARCHAR(64) NOT NULL,
    itemPrice FLOAT(32) NOT NULL,
    PRIMARY KEY (itemID),
    FOREIGN KEY (userID) REFERENCES user(userID)
)";

sendQuery($connection, $query);
checkTableColumns($connection, 'items', 8);

//create cart table
$query = "CREATE TABLE cart (
    cartID INT UNSIGNED AUTO_INCREMENT,
    userID INT UNSIGNED NOT NULL,
    PRIMARY KEY (cartID),
    FOREIGN KEY (userID) REFERENCES user(userID)
)";

sendQuery($connection, $query);
checkTableColumns($connection, "cart", 2);

$query = "CREATE TABLE orders_items (
    orderID INT UNSIGNED NOT NULL,
    itemID INT UNSIGNED NOT NULL,
    userID INT UNSIGNED NOT NULL,
    orderQuantity INT(32) NOT NULL,
    FOREIGN KEY (orderID) REFERENCES orders(orderID),
    FOREIGN KEY (userID) REFERENCES user(userID),
    FOREIGN KEY (itemID) REFERENCES items(itemID)
)";

//create orders_items table
sendQuery($connection, $query);
checkTableColumns($connection, "orders_items", 4);

//TODO: possible remove priceTotal field in case the price of the item
//is changed after it row data is inserted?
$query = "CREATE TABLE cart_items (
    cartID INT UNSIGNED NOT NULL,
    itemID INT UNSIGNED NOT NULL,
    userID INT UNSIGNED NOT NULL,
    cartQuantity INT(32) NOT NULL,
    priceTotal FLOAT(32) NOT NULL,
    FOREIGN KEY (cartID) REFERENCES cart(cartID),
    FOREIGN KEY (userID) REFERENCES user(userID),
    FOREIGN KEY (itemID) REFERENCES items(itemID)
)";

sendQuery($connection, $query);
checkTableColumns($connection, "cart_items", 5);

//create item_ratings table
$query = "CREATE TABLE item_ratings (
    ratingID INT UNSIGNED AUTO_INCREMENT,
    itemID INT UNSIGNED NOT NULL,
    userID INT UNSIGNED NOT NULL,
    ratingNumber INT(3),
    PRIMARY KEY (ratingID),
    FOREIGN KEY (userID) REFERENCES user(userID),
    FOREIGN KEY (itemID) REFERENCES items(itemID)
)";

sendQuery($connection, $query);
checkTableColumns($connection, 'item_ratings', 4);

//create item_comments table
$query = "CREATE TABLE item_comments (
    commentID INT UNSIGNED AUTO_INCREMENT,
    itemID INT UNSIGNED NOT NULL,
    userID INT UNSIGNED NOT NULL,
    commentText VARCHAR(1024) NOT NULL,
    PRIMARY KEY (commentID),
    FOREIGN KEY (userID) REFERENCES user(userID),
    FOREIGN KEY (itemID) REFERENCES items(itemID)
)";

sendQuery($connection, $query);
checkTableColumns($connection, 'item_comments', 4);

echo("Database successfully created! Have a great day! :D");
$connection->close();

function checkTableColumns($connection, $table, $num_columns) {
    $query = "SHOW COLUMNS FROM $table";
    
    $result = sendQuery($connection, $query);
    $rows = $result->num_rows;

    if ($rows < $num_columns ) {
        echo("Table $table was not successfully created. <br>");
        echo("Error message: Table $table did not contain enough fields.The number of field expected is $num_of_columns. The actual number is $rows. <br><br>");
        die();
    }
    else echo("Successfully created $table. <br>");
}

function sendQuery($connection, $query) {
    $result = $connection->query($query);
    if (!$result) {
        echo("Query failed. <br>");
        echo("The contents of the query is as follows. <br><br>");
        echo("$query <br><br>");
        echo("Error message: $connection->error. <br>");
        die();
    }
    //else echo("Query successfully sent. <br>");
    return $result;
}

?>