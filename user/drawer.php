<?php
    //start session
    session_start();
    //check if logged in
    if (!isset($_SESSION['staff_id'])) {
        header("location: login.php");
    }
?>
<div id="logOut" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="logOut">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to Log Out?</h3>
                <a href="/hams-new/user/logout.php" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                    Yes, I'm sure
                </a>
                <button data-modal-hide="logOut" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
            </div>
        </div>
    </div>
</div>
<div id="navbar" class="fixed top-0 left-0 z-40 h-screen p-4 overflow-y-none transition-transform -translate-x-full backdrop-blur-md bg-white/45 w-80 dark:bg-black/45 dark:text-white" tabindex="-1" aria-labelledby="drawer-label">
    <div class="flex items-center"><div class="bg-[url('../resources/AMC.png')] bg-contain bg-no-repeat bg-center h-12 w-12"></div><h5 class="font-bold"><?php echo $_SESSION['usr'];?></h5>
        <button type="button" data-drawer-hide="navbar" aria-controls="navbar" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white" >
            <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
            <span class="sr-only">Close menu</span>
        </button>
    </div>

    <?php
        if ($_SESSION['level'] == '4' || $_SESSION['p8'] == '1') {
            ?><a class="flex items-center h-12" href="/hams-new/user/approval.php"><div class="w-screen px-12 font-bold block md:bg-[url('../resources/checkbox.png')] md:dark:bg-[url('../resources/dark/checkbox.png')] bg-no-repeat bg-contain">Approval</div></a><?php
        }
    ?>
    <?php
        if ($_SESSION['level'] == '4' || $_SESSION['p9'] == '1') {
            ?><a class="flex items-center h-12" href="/hams-new/user/types.php"><div class="w-screen px-12 font-bold block md:bg-[url('../resources/category.png')] md:dark:bg-[url('../resources/dark/category.png')] bg-no-repeat bg-contain">Types</div></a><?php
        }
    ?>
    <a class="flex items-center h-12" href="/hams-new/user/staff.php"><div class="w-screen px-12 font-bold block md:bg-[url('../resources/staff.png')] md:dark:bg-[url('../resources/dark/staff.png')] bg-no-repeat bg-contain">Staff</div></a>
    <a class="flex items-center h-12" href="/hams-new/user/medicine.php"><div class="w-screen px-12 font-bold block md:bg-[url('../resources/medicine.png')] md:dark:bg-[url('../resources/dark/medicine.png')] bg-no-repeat bg-contain">Medicine</div></a>
    <a class="flex items-center h-12" href="/hams-new/user/equipments.php"><div class="w-screen px-12 font-bold block md:bg-[url('../resources/equipment.png')] md:dark:bg-[url('../resources/dark/equipment.png')] bg-no-repeat bg-contain">Equipments</div></a>
    <a class="flex items-center h-12" href="/hams-new/user/rooms.php"><div class="w-screen px-12 font-bold block md:bg-[url('../resources/room.png')] md:dark:bg-[url('../resources/dark/room.png')] bg-no-repeat bg-contain">Rooms</div></a>
    <a class="flex items-center h-12" href="/hams-new/user/beds.php"><div class="w-screen px-12 font-bold block md:bg-[url('../resources/bed.png')] md:dark:bg-[url('../resources/dark/bed.png')] bg-no-repeat bg-contain">Beds</div></a>
    <?php
        if ($_SESSION['level'] == '4' || $_SESSION['p7'] == '1') {
            ?><a class="flex items-center h-12" href="/hams-new/user/uid.php"><div class="w-screen px-12 font-bold block md:bg-[url('../resources/barcode.png')] md:dark:bg-[url('../resources/dark/barcode.png')] bg-no-repeat bg-contain">UID</div></a><?php
        }
    ?>
    <a class="flex items-center h-12" href="/hams-new/user/scanner.php"><div class="w-screen px-12 font-bold block md:bg-[url('../resources/qr-scan.png')] md:dark:bg-[url('../resources/dark/qr-scan.png')] bg-no-repeat bg-contain">Scanner</div></a>
    <a class="flex items-center h-4 md:hidden" ><div class="w-screen px-12 font-bold"></div></a>
    <div class="grid grid-cols-2 gap-4">
        <button id="toggleDarkMode" class="px-4 py-2 text-white bg-slate-700 rounded-lg hover:bg-slate-600 focus:ring-4 focus:ring-slate-300 dark:bg-slate-400 dark:hover:bg-slate-300 focus:outline-none dark:focus:ring-slate-500">Dark Mode</button>
        <button data-modal-target='logOut' data-modal-show='logOut' class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-green-500 rounded-lg hover:bg-green-600 focus:ring-4 focus:ring-green-300 dark:bg-green-700 dark:hover:bg-green-800 focus:outline-none dark:focus:ring-green-900">Log out
            <div class="bg-[url('../resources/exit.png')] ml-4 bg-contain bg-no-repeat bg-center h-6 w-6"></div>
        </button>
   </div>
</div>

<script>
    //dakrmode script
    if (localStorage.getItem('theme') === 'dark') {
      document.documentElement.classList.add('dark');
    }

    // JavaScript to toggle dark mode and save preference
    const toggleDarkMode = document.getElementById('toggleDarkMode');
    toggleDarkMode.addEventListener('click', () => {
        const html = document.documentElement;

        // Toggle the dark class
        html.classList.toggle('dark');

        // Save the current theme to localStorage
        if (html.classList.contains('dark')) {
          localStorage.setItem('theme', 'dark');
        } else {
          localStorage.setItem('theme', 'light');
        }
    });
</script>