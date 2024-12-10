<div id="dropdownSearch" class="z-10 hidden bg-white rounded-lg shadow w-80 dark:bg-gray-700">
    <ul class="flex flex-wrap h-48 w-full px-3 pb-3 overflow-y-auto overflow-x-hidden text-sm text-gray-700 dark:text-gray-200 gap-2" aria-labelledby="dropdownSearchButton">
        <?php
        $typeSql2 = "SELECT * FROM `types` WHERE `table` = 'medicine'";
        $typeResult2 = mysqli_query($conn, $typeSql2);
        if (mysqli_num_rows($typeResult2) > 0) {
            $yz = 1;
            while ($typeRow2 = mysqli_fetch_assoc($typeResult2)) {
                echo "
                <li id='type-$yz' class='flex basis-1/3'>
                    <div class='flex items-center ps-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600'>
                        <input id='CB$yz' name='CB$yz' type='checkbox' value='{$typeRow2["type"]}' class='hidden w-4 h-4 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500'>
                        <label for='CB$yz' class='w-24 h-18 pt-3 py-2 ms-2 text-sm font-small text-gray-900 rounded dark:text-gray-300'>{$typeRow2["type"]}</label>
                    </div>
                </li>";
                $yz++;
            }
        } else {
            echo "
            <li id='type-1' class='flex basis-1/3'>
                <div class='flex items-center ps-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600'>
                    No Data
                </div>
            </li>";
        }
        ?>
    </ul>
</div>
