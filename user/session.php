<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "DBconfig.php"; // Include your database connection file
    
    // Get user input from the form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Query to retrieve the user's hashed password from the database
    $sql = "SELECT * FROM accounts WHERE acc_name=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user["acc_pwd"])) {
        // Password is correct, log the user in
        $_SESSION["acc_id"] = $user["acc_id"];
        $_SESSION["level"] = $user["level"];
        $_SESSION["usr"] = $user["acc_name"];
        $_SESSION["occu"] = $user["occupation"];
        $_SESSION["profile"] = $user["profile"];
        // user permission
        $_SESSION["p1"] = $user["stf"];
        $_SESSION["p2"] = $user["bb"];
        $_SESSION["p3"] = $user["med"];
        $_SESSION["p4"] = $user["equip"];
        $_SESSION["p5.1"] = $user["rm"];
        $_SESSION["p5.2"] = $user["bd"];
        $_SESSION["p6"] = $user["acc"];
        $_SESSION["p7"] = $user["ui"];
        $_SESSION["p8"] = $user["aprvl"];
        header("Location: home.php"); // Redirect to a welcome page
        exit();
    } else {
        // Incorrect username or password
        echo "Incorrect username or password. <a href='/Hams/login/'>Try again</a>";
    }

    $stmt->close();
    $conn->close();
}
?>