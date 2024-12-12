<?php
    include "../dbcon.php";

    if ($_SERVER["REQUEST_METHOD"] !== "POST") {

    }

    $uid = $_POST["uid"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Generator</title>
    <link rel="stylesheet" href="../style.css">
    <script src="../../node_modules/flowbite/dist/flowbite.min.js"></script>
    <script src="../../src/qrcode.min.js"></script>
    <script src="../../src/html2canvas.min.js"></script>
</head>
<body>
    <?php include "../drawer.php";
    ?>
    <div class="sm:flex bg-[url('../resources/mbg.jpg')] bg-center sm:bg-[url('../resources/bg.jpg')] bg-cover font-sans m-0 fixed overflow-x-scroll">
        <?php include "../navbar.php";?> 
        <!-- Main container -->
        <div id="container" class="md:inline-block h-screen w-screen">
            <div class="backdrop-blur-md bg-slate-300/30 dark:bg-slate-800/50 w-screen h-screen justify-center items-center">
                <br><br><br><h1 class="text-2xl font-bold text-center mb-4">UID QR-CODE</h1><br><br>
                <div id="box" class="bg-white shadow-lg rounded-lg p-8 w-full max-w-xs m-auto">
                    <h1 class="text-2xl font-bold text-center mb-4"><?php echo $uid;?></h1>

                    <!-- Input field for QR code text -->
                    <input type="hidden" id="qrInput" 
                        class="w-full px-4 py-2 border rounded-md focus:outline-none text-center mb-4" 
                        value="<?php echo $uid;?>" readonly>

                    <!-- QR Code Container -->
                    <div id="qrcode" class="flex justify-center items-center mt-6"></div>
                </div>
                
                <!-- Download Button -->
                <div class="text-center mt-4">
                    <button id="downloadBtn" class="bg-green-500 text-white px-4 py-2 rounded">Download as Image</button>
                </div>

                <script>
                    const input = document.getElementById("qrInput").value.trim();
                    const qrCodeContainer = document.getElementById("qrcode");

                    // Clear any existing QR code
                    qrCodeContainer.innerHTML = "";

                    if (input !== "") {
                        const canvas = document.createElement("canvas"); // Create a canvas element
                        qrCodeContainer.appendChild(canvas); // Append it to the container

                        QRCode.toCanvas(canvas, input, {
                            width: 200,
                            margin: 2
                        }, function (error) {
                            if (error) {
                                console.error(error);
                                alert("Failed to generate QR Code!");
                            }
                        });
                    } else {
                        alert("Please enter some text or a URL.");
                    }

                    // Download functionality
                    document.getElementById("downloadBtn").addEventListener("click", () => {
                        html2canvas(document.getElementById("box")).then(canvas => {
                            const link = document.createElement("a");
                            link.download = "<?php echo $uid;?>.png"; // Default filename
                            link.href = canvas.toDataURL(); // Convert canvas to image URL
                            link.click(); // Trigger the download
                        }).catch(error => {
                            console.error("Error capturing the div:", error);
                            alert("Failed to capture the image.");
                        });
                    });

                    //Trigger for hover duplicate[id="drawer-hover-trigger"]

                    const drawerElement = document.getElementById('navbar');
                    const drawerInstance = new Drawer(drawerElement, {
                    placement: 'left', // Can be 'left', 'right', 'top', or 'bottom'
                    backdrop: false,
                    });

                    // Hover Event Listeners
                    const trigger = document.getElementById('drawer-hover-trigger');

                    trigger.addEventListener('mouseover', () => {
                    drawerInstance.show(); // Show drawer on hover
                    });

                    drawerElement.addEventListener('mouseleave', () => {
                    drawerInstance.hide(); // Hide drawer on mouse leave
                    });
                    
                    function autoSubmit() {
                        var formObject = document.forms['discarded'];
                        formObject.submit();
                    }
                </script>
            </div>
        </div>
    </div>
</body>
</html>