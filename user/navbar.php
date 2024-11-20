<?php
    //start session
    session_start();
    //check if logged in
    if (!isset($_SESSION['staff_id'])) {
        header("location: login.php");
    }
?>
<div id="navbar" class="fixed top-0 left-0 z-40 h-screen p-4 overflow-y-none transition-transform -translate-x-full bg-white w-80 dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-label">
    <h5 class="font-bold"><?php echo $_SESSION['usr'];?></h5>
    <button type="button" data-drawer-hide="navbar" aria-controls="navbar" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white" >
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
        </svg>
        <span class="sr-only">Close menu</span>
    </button>
      
    <a class="flex items-center h-12" href="home.php"><div class="w-screen px-8 font-bold">Home</div></a>
    <a class="flex items-center h-12" href="approval.php"><div class="w-screen px-8 font-bold">Approval</div></a>
    <a class="flex items-center h-12" href="staff.php"><div class="w-screen px-8 font-bold">Staff</div></a>
    <a class="flex items-center h-12" href="blood.php"><div class="w-screen px-8 font-bold">Blood</div></a>
    <a class="flex items-center h-12" href="medicine.php"><div class="w-screen px-8 font-bold">Medicine</div></a>
    <a class="flex items-center h-12" href="equipments.php"><div class="w-screen px-8 font-bold">Equipments</div></a>
    <a class="flex items-center h-12" href="rooms.php"><div class="w-screen px-8 font-bold">Rooms</div></a>
    <a class="flex items-center h-12" href="beds.php"><div class="w-screen px-8 font-bold">Beds</div></a>
    <a class="flex items-center h-12" href="uid.php"><div class="w-screen px-8 font-bold">UID</div></a>
    <a class="flex items-center h-12" href="scanner.php"><div class="w-screen px-8 font-bold">Scanner</div></a>
    <a class="flex items-center h-12 sm:hidden" ><div class="w-screen px-8 font-bold"></div></a>
    <div class="grid grid-cols-2 gap-4">
        <a href="#" class="px-4 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Learn more</a>
        <a href="logout.php" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Log Out <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
        </svg></a>
   </div>
</div>