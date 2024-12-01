<?php
    //start session
    session_start();
    //check if logged in
    if (isset($_SESSION['staff_id'])) {
        header("location: home.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="../node_modules/flowbite/dist/flowbite.min.js"></script>
    <title>login</title>
</head>
<body class="bg-slate-200 dark:bg-slate-800 font-sans bg-[url('../resources/mbg.jpg')] bg-center sm:bg-[url('../resources/bg.jpg')] bg-cover sm:bg-left background-size: cover;">
    <div class="w-screen h-screen overflow-hidden">
        <div class="w-full h-14 bg-white flex pl-6 font-bold">
            <div class="bg-[url('../resources/AMC.png')] bg-contain bg-no-repeat bg-center mt-1 h-12 w-12"></div>
            <div class="pt-3.5 pl-4">HAMS</div>
        </div>
        <div class="flex justify-center w-screen h-full">
            <div class="rounded-2xl mt-24 w-72 h-80 bg-white">
                <div class="w-100 text-center font-bold text-2xl mt-8">
                    <h1 class="text-2xl">Welcome Back!</h1>
                    <h3 class="text-base text-gray-500">login to your account</h3>
                </div>
                <div class="w-100 text-center">
                    <form action="session.php" method="POST">
                        <div class="m-auto w-min">
                            <div class="relative m-2">
                                <input type="text" onkeypress="return isAlphaNumerical(event)" required id="username" name="username" class="block px-2.5 pb-2.5 pt-4 w-50 text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-green-500 focus:outline-none focus:ring-0 focus:border-green-600 peer" placeholder=" " />
                                <label for="username" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-700 px-2 peer-focus:px-2 peer-focus:text-green-600 peer-focus:dark:text-green-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Username</label>
                            </div>
                            <div class="relative m-2">
                                <input type="password" onkeypress="return isAlphaNumerical(event)" required id="password" name="password" class="block px-2.5 pb-2.5 pt-4 w-50 text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-green-500 focus:outline-none focus:ring-0 focus:border-green-600 peer" placeholder=" " />
                                <label for="password" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-700 px-2 peer-focus:px-2 peer-focus:text-green-600 peer-focus:dark:text-green-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Password</label>
                            </div>
                        </div><br>
                        <button class="rounded-xl bg-green-500 h-12 w-24 font-bold text-xl text-white">Log In</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function isAlphaNumerical(event) {
            const charCode = event.which || event.keyCode;
            const char = String.fromCharCode(charCode);
            const validPattern = /^[a-zA-Z0-9-_,.]$/;
            if (!validPattern.test(char)) {
                return false;
            }
            return true;
        }
    </script>
</body>
</html>