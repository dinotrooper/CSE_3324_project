<?php 
class Cart{
    private $itemsInCart;
    private $cartID;
    private $cartTotal;
    
    public function __construct($userID)
	{
        $this->itemsInCart = [];
        $this->cartTotal = 0;
		require_once 'login.php';
        $conn = new mysqli($hn, $un, $pw, $db);
        if($conn->connect_error)
            die($conn->connect_error);
        $query = "INSERT INTO cart VALUES (".$userID.")";
		$result = $conn ->query($query);
		if(!result) die(conn->connection_error);
		$query1 = "SELECT cartID FROM cart WHERE userID = ".$userID;
		$cartID = $conn ->query($query1);
		if(!cartID) die(conn->connection_error);
    }
    
    public function deleteCart(userID)
	{
        require_once 'login.php';
        $conn = new mysqli($hn, $un, $pw, $db);
        if($conn->connect_error)
            die($conn->connect_error);
		
		$query0 = "SELECT isAdmin FROM user WHERE userID = ".$userID;
		$isAdmin = $conn ->query($query0);
		if(!isAdmin) die(conn->connection_error);
		
		$query1 = "SELECT userID FROM cart WHERE cartID = ".$cartID;
		$isCorrectUser = $conn ->query($query1);
		if(!isCorrectUser) die(conn->connection_error);
		
		if($isAdmin)
		{
			$query = "DELETE FROM cart WHERE userID =". 
				$userID;
		}
		else
		{
			if($isCorrectUser == $userID)
			{
				$query = "DELETE FROM cart WHERE userID =". 
				$userID;
			}
		}
		$result = $conn ->query($query);
		if(!result) die(conn->connection_error);
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
	
	public function deleteItemsFromCart ()
	{
		require_once 'login.php';
        $conn = new mysqli($hn, $un, $pw, $db);
        if($conn->connect_error)
            die($conn->connect_error);
        $query = "DELETE FROM cart_items WHERE itemID =". 
            $itemID;
		$result = $conn ->query($query);
		if(!result) die(conn->connection_error);
	}
	
	public function addItemsToCart ()
	{
		require_once 'login.php';
        $conn = new mysqli($hn, $un, $pw, $db);
        if($conn->connect_error)
            die($conn->connect_error);
        $query = "INSERT INTO cart_items VALUES (".$cartID.", ".$userID.", 
		         ".$itemID.", 1".$priceTotal.")";
		$result = $conn ->query($query);
		if(!result) die(conn->connection_error);
	}
}


?>