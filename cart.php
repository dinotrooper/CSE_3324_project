<?php 
class Cart{
    private $itemsInCart;
    private $cartID;
    private $cartTotal;
    
    public function __construct($userID){
        $this->itemsInCart = [];
        $this->cartID = 0;
        $this->cartTotal = 0;
    }
    
    public function deleteCart(userID){
        require_once 'login.php';
        $conn = new mysqli($hn, $un, $pw, $db);
        if($conn->connect_error)
            die($conn->connect_error);
        $query = "DELETE FROM cart WHERE userID =". 
            $userID;
        
    }
    
    public function getItemsInCart(){
        return($this->itemsInCart);
    }
    
    public function getCartID(){
        return($this->itemsInCart);
    }
    
    public function getCartTotal(){
        return($this->cartTotal);
    }
}


?>