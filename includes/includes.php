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
    public function saveUser() {

        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password = md5($password);

        $checkQuery = "SELECT * FROM ".$this->userTable." WHERE email='".$email."'";

        $checkResult = $this->getData($checkQuery);

        if ($checkResult == null) {

            $sqlInsert = "INSERT INTO users VALUES (NULL, '".$firstname."', '".$lastname."', '".$email."', '".$password."', '1', NULL, NULL)";
    
            mysqli_query($this->dbConnect, $sqlInsert);
        } else {
            $message = '<div class="alert alert-danger rounded-0 py-1">Email in use, try using another email address</div>';
        }

        return @$message;
    }
    public function addUser() {
        
        
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = "password";
        $password = md5($password);
        $region_id = $_POST['region'];
        $district_id = $_POST['district'];

        if (isset($region_id) && empty($district_id)) {
        
            $sqlInsert = "INSERT INTO users VALUES (NULL, '".$firstname."', '".$lastname."', '".$email."', '".$password."', 2, '".$region_id."', NULL)";
        } else {
            
            $sqlInsert = "INSERT INTO users VALUES (NULL, '".$firstname."', '".$lastname."', '".$email."', '".$password."', 2, '".$region_id."', NULL)";
        }

		mysqli_query($this->dbConnect, $sqlInsert);
    }
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
    public function getUser($email) {

        $sqlQuery = "SELECT * FROM ".$this->userTable." WHERE email='".$email."'";

        return $this->getData($sqlQuery);
    }
    public function getAllUsers() {

        $sqlQuery = "SELECT * FROM ".$this->userTable." WHERE region_id IS NOT NULL OR district_id IS NOT NULL ORDER BY firstname ASC";

        return $this->getData($sqlQuery);
    }
    public function getRegionAdmin($region_id) {

        $sqlQuery = "SELECT * FROM ".$this->userTable." WHERE region_id='".$region_id."'";

        return $this->getData($sqlQuery);
    }
    public function getDistrictAdmin($district_id) {

        $sqlQuery = "SELECT * FROM ".$this->userTable." WHERE district_id='".$district_id."'";

        return $this->getData($sqlQuery);
    }
    public function getAddress($getUrl)
    {

        //URL FOR FILE INCLLUDE IN INDEX PAGE
        switch ($getUrl) {
            case 'request':
                $getUrl = 'request-transfer.php';
                break;
            case 'region-transfers':
                $getUrl = 'region-transfers.php';
                break;
            case 'view_transfer':
                $getUrl = 'view-transfer.php';
                break;
            case 'district-transfers':
                $getUrl = 'district-transfers.php';
                break;
            case 'application':
                 $getUrl = 'application-status.php';
                 break;
            case 'district':
                $getUrl = 'add-district.php';
                break;
            case 'region':
                $getUrl = 'add-region.php';
                break;
            case 'add-user':
                $getUrl = 'add-users.php';
                break;
            default:
                $getUrl = null;
                break;
        }

        return $getUrl;
    }
}

class  Location extends Database
{
    
    public function getRegions()
    {

        $sqlQuery = "SELECT * FROM ".$this->regionTable." ORDER BY region ASC";

        return $this->getData($sqlQuery);
    }
    public function getRegion($region_id)
    {

        $sqlQuery = "SELECT * FROM ".$this->regionTable." WHERE region_id='".$region_id."'";

        return $this->getData($sqlQuery);
    }
    public function getDistricts($region_id)
    {
        
        $query = "SELECT * FROM ".$this->districtTable." WHERE region_id = ".$region_id." ORDER BY district ASC";

        return $this->getData($query);
    }
    public function getAllDistrict() {

        $sqlQuery = "SELECT * FROM ".$this->districtTable." ORDER BY district ASC";

        return $this->getData($sqlQuery);
    }
    public function getDistrict($district_id)
    {

        $sqlQuery = "SELECT * FROM ".$this->districtTable." WHERE district_id='".$district_id."'";

        return $this->getData($sqlQuery);
    }
    public function addRegion() {

        $region = $_POST['region'];
        $region = ucfirst(strtolower($region));

        $sqlInsert = "INSERT INTO ".$this->regionTable." VALUES (NULL, '".$region."' )";

        mysqli_query($this->dbConnect, $sqlInsert);
    }
    public function addDistrict () {

        $region_id = $_POST['region_id'];
        $district = $_POST['district'];
        $district = ucfirst(strtolower($district));


        $sqlInsert = "INSERT INTO ".$this->districtTable." VALUES (NULL, '".$region_id."', '".$district."' )";

        mysqli_query($this->dbConnect, $sqlInsert);
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
        '".$tran_school."', '".$tran_region."', '".$tran_district."', '".$result[0]['id']."', '".$status."' , 1 )";

        mysqli_query($this->dbConnect, $sqlInsert);
        
        $message = '<div class="alert alert-success rounded-0 py-1">Application sent</div>';

        return $message;
    }
    public function getInRegionTransfer($region_id)
    {
        
        $sqlQuery = "SELECT * FROM ".$this->transferTable." WHERE cur_region='".$region_id."'";

        return $this->getData($sqlQuery);
    }
    public function getInRegionTransfers($region_id) {

        $sqlQuery = "SELECT * FROM ".$this->transferTable." WHERE cur_region='".$region_id."' 
        OR tran_region=".$region_id." ORDER BY transfer_id DESC";

        return $this->getData($sqlQuery);
    }
    public function getTransfer($transfer_id)
    {

        $sqlQuery = "SELECT * FROM  ".$this->transferTable." WHERE transfer_id='".$transfer_id."'";

        return $this->getData($sqlQuery);
    }
    public function getDistrictTranfers($district_id)
    {
        
        $sqlQuery = "SELECT * FROM ".$this->transferTable." WHERE cur_district=".$district_id." 
        OR tran_district=".$district_id." ORDER BY transfer_id DESC";

        return $this->getData($sqlQuery);
    }
    public function getParentsTransfer($parent_id) {

        $sqlQuery = "SELECT * FROM ".$this->transferTable." WHERE parent_id=".$parent_id."";
        
        return $this->getData($sqlQuery);
    }
    public function updateTransfer($transfer_id, $role)
    {
        
        $description = $_POST['description'];
        $choice = $_POST['choice'];
        $tran_level = $_POST['tran_level'];
        $status = $_POST['status'];

        if ($choice == 'reject') {

            $tran_level = 0;
            $sqlInsert = " UPDATE transfers SET tran_level='".$tran_level."', description='".$description."', set_by='".$_SESSION['email']."'
            WHERE transfer_id='".$transfer_id."'";
        } elseif ($choice == 'accept' && $status == 1) {

            switch ($role) {
                case 'district':
                    $tran_level = $tran_level + 1;
                    break;
                case 'region':
                    $tran_level = $tran_level + 2;
                    break;
            }
            $sqlInsert = "UPDATE transfers SET tran_level='".$tran_level."' WHERE transfer_id='".$transfer_id."'";
        } elseif ($choice == 'accept' && $status == 2) {

            $tran_level + 4;
            $sqlInsert = "UPDATE transfers SET tran_level='".$tran_level."' WHERE transfer_id='".$transfer_id."'";
        } elseif ($choice == 'accept' && $status == 3) {
            
            $tran_level = $tran_level + 1;
            $sqlInsert = "UPDATE transfers SET tran_level='".$tran_level."' WHERE transfer_id='".$transfer_id."'";
        }

    mysqli_query($this->dbConnect, $sqlInsert);
    }
} 