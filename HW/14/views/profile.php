<div>
    <div class="w-64 mx-auto text-center text-black text-bold text-2xl">
        Profile Information
    </div>
    <form action="" method="post">
        <div class="mb-2">
            <label for="Medical" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Medical Registeration Code</label>
            <input type="text" name="Medical" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required>
        </div>
        <div class="mb-2">
            <label for="Field" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Field</label>
            <input type="text" name="Field" id="password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required>
        </div>
        <div class="mb-2">
            <label for="university" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">university</label>
            <input type="text" name="university" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required>
        </div>
        <div class="mb-2">
            <label for="Exprience" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Exprience</label>
            <input type="text" name="Exprience" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required>
        </div>
        <div class=" mb-2">
            <label for="Exprience" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Degree</label>
            <div class="mb-3 xl:w-96">
                <select class="form-select appearance-none block w-full px-3 py-1.5 text-base  font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example">
                    <option selected>Open this select menu</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>
        </div>
        <div class=" mb-2">
            <label for="Department" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Department</label>
            <div class="mb-3 xl:w-96">
                <select class="form-select appearance-none block w-full px-3 py-1.5 text-base  font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" name="Department" aria-label="Default select example">
                    <option selected>Open this select menu</option>
                    <option name="Department" value="1">One</option>
                    <option name="Department" value="2">Two</option>
                    <option name="Department" value="3">Three</option>
                </select>
            </div>
        </div>
        <div class="mb-2">
            <label class="block text-sm font-medium text-gray-700"> Photo </label>
            <div class="mt-1 flex items-center">
                <span class="inline-block h-12 w-12 rounded-full overflow-hidden bg-gray-100">
                    <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </span>
                <div class="flex w-40 h-32 items-center justify-center bg-grey-lighter">
                    <label class="w-64 flex flex-col items-center px-1 py-1 ml-2 bg-white text-blue rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-blue hover:text-red-600">
                        <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                        </svg>
                        <span class="mt-2 text-base leading-normal">Select a file</span>
                        <input type='file' class="hidden" name="profilepicture" />
                    </label>
                </div>
            </div>
        </div>
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update Profile</button>

    </form>
</div>