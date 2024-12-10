<?php 
//start session
session_start();
//check if logged in
include "../dbcon.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    abstract class typeEssentials {
        protected $type;
        protected $table;
    }

    class typeSetter extends typeEssentials {
        function type() {
            $this->type = $_POST["type"] ?? null;
        }
        function table() {
            $this->table = $_POST["table"] ?? null;
        }
        public function exportState() { return get_object_vars($this); }
    }

    class typeGetter extends typeSetter {
        function type() {
            return $this->type;
        }
        function table() {
            return $this->table;
        }
        public function importState($state) {
            foreach ($state as $key => $value) {
                $this->$key = $value;
            }
        }
    }

    $typeMutator = new typeSetter;
    $typeMutator->type();
    $typeMutator->table();

    $typeAccessor = new typeGetter;
    $typeAccessor->importState($typeMutator->exportState());
    $type = $typeAccessor->type();
    $table = $typeAccessor->table();

    // Check if the medicine already exists
    $uidSql1 = "SELECT * FROM `types` WHERE type = '$type'";
    $uidResult1 = mysqli_query($conn, $uidSql1);
    if (mysqli_num_rows($uidResult1) > 0) {
        echo"Entry is already in the Database! <a href='../types.php'>go back?</a>";
    } else {
        $sql = "INSERT INTO types (table, type, addedBy) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss",$table, $type, $_SESSION["usr"]);
        if ($stmt->execute()) {
            header("location: ../types.php");
        }
    }
}?>