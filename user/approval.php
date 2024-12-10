<?php
    include "dbcon.php";

    error_reporting(E_ERROR | E_PARSE);

    $toggle = "";
    if(isset($_GET["toggle"]))
    { $toggle = $_GET["toggle"]; }
    else{$toggle = "pending";}

    $recordsPerPage = 10;
                $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
                $offset = ($page - 1) * $recordsPerPage;
                
                $search = isset($_GET['search']) ? $_GET['search'] : '';
                $sortColumn = isset($_GET['sort']) ? $_GET['sort'] : 'date_added';
                $sortOrder = isset($_GET['order']) && strtoupper($_GET['order']) === 'ASC' ? 'ASC' : 'DESC';

            if ($toggle == "pending") {
                $sql = "SELECT * FROM `requests` WHERE 
                        `approved` = '0' AND
                        (`req_by` LIKE '%$search%' OR
                        `date_added` LIKE '%$search%')
                        GROUP BY `req_by`, `date_added`
                        ORDER BY $sortColumn $sortOrder
                        LIMIT $offset, $recordsPerPage";

                $result = mysqli_query($conn, $sql);

                $totalRecordsQuery = "SELECT COUNT(DISTINCT `req_by`, `date_added`) AS total 
                                    FROM `requests` 
                                    WHERE `approved` = '0' AND
                                            (`req_by` LIKE '%$search%' OR
                                            `date_added` LIKE '%$search%')";
                $totalRecordsResult = mysqli_query($conn, $totalRecordsQuery);
                $totalRecords = mysqli_fetch_assoc($totalRecordsResult)['total'];
                $totalPages = ceil($totalRecords / $recordsPerPage);
            }

            if ($toggle == "approved") {
                $sql = "SELECT * FROM `requests` WHERE 
                        `approved` = '1' AND
                        (`req_by` LIKE '%$search%' OR
                        `date_added` LIKE '%$search%')
                        GROUP BY `req_by`, `date_added`
                        ORDER BY $sortColumn $sortOrder
                        LIMIT $offset, $recordsPerPage";

                $result = mysqli_query($conn, $sql);

                $totalRecordsQuery = "SELECT COUNT(DISTINCT `req_by`, `date_added`) AS total 
                                    FROM `requests` 
                                    WHERE `approved` = '1' AND
                                            (`req_by` LIKE '%$search%' OR
                                            `date_added` LIKE '%$search%')";
                $totalRecordsResult = mysqli_query($conn, $totalRecordsQuery);
                $totalRecords = mysqli_fetch_assoc($totalRecordsResult)['total'];
                $totalPages = ceil($totalRecords / $recordsPerPage);
            }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="../node_modules/flowbite/dist/flowbite.min.js"></script>
    <title>Home</title>
</head>
<body class="">
    <?php include "drawer.php";?>   
    <div class="sm:flex bg-[url('../resources/mbg.jpg')] bg-center sm:bg-[url('../resources/bg.jpg')] bg-cover font-sans m-0 fixed overflow-x-scroll">
        <?php include "navbar.php";?> 
        <!-- Main container -->
        <div id="container" class="md:inline-block bg-fit bg-no-repeat h-screen w-screen">
            <div class="backdrop-blur-md bg-slate-300/30 dark:bg-slate-800/50 w-screen h-screen">
            <div class="p-2 md:h-32 w-full items-center text-center"><h1 class="hidden md:block font-bold text-2xl dark:text-white">approval</h1><br>
                    <form method="GET" class="flex w-min m-auto rounded-full bg-white/60 backdrop-blur-md">
                        <div class="bg-[url('../resources/loupe.png')] bg-contain bg-no-repeat bg-center h-6 w-10 m-auto invert dark:invert-0"></div>
                        <input type="hidden" name="toggle" value="<?php echo $toggle; ?>"/>
                        <input type="text" class="rounded-full bg-white/0 border-none focus:outline-none focus:ring-0" name="search" placeholder="Search..." value="<?php echo $search; ?>">
                    </form>
                </div>
                <div class="flex h12 md:h-8 2xl:h-12 w-90 md:w-4/5 lg:w-3/5 xl:w-2/4 2xl:w-5/12 items-center bg-green-500 text-white m-auto rounded-lg">
                    <div class='flex-1 font-bold text-center'><a href="?search=<?php echo $search; ?>&page=<?php echo $page; ?>&toggle=<?php echo $toggle; ?>&sort=req_by&order=<?php echo $sortColumn === 'req_by' && $sortOrder === 'ASC' ? 'DESC' : 'ASC'; ?>">Requested By</a></div>
                    <div class='flex-1 font-bold text-center'><a href="?search=<?php echo $search; ?>&page=<?php echo $page; ?>&toggle=<?php echo $toggle; ?>&sort=date_added&order=<?php echo $sortColumn === 'date_added' && $sortOrder === 'ASC' ? 'DESC' : 'ASC'; ?>">Date Added</a></div>
                    <form name='toggle' id='toggle' class="flex-1 block md:flex">
                        <select class="bg-green-500" name="toggle" onChange="autoSubmit();">
                                <option class="text-black border-transparent" value="$discarded" hidden><?php 
                                    if ($toggle == 'pending') {echo "Pending";}
                                    if ($toggle == 'approved') {echo "Approved";}
                                ?></option>
                                <option class="text-black dark:text-white bg-slate-300 dark:bg-slate-800" value="pending">Pending</option>
                                <option class="text-black dark:text-white bg-slate-300 dark:bg-slate-800" value="approved">Approved</option>
                            </select>
                    </form>
                </div>
                <div class="h-24rem md:h-max overflow-y-auto">
                <?php
                    // table rows
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "
                                <form class='flex h-12 md:h-8 2xl:h-12 w-90 md:w-4/5 lg:w-3/5 xl:w-2/4 2xl:w-5/12 m-auto mt-2 items-center backdrop-blur-sm bg-white/80 dark:bg-slate-800/50 rounded-xl' action='approval/items.php' method='POST'>
                                    <div class='dark:text-white flex-1 text-center'>{$row['req_by']}</div>
                                    <div class='dark:text-white flex-1 text-center'>{$row['date_added']}</div>
                                        <input type='text' name='req_by' value='{$row['req_by']}' hidden readonly>
                                        <input type='text' name='date_added' value='{$row['date_added']}' hidden readonly>
                                        <input type='text' name='show' value='{$toggle}' hidden readonly>
                                    <div class='flex-1 text-center'><button class='bg-[url(../resources/angle-double-left.png)] bg-cover  w-4 h-4' type='submit'></button></div>
                                </form>
                            ";
                        }
                    } else {
                        echo"<div class='flex h-8 2xl:h-12 w-90 md:w-4/5 lg:w-3/5 xl:w-2/4 2xl:w-5/12 m-auto mt-2 items-center backdrop-blur-sm bg-white/80 dark:bg-slate-800/50 dark:text-white rounded-xl'><div class='m-auto'>No Data</div></div>";
                    } echo "</div>";
                    if ($totalPages != 1) {
                        echo "<div class='h-8 w-90 md:w-4/5 lg:w-3/5 xl:w-2/4 2xl:w-5/12 m-auto mt-2'>";
                        $prev = $page - 1;
                        $next = $page + 1;
                        echo "<nav aria-label='Page navigation example'>
                                <ul class='inline-flex -space-x-px text-base h-10'>";
                        if($page > 1){
                            echo "<li><a href='?search=$search&page=$prev&&toggle=$toggle&sort=$sortColumn&order=$sortOrder' class='flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white'>Previous</a></li>";
                        }
                        for ($i = 1; $i <= $totalPages; $i++) {
                            $activeClass = $i === $page ? 'active' : '';
                            if ($page == $i) {
                                echo "<li><a href='?search=$search&page=$i&&toggle=$toggle&sort=$sortColumn&order=$sortOrder' class='flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-green border border-green-300 hover:bg-green-100 hover:text-gray-700 dark:bg-green-800 dark:border-green-700 dark:text-gray-400 dark:hover:bg-green-700 dark:hover:text-white'>$i</a></li>";
                            } else {
                                echo "<li><a href='?search=$search&page=$i&&toggle=$toggle&sort=$sortColumn&order=$sortOrder' class='flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white'>$i</a></li>";
                            }
                        }
                        if($page < $totalPages){
                            echo "<li><a href='?search=$search&page=$next&&toggle=$toggle&sort=$sortColumn&order=$sortOrder' class='flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white'>Next</a></li>";
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
            var formObject = document.forms['toggle'];
            formObject.submit();
        }
    </script>
</body>
</html>