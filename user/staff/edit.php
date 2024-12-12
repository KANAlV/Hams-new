<?php include "../dbcon.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    interface Methods {
        function username();
        function password();
        function occupation();
        function staff_uid();
        function level();
        function surname();
        function first_name();
        function m_i();
        function suffix();
        //checkbox
            function id();
            function stf();
            function bb();
            function med();
            function equip();
            function rm();
            function bd();
            function ui();
            function aprvl();
    }

    class Data {
        protected $rowData;
        protected $id;
        protected $username;
        protected $password;
        protected $occupation;
        protected $staff_uid;
        protected $level;
        protected $surname;
        protected $first_name;
        protected $m_i;
        protected $suffix;
        //checkbox
            protected $stf;
            protected $bb;
            protected $med;
            protected $equip;
            protected $rm;
            protected $bd;
            protected $ui;
            protected $aprvl;
    }

    class Mutator extends Data implements Methods {
        public function exportState() { return get_object_vars($this); }

        function id() { $this->id = $_POST['id']; }
        function username() { $this->username = $this->rowData['acc_name']; }
        function password() { $this->password = $this->rowData['acc_pwd']; }
        function occupation() { $this->occupation = $this->rowData['occupation']; }
        function staff_uid() { $this->staff_uid = $this->rowData['staff_uid']; }
        function level() { $this->level = $this->rowData['level']; }
        function surname() { $this->surname = $this->rowData['surname']; }
        function first_name() { $this->first_name = $this->rowData['first_name']; }
        function m_i() { 
            if (isset($this->rowData['m_i'])) {
                $this->stf = $this->rowData['m_i'];
            } else {
                $this->stf = null; // Default if 'm_i' is not found
            }
         }
        function suffix() {
            if (isset($this->rowData['suffix'])) {
                $this->stf = $this->rowData['suffix'];
            } else {
                $this->stf = null; // Default if 'suffix' is not found
            }
        }

        //checkbox
            function stf() { $this->stf = $this->rowData['stf']; }
            function bb() { $this->bb = $this->rowData['bb']; }
            function med() { $this->med = $this->rowData['med']; }
            function equip() { $this->equip = $this->rowData['equip']; }
            function rm() { $this->rm = $this->rowData['rm']; }
            function bd() { $this->bd = $this->rowData['bd']; }
            function ui() { $this->ui = $this->rowData['ui']; }
            function aprvl() { $this->aprvl = $this->rowData['aprvl']; }

        function main($conn) {
            $sql = "SELECT * FROM staff WHERE staff_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $this->id);
            $stmt->execute();
            $result = $stmt->get_result();
        
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $this->rowData = $row;  // Ensure rowData is populated
                }
            }
        }
    }

    class Accessor extends Mutator implements Methods {
        public function importState($state) {
            foreach ($state as $key => $value) {
                $this->$key = $value;
            }
        }

        function id() { return $this->id; }
        function username() { return $this->username; }
        function password(){ return $this->password; }
        function occupation(){ return $this->occupation; }
        function staff_uid(){ return $this->staff_uid; }
        function level(){ return $this->level; }
        function surname(){ return $this->surname; }
        function first_name(){ return $this->first_name; }
        function m_i(){ return $this->m_i; }
        function suffix(){ return $this->suffix; }
        //checkbox
            function stf() { return $this->stf; }
            function bb() { return $this->bb; }
            function med() { return $this->med; }
            function equip() { return $this->equip; }
            function rm() { return $this->rm; }
            function bd() { return $this->bd; }
            function ui() { return $this->ui; }
            function aprvl() { return $this->aprvl; }
    }

    // Mutator operation
    $mutator = new Mutator();
    $mutator->id();
    $mutator->main($conn);//run $sql
        $mutator->username();
        $mutator->password();
        $mutator->occupation();
        $mutator->staff_uid();
        $mutator->level();
        $mutator->surname();
        $mutator->first_name();
        $mutator->m_i();
        $mutator->suffix();
        //checkbox
            $mutator->stf();
            $mutator->bb();
            $mutator->med();
            $mutator->equip();
            $mutator->rm();
            $mutator->bd();
            $mutator->ui();
            $mutator->aprvl();

    // Accessor operation
    $accessor = new Accessor();
    $accessor->importState($mutator->exportState());
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <script src="../../node_modules/flowbite/dist/flowbite.min.js"></script>
    <title>Staff</title>
</head>
<body class="bg-[url('../resources/mbg.jpg')] bg-center sm:bg-[url('../resources/bg.jpg')] bg-cover font-sans m-0 fixed overflow-x-scroll">
    <?php include "../drawer.php";?>   
    <div class="sm:flex">
        <?php include "../navbar.php";?>   
        <!-- Main container -->
        <div id="container" class="md:inline-block h-screen w-screen">
            <div class="backdrop-blur-md bg-slate-300/30 dark:bg-slate-800/50 w-screen h-screen">
                <div class="h-4 2xl:h-24 w-screen text-center items-center"></div>
                <div class="m-auto p-4 rounded-xl bg-white/80 dark:bg-slate-800/50 dark:text-white backdrop-blur-md w-96">
                    <form class="text-center" action="tide.php" method="POST">
                        <!-- hidden id submit -->
                        <h1 class="font-bold text-2xl dark:text-white">Edit Staff</h1>
                        <input class="hidden" type="text" name="id" value="<?php echo $accessor->id();?>">
                        <input class="hidden" type="text" name="oldStaff_uid" value="<?php echo $accessor->staff_uid();?>">
                        <div class="flex">
                            <div class="text-left p-2">
                                <label>USERNAME</label><br>
                                <input onkeypress="return isAlphaNumerical(event)" class="w-28 border-t-0 border-l-0 border-r-0 border-b-2 border-green-500 bg-white/5" type="text" name="username" value="<?php echo $accessor->username();?>" required><br><br>
                                <label>PASSWORD</label><br>
                                <input onkeypress="return isAlphaNumerical(event)" class="w-28 border-t-0 border-l-0 border-r-0 border-b-2 border-green-500 bg-white/5" type="password" name="password" value="lwdadrspsoo" required><br><br>
                                <label>Occupation</label><br>
                                <input onkeypress="return isAlphaNumerical(event)" class="w-28 border-t-0 border-l-0 border-r-0 border-b-2 border-green-500 bg-white/5" type="text" name="occupation" value="<?php echo $accessor->occupation();?>" required><br>
                            </div>
                            <div class="text-left p-2">
                                <label>NAME</label><br>
                                <input onkeypress="return isAlphaNumerical(event)" class="border-t-0 border-l-0 border-r-0 border-b-2 border-green-500 bg-white/5 w-48" type="text" name="surname" placeholder="Surname" value="<?php echo $accessor->surname();?>" required><br>
                                <input onkeypress="return isAlphaNumerical(event)" class="border-t-0 border-l-0 border-r-0 border-b-2 border-green-500 bg-white/5 w-48" type="text" name="first_name" placeholder="First Name" value="<?php echo $accessor->first_name();?>" required><br>
                                <input onkeypress="return isAlphaNumerical(event)" class="border-t-0 border-l-0 border-r-0 border-b-2 border-green-500 bg-white/5 w-12" type="text" name="m_i" value="<?php echo $accessor->m_i();?>" placeholder="M.I.">
                                <input onkeypress="return isAlphaNumerical(event)" class="border-t-0 border-l-0 border-r-0 border-b-2 border-green-500 bg-white/5 w-20" type="text" name="suffix" placeholder="Suffix" value="<?php echo $accessor->suffix();?>"><br><br>
                                <label for='staff_uid'>UID:</label><br>
                                <select name='staff_uid' class="border-t-0 border-l-0 border-r-0 border-b-2 border-green-500 bg-white/5">
                                    <option class='dark:bg-slate-800' value="<?php echo $accessor->staff_uid();?>"><?php echo $accessor->staff_uid();?></option>
                                    <option class='dark:bg-slate-800' value=''>--none--</option>
                                <?php
                                    $uidSql = "SELECT * FROM `uid` WHERE `uid` != '{$accessor->staff_uid()}' AND `assigned` IS NULL ORDER BY `uid` LIMIT 10";
                                    $uidResult = mysqli_query($conn, $uidSql);
                                    if (mysqli_num_rows($uidResult) > 0) {
                                        while ($uidRow = mysqli_fetch_assoc($uidResult)) { echo "
                                            <option class='dark:bg-slate-800' value='{$uidRow['uid']}'>{$uidRow['uid']}</option>
                                        ";}
                                    }
                                ?>
                            </div>
                        </div>
                        <?php
                            if($_SESSION['level'] == '4'){
                                echo "<label>usertype: </label><select class='border-t-0 border-l-0 border-r-0 border-b-2 border-green-500 bg-white/5' name='level' placeholder='Password' required>
                                    <option class='hidden dark:bg-slate-800' value='{$accessor->level()}'>{$accessor->level()}</option>
                                    <option class='dark:bg-slate-800' value='1'>1</option>
                                    <option class='dark:bg-slate-800' value='2'>2</option>
                                    <option class='dark:bg-slate-800' value='3'>3</option>
                                    </select>
                                <br><br>";
                            } else if($_SESSION['level'] == '3'){
                                echo "<label>usertype: </label><select class='border-t-0 border-l-0 border-r-0 border-b-2 border-green-500 bg-white/5' name='level' placeholder='Password' required>
                                    <option class='hidden dark:bg-slate-800' value='{$accessor->level()}'>{$accessor->level()}</option>
                                    <option class='dark:bg-slate-800' value='1'>1</option>
                                    <option class='dark:bg-slate-800' value='2'>2</option>
                                    </select>
                                <br><br>";
                            }else {
                                echo '<input type="password" name="level" value="1" hidden>';
                            }
                        ?>
                        <br>Permissions<br>
                        <div class='flex'>
                            <div class='block w-28 text-left'>
                                <input type='checkbox' id='stf' name='stf' value='1' <?php if($accessor->stf() == 1){echo "checked";};?>>
                                <label for='staff'> Staff</label><br>
                                <input type='checkbox' id='equip' name='equip' value='1' <?php if($accessor->equip() == 1){echo "checked";};?>>
                                <label for='equip'> Equipment</label><br>
                                <input type='checkbox' id='aprvl' name='aprvl' value='1' <?php if($accessor->aprvl() == 1){echo "checked";};?>>
                                <label for='aprvl'> Approvals</label><br>
                            </div>
                            <div class='block w-28 text-left'>
                                <input type='checkbox' id='bb' name='bb' value='1' <?php if($accessor->bb() == 1){echo "checked";};?>>
                                <label for='bb'> Blood Bank</label><br>
                                <input type='checkbox' id='rm' name='rm' value='1' <?php if($accessor->rm() == 1){echo "checked";};?>>
                                <label for='rm'> Rooms</label><br>
                                <input type='checkbox' id='ui' name='ui' value='1' <?php if($accessor->ui() == 1){echo "checked";};?>>
                                <label for='ui'> UID</label><br>
                            </div>
                            <div class='block w-26 text-left'>
                                <input type='checkbox' id='med' name='med' value='1'>
                                <label for='med'> Medicine</label><br>
                                <input type='checkbox' id='bd' name='bd' value='1'>
                                <label for='bd'> Beds</label><br>
                                <input type='checkbox' id='typ' name='typ' value='1'>
                                <label for='typ'> Types</label><br>
                            </div>
                        </div>
                        <br>
                        <button class="w-36 h-12 bg-green-500 hover:bg-green-400 hover:border-black hover:border-2 text-white" type="submit">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        //Trigger for hover duplicate[id="drawer-hover-trigger"]

        const drawerElement = document.getElementById('navbar');
        const drawerInstance = new Drawer(drawerElement, {
        placement: 'left', // Can be 'left', 'right', 'top', or 'bottom'
        backdrop: false,
        });

        // Hover Event Listeners
        const trigger = document.getElementById('drawer-hover-trigger');

        trigger.addEventListener('mouseover', () => {
        drawerInstance.show(); // Show drawer on hover
        });

        drawerElement.addEventListener('mouseleave', () => {
        drawerInstance.hide(); // Hide drawer on mouse leave
        });

        function isAlphaNumerical(event) {
            const charCode = event.which || event.keyCode;
            const char = String.fromCharCode(charCode);
            const validPattern = /^[a-zA-Z0-9-_,.]$/;
            if (!validPattern.test(char)) {
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
<?php } ?>