<?php 
class Cart{
    private $itemsInCart;
    private $cartID;
    private $cartTotal;
    
    public function __construct($userID)
	{
		//initialize class members
	    $this->itemsInCart = [];
	    $this->cartTotal = 0;
		
		//connect to database
	    require_once 'login.php';
		$conn = new mysqli($hn, $un, $pw, $db);
		if($conn->connect_error) die($conn->connect_error);
		
		//query database to see if the cart already exists
		$query = "SELECT cartID FROM cart WHERE userID = $userID";
		$cartIDExists = $conn->query($query);
		if(!$cartIDEXists)
		{
		    //if it doesn't, create a new cart w/ the userID
			$query = "INSERT INTO cart VALUES ($userID)"; //TODO: verify this is the right way to format the variable into the insert query
			$result = $conn->query($query);
			if(!$result) die($conn->error);
			
			//grab new cartID from database using userID
			$query = "SELECT cartID FROM cart WHERE userID = $userID";
			$result = $conn->query($query);
			$result->data_seek(0);
			$cartID = $result->fetch_array(MYSQLI_ASSOC)['cartID'];
		}
		else
		{
		    //grab cartID from datbase using userID
		    $result = $cartIDExists;
            $result->data_seek(0);
		    $cartID = $result->fetch_array(MYSQLI_ASSOC)['cartID'];
			
		    //create elements for itemsInCart associative array
		    //using itemIDs as indexes and quantities as values
		    //calculate the total cost of the cart
		    $query = "SELECT itemID FROM cart_items WHERE cartID = $this->cartID";
		    $result = $conn->query($query);
			$rows = $result->num_rows;

			for ($j = 0 ; $j < $rows ; ++$j)
			{
				$result->data_seek($j);
				$row = $result->fetch_array(MYSQLI_ASSOC);
                $itemID = $row['itemID'];
                $quantity = $row['cartQuantity'];
                $itemsInCart[$itemID] = $quantity;
                $cartTotal += $row['priceTotal'];
			}
		}
		//disconnect from database
		$conn->close();
    }
    
    public function deleteCart($userID)
	{
        //connect to database
        require_once 'login.php';
        $conn = new mysqli($hn, $un, $pw, $db);
        if($conn->connect_error) die($conn->connect_error);
        
		//check to see if the userID is an admin
		//grab the isAdmin value from the user table
		$query = "SELECT isAdmin FROM user WHERE userID = ".$userID;
		$result = $conn ->query($query);
		if(!$result) die($conn->error);
	
		$result = $conn->query($query);
		$result->data_seek(0);
		$isAdmin = $result->fetch_array(MYSQLI_ASSOC)['isAdmin'];
				
		if($isAdmin)
		{
			$query = "DELETE FROM cart WHERE cartID = $this->cartID";
			$result = $conn ->query($query);
			if(!$result) die($conn->error);
			
			//TODO: do we need to set all class members to NULL?
		}
		//since the userID wasn't an admin check to see if the userID is the owner of the cart
		else
		{
		    //grab the original userID associated with the cart
		    $query = "SELECT userID FROM cart WHERE cartID = $this->cartID";
		    $result = $conn->query($query);
		    if(!$result) die($conn->error);
		    $result->data_seek(0);
		    $cartUser = $result->fetch_array(MYSQLI_ASSOC)['userID'];
		    
		    //compare the user of the cart and cartID
			if($cartUser == $userID)
			{
				$query = "DELETE FROM cart WHERE cartID = $this->cartID"; 
				$result = $conn ->query($query);
				if(!$result) die($conn->error);
			}
		}
        //disconnect from database
        $conn->close();
    }
    
    public function getItemsInCart()
	{
        return($this->itemsInCart);
    }
    
    public function getCartID()
	{
        return($this->itemsInCart);
    }
    
    public function getCartTotal()
	{
        return($this->cartTotal);
    }
	
	public function deleteItemsFromCart($itemID)
	{
	    //initialize local variables
	    $itemIsInCart = 0;
	    //connect to database
		require_once 'login.php';
        $conn = new mysqli($hn, $un, $pw, $db);
        if($conn->connect_error) die($conn->connect_error);
        
        //check if item is in cart to begin with
        //get list of itemIDs in cart
        
        $query = "SELECT itemID FROM cart_items WHERE cartID = $this->cartID";
        $result = $conn->query($query);
        $rows = $result->num_rows;
        
        for ($j = 0 ; $j < $rows ; ++$j)
        {
            $result->data_seek($j);
            $row = $result->fetch_array(MYSQLI_ASSOC);
            $tempItemID = $row['itemID'];
            if ($tempItemID == $itemID) $itemIsInCart = 1;
        }
        
        if ($itemIsInCart) {
            //reduce the cart total by the price of the item times the quantity of the item
            //get value of item
            $query = "SELECT itemPrice FROM items WHERE itemID = $itemID";
            $result = $conn->query($query);
            $result->data_seek(0);
            $itemPrice = $result->fetch_array(MYSQLI_ASSOC)['itemPrice'];
            //get the quantity of the item from the itemsInCart associate array
            $quantity = $this->itemsInCart[$itemID];
            $cartTotal -= ($itemPrice * $quantity);
            
            //not delete the item from the cart_items table
            $query = "DELETE FROM cart_items WHERE itemID = $itemID";
            $result = $conn->query($query);
            if(!$result) die($conn->error);
            
            $this->itemsInCart[$itemID] = NULL;
        }
        //disconnect from database
        $conn->close();
	}
	
	public function addItemsToCart ($itemID)
	{
		//connect to database
	    require_once 'login.php';
        $conn = new mysqli($hn, $un, $pw, $db);
        if($conn->connect_error) die($conn->connect_error);
        
        //check to see if item exists in items table
        $query = "SELECT * FROM items WHERE itemID = $itemID";
        $itemIDExists = $conn->query($query); //TODO: does the MYSQL database return anything if the query can't pull data?
        
		if ($itemIDExists)
		{
		    //check to see if the item is in the cart's associate array
		    if(isset($this->itemsInCart[$itemID])) {
		        //if it is in cart, update the associate array and the cart_items table
                $this->itemsInCart[$itemID] += 1;
                $query = "UPDATE cart_items SET cartQuantity = ".$this->itemsInCart[$itemID]." WHERE cartID = $this->cartID AND itemID = $itemID"; //TODO: verify that this query is correct
                $result = $conn->query($query);
                if (!$result) die($conn->error);
                
                //get item price and quantity from the itemIDExists query made eariler
                $itemIDExists->data_seek(0);
                $itemPrice = $itemIDExists->fetch_array(MYSQLI_ASSOC)['itemPrice'];
                
                //update the totalPrice field of the row in cart_items table
                $itemTotal = $itemPrice * $this->itemsInCart[$itemID];
                $query = "UPDATE cart_items SET priceTotal = $itemTotal  WHERE cartID = $this->cartID AND itemID = $itemID"; //TODO: verify that this query is correct
                $result = $conn->query($query);
                if (!$result) die($conn->error);
                
                //update the cart total price
                $this->cartTotal += $itemPrice;
		    }
		    else {
		        //if it is not in cart, add it to the associate array and add a row into the cart_items table
		        //get a few values needed by table
		        //first get userID associated with the cartID
		        $query = "SELECT userID FROM cart WHERE cartID = $this->cartID";
		        $result = $conn->query($query);
		        if (!$result) die($conn->error);
		        $result->data_seek(0);
		        
		        $userID = $result->fetch_array(MYSQLI_ASSOC)['userID'];
		        
		        //then get item price from the itemIDExists query made earlier
		        $itemIDExists->data_seek(0);
		        $itemPrice = $itemIDExists->fetch_array(MYSQLI_ASSOC)['itemPrice'];
		        
		        //insert the values into the cart_items table
			    $query = "INSERT INTO cart_items(cartID, userID, itemID, cartQuantity, priceTotal) VALUES ($this->cartID, $userID, $itemID, 1, $itemPrice)";//TODO: verify that the numerical one in the query doesn't need quotes
			    $result = $conn ->query($query);
			    if(!$result) die ($conn->error);
			    
			    //add new item's price to cart total
			    $this->cartTotal += $itemPrice;
		    }
		}
		//disconnect from database
		$conn->close();
	}
}


?>