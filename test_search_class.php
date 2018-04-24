<?php 
require_once "setup_test_databases.php";
require_once "search.php";

$connection = connectToLocalDatabase();
deleteAllDataFromTables($connection);

$dino_userID = createUser($connection, 'dinotrooper', 'alexward', 'dino@gmail.com', '123 Fire Rd', 'Starkville', 'MS', 98765, 12345678, '3/3000', 134, 1);
$wrekk_userID = createUser($connection, 'wrekker', 'wardalex', 'wrekker@gmail.com', '123 Water Rd', 'Memphis', 'TN', 65478, 98765432, '8/2045', 753, 1);
$lee_userID = createUser($connection, 'lee-thegreat', 'wardlee', 'greatlee@gmail.com', '123 Grass Rd', 'Huntsville', 'AL', 45218, 12378965, '4/2075', 367, 0);


$itemID_one = createItem($connection, 'dinotrooper', $dino_userID, 'image1', 'titantic t-shirt', 'who doesnt love the titanic', 2, 'Clothing and Accessories', 1.99);
$itemID_two = createItem($connection, 'dinotrooper', $dino_userID, 'image2', 'titantic movie poster', 'the perfect thing for your empty walls in your empty apartment', 4, 'Other', 39.99);
$itemID_three = createItem($connection, 'dinotrooper', $dino_userID, 'image3', 'leos oscar replica', 'he finally got one', 1, 'Other', 129.99);
$itemID_four = createItem($connection, 'dinotrooper', $dino_userID, 'image4', 'the mini iceberg that could', 'a story of the journey of the iconic iceberg through its life', 3, 'Literature', 39.99);
$itemID_five = createItem($connection, 'wrekker', $wrekk_userID, 'image5', 'iceberg throwpillow', 'for when you need to chill', 1, 'Merchandise', 8.99);
$itemID_six = createItem($connection, 'wrekker', $wrekk_userID, 'image6', 'winslet painting', 'a beautiful picture', 2, 'Artwork', 32.99);
$itemID_seven = createItem($connection, 'wrekker', $wrekk_userID, 'image7', 'titantic wheel replica', 'yep the one from titantic', 6, 'Merchandise', 45.99);
$itemID_eight = createItem($connection, 'wrekker', $wrekk_userID, 'image8', 'iceberg t-shirt', 'a shirt to celebrate the iconic character', 3, 'Clothing and Accessories', 28.99);
$itemID_nine = createItem($connection, 'lee', $lee_userID, 'image9', 'the old lady', 'spoiler: she lived', 2, 'Electronic Media', 19.99);
$itemID_ten = createItem($connection, 'lee', $lee_userID, 'image10', 'titantic the movie: collectors edition', 'signed by leo too', 1, 'Electronic Media', 199.99);
$itemID_eleven = createItem($connection, 'lee', $lee_userID, 'image11', 'a life of a lady on the titantic', 'he worked pretty hard', 6, 'Liteature', 19.99);
$itemID_twelve = createItem($connection, 'lee', $lee_userID, 'image12', 'heart of the sea replica', 'its shiny', 1, 'Clothing and Accessories', 999.99);
$itemID_thirten = createItem($connection, 'lee', $lee_userID, 'image13', 'the iconic titantic door replica', 'youll notice that they both can fit on there', 3, 'Merchandise', 69.99);
$itemID_fourteen = createItem($connection, 'lee', $lee_userID, 'image14', 'iceberg keychain', 'have the iconic iceberg with you at all times', 9, 'Clothing and Accessories', 7.99);

$listTitanicIDs = [$itemID_one, $itemID_two, $itemID_seven, $itemID_ten, $itemID_eleven, $itemID_thirten];
$listIcebergIDs = [$itemID_four, $itemID_five, $itemID_eight, $itemID_fourteen];
$listLadyMovieIDs = [$itemID_two, $itemID_nine, $itemID_ten,  $itemID_eleven];

echo("Testing applying keyword titanic through class constructor. <br>");

$listTitanicKeywords = ['titantic'];
$searchTitanic = new Search($listTitanicKeywords);
$titanticOutputList = $searchTitanic->getFoundItemIDs();

echo("Class member itemNames <br>");
foreach($titanticOutputList as $itemID) {
    $query = "SELECT itemName FROM items WHERE itemID = $itemID";
    $result = sendQuery($connection, $query);
    $itemName = $result->fetch_array(MYSQLI_ASSOC)['itemName'];
    echo("itemName: $itemName of itemID: $itemID <br>");
}

$listIcebergKeywords = ['iceberg'];
$searchIceberg = new Search($listIcebergKeywords);
$icebergOutputList = $searchIceberg->getFoundItemIDs();

echo("Class member itemNames <br>");
foreach($icebergOutputList as $itemID) {
    $query = "SELECT itemName FROM items WHERE itemID = $itemID";
    $result = sendQuery($connection, $query);
    $itemName = $result->fetch_array(MYSQLI_ASSOC)['itemName'];
    echo("itemName: $itemName of itemID: $itemID <br>");
}

$listLadyMovieKeywords = ['lady', 'movie'];
$searchMovieLady = new Search($listLadyMovieKeywords);
$ladyMovieOutputList = $searchMovieLady->getFoundItemIDs();

echo("Class member itemNames <br>");
foreach($ladyMovieOutputList as $itemID) {
    $query = "SELECT itemName FROM items WHERE itemID = $itemID";
    $result = sendQuery($connection, $query);
    $itemName = $result->fetch_array(MYSQLI_ASSOC)['itemName'];
    echo("itemName: $itemName of itemID: $itemID <br>");
}

echo("Correct itemNames <br>");
foreach($listLadyMovieIDs as $itemID) {
    $query = "SELECT itemName FROM items WHERE itemID = $itemID";
    $result = sendQuery($connection, $query);
    $itemName = $result->fetch_array(MYSQLI_ASSOC)['itemName'];
    echo("itemName: $itemName of itemID: $itemID <br>");
}


echo("Applying ascending numerical filter <br>");
$searchTitanic->setAscending(1);
$searchTitanic->setNumerical(1);
$searchTitanic->applyFilter();
$numeAscendTitanticOutputlist = $searchTitanic->getFoundItemIDs();

echo("Class member itemNames <br>");
foreach($numeAscendTitanticOutputlist as $itemID) {
    $query = "SELECT itemName FROM items WHERE itemID = $itemID";
    $result = sendQuery($connection, $query);
    $itemName = $result->fetch_array(MYSQLI_ASSOC)['itemName'];
    echo("itemName: $itemName of itemID: $itemID <br>");
}

echo("Applying descending numerical filter <br>");
$searchTitanic->setAscending(0);
$searchTitanic->setDescending(1);
$searchTitanic->setNumerical(1);
$searchTitanic->applyFilter();
$numeAscendTitanticOutputlist = $searchTitanic->getFoundItemIDs();

echo("Class member itemNames <br>");
foreach($numeAscendTitanticOutputlist as $itemID) {
    $query = "SELECT itemName FROM items WHERE itemID = $itemID";
    $result = sendQuery($connection, $query);
    $itemName = $result->fetch_array(MYSQLI_ASSOC)['itemName'];
    echo("itemName: $itemName of itemID: $itemID <br>");
}

echo("Applying descending alphbetical filter <br>");
$searchTitanic->setDescending(1);
$searchTitanic->setNumerical(0);
$searchTitanic->setAlphabetical(1);
$searchTitanic->applyFilter();
$numeAscendTitanticOutputlist = $searchTitanic->getFoundItemIDs();

echo("Class member itemNames <br>");
foreach($numeAscendTitanticOutputlist as $itemID) {
    $query = "SELECT itemName FROM items WHERE itemID = $itemID";
    $result = sendQuery($connection, $query);
    $itemName = $result->fetch_array(MYSQLI_ASSOC)['itemName'];
    echo("itemName: $itemName of itemID: $itemID <br>");
}

echo("Applying ascending alphabetical filter <br>");
$searchTitanic->setDescending(0);
$searchTitanic->setAscending(1);
$searchTitanic->setNumerical(0);
$searchTitanic->setAlphabetical(1);
$searchTitanic->applyFilter();
$numeAscendTitanticOutputlist = $searchTitanic->getFoundItemIDs();

echo("Class member itemNames <br>");
foreach($numeAscendTitanticOutputlist as $itemID) {
    $query = "SELECT itemName FROM items WHERE itemID = $itemID";
    $result = sendQuery($connection, $query);
    $itemName = $result->fetch_array(MYSQLI_ASSOC)['itemName'];
    echo("itemName: $itemName of itemID: $itemID <br>");
}

echo("Applying categories filter <br>");
$listCategories = ['Merchandise'];
$searchTitanic->setCategories($listCategories);
$searchTitanic->applyFilter();
$numeAscendTitanticOutputlist = $searchTitanic->getFoundItemIDs();

echo("Class member itemNames <br>");
foreach($numeAscendTitanticOutputlist as $itemID) {
    $query = "SELECT itemName FROM items WHERE itemID = $itemID";
    $result = sendQuery($connection, $query);
    $itemName = $result->fetch_array(MYSQLI_ASSOC)['itemName'];
    echo("itemName: $itemName of itemID: $itemID <br>");
}


echo("Applying price range $25 to $65 <br>");
$listCategories = [];
$searchTitanic->setCategories($listCategories);
$searchTitanic->setNumerical(1);
$searchTitanic->setAlphabetical(0);
$searchTitanic->setPriceRangeNumOne(25);
$searchTitanic->setPriceRangeNumTwo(65);
$searchTitanic->applyFilter();

$numeAscendTitanticOutputlist = $searchTitanic->getFoundItemIDs();

echo("Class member itemNames <br>");
foreach($numeAscendTitanticOutputlist as $itemID) {
    $query = "SELECT itemName FROM items WHERE itemID = $itemID";
    $result = sendQuery($connection, $query);
    $itemName = $result->fetch_array(MYSQLI_ASSOC)['itemName'];
    echo("itemName: $itemName of itemID: $itemID <br>");
}


$connection->close();

?>