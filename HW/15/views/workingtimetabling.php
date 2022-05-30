<div class="text-center font-bold text-black mx-4 text-xl backdrop-blur-md bg-amber-400/30  rounded-md my-2 p-2">
    Working Timetabling (please enter rounted hour such as 8 and 17 and etc.)
</div>
<div class=" relative overflow-x-auto shadow-md sm:rounded-lg mx-4">
    <form class="flex flex-col" action="../doctor/doctortime" method="post">
        <table class="  w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-black uppercase  backdrop-blur-md bg-amber-400/30 ">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Days
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Starting Time
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Ending Time
                    </th>
                </tr>
            </thead>
            <tbody class="backdrop-blur-md bg-stone-600/30 text-black ">
                <tr class=" border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-black whitespace-nowrap">
                        Monday
                    </th>
                    <td class="px-6 py-4">
                        <input class="px-2 w-32 rounded-md" type="text" name="mon_start">
                    </td>
                    <td class="px-6 py-4">
                        <input class="px-2 w-32 rounded-md" type="text" name="mon_end">
                    </td>
                </tr>
                <tr class=" border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-black whitespace-nowrap">
                        Tuesday
                    </th>
                    <td class="px-6 py-4">
                        <input class="px-2 w-32 rounded-md" type="text" name="tues_start">
                    </td>
                    <td class="px-6 py-4">
                        <input class="px-2 w-32 rounded-md" type="text" name="tues_end">
                    </td>
                </tr>
                <tr class=" border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-black whitespace-nowrap">
                        wednesday
                    </th>
                    <td class="px-6 py-4">
                        <input class="px-2 w-32 rounded-md" type="text" name="wendes_start">
                    </td>
                    <td class="px-6 py-4">
                        <input class="px-2 w-32 rounded-md" type="text" name="wendes_end">
                    </td>
                </tr>
                <tr class=" border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-black whitespace-nowrap">
                        Thursday
                    </th>
                    <td class="px-6 py-4">
                        <input class="px-2 w-32 rounded-md" type="text" name="thurs_start">
                    </td>
                    <td class="px-6 py-4">
                        <input class="px-2 w-32 rounded-md" type="text" name="thurs_end">
                    </td>
                </tr>
                <tr class=" border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-black whitespace-nowrap">
                        Friday
                    </th>
                    <td class="px-6 py-4">
                        <input class="px-2 w-32 rounded-md" type="text" name="fri_start">
                    </td>
                    <td class="px-6 py-4">
                        <input class="px-2 w-32 rounded-md" type="text" name="fri_end">
                    </td>
                </tr>
                <tr class=" border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-black whitespace-nowrap">
                        saturday
                    </th>
                    <td class="px-6 py-4">
                        <input class="px-2 w-32 rounded-md" type="text" name="sat_start">
                    </td>
                    <td class="px-6 py-4">
                        <input class="px-2 w-32 rounded-md" type="text" name="sat_end">
                    </td>
                </tr>
                <tr class=" border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-black whitespace-nowrap">
                        sunday
                    </th>
                    <td class="px-6 py-4">
                        <input class="px-2 w-32 rounded-md" type="text" name="sun_start">
                    </td>
                    <td class="px-6 py-4">
                        <input class="px-2 w-32 rounded-md" type="text" name="sun_end">
                    </td>
                </tr>
            </tbody>
        </table>
        <button class=" bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full my-2 mx-4 text-center w-32">Submit</button>
    </form>
</div>