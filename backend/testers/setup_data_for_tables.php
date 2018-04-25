<?php
require_once 'setup_test_databases.php';

$connection = connectToLocalDatabase();

echo("Deleting any rows that may be in the database. <br>");
deleteAllDataFromTables($connection);


$salt1 = 'kate';
$salt2 = 'leo';

$passwordOne = 'abc';
$passwordTwo = '123';
$passwordThree = 'ab12';
$passwordFour = 'cd34';

$hashOne = hash('ripemd128',"$salt1$passwordOne$salt2");
$hashTwo = hash('ripemd128',"$salt1$passwordTwo$salt2");
$hashThree = hash('ripemd128',"$salt1$passwordThree$salt2");
$hashFour = hash('ripemd128',"$salt1$passwordFour$salt2");

$gato_userID = createUser($connection, 'spacegato', $hashOne, 'gato@gmail.com', '123 Fire Rd', 'Starkville', 'MS', 98765, 12345678, '3/3000', 134, 1);
$wrekk_userID = createUser($connection, 'wrekker', $hashTwo, 'wrekker@gmail.com', '123 Water Rd', 'Memphis', 'TN', 65478, 98765432, '8/2045', 753, 0);
$lee_userID = createUser($connection, 'lee-thegreat', $hashThree, 'greatlee@gmail.com', '123 Grass Rd', 'Huntsville', 'AL', 45218, 12378965, '4/2075', 367, 0);
$steven_userID = createUser($connection, 'steveromo', $hashFour, 'steve@gmail.com', '123 Rock Rd', 'Southaven', 'MS', 74161, 78965413, '08/2018', 854, 0);

$gato_orderID = createOrder($connection,'spacegato', $gato_userID, '123 Fire Rd', 'Starkville', 'MS', 98765, '2018-04-20 10:08:45', 92.97);
$wrekk_orderID = createOrder($connection,'wrekker', $wrekk_userID, '123 Water Rd', 'Memphis', 'TN', 65478, '2013-07-16 07:18:24', 1199.97);
$lee_orderID = createOrder($connection,'lee-thegreat', $lee_userID, '123 Grass Rd', 'Huntsville', 'AL', 45218, '2012-01-23 05:31:45', 208.98);

$gato_cartID = createCart($connection, 'spacegato', $gato_userID);

$itemID_one = createItem($connection, 'spacegato', $gato_userID, 'image1', 'titantic t-shirt', 'who doesnt love the titanic', 2, 'Clothing and Accessories', 1.99);
$itemID_two = createItem($connection, 'spacegato', $gato_userID, 'image2', 'titantic movie poster', 'the perfect thing for your empty walls in your empty apartment', 4, 'Other', 39.99);
$itemID_three = createItem($connection, 'spacegato', $gato_userID, 'image3', 'leos oscar replica', 'he finally got one', 1, 'Other', 129.99);
$itemID_four = createItem($connection, 'spacegato', $gato_userID, 'image4', 'the mini iceberg that could', 'a story of the journey of the iconic iceberg through its life', 3, 'Literature', 39.99);
$itemID_five = createItem($connection, 'wrekker', $wrekk_userID, 'image5', 'iceberg throwpillow', 'for when you need to chill', 1, 'Merchandise', 8.99);
$itemID_six = createItem($connection, 'wrekker', $wrekk_userID, 'image6', 'winslet painting', 'a beautiful picture', 2, 'Artwork', 32.99);
$itemID_seven = createItem($connection, 'wrekker', $wrekk_userID, 'image7', 'titantic wheel replica', 'yep the one from titantic', 6, 'Merchandise', 45.99);
$itemID_eight = createItem($connection, 'wrekker', $wrekk_userID, 'image8', 'iceberg t-shirt', 'a shirt to celebrate the iconic character', 3, 'Clothing and Accessories', 28.99);
$itemID_nine = createItem($connection, 'lee', $lee_userID, 'image9', 'the old lady', 'spoiler: she lived', 2, 'Electronic Media', 19.99);
$itemID_ten = createItem($connection, 'lee', $lee_userID, 'image10', 'titantic the movie: collectors edition', 'signed by leo too', 1, 'Electronic Media', 199.99);
$itemID_eleven = createItem($connection, 'lee', $lee_userID, 'image11', 'a life of a lady on the titantic', 'he worked pretty hard', 6, 'Liteature', 19.99);
$itemID_twelve = createItem($connection, 'lee', $steven_userID, 'image12', 'heart of the sea replica', 'its shiny', 1, 'Clothing and Accessories', 999.99);
$itemID_thirten = createItem($connection, 'steveromo', $steven_userID, 'image13', 'the iconic titantic door replica', 'youll notice that they both can fit on there', 3, 'Merchandise', 69.99);
$itemID_fourteen = createItem($connection, 'steveromo', $steven_userID, 'image14', 'iceberg keychain', 'have the iconic iceberg with you at all times', 9, 'Clothing and Accessories', 7.99);

createOrderItem($connection, $gato_orderID, 'winslet painting', $gato_userID, 1, 32.99);
createOrderItem($connection, $gato_orderID, 'titantic wheel replica', $gato_userID, 1, 45.99);
createOrderItem($connection, $gato_orderID, 'iceberg keychain', $gato_userID, 2, 13.99);

createOrderItem($connection, $wrekk_orderID, 'heart of the sea replica', $wrekk_userID, 1, 999.99);
createOrderItem($connection, $wrekk_orderID, 'leos oscar replica', $wrekk_userID, 1, 129.99);
createOrderItem($connection, $wrekk_orderID, 'the iconic titantic door replica', $wrekk_userID, 1, 69.99);

createOrderItem($connection, $lee_orderID, 'titantic t-shirt', $lee_userID, 1, 1.99);
createOrderItem($connection, $lee_orderID, 'titantic wheel replica', $lee_userID, 1, 45.99);
createOrderItem($connection, $lee_orderID, 'the mini iceberg that could', $lee_userID, 1, 39.99);

createCartItem($connection, $gato_cartID, $itemID_eight, $gato_userID, 1, 28.99);
createCartItem($connection, $gato_cartID, $itemID_ten, $gato_userID, 1, 199.99);
createCartItem($connection, $gato_cartID, $itemID_thirten, $gato_userID, 1, 69.99);

$gato_ratingID = createItemRating($connection, $itemID_six, $gato_userID, 1);
$wrek_ratingID = createItemRating($connection, $itemID_ten, $wrekk_userID, 4);
$lee_ratingID = createItemRating($connection, $itemID_three, $lee_userID, 2);

$gato_commentID = createItemComment($connection, $itemID_six, $gato_userID, 'I love it');
$wrek_commentID = createItemComment($connection, $itemID_ten, $wrekk_userID, 'I hate it.');
$lee_commentID = createItemComment($connection, $itemID_three, $lee_userID, 'I was okay.');

echo("Finished creating table test data. :D <br><br><br>");


?>