<div class="text-left font-bold text-black mx-4 text-xl">
    Departments
</div>
<div class=" relative overflow-x-auto shadow-md sm:rounded-lg mx-4">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-black uppercase  backdrop-blur-md bg-amber-400/30 ">
            <tr>
                <th scope="col" class="px-6 py-3">
                    No.
                </th>
                <th scope="col" class="px-6 py-3">
                    Department Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Edit name
                </th>
                <th scope="col" class="px-6 py-3 ">
                    Delete
                </th>

            </tr>
        </thead>
        <tbody class="backdrop-blur-md bg-stone-600/30 text-black ">
            <tr class=" border-b dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-black whitespace-nowrap">
                    1
                </th>
                <td class="px-6 py-4">
                    Dep1
                </td>
                <td class="px-6 py-4">
                    <form class="flex flex-row justify-start" action="#">
                        <input  class="w-32 h-6 mr-2 rounded-md backdrop-blur-md bg-amber-200/30" type="text" name="editename">
                        <button class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</button>
                    </form>
                </td>
                <td class="px-6 py-4 font-medium text-blue-600 dark:text-blue-500 hover:underline">
                    Delete
                </td>
            </tr>
            <tr class="border-b text-black">
                <th scope="row" class="px-6 py-4 font-medium text-black whitespace-nowrap">
                    2
                </th>
                <td class="px-6 py-4">
                    Dep2
                </td>
                <td class="px-6 py-4">
                    <form class="flex flex-row justify-start" action="#">
                        <input  class="w-32 h-6 mr-2 rounded-md backdrop-blur-md bg-amber-200/30" type="text" name="editename">
                        <button class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</button>
                    </form>
                </td>
                <td class="px-6 py-4 font-medium text-blue-600 dark:text-blue-500 hover:underline">
                    Delete
                </td>
            </tr>
            <tr class="">
                <th scope="row" class="px-6 py-4 font-medium text-black whitespace-nowrap">
                    3
                </th>
                <td class="px-6 py-4">
                    Dep3
                </td>
                <td class="px-6 py-4">
                    <form class="flex flex-row justify-start" action="#">
                        <input  class="w-32 h-6 mr-2 rounded-md backdrop-blur-md bg-amber-200/30" type="text" name="editename">
                        <button class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</button>
                    </form>
                </td>
                <td class="px-6 py-4 font-medium text-blue-600 dark:text-blue-500 hover:underline">
                    Delete
                </td>
            </tr>
        </tbody>
    </table>
</div>
<div class="mx-4 my-4 p-2 backdrop-blur-md bg-amber-400/30 rounded-md w-1/2">
    <p class="font-bold text-2xl text-left text-black">Create New department</p>
    <form action="" method="post">
        <label class="text-bold text-black text-xl " for="name">Department Name</label>
        <input class="rounded-md px-2 py-2" type="text" name="name">
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full"> Create </button>
    </form>
</div>