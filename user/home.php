<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="../node_modules/flowbite/dist/flowbite.min.js"></script>
    <title>Home</title>
</head>
<body class="bg-slate-200/55 dark:bg-slate-800 font-sans m-0 fixed overflow-x-scroll">
    <?php include "navbar.php";?>   
    <div class="sm:flex">
        <div id="topbar" class="flex w-screen md:w-16 bg-white h-16 sm:h-screen">
            <div class="w-18">
                <button data-drawer-target="navbar" data-drawer-backdrop="false" data-drawer-show="navbar" aria-controls="navbar" class="block text-slate-700 font-bold rounded-lg text-4xl px-5 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">=</button>
            </div>
            <div class="flex items-center">
                <div class="w-screen font-bold md:hidden landscape:hidden">HAMS</div>
            </div>
        </div>
        <!-- Main container -->
        <div id="container" class="md:inline-block bg-[url('../resources/mbg.jpg')] bg-center sm:bg-[url('../resources/bg.jpg')] bg-cover h-screen w-screen">
            <div class="backdrop-blur-md bg-slate-300/30 w-screen h-screen">
                
            </div>
        </div>
    </div>
</body>
</html>