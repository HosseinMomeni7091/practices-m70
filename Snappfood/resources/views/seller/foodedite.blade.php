@extends("layout.seller")


@section("body")
<!-- messages -->
<div class="p-4 mb-4 text-sm text-blue-700 bg-blue-100 rounded-lg dark:bg-blue-200 dark:text-blue-800" role="alert">
    <span class="font-medium">Edite Food Page </span>
</div>


<div class="px-2 mx-8">
    <div class="flex flex-wrap justify-around mx-3 mb-6">
        <div class="w-1/3  px-3 m-4">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                Name
            </label>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text" placeholder="Doe" name="name">
        </div>
        <div class="w-1/3  px-3 m-4">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                Raw material
            </label>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text" placeholder="Doe" name="raw">
        </div>
        <div class="w-1/3  px-3 m-4">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                Price
            </label>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="number" placeholder="Doe" name="price">
        </div>
        <div class="w-1/3  px-3 m-4">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                Discount
            </label>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="number" placeholder="Doe" name="discount">
        </div>
        <div class="w-full  px-3 ml-[109px] my-6">
            <div class="flex items-center">
                <input checked id="checked-checkbox" type="checkbox" value="true" class="w-8 h-8 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" name="is_foodparty">
                <label for="checked-checkbox" class="ml-2 text-xl font-bold text-gray-900 dark:text-gray-300">This food is consist of Foodparty</label>
            </div>
        </div>
        <div class="w-full mx-28">

            <label class="block mb-2 text-lg font-bold text-gray-900 dark:text-gray-300" for="file_input">Upload food picture</label>
            <input class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" name="image" type="file">
            
        </div>
    </div>
</div>




@endsection()