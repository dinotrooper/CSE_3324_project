<?php 
class Cart{
    private $itemsInCart;
    private $cartID;
    private $cartTotal;
    
    public function __construct(userID)
	{
		require_once 'login.php';
		$conn = new mysqli($hn, $un, $pw, $db);
		if($conn->connect_error)
			die($conn->connect_error);
		
		$query0 = "SELECT cartID FROM cart WHERE userID = ".$userID;
		$cartExists = $conn ->query($query0);
		if(!cartExists)
		{
			$this->itemsInCart = [];
			$this->cartTotal = 0;
			
			$query = "INSERT INTO cart VALUES (".$userID.")";
			$result = $conn ->query($query);
			
			if(!result) die(conn->connection_error);
			$query1 = "SELECT cartID FROM cart WHERE userID = ".$userID;
			
			$cartID = $conn ->query($query1);
			if(!cartID) die(conn->connection_error);
		}
		else
		{
			$query2 = "SELECT  
			
			$rows = $result->num_rows;

			for ($j = 0 ; $j < $rows ; ++$j)
			{
				$result->data_seek($j);
				$row = $result->fetch_array(MYSQLI_ASSOC);

				echo 'Author: '   . $row['author']   . '<br>';
				echo 'Title: '    . $row['title']    . '<br>';
				echo 'Category: ' . $row['category'] . '<br>';
				echo 'Year: '     . $row['year']     . '<br>';
				echo 'ISBN: '     . $row['isbn']     . '<br><br>';
			}
		}
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