<?php
class Item {
    private $itemName;
    private $itemID;
    private $itemDescription;
    private $itemCategory;
    private $itemImageSrc;
    private $itemQuantity;
    private $itemPrice;
    private $ratings; 
    private $comments;
    
    public function __construct() {
        $this->itemName = '';
        $this->itemID = 0;
        $this->itemDescription = '';
        $this->itemCategory ='';
        $this->itemImageSrc ='';
        $this->itemQuantity = 0;
        $this->itemPrice = 0.0;
        $this->comments = [];
        $this->ratings = [];
    }
    
    public static function existingItem($itemID) {
        //create an instance of the class
        $instance = new self();
        
        //initialize class members
        $instance->itemID = $itemID;
        $instance->ratings = [];
        $instance->comments = [];
        
        //connect to database
        require_once 'login.php';
        $conn = new mysqli($hn, $un, $pw, $db);
        if($conn->connect_error) die($conn->connect_error);
        
        //if item is in items table, get class values
        $query = "SELECT * FROM items WHERE itemID = $itemID";
        $result = $conn->query($query);
        if (!$result) die($conn->error);
        
        $result->data_seek(0);
        $instance->itemName = $result->fetch_array(MYSQLI_ASSOC)['itemName'];
        $instance->itemDescription = $result->fetch_array(MYSQLI_ASSOC)['itemDescription'];
        $instance->itemCategory = $result->fetch_array(MYSQLI_ASSOC)['itemCategory'];
        $instance->itemImageSrc = $result->fetch_array(MYSQLI_ASSOC)['itemImageSrc'];
        $instance->itemQuantity = $result->fetch_array(MYSQLI_ASSOC)['itemQuantity'];
        $instance->itemPrice = $result->fetch_array(MYSQLI_ASSOC)['itemPrice'];
        
        //get all ratingIDs with the same itemID and put into a list
        $query = "SELECT * FROM item_ratings WHERE itemID = $itemID";
        $result = $conn->query($query);
        if (!$result) die($conn->error);
        
        $rows = $result->num_rows;
        
        for ($j = 0 ; $j < $rows ; ++$j)
        {
            $result->data_seek($j);
            $instance->ratings[] = $result->fetch_array(MYSQLI_ASSOC)['ratingID'];
        }
        
        //get all commentIDs with the same itemID and put into a list
        $query = "SELECT * FROM item_comments WHERE itemID = $itemID";
        $result = $conn->query($query);
        if (!$result) die($conn->error);
        
        $rows = $result->num_rows;
        
        for ($j = 0 ; $j < $rows ; ++$j)
        {
            $result->data_seek($j);
            $instance->comments[] = $result->fetch_array(MYSQLI_ASSOC)['commentID'];
        }
        
        //disconnect from database
        $conn->close();
        
        return $instance;
    }
    
    //TODO: make note of missing parameter $userID
    public static function newItem($userID, $itemName, $itemDescription, $itemCategory, $itemImageSrc, $itemQuantity, $itemPrice) {
        //create new instance of class
        $instance = new self();    
        
        //initialize class members
        $instance->itemName = $itemName;
        $instance->itemCategory = $itemCategory;
        $instance->itemDescription = $itemDescription;
        $instance->itemImageSrc = $itemImageSrc;
        $instance->itemPrice = $itemPrice;
        $instance->itemQuantity = $itemQuantity;
        $instance->ratings = [];
        $instance->comments = [];
        
        //connect to database
        require_once 'login.php';
        $conn = new mysqli($hn, $un, $pw, $db);
        if($conn->connect_error) die($conn->connect_error);
        
        //create new item in the items table
        $query = "INSERT INTO items(userID, itemImage, itemName, itemDescription, itemQuantity, itemCategory, itemPrice) 
                 VALUES ($userID, '$itemName', '$itemDescription', '$itemCategory', '$itemImageSrc', $itemQuantity, $itemPrice)";
        $result = $conn->query($query);
        if (!$result) die($conn->error);
        
        //get itemID from the items table using the userID 
        //since users can make multiple items we grab the largest item id associated with userID
        //the newest item will always have the largest id
        $query = "SELECT * FROM items WHERE userID = $userID";
        $result = $conn->query($query);
        if (!$result) die($conn->error);
        
        $rows = $num_rows;
        $this->itemID = 0;
        
        for ($j = 0 ; $j < $rows ; ++$j)
        {
            $result->data_seek($j);
            $tempID = $result->fetch_array(MYSQLI_ASSOC)['itemID'];
            if ($tempID > $instance->itemID) $instance->itemID = $tempID;
        }
        
        //disconnect from database
        $conn->close();
        
        return $instance;
    }
    
    public function getItemName() {
        return ($this->itemName);
    }
    
    public function setItemName($itemName) {
        $this->itemName = $itemName;
    }
    
    public function getItemDescription() {
        return ($this->itemDescription);
    }
    
    public function setItemDescription($itemDescription) {
        $this->itemDescriptiion = $itemDescription;
    }
    
    public function getItemCategory() {
        return($this->itemCategory);
    }
    
    public function setItemCategory($itemCategory) {
        $this->itemCategory = $itemCategory;
    }
    
    public function getItemImageSrc() {
        return($this->itemImageSrc);
    }
    
    public function setItemImageSrc($itemImageSrc) {
        $this->itemImageSrc = $itemImageSrc;
    }
    
    public function getItemQuantity () {
        return ($this->itemQuantity);
    }
    
    public function setItemQuantity($itemQuantity) {
        $this->itemQuantity = $itemQuantity;
    }
    
    public function getItemPrice() {
        return ($this->itemPrice);
    }
    
    public function setItemPrice($itemPrice) {
        $this->itemPrice = $itemPrice;
    }
    
    public function getRatings() {
        return ($this->ratings);
    }
    
    public function getComments() {
        return ($this->comments);
    }
    
    public function deleteItem($userID) {
        //connect to database
        require_once 'login.php';
        $conn = new mysqli($hn, $un, $pw, $db);
        if($conn->connect_error) die($conn->connect_error);
        
        //check to see if the userID is an admin
        //grab the isAdmin value from the user table
        $query = "SELECT isAdmin FROM user WHERE userID = $userID";
        $result = $conn ->query($query);
        if(!$result) die($conn->error);
        
        $result = $conn->query($query);
        $result->data_seek(0);
        $isAdmin = $result->fetch_array(MYSQLI_ASSOC)['isAdmin'];
        
        if($isAdmin)
        {
            //TODO: write queries that will delete the current item
            //from the other item tables (orders_items, cart_items)
            
            //finally delete item from items table
            $query = "DELETE FROM items WHERE itemID = $this->itemID";
            $result = $conn ->query($query);
            if(!$result) die($conn->error);
            
            //TODO: set all the class members to NULL
        }
        //since the userID wasn't an admin check to see if the userID is the owner of the cart
        else
        {
            //grab the original userID associated with the cart
            $query = "SELECT userID FROM items WHERE itemID = $this->itemID";
            $result = $conn->query($query);
            if(!$result) die($conn->error);
            $result->data_seek(0);
            $itemCreator = $result->fetch_array(MYSQLI_ASSOC)['userID'];
            
            //compare the user of the cart and cartID
            if($itemCreator == $userID)
            {
                
                //TODO: write queries that will delete the current item
                //from the other item tables (orders_items, cart_items)
                
                //finally delete item from items table
                $query = "DELETE FROM items WHERE itemID = $this->itemID";
                $result = $conn ->query($query);
                if(!$result) die($conn->error);
                
                //TODO: set all the class members to NULL
            }
        }
        //disconnect from database;
        $conn->close();
    }
    
    public function addItemRating($userID, $rating) {
        //connect to database
        require_once 'login.php';
        $conn = new mysqli($hn, $un, $pw, $db);
        if($conn->connect_error) die($conn->connect_error);
        
        //create and send the query to create the rating in the item_rating table
        $query = "INSERT INTO item_ratings(itemID, userID, ratingNumber) VALUES ($this->itemID, $userID, $rating)";
        $result = $conn ->query($query);
        if(!$result) die($conn->error);
        
        //get rating ID to add to item ratings list
        //since a user can comment multiple times, will get the largest commentID from the table
        //the newest comment from the user will always have the largest commentID
        $query = "SELECT * FROM item_ratings WHERE userID = $userID";
        $result = $conn->query($query);
        if (!$result) die($conn->error);
        
        $rows = $num_rows;
        $ratingID = 0;
        
        for ($j = 0 ; $j < $rows ; ++$j)
        {
            $result->data_seek($j);
            $tempID = $result->fetch_array(MYSQLI_ASSOC)['ratingID'];
            if ($tempID > $ratingID) $ratingID = $tempID;
        }
        
        $this->ratings[] = $ratingID;
        
        //disconnect from database
        $conn->close();
    }
    
    public function deleteItemRating($userID, $ratingID) {
        //connect to database
        require_once 'login.php';
        $conn = new mysqli($hn, $un, $pw, $db);
        if($conn->connect_error) die($conn->connect_error);
        
        //check to see if the userID is an admin
        //grab the isAdmin value from the user table
        $query = "SELECT isAdmin FROM user WHERE userID = $userID";
        $result = $conn ->query($query);
        if(!$result) die($conn->error);
        
        $result = $conn->query($query);
        $result->data_seek(0);
        $isAdmin = $result->fetch_array(MYSQLI_ASSOC)['isAdmin'];
        
        if($isAdmin)
        {
            $query = "DELETE FROM item_ratings WHERE ratingID = $ratingID";
            $result = $conn ->query($query);
            if(!$result) die($conn->error);
            
            //TODO: do we need to set all the class members to NULL?
        }
        //since the userID wasn't an admin check to see if the userID is the owner of the cart
        else
        {
            //grab the original userID associated with the cart
            $query = "SELECT userID FROM item_ratings WHERE ratingID = $ratingID";
            $result = $conn->query($query);
            if(!$result) die($conn->error);
            $result->data_seek(0);
            $ratingCreator = $result->fetch_array(MYSQLI_ASSOC)['userID'];
            
            //compare the user of the cart and cartID
            if($ratingCreator == $userID)
            {
                $query = "DELETE FROM item_ratings WHERE ratingID = $ratingID";
                $result = $conn ->query($query);
                if(!$result) die($conn->error);
            }
        }
        //disconnect from database;
        $conn->close();
    }
    
    public function addItemComment($userID, $comment) {
        //connect to database
        require_once 'login.php';
        $conn = new mysqli($hn, $un, $pw, $db);
        if($conn->connect_error) die($conn->connect_error);
        
        //create and send the query to create the rating in the item_rating table
        $query = "INSERT INTO item_comments(itemID, userID, commentText) VALUES ($this->itemID, $userID,'$comment')";
        $result = $conn ->query($query);
        if(!$result) die($conn->error);
        
        //get rating ID to add to item ratings list
        //since a user can comment multiple times, will get the largest commentID from the table
        //the newest comment from the user will always have the largest commentID
        $query = "SELECT * FROM item_comments WHERE userID = $userID";
        $result = $conn->query($query);
        if (!$result) die($conn->error);
        
        $rows = $num_rows;
        $commentID = 0;
        
        for ($j = 0 ; $j < $rows ; ++$j)
        {
            $result->data_seek($j);
            $tempID = $result->fetch_array(MYSQLI_ASSOC)['ratingID'];
            if ($tempID > $commentID) $commentID = $tempID;
        }
        
        $this->comments[] = $commentID;
        
        //disconnect from database
        $conn->close();
    }
    
    public function deleteItemComment($userID, $commentID) {
        //connect to database
        require_once 'login.php';
        $conn = new mysqli($hn, $un, $pw, $db);
        if($conn->connect_error) die($conn->connect_error);
        
        //check to see if the userID is an admin
        //grab the isAdmin value from the user table
        $query = "SELECT isAdmin FROM user WHERE userID = $userID";
        $result = $conn ->query($query);
        if(!$result) {echo("$conn->error <br>"); die($conn->error);}
        
        $result->data_seek(0);
        $isAdmin = $result->fetch_array(MYSQLI_ASSOC)['isAdmin'];
                
        if($isAdmin)
        {
            $query = "DELETE FROM item_comments WHERE commentID = $commentID";
            $result = $conn ->query($query);
            if(!$result) {echo("$conn->error <br>"); die($conn->error);}
            
            //TODO: set all the class members to NULL?
        }
        //since the userID wasn't an admin check to see if the userID is the owner of the cart
        else
        {
            //grab the original userID associated with the cart
            $query = "SELECT userID FROM item_comments WHERE commentID = $commentID";
            $result = $conn->query($query);
            if(!$result) {echo("$conn->error <br>"); die($conn->error);}
            
            $result->data_seek(0);
            $commentCreator = $result->fetch_array(MYSQLI_ASSOC)['userID'];
            
            //compare the user of the cart and cartID
            if($commentCreator == $userID)
            {
                $query = "DELETE FROM item_comments WHERE commentID = $commentID";
                $result = $conn ->query($query);
                if(!$result) {echo("$conn->error <br>"); die($conn->error);}
            }
        }
        //disconnect from database;
        $conn->close();
    }
}
?>