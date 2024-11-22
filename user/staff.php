<?php
    include "dbcon.php";

    $recordsPerPage = 10;
                $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
                $offset = ($page - 1) * $recordsPerPage;
                
                $search = isset($_GET['search']) ? $_GET['search'] : '';
                $sortColumn = isset($_GET['sort']) ? $_GET['sort'] : 'surname';
                $sortOrder = isset($_GET['order']) && strtoupper($_GET['order']) === 'DESC' ? 'DESC' : 'ASC';

                $sql = "SELECT * FROM `staff` WHERE 
                `status` LIKE '%$search%' OR
                `occupation` LIKE '%$search%' OR
                `surname` LIKE '%$search%' OR
                `first_name` LIKE '%$search%' OR
                `m_i` LIKE '%$search%' OR
                `occupation` LIKE '%$search%' OR
                `date_added` LIKE '%$search%' OR
                `addedBy` LIKE '%$search%'
                ORDER BY $sortColumn $sortOrder
                LIMIT $offset, $recordsPerPage";

                $result = mysqli_query($conn, $sql);

                $totalRecordsQuery = "SELECT COUNT(*) AS total FROM `staff` WHERE 
                                    `status` LIKE '%$search%' OR
                                    `occupation` LIKE '%$search%' OR
                                    `surname` LIKE '%$search%' OR
                                    `first_name` LIKE '%$search%' OR
                                    `m_i` LIKE '%$search%' OR
                                    `occupation` LIKE '%$search%' OR
                                    `date_added` LIKE '%$search%' OR
                                    `addedBy` LIKE '%$search%'";
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
    <title>Staff</title>
</head>
<body class="bg-[url('../resources/mbg.jpg')] bg-center sm:bg-[url('../resources/bg.jpg')] bg-cover font-sans m-0 fixed overflow-x-scroll">
    <?php include "drawer.php";?>   
    <div class="sm:flex">
        <?php include "navbar.php";?> 
        <!-- Main container -->
        <div id="container" class="md:inline-block h-screen w-screen">
            <div class="backdrop-blur-md bg-slate-300/30 dark:bg-slate-800/50 w-screen h-screen">
                <div class="p-2 md:h-32 w-full items-center text-center"><h1 class="hidden md:block font-bold text-2xl dark:text-white">STAFF</h1><br>
                    <form method="GET" class="flex w-min m-auto rounded-full bg-white/60 backdrop-blur-md">
                        <div class="bg-[url('../resources/loupe.png')] bg-contain bg-no-repeat bg-center h-6 w-10 m-auto invert dark:invert-0"></div>
                        <input type="text" class="rounded-full bg-white/0 border-none focus:outline-none focus:ring-0" name="search" placeholder="Search..." value="<?php echo $search; ?>">
                    </form>
                </div>
                <div class="flex h-8 2xl:h-12 w-96 md:w-4/5 lg:w-3/5 xl:w-2/4 2xl:w-5/12 items-center bg-green-500 text-white m-auto rounded-lg">
                    <div class='w-4'></div>
                    <div class="w-48 xl:hidden text-center font-bold"><a href="?search=<?php echo $search; ?>&page=<?php echo $page; ?>&sort=surname&order=<?php echo $sortColumn === 'surname' && $sortOrder === 'ASC' ? 'DESC' : 'ASC'; ?>">Name</a></div>
                    <div class="hidden w-24 xl:block text-center font-bold"><a href="?search=<?php echo $search; ?>&page=<?php echo $page; ?>&sort=surname&order=<?php echo $sortColumn === 'surname' && $sortOrder === 'ASC' ? 'DESC' : 'ASC'; ?>">Surname</a></div>
                    <div class='hidden w-24 xl:block text-center font-bold'><a href="?search=<?php echo $search; ?>&page=<?php echo $page; ?>&sort=first_name&order=<?php echo $sortColumn === 'first_name' && $sortOrder === 'ASC' ? 'DESC' : 'ASC'; ?>">First Name</a></div>
                    <div class='hidden w-12 xl:block text-center font-bold'><a href="?search=<?php echo $search; ?>&page=<?php echo $page; ?>&sort=m_i&order=<?php echo $sortColumn === 'm_i' && $sortOrder === 'ASC' ? 'DESC' : 'ASC'; ?>">M.I.</a></div>
                    <div class='hidden w-12 xl:block text-center font-bold'></div>
                    <div class='hidden md:block w-32 font-bold text-center'><a href="?search=<?php echo $search; ?>&page=<?php echo $page; ?>&sort=occupation&order=<?php echo $sortColumn === 'occupation' && $sortOrder === 'ASC' ? 'DESC' : 'ASC'; ?>">Occupation</a></div>
                    <div class='hidden md:block w-32 font-bold text-center'><a href="?search=<?php echo $search; ?>&page=<?php echo $page; ?>&sort=addedBy&order=<?php echo $sortColumn === 'addedBy' && $sortOrder === 'ASC' ? 'DESC' : 'ASC'; ?>">Added By</a></div>
                    <div class="text-center font-bold"><a href="?search=<?php echo $search; ?>&page=<?php echo $page; ?>&sort=date_added&order=<?php echo $sortColumn === 'date_added' && $sortOrder === 'ASC' ? 'DESC' : 'ASC'; ?>">Date Added</a></div>
                    <?php
                        if ($_SESSION['level'] == '4' || $_SESSION['p1'] == '1') {
                            echo "<a class='flex-1 text-center items-center' href='staff/register.php'><button class='bg-[url(../resources/add.png)] bg-cover  w-6 h-6 mt-1' type='submit'></button></a>";
                        }
                    ?>
                </div>
                <?php
                    // table rows
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $timestamp = $row['date_added'];
                            $date = date("Y-m-d", strtotime($timestamp));
                            echo "
                                <form class='flex h-8 2xl:h-12 w-96 md:w-4/5 lg:w-3/5 xl:w-2/4 2xl:w-5/12 m-auto mt-2 items-center backdrop-blur-sm bg-white/80 dark:bg-slate-800/50 rounded-xl' action='staff/edit.php' method='POST'>
                                        <div class='w-4 md:w-8'>";
                                            if($row['status'] == 1){
                                                echo"<div class='border-l-solid border-l-8 border-green-400 w-0 h-8 2xl:h-12'></div>";
                                            } else if ($row['status']== 0){
                                                echo"<div class='border-l-solid border-l-8 border-red-600 w-0 h-8 2xl:h-12'></div>";
                                            } else if ($row['status'] == 2){
                                                echo"<div class='border-l-solid border-l-8 border-yellow-300 w-0 h-8 2xl:h-12'></div>";
                                            }else {
                                                echo"Err.";
                                            }
                                        echo "</div>
                                        <div class='dark:text-white w-48 xl:hidden'>{$row['surname']}, {$row['first_name']} {$row['m_i']}. {$row['suffix']}</div>
                                        <div class='dark:text-white w-24 hidden xl:block'>{$row['surname']}</div>
                                        <div class='dark:text-white w-24 hidden xl:block'>{$row['first_name']}</div>
                                        <div class='dark:text-white w-12 hidden xl:block text-center'>{$row['m_i']}</div>
                                        <div class='dark:text-white w-12 hidden xl:block text-center'>{$row['suffix']}</div>
                                        <div class='dark:text-white hidden md:block w-32 text-center'>{$row['occupation']}</div>
                                        <div class='dark:text-white hidden md:block w-32 text-center'>{$row['addedBy']}</div>
                                        <div class='dark:text-white'>$date</div>
                                ";if ($_SESSION['level'] == '4' || $_SESSION['p1'] == '1') {
                                    echo "
                                        <input type='text' hidden name='id' value='{$row['staff_id']}'>
                                        <div class='flex-1 text-center'><button class='bg-[url(../resources/pencil.png)] bg-cover  w-4 h-4' type='submit'></button></div>
                                    ";
                                } echo "
                                </form>
                            ";
                        }
                    }
                    if ($totalPages != 1) {
                        echo "<div class='h-8 w-96 md:w-4/5 lg:w-3/5 xl:w-2/4 2xl:w-5/12 m-auto mt-2'>";
                        $prev = $page - 1;
                        $next = $page + 1;
                        echo "<nav aria-label='Page navigation example'>
                                <ul class='inline-flex -space-x-px text-base h-10'>";
                        if($page > 1){
                            echo "<li><a href='?search=$search&page=$prev&sort=$sortColumn&order=$sortOrder' class='flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white'>Previous</a></li>";
                        }
                        for ($i = 1; $i <= $totalPages; $i++) {
                            $activeClass = $i === $page ? 'active' : '';
                            echo "<li><a href='?search=$search&page=$i&sort=$sortColumn&order=$sortOrder' class='flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white'>$i</a></li>";
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
    </script>
</body>
</html>