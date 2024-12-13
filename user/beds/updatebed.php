<?php
    include "../dbcon.php";
    // Start session
    session_start();
    // Check if logged in
    if (!isset($_SESSION['acc_id'])) {
        header("Location: /Hams/login/");
        exit();
    }

    // OOP
    class RoomAssign {
        private $bedId;
        private $bedUid;
        private $bedStatus;
        private $bedNo;
        private $oldRoom;
        private $newRoomId;
        private $newRoom;
        private $bedCount;
        private $available;

        // Set methods
        public function setBedId($var) { $this->bedId = $var; }
        public function setBedUid($var) { $this->bedUid = $var; }
        public function setBedStatus($var) { $this->bedStatus = $var; }
        public function setBedNo($var) { $this->bedNo = $var; }
        public function setOldRoom($var) { $this->oldRoom = $var; }
        public function setNewRoomId($var) { $this->newRoomId = $var; }
        public function setNewRoom($var) { $this->newRoom = $var; }
        public function setBedCount($var) { $this->bedCount = $var; }
        public function setAvailable($var) { $this->available = $var; }

        // Get methods
        public function getBedId() { return $this->bedId; }
        public function getBedUid() { return $this->bedUid; }
        public function getBedStatus() { return $this->bedStatus; }
        public function getBedNo() { return $this->bedNo; }
        public function getOldRoom() { return $this->oldRoom; }
        public function getNewRoomId() { return $this->newRoomId; }
        public function getNewRoom() { return $this->newRoom; }
        public function getBedCount() { return $this->bedCount; }
        public function getAvailable() { return $this->available; }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $DATA = new RoomAssign();
        $DATA->setBedId($_POST['bedId']  ?? null);
        $DATA->setBedUid($_POST['bedUid']  ?? null);
        $DATA->setBedStatus($_POST['bedStatus']  ?? null);
        $DATA->setBedNo($_POST['bedNo']  ?? null);
        $DATA->setOldRoom($_POST['oldRoom']  ?? null);
        $DATA->setNewRoom($_POST['newRoom']  ?? null);
        $DATA->setNewRoomId($_POST['newRoomId']  ?? null);
        $DATA->setBedCount($_POST['bedCount']  ?? null);
        $DATA->setAvailable($_POST['available']  ?? null);

        if ($DATA->getOldRoom() != $DATA->getNewRoom()) {
            // Update the bed record
            $sql1 = "UPDATE bed SET room = ? WHERE bed_id = ? AND uid = ? AND no = ?";
            $stmt1 = $conn->prepare($sql1);
            if (!$stmt1) {
                die('Prepare failed: ' . htmlspecialchars($conn->error));
            }
            $newRoom = $DATA->getNewRoom();
            $bedID = $DATA->getBedId();
            $bedUID = $DATA->getBedUid();
            $BedNo = $DATA->getBedNo();

            $stmt1->bind_param("siss", $newRoom, $bedID, $bedUID, $BedNo);
            $stmt1->execute();

            // Update the old room record
            $room = $DATA->getOldRoom();
            $getsql = "SELECT * FROM `room` WHERE `room` = '$room'";
            $getresult = mysqli_query($conn, $getsql);
            if (mysqli_num_rows($getresult) > 0) {
                while ($getrow = mysqli_fetch_assoc($getresult)){
                    $getavail = $getrow['available'];
                    $getcount = $getrow['beds'];

                    $sql3 = "UPDATE room SET available = ?, beds = ? WHERE room = ?";
                    $stmt3 = $conn->prepare($sql3);
                    if (!$stmt3) {
                        die('Prepare failed: ' . htmlspecialchars($conn->error));
                    }

                    if ($DATA->getBedStatus() != 1) {
                        $getavail--; // Decrease available beds if the bed status is not 1
                    }
                    $getcount--; // Always increment bed count

                    // Ensure the types match with the SQL query
                    $stmt3->bind_param("iis", $getavail, $getcount, $DATA->getOldRoom());

                    if (!$stmt3->execute()) {
                        die('Execute failed: ' . htmlspecialchars($stmt2->error));
                    }
                }
            }
            // Update the new room record
            $sql2 = "UPDATE room SET available = ?, beds = ? WHERE room_id = ? AND room = ?";
            $stmt2 = $conn->prepare($sql2);
            if (!$stmt2) {
                die('Prepare failed: ' . htmlspecialchars($conn->error));
            }

            $avail = $DATA->getAvailable();
            $count = $DATA->getBedCount();
            if ($DATA->getBedStatus() != 1) {
                $avail++; // Increase available beds if the bed status is not 1
            }
            $count++; // Always increment bed count

            // Ensure the types match with the SQL query
            $stmt2->bind_param("iiis", $avail, $count, $DATA->getNewRoomId(), $DATA->getNewRoom());

            if (!$stmt2->execute()) {
                die('Execute failed: ' . htmlspecialchars($stmt2->error));
            }

            // Redirect to the room bed page
            header("Location: ../rooms.php");
            exit();


        } else { echo "New Room is the same as the Old Room. <a href='../rooms.php'>return</a>";}
    }
?>