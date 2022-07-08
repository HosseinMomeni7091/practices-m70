@extends("layout.admin")


@section("body")
<!-- messages -->
<div class="p-4 mb-4 text-sm text-blue-700 bg-blue-100 rounded-lg dark:bg-blue-200 dark:text-blue-800" role="alert">
    <span class="font-medium">Food Categories</span>
</div>

<!-- Category add -->
<div class=" px-4 py-2 mb-4 text-sm w-1/2 mx-auto text-blue-300 bg-blue-100 rounded-lg dark:bg-blue-200 dark:text-blue-800" role="alert">
    <form class="flex  items-center" action="{{route('foodcategory.store')}}" method="POST">
        @csrf
        <input class="appearance-none w-1/3 bg-green-50 text-gray-700 border border-gray-200 rounded  py-2 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text" name="name" placeholder="Sandwich">
        <button class=" mx-auto my-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Add Category
        </button>
    </form>
</div>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-1/2 text-lg mx-auto mb-4 text-left text-gray-500 dark:text-gray-400">
        <thead class="text-base text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Category Name
                </th>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Edit</span>
                </th>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Remove</span>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($foodcategories as $foodcategory)
            <tr class="border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-amber-100 even:bg-gray-200 odd:dark:bg-gray-800 even:dark:bg-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                    {{$foodcategory->name}}
                </th>
                <td class="px-6 py-4 text-right">
                    <form action="{{ route('foodcategory.update',['foodcategory'=>$foodcategory]) }}" method="POST" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                        @method('PUT')
                        @CSRF
                        <input type="hidden" name="editeid" value="{{$foodcategory->id}}">
                        <input class="w-32 h-8 text-lg" type="text" name="editevalue">
                        <button class=" mx-auto bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Edit
                        </button>
                    </form>
                </td>
                <td class="px-6 py-4 text-right">
                    <form action="{{ route('foodcategory.destroy',['foodcategory'=>$foodcategory]) }}" method="POST" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                        @method('DELETE')
                        @CSRF
                        <input type="hidden" name="remove" value="{{$foodcategory->id}}">
                        <button class=" mx-auto bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Remove
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


@endsection()