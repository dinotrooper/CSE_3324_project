<?php 
class Cart{
    private $orderID;
    private $orderTotal;
    private $shippingName;
	private $shippingStreet;
	private $shippingCity;
	private $shippingState;
	private $shippingZip;
	private $orderDate;
	
    public function __construct()
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
	
	public function deleteItemsFromCart (itemID)
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
	
	public function addItemsToCart (itemID)
	{
		require_once 'login.php';
        $conn = new mysqli($hn, $un, $pw, $db);
        if($conn->connect_error)
            die($conn->connect_error);
		if($itemIDExists)
		{
			$query0 = "SELECT quantity FROM cart_items WHERE itemID = ".$itemID;
			$quantity = $conn ->query($query0);
			if(!quantity) die (conn->connection_error);
			$quantity += 1;
			$query = "UPDATE cart_items SET quantity = ".$quantity." WHERE userID = ".$userID; 
		}
		else
		{
			$query = "INSERT INTO cart_items VALUES (".$cartID.", ".$userID.", 
					".$itemID.", 1".$priceTotal.")";
		}
		$result = $conn ->query($query);
		if(!result) die(conn->connection_error);
	}
}
?>