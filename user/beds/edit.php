<?php 
//start session
session_start();
//check if logged in
include "../dbcon.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    abstract class jayke{
        protected $no;
        protected $uid;
        abstract function magic($var);
    }
    class bedSetter extends jayke {
        function magic($var){
            $this->req_id = $_POST["no"] ?? null;
            $this->uid = $_POST["uid"] ?? null;
        }
        public function exportState() { return get_object_vars($this); }
    }
    class bedGetter extends bedSetter{
        function magic($var){
            if ($var == "uid"){return $this->uid;}
            if ($var == "no"){return $this->req_id;}
        }
        public function importState($state) {
            foreach ($state as $key => $value) {
                $this->$key = $value;
            }
        }
    }

    $setter = new bedSetter;
    $setter->magic($conn);
    $getter = new bedGetter;
    $getter->importState($setter->exportState());
    $uid = $getter->magic("uid");
    $no = $getter->magic("no");
    $req_by = $_SESSION["usr"];
    $table_name = "beds";
    $operation = "edit";

    $Sql0 = "SELECT * FROM `bed` WHERE `no` = '$no'";
    $Result0 = mysqli_query($conn, $Sql0);
    if (mysqli_num_rows($Result0) < 0) {
        echo"No such item Exists! <a href='../beds.php'>return</a>";
        exit;
    } else {
        $data = mysqli_fetch_assoc($Result0);
        $sql = "INSERT INTO requests (description,  req_by, table_name, operation, rmv_id, uid) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $data['no'], $req_by, $table_name, $operation, $data['bed_id'], $uid);
        if ($stmt->execute()){
            header("Location: ../beds.php");
        }
    }
}
?>