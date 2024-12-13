<?php
    include "../dbcon.php";
    session_start();
    if (!isset($_SESSION['acc_id'])) {
        header("location: ../home.php");
    }

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    class toolsMed {
        private $arrayCount;
        //setter
            public function setCount($var) {$this->arrayCount = $var;}
        //getter
            public function getCount() {return $this->arrayCount;}
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($_POST["sendType"] == "tools-medicine") {//
            $OOP = new toolsMed();
            $cnt = $_POST['cnt'];
            $OOP->setCount($cnt);
            $Item = array();
            $Qty = array();
            for ($x = 0; $x <= $cnt; $x++){
                array_push($Item, $_POST[$x]);
                array_push($Qty, $_POST["qty{$x}"]);
            }

            for ($x = 0; $x <= $cnt; $x++){
                $uidSql = "SELECT * FROM `uid` WHERE `uid` = {$Item[$x]}";
                $uidResult = mysqli_query($conn, $uidSql);
                if (mysqli_num_rows($uidResult) > 0) {
                    while ($uidRow = mysqli_fetch_assoc($uidResult)) {
                        if ($uidRow['table_name'] == "staff"||$uidRow['table_name'] == "beds") {
                            if ($uidRow['table_name'] == "staff"){
                                $toggleSql = "SELECT * FROM `staff` WHERE `staff_uid` = {$Item[$x]}";
                                $toggleResult = mysqli_query($conn, $toggleSql);
                                if (mysqli_num_rows($toggleResult) > 0) {
                                    while ($toggleRow = mysqli_fetch_assoc($toggleResult)) {
                                        $sql = "UPDATE staff SET status = ? WHERE staff_uid = {$Item[$x]}";
                                        $stmt = $conn->prepare($sql);
                                        if (!$stmt) {
                                            die('Prepare failed: ' . htmlspecialchars($conn->error));
                                        }
                                        if ($toggleRow['status'] == 0){
                                            $status = 1;
                                            $stmt->bind_param("i", $status);
                                            if($stmt->execute()){
                                                header("location: ../scanner.php");
                                            }
                                        };
                                        if ($toggleRow['status'] == 1){
                                            $status = 0;
                                            $stmt->bind_param("i", $status);
                                            if($stmt->execute()){
                                                header("location: ../scanner.php");
                                            }
                                        };                                        
                                    }
                                }
                            }
                            if ($uidRow['table_name'] == "beds"){
                                $toggleSql = "SELECT * FROM `bed` WHERE `uid` = {$Item[$x]}";
                                $toggleResult = mysqli_query($conn, $toggleSql);
                                if (mysqli_num_rows($toggleResult) > 0) {
                                    while ($toggleRow = mysqli_fetch_assoc($toggleResult)) {
                                        $sql = "UPDATE bed SET status = ? WHERE uid = {$Item[$x]}";
                                        $stmt = $conn->prepare($sql);
                                        if (!$stmt) {
                                            die('Prepare failed: ' . htmlspecialchars($conn->error));
                                        }
                                        if ($toggleRow['status'] == 0){
                                            $status = 1;
                                            $stmt->bind_param("i", $status);
                                            $roomSql = "SELECT * FROM `room` WHERE `room` = {$toggleRow['room']}";
                                            $roomResult = mysqli_query($conn, $roomSql);
                                            if (mysqli_num_rows($roomResult) > 0) {
                                                while ($roomRow = mysqli_fetch_assoc($roomResult)) {
                                                    $adjust = $roomRow['available'] - 1;
                                                    $adjustSql = "UPDATE room SET available = ? WHERE room = {$toggleRow['room']}";
                                                    $adjustStmt = $conn->prepare($adjustSql);
                                                    if (!$adjustStmt) {
                                                        die('Prepare failed: ' . htmlspecialchars($conn->error));
                                                    }
                                                    $adjustStmt->bind_param("i", $adjust);
                                                    $adjustStmt->execute();
                                                }
                                            }
                                            if($stmt->execute()){
                                                header("location: ../scanner.php");
                                            }
                                        };
                                        if ($toggleRow['status'] == 1){
                                            $status = 0;
                                            $stmt->bind_param("i", $status);
                                            $roomSql = "SELECT * FROM `room` WHERE `room` = {$toggleRow['room']}";
                                            $roomResult = mysqli_query($conn, $roomSql);
                                            if (mysqli_num_rows($roomResult) > 0) {
                                                while ($roomRow = mysqli_fetch_assoc($roomResult)) {
                                                    $adjust = $roomRow['available'] + 1;
                                                    $adjustSql = "UPDATE room SET available = ? WHERE room = {$toggleRow['room']}";
                                                    $adjustStmt = $conn->prepare($adjustSql);
                                                    if (!$adjustStmt) {
                                                        die('Prepare failed: ' . htmlspecialchars($conn->error));
                                                    }
                                                    $adjustStmt->bind_param("i", $adjust);
                                                    $adjustStmt->execute();
                                                }
                                            }
                                            if($stmt->execute()){
                                                header("location: ../scanner.php");
                                            }
                                        };
                                    }
                                }
                            }
                        } else {
                            $sql = "INSERT INTO `requests` (`qty`, `description`, `table_name`, `req_by`) VALUES ('{$Qty[$x]}', '{$uidRow['assigned']}', '{$uidRow['table_name']}', '{$_SESSION['usr']}')";
                            $stmt = $conn->prepare($sql);
                            $stmt->execute();
                        }
                    }
                } else {continue;}
            }
            header("location: ../scanner.php");
        }
    }
?>