<?php
$systemName = 'STUDENT TRANSFER SYSTEM';
session_start();

define ('DB_HOST', 'localhost');
define ('DB_NAME', 'transfer');
define ('DB_USER', 'root');
define ('DB_PASSWORD', '');

class Database
{
    protected $dbConnect = null;
    protected $userTable = 'users';

    //CONSTRUCTOR - CONNECT TO DATABASE
    public function __construct()
    {

        if(!$this->dbConnect) {

            $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        }
        if($conn->connect_error){

            die("Error failed to connect to MySQL: " . $conn->connect_error);
        }else{

            $this->dbConnect = $conn;
        }
    }
    public function __destruct()
    {

        $this->dbConnect->close();
    }
}

class User extends Database {

    public function login($email, $password) {

        $password = md5($password);
		$sqlQuery = "SELECT * FROM ".$this->userTable." WHERE email='".$email."' AND password='".$password."'";
        
        $results = $this->getData($sqlQuery);
        
        $data = $results;
 
        return $data;
    }
    public function getData($sqlQuery)
    {

        $result = mysqli_query($this->dbConnect, $sqlQuery);
        if ( $result->num_rows > 0 ) {
            $data = array();
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        return @$data;
    }
    public function checkLogin() {

        if (!isset($_SESSION['email'])) {
            header ('Location:login.php');
		}
	}
    public function getAddress($getUrl) {

        //URL FOR FILE INCLLUDE IN INDEX PAGE
        switch ($getUrl) {
            case 'request':
                $getUrl = 'request-transfer.php';
                break;
            case 'group-members':
                $getUrl = 'add-group-members.php';
                break;
            case 'group-activities':
                $getUrl = 'add-group-activities.php';
                break;
            case 'request':
                $getUrl = 'loan-request.php';
                break;
            case 'member':
                $getUrl = 'member-dash.php';
                break;
            case 'admin':
                $getUrl = 'admin-dash.php';
                break;
            case 'group-details':
                $getUrl = 'group-details.php';
                break;
            default:
                $getUrl = null;
                break;
        }

        return $getUrl;
    }
}