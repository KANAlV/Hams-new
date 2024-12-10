<div id="addEquip" data-modal-backdrop='static' tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="addEquip">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <form action="equipments/add.php" method="POST">
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Add Equipments</h3>
                    <div class="block 2xl:flex">
                        <div class="relative m-2">
                            <input type="text" onkeypress="return isAlphaNumerical(event)" required id="name" name="name" class="block px-2.5 pb-2.5 pt-4 w-50 text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-green-500 focus:outline-none focus:ring-0 focus:border-green-600 peer" placeholder=" " />
                            <label for="name" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-700 px-2 peer-focus:px-2 peer-focus:text-green-600 peer-focus:dark:text-green-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Description</label>
                        </div>
                        <div class="relative m-2">
                            <input type="text" onkeypress="return isAlphaNumerical(event)" id="manufacturer" required name="manufacturer" class="block px-2.5 pb-2.5 pt-4 w-50 text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-green-500 focus:outline-none focus:ring-0 focus:border-green-600 peer" placeholder=" " />
                            <label for="manufacturer" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-700 px-2 peer-focus:px-2 peer-focus:text-green-600 peer-focus:dark:text-green-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Manufacturer</label>
                        </div>
                    </div>
                    <div class="block md:flex">
                        <div class="relative m-2">
                            <input type="date" id="expiry" name="expiry" class="block px-2.5 pb-2.5 pt-4 w-50 text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-green-500 focus:outline-none focus:ring-0 focus:border-green-600 peer" placeholder=" " />
                            <label for="expiry" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-700 px-2 peer-focus:px-2 peer-focus:text-green-600 peer-focus:dark:text-green-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Expiry</label>
                        </div>
                    </div>
                    <!-- Multi Select -->
                    <div class="block text-left md:ml-2">
                        <label class="dark:text-white">Type</label><button type="button" data-dropdown-toggle="dropdownSearch" data-dropdown-placement="bottom-start" class="bg-white/0 text-green-400 font-bold ml-4">+</button><br>
                        <div class="flex flex-wrap h-auto w-full max-h-32 overflow-y-auto dark:text-white border-t-0 border-l-0 border-r-0 border-b-2 border-green-500 bg-black/5 dark:bg-white/5 items-start gap-2">
                            <?php
                                $typeSql1 = "SELECT * FROM `types` WHERE `table` = 'equipments'";
                                $typeResult1 = mysqli_query($conn, $typeSql1);
                                if (mysqli_num_rows($typeResult1) > 0) {
                                    $xy = 1;
                                    while ($typeRow1 = mysqli_fetch_assoc($typeResult1)) {
                                        echo "
                                        <div id='tag$xy' class='hidden rounded-md bg-green-500 w-min px-2'>
                                            {$typeRow1["type"]}
                                            <button id='x$xy' onclick=\"toggleDiv('$xy')\" type='button' class='bg-white/0 text-green-900 inline-block ml-2'>X</button>
                                        </div>";
                                        $xy++;
                                    }
                                } else {
                                    // Optional: Add a message for when no data is found.
                                    echo "<p>No types found.</p>";
                                }
                            ?>
                        </div>
                    </div>
                    <!-- Dropdown menu -->
                    <?php include "types.php";?>
                    <div class="block mt-2 text-left md:block md:text-center md:mt-0">
                        <div><label class="dark:text-white">Amount</label></div>
                        <div><input name="amount" required type="number" onkeypress="return isNumberKey(event)" class="w-28 dark:text-white border-t-0 border-l-0 border-r-0 border-b-2 border-green-500 bg-black/5 dark:bg-white/5"/></div><br><br>
                    </div>
                    <button type="reset" onclick="resetDivs()" data-modal-hide="addEquip" type="button" class="py-2.5 px-5 ms-3 text-sm font-small text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-green-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Discard</button>
                    <button type="submit" class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-small rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">Save</button>
                    <script>
                        function isNumberKey(evt) {
                        var charCode = (evt.which) ? evt.which : evt.keyCode
                        if (charCode > 31 && (charCode < 48 || charCode > 57))
                            return false;
                        return true;
                        }

                        function isAlphaNumerical(event) {
                            const charCode = event.which || event.keyCode;
                            const char = String.fromCharCode(charCode);
                            const validPattern = /^[a-zA-Z0-9-_,.]$/;
                            if (!validPattern.test(char)) {
                                return false;
                            }
                            return true;
                        }

                        for (let i = 1; i <= 47; i++) {
                            const checkbox = document.getElementById(`CB${i}`);
                            const hiddenDiv = document.getElementById(`tag${i}`);
                            const checkDiv = document.getElementById(`type-${i}`);

                            if (checkbox && hiddenDiv) {
                                checkbox.addEventListener('change', () => {
                                    hiddenDiv.style.display = checkbox.checked ? 'flex' : 'none';
                                    checkDiv.style.display = checkbox.checked ? 'none' : 'flex';
                                });
                            }
                        }

                        function toggleDiv(id) {
                            const element1 = document.getElementById(`CB${id}`);
                            const element2 = document.getElementById(`tag${id}`);
                            const element3 = document.getElementById(`type-${id}`);
                            if (element1 && element1.type === 'checkbox') {
                                element1.checked = !element1.checked; // Toggles the checked state
                                element2.style.display = 'none';
                                element3.style.display = 'flex';
                            } else {
                                console.error(`Element with id "${id}" is not a checkbox or does not exist.`);
                            }
                        }

                        function resetDivs(){
                            for (let i = 1; i <= 47; i++) {
                                const hiddenDiv = document.getElementById(`tag${i}`);
                                const checkDiv = document.getElementById(`type-${i}`);
                                hiddenDiv.style.display = 'none';
                                checkDiv.style.display = 'flex';
                            }
                        }
                    </script>
                </form>
            </div>
        </div>
    </div>
</div>