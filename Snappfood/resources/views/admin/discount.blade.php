@extends("layout.admin")


@section("body")
<!-- messages -->
<div class="p-4 mb-4 text-sm text-blue-700 bg-blue-100 rounded-lg dark:bg-blue-200 dark:text-blue-800" role="alert">
    <span class="font-medium">All Discount</span>
</div>

<!-- Category add -->
<div class=" px-4 py-2 mb-4 text-sm w-1/2 mx-auto text-blue-300 bg-blue-100 rounded-lg dark:bg-blue-200 dark:text-blue-800" role="alert">
    <form class="flex  items-center" action="{{route('discount.store')}}" method="POST">
        @csrf
        <input class="appearance-none w-1/3 bg-green-50 text-gray-700 border border-gray-200 rounded  py-2 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text" name="name" placeholder="Eid">
        <input class="appearance-none w-1/3 bg-green-50 text-gray-700 border border-gray-200 rounded  py-2 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text" name="off" placeholder="20">
        <button class=" mx-auto my-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Add Discount
        </button>
    </form>
</div>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-3/4 text-lg mx-auto mb-4 text-left text-gray-500 dark:text-gray-400">
        <thead class="text-base text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Discount Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Off Percent
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
            @foreach($discounts as $discount)
            <tr class="border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-amber-100 even:bg-gray-200 odd:dark:bg-gray-800 even:dark:bg-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                    {{$discount->name}}
                </th>
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                    {{$discount->discount}}
                </th>
                <td class="px-6 py-4 text-right">
                    <form action="{{ route('discount.update',['discount'=>$discount]) }}" method="POST" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                        @method('PUT')
                        @CSRF
                        <input type="hidden" name="editeid" value="{{$discount->id}}">
                        <input class="w-32 h-8 text-lg" type="text" name="editevalue1" placeholder="Eid">
                        <input class="w-32 h-8 text-lg" type="text" name="editevalue2" placeholder="20">
                        <button class=" mx-auto bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Edit
                        </button>
                    </form>
                </td>
                <td class="px-6 py-4 text-right">
                    <form action="{{ route('discount.destroy',['discount'=>$discount]) }}" method="POST" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                        @method('DELETE')
                        @CSRF
                        <input type="hidden" name="remove" value="{{$discount->id}}">
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