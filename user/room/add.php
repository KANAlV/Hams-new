<?php 
//start session
session_start();
//check if logged in
include "../dbcon.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    abstract class jayke{
        protected $no;
        protected $uid;
        protected $type;
        abstract function magic($var);
    }
    class bedSetter extends jayke {
        function magic($var){
            $this->req_id = $_POST["no"] ?? null;
            $this->uid = $_POST["uid"] ?? null;
            $this->type = $_POST["type"] ?? null;
        }
        public function exportState() { return get_object_vars($this); }
    }
    class bedGetter extends bedSetter{
        function magic($var){
            if ($var == "uid"){return $this->uid;}
            if ($var == "no"){return $this->req_id;}
            if ($var == "type"){return $this->type;}
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
    $room = $getter->magic("no");
    $req_by = $_SESSION["usr"];
    $table_name = "room";
    $operation = "+";

    $Sql0 = "SELECT * FROM `room` WHERE `room` = '$room'";
    $Result0 = mysqli_query($conn, $Sql0);
    if (mysqli_num_rows($Result0) > 0) {
        echo"Room No. is Already Used! <a href='../rooms.php'>return</a>";
        exit;
    } else {
        $sql = "INSERT INTO requests (description,  req_by, table_name, operation, uid, type) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $room, $req_by, $table_name, $operation, $uid, $type);
        if ($stmt->execute()){
            //update in uid table
            header("Location: ../rooms.php");
        }
    }
}
?>