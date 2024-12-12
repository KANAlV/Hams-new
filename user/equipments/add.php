<?php 
//start session
session_start();
//check if logged in
include "../dbcon.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    abstract class equipEssentials {
        protected $amount;
        protected $name;
        protected $manufacturer;
        protected $type = [];
        protected $expiry;
        protected $uid;

        abstract function amount();
        abstract function name();
        abstract function manufacturer();
        abstract function type();
        abstract function expiry();
        abstract function uid();
    }

    class equipSetter extends equipEssentials {
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
            $this->uid = $_POST["uid"] ?? "unassinged";
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

    class equipGetter extends equipSetter {
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

    $equipMutator = new equipSetter;
    $equipMutator->amount();
    $equipMutator->name();
    $equipMutator->manufacturer();
    $equipMutator->type();
    $equipMutator->expiry();
    $equipMutator->uid();

    $equipAccessor = new equipGetter;
    $equipAccessor->importState($equipMutator->exportState());
    $amount = $equipAccessor->amount();
    $name = $equipAccessor->name();
    $manufacturer = $equipAccessor->manufacturer();
    $type = $equipAccessor->type();
    $expiry = $equipAccessor->expiry();
    $uid = $equipAccessor->uid();

    $req_by = $_SESSION["usr"];
    $table_name = "equipments";
    $operation = "+";

    // Check if the medicine already exists
    $uidSql1 = "SELECT * FROM `equipments` WHERE name = '$name' AND manufacturer = '$manufacturer'";
    $uidResult1 = mysqli_query($conn, $uidSql1);
    if (mysqli_num_rows($uidResult1) > 0) {
        $uidRow1 = mysqli_fetch_assoc($uidResult1);
        $sql = "INSERT INTO requests (qty, description, manufacturer, expiry, type, req_by, table_name, operation, uid) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssss", $amount, $name, $manufacturer, $expiry, $uidRow1["type"], $req_by, $table_name, $operation, $uidRow1["uid"]);
        if ($stmt->execute()) {
            $discard = $_POST["discarded"] ?? 0;
            echo "
                <form id='myForm' action='../equipments.php' method='POST'>
                    <input type='text' name='name' value='$name' hidden readonly/>
                    <input type='text' name='manufacturer' value='$manufacturer' hidden readonly/>
                    <input type='text' name='discarded' value='$discard' hidden readonly/>
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
            $uidSql2 = "SELECT * FROM `uid` WHERE uid = '$uid' AND assigned IS NOT NULL";
            $uidResult2 = mysqli_query($conn, $uidSql2);
            if (mysqli_num_rows($uidResult2) > 0) {
                while ($uidRow2 = mysqli_fetch_assoc($uidResult2)) {
                    echo "UID is Already Used By {$uidRow2['assigned']}. <a href='../equipments.php'>return</a>";
                    exit();
                }
            } else {
                //update in uid table
                $sql1 = "UPDATE `uid` SET assigned = ?, `table_name` = 'equipments' WHERE `uid` = ?";
                $stmt1 = $conn->prepare($sql1);
                if (!$stmt1) {
                    die('Prepare failed: ' . htmlspecialchars($conn->error));
                }
                $stmt1->bind_param("ss", $name, $uid);
                if ($stmt1->execute()){
                    $discard = $_POST["discarded"] ?? 0;
                    echo "
                        <form id='myForm' action='../equipments.php' method='POST'>
                            <input type='text' name='name' value='$name' hidden readonly/>
                            <input type='text' name='manufacturer' value='$manufacturer' hidden readonly/>
                            <input type='text' name='discarded' value='$discard' hidden readonly/>
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