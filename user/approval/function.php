<?php 
//start session
session_start();
//check if logged in
include "../dbcon.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    abstract class jayke{
        protected $uid;
        protected $req_id;
        protected $rmv_id;
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
                    $this->uid = $row['uid'];
                    $this->qty = $row['qty'];
                    $this->desc = $row['description'];
                    $this->manu = $row['manufacturer'];
                    $this->type = $row['type'];
                    $this->table_name = $row['table_name'];
                    $this->expiry = $row['expiry'];
                    $this->rmv_id = $row['rmv_id'];
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
            if ($var == "uid"){return $this->uid;}
            if ($var == "req_id"){return $this->req_id;}
            if ($var == "qty"){return $this->qty;}
            if ($var == "desc"){return $this->desc;}
            if ($var == "manu"){return $this->manu;}
            if ($var == "type"){return $this->type;}
            if ($var == "table_name"){return $this->table_name;}
            if ($var == "expiry"){return $this->expiry;}
            if ($var == "op"){return $this->op;}
            if ($var == "aprvd"){return $this->aprvd;}
            if ($var == "rmv_id"){return $this->rmv_id;}
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
    $uid = $getter->magic("uid");
    $id = $getter->magic("req_id");
    $qty = $getter->magic("qty");
    $dsc = $getter->magic("desc");
    $man = $getter->magic("manu");
    $typ = $getter->magic("type");
    $tbl = $getter->magic("table_name");
    $exp = $getter->magic("expiry");
    $ope = $getter->magic("op");
    $apd = $getter->magic("aprvd");
    $rmv_id = $getter->magic("rmv_id");
    $dtaprvd = $getter->magic("date_aprvd");
    $req_by = $getter->magic("req_by");
    $date_added = $getter->magic("date_added");

    if($tbl == "medicine"){
        if ($ope == "-") {
            $sql = "SELECT * FROM `medicine` WHERE
                        `discarded` = 0 AND
                        `name` = '$dsc'
                    ORDER BY `expiry` ASC LIMIT 1";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $newStock = $row['stock'] - $qty;
                $sql1 = "UPDATE medicine SET stock = ? WHERE name = ?";
                $stmt1 = $conn->prepare($sql1);
                $stmt1->bind_param("ss", $newStock, $dsc);
                if ($stmt1->execute()) {
                    $sql2 = "UPDATE requests SET approved = ?, approved_by = ?, date_approved = now()  WHERE req_id = ?";
                    $stmt2 = $conn->prepare($sql2);
                    if (!$stmt2) {
                        die('Prepare failed: ' . htmlspecialchars($conn->error));
                    }
                    $apd = 1;
                    $stmt2->bind_param("isi", $apd, $_SESSION['usr'], $id);
                    if ($stmt2->execute()) {
                        echo "
                            <form id='myForm' action='items.php' method='POST'>
                                <input type='text' name='show' value='pending' hidden readonly/>
                                <input type='text' name='req_by' value='{$req_by}' hidden readonly/>
                                <input type='text' name='date_added' value='{$date_added}' hidden readonly/>
                            </form>
                        ";
                    }
                }
            }
        }
        if ($ope == "+") {
            $sql = "INSERT INTO medicine (stock, name, manufacturer, type, expiry, addedBy, uid) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssss", $qty, $dsc, $man, $typ, $exp, $_SESSION["usr"], $uid);
            if ($stmt->execute()) {
                $sql1 = "UPDATE requests SET approved = ?, approved_by = ?, date_approved = now()  WHERE req_id = ?";
                $stmt1 = $conn->prepare($sql1);
                if (!$stmt1) {
                    die('Prepare failed: ' . htmlspecialchars($conn->error));
                }
                $apd = 1;
                $stmt1->bind_param("isi", $apd, $_SESSION['usr'], $id);
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
        } if ($ope == "rmv") {
            $val0 = 1;
            $sql = "UPDATE medicine SET discarded = ? WHERE med_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $val0, $rmv_id);
            if ($stmt->execute()) {
                $sql1 = "UPDATE requests SET approved = ?, approved_by = ?, date_approved = now() WHERE req_id = ?";
                $stmt1 = $conn->prepare($sql1);
                if (!$stmt1) {
                    die('Prepare failed: ' . htmlspecialchars($conn->error));
                }
                $apd = 1;
                $stmt1->bind_param("isi", $apd, $_SESSION['usr'], $id);
                if ($stmt1->execute()) {
                    $stockChk = "SELECT * FROM `medicine` WHERE `discarded` = 0 AND `name` = '$dsc' AND `manufacturer` = '$man'";
                    $stockResult = mysqli_query($conn, $stockChk);
                    if (mysqli_num_rows($stockResult) == 0) {
                        // Update in uid table
                        $sql1 = "UPDATE `uid` SET `assigned` = null, `table_name` = null WHERE `uid` = ?";
                        $stmt1 = $conn->prepare($sql1);
                        if (!$stmt1) {
                            die('Prepare failed: ' . htmlspecialchars($conn->error));
                        }
                        $stmt1->bind_param("s", $uid);
                        if ($stmt1->execute()) {
                            echo "
                                <form id='myForm' action='items.php' method='POST'>
                                    <input type='text' name='show' value='pending' hidden readonly/>
                                    <input type='text' name='req_by' value='{$req_by}' hidden readonly/>
                                    <input type='text' name='date_added' value='{$date_added}' hidden readonly/>
                                </form>
                            ";
                        }
                    } else {
                        echo "
                            <form id='myForm' action='items.php' method='POST'>
                                <input type='text' name='show' value='pending' hidden readonly/>
                                <input type='text' name='req_by' value='{$req_by}' hidden readonly/>
                                <input type='text' name='date_added' value='{$date_added}' hidden readonly/>
                            </form>
                        ";
                    }
                }
            }
        }
    }

    // medicine above / equipments below //

    if($tbl == "equipments"){
        if ($ope == "-") {
            $sql = "SELECT * FROM `equipments` WHERE
                        `discarded` = 0 AND
                        `name` = '$dsc'
                    ORDER BY `expiry` ASC LIMIT 1";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $newStock = $row['stock'] - $qty;
                $sql1 = "UPDATE equipments SET stock = ? WHERE name = ?";
                $stmt1 = $conn->prepare($sql1);
                $stmt1->bind_param("ss", $newStock, $dsc);
                if ($stmt1->execute()) {
                    $sql2 = "UPDATE requests SET approved = ?, approved_by = ?, date_approved = now()  WHERE req_id = ?";
                    $stmt2 = $conn->prepare($sql2);
                    if (!$stmt2) {
                        die('Prepare failed: ' . htmlspecialchars($conn->error));
                    }
                    $apd = 1;
                    $stmt2->bind_param("isi", $apd, $_SESSION['usr'], $id);
                    if ($stmt2->execute()) {
                        echo "
                            <form id='myForm' action='items.php' method='POST'>
                                <input type='text' name='show' value='pending' hidden readonly/>
                                <input type='text' name='req_by' value='{$req_by}' hidden readonly/>
                                <input type='text' name='date_added' value='{$date_added}' hidden readonly/>
                            </form>
                        ";
                    }
                }
            }
        }
        if ($ope == "+") {
            $sql = "INSERT INTO equipments (stock, name, manufacturer, type, expiry, addedBy, uid) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssss", $qty, $dsc, $man, $typ, $exp, $_SESSION["usr"], $uid);
            if ($stmt->execute()) {
                $sql1 = "UPDATE requests SET approved = ?, approved_by = ?, date_approved = now()  WHERE req_id = ?";
                $stmt1 = $conn->prepare($sql1);
                if (!$stmt1) {
                    die('Prepare failed: ' . htmlspecialchars($conn->error));
                }
                $apd = 1;
                $stmt1->bind_param("isi", $apd, $_SESSION['usr'], $id);
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
        } if ($ope == "rmv") {
            $val0 = 1;
            $sql = "UPDATE equipments SET discarded = ? WHERE equip_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $val0, $rmv_id);
            if ($stmt->execute()) {
                $sql1 = "UPDATE requests SET approved = ?, approved_by = ?, date_approved = now()  WHERE req_id = ?";
                $stmt1 = $conn->prepare($sql1);
                if (!$stmt1) {
                    die('Prepare failed: ' . htmlspecialchars($conn->error));
                }
                $apd = 1;
                $stmt1->bind_param("isi", $apd, $_SESSION['usr'], $id);
                if ($stmt1->execute()) {
                    $stockChk = "SELECT * FROM `equipments` WHERE `discarded` = 0 AND `name` = '$dsc' AND `manufacturer` = '$man'";
                    $stockResult = mysqli_query($conn, $stockChk);
                    if (mysqli_num_rows($stockResult) == 0) {
                        // Update in uid table
                        $sql1 = "UPDATE `uid` SET `assigned` = null, `table_name` = null WHERE `uid` = ?";
                        $stmt1 = $conn->prepare($sql1);
                        if (!$stmt1) {
                            die('Prepare failed: ' . htmlspecialchars($conn->error));
                        }
                        $stmt1->bind_param("s", $uid);
                        if ($stmt1->execute()) {
                            echo "
                                <form id='myForm' action='items.php' method='POST'>
                                    <input type='text' name='show' value='pending' hidden readonly/>
                                    <input type='text' name='req_by' value='{$req_by}' hidden readonly/>
                                    <input type='text' name='date_added' value='{$date_added}' hidden readonly/>
                                </form>
                            ";
                        }
                    } else {
                        echo "
                            <form id='myForm' action='items.php' method='POST'>
                                <input type='text' name='show' value='pending' hidden readonly/>
                                <input type='text' name='req_by' value='{$req_by}' hidden readonly/>
                                <input type='text' name='date_added' value='{$date_added}' hidden readonly/>
                            </form>
                        ";
                    }
                }
            }
        }
    }
    // equipments above / bed below //
    if($tbl == "beds"){
        if ($ope == "+") {
            $sql = "INSERT INTO bed (no, addedBy, uid) 
                    VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $dsc, $_SESSION["usr"], $uid);
            if ($stmt->execute()) {
                $sql1 = "UPDATE requests SET approved = ?, approved_by = ?, date_approved = now()  WHERE req_id = ?";
                $stmt1 = $conn->prepare($sql1);
                if (!$stmt1) {
                    die('Prepare failed: ' . htmlspecialchars($conn->error));
                }
                $apd = 1;
                $stmt1->bind_param("isi", $apd, $_SESSION['usr'], $id);
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
        }
        if ($ope == "rmv") {
            $val0 = 1;
            $sql = "UPDATE bed SET discarded = ? WHERE bed_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $val0, $rmv_id);
            if ($stmt->execute()) {
                $sql1 = "UPDATE requests SET approved = ?, approved_by = ?, date_approved = now()  WHERE req_id = ?";
                $stmt1 = $conn->prepare($sql1);
                if (!$stmt1) {
                    die('Prepare failed: ' . htmlspecialchars($conn->error));
                }
                $apd = 1;
                $stmt1->bind_param("isi", $apd, $_SESSION['usr'], $id);
                if ($stmt1->execute()) {
                    $stockChk = "SELECT * FROM `bed` WHERE `discarded` = 0 AND `no` = '$dsc'";
                    $stockResult = mysqli_query($conn, $stockChk);
                    if (mysqli_num_rows($stockResult) == 0) {
                        // Update in uid table
                        $sql1 = "UPDATE `uid` SET `assigned` = null, `table_name` = null WHERE `uid` = ?";
                        $stmt1 = $conn->prepare($sql1);
                        if (!$stmt1) {
                            die('Prepare failed: ' . htmlspecialchars($conn->error));
                        }
                        $stmt1->bind_param("s", $uid);
                        if ($stmt1->execute()) {
                            echo "
                                <form id='myForm' action='items.php' method='POST'>
                                    <input type='text' name='show' value='pending' hidden readonly/>
                                    <input type='text' name='req_by' value='{$req_by}' hidden readonly/>
                                    <input type='text' name='date_added' value='{$date_added}' hidden readonly/>
                                </form>
                            ";
                        }
                    } else {
                        echo "
                            <form id='myForm' action='items.php' method='POST'>
                                <input type='text' name='show' value='pending' hidden readonly/>
                                <input type='text' name='req_by' value='{$req_by}' hidden readonly/>
                                <input type='text' name='date_added' value='{$date_added}' hidden readonly/>
                            </form>
                        ";
                    }
                }
            }
        }
        if ($ope == "edit") {
            $Sql0 = "SELECT * FROM `bed` WHERE `no` = '$dsc'";
            $Result0 = mysqli_query($conn, $Sql0);
            if (mysqli_num_rows($Result0) > 0) {
                $data = mysqli_fetch_assoc($Result0);
                $dataUID = $data['uid'];
                $sql1 = "UPDATE `uid` SET `assigned` = null, `table_name` = null WHERE `uid` = ?";
                $stmt1 = $conn->prepare($sql1);
                if (!$stmt1) {
                    die('Prepare failed: ' . htmlspecialchars($conn->error));
                }
                $stmt1->bind_param("s", $dataUID);
                if ($stmt1->execute()) {
                    $sql4 = "UPDATE `uid` SET `assigned` = '$dsc', `table_name` = 'beds' WHERE `uid` = ?";
                    $stmt4 = $conn->prepare($sql4);
                    if (!$stmt4) {
                        die('Prepare failed: ' . htmlspecialchars($conn->error));
                    }
                    $stmt4->bind_param("s", $uid);
                    if ($stmt4->execute()) {
                        $sql2 = "UPDATE `bed` SET `uid` = ? WHERE `bed_id` = '$rmv_id'";
                        $stmt2 = $conn->prepare($sql2);
                        if (!$stmt2) {
                            die('Prepare failed: ' . htmlspecialchars($conn->error));
                        }
                        $stmt2->bind_param("s", $uid);
                        if ($stmt2->execute()) {
                            $sql3 = "UPDATE requests SET approved = ?, approved_by = ?, date_approved = now()  WHERE req_id = ?";
                            $stmt3 = $conn->prepare($sql3);
                            if (!$stmt3) {
                                die('Prepare failed: ' . htmlspecialchars($conn->error));
                            }
                            $apd = 1;
                            $stmt3->bind_param("isi", $apd, $_SESSION['usr'], $id);
                            if ($stmt3->execute()) {
                                echo "
                                    <form id='myForm' action='items.php' method='POST'>
                                        <input type='text' name='show' value='pending' hidden readonly/>
                                        <input type='text' name='req_by' value='{$req_by}' hidden readonly/>
                                        <input type='text' name='date_added' value='{$date_added}' hidden readonly/>
                                    </form>
                                ";
                            }
                        }
                    }
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