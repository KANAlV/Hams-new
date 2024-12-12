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
        protected $uid;
        protected $expiry;

        abstract function amount();
        abstract function name();
        abstract function manufacturer();
        abstract function type();
        abstract function uid();
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
        function uid() {
            $this->uid = $_POST["uid"] ?? null;
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
        function uid() {
            return $this->uid;
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
    $medMutator->uid();

    $medAccessor = new medGetter;
    $medAccessor->importState($medMutator->exportState());
    $amount = $medAccessor->amount();
    $name = $medAccessor->name();
    $manufacturer = $medAccessor->manufacturer();
    $type = $medAccessor->type();
    $expiry = $medAccessor->expiry();
    $uid = $medAccessor->uid();

    $req_by = $_SESSION["usr"];
    $table_name = "medicine";
    $operation = "+";

    // Check if the medicine already exists
    $uidSql1 = "SELECT * FROM `medicine` WHERE name = '$name' AND manufacturer = '$manufacturer'";
    $uidResult1 = mysqli_query($conn, $uidSql1);
    if (mysqli_num_rows($uidResult1) > 0) {
        $uidRow1 = mysqli_fetch_assoc($uidResult1);
        $sql = "INSERT INTO requests (qty, description, manufacturer, expiry, type, req_by, table_name, operation, uid) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssss", $amount, $name, $manufacturer, $expiry, $uidRow1["type"], $req_by, $table_name, $operation, $uidRow1["uid"]);
        if ($stmt->execute()){
            echo "
                <form id='myForm' action='../medicine.php' method='POST'>
                    <input type='text' name='name' value='$name' hidden readonly/>
                    <input type='text' name='manufacturer' value='$manufacturer' hidden readonly/>
                </form>
            ";
        }
    } else {
        $sql = "INSERT INTO requests (qty, description, manufacturer, type, expiry, req_by, table_name, operation, uid) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssss", $amount, $name, $manufacturer, $type, $expiry, $req_by, $table_name, $operation, $uid);
        if ($stmt->execute()){
            //reserve uid
            $uidSql2 = "SELECT * FROM `uid` WHERE uid = $uid AND assigned IS NOT NULL";
            $uidResult2 = mysqli_query($conn, $uidSql2);
            if (mysqli_num_rows($uidResult2) > 0) {
                while ($uidRow2 = mysqli_fetch_assoc($uidResult2)) {
                    echo "UID is Already Used By {$uidRow2['assigned']}. <a href='/Hams/bed'>return</a>";
                    exit();
                }
            } else {
                //update in uid table
                $sql1 = "UPDATE `uid` SET assigned = ?, `table_name` = 'medicine' WHERE `uid` = ?";
                $stmt1 = $conn->prepare($sql1);
                if (!$stmt1) {
                    die('Prepare failed: ' . htmlspecialchars($conn->error));
                }
                $stmt1->bind_param("ss", $name, $uid);
                if ($stmt1->execute()){
                    echo "
                        <form id='myForm' action='../medicine.php' method='POST'>
                            <input type='text' name='name' value='$name' hidden readonly/>
                            <input type='text' name='manufacturer' value='$manufacturer' hidden readonly/>
                        </form>
                    ";
                }
            }
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