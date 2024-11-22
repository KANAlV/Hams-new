<?php
    //start session
    session_start();
    //check if logged in
    if (!isset($_SESSION['staff_id'])) {
        header("location: login.php");
    }
?>
<div id="navbar" class="fixed top-0 left-0 z-40 h-screen p-4 overflow-y-none transition-transform -translate-x-full backdrop-blur-md bg-white/45 w-80 dark:bg-black/45 dark:text-white" tabindex="-1" aria-labelledby="drawer-label">
    <div class="flex items-center"><div class="bg-[url('../resources/AMC.png')] bg-contain bg-no-repeat bg-center h-12 w-12"></div><h5 class="font-bold"><?php echo $_SESSION['usr'];?></h5>
        <button type="button" data-drawer-hide="navbar" aria-controls="navbar" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white" >
            <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
            <span class="sr-only">Close menu</span>
        </button>
    </div>

    <a class="flex items-center h-12" href="/hams-new/user/home.php"><div class="w-screen px-12 font-bold block md:bg-[url('../resources/dashboard.png')] md:dark:bg-[url('../resources/dark/dashboard.png')] bg-no-repeat bg-contain">Home</div></a>
    <?php
        if ($_SESSION['level'] == '4' || $_SESSION['p8'] == '1') {
            ?><a class="flex items-center h-12" href="/hams-new/user/approval.php"><div class="w-screen px-12 font-bold block md:bg-[url('../resources/checkbox.png')] md:dark:bg-[url('../resources/dark/checkbox.png')] bg-no-repeat bg-contain">Approval</div></a><?php
        }
    ?>
    <a class="flex items-center h-12" href="/hams-new/user/staff.php"><div class="w-screen px-12 font-bold block md:bg-[url('../resources/staff.png')] md:dark:bg-[url('../resources/dark/staff.png')] bg-no-repeat bg-contain">Staff</div></a>
    <a class="flex items-center h-12" href="/hams-new/user/blood.php"><div class="w-screen px-12 font-bold block md:bg-[url('../resources/heart.png')] md:dark:bg-[url('../resources/dark/heart.png')] bg-no-repeat bg-contain">Blood</div></a>
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
        <a href="/hams-new/user/logout.php" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-green-500 rounded-lg hover:bg-green-600 focus:ring-4 focus:ring-green-300 dark:bg-green-700 dark:hover:bg-green-800 focus:outline-none dark:focus:ring-green-900">Log out
            <div class="bg-[url('../resources/exit.png')] ml-4 bg-contain bg-no-repeat bg-center h-6 w-6"></div>
        </a>
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