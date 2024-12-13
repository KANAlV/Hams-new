<?php
    include "dbcon.php";
    error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
    $discarded = "";
    if(isset($_GET["discarded"]))
    { $discarded = $_GET["discarded"]; }
    else{$discarded = 0;}

    $recordsPerPage = 10;
    
    //ROOMS TABLE
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $recordsPerPage;
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $sortColumn = isset($_GET['sort']) ? $_GET['sort'] : 'room';
    $sortOrder = isset($_GET['order']) && strtoupper($_GET['order']) === 'DESC' ? 'DESC' : 'ASC';

    $sql = "SELECT * FROM `room` WHERE 
                `beds` LIKE '%$search%' OR
                `available` LIKE '%$search%' OR
                `room` LIKE '%$search%' OR
                `type` LIKE '%$search%' OR
                `status` LIKE '%$search%'
                ORDER BY $sortColumn $sortOrder
                LIMIT $offset, $recordsPerPage";

    $result = mysqli_query($conn, $sql);

    $totalRecordsQuery = "SELECT COUNT(*) AS total FROM `room` WHERE 
                                    `beds` LIKE '%$search%' OR
                                    `available` LIKE '%$search%' OR
                                    `room` LIKE '%$search%' OR
                                    `type` LIKE '%$search%' OR
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
        include "room/modals.php";
    ?>
    <div class="sm:flex bg-[url('../resources/mbg.jpg')] bg-center sm:bg-[url('../resources/bg.jpg')] bg-cover font-sans m-0 fixed overflow-x-scroll">
        <?php include "navbar.php";?> 
        <!-- Main container -->
        <div id="container" class="md:inline-block h-screen w-screen">
            <div class="backdrop-blur-md bg-slate-300/30 dark:bg-slate-800/50 w-screen h-screen">
                <div class="p-2 md:h-32 w-full items-center text-center"><?php 
                    if ($discarded == '0')  {echo "<h1 class='hidden md:block font-bold text-2xl dark:text-white'>";}
                    if ($discarded == '1') {echo "<h1 class='hidden md:block font-bold text-2xl dark:text-red-600'>";}
                ?>Rooms</h1><br>
                    <form method="GET" class="flex w-min m-auto rounded-full bg-white/60 backdrop-blur-md">
                        <div class="bg-[url('../resources/loupe.png')] bg-contain bg-no-repeat bg-center h-6 w-10 m-auto invert dark:invert-0"></div>
                        <input type="hidden" name="toggle" value="<?php echo $toggle; ?>"/>
                        <input type="text" class="rounded-full bg-white/0 border-none focus:outline-none focus:ring-0" name="search" placeholder="Search..." value="<?php echo $search; ?>">
                    </form>
                </div>
                <div class="flex h-12 w-90 md:w-4/5 lg:w-3/5 xl:w-2/4 2xl:w-5/12 items-center bg-green-500 text-white m-auto rounded-lg">
                    <div class='w-4 md:w-8'></div>
                    <div class="dark:text-white w-24 font-bold text-center"><a href="?search=<?php echo $search; ?>&page=<?php echo $page; ?>&sort=room&order=<?php echo $sortColumn === 'room' && $sortOrder === 'ASC' ? 'DESC' : 'ASC'; ?>">Room</a></div>
                    <div class="dark:text-white w-64 font-bold text-center"><a href="?search=<?php echo $search; ?>&page=<?php echo $page; ?>&sort=type&order=<?php echo $sortColumn === 'type' && $sortOrder === 'ASC' ? 'DESC' : 'ASC'; ?>">Type</a></div>
                    <div class="dark:text-white w-24 font-bold text-center"> <a href="?search=<?php echo $search; ?>&page=<?php echo $page; ?>&sort=beds&order=<?php echo $sortColumn === 'beds' && $sortOrder === 'ASC' ? 'DESC' : 'ASC'; ?>">Beds</a></div>
                    <div class="dark:text-white w-24 font-bold text-center"> <a href="?search=<?php echo $search; ?>&page=<?php echo $page; ?>&sort=available&order=<?php echo $sortColumn === 'available' && $sortOrder === 'ASC' ? 'DESC' : 'ASC'; ?>">Available</a></div>
                    <?php
                        if ($_SESSION['level'] == '3' || $_SESSION['p5.1'] == '1') {
                            echo "<div class='flex-1 flex text-center items-center' name='discarded' id='discarded'>" ?>
                                    <div class='flex-1'><button data-modal-target='addroom' data-modal-show='addroom' class='bg-[url(../resources/add.png)] bg-cover  w-6 h-6 mt-1' type='button'></button></div>
                                </div>
                            <?php ;
                        } else {
                            echo "<div class='flex-1 flex text-center items-center' name='discarded' id='discarded'></div>" ?>
                            <?php ;
                        }
                    ?>
                </div>
                <?php
                    // table rows
                    if (mysqli_num_rows($result) > 0) {
                        $xy = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<form class='flex h-8 2xl:h-12 w-90 md:w-4/5 lg:w-3/5 xl:w-2/4 2xl:w-5/12 m-auto mt-2 items-center backdrop-blur-sm bg-white/80 dark:bg-slate-800/50 rounded-xl' action='room/data.php' method='POST'>
                                    <div class='w-4 md:w-8'>";
                                        if($row['beds'] == 0){
                                            echo"<div class='border-l-solid border-l-8 border-black w-0 h-8 2xl:h-12'></div>";
                                        } else if ($row['beds'] == $row['available']){
                                            echo"<div class='border-l-solid border-l-8 border-green-400 w-0 h-8 2xl:h-12'></div>";
                                        } else if ($row['available'] == 0){
                                            echo"<div class='border-l-solid border-l-8 border-red-700 w-0 h-8 2xl:h-12'></div>";
                                        } else if ($row['available'] != $row['beds'] && $row['available'] != 0){
                                            echo"<div class='border-l-solid border-l-8 border-yellow-300 w-0 h-8 2xl:h-12'></div>";
                                        }else {
                                            echo"Err.";
                                        }
                                        $displayType = str_replace("_", " ", $row['type']);
                                    echo "</div>
                                    <div class='dark:text-white w-24 text-center'>{$row['room']}</div>
                                    <div class='dark:text-white w-64 text-center'>{$displayType}</div>
                                    <div class='dark:text-white w-24 text-center'>{$row['beds']}</div>
                                    <div class='dark:text-white w-24 text-center'>{$row['available']}</div>";
                                    if ($discarded == 1){}
                                    else{
                                    if($_SESSION['level'] == '4' || $_SESSION['p5.1'] == '1'){ echo"
                                        <div class='flex-1'></div>
                                        <input type='text' name='room' value='{$row['room']}' hidden>
                                        <input type='text' name='type' value='{$row['type']}' hidden>
                                        <input type='text' name='bedCount' value='{$row['beds']}' hidden>
                                        <input type='text' name='available' value='{$row['available']}' hidden>
                                        <div class='flex-1'><button class='bg-[url(../resources/pencil.png)] bg-cover  w-6 h-6 mt-1' type='submit'></button></div>
                                    ";} else {}}echo"
                                </form>
                            ";
                            $xy++;
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