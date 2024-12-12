<?php
include "../dbcon.php";

$uid = $_POST["uid"];
$assigned = $_POST["assigned"];
$table_name = $_POST["table_name"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql1 = "UPDATE `uid` SET `assigned` = null, `table_name` = null WHERE `uid` = ?";
    $stmt1 = $conn->prepare($sql1);
    if (!$stmt1) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }
    $stmt1->bind_param("s", $uid);
    if ($stmt1->execute()) {
        if ($table_name == "medicine" || $table_name == "equipments") {
            $sql2 = "UPDATE `$table_name` SET `uid` = null WHERE `name` = '$assigned'";
            $stmt2 = $conn->prepare($sql2);
            if (!$stmt2) {
                die('Prepare failed: ' . htmlspecialchars($conn->error));
            }
            $stmt2->bind_param("s", $uid);
            if ($stmt2->execute()) {
                header("Location: ../uid.php");
            }
        }
        if ($table_name == "bed") {
            $sql2 = "UPDATE `bed` SET `uid` = null WHERE `room` = '$assigned'";
            $stmt2 = $conn->prepare($sql2);
            if (!$stmt2) {
                die('Prepare failed: ' . htmlspecialchars($conn->error));
            }
            $stmt2->bind_param("s", $uid);
            if ($stmt2->execute()) {
                header("Location: ../uid.php");
            }
        }
        if ($table_name == "staff") {
            $sql2 = "UPDATE `staff` SET `uid` = null WHERE `uid` = '$uid'";
            $stmt2 = $conn->prepare($sql2);
            if (!$stmt2) {
                die('Prepare failed: ' . htmlspecialchars($conn->error));
            }
            $stmt2->bind_param("s", $uid);
            if ($stmt2->execute()) {
                header("Location: ../uid.php");
            }
        }
    }
}
?>