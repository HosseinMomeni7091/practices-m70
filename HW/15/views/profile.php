<?php

use core\Application;

echo '<pre>';
print_r(Application::$app->user);
echo '</pre>' . '<br>';
echo '<pre>';
print_r(Application::$app->user->ID);
echo '</pre>' . '<br>';
echo '<pre>';
print_r($list);
echo '</pre>' . '<br>';


?>

<div>
    <div class="w-64 mx-auto text-center text-black text-bold text-2xl">
        Profile Information
    </div>
    <form action="../doctor/saveprofile" method="post" class="ml-4 mr-12" enctype="multipart/form-data">
        <div class="mb-2">
            <label for="Medical" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Medical Registeration Code</label>
            <input type="text" name="medical_licence" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required>
        </div>
        <div class="mb-2">
            <label for="Field" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Field</label>
            <input type="text" name="working_field" id="password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required>
        </div>
        <div class="mb-2">
            <label for="graduated_university" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">university</label>
            <input type="text" name="graduated_university" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required>
        </div>
        <div class="mb-2">
            <label for="Exprience" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Exprience</label>
            <input type="text" name="exprience" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required>
        </div>
        <div class=" mb-2">
            <label for="Exprience" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Degree</label>
            <div class="mb-3 xl:w-96">
                <select class="form-select appearance-none block w-full px-3 py-1.5 text-base  font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example" name="degree">
                    <option selected>Open this select menu</option>
                    <option value="BS">BS</option>
                    <option value="Msc">Msc</option>
                    <option value="Phd">Phd</option>
                </select>
            </div>
        </div>
        <div class=" mb-2">
            <label for="Department" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Department</label>
            <div class="mb-3 xl:w-96">
                <select class="form-select appearance-none block w-full px-3 py-1.5 text-base  font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" name="department" aria-label="Default select example">
                    <option selected>Open this select menu</option>
                    <?php
                    foreach ($list as $key => $value) {
                    ?>
                        <option value="<?php echo $value["ID"] ?>">
                            <?php echo $value["name"]; ?>
                        </option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="mb-2">
            <label class="block text-sm font-medium text-gray-700"> Photo </label>
            <input type='file' class="rounded-md" name="image" />
        </div>

</div>
<button class="ml-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update Profile</button>

</form>
</div>