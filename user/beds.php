<?php
    include "dbcon.php";

    $discarded = "";
    if(isset($_GET["discarded"]))
    { $discarded = $_GET["discarded"]; }
    else{$discarded = 0;}

    $recordsPerPage = 10;
    
    //BEDS TABLE
    $bedpage = isset($_GET['bedpage']) && is_numeric($_GET['bedpage']) ? (int)$_GET['bedpage'] : 1;
    $bedoffset = ($bedpage - 1) * $recordsPerPage;
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $bedsortColumn = isset($_GET['bedsort']) ? $_GET['bedsort'] : 'no';
    $bedsortOrder = isset($_GET['bedorder']) && strtoupper($_GET['bedorder']) === 'DESC' ? 'DESC' : 'ASC';

    $sql = "SELECT * FROM `bed` WHERE 
            `uid` LIKE '%$search%' OR
            `no` LIKE '%$search%' OR
            `room` LIKE '%$search%' OR
            `status` LIKE '%$search%'
            ORDER BY $bedsortColumn $bedsortOrder
            LIMIT $bedoffset, $recordsPerPage";

    $result = mysqli_query($conn, $sql);

    $totalRecordsQuery = "SELECT COUNT(*) AS total FROM `bed` WHERE 
                        `uid` LIKE '%$search%' OR
                        `no` LIKE '%$search%' OR
                        `room` LIKE '%$search%' OR
                        `status` LIKE '%$search%'";
    $totalRecordsResult = mysqli_query($conn, $totalRecordsQuery);
    $totalRecords = mysqli_fetch_assoc($totalRecordsResult)['total'];
    $totalPages = ceil($totalRecords / $recordsPerPage);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="../node_modules/flowbite/dist/flowbite.min.js"></script>
    <title>equipments</title>
</head>
<body>
    <?php include "drawer.php";
    //Modals
        include "beds/modals.php";
    ?>
    <div class="sm:flex bg-[url('../resources/mbg.jpg')] bg-center sm:bg-[url('../resources/bg.jpg')] bg-cover font-sans m-0 fixed overflow-x-scroll">
        <?php include "navbar.php";?> 
        <!-- Main container -->
        <div id="container" class="md:inline-block h-screen w-screen">
            <div class="backdrop-blur-md bg-slate-300/30 dark:bg-slate-800/50 w-screen h-screen">
                <div class="p-2 md:h-32 w-full items-center text-center"><?php 
                    if ($discarded == '0')  {echo "<h1 class='hidden md:block font-bold text-2xl dark:text-white'>";}
                    if ($discarded == '1') {echo "<h1 class='hidden md:block font-bold text-2xl dark:text-red-600'>";}
                ?>Beds</h1><br>
                    <form method="GET" class="flex w-min m-auto rounded-full bg-white/60 backdrop-blur-md">
                        <div class="bg-[url('../resources/loupe.png')] bg-contain bg-no-repeat bg-center h-6 w-10 m-auto invert dark:invert-0"></div>
                        <input type="hidden" name="toggle" value="<?php echo $toggle; ?>"/>
                        <input type="text" class="rounded-full bg-white/0 border-none focus:outline-none focus:ring-0" name="search" placeholder="Search..." value="<?php echo $search; ?>">
                    </form>
                </div>
                <div class="flex h-12 w-90 md:w-4/5 lg:w-3/5 xl:w-2/4 2xl:w-5/12 items-center bg-green-500 text-white m-auto rounded-lg">
                    <div class='w-4 md:w-8'></div>
                    <div class='dark:text-white w-24 font-bold text-center'><a href="?search=<?php echo $search; ?>&page=<?php echo $page; ?>&sort=no&order=<?php echo $sortColumn === 'no' && $sortOrder === 'ASC' ? 'DESC' : 'ASC'; ?>">Bed No.</a></div>
                    <div class='dark:text-white w-24 font-bold text-center'><a href="?search=<?php echo $search; ?>&page=<?php echo $page; ?>&sort=room&order=<?php echo $sortColumn === 'room' && $sortOrder === 'ASC' ? 'DESC' : 'ASC'; ?>">Room</a></div>
                    <div class='hidden md:block dark:text-white w-72 font-bold text-center'><a href="?search=<?php echo $search; ?>&page=<?php echo $page; ?>&sort=uid&order=<?php echo $sortColumn === 'uid' && $sortOrder === 'ASC' ? 'DESC' : 'ASC'; ?>">UID</a></div>
                    <?php
                        if ($_SESSION['level'] == '3' || $_SESSION['p4'] == '1') {
                            echo "<div class='flex-1 flex text-center items-center' name='discarded' id='discarded'>
                                    <form class='text-center items-center' name='discarded' id='discarded'>" ?>
                                        <select class="bg-green-500" name="discarded" onChange="autoSubmit();">
                                            <option class="text-black border-transparent" value="$discarded" hidden><?php 
                                                if ($discarded == '0') {echo "On-Stock";}
                                                if ($discarded == '1') {echo "Discarded";}
                                            ?></option>
                                            <option class="text-black dark:text-white bg-slate-300 dark:bg-slate-800" value="0">On-Stock</option>
                                            <option class="text-black dark:text-white bg-slate-300 dark:bg-slate-800" value="1">Discarded</option>
                                        </select>
                                    </form>
                                    <div class="flex-1"><button data-modal-target='addBeds' data-modal-show='addBeds' class='bg-[url(../resources/add.png)] bg-cover  w-6 h-6 mt-1' type='button'></button></div>
                                </div>
                            <?php ;
                        } else {
                            echo "<div class='flex-1 flex text-center items-center' name='discarded' id='discarded'>
                                    <form class=' text-center items-center' name='discarded' id='discarded'>" ?>
                                        <select class="bg-green-500" name="discarded" onChange="autoSubmit();">
                                            <option class="text-black border-transparent" value="$discarded" hidden><?php 
                                                if ($discarded == '0') {echo "On-Stock";}
                                                if ($discarded == '1') {echo "Discarded";}
                                            ?></option>
                                            <option class="text-black dark:text-white bg-slate-300 dark:bg-slate-800" value="0">On-Stock</option>
                                            <option class="text-black dark:text-white bg-slate-300 dark:bg-slate-800" value="1">Discarded</option>
                                        </select>
                                    </form>
                                </form>
                            <?php ;
                        }
                    ?>
                </div>
                <?php
                    // table rows
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "
                                <form class='flex h-8 2xl:h-12 w-90 md:w-4/5 lg:w-3/5 xl:w-2/4 2xl:w-5/12 m-auto mt-2 items-center backdrop-blur-sm bg-white/80 dark:bg-slate-800/50 rounded-xl' action='equipments/data.php' method='POST'>
                                    <div class='w-4 md:w-8'>";
                                        if($row['status'] == 0){
                                            echo"<div class='border-l-solid border-l-8 border-green-400 w-0 h-8 2xl:h-12'></div>";
                                        } else if ($row['status']== 1){
                                            echo"<div class='border-l-solid border-l-8 border-red-600 w-0 h-8 2xl:h-12'></div>";
                                        } else if ($row['status'] == 2){
                                            echo"<div class='border-l-solid border-l-8 border-yellow-300 w-0 h-8 2xl:h-12'></div>";
                                        }else {
                                            echo"Err.";
                                        }
                                    $cleaned = preg_replace('/^0+/', '', $row['no']);
                                    echo "</div>
                                    <div class='dark:text-white w-24 text-center'>{$cleaned}</div>
                                    <div class='dark:text-white w-24 text-center'>{$row['room']}</div>
                                    <div class='hidden md:block dark:text-white w-72 text-center'>{$row['uid']}</div>";
                                    if($_SESSION['level'] == '4' || $_SESSION['p5.2'] == '1'){ echo"
                                        <div class='flex-1'></div>
                                        <div class='flex-1'><button data-modal-target='EditBed' data-modal-show='EditBed' class='bg-[url(../resources/pencil.png)] bg-cover  w-6 h-6 mt-1' type='button'></button></div>
                                        <div class='flex-1'><button data-modal-target='DeleteBed' data-modal-show='DeleteBed' class='bg-[url(../resources/trash.png)] bg-cover  w-6 h-6 mt-1' type='button'></button></div>
                                    ";} else {echo"
                                        <div class='flex-1'>{$row['uid']}</div>
                                    ";}echo"
                                </form>
                            ";
                        }
                    } else {
                        echo"<div class='flex h-8 2xl:h-12 w-90 md:w-4/5 lg:w-3/5 xl:w-2/4 2xl:w-5/12 m-auto mt-2 items-center backdrop-blur-sm bg-white/80 dark:bg-slate-800/50 dark:text-white rounded-xl'><div class='m-auto'>No Data</div></div>";
                    }
                    if ($totalPages != 1) {
                        echo "<div class='h-8 w-90 md:w-4/5 lg:w-3/5 xl:w-2/4 2xl:w-5/12 m-auto mt-2'>";
                        $prev = $page - 1;
                        $next = $page + 1;
                        echo "<nav aria-label='Page navigation example'>
                                <ul class='inline-flex -space-x-px text-base h-10'>";
                        if($page > 1){
                            echo "<li><a href='?search=$search&page=$prev&sort=$sortColumn&order=$sortOrder' class='flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white'>Previous</a></li>";
                        }
                        for ($i = 1; $i <= $totalPages; $i++) {
                            $activeClass = $i === $page ? 'active' : '';
                            if ($page == $i) {
                                echo "<li><a href='?search=$search&page=$i&sort=$sortColumn&order=$sortOrder' class='flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-green border border-green-300 hover:bg-green-100 hover:text-gray-700 dark:bg-green-800 dark:border-green-700 dark:text-gray-400 dark:hover:bg-green-700 dark:hover:text-white'>$i</a></li>";
                            } else {
                                echo "<li><a href='?search=$search&page=$i&sort=$sortColumn&order=$sortOrder' class='flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white'>$i</a></li>";
                            }
                        }
                        if($page < $totalPages){
                            echo "<li><a href='?search=$search&page=$next&sort=$sortColumn&order=$sortOrder' class='flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white'>Next</a></li>";
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
        
        function autoSubmit() {
            var formObject = document.forms['discarded'];
            formObject.submit();
        }
    </script>
</body>
</html>