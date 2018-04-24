<?php
class User{
    private $userID;
    private $isAdmin;
    public  $username;
    public  $password;
    public  $email;
    public  $billingStreetOne;
    public  $billingStreetTwo;
    public  $billingCity;
    public  $billlingState;
    public  $billingZip;
    public  $avatarImg;
    public  $cardNumber;
    public  $cardExpDate;
    public  $cardSecureCode;

    public function __construct(){
        $this->username = "";
        $this->password = "";
        $this->email = "";
        $this->billingStreetOne = "";
        $this->billingStreetTwo = "";
        $this->billingCity = "";
        $this->billingState = "";
        $this->billingZip = "";
        $this->avatarImg = "";
        $this->cardNumber = "";
        $this->cardExpDate = "";
        $this->cardSecureCode = "";

    }

    public static function createNewUser($username,$password,$email,$billingStreetOne,$billingStreetTwo,$billingCity,$billingState,$billingZip,$avatarImg,$cardNumber,$cardExpDate,$cardSecureCode){
		$instance = new self();
		$instance->username = $username;
		
		$instance->email = $email;
		$instance->billingStreetOne = $billingStreetOne;
		$instance->billingStreetTwo = !empty($billingStreetTwo)?"'$billingStreetTwo'" : "NULL";
		$instance->billingcity = $billingCity;
		$instance->billingState = $billingState;
		$instance->billingZip = $billingZip;
		$instance->avatarImg = !empty($avatarImg)?"'$avatarImg'": "Default Location";
		$instance->cardNumber = $cardNumber;
		$instance->cardExpDate = $cardExpDate;
		$instance->cardSecureCode = $cardSecureCode;
		$salt1 = "kate";
		$salt2 = "leo";
		$password = hash('ripemd128',"$salt1$password$salt2");
		$instance->password = $password;
	   //require_once 'login.php';
        $conn = new mysqli('localhost', 'root', 'YES', 'group7_project_database');
        if($conn->connect_error) die($conn->connect_error);
        $query1 = "SELECT * FROM user ORDER BY userID DESC LIMIT 1 ";
        $result1 = $conn->query($query1);
        if (!$result1) die($conn->error);

        $isAdmin = 0;

        $query2 = ("INSERT INTO user(username, password, email, billingStreetOne,billingStreetTwo,billingState,billingCity,billingZip,avatarImg,cardNumber,cardExpDate,cardSecureCode,isAdmin)
		VALUES('$username','$password','$email','$billingStreetOne', $instance->billingStreetTwo,'$billingState','$billingCity','$billingZip','$avatarImg','$cardNumber','$cardExpDate','$cardSecureCode','$isAdmin')");
		$result2 = $conn->query($query2);
		if (!$result2) die($conn->error);
        $conn->close();

    }
    public static function getExistingUser($userID){
		$instance = new self();
		
        $instance->userID = $userID;

        //require_once 'login.php';
        $conn = new mysqli('localhost', 'root', 'YES', 'group7_project_database');
        if($conn->connect_error) die($conn->connect_error);
        $query1 = "SELECT * FROM user WHERE userID = " .$userID;
        $result = $conn->query($query1);
        if (!$result) die($conn->error);
        $row = $result->fetch_array(MYSQLI_ASSOC);
		$instance->userID = $row['userID'];
        $instance->username = $row['username'];
        $instance->password = $row['password'];
        $instance->email = $row['email'];
        $instance->billingStreetOne = $row['billingStreetOne'];
        $instance->billingStreetTwo = $row['billingStreetTwo'];
        $instance->billingCity = $row['billingCity'];
        $instance->billingState = $row['billingState'];
        $instance->billingZip = $row['billingZip'];
        $instance->avatarImg = $row['avatarImg'];
        $instance->cardNumber = $row['cardNumber'];
        $instance->cardExpDate = $row['cardExpDate'];
        $instance->cardSecureCode = $row['cardSecureCode'];
		$instance->isAdmin = $row['isAdmin'];
        /*
		print($instance->userID .PHP_EOL);
		print($instance->username .PHP_EOL);
		print($instance->password .PHP_EOL);
		print($instance->email .PHP_EOL);
		print($instance->billingStreetOne .PHP_EOL);
		print($instance->billingStreetTwo .PHP_EOL);
		print($instance->billingState .PHP_EOL);
		print($instance->billingCity .PHP_EOL);
		print($instance->billingZip .PHP_EOL);
		print($instance->avatarImg .PHP_EOL);
		print($instance->cardNumber .PHP_EOL);
		print($instance->cardExpDate .PHP_EOL);
		print($instance->cardSecureCode .PHP_EOL);
		print($instance->isAdmin .PHP_EOL);
		*/
        $conn->close();
		return $instance;
    }
	public function getUserID(){
		return($this->userID);
	}
	public function setUserID(){
		$this->userID = $userID;
	}
    public function getUsername(){
        return($this->username);
    }

    public function setUsername(){
        $this->username = $username;
    }

    public function getPassword(){
        return($this->password);
    }

    public function setPassword(){
        $this->password = $password;
    }

    public function getEmail(){
        return($this->email);
    }

    public function setEmail(){
        $this->email = $email;
    }

    public function getBillingStreetOne(){
        return($this->billingStreetOne);
    }

    public function setBillingStreetOne(){
        $this->billingStreetOne = $billingStreetOne;
    }

    public function getBillingStreetTwo(){
        return($this->billingStreetTwo);
    }

    public function setBillingStreetTwo(){
        $this->billingStreetTwo = $billingStreetTwo;
    }

    public function getBillingCity(){
        return($this->billingCity);
    }

    public function setBillingCity(){
        $this->billingCity = $billingCity;
    }

    public function getBillingState(){
        return($this->billingState);
    }

    public function setBillingState(){
        $this->billingState = $billingState;
    }

    public function getBillingZip(){
        return($this->billingZip);
    }

    public function setBillingZip(){
        $this->billingZip = $bililngZip;
    }

    public function getAvatarImg(){
        return($this->avatarImg);
    }

    public function setAvatarImg(){
        $this->avatarImg = $avatarImg;
    }

    public function getCardNumber(){
        return($this->cardNumber);
    }

    public function setCardNumber(){
        $this->cardNumber = $cardNumber;
    }

    public function getCardExpDate(){
        return($this->cardExpDate);
    }

    public function setCardExpDate(){
        $this->cardExpDate = $cardExpDate;
    }

    public function getCardSecureCode(){
        return($this->cardExpDate);
    }

    public function setCardSecureCode(){
        $this->cardSecureCode = $cardSecureCode;
    }

	public function getIsAdmin(){
		return($this->isAdmin);
	}
	
	public function setIsAdmin(){
		$this->isAdmin = $isAdmin;
	}
	
    public function deleteUser($userID){
        //require_once 'login.php';
        $conn = new mysqli('localhost', 'root', '', 'group7_project_database');
        if($conn->connect_error) die($conn->connect_error);

        $query1 = "SELECT * FROM user WHERE userID = ".$userID;
        $result = $conn -> query($query1);
        if(!$result) die($conn->error);

        $result = $conn->query($query1);
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $ifAdmin = $row['isAdmin'];
        $currentUserID = $row['userID'];
        if($ifAdmin or $currentUserID == $userID)
        {
            $query2 = "DELETE FROM user WHERE userID = ". $userID;
            $result = $conn -> query($query2);
            if(!$result) die($conn->error);
        }
        $conn->close();
    }
}
?>