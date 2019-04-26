<?php

require_once 'test_database_functions.php';
require_once 'login.php';
require_once 'item.php';

$connection = connectToLocalDatabase();

echo("Deleting any rows that may be in the database. <br>");
deleteAllDataFromTables($connection);

$item_image = 'tshirt_image';
$item_name = 'Dino Shirt';
$item_desc = 'a dino tshirt';
$item_quantity = 1;
$item_category = 'clothing';
$item_price = 4.99;

$item_image_two = 'tshirt_image2';
$item_name_two = 'A T-rex-shirt';
$item_desc_two = 'A t-rex shirt. lol.';
$item_quantity_two = 2;
$item_category_two = 'Clothing and Apparel';
$item_price_two = 7.99;

$dino_userID = createUser($connection, 'dinotrooper', 'alexward', 'dino@gmail.com', '123 Fire Rd', 'Starkville', 'MS', 98765, 12345678, '3/3000', 134, 1); 
$wrekk_userID = createUser($connection, 'wrekker', 'wardalex', 'wrekker@gmail.com', '123 Water Rd', 'Memphis', 'TN', 65478, 98765432, '8/2045', 753, 1);
$lee_userID = createUser($connection, 'lee-thegreat', 'wardlee', 'greatlee@gmail.com', '123 Grass Rd', 'Huntsville', 'AL', 45218, 12378965, '4/2075', 367, 0);
$steven_userID = createUser($connection, 'steven', 'magicthegather', 'mtgjudge@gmail.com', '123 Rock Rd', 'Southaven', 'MS', 38657, 9854781, '6/2036', 746, 0);

$dino_orderID = createOrder($connection,'dinotrooper', $dino_userID, '123 Fire Rd', 'Starkville', 'MS', 98765, '2018-04-20 10:08:45',208.98);
$wrek_orderID = createOrder($connection, 'wrekker', $wrekk_userID, '123 Water Rd', 'Memphis', 'TN', 65478, '2016-08-15 09:07:23', 204.98);
$lee_orderID = createOrder($connection, 'lee', $lee_userID, '123 Grass Rd', 'Huntsville', 'AL', 45218, '2013-06-08 11:11:11', 13.98);

$dino_itemID = createItem($connection, 'dinotrooper', $dino_userID, $item_image, $item_name, $item_desc, $item_quantity, $item_category, $item_price);
$wrek_itemID = createItem($connection, 'wrekker', $wrekk_userID, 'basketball_image', 'Kool Basketball', 'A really cool basketball', 1, 'sports', 8.99);
$lee_itemID = createItem($connection, 'lee', $lee_userID, 'textbook_image', 'Calculus Textbook', 'Textbook I used from Cal 1 to Cal IV', 1, 'Media', 199.99);

$dino_cartID = createCart($connection, 'dinotrooper', $dino_userID);
$wrek_cartID = createCart($connection, 'wrekker', $wrekk_userID);
$lee_cartID = createCart($connection, 'lee', $lee_userID);

createOrderItem($connection, $dino_orderID, 'Kool Basketball', $dino_userID, 1, 8.99);
createOrderItem($connection, $dino_orderID, 'Calculus Textbook', $dino_userID, 1, 199.99);

createOrderItem($connection, $wrek_orderID, $item_name, $wrekk_userID, 1, $item_price);
createOrderItem($connection, $wrek_orderID, 'Calculus Textbook', $wrekk_userID, 1, 199.99);

createOrderItem($connection, $lee_orderID, $item_name, $lee_userID, 1, $item_price);
createOrderItem($connection, $lee_orderID, 'Kool Basketball', $lee_userID, 1, 8.99);

createCartItem($connection, $dino_cartID, $wrek_itemID, $dino_userID, 1, 8.99);
createCartItem($connection, $dino_cartID, $lee_itemID, $dino_userID, 1, 199.99);

createCartItem($connection, $wrek_cartID, $dino_itemID, $wrekk_userID, 1, 4.99);
createCartItem($connection, $wrek_cartID, $lee_itemID, $wrekk_userID, 1, 199.99);

createCartItem($connection, $lee_cartID, $dino_itemID, $lee_userID, 1, 4.99);
createCartItem($connection, $lee_cartID, $wrek_itemID, $lee_userID, 1, 8.99);

$dino_ratingID = createItemRating($connection, $wrek_itemID, $dino_userID, 1);
$wrek_ratingID = createItemRating($connection, $lee_itemID, $wrekk_userID, 4);
$lee_ratingID = createItemRating($connection, $dino_itemID, $lee_userID, 2);

$dino_commentID = createItemComment($connection, $wrek_itemID, $dino_userID, 'The ball had a hole in it! Unacceptable!');
$wrek_commentID = createItemComment($connection, $lee_itemID, $wrekk_userID, 'The book is in great condition besides some highlighting and notes made in the margin.');
$lee_commentID = createItemComment($connection, $dino_itemID, $lee_userID, 'I love the graphic on the shirt, but it is not the size I wanted.');
$lee_comment_two = 'He saw my comment and sent me a shirt in my size FOR FREE! I am so pumped! Thanks man!';

echo("Finished creating table test data. :D <br><br><br>");
echo("Testing item.php. <br><br><br>");


//first item
echo("Creating a local instance of an existing item called dino_item. <br>");
$dino_item = Item::existingItem($dino_itemID);

echo('Checking the class members of $dino_item. <br>');
if (testItem($dino_item, $dino_itemID, $item_name, $item_desc, $item_category, $item_image, $item_quantity, $item_price, $lee_ratingID, $lee_commentID)) 
    echo('All tests for $dino_item passed! <br>');
    else echo('One or more tests for $dino_item failed! <br>');

echo('Changing the values of the class members of $dino_item. <br>');
if (changeItem($dino_item, $dino_itemID, $lee_userID, $item_name_two, $item_desc_two, $item_category_two, $item_image_two, $item_quantity_two, $item_price_two, 5, $lee_comment_two)) 
    echo('All tests for $dino_item passed! <br>');
else echo('One or more tests for $dino_item failed! <br>');

echo('Deleting $dino_item and any associated data in the items and cart_items data using $dino_userID. <br>');
$dino_item->deleteItem($dino_userID);
if (testDeletedItem($dino_item)) echo('$dino_item successfully deleted! <br>');
else echo('$dino_item was not successfully deleted! <br><br><br>');


//second item
echo('Creating a new instance of item with the static function newItem called $dino_item_two. <br>');
$dino_item_two = Item::newItem($dino_userID, $item_name_two, $item_desc_two, $item_category_two, $item_image_two, $item_quantity_two, $item_price_two);

echo('Checking the class members of $dino_item_two. <br>');
if (testItem($dino_item_two, $dino_itemID + 3, $item_name_two, $item_desc_two, $item_category_two, $item_image_two, $item_quantity_two, $item_price_two, 0, 0))
    echo('All tests for $dino_item_two passed! <br>');
else echo('One or more tests for $dino_item_two failed! <br>');

echo('Adding a new comment and a new rating to $dino_item_two. <br>');
changeItem($dino_item_two, 0, $lee_userID, '', '', '', '', '', '', 5, $lee_comment_two);

echo('Checking the class members of $dino_item_two. <br>');
if (testItem($dino_item_two, $dino_itemID + 3, $item_name_two, $item_desc_two, $item_category_two, $item_image_two, $item_quantity_two, $item_price_two, $wrek_ratingID  + 3, $wrek_commentID + 3))
    echo('All tests for $dino_item_two passed! <br>');
else echo('One or more tests for $dino_item_two failed! <br>');

echo('Deleting $dino_item and any associated data in the items and cart_items data using $wrekk_userID. <br>');
$dino_item_two->deleteItem($wrekk_userID);

if (testDeletedItem($dino_item_two)) echo('$dino_item_two successfully deleted! <br>');
else echo('$dino_item_two was not successfully deleted! <br><br><br>');


//third item
echo('Creating a new instance of item with the static function newItem called $dino_item_three. <br>');
$dino_item_three = Item::newItem($dino_userID, $item_name_two, $item_desc_two, $item_category_two, $item_image_two, $item_quantity_two, $item_price_two);

echo('Adding a new comment and a new rating to $dino_item_three. <br>');
changeItem($dino_item_three, 0, $lee_userID, '', '', '', '', '', '', 5, $lee_comment_two);

echo('Checking class members of item instance $dino_item_three. <br>');
if (testItem($dino_item_three, $dino_itemID + 4, $item_name_two, $item_desc_two, $item_category_two, $item_image_two, $item_quantity_two, $item_price_two, $wrek_ratingID  + 4, $wrek_commentID + 4))
    echo('All tests for $dino_item_three passed! <br>');
    else echo('One or more tests for $dino_item_three failed! <br>');

echo('Deleting $dino_item_three and any associated table data in the items and cart_items data using $lee_userID. <br>');
echo('The item should not be deleted. <br>');
$dino_item_three->deleteItem($lee_userID);
if (testItem($dino_item_three, $dino_itemID + 4, $item_name_two, $item_desc_two, $item_category_two, $item_image_two, $item_quantity_two, $item_price_two, $wrek_ratingID  + 4, $wrek_commentID + 4))
    echo('All tests for $dino_item_three passed! <br>');
    else echo('One or more tests for $dino_item_three failed! <br><br><br>');

echo('Deleting comment and rating associated with $lee_userID using $steve_userID. <br>');
echo('comment and rating should not be deleted. <br>');

$dino_item_three->deleteItemComment($steven_userID, $wrek_commentID + 5);
$dino_item_three->deleteItemRating($steven_userID, $wrek_commentID + 5);

if (testItem($dino_item_three, $dino_itemID + 4, $item_name_two, $item_desc_two, $item_category_two, $item_image_two, $item_quantity_two, $item_price_two, $wrek_ratingID  + 4, $wrek_commentID + 4))
    echo('All tests for $dino_item_three passed! <br>');
    else echo('One or more tests for $dino_item_three failed! <br><br><br>');
    
echo('Deleting comment and rating associated with $lee_userID using $lee_userID. <br>');
echo('Comment and Rating should be deleted. <br>');

$dino_item_three->deleteItemComment($lee_userID, $wrek_commentID + 4);
$dino_item_three->deleteItemRating($lee_userID, $wrek_commentID + 4);

if (testDeletedComments($dino_item_three)) echo("Comment deleted successfully. <br>");
if (testDeletedRatings($dino_item_three)) echo ("Rating deleted successfully. <br>");

// foreach ($dino_item_three->getComments() as $commentID) {
//     echo("CommentID from object: $commentID <br>");
// }

// foreach ($dino_item_three->getRatings() as $ratingID) {
//     echo("Rating from object: $ratingID <br>");
// }

function testItem($item, $id, $name, $description, $category, $image, $quantity, $price, $rating, $comment) {
    $allTestPassed = 1;
    
    if ($id) {$allTestPassed = testValues($id, $item->getItemID()); echo("ItemId check result: $allTestPassed. <br>");}
    if ($name) {$allTestPassed = testValues($name, $item->getItemName()); echo("ItemName check result: $allTestPassed. <br>");}
    if ($description) {$allTestPassed = testValues($description, $item->getItemDescription()); echo("ItemDescription check result: $allTestPassed. <br>"); }
    if ($category) {$allTestPassed = testValues($category, $item->getItemCategory()); echo("ItemCategory check result: $allTestPassed. <br>"); }
    if ($image) {$allTestPassed = testValues($image, $item->getItemImage()); echo("ItemImageSrc check result: $allTestPassed. <br>"); }
    if ($quantity) {$allTestPassed = testValues($quantity, $item->getItemQuantity()); echo("ItemQuantity check result: $allTestPassed. <br>"); }
    if ($price) {$allTestPassed = testValues($price, $item->getItemPrice()); echo("ItemPrice check result: $allTestPassed. <br>"); }
    if ($rating) $allTestPassed = checkItemRating($item, $rating);
    if ($comment) $allTestPassed = checkItemComment($item, $comment);
    
    return $allTestPassed;
}

function changeItem($item, $id, $userID, $name, $description, $category, $image, $quantity, $price, $ratingNum, $commentTxt) {

    if ($name) $item->setItemName($name);
    if ($description) $item->setItemDescription($description);
    if ($category) $item->setItemCategory($category);
    if ($image) $item->setItemImage($image);
    if ($quantity) $item->setItemQuantity($quantity);
    if ($price) $item->setItemPrice($price);
    if ($ratingNum) {
        $item->addItemRating($userID, $ratingNum);
        $ratings = $item->getRatings();
        $ratingID = $ratings[count($ratings) - 1];
    }
    if ($commentTxt) {
        $item->addItemComment($userID, $commentTxt);
        $comments = $item->getComments();
        $commentID = $comments[count($comments) -1];
    }
    
    return testItem($item, $id, $name, $description, $category, $image, $quantity, $price, $ratingID, $commentID);
}

function testDeletedItem($item) {
    $allTestPassed = 1;
    
    if ($item->getItemID()) {echo("ItemID check failed. <br>"); $allTestPassed = 0;}
    if ($item->getItemName()) {echo("ItemName check failed. <br>"); $allTestPassed = 0;}
    if ($item->getItemDescription()) {echo("ItemDescription check failed. <br>"); $allTestPassed = 0;}
    if ($item->getItemCategory()) {echo("ItemCategory check failed. <br>"); $allTestPassed = 0;}
    if ($item->getItemImage()) {echo("ItemImage check failed. <br>"); $allTestPassed = 0;}
    if ($item->getItemQuantity()) {echo("ItemQuantity check failed. <br>"); $allTestPassed = 0;}
    if ($item->getItemPrice()) {echo("ItemPrice check failed. <br>"); $allTestPassed = 0;}
    $allTestPassed = testDeletedComments($item);
    $allTestPassed = testDeletedRatings($item);
    //if ($item->getItemsInOrder()) {echo("ItemsInOrder check failed. <br>"); $allTestPassed = 0;}
    
    return $allTestPassed;
}

function testDeletedComments($item) {
    $testPassed = 1;
    
    foreach ($item->getComments() as $commentID) {
        //echo("CommentID from object: $commentID <br>");
        if ($commentID) {echo("CommentID check failed."); $testPassed = 0;}
    }
    
    return $testPassed;
}
function testDeletedRatings($item) {
    $testPassed = 1;
    
    foreach ($item->getRatings() as $ratingID) {
        //echo("Rating from object: $ratingID <br>");
        if ($ratingID) {
            echo("RatingID check failed."); $testPassed = 0;
        }
    }
    return $testPassed;
}

function checkItemRating($item, $rating) {
    $testPassed = 1;
   
    if (is_array($rating) ) {
        foreach($item->getRatings() as $getRatingID) {
            if (($key = array_search($getRatingID, $rating)) === false) {echo('RatingID check failed. <br>'); $testPassed = 0;}
        }
    }
    else if (($key = array_search($rating, $item->getRatings())) === false) {echo('RatingID check failed. <br>'); $testPassed = 0; }
    return $testPassed;
}

function checkItemComment($item, $comment) {
    $testPassed = 1;
    if (is_array($comment)) {
        foreach($item->getComments() as $getCommentID) {
            if (($key = array_search($getCommentID, $comment)) === false) {echo('CommentID check failed. <br>'); $testPassed = 0;}
        }
    }
    else if (($key = array_search($comment, $item->getComments())) === false) {echo('CommentID check failed. <br>'); $testPassed = 0;}
    return $testPassed;
}


































?>