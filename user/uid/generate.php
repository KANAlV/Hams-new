<?php
include "../dbcon.php";

$sql = "SELECT * FROM `uid` ORDER BY `Q_id` DESC LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$uid = $result->fetch_assoc();

$add = $uid['uid'] + 1;

$sql1 = "INSERT INTO `uid`(`uid`) VALUES ('$add')";
$stmt1 = $conn->prepare($sql1);
if($stmt1->execute()){
    header("Location: ../uid.php");
}
?>