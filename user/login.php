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
    <div class="flex w-screen h-screen">
        <div class="flex justify-center w-screen h-screen">
            <div class="rounded-2xl mt-24 w-80 h-80 bg-white justify-center">
                <div class="w-100 text-center font-bold text-2xl mt-8">Login</div><br>
                <div class="w-100 text-center">
                    <form action="session.php" method="POST">
                        <div class="text-left w-56 m-auto">
                            <label>USERNAME</label><br>
                            <input type="text" name="username" class="border-x-white border-t-white border-b-green-500 w-56" required>
                        </div>
                        <div class="text-left w-56 m-auto">
                            <label>PASSWORD</label><br>
                            <input type="password" name="password" class="border-x-white border-t-white border-b-green-500 w-56" required>
                        </div><br>
                        <button class="rounded-full bg-green-500 h-12 w-24 font-bold text-xl text-white">Log In</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>