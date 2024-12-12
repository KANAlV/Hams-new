<?php
//start session
session_start();
//check if logged in
if (!isset($_SESSION['staff_id'])) {
    header("location: login.php");
}
include "../dbcon.php";

interface tideFunctions {
    function id();
    function username();
    function password();
    function occupation();
    function staff_uid();
    function oldStaff_uid();
    function level();
    function surname();
    function first_name();
    function m_i();
    function suffix();
    function staff();
    function bloodBank();
    function medicines();
    function equipments();
    function rooms();
    function beds();
    function uid();
    function approval();
    function type();
}

class Data {
    protected $id;
    protected $username;
    protected $password;
    protected $occupation;
    protected $staff_uid;
    protected $oldStaff_uid;
    protected $level;
    protected $surname;
    protected $first_name;
    protected $m_i;
    protected $suffix;
    protected $staff = 0;
    protected $bloodBank = 0;
    protected $medicines = 0;
    protected $equipments = 0;
    protected $rooms = 0;
    protected $beds = 0;
    protected $uid = 0;
    protected $approval = 0;
    protected $type = 0;
}

class Mutator extends Data implements tideFunctions {
    function id() { $this->id = $_POST['id'] ?? null; }
    function username() { $this->username = $_POST['username'] ?? null; }
    function password() { $this->password = $_POST['password'] ?? null;}
    function occupation() { $this->occupation = $_POST['occupation'] ?? null; }
    function staff_uid() { $this->staff_uid = $_POST['staff_uid'] ?? null; }
    function oldStaff_uid() { $this->oldStaff_uid = $_POST['oldStaff_uid'] ?? null; }
    function level() { $this->level = $_POST['level'] ?? null; }
    function surname() { $this->surname = $_POST['surname'] ?? null; }
    function first_name() { $this->first_name = $_POST['first_name'] ?? null; }
    function m_i() { $this->m_i = $_POST['m_i'] ?? null; }
    function suffix() { $this->suffix = $_POST['suffix'] ?? null; }
    function staff() { $this->staff = $_POST['stf'] ?? $this->staff; }
    function bloodBank() { $this->bloodBank = $_POST['bb'] ?? $this->bloodBank; }
    function medicines() { $this->medicines = $_POST['med'] ?? $this->medicines; }
    function equipments() { $this->equipments = $_POST['equip'] ?? $this->equipments; }
    function rooms() { $this->rooms = $_POST['rm'] ?? $this->rooms; }
    function beds() { $this->beds = $_POST['bd'] ?? $this->beds; }
    function uid() { $this->uid = $_POST['ui'] ?? $this->uid; }
    function approval() { $this->approval = $_POST['aprvl'] ?? $this->approval; }
    function type() { $this->type = $_POST['typ'] ?? $this->type; }
    public function exportState() { return get_object_vars($this); }
}

class Accessor extends Mutator implements tideFunctions {
    function id() { return $this->id; }
    function username() { return $this->username; }
    function password() { return $this->password; }
    function occupation() { return $this->occupation; }
    function staff_uid() { return $this->staff_uid; }
    function oldStaff_uid() { return $this->oldStaff_uid; }
    function level() { return $this->level; }
    function surname() { return $this->surname; }
    function first_name() { return $this->first_name; }
    function m_i() { return $this->m_i; }
    function suffix() { return $this->suffix; }
    function staff() { return $this->staff; }
    function bloodBank() { return $this->bloodBank; }
    function medicines() { return $this->medicines; }
    function equipments() { return $this->equipments; }
    function rooms() { return $this->rooms; }
    function beds() { return $this->beds; }
    function uid() { return $this->uid; }
    function approval() { return $this->approval; }
    function type() { return $this->type; }
    public function importState($state) {
        foreach ($state as $key => $value) {
            $this->$key = $value;
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mutator = new Mutator();
        $mutator->id();
        $mutator->username();
        $mutator->password();
        $mutator->occupation();
        $mutator->staff_uid();
        $mutator->oldStaff_uid();
        $mutator->level();
        $mutator->surname();
        $mutator->first_name();
        $mutator->m_i();
        $mutator->suffix();
        $mutator->staff();
        $mutator->bloodBank();
        $mutator->medicines();
        $mutator->equipments();
        $mutator->rooms();
        $mutator->beds();
        $mutator->uid();
        $mutator->approval();
        $mutator->type();

    $accessor = new Accessor();

    $accessor->importState($mutator->exportState());
        $id = $accessor->id();
        $username = $accessor->username();
        $password = $accessor->password();
        $level = $accessor->level();
        $addedBy = $_SESSION['usr'] ?? null;
        $occupation = $accessor->occupation();
        $surname = $accessor->surname();
        $first_name = $accessor->first_name();
        $m_i = $accessor->m_i();
        $suffix = $accessor->suffix();
        $staff_uid = $accessor->staff_uid();
        $oldStaff_uid = $accessor->oldStaff_uid();
        $staff = $accessor->staff();
        $bloodBank = $accessor->bloodBank();
        $medicines = $accessor->medicines();
        $equipments = $accessor->equipments();
        $rooms = $accessor->rooms();
        $beds = $accessor->beds();
        $uid = $accessor->uid();
        $approval = $accessor->approval();
        $approval = $accessor->type();

    // Check if the username already exists
    $check1_sql = "SELECT * FROM staff WHERE acc_name=? AND staff_id != '$id'";
    $check1_stmt = $conn->prepare($check1_sql);
    $check1_stmt->bind_param("s", $username);
    $check1_stmt->execute();
    $check1_result = $check1_stmt->get_result();

    if ($check1_result->num_rows > 0) {
        echo "Username already exists. <a href='../staff.php'>Try a different username</a>";
        exit();
    }

    // Check if the staff already exists
    $check2_sql = "SELECT * FROM staff WHERE surname=? AND first_name=? AND suffix=? AND staff_id != '$id'";
    $check2_stmt = $conn->prepare($check2_sql);
    $check2_stmt->bind_param("sss", $surname, $first_name, $suffix);
    $check2_stmt->execute();
    $check2_result = $check2_stmt->get_result();

    if ($check2_result->num_rows > 0) {
        echo "Staff already exists. <a href='../staff.php'>Go Back?</a>";
        exit();
    }

    if ($oldStaff_uid != $staff_uid){//Update UID
        $new = $staff_uid;
        $old = $oldStaff_uid;
        $name = "$surname, $first_name $m_i";

        //check if already used
        $uidSql2 = "SELECT * FROM `uid` WHERE uid = $new AND assigned IS NOT NULL";
        $uidResult2 = mysqli_query($conn, $uidSql2);
        if (mysqli_num_rows($uidResult2) > 0) {
            while ($uidRow2 = mysqli_fetch_assoc($uidResult2)) {
                echo "UID is Already Used By {$uidRow2['assigned']}. <a href='/Hams/bed'>return</a>";
                exit();
            }
        } else {
            if ($old != NULL) { //clear old uid if already assigned
                $sql0 = "UPDATE `uid` SET assigned = NULL, `table_name` = NULL WHERE `uid` = ?";
                $stmt0 = $conn->prepare($sql0);
                if (!$stmt0) {
                    die('Prepare failed: ' . htmlspecialchars($conn->error));
                }
                $stmt0->bind_param("s",$old);
                $stmt0->execute();
            }
            //update in uid table
            $sql1 = "UPDATE `uid` SET assigned = ?, `table_name` = 'staff' WHERE `uid` = ?";
            $stmt1 = $conn->prepare($sql1);
            if (!$stmt1) {
                die('Prepare failed: ' . htmlspecialchars($conn->error));
            }
            $stmt1->bind_param("ss", $name, $new);
            $stmt1->execute();

            //update in uid staff
            $sql2 = "UPDATE `staff` SET staff_uid = ? WHERE `staff_id` = ?";
            $stmt2 = $conn->prepare($sql2);
            if (!$stmt2) {
                die('Prepare failed: ' . htmlspecialchars($conn->error));
            }
            $stmt2->bind_param("ss", $new, $id);
            $stmt2->execute();
        }
    }

    if ($password == null){ //same password
       $sql = "UPDATE `staff` SET `acc_name`='$username',
                        `surname`='$surname',`first_name`='$first_name',`m_i`='$m_i',`suffix`='$suffix',
                        `occupation`='$occupation',`level`='$level',
                        `stf`='$staff',`bb`='$bloodBank',`med`='$medicines',`equip`='$equipments',
                        `rm`='$rooms',`bd`='$beds',`aprvl`='$approval',`typ`='$type'
        WHERE `staff_id`= $id";
        $stmt = $conn->prepare($sql);
        if ($stmt->execute()) {
            echo "Registration successful! <a href='/Hams/account_management/'>Login</a>";
            header("Location: ../staff.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    } else { //different password
        $hashedPassword = password_hash($password ?? "", PASSWORD_DEFAULT);
        $sql = "UPDATE `staff` SET `acc_name`='$username',`acc_pwd`='$hashedPassword',
                        `surname`='$surname',`first_name`='$first_name',`m_i`='$m_i',`suffix`='$suffix',
                        `occupation`='$occupation',`level`='$level',
                        `stf`='$staff',`bb`='$bloodBank',`med`='$medicines',`equip`='$equipments',
                        `rm`='$rooms',`bd`='$beds',`aprvl`='$approval',`typ`='$type'
        WHERE `staff_id`= $id";
        $stmt = $conn->prepare($sql);
        if ($stmt->execute()) {
            echo "Registration successful! <a href='/Hams/account_management/'>Login</a>";
            header("Location: ../staff.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    }
}
?>