<?php

include_once "setup_test_databases.php";

$connection = connectToLocalDatabase();

deleteAllDataFromTables($connection);

$userID = createUser($connection, 'alexLoser','loser','loser@loser.com','123 loser street','Loserville','Loser State','39759','444444444444','10/17','123','1');

createItem($connection, 'shirt1', $userID, 'tshirt_image', 'shirt1', 'a dino tshirt', 1, 'clothing', 4.99);
createItem($connection, 'pants2', $userID, 'tshirt_image', 'pants2', 'a dino tshirt', 1, 'clothing', 4.99);
createItem($connection, 'ball3', $userID, 'tshirt_image', 'ball3', 'a dino tshirt', 1, 'clothing', 4.99);
createItem($connection, 'glove4', $userID, 'tshirt_image', 'glove4', 'a dino tshirt', 1, 'clothing', 4.99);
createItem($connection, 'hat5', $userID, 'tshirt_image', 'hat5', 'a dino tshirt', 1, 'clothing', 4.99);
createItem($connection, 'pig6', $userID, 'tshirt_image', 'pig6', 'a dino tshirt', 1, 'clothing', 4.99);
createItem($connection, 'dinosauce7', $userID, 'tshirt_image', 'dinosauce', 'a dino tshirt', 1, 'clothing', 4.99);
createItem($connection, 'computer8', $userID, 'tshirt_image', 'computer', 'a dino tshirt', 1, 'clothing', 4.99);
createItem($connection, 'clock9', $userID, 'tshirt_image', 'clock', 'a dino tshirt', 1, 'clothing', 4.99);
createItem($connection, 'painting10', $userID, 'tshirt_image', 'charger12', 'a dino tshirt', 1, 'clothing', 4.99);
createItem($connection, 'dell11', $userID, 'tshirt_image', 'painting', 'a dino tshirt', 1, 'clothing', 4.99);
createItem($connection, 'charger12', $userID, 'tshirt_image', 'dell', 'a dino tshirt', 1, 'clothing', 4.99);
createItem($connection, 'headphones13', $userID, 'tshirt_image', 'headphones', 'a dino tshirt', 1, 'clothing', 4.99);
createItem($connection, 'cookies14', $userID, 'tshirt_image', 'cookies', 'a dino tshirt', 1, 'clothing', 4.99);
createItem($connection, 'tables15', $userID, 'tshirt_image', 'tables', 'a dino tshirt', 1, 'clothing', 4.99);
createItem($connection, 'chair16', $userID, 'tshirt_image', 'chair', 'a dino tshirt', 1, 'clothing', 4.99);
createItem($connection, 'desk17', $userID, 'tshirt_image', 'desk', 'a dino tshirt', 1, 'clothing', 4.99);
createItem($connection, 'Lee18', $userID, 'tshirt_image', 'lee', 'a dino tshirt', 1, 'clothing', 4.99);
createItem($connection, 'Steven19', $userID, 'tshirt_image', 'steven', 'a dino tshirt', 1, 'clothing', 4.99);
createItem($connection, 'Clayton20', $userID, 'tshirt_image', 'clayton', 'a dino tshirt', 1, 'clothing', 4.99);
createItem($connection, 'Jacob21', $userID, 'tshirt_image', 'jacob', 'a dino tshirt', 1, 'clothing', 4.99);
createItem($connection, 'Tom22', $userID, 'tshirt_image', 'tom', 'a dino tshirt', 1, 'clothing', 4.99);
createItem($connection, 'Rikk23', $userID, 'tshirt_image', 'rikk', 'a dino tshirt', 1, 'clothing', 4.99);

$connection->close();