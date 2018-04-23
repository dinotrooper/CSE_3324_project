<?
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

    public function createNewUser($username,$password,$email,$billingStreetOne,$bililngStreetTwo,$billingCity,$bililngState,$billingZip,$avatarImg,$cardNumber,$cardExpDate,$cardSecureCode){
        require_once 'login.php';
        $conn = new mysqli($hn, $un, $pw, $db);
        if($conn->connect_error) die($conn->connect_error);
        $query1 = "SELECT * FROM user ORDER BY userID DESC LIMIT 1 ";
        $result = $conn->query($query1);
        if (!$result) die($conn->error);
        $this->userID = $result->fetch_array(MYSQLI_ASSOC)['userID'] + 1;
        $this->isAdmin = 0;

        $query2 = mysql_query("INSERT INTO user(userID, username, password, email, billingStreetOne,billingStreetTwo,billingCity,billingZip,avatarImg,cardNumber,cardExpDate,cardSecureCode,isAdmin) VALUES('$username','$password','$email',
        '$billingStreetOne','$billingStreetTwo','$billingCity','$billingState','$billingZip','$avatarImg','$cardNumber','$cardExpDate','$cardSecureCode')");

        $conn->close();

    }
    public function getExistingUser($userID){
        $this->userID = $userID;

        require_once 'login.php';
        $conn = new mysqli($hn, $un, $pw, $db);
        if($conn->connect_error) die($conn->connect_error);
        $query1 = "SELECT * FROM user WHERE userID = " .$userID;
        $result = $conn->query($query1);
        if (!$result) die($conn->error);
        $result->data_seek(0);
        $this->username = $result->fetch_array(MYSQLI_ASSOC)['username'];
        $this->password = $result->fetch_array(MYSQLI_ASSOC)['password'];
        $this->email = $result->fetch_array(MYSQLI_ASSOC)['email'];
        $this->billingStreetOne = $result->fetch_array(MYSQLI_ASSOC)['billingStreetOne'];
        $this->billingStreetTwo = $result->fetch_array(MYSQLI_ASSOC)['billingStreetTwo'];
        $this->billingCity = $result->fetch_array(MYSQLI_ASSOC)['billingCity'];
        $this->billingState = $result->fetch_array(MYSQLI_ASSOC)['billingState'];
        $this->bililngZip = $result->fetch_array(MYSQLI_ASSOC)['bililngZip'];
        $this->avatarImg = $result->fetch_array(MYSQLI_ASSOC)['avatarImg'];
        $this->cardNumber = $result->fetch_array(MYSQLI_ASSOC)['cardNumber'];
        $this->cardExpDate = $result->fetch_array(MYSQLI_ASSOC)['cardExpDate'];
        $this->cardSecureCode = $result->fetch_array(MYSQLI_ASSOC)['cardSecureCode'];
        
        $conn->close();
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

    public function deleteUser($userID, $isAdmin){
        require_once 'login.php';
        $conn = new mysqli($hn, $un, $pw, $db);
        if($conn->conect_error) die($conn->connect_error);

        $query1 = "SELECT * FROM user WHERE userID = ".$userID;
        $result = $conn -> query($query1);
        if(!$result) die($conn->error);

        $result = $conn->query($query1);
        $result->data_seek(0);
        $ifAdmin = $result->fetch_array(MYSQLI_ASSOC)['isAdmin'];
        $currentUserID = $result->fetch_array(MYSQLI_ASSOC)['isAdmin'];

        if($ifAdmin or $currentUserID == $userID)
        {
            $query2 = "DELETE * FROM user WHERE userID = ". $userID;
            $result = $conn -> query($query2);
            if(!$result) die($conn->error);
        }
        $conn->close();
    }
}