<div id="addType" data-modal-backdrop='static' tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-64 max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="addType">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <form action="type/add.php" method="POST">
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Add Type</h3>
                    <div class="block text-center">
                        <div class="relative m-1">
                            <input type="text" onkeypress="return isAlphaNumerical(event)" required id="type" name="type" class="block px-2.5 pb-2.5 pt-4 w-50 text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-green-500 focus:outline-none focus:ring-0 focus:border-green-600 peer" placeholder=" " />
                            <label for="type" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-700 px-2 peer-focus:px-2 peer-focus:text-green-600 peer-focus:dark:text-green-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Type</label>
                        </div>
                        <div class="relative m-1">
                            <select required id="table" name="table" class="block px-2.5 pb-2.5 pt-4 w-50 text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-green-500 focus:outline-none focus:ring-0 focus:border-green-600 peer">
                                <option class="text-gray-900 dark:text-gray-400 bg-slate-50 dark:bg-slate-700" value="medicine">Medicine</option>
                                <option class="text-gray-900 dark:text-gray-400 bg-slate-50 dark:bg-slate-700" value="equipments">Equipments</option>
                                <option class="text-gray-900 dark:text-gray-400 bg-slate-50 dark:bg-slate-700" value="Room">Room</option>
                            </select>
                            <label for="table" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-700 px-2 peer-focus:px-2 peer-focus:text-green-600 peer-focus:dark:text-green-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Table</label>
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
                    </div><br>
                    <button type="submit" class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-small rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>