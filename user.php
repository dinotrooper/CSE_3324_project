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

    public function __construct($username,$password,$email,$billingStreetOne,$bilingStreetTwo,$billingCity,$billingState,$bilingZip,$avatarimg,$cardNumber,$cardExpDate,$cardSecureCode){
        $this->userame = $username;
        $this->password = $password;
        $this->email = $email;
        $this->billingStreetOne = $billingStreetOne;
        $this->billingStreetTwo = $bilingStreetTwo;
        $this->billingCity = $billingCity;
        $this->billingState = $billingState;
        $this->billingZip = $billingZip;
        $this->avatarImg = $avatarImg;
        $this->cardNumber = $cardNumber;
        $this->cardExpDate = $cardExpDate;
        $this->cardSecureCode = $cardSecureCode;

        require_once 'login.php';
        $conn = new mysqli($hn, $un, $pq, $db);
        if($conn->connect_error) die($conn->connect_error);
        $query1 = "SELECT * FROM user ORDER BY userID DESC LIMIT 1 ";
        $result = $conn->query($query1);
        if (!$result) die($conn->error);
        $this->userID = $result->fetch_array(MYSQLI_ASSOC)['userID'] + 1;
        $this->isAdmin = 0;

        $query2 = mysql_query("INSERT INTO user(userID, username, password, email, billingStreetOne,billingStreetTwo,billingCity,billingZip,avatarImg,cardNumber,cardExpDate,cardSecureCode,isAdmin) VALUES('$username','$password','$email',
        '$billingStreetOne','$billingStreetTwo','$billingCity','$billingState','$billingZip','$avatarImg','$cardNumber','$cardExpDate','$cardSecureCode')")

        
    }

    public function     
}