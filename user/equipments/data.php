<?php
    include "../dbcon.php";
    $discarded = $_POST["discarded"];

    $recordsPerPage = 10;
                $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
                $offset = ($page - 1) * $recordsPerPage;
                
                $search = isset($_GET['search']) ? $_GET['search'] : '';
                $sortColumn = isset($_GET['sort']) ? $_GET['sort'] : 'name';
                $sortOrder = isset($_GET['order']) && strtoupper($_GET['order']) === 'DESC' ? 'DESC' : 'ASC';

                $getUID = "SELECT * FROM `equipments` WHERE 
                            `name` = '{$_POST["name"]}' AND
                            `manufacturer` = '{$_POST["manufacturer"]}'
                            GROUP BY name, manufacturer, type";
                $resultUID = mysqli_query($conn, $getUID);

                $sql = "SELECT * FROM `equipments` WHERE 
                            `name` = '{$_POST["name"]}' AND
                            `manufacturer` = '{$_POST["manufacturer"]}' AND
                            `discarded` = '$discarded' AND
                           (`stock` LIKE '%$search%' OR
                            `expiry` LIKE '%$search%' OR
                            `type` LIKE '%$search%')
                ORDER BY $sortColumn $sortOrder
                LIMIT $offset, $recordsPerPage";

                $result = mysqli_query($conn, $sql);

                $totalRecordsQuery = "SELECT COUNT(*) AS total FROM `equipments` WHERE 
                                    `name` = '{$_POST["name"]}' AND
                                    `manufacturer` = '{$_POST["manufacturer"]}' AND
                                    `discarded` = '$discarded' AND
                                   (`stock` LIKE '%$search%' OR
                                    `expiry` LIKE '%$search%' OR
                                    `type` LIKE '%$search%')";
                $totalRecordsResult = mysqli_query($conn, $totalRecordsQuery);
                $totalRecords = mysqli_fetch_assoc($totalRecordsResult)['total'];
                $totalPages = ceil($totalRecords / $recordsPerPage);
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
<body>
    <!-- del modal -->
    <div id='deleteEquip' tabindex='-1' class='hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full'>
        <div class='relative p-4 w-full max-w-md max-h-full'>
            <div class='relative bg-white rounded-lg shadow dark:bg-gray-700'>
                <button type='button' class='absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white' data-modal-hide='deleteEquip'>
                    <svg class='w-3 h-3' aria-hidden='true' xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 14 14'>
                        <path stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6'/>
                    </svg>
                    <span class='sr-only'>Close modal</span>
                </button>
                <form class='p-4 md:p-5 text-center' action='delete.php' method='POST'>
                    <input type="hidden" id='delInput' name='id'></input>
                    <input type="hidden" id='discarded' name='discarded' value="<?php echo $_POST["discarded"];?>"></input>
                    <svg class='mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200' aria-hidden='true' xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'>
                        <path stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z'/>
                    </svg>
                    <h3 class='mb-5 text-lg font-normal text-gray-500 dark:text-gray-400'>This action is not reversable! Dispose this Entry?<p class="text-gray-400">(note: this will still need approval!)</p></h3>
                    <button data-modal-hide='deleteEquip' type='submit' class='text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center'>
                        Yes, I'm sure
                    </button>
                    <button data-modal-hide='deleteEquip' type='button' class='py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700'>No, cancel</button>
                </form>
            </div>
        </div>
    </div>
    <?php include "../drawer.php";?>
    <!-- add modal -->
    <div id='addEquip' tabindex='-1' class='hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full'>
        <div class='relative p-4 w-full max-w-xs max-h-full'>
            <div class='relative bg-white rounded-lg shadow dark:bg-gray-700'>
                <button type='button' class='absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white' data-modal-hide='addEquip'>
                    <svg class='w-3 h-3' aria-hidden='true' xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 14 14'>
                        <path stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6'/>
                    </svg>
                    <span class='sr-only'>Close modal</span>
                </button><br>
                <form class='p-4 md:p-5 text-center' action='add.php' method='POST'>
                    <h1 class="dark:text-white">Add Stock</h1>
                    <input type='hidden' name='name' value='<?php echo $_POST['name'];?>'/>
                    <input type='hidden' name='manufacturer' value='<?php echo $_POST['manufacturer'];?>'/>
                    <div class="m-auto w-min">
                        <div class="relative m-2">
                            <input type="text" onkeypress="return isNumberKey(event)" required id="amount" name="amount" class="block px-2.5 pb-2.5 pt-4 w-50 text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-green-500 focus:outline-none focus:ring-0 focus:border-green-600 peer" placeholder=" " />
                            <label for="amount" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-700 px-2 peer-focus:px-2 peer-focus:text-green-600 peer-focus:dark:text-green-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Amount</label>
                        </div>
                        <div class="relative m-2">
                            <input type="date" id="expiry" required name="expiry" class="block px-2.5 pb-2.5 pt-4 w-50 text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-green-500 focus:outline-none focus:ring-0 focus:border-green-600 peer" placeholder=" " />
                            <label for="expiry" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-700 px-2 peer-focus:px-2 peer-focus:text-green-600 peer-focus:dark:text-green-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Expiry</label>
                        </div>
                    </div>
                    <button data-modal-hide='addEquip' type='button' class='py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700'>Discard</button>
                    <button data-modal-hide='addEquip' type='submit' class='text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center'>
                        Save
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="sm:flex bg-[url('../resources/mbg.jpg')] bg-center sm:bg-[url('../resources/bg.jpg')] bg-cover font-sans m-0 fixed overflow-x-scroll">
        <?php include "../navbar.php";?> 
        <!-- Main container -->
        <div id="container" class="md:inline-block h-screen w-screen">
            <div class="backdrop-blur-md bg-slate-300/30 dark:bg-slate-800/50 w-screen h-screen">
                <div class="fklep-2 md:h-32 w-full items-center text-center">
                    <h1 class="hidden md:block font-bold text-2xl dark:text-white"><?php 
                        $getUID = mysqli_fetch_assoc($resultUID);
                        echo $_POST["name"] ." [". $getUID["uid"] . "]";?>
                    </h1><br>
                    <form method="POST" class="flex w-min m-auto rounded-full bg-white/60 backdrop-blur-md">
                        <div class="bg-[url('../resources/loupe.png')] bg-contain bg-no-repeat bg-center h-6 w-10 m-auto invert dark:invert-0"></div>
                        <input type="text" class="rounded-full bg-white/0 border-none focus:outline-none focus:ring-0" name="search" placeholder="Search..." value="<?php echo $search; ?>">
                    </form>
                </div>
                <div class="flex h-12 w-full md:w-4/5 lg:w-3/5 xl:w-2/4 2xl:w-5/12 items-center bg-green-500 text-white m-auto rounded-lg">
                    <div class='w-20 font-bold text-center'><a href="?search=<?php echo $search; ?>&page=<?php echo $page; ?>&sort=total_stock&order=<?php echo $sortColumn === 'total_stock' && $sortOrder === 'ASC' ? 'DESC' : 'ASC'; ?>">Stock</a></div>
                    <div class="hidden xl:block w-96 text-center font-bold"><a href="?search=<?php echo $search; ?>&page=<?php echo $page; ?>&sort=type&order=<?php echo $sortColumn === 'type' && $sortOrder === 'ASC' ? 'DESC' : 'ASC'; ?>">Type</a></div>
                    <div class='w-32 font-bold text-center'><a href="?search=<?php echo $search; ?>&page=<?php echo $page; ?>&sort=expiry&order=<?php echo $sortColumn === 'expiry' && $sortOrder === 'ASC' ? 'DESC' : 'ASC'; ?>">Expiry</a></div>
                    <div class='flex-1 flex text-center items-center' name='discarded' id='discarded'>
                        <form class=' text-center items-center' name='discarded' id='discarded' method="POST">
                            <input type='text' hidden name='name' value='<?php echo $_POST['name'];?>'>
                            <input type='text' hidden name='manufacturer' value='<?php echo $_POST['manufacturer'];?>'>
                            <select class="bg-green-500" name="discarded" onChange="autoSubmit();">
                                <option class="text-black border-transparent" value="$discarded" hidden><?php 
                                    if ($discarded == '0') {echo "On-Stock";}
                                    if ($discarded == '1') {echo "Discarded";}
                                ?></option>
                                <option class="text-black dark:text-white bg-slate-300 dark:bg-slate-800" value="0">On-Stock</option>
                                <option class="text-black dark:text-white bg-slate-300 dark:bg-slate-800" value="1">Discarded</option>
                            </select>
                        </form>
                        <div class="flex-1"><button data-modal-target='addEquip' data-modal-show='addEquip' class='bg-[url(../resources/add.png)] bg-cover  w-6 h-6 mt-1'></button></div>
                    </div>
                </div>
                <?php
                    // table rows
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            if ($_SESSION["level"] >= '3' || $_SESSION['p3'] == '1') {
                                if ($discarded == 0) {echo "
                                    <form class='flex h-8 2xl:h-12 w-90 md:w-4/5 lg:w-3/5 xl:w-2/4 2xl:w-5/12 m-auto mt-2 items-center backdrop-blur-sm bg-white/80 dark:bg-slate-800/50 rounded-xl' action='remove.php' method='POST'>
                                        <div class='dark:text-white w-20 text-center'>{$row['stock']}</div>
                                        <div class='dark:text-white w-96 h-8 text-center hidden xl:block overflow-y-auto overflow-x-hidden'>{$row['type']}</div>
                                        <div class='dark:text-white w-32 text-center block'>{$row['expiry']}</div>
                                        <input type='text' hidden name='equip_id' value='{$row['equip_id']}'>
                                        <input type='text' hidden name='discarded' value='{$_POST['discarded']}'>
                                        <div class='flex-1 text-center'><button type='button' onclick='sendData({$row['equip_id']})' data-modal-target='deleteEquip' data-modal-show='deleteEquip' class='bg-[url(../resources/trash.png)] bg-cover  w-6 h-6' type='submit'></button></div>
                                    </form>
                                ";}
                                if ($discarded == 1) {echo "
                                    <form class='flex h-8 2xl:h-12 w-90 md:w-4/5 lg:w-3/5 xl:w-2/4 2xl:w-5/12 m-auto mt-2 items-center backdrop-blur-sm bg-red-800 rounded-xl' action='remove.php' method='POST'>
                                        <div class='dark:text-white w-20 text-center'>{$row['stock']}</div>
                                        <div class='dark:text-white w-96 h-8 text-center hidden xl:block overflow-y-auto overflow-x-hidden'>{$row['type']}</div>
                                        <div class='dark:text-white w-32 text-center block'>{$row['expiry']}</div>
                                        <input type='text' hidden name='equip_id' value='{$row['equip_id']}'>
                                        <input type='text' hidden name='discarded' value='{$_POST['discarded']}'>";
                                    if ($_SESSION['level'] == '3'){echo"
                                        <div class='flex-1 text-center'><button type='button' onclick='sendData({$row['equip_id']})' data-modal-target='deleteEquip' data-modal-show='deleteEquip' class='bg-[url(../resources/trash.png)] bg-cover  w-6 h-6' type='submit'></button></div>
                                        </form>  
                                    ";} else {echo "</form>";}
                                }
                            } else {
                                if ($discarded == 0) {echo "<div class='flex h-8 2xl:h-12 w-90 md:w-4/5 lg:w-3/5 xl:w-2/4 2xl:w-5/12 m-auto mt-2 items-center backdrop-blur-sm bg-white/80 dark:bg-slate-800/50 rounded-xl'>";}
                                if ($discarded == 1) {echo "<div class='flex h-8 2xl:h-12 w-90 md:w-4/5 lg:w-3/5 xl:w-2/4 2xl:w-5/12 m-auto mt-2 items-center backdrop-blur-sm bg-red-800 rounded-xl'>";}
                                echo "
                                        <div class='dark:text-white w-20 text-center'>{$row['stock']}</div>
                                        <div class='dark:text-white w-96 h-8 text-center hidden xl:block overflow-y-auto overflow-x-hidden'>{$row['type']}</div>
                                        <div class='dark:text-white w-32 text-center block'>{$row['expiry']}</div>
                                        <input type='text' hidden name='equip_id' value='{$row['equip_id']}'>
                                        <div class='flex-1 text-center'></div>
                                    </div>
                                ";
                            }
                        }
                    }
                    if ($totalPages != 1) {
                        echo "<div class='h-8 w-96 md:w-4/5 lg:w-3/5 xl:w-2/4 2xl:w-5/12 m-auto mt-2'>";
                        $prev = $page - 1;
                        $next = $page + 1;
                        echo "<nav aria-label='Page navigation example'>
                                <ul class='inline-flex -space-x-px text-base h-10'>";
                        if($page > 1){
                            echo "<li>
                                <form method='POST'>
                                    <input type='hidden' name='search' value='$search'/>
                                    <input type='hidden' name='page' value='$prev'/>
                                    <input type='hidden' name='sort' value='$sortColumn'/>
                                    <input type='hidden' name='order' value='$sortOrder'/>
                                    <button class='flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white'>Previous</button>
                                </form>
                            </li>";
                        }
                        for ($i = 1; $i <= $totalPages; $i++) {
                            $activeClass = $i === $page ? 'active' : '';
                            echo "<li>
                                <form method='POST'>
                                    <input type='hidden' name='search' value='$search'/>
                                    <input type='hidden' name='page' value='$i'/>
                                    <input type='hidden' name='sort' value='$sortColumn'/>
                                    <input type='hidden' name='order' value='$sortOrder'/>
                                    <button type='submit' class='flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white'>$i</button>
                                </form>
                            </li>";
                        }
                        if($page < $totalPages){
                            echo "<li>
                                <form method='POST'>
                                    <input type='hidden' name='search' value='$search'/>
                                    <input type='hidden' name='page' value='$next'/>
                                    <input type='hidden' name='sort' value='$sortColumn'/>
                                    <input type='hidden' name='order' value='$sortOrder'/>
                                    <button class='flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white'>Next</button>
                                </form>
                            </li>";
                        }
                        echo "</ul>
                            </nav>
                        </div>";
                    }
                ?>
            </div>
        </div>
    </div>
    <script>
        function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
        }
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

        function sendData(id) {
            // Set the value of 'delInput'
            document.getElementById('delInput').value = id;
        }

        function autoSubmit() {
            var formObject = document.forms['discarded'];
            formObject.submit();
        }
    </script>
</body>
</html>