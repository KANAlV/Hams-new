<?php 
//start session
session_start();
//check if logged in
include "../dbcon.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    abstract class jayke{
        protected $req_id;
        protected $req_by;
        protected $qty;
        protected $desc;
        protected $manu;
        protected $type;
        protected $table_name;
        protected $expiry;
        protected $op;
        protected $aprvd = 1;
        protected $date_aprvd;
        protected $date_added;
        abstract function magic($var);
    }
    class aprvlSetter extends jayke {
        function magic($var){
            $conn = $var;
            $this->req_id = $_POST["req_id"] ?? null;
            
            $sql0 = "SELECT * FROM `requests` WHERE `req_id` = '{$this->req_id}'";
            $result0 = mysqli_query($conn, $sql0);
            if (mysqli_num_rows($result0) > 0) {
                while ($row = mysqli_fetch_assoc($result0)) {
                    $this->qty = $row['qty'];
                    $this->desc = $row['description'];
                    $this->manu = $row['manufacturer'];
                    $this->type = $row['type'];
                    $this->table_name = $row['table_name'];
                    $this->expiry = $row['expiry'];
                    $this->op = $row['operation'];
                    $this->date_aprvd = $row['date_approved'];
                    $this->req_by = $row['req_by'];
                    $this->date_added = $row['date_added'];
                }
            }
        }
        public function exportState() { return get_object_vars($this); }
    }
    class aprvlGetter extends aprvlSetter{
        function magic($var){
            if ($var == "req_id"){return $this->req_id;}
            if ($var == "qty"){return $this->qty;}
            if ($var == "desc"){return $this->desc;}
            if ($var == "manu"){return $this->manu;}
            if ($var == "type"){return $this->type;}
            if ($var == "table_name"){return $this->table_name;}
            if ($var == "expiry"){return $this->expiry;}
            if ($var == "op"){return $this->op;}
            if ($var == "aprvd"){return $this->aprvd;}
            if ($var == "date_aprvd"){return $this->date_aprvd;}
            if ($var == "req_by"){return $this->req_by;}
            if ($var == "date_added"){return $this->date_added;}
        }
        public function importState($state) {
            foreach ($state as $key => $value) {
                $this->$key = $value;
            }
        }
    }

    $setter = new aprvlSetter;
    $setter->magic($conn);
    $getter = new aprvlGetter;
    $getter->importState($setter->exportState());
    $id = $getter->magic("req_id");
    $qty = $getter->magic("qty");
    $dsc = $getter->magic("desc");
    $man = $getter->magic("manu");
    $typ = $getter->magic("type");
    $tbl = $getter->magic("table_name");
    $exp = $getter->magic("expiry");
    $ope = $getter->magic("op");
    $apd = $getter->magic("aprvd");
    $dtaprvd = $getter->magic("date_aprvd");
    $req_by = $getter->magic("req_by");
    $date_added = $getter->magic("date_added");

    if($tbl == "medicine"){
        if ($ope == "+") {
            $sql = "INSERT INTO medicine (stock, name, manufacturer, type, expiry, addedBy) 
                    VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssss", $qty, $dsc, $man, $typ, $exp, $_SESSION["usr"]);
            if ($stmt->execute()) {
                header("Location: ../medicine.php");
                exit();
            }
        }
    }// above medicine below ...

    $sql1 = "UPDATE requests SET approved = ?, approved_by = '{$_SESSION['usr']}', date_approved = now()  WHERE req_id = ?";
    $stmt1 = $conn->prepare($sql1);
    if (!$stmt1) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }
    $stmt1->bind_param("ii", $apd, $id);
    if ($stmt1->execute()) {
        echo "
            <form id='myForm' action='items.php' method='POST'>
                <input type='text' name='show' value='pending' hidden readonly/>
                <input type='text' name='req_by' value='{$req_by}' hidden readonly/>
                <input type='text' name='date_added' value='{$date_added}' hidden readonly/>
            </form>
        ";
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