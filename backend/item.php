<?php
class Item {
    private $itemName;
    private $itemID;
    private $itemDescription;
    private $itemCategory;
    //TODO: make note of deviation of design document
    private $itemImage;
    private $itemQuantity;
    private $itemPrice;
    private $ratings; 
    private $comments;
    
    public function __construct() {
        $this->itemName = '';
        $this->itemID = 0;
        $this->itemDescription = '';
        $this->itemCategory ='';
        $this->itemImage ='';
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
        $conn = new mysqli($GLOBALS['hn'], $GLOBALS['un'], $GLOBALS['pw'], $GLOBALS['db']);
        if($conn->connect_error) die($conn->connect_error);
        
        //if item is in items table, get class values
        $query = "SELECT * FROM items WHERE itemID = $itemID";
        $result = $conn->query($query);
        if (!$result) die($conn->error);
        
        $result->data_seek(0);
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $instance->itemName = $row['itemName'];
        $instance->itemDescription = $row['itemDescription'];
        $instance->itemCategory = $row['itemCategory'];
        $instance->itemImage = $row['itemImage'];
        $instance->itemQuantity = $row['itemQuantity'];
        $instance->itemPrice = $row['itemPrice'];
        
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
    public static function newItem($userID, $itemName, $itemDescription, $itemCategory, $itemImage, $itemQuantity, $itemPrice) {
        //create new instance of class
        $instance = new self();    
        
        //connect to database
        require_once 'login.php';
        $conn = new mysqli('localhost', 'root', '', 'group7_project_database');
        if($conn->connect_error) die($conn->connect_error);
        
        //create new item in the items table
        $query = "INSERT INTO items(userID, itemImage, itemName, itemDescription, itemQuantity, itemCategory, itemPrice) 
                             VALUES ($userID, '$itemImage', '$itemName', '$itemDescription', $itemQuantity, '$itemCategory', $itemPrice)";
        $result = $conn->query($query);
        if (!$result) die($conn->error);
        
        //initialize class members
        $instance->setItemName($itemName);
        $instance->setItemCategory($itemCategory);
        $instance->setItemDescription($itemDescription);
        $instance->setItemImage($itemImage);
        $instance->setItemPrice($itemPrice);
        $instance->setItemQuantity($itemQuantity);
        
        //get itemID from the items table using the userID 
        //since users can make multiple items we grab the largest item id associated with userID
        //the newest item will always have the largest id
        $query = "SELECT * FROM items WHERE userID = $userID";
        $result = $conn->query($query);
        if (!$result) die($conn->error);
        
        $rows = $result->num_rows;
        $instance->itemID = 0;
        
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
    
    public function getItemID() {
        return $this->itemID;
    }
    
    public function getItemName() {
        return $this->itemName;
    }
    
    public function setItemName($itemName) {
        
        $conn = new mysqli('localhost', 'root', '', 'group7_project_database');
        if($conn->connect_error) die($conn->connect_error);
        
        $query = "UPDATE items SET itemName = '$itemName' WHERE itemID = $this->itemID";
        $result = $conn->query($query);
        if (!$result) {echo("$conn->error <br>"); die($conn->error);}
        
        $this->itemName = $itemName;
        
        $conn->close();
    }
    
    public function getItemDescription() {
        return $this->itemDescription;
    }
    
    public function setItemDescription($itemDescription) {
        
        $conn = new mysqli('localhost', 'root', '', 'group7_project_database');
        if($conn->connect_error) die($conn->connect_error);
        
        $query = "UPDATE items SET itemDescription = '$itemDescription' WHERE itemID = $this->itemID";
        $result = $conn->query($query);
        if (!$result) {echo("$conn->error <br>"); die($conn->error);}
        
        $this->itemDescription = $itemDescription;
        
        $conn->close();
    }
    
    public function getItemCategory() {
        return $this->itemCategory;
    }
    
    public function setItemCategory($itemCategory) {
        
        $conn = new mysqli('localhost', 'root', '', 'group7_project_database');
        if($conn->connect_error) die($conn->connect_error);
        
        $query = "UPDATE items SET itemCategory = '$itemCategory' WHERE itemID = $this->itemID";
        $result = $conn->query($query);
        if (!$result) {echo("$conn->error <br>"); die($conn->error);}
        
        $this->itemCategory = $itemCategory;
        
        $conn->close();
    }
    
    public function getItemImage() {
        return $this->itemImage;
    }
    
    public function setItemImage($itemImage) {
        
        $conn = new mysqli('localhost', 'root', '', 'group7_project_database');
        if($conn->connect_error) die($conn->connect_error);
        
        $query = "UPDATE items SET itemImage = '$itemImage' WHERE itemID = $this->itemID";
        $result = $conn->query($query);
        if (!$result) {echo("$conn->error <br>"); die($conn->error);}
        
        $this->itemImage = $itemImage;
        
        $conn->close();
    }
    
    public function getItemQuantity () {
        return $this->itemQuantity;
    }
    
    public function setItemQuantity($itemQuantity) {
        
        $conn = new mysqli('localhost', 'root', '', 'group7_project_database');
        if($conn->connect_error) die($conn->connect_error);
        
        $query = "UPDATE items SET itemQuantity = $itemQuantity WHERE itemID = $this->itemID";
        $result = $conn->query($query);
        if (!$result) {echo("$conn->error <br>"); die($conn->error);}
        
        $this->itemQuantity = $itemQuantity;
        
        $conn->close();
    }
    
    public function getItemPrice() {
        return $this->itemPrice;
    }
    
    public function setItemPrice($itemPrice) {
        
        $conn = new mysqli('localhost', 'root', '', 'group7_project_database');
        if($conn->connect_error) die($conn->connect_error);
        
        $query = "UPDATE items SET itemPrice = $itemPrice WHERE itemID = $this->itemID";
        $result = $conn->query($query);
        if (!$result) {echo("$conn->error <br>"); die($conn->error);}
        
        $this->itemPrice = $itemPrice;
    }
    
    public function getRatings() {
        return $this->ratings;
    }
    
    public function getComments() {
        return $this->comments;
    }
    
    public function deleteItem($userID) {
        //connect to database
        require_once 'login.php';
        $conn = new mysqli('localhost', 'root', '', 'group7_project_database');
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
            //delete item comments from item_comments table
            foreach($this->comments as $commentID) {
                $this->deleteItemComment($userID, $commentID);
            }
            
            foreach($this->ratings as $ratingID) {
                $this->deleteItemRating($userID, $ratingID);
            }
            
            //delete items from cart_items tables
            $query = "DELETE FROM cart_items WHERE itemID = $this->itemID";
            $result = $conn ->query($query);
            if(!$result) die($conn->error);
            
            //finally delete item from items table
            $query = "DELETE FROM items WHERE itemID = $this->itemID";
            $result = $conn ->query($query);
            if(!$result) die($conn->error);
            
            //TODO: set all the class members to NULL
            $this->itemID = 0;
            $this->itemName = '';
            $this->itemCategory = '';
            $this->itemDescription = '';
            $this->itemImage = '';
            $this->itemPrice = 0;
            $this->itemQuantity = 0;
            $this->ratings = [];
            $this->comments = [];
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
                
                foreach($this->comments as $commentID) {
                    $this->deleteItemComment($userID, $commentID);
                }
                
                foreach($this->ratings as $ratingsID) {
                    $this->deleteItemComment($userID, $ratingID);
                }
                
                //delete items from cart_items tables
                $query = "DELETE FROM cart_items WHERE itemID = $this->itemID";
                $result = $conn ->query($query);
                if(!$result) die($conn->error);
                
                
                //finally delete item from items table
                $query = "DELETE FROM items WHERE itemID = $this->itemID";
                $result = $conn ->query($query);
                if(!$result) die($conn->error);
                
                $this->itemID = 0;
                $this->itemName = '';
                $this->itemCategory = '';
                $this->itemDescription = '';
                $this->itemImage = '';
                $this->itemPrice = 0;
                $this->itemQuantity = 0;
                $this->ratings = [];
                $this->comments = [];
            }
        }
        //disconnect from database;
        $conn->close();
    }
    
    public function addItemRating($userID, $rating) {
        //connect to database
        require_once 'login.php';
        $conn = new mysqli('localhost', 'root', '', 'group7_project_database');
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
        
        $rows = $result->num_rows;
        $ratingID = 0;
        
        for ($j = 0; $j < $rows ; ++$j)
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
        $conn = new mysqli('localhost', 'root', '', 'group7_project_database');
        if($conn->connect_error) die($conn->connect_error);
        
//         echo("userID in deleteItemRating: $userID <br>");
//         echo("ratingID in deleteItemRating: $ratingID <br>");
        
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
            
            //remove list element from list
            //find element with ratingID
            
            for ($j = 0; $j < count($this->ratings); ++$j) {
                if ($this->ratings[$j] == $ratingID) {
                    $this->ratings[$j] = NULL;
                }
            }
        }
        //since the userID wasn't an admin check to see if the userID is the owner of the item
        //or is the owner of the rating
        else
        {
            //grab the userID associated with the rating
            $query = "SELECT userID FROM item_ratings WHERE ratingID = $ratingID";
            $result = $conn->query($query);
            if(!$result) die($conn->error);
            $result->data_seek(0);
            $ratingCreator = $result->fetch_array(MYSQLI_ASSOC)['userID'];
            
            //grab the userID associated with the item
            $query = "SELECT userID FROM items WHERE itemID = $this->itemID";
            $result = $conn->query($query);
            if(!$result) die($conn->error);
            $result->data_seek(0);
            $itemCreator = $result->fetch_array(MYSQLI_ASSOC)['userID'];
            
            if($ratingCreator == $userID)
            {
                $query = "DELETE FROM item_ratings WHERE ratingID = $ratingID";
                $result = $conn ->query($query);
                if(!$result) die($conn->error);
                
                //remove list element from list
                for ($j = 0; $j < count($this->ratings); ++$j) {
                    if ($this->ratings[$j] == $ratingID) {
                        $this->ratings[$j] = NULL;
                    }
                }
            }
            else if ($itemCreator == $userID) {
                $query = "DELETE FROM item_ratings WHERE ratingID = $ratingID";
                $result = $conn ->query($query);
                if(!$result) die($conn->error);               
                
                //remove list element from list
                for ($j = 0; $j < count($this->ratings); ++$j) {
                    if ($this->ratings[$j] == $ratingID) {
                        $this->rating[$j] = NULL;
                    }
                }
            }
        }
        //disconnect from database;
        $conn->close();
    }
    
    public function addItemComment($userID, $comment) {
        //connect to database
        require_once 'login.php';
        $conn = new mysqli('localhost', 'root', '', 'group7_project_database');
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
        
        $rows = $result->num_rows;
        $commentID = 0;
        
        for ($j = 0; $j < $rows ; ++$j)
        {
            $result->data_seek($j);
            $tempID = $result->fetch_array(MYSQLI_ASSOC)['commentID'];
            if ($tempID > $commentID) $commentID = $tempID;
        }
        
        $this->comments[] = $commentID;
        
        //disconnect from database
        $conn->close();
    }
    
    public function deleteItemComment($userID, $commentID) {
        //connect to database
        require_once 'login.php';
        $conn = new mysqli('localhost', 'root', '', 'group7_project_database');
        if($conn->connect_error) die($conn->connect_error);
        
//         echo("userID in deleteItemRating: $userID. <br>");
//         echo("CommentID in deleteItemComment: $commentID. <br>");
        
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
            
            //remove list element from list
            for ($j = 0; $j < count($this->comments); ++$j) {
                if ($this->comments[$j] == $commentID) {
                    $this->comments[$j] = NULL;
                }
            }
        }
        //since the userID wasn't an admin check to see if the userID is the owner of the item
        //or is the owner of the rating
        else
        {
            //grab the original userID associated with the comment
            $query = "SELECT userID FROM item_comments WHERE commentID = $commentID";
            $result = $conn->query($query);
            if(!$result) {echo("$conn->error <br>"); die($conn->error);}
            $result->data_seek(0);
            $commentCreator = $result->fetch_array(MYSQLI_ASSOC)['userID'];
            
            //grab the original userID associated with the item
            $query = "SELECT userID FROM items WHERE itemID = $this->itemID";
            $result = $conn->query($query);
            if(!$result) die($conn->error);
            $result->data_seek(0);
            $itemCreator = $result->fetch_array(MYSQLI_ASSOC)['userID'];
            
            if($commentCreator == $userID)
            {
                $query = "DELETE FROM item_comments WHERE commentID = $commentID";
                $result = $conn ->query($query);
                if(!$result) {echo("$conn->error <br>"); die($conn->error);}
                
                
                //remove list element from list
                for ($j = 0; $j < count($this->comments); ++$j) {
                    if ($this->comments[$j] == $commentID) {
                        $this->comments[$j] = NULL;
                    }
                }
                
            }
            
            elseif ($itemCreator == $userID) {
                $query = "DELETE FROM item_comments WHERE commentID = $commentID";
                $result = $conn ->query($query);
                if(!$result) {echo("$conn->error <br>"); die($conn->error);}
                
                
                //remove list element from list
                for ($j = 0; $j < count($this->comments); ++$j) {
                    if ($this->comments[$j] == $commentID) {
                        $this->comments[$j] = NULL;
                    }
                    
                }   
            }
            //disconnect from database;
           $conn->close();
        }
    }
}

?>
