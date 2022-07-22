@extends("layout.seller")


@section("body")
<!-- messages -->
<div class="p-4 mb-4 text-sm text-blue-700 bg-blue-100 rounded-lg dark:bg-blue-200 dark:text-blue-800" role="alert">
    <span class="font-medium">Current Orders :</span>
</div>
<div class="p-4 mb-4 mx-4 text-lg font-bold flex flex-wrap flex-row g-4 border-4 rounded-lg border-red-400">
    <div class="w-1/3 px-2">Id:<span class="text-red-600"> {{$result->id}}</span> </div>
    <div class="w-1/3 px-2">Name: <span class="text-red-600">{{$result->user->name}}</span></div>
    <div class="w-1/3 px-2">Total Cost: <span class="text-red-600">{{$result->cost}}</span></div>
    <div class="w-1/3 px-2">Total Quantity: <span class="text-red-600">{{$result->quantity}}</span></div>
    <div class="w-1/3 px-2">Status:<span class="text-red-600"> {{$result->status}}</span></div>
    <div class="w-1/3 px-2">Placed at: <span class="text-red-600">{{$result->created_at}}</span></div>
    <div class="w-full px-2">
        <form action="{{route('UpdateOrderStatus')}}" method="get">
            <input type="hidden" name="orderId" value="{{$result->id}}">
            <label for="countries" class="block mb-2 ">Select New Status :</label>
            <select id="countries" class="bg-gray-50 border border-gray-300  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="status">
                <option selected>Select Status</option>
                <option value="Ordering">Ordering</option>
                <option value="Paid">Paid</option>
                <option value="Progressing">Progressing</option>
                <option value="Preparing">Preparing</option>
                <option value="Delivering">Delivering</option>
                <option value="Delivered">Delivered</option>
            </select>
            <button class="my-4 focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">Update</button>
        </form>
    </div>

</div>
<div class="border-4 border-blue-400 rounded-lg mx-4">
    <p class="p-4 mb-4 text-3xl font-bold">Foods List</p>
    <div class=" p-4 mb-4 overflow-x-auto relative shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-350 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="py-3 px-6">
                        ID
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Name
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Price
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Count
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($result->foods as $food)
                <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                    <td class="py-4 px-6">
                        {{$food->id}}
                    </td>
                    <td class="py-4 px-6">
                        {{$food->name}}
                    </td>
                    <td class="py-4 px-6">
                        {{$food->price}}
                    </td>
                    <td class="py-4 px-6">
                        {{$food->pivot->count}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection()