<?php
    //start session
    session_start();
    //check if logged in
    if (!isset($_SESSION['staff_id'])) {
        header("location: login.php");
    }
?>
<div id="navbar" aria-hidden="true" class="hidden w-screen z-10">
    <div class="backdrop-blur-sm bg-white h-screen divide-gray-400 z-50">
        <div class="flex items-center w-screen h-12">
            <div class="w-3/4 px-4 font-bold text-lg">HAMS</div>
            <div class="w-1/4 px-4 font-bold text-lg text-right">
                <button data-modal-target="navbar" data-modal-hide="navbar" class="block text-slate-800 font-medium rounded-lg text-2xl px-5 py-2.5 text-center" type="button">
                    X
                </button>
            </div>
        </div>
        <a class="flex items-center w-screen h-12" href="home.php"><div class="w-screen px-8 font-bold">Home</div></a>
        <a class="flex items-center w-screen h-12" href="staff.php"><div class="w-screen px-8 font-bold">Approval</div></a>
        <a class="flex items-center w-screen h-12"><div class="w-screen px-8 font-bold">Staff</div></a>
        <a class="flex items-center w-screen h-12"><div class="w-screen px-8 font-bold">Blood</div></a>
        <a class="flex items-center w-screen h-12"><div class="w-screen px-8 font-bold">Medicine</div></a>
        <a class="flex items-center w-screen h-12"><div class="w-screen px-8 font-bold">Equipments</div></a>
        <a class="flex items-center w-screen h-12"><div class="w-screen px-8 font-bold">Rooms</div></a>
        <a class="flex items-center w-screen h-12"><div class="w-screen px-8 font-bold">Beds</div></a>
        <a class="flex items-center w-screen h-12"><div class="w-screen px-8 font-bold">UID</div></a>
        <a class="flex items-center w-screen h-12"><div class="w-screen px-8 font-bold">Scanner</div></a>
    </div>
</div>
