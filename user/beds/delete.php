<?php
//start session
session_start();
//check if logged in
include "../dbcon.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    abstract class jayke{
        protected $bed_id;
        abstract function magic($var);
    }
    class bedSetter extends jayke {
        function magic($var){
            $this->bed_id = $_POST["bed_id"] ?? null;
        }
        public function exportState() { return get_object_vars($this); }
    }
    class bedGetter extends bedSetter{
        function magic($var){
            if ($var == "bed_id"){return $this->bed_id;}
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
    $bed_id = $getter->magic("bed_id");
    $req_by = $_SESSION["usr"];
    $table_name = "beds";
    $operation = "rmv";

    $uidSql1 = "SELECT * FROM `bed` WHERE bed_id = '$bed_id'";
    $uidResult1 = mysqli_query($conn, $uidSql1);
    if (mysqli_num_rows($uidResult1) > 0) {
        $uidRow1 = mysqli_fetch_assoc($uidResult1);
        $sql = "INSERT INTO requests (description,  req_by, table_name, operation, rmv_id, uid) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $uidRow1['no'], $req_by, $table_name, $operation, $bed_id, $uidRow1['uid']);
        if ($stmt->execute()) {
            header("Location: ../beds.php");
        }
    }
}
?>