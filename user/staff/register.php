<?php include "../dbcon.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <script src="../../node_modules/flowbite/dist/flowbite.min.js"></script>
    <title>Home</title>
</head>
<body class="bg-[url('../resources/mbg.jpg')] bg-center sm:bg-[url('../resources/bg.jpg')] bg-cover font-sans m-0 fixed overflow-x-scroll">
    <?php include "../drawer.php";?>   
    <div class="sm:flex">
        <?php include "../navbar.php";?> 
        <!-- Main container -->
        <div id="container" class="md:inline-block h-screen w-screen">
            <div class="backdrop-blur-md bg-slate-300/30 dark:bg-slate-800/50 w-screen h-screen">
                <div class="h-4 2xl:h-24"></div>
                <div class="m-auto p-4 rounded-xl bg-white/80 dark:bg-slate-800/50 dark:text-white backdrop-blur-md w-96">
                    <form class="text-center" action="retsiger.php" method="POST">
                        <div class="flex">
                            <div class="text-left p-2">
                                <label>USERNAME</label><br>
                                <input onkeypress="return isAlphaNumerical(event)" class="w-28 border-t-0 border-l-0 border-r-0 border-b-2 border-green-500 bg-white/5" type="text" name="username" required><br><br>
                                <label>PASSWORD</label><br>
                                <input onkeypress="return isAlphaNumerical(event)" class="w-28 border-t-0 border-l-0 border-r-0 border-b-2 border-green-500 bg-white/5" type="password" name="password" required><br><br>
                                <label>Occupation</label><br>
                                <input onkeypress="return isAlphaNumerical(event)" class="w-28 border-t-0 border-l-0 border-r-0 border-b-2 border-green-500 bg-white/5" type="text" name="occupation" required><br>
                            </div>
                            <div class="text-left p-2">
                                <label>NAME</label><br>
                                <input onkeypress="return isAlphaNumerical(event)" class="border-t-0 border-l-0 border-r-0 border-b-2 border-green-500 bg-white/5 w-48" type="text" name="surname" placeholder="Surname" required><br>
                                <input onkeypress="return isAlphaNumerical(event)" class="border-t-0 border-l-0 border-r-0 border-b-2 border-green-500 bg-white/5 w-48" type="text" name="first_name" placeholder="First Name" required><br>
                                <input onkeypress="return isAlphaNumerical(event)" class="border-t-0 border-l-0 border-r-0 border-b-2 border-green-500 bg-white/5 w-12" type="text" name="m_i" placeholder="M.I.">
                                <input onkeypress="return isAlphaNumerical(event)" class="border-t-0 border-l-0 border-r-0 border-b-2 border-green-500 bg-white/5 w-20" type="text" name="suffix" placeholder="Suffix"><br><br>
                                <label for='staff_uid'>UID:</label><br>
                                <select name='staff_uid' class="border-t-0 border-l-0 border-r-0 border-b-2 border-green-500 bg-white/5">
                                    <option class='dark:bg-slate-800' value=''>--none--</option>
                                <?php
                                    $uidSql = "SELECT * FROM `uid` WHERE `assigned` IS NULL ORDER BY `uid` LIMIT 10";
                                    $uidResult = mysqli_query($conn, $uidSql);
                                    if (mysqli_num_rows($uidResult) > 0) {
                                        while ($uidRow = mysqli_fetch_assoc($uidResult)) { echo "
                                            <option class='dark:bg-slate-800' value='{$uidRow['uid']}'>{$uidRow['uid']}</option>
                                        ";}
                                    }
                                ?>
                                </select>
                            </div>
                        </div>
                        <?php
                            if($_SESSION['level'] == '4'){
                                echo '<label>usertype: </label>
                                <select class="border-t-0 border-l-0 border-r-0 border-b-2 border-green-500 bg-white/5" name="level" placeholder="Password" required>
                                    <option class="dark:bg-slate-800" value="1">1</option>
                                    <option class="dark:bg-slate-800" value="2">2</option>
                                    <option class="dark:bg-slate-800" value="3">3</option>
                                </select>
                                <br><br>';
                            } else if($_SESSION['level'] == '3'){
                                echo '<label>usertype: </label><select class="border-t-0 border-l-0 border-r-0 border-b-2 border-green-500 bg-white/5" name="level" placeholder="Password" required>
                                    <option class="dark:bg-slate-800" value="1">1</option>
                                    <option class="dark:bg-slate-800" value="2">2</option>
                                    </select>
                                <br><br>';
                            }else {
                                echo '<input type="password" name="level" value="1" hidden>';
                            }
                        ?>
                        <br>Permissions<br>
                        <div class='flex'>
                            <div class='block w-28 text-left'>
                                <input type='checkbox' id='stf' name='stf' value='1'>
                                <label for='staff'> Staff</label><br>
                                <input type='checkbox' id='equip' name='equip' value='1'>
                                <label for='equip'> Equipment</label><br>
                                <input type='checkbox' id='aprvl' name='aprvl' value='1'>
                                <label for='aprvl'> Approvals</label><br>
                            </div>
                            <div class='block w-28 text-left'>
                                <input type='checkbox' id='bb' name='bb' value='1'>
                                <label for='bb'> Blood Bank</label><br>
                                <input type='checkbox' id='rm' name='rm' value='1'>
                                <label for='rm'> Rooms</label><br>
                                <input type='checkbox' id='ui' name='ui' value='1'>
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
                        <button class="w-36 h-12 bg-green-500 hover:bg-green-400 hover:border-black hover:border-2 text-white" type="submit">Register</button>
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