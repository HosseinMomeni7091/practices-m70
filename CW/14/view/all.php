<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Document</title>
</head>

<body>
    <p>Hell all page</p>
    <?php
    echo '<pre>';
    print_r($list);
    echo '</pre>' . '<br>';
    ?>
    <!-- Table -->
    <div class=" mx-10 my-10 border-solid  border-2 w-3/4 relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <tr class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <th scope="col" class="px-6 py-3">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Subject
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Deadline
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Color
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Description
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <a href="#">Edit</a>
                    </th>
                </tr>
            <tbody>
                <?php
                    foreach ($list as $key => $value) {
                        ?>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            <?php
                            echo $value["ID"];
                            ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php
                            echo $value["Subject"];
                            ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php
                            echo $value["Deadline"];
                            ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php
                            echo $value["Color"];
                            ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php
                            echo $value["Description"];
                            ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php
                            echo $value["Status"];
                            ?>
                        </td>
                        <td scope="col" class="px-6 py-3">
                            <a href="#">Edit</a>
                        </td>
                    </tr>

                        <!-- End of foreach -->
                    <?php
                    }
                    ?>

            </tbody>
        </table>
    </div>

</body>

</html>