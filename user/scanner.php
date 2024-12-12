<?php
    include "dbcon.php";
    //OOP
    class count{
        private $arrayCount;
        //setter
            public function setCount($var) {$this->arrayCount = $var;}
        //getter
            public function getCount() {return $this->arrayCount;}
    }
    
    $OOP = new count();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $cnt = $_POST['cnt'];
        $OOP->setCount($cnt);
        $Item = array();
        $Qty = array();
        for ($x = 0; $x <= $cnt; $x++){
            array_push($Item, $_POST[$x]);
            array_push($Qty, $_POST["qty{$x}"]);
        }
    } else {
        $cnt = 0;
        $Qty = 1;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="../node_modules/flowbite/dist/flowbite.min.js"></script>
    <script src="../src/qrScanner.js"></script>
    <title>Medicine</title>
</head>
<body>
    <?php include "drawer.php";?>
    <div class="sm:flex bg-[url('../resources/mbg.jpg')] bg-center sm:bg-[url('../resources/bg.jpg')] bg-cover font-sans m-0 fixed overflow-x-scroll">
        <?php include "navbar.php";?> 
        <!-- Main container -->
        <div id="container" class="md:inline-block h-svh md:h-screen w-screen ">
            <div class="backdrop-blur-md bg-slate-300/30 dark:bg-slate-800/50 w-screen h-screen dark:text-white">
                <div class="md:flex block overflow-y-auto">
                    <div class="w-96 bg-white/80 dark:bg-slate-800/80 p-8 rounded-md shadow-xl">
                        <div id="reader" class="w-96 justify-self-center"></div>
                        <div id="show" class="justify-self-center"><br>
                        <?php
                            if ($_SERVER["REQUEST_METHOD"] == "POST") { $cnt++; echo"
                                <form id='updateForm' action='scanner.php' method='post'>
                                    <label>UID: </label><input type='text' id='result' class='w-64' bg-slate-300/0' name='$cnt' required/>
                                    <input type='text' name='cnt' value='$cnt' hidden/>
                                    <label for='qty'>   Qty: </label><input type='text' class='w-12' bg-slate-300/0' name='qty{$cnt}' onfocus='this.select()' value='1' required/>
                                    <input type='submit' id='clickButton' hidden/>
                                    ";
                                    $cnt--;
                                    for ($x = 0; $x <= $cnt; $x++){
                                        echo "<input type='text' name='qty{$x}' value='{$Qty[$x]}' hidden/>
                                        <input type='text' name='$x' value='{$Item[$x]}' hidden/>";
                                    }
                                echo "</form>";
                            } else { echo"
                                <form id='updateForm' action='scanner.php' method='post'>
                                    <label>UID: </label><input type='text' id='result' class='w-36 bg-slate-300/0' name='$cnt' required/>
                                    <input type='text' name='cnt' value='$cnt' hidden/>
                                    <label for='qty'>   Qty: </label><input type='text' class='w-12 bg-slate-300/0' name='qty{$cnt}' value='1' required/>
                                    <input type='submit' id='clickButton' hidden/>
                                </form>";
                            }
                        ?>
                    </div>
                </div>
                <div class="h-12 w-12"></div>
                <div>
                    <div class="bg-white/80 dark:bg-slate-800/80 dark:text-white">
                        <div class="flex h-12 border-b-2 border-slate-400 dark:border-slate-600">
                            <div class="w-24 text-center pt-2">Qty</div>
                            <div class="w-96 text-center pt-2">Description</div>
                        </div>
                        <div class="overflow-y-auto"><?php
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {echo"
                                <form id='updateForm' action='scanner.php' method='post'>
                                    <input type='text' name='cnt' value='{$OOP->getCount()}' hidden/>
                                    <input type='submit'  id='qtyIn' hidden/>
                                    ";
                                    for ($x = 0; $x <= $cnt; $x++){
                                        echo "<div class='flex h-12'>
                                        <div class='w-24 text-center'><input type='number' name='qty{$x}' class='w-12 bg-white/0 text-center' onfocus='this.select()' onblur='changeqty()' onkeypress='return isAlphaNumeric(event)' value='{$Qty[$x]}' /></div>
                                        <div class='w-64 text-center'><input type='text' name='$x' value='{$Item[$x]}' hidden/>";
                                            $uidSql = "SELECT * FROM `uid` WHERE `uid` = {$Item[$x]}";
                                            $uidResult = mysqli_query($conn, $uidSql);
                                            if (mysqli_num_rows($uidResult) > 0) {
                                                while ($uidRow = mysqli_fetch_assoc($uidResult)) { echo "
                                                    {$uidRow['assigned']}
                                                ";}
                                            }
                                        echo"</div></div>";
                                    }
                                echo "</form>";
                            }
                        ?></div>
                        <?php
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {echo"
                                <form id='updateForm' action='scanner/input.php' method='post'>
                                    <input type='text' name='cnt' value='{$OOP->getCount()}' hidden/>
                                    <input typle='text' name='sendType' value='tools-medicine' readonly hidden/>
                                    <input type='submit'/>
                                    ";
                                    for ($x = 0; $x <= $cnt; $x++){
                                        echo "<tr>
                                        <input type='number' name='qty{$x}' class='qty' onfocus='this.select()' onblur='changeqty()' onkeypress='return isAlphaNumeric(event)' value='{$Qty[$x]}' hidden/>
                                        <input type='text' name='$x' value='{$Item[$x]}' hidden/>";
                                    }
                                echo "</form>";
                            }
                        ?>
                    </div>
                </div>
                <div class='md:hidden h-32 backdrop-blur-md bg-slate-300/30 dark:bg-slate-800/50 w-screen'></div>
            </div>
        </div>
    </div>
    <script>
        const html5Qrcode = new Html5Qrcode('reader');
        const qrCodeSuccessCallBack = (decodedText, decodedResult) => {
            if (decodedText) {
                document.getElementById('result').value = decodedText;
                html5Qrcode.stop();
                var button = document.getElementById('clickButton');
                button.form.submit();
            }
        }
        const config = { fps: 10, qrbox: { width: 250, height: 250 } }
        html5Qrcode.start({ facingMode: "environment" }, config, qrCodeSuccessCallBack);
         
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

        function changeqty(){
            var button = document.getElementById('qtyIn');
                button.form.submit();
        }

        function isAlphaNumeric(event) {
            const char = String.fromCharCode(event.which);
            const regex = /^[0-9]*$/;
            if (!regex.test(char)) {
                event.preventDefault();
                return false;
            }
            return true;
        }
    </script>
</body>
</html>