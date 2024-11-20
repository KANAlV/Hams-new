<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="../node_modules/flowbite/dist/flowbite.min.js"></script>
    <title>Home</title>
</head>
<body class="bg-slate-200 dark:bg-slate-800 font-sans">
    <?php include "navbar.php";?>   
    <div class="sm:flex">
        <div id="topbar" class="flex w-92 sm:w-16 bg-white h-16 sm:h-screen">
            <div class="w-18">
                <button data-modal-target="navbar" data-modal-show="navbar" class="block text-slate-700 font-bold rounded-lg text-4xl px-5 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">=</button>
            </div>
            <div class="flex items-center">
                <div class="w-screen font-bold landscape:hidden">HAMS</div>
            </div>
        </div>
        <!-- Main container -->
        <div id="container" class="sm:inline-block">

        </div>
    </div>
</body>
</html>