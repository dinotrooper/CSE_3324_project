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
    public function __construct($userID, $cartID, $orderTotal, $shippingName, $shippingStreetOne, $shippingStreetTwo, $shippingCity, $shippingState, $shippingZip)
	{
        //initialize class members
	    $this->orderTotal = $orderTotal;
	    $this->shippingName = $shippingName;
	    $this->shippingStreetOne = $shippingStreetOne;
	    $this->shippingStreetTwo = $shippingStreetTwo;
	    $this->shippingCity = $shippingCity;
	    $this->shippingState = $shippingState;
	    $this->shippingZip = $shippingZip;
	    
	    //get date and time from server
	    $dateTime = getDate();
	    $orderDate = "".$dateTime['year']."-".$dateTime['mon']."-".$dateTime['mday']." ".$dateTime['hours'].":".$dateTime['minutes'].":".$dateTime['seconds']."";
	    $this->orderDate = $orderDate;
	    
	    //connect to the database
	    require_once 'login.php';
	    $conn = new mysqli($hn, $un, $pw, $db);
	    if($conn->connect_error) die($conn->connect_error);
	    
	    //create new order in the orders table
        $query = "INSERT INTO orders(userID, shippingStreetOne, shippingStreetTwo, shippingStreetCity, shippingState, shippingZip, orderDate) 
                            VALUES ($userID, '$shippingStreetOne', '$shippingStreetTwo', '$shippingCity', '$shippingState', $shippingZip, '$orderDate')";
        $result = $conn ->query($query);
		if(!$result) die($conn->error);
		
		//get orderID from orders table
		//since users can have more than one order, get the largest orderID
		//newest orders have the largest numbers
		$query = "SELECT orderID FROM orders WHERE userID = $userID";
		$result = $conn->query($query);
		if (!$result) die($conn->error);
		
		$rows = $num_rows;
		$this->orderID = 0;
		
		for ($j = 0 ; $j < $rows ; ++$j)
		{
		    $result->data_seek($j);
		    $tempID = $result->fetch_array(MYSQLI_ASSOC)['ratingID'];
		    if ($tempID > $this->orderID) $this->orderID = $tempID;
		}
		
		//disconnect from database
		$conn->close();
		
    }
    
    public function __construct($orderID) {
        //initialize class members
        $this->orderID = $orderID;
        
        //connect to the database
        require_once 'login.php';
        $conn = new mysqli($hn, $un, $pw, $db);
        if ($conn->connect_error) die($conn->connect_error);
        
        //get class members from orders table
        $query = "SELECT * FROM orders WHERE orderID = $orderID";
        $result = $conn->query($query);
        if (!$result) die($conn->error);
        
        $result->data_seek(0);
        $this->orderDate = $result->fetch_array(MYSQLI_ASSOC)['orderDate'];
        $this->shippingStreetOne = $result->fetch_array(MYSQLI_ASSOC)['shippingStreetOne'];
        $this->shippingStreetTwo = $result->fetch_array(MYSQLI_ASSOC)['shippingStreeTwo'];
        $this->shippingCity = $result->fetch_array(MYSQLI_ASSOC)['shippingCity'];
        $this->shippingZip = $result->fetch_array(MYSQLI_ASSOC)['shippingZip'];
        
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
        return ($this->shippingState);
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
	        $query = "DELETE FROM orders WHERE orderID = $this->orderID";
	        $result = $conn ->query($query);
	        if(!$result) die($conn->error);
	        
	        //TODO: do we need to set all class members to NULL?
	    }
	    //since the userID wasn't an admin check to see if the userID is the owner of the cart
	    else
	    {
	        //grab the original userID associated with the cart
	        $query = "SELECT userID FROM orders WHERE orderID = $this->orderID";
	        $result = $conn->query($query);
	        if(!$result) die($conn->error);
	        $result->data_seek(0);
	        $orderOwner = $result->fetch_array(MYSQLI_ASSOC)['userID'];
	        
	        //compare the user of the cart and cartID
	        if($orderOwner == $userID)
	        {
	            $query = "DELETE FROM orders WHERE orderID = $this->orderID";
	            $result = $conn ->query($query);
	            if(!$result) die($conn->error);
	        }
	    }
	    //disconnect from database
	    $conn->close();
    }
}
?>