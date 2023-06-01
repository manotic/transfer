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
    protected $regionTable = 'regions';
    protected $districtTable = 'districts';
    protected $transferTable = 'transfers';

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
}

class User extends Database {

    public function login($email, $password) 
    {

        $password = md5($password);
		$sqlQuery = "SELECT * FROM ".$this->userTable." WHERE email='".$email."' AND password='".$password."'";
        
        $results = $this->getData($sqlQuery);
        
        $data = $results;
 
        return $data;
    }
    public function checkLogin()
    {

        if (!isset($_SESSION['email'])) {
            header ('Location:login.php');
		}
	}
    public function getAddress($getUrl)
    {

        //URL FOR FILE INCLLUDE IN INDEX PAGE
        switch ($getUrl) {
            case 'request':
                $getUrl = 'request-transfer.php';
                break;
            case 'in_region':
                $getUrl = 'in-region-transfers.php';
                break;
            // case 'group-activities':
            //     $getUrl = 'add-group-activities.php';
            //     break;
            // case 'request':
            //     $getUrl = 'loan-request.php';
            //     break;
            // case 'member':
            //     $getUrl = 'member-dash.php';
            //     break;
            // case 'admin':
            //     $getUrl = 'admin-dash.php';
            //     break;
            // case 'group-details':
            //     $getUrl = 'group-details.php';
            //     break;
            default:
                $getUrl = null;
                break;
        }

        return $getUrl;
    }
}

class  Location extends Database
{
    
    public function getRegion()
    {

        $sqlQuery = "SELECT * FROM ".$this->regionTable;

        return $this->getData($sqlQuery);
    }
    public function getDistrict($region_id)
    {
        
        $query = "SELECT * FROM ".$this->districtTable." WHERE region_id = ".$region_id." ORDER BY district ASC";

        return $this->getData($query);
    }
}
class Transfer extends Database
{
    public function saveTransfer() {

        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $student_class = $_POST['student_class'];
        $cur_school = $_POST['cur_school'];
        $cur_region = $_POST['cur_region'];
        $cur_district = $_POST['cur_district'];
        $tran_school = $_POST['tran_school'];
        $tran_region = $_POST['tran_region'];
        $tran_district = $_POST['tran_district'];

        //GET PARENT ID
        $parQuery = "SELECT * FROM ".$this->userTable." WHERE email='".$_SESSION['email']."'";
        $result = $this->getData($parQuery);

        if ($cur_region == $tran_region) {

            $status = 1;
        } else if($cur_district == $tran_district) {

            $status = 2;
        } else {
            $status = 3;
        }
        $sqlInsert = "INSERT INTO ".$this->transferTable." VALUES 
        (NULL, '".$firstname."', '".$lastname."', '".$student_class."', '".$cur_school."', '".$cur_region."', '".$cur_district."',
        '".$tran_school."', '".$tran_region."', '".$tran_district."', '".$result[0]['id']."', '".$status."' , NULL )";

        mysqli_query($this->dbConnect, $sqlInsert);
        
        $message = '<div class="alert alert-success rounded-0 py-1">Application sent</div>';

        return $message;
    }
    public function getRegionTransfer ($region_id) {
        
        $sqlQuery = "SELECT * FROM ".$this->transferTable." WHERE cur_region='$region_id' AND status='1'";

        mysqli_query($this->dbConnect, $sqlQuery);
    }
} 