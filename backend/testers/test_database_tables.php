<?php

require_once 'test_database_functions.php';

$conn= new mysqli('localhost', 'root', '', 'group7_project_database');
if ($connection->connect_error) {
    echo("Connection to database failed. <br>");
die();}
//deleteDB($connection);

$connection = new mysqli('localhost', 'root', '', 'group7_project_database');
if ($connection->connect_error) {
    echo("Connection to database failed. <br>");
    die();
}
else echo("Succesfully connected to mySQL server and group7_project_database. <br>");

$query = "INSERT INTO user(username, password, email, billingStreetOne, billingCity, billingState, billingZip, cardNumber, cardExpDate, cardSecureCode, isAdmin) 
                    VALUES ('dinotrooper', 'alexward', 'dino@gmail.com', '123 Fire Rd', 'Starkville', 'MS', 98765, 12345678, '3/3000', 134, 1)";

sendQuery($connection, $query);

$query = "INSERT INTO user(username, password, email, billingStreetOne, billingCity, billingState, billingZip, cardNumber, cardExpDate, cardSecureCode, isAdmin)
                    VALUES ('wrekker', 'wardalex', 'wrekker@gmail.com', '123 Water Rd', 'Memphis', 'TN', 65478, 98765432, '8/2045', 753, 1)";

sendQuery($connection, $query);


$query = "INSERT INTO user(username, password, email, billingStreetOne, billingCity, billingState, billingZip, cardNumber, cardExpDate, cardSecureCode, isAdmin)
                   VALUES ('lee-thegreat', 'wardlee', 'greatlee@gmail.com', '123 Grass Rd', 'Huntsville', 'AL', 45218, 12378965, '4/2075', 367, 0)";

sendQuery($connection, $query);

$query = "INSERT INTO orders(userID, shippingStreetOne, shippingCity, shippingState, shippingZip, orderDate) 
                    VALUES(1, '123 Fire Rd', 'Starkville', 'MS', 98765, '4-20-2018 10:08:45')";


function sendQuery($connection, $query) {
    $result = $connection->query($query);
    if (!$result) {
        echo("Query failed. <br>");
        echo("The contents of the query is as follows. <br><br>");
        echo("$query <br><br>");
        echo("Error message: $connection->error. <br>");
        die();
    }
    else echo("Query successfully sent. <br>");

    return $result;
    
}

