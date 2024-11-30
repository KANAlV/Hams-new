<?php 
//start session
session_start();
//check if logged in
include "../dbcon.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    abstract class medEssentials {
        protected $amount;
        protected $name;
        protected $manufacturer;
        protected $type = [];
        protected $expiry;

        abstract function amount();
        abstract function name();
        abstract function manufacturer();
        abstract function type();
        abstract function expiry();
    }

    class medSetter extends medEssentials {
        function amount() {
            $this->amount = $_POST["amount"] ?? null;
        }
        function name() {
            $this->name = $_POST["name"] ?? null;
        }
        function manufacturer() {
            $this->manufacturer = $_POST["manufacturer"] ?? null;
        }
        function expiry() {
            $date = new DateTime($_POST["expiry"]);
            $this->expiry = $date->format('m/d/Y');
        }
        function type() {
            for ($x = 1; $x <= 47; $x++) {
                $posttest = $_POST["CB$x"] ?? null;
                if ($posttest !== null) {
                    $this->type[] = htmlspecialchars($posttest); // Sanitize inputs
                }
            }
        }
        public function exportState() { return get_object_vars($this); }
    }

    class medGetter extends medSetter {
        function amount() {
            return $this->amount;
        }
        function name() {
            return $this->name;
        }
        function manufacturer() {
            return $this->manufacturer;
        }
        function expiry() {
            return $this->expiry;
        }
        function type() {
            return implode(" / ", $this->type); // Return a comma-separated string
        }
        public function importState($state) {
            foreach ($state as $key => $value) {
                $this->$key = $value;
            }
        }
    }

    $medMutator = new medSetter;
    $medMutator->amount();
    $medMutator->name();
    $medMutator->manufacturer();
    $medMutator->type();
    $medMutator->expiry();

    $medAccessor = new medGetter;
    $medAccessor->importState($medMutator->exportState());
    $amount = $medAccessor->amount();
    $name = $medAccessor->name();
    $manufacturer = $medAccessor->manufacturer();
    $type = $medAccessor->type();
    $expiry = $medAccessor->expiry();

    // Check if the medicine already exists
    $uidSql1 = "SELECT * FROM `medicine` WHERE name = '$name' AND manufacturer = '$manufacturer'";
    $uidResult1 = mysqli_query($conn, $uidSql1);
    if (mysqli_num_rows($uidResult1) > 0) {
        $uidRow1 = mysqli_fetch_assoc($uidResult1);
        $sql = "INSERT INTO requests (qty, description, manufacturer, expiry, type, req_by, table_name, operation) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssss", $amount, $name, $manufacturer, $expiry, $uidRow1["type"], $_SESSION["usr"], "medicine", "+");
        if ($stmt->execute()) {
            header("Location: ../medicine.php");
            exit();
        }
    } else {
        $sql = "INSERT INTO requests (qty, description, manufacturer, type, expiry, req_by, table_name, operation) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssss", $amount, $name, $manufacturer, $type, $expiry, $_SESSION["usr"], "medicine", "+");
        if ($stmt->execute()) {
            header("Location: ../medicine.php");
            exit();
        }
    }
}
?>