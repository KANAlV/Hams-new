<?php
//start session
session_start();
//check if logged in
if (!isset($_SESSION['staff_id'])) {
    header("location: login.php");
}
include "../dbcon.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $type_id = $_POST['id'];

    $sql = "DELETE FROM `types` WHERE `type_id` = $type_id";
    $stmt = $conn->prepare($sql);
    if ($stmt->execute()) {
        header("Location: ../types.php");
    }
}
?>