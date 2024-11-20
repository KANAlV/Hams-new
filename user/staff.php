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
    <title>Home</title>
</head>
<body class="bg-slate-200 dark:bg-slate-800 font-sans m-0 fixed overflow-x-scroll">
    <?php include "navbar.php";?>   
    <div class="sm:flex">
        <div id="topbar" class="flex w-screen md:w-16 bg-white h-16 sm:h-screen">
            <div class="w-18">
                <button data-drawer-target="navbar" data-drawer-show="navbar" aria-controls="navbar" class="block text-slate-700 font-bold rounded-lg text-4xl px-5 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">=</button>
            </div>
            <div class="flex items-center">
                <div class="w-screen font-bold md:hidden landscape:hidden">HAMS</div>
            </div>
        </div>
        <!-- Main container -->
        <div id="container" class="md:inline-block bg-[url('../resources/mbg.jpg')] bg-center sm:bg-[url('../resources/bg.jpg')] bg-cover h-screen w-screen">
            <div class="backdrop-blur-md bg-slate-300/30 w-screen h-screen">
                <div class="flex w-96 bg-white m-auto">
                    <div class='w-4'></div>
                    <div class="w-14"><a href="?search=<?php echo $search; ?>&page=<?php echo $page; ?>&sort=surname&order=<?php echo $sortColumn === 'surname' && $sortOrder === 'ASC' ? 'DESC' : 'ASC'; ?>">Name</a></div>
                    <div class=""><a href="?search=<?php echo $search; ?>&page=<?php echo $page; ?>&sort=date_added&order=<?php echo $sortColumn === 'date_added' && $sortOrder === 'ASC' ? 'DESC' : 'ASC'; ?>">Date Added</a></div>
                </div>
                <?php
                    // table rows
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $timestamp = $row['date_added'];
                            $date = date("Y-m-d", strtotime($timestamp));
                            echo "
                                <form class='flex h-6 w-96 m-auto mt-2 items-center backdrop-blur-sm bg-white/80 rounded-xl' action='/staff/edit.php' method='POST'>
                                        <div class='w-4'>";
                                            if($row['status'] == 1){
                                                echo"<div class='border-l-solid border-l-8 border-green-400 w-0 h-6'></div>";
                                            } else if ($row['status']== 0){
                                                echo"<div class='border-l-solid border-l-8 border-red-600 w-0 h-6'></div>";
                                            } else if ($row['status'] == 2){
                                                echo"<div class='border-l-solid border-l-8 border-yellow-300 w-0 h-6'></div>";
                                            }else {
                                                echo"Err.";
                                            }
                                        echo "</div>
                                        <div class='r3'>{$row['surname']}, {$row['first_name']} {$row['m_i']}. {$row['prefix']}</div>
                                        <div class='r7'>$date</div>
                                ";if ($_SESSION['level'] == '4' || $_SESSION['p1'] == '1') {
                                    echo "
                                        <input hidden name='id' value='{$row['staff_id']}'>
                                        <input hidden name='surname' value='{$row['surname']}'>
                                        <input hidden name='first_name' value='{$row['first_name']}'>
                                        <div class='r8'><button class='bg-[url(../resources/pencil.png)] bg-cover  w-4 h-4' type='submit'></button></div>
                                    ";
                                } echo "
                                </form>
                            ";
                        }
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>