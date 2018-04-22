<?php 
class Order{
    private $orderID;
    private $orderTotal;
    private $shippingName;
	private $shippingStreetOne;
	private $shippingStreetTwo;
	private $shippingCity;
	private $shippingState;
	private $shippingZip;
	private $orderDate;
	
	//TODO: ask why we didn't include userID in order constructor
	//TODO: want to add a list of items like in cart?
	public function __construct(){
	    $this->orderID = 0;
	    $this->orderTotal = 0;
	    //TODO: either add a shippingName field in the orders table
	    //or delete this shippingName class member
	    $this->shippingName = '';
	    $this->shippingStreetOne = '';
	    $this->shippingStreetTwo = '';
	    $this->shippingCity = '';
	    $this->shippingState = '';
	    $this->shippingZip = 0;
	    $this->orderDate = '';
	}
	
	
    public static function NewOrder($userID, $cartID, $orderTotal, $shippingName, $shippingStreetOne, $shippingStreetTwo, $shippingCity, $shippingState, $shippingZip)
	{
        //create new instance of the class
        $instance = new self();
        
        //initialize class members
	    $instance->orderTotal = $orderTotal;
	    $instance->shippingName = $shippingName;
	    $instance->shippingStreetOne = $shippingStreetOne;
	    $instance->shippingStreetTwo = $shippingStreetTwo;
	    $instance->shippingCity = $shippingCity;
	    $instance->shippingState = $shippingState;
	    $instance->shippingZip = $shippingZip;
	    
	    //get date and time from server
	    $dateTime = getDate();
	    $orderDate = "".$dateTime['year']."-".$dateTime['mon']."-".$dateTime['mday']." ".$dateTime['hours'].":".$dateTime['minutes'].":".$dateTime['seconds']."";
	    $instance->orderDate = $orderDate;
	    
	    //connect to the database
	    //require_once 'login.php';
	    $conn = new mysqli('localhost', 'root', '', 'group7_project_database');
	    if($conn->connect_error) die($conn->connect_error);
	    
	    //create new order in the orders table
        $query = "INSERT INTO orders(userID, shippingStreetOne, shippingStreetTwo, shippingStreetCity, shippingState, shippingZip, orderDate) 
                            VALUES ($userID, '$shippingStreetOne', '$shippingStreetTwo', '$shippingCity', '$shippingState', $shippingZip, '$orderDate')";
        $result = $conn ->query($query);
        if(!$result) {echo("$conn->error <br>"); die($conn->error);}
		
		//get orderID from orders table
		//since users can have more than one order, get the largest orderID
		//newest orders have the largest numbers
		$query = "SELECT orderID FROM orders WHERE userID = $userID";
		$result = $conn->query($query);
		if(!$result) {echo("$conn->error <br>"); die($conn->error);}
		
		$rows = $num_rows;
		$this->orderID = 0;
		
		for ($j = 0 ; $j < $rows ; ++$j)
		{
		    $result->data_seek($j);
		    $tempID = $result->fetch_array(MYSQLI_ASSOC)['ratingID'];
		    if ($tempID > $insance->orderID) $instance->orderID = $tempID;
		}
		
		
		//calulate order total
		//get all items that are associated with the orderID
		$query = "SELECT * FROM orders_items WHERE orderID = $instance->orderID";
		$orderItems = $conn->query($query);
		if(!$orderItems) {echo("$conn->error <br>"); die($conn->error);}
		
		$rows = $orderItems->num_rows;
		for ($j = 0 ; $j < $rows ; ++$j)
		{
		    //get itemID and itemQuantity from order_items table
		    $orderItems->data_seek($j);
		    $row = $orderItems->fetch_array(MYSQLI_ASSOC);
		    $itemID = $row['itemID'];
		    $quantity = $row['orderQuantity'];
		    
		    //get itemPrice using itemID from items table
		    $query = "SELECT * FROM items WHERE itemID = $itemID";
		    $item = $conn->query($query);
		    if(!$item) {echo("$conn->error <br>"); die($conn->error);}
		    $itemPrice = $item->fetch_array(MYSQLI_ASSOC)['itemPrice'];
		    
		    //add to total equal to itemPrice * itemQuantity
		    $instance->orderTotal += ($itemPrice * $quantity);
		}
		
		
		//disconnect from database
		$conn->close();
		
		return $instance;
		
    }
    
    public static function ExistingOrder($orderID) {
        //create new instance of class
        $instance = new self();
        
        //initialize class members
        $instance->orderID = $orderID;
        
        //connect to the database
        //require_once 'login.php';
        $conn = new mysqli('localhost', 'root', '', 'group7_project_database');
        if ($conn->connect_error){echo($conn->connect_error); die($conn->connect_error);}
        
        //get class members from orders table
        $query = "SELECT * FROM orders WHERE orderID = $orderID";
        $result = $conn->query($query);
        if(!$result) {echo("$conn->error <br>"); die($conn->error);}
        $row = $result->fetch_array(MYSQLI_ASSOC);
   
        $instance->orderDate = $row['orderDate'];
        $instance->shippingStreetOne = $row['shippingStreetOne'];
        $instance->shippingStreetTwo = $row['shippingStreetTwo'];
        $instance->shippingCity = $row['shippingCity'];
        $instance->shippingState = $row['shippingState'];
        $instance->shippingZip = $row['shippingZip'];
        
        //calulate order total
        //get all items that are associated with the orderID
        $query = "SELECT * FROM orders_items WHERE orderID = $instance->orderID";
        $orderItems = $conn->query($query);
        if(!$orderItems) {echo("$conn->error <br>"); die($conn->error);}
        
        $rows = $orderItems->num_rows;
        for ($j = 0 ; $j < $rows ; ++$j)
        {
            //get itemID and itemQuantity from order_items table
            $orderItems->data_seek($j);
            $row = $orderItems->fetch_array(MYSQLI_ASSOC);
            $itemID = $row['itemID'];
            $quantity = $row['orderQuantity'];
            
            //get itemPrice using itemID from items table
            $query = "SELECT * FROM items WHERE itemID = $itemID";
            $item = $conn->query($query);
            if(!$item) {echo("$conn->error <br>"); die($conn->error);}
            $itemPrice = $item->fetch_array(MYSQLI_ASSOC)['itemPrice'];
            
            //add to total equal to itemPrice * itemQuantity
            $instance->orderTotal += ($itemPrice * $quantity);
        }
        
        return $instance;
        
    }
    
    public function getOrderTotal() {
        return ($this->orderTotal);
    }
    
    public function getShippingName() {
        return ($this->shippingName);
    }
    
    public function getShippingStreetOne() {
        return ($this->shippingStreetOne);
    }
    
    public function getShippingStreetTwo() {
        return ($this->shippingStreetTwo);
    }
    
    public function getShippingCity() {
        return ($this->shippingCity);
    }
    
    public function getShippingState() {
        return ($this->shippingState);
    }
    
    public function getShippingZip() {
        return ($this->shippingZip);
    }
    
    public function getOrderDate() {
        return ($this->orderDate);
    }
    
    public function deleteOrder($userID)
	{
	    //connect to database
	    //require_once 'login.php';
	    $conn = new mysqli('localhost', 'root', '', 'group7_project_database');
	    if($conn->connect_error) die($conn->connect_error);
	    
	    //check to see if the userID is an admin
	    //grab the isAdmin value from the user table
	    $query = "SELECT isAdmin FROM user WHERE userID = ".$userID;
	    $result = $conn ->query($query);
	    if(!$result) {echo("$conn->error <br>"); die($conn->error);}
	    
	    $result = $conn->query($query);
	    $result->data_seek(0);
	    $isAdmin = $result->fetch_array(MYSQLI_ASSOC)['isAdmin'];
	    
	    if($isAdmin)
	    {
	        //delete all items in the orders_items table associated with this orderID
	        $query = "DELETE FROM orders_items WHERE orderID = $this->orderID";
	        $result = $conn ->query($query);
	        if(!$result) {echo($conn->error); die($conn->error);}
	        
	        //delete the row in the orders table
	        $query = "DELETE FROM orders WHERE orderID = $this->orderID";
	        $result = $conn ->query($query);
	        if(!$result) {echo("$conn->error <br>"); die($conn->error);}
	        
	        //set all class members to NULL or zero
	        $this->orderDate = '';
	        $this->orderTotal = 0;
	        $this->shippingName = '';
	        $this->shippingStreetOne = '';
	        $this->shippingStreetTwo = '';
	        $this->shippingCity = '';
	        $this->shippingState = '';
	        $this->shippingZip = 0;
	        $this->orderID = 0;
	    }
	    //since the userID wasn't an admin check to see if the userID is the owner of the cart
	    else
	    {
	        //grab the original userID associated with the cart
	        $query = "SELECT userID FROM orders WHERE orderID = $this->orderID";
	        $result = $conn->query($query);
	        if(!$result) {echo($conn->error); die($conn->error);}
	        $result->data_seek(0);
	        $orderOwner = $result->fetch_array(MYSQLI_ASSOC)['userID'];
	        
	        //compare the user of the cart and cartID
	        if($orderOwner == $userID)
	        {
	            $query = "DELETE FROM orders_items WHERE orderID = $this->orderID";
	            $result = $conn ->query($query);
	            if(!$result) {echo($conn->error); die($conn->error);}
	            
	            $query = "DELETE FROM orders WHERE orderID = $this->orderID";
	            $result = $conn ->query($query);
	            if(!$result) {echo("$conn->error <br>"); die($conn->error);}
	            
	            $this->orderDate = '';
	            $this->orderTotal = 0;
	            $this->shippingName = '';
	            $this->shippingStreetOne = '';
	            $this->shippingStreetTwo = '';
	            $this->shippingCity = '';
	            $this->shippingState = '';
	            $this->shippingZip = 0;
	            $this->orderID = 0;
	        }
	    }
	    //disconnect from database
	    $conn->close();
    }
}
?>