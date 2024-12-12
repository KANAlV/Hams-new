<?php 
//start session
session_start();
//check if logged in
include "../dbcon.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    abstract class delEquipEssentials {
        protected $id;
        protected $name;
        protected $manufacturer;
        abstract function id();
        abstract function name();
        abstract function manufacturer();
    }

    class delEquipSetter extends delEquipEssentials {
        function id() {
            $this->id = $_POST["id"] ?? null;
        }
        function name() {
            $this->name = $_POST["name"] ?? null;
        }
        function manufacturer() {
            $this->manufacturer = $_POST["manufacturer"] ?? null;
        }
        public function exportState() { return get_object_vars($this); }
    }

    class delEquipGetter extends delEquipSetter {
        function id() {
            return $this->id;
        }
        function name() {
            return $this->name;
        }
        function manufacturer() {
            return $this->manufacturer;
        }
        public function importState($state) {
            foreach ($state as $key => $value) {
                $this->$key = $value;
            }
        }
    }
    $delEquipMutator = new delEquipSetter;
    $delEquipMutator->id();
    $delEquipMutator->name();
    $delEquipMutator->manufacturer();
    $delEquipAccessor = new delEquipGetter;
    $delEquipAccessor->importState($delEquipMutator->exportState());
    $delID = $delEquipAccessor->id();
    $name = $delEquipAccessor->name();
    $manufacturer = $delEquipAccessor->manufacturer();
    $operation = "rmv";
    $req_by = $_SESSION['usr'];
    $table_name = "equipments";

    // get med details
    $uidSql1 = "SELECT * FROM `equipments` WHERE equip_id = '$delID'";
    $uidResult1 = mysqli_query($conn, $uidSql1);
    if (mysqli_num_rows($uidResult1) > 0) {
        $uidRow1 = mysqli_fetch_assoc($uidResult1);
        $sql = "INSERT INTO requests (qty, description, manufacturer, expiry, type, req_by, table_name, operation, rmv_id, uid) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssss", $uidRow1["stock"], $uidRow1["name"], $uidRow1["manufacturer"], $uidRow1["expiry"], $uidRow1["type"], $req_by, $table_name, $operation, $uidRow1["equip_id"], $uidRow1["uid"]);
        if ($stmt->execute()) {
            echo "
                <form id='myForm' action='data.php' method='POST'>
                    <input type='text' name='name' value='{$uidRow1["name"]}' hidden readonly/>
                    <input type='text' name='manufacturer' value='{$uidRow1["manufacturer"]}' hidden readonly/>
                    <input type='text' name='discarded' value='{$_POST["discarded"]}' hidden readonly/>
                </form>
            ";
        }
    }
}
?>
<script>
    window.onload = function() {
        setTimeout(function() {
            document.getElementById("myForm").submit();
        }, 0);
    };
</script>