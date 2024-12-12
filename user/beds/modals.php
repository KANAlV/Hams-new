<!-- add Modal -->
<div id="addBeds" data-modal-backdrop='static' tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-xs max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="addBeds">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <form action="beds/add.php" method="POST">
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Add Bed</h3>
                    <div class="block">
                        <div class="relative m-2">
                            <input type="text" onkeypress="return isAlphaNumerical(event)" required id="no" name="no" class="block px-2.5 pb-2.5 pt-4 w-50 text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-green-500 focus:outline-none focus:ring-0 focus:border-green-600 peer" placeholder=" " />
                            <label for="no" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-700 px-2 peer-focus:px-2 peer-focus:text-green-600 peer-focus:dark:text-green-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Bed No.</label>
                        </div>
                        <div class="relative m-2">
                            <select name='uid' required class="block px-2.5 pb-2.5 pt-4 w-50 text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-green-500 focus:outline-none focus:ring-0 focus:border-green-600 peer">
                                <option class='dark:bg-slate-800' value=''>--none--</option>
                                <?php
                                    $uidSql = "SELECT * FROM `uid` WHERE `assigned` IS NULL ORDER BY `uid` LIMIT 10";
                                    $uidResult = mysqli_query($conn, $uidSql);
                                    if (mysqli_num_rows($uidResult) > 0) {
                                        while ($uidRow = mysqli_fetch_assoc($uidResult)) { echo "
                                            <option class='dark:bg-slate-800' value='{$uidRow['uid']}'>{$uidRow['uid']}</option>
                                        ";}
                                    }
                                ?>
                            </select>
                            <label for='uid' class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-700 px-2 peer-focus:px-2 peer-focus:text-green-600 peer-focus:dark:text-green-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">UID:</label><br>
                        </div>
                    </div>
                    <button type="reset" data-modal-hide="addEquip" type="button" class="py-2.5 px-5 ms-3 text-sm font-small text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-green-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Discard</button>
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
                    </script>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- edit -->
<div id="EditBed" data-modal-backdrop='static' tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-xs max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="EditBed">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <form action="beds/add.php" method="POST">
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Edit Bed</h3>
                    <div class="block">
                        <input type="hidden" id='modal-id' value=""/>
                        <div class="relative m-2">
                            <input type="text" onkeypress="return isAlphaNumerical(event)" required id="modal-no" id="no" name="no" class="block px-2.5 pb-2.5 pt-4 w-50 text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-green-500 focus:outline-none focus:ring-0 focus:border-green-600 peer" placeholder=" " />
                            <label for="no" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-700 px-2 peer-focus:px-2 peer-focus:text-green-600 peer-focus:dark:text-green-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Bed No.</label>
                        </div>
                        <div class="relative m-2">
                            <select name='uid' id='modalUID' class="block px-2.5 pb-2.5 pt-4 w-50 text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-green-500 focus:outline-none focus:ring-0 focus:border-green-600 peer">
                                <option class='dark:bg-slate-800' value=''>--none--</option>
                                <?php
                                    $uidSql = "SELECT * FROM `uid` WHERE `assigned` IS NULL ORDER BY `uid` LIMIT 10";
                                    $uidResult = mysqli_query($conn, $uidSql);
                                    if (mysqli_num_rows($uidResult) > 0) {
                                        while ($uidRow = mysqli_fetch_assoc($uidResult)) { echo "
                                            <option class='dark:bg-slate-800' value='{$uidRow['uid']}'>{$uidRow['uid']}</option>
                                        ";}
                                    }
                                ?>
                            </select>
                            <label for='uid' class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-700 px-2 peer-focus:px-2 peer-focus:text-green-600 peer-focus:dark:text-green-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">UID:</label><br>
                        </div>
                    </div>
                    <button type="reset" data-modal-hide="addEquip" type="button" class="py-2.5 px-5 ms-3 text-sm font-small text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-green-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Discard</button>
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
                    </script>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- delete -->
<div id="DeleteBed" data-modal-backdrop='static' tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-xs max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="DeleteBed">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <form action="beds/delete.php" method="POST">
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Delete Bed</h3>
                    <svg class='mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200' aria-hidden='true' xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'>
                        <path stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z'/>
                    </svg>
                    <h3 class='mb-5 text-lg font-normal text-gray-500 dark:text-gray-400'>This action is not reversable! Dispose this Entry?<p class="text-gray-400">(note: this will still need approval!)</p></h3>
                    <input type="hidden" id='modalID' name="bed_id" value=""/>
                    <button data-modal-hide='deleteMed' type='submit' class='text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center'>
                        Yes, I'm sure
                    </button>
                    <button data-modal-hide='deleteMed' type='button' class='py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700'>No, cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>