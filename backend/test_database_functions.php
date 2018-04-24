<?php

$connection = new mysqli('localhost', 'root', '', 'group7_project_database');
if ($connection->connect_error) {
    echo("Connection to database failed. <br>"); 
    die();
}

function deleteDB($connection)
{
	$query = "DROP DATABASE group7_project_database";
	sendQuery($connection, $query);
}
function connectToLocalDatabase() {
    $connection = new mysqli('localhost', 'root', '', 'group7_project_database');
    if ($connection->connect_error) {
        echo("Connection to database failed. <br>");
        die();
    }

    
    return $connection;
}

function sendQuery($connection, $query) {
    //sends a basic query to the database
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

function createUser($connection, $un, $pw, $email, $billStreetOne, $billCity, $billState, $billZip, $cardNum, $cardDate, $cardCode, $isAdmin) {
    //creates a query using the function's parameters to insert a new user into the user table
    //then returns the userID of the newly created user
    $query = "INSERT INTO user(username, password, email, billingStreetOne, billingCity, billingState, billingZip, cardNumber, cardExpDate, cardSecureCode, isAdmin)
                    VALUES ('$un', '$pw', '$email', '$billStreetOne', '$billCity', '$billState', $billZip, $cardNum, '$cardDate', $cardCode, $isAdmin)";
    
    sendQuery($connection, $query);

    return selectValueFromTable($connection, 'userID', 'user', 'username', $un);
}

function createOrder($connection, $un, $userID, $shipStreetOne, $shipCity, $shipState, $shipZip, $orderDate, $orderTotal) {
    //creates a query using the function's parameters to insert a new order into the order table
    //then returns the orderID of the newly created order
    $query = "INSERT INTO orders(userID, shippingName, shippingStreetOne, shippingCity, shippingState, shippingZip, orderDate, orderTotal)
                    VALUES ($userID, '$un', '$shipStreetOne', '$shipCity', '$shipState', $shipZip, '$orderDate', $orderTotal)";
    
    sendQuery($connection, $query);

    return selectValueFromTable($connection, 'orderID', 'orders', 'userID', $userID);
}

function createItem($connection, $un, $userID, $image, $name, $description, $quantity, $category, $price) {
    //create a query using the function's parameters to insert a new item into the items table
    //then returns the itemID of the newly created order
    $query = "INSERT INTO items (userID, itemImage, itemName, itemDescription, itemQuantity, itemCategory, itemPrice) 
                        VALUES ($userID, '$image', '$name', '$description', $quantity, '$category', $price)";
    
    sendQuery($connection, $query);
    
    $query = "SELECT itemID FROM items WHERE userID = $userID";
    $itemIDResult = sendQuery($connection, $query);
    $rows = $itemIDResult->num_rows;
    $itemID = 0;
 
    for ($j = 0 ; $j < $rows ; ++$j)
    {
        $itemIDResult->data_seek($j);
        $row = $itemIDResult->fetch_array(MYSQLI_ASSOC);
        $tempItemID = $row['itemID'];
        if ($tempItemID > $itemID) $itemID = $tempItemID;
    }

    return $itemID;
}

function createCart($connection, $un, $userID) {
    //create a query using the function's parameters to insert a new cart into the items table
    //then returns the cartID of the newly created order
    $query = "INSERT INTO cart (userID) VALUES ($userID)";
    sendQuery($connection, $query);

    
    return selectValueFromTable($connection, 'cartID', 'cart', 'userID', $userID);
}

function createOrderItem($connection, $orderID, $itemName, $userID, $quantity, $itemTotal) {
    //create a query using the function's parameters to insert a item into the orders_items table
    $query = "INSERT INTO orders_items (orderID, userID, itemName, orderQuantity, itemTotal) 
                                VALUES ($orderID, $userID, '$itemName', $quantity, $itemTotal)";
    sendQuery($connection, $query);
    
}

function createCartItem($connection, $cartID, $itemID, $userID, $quantity, $priceTotal) {
    //create a query using the function's parameters to insert a item into the cart_items table
    $query = "INSERT INTO cart_items(cartID, itemID, userID, cartQuantity, priceTotal) 
                            VALUES ($cartID, $itemID, $userID, $quantity, $priceTotal)";
    sendQuery($connection, $query);
}

function createItemRating($connection, $itemID, $userID, $number) {
    //create a query using the function's parameters to insert a rating into the item_ratings table
    //return the ratingID
    $query = "INSERT INTO item_ratings(itemID, userID, ratingNumber) 
                            VALUES ($itemID, $userID, $number)";
    sendQuery($connection, $query);
;
    
    return selectValueFromTable($connection, 'ratingID', 'item_ratings', 'userID', $userID);
}

function createItemComment($connection, $itemID, $userID, $text) {
    $query = "INSERT INTO item_comments(itemID, userID, commentText) 
                                VALUES ($itemID, $userID, '$text')";
    
    sendQuery($connection, $query);

    
    return selectValueFromTable($connection, 'commentID', 'item_comments', 'userID', $userID);
}

function deleteAllDataFromTables($connection) {
    $query = "DELETE FROM item_comments";
    sendQuery($connection, $query);
    $query = "DELETE FROM item_ratings";
    sendQuery($connection, $query);
    $query = "DELETE FROM cart_items";
    sendQuery($connection, $query);
    $query = "DELETE FROM orders_items";
    sendQuery($connection, $query);
    $query = "DELETE FROM cart";
    sendQuery($connection, $query);
    $query = "DELETE FROM items";
    sendQuery($connection, $query);
    $query = "DELETE FROM orders";
    sendQuery($connection, $query);
    $query = "DELETE FROM user";
    sendQuery($connection, $query);
}


function selectValueFromTable($connection, $valueType, $table, $keyType, $keyValue) {
    //returns a single value from a table based on the key parameter passed and the keyvalue
    //for exampke if you want a userID of a user with a username of 'dinotrooper'
    //the valueType would be 'userID', the table would be 'user'
    //the key type would be 'username' and the key value would be 'dinotrooper'
    
    if (is_numeric($keyValue)) {
        $query = "SELECT $valueType FROM $table WHERE $keyType = $keyValue";
    }
    else {
        $query = "SELECT $valueType FROM $table WHERE $keyType = '$keyValue'";
    }
    
    $result = sendQuery($connection, $query);
    $result->data_seek(0);
    return $result->fetch_array(MYSQLI_ASSOC)[$valueType];
}

function testValues($valueOne, $valueTwo) {
    if ($valueOne != $valueTwo) {
        echo('$valueOne does not equal $valueTwo(). <br>');
        echo('$valueOne: '.$valueOne.'; $valueTwo: '.$valueTwo.'<br>');
        return 0;
    }
    else return 1;
}
?>