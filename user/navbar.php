<div id="topbar" class="flex w-screen sm:w-16 backdrop-blur-md bg-white/80 dark:bg-slate-700/80 h-16 sm:h-screen">
    <div class="w-18">
        <button data-drawer-target="navbar" data-drawer-backdrop="false" data-drawer-show="navbar" aria-controls="navbar" class="block md:hidden text-slate-700 dark:text-white font-bold rounded-lg text-4xl px-5 py-2 text-center" type="button">=</button>
        <div id="drawer-hover-trigger" class="hidden md:block h-max w-max px-2 justify-center">
            <div class="bg-[url('../resources/AMC.png')] mt-2 bg-contain bg-no-repeat bg-center h-12 w-12"></div>
            <div class="bg-[url('../resources/dashboard.png')] dark:bg-[url('../resources/dark/dashboard.png')] mt-4 ml-2 bg-contain bg-no-repeat bg-center h-8 w-8"></div>
            <?php
                if ($_SESSION['level'] == '4' || $_SESSION['p1'] == '1') {
                    ?><div class="bg-[url('../resources/checkbox.png')] dark:bg-[url('../resources/dark/checkbox.png')] mt-4 ml-2 bg-contain bg-no-repeat bg-center h-8 w-8"></div><?php
                }
            ?>
            <div class="bg-[url('../resources/staff.png')] dark:bg-[url('../resources/dark/staff.png')] mt-4 ml-2 bg-contain bg-no-repeat bg-center h-8 w-8"></div>
            <div class="bg-[url('../resources/heart.png')] dark:bg-[url('../resources/dark/heart.png')] mt-4 ml-2 bg-contain bg-no-repeat bg-center h-8 w-8"></div>
            <div class="bg-[url('../resources/medicine.png')] dark:bg-[url('../resources/dark/medicine.png')] mt-4 ml-2 bg-contain bg-no-repeat bg-center h-8 w-8"></div>
            <div class="bg-[url('../resources/equipment.png')] dark:bg-[url('../resources/dark/equipment.png')] mt-4 ml-2 bg-contain bg-no-repeat bg-center h-8 w-8"></div>
            <div class="bg-[url('../resources/room.png')] dark:bg-[url('../resources/dark/room.png')] mt-4 ml-2 bg-contain bg-no-repeat bg-center h-8 w-8"></div>
            <div class="bg-[url('../resources/bed.png')] dark:bg-[url('../resources/dark/bed.png')] mt-4 ml-2 bg-contain bg-no-repeat bg-center h-8 w-8"></div>
            <?php
                if ($_SESSION['level'] == '4' || $_SESSION['p7'] == '1') {
                    ?><div class="bg-[url('../resources/barcode.png')] dark:bg-[url('../resources/dark/barcode.png')] mt-4 ml-2 bg-contain bg-no-repeat bg-center h-8 w-8"></div><?php
                }
            ?>
            <div class="bg-[url('../resources/qr-scan.png')] dark:bg-[url('../resources/dark/qr-scan.png')] mt-4 ml-2 bg-contain bg-no-repeat bg-center h-8 w-8"></div>
        </div>
    </div>
    <div class="flex items-center">
        <div class="w-screen font-bold md:hidden landscape:hidden dark:text-white">HAMS</div>
    </div>
</div>