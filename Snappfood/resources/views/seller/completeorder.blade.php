@extends("layout.seller")


@section("body")
<!-- messages -->
<div class="p-4 mb-4 text-sm text-blue-700 bg-blue-100 rounded-lg dark:bg-blue-200 dark:text-blue-800" role="alert">
    <span class="font-medium">Completed Orders :</span>
</div>


<div class="overflow-x-auto relative shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="py-3 px-6">
                    ID
                </th>
                <th scope="col" class="py-3 px-6">
                    Username
                </th>
                <th scope="col" class="py-3 px-6">
                    Total Quantity
                </th>
                <th scope="col" class="py-3 px-6">
                    Total Cost
                </th>
                <th scope="col" class="py-3 px-6">
                    Status
                </th>
                <th scope="col" class="py-3 px-6">
                    Info
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($result as $order)
            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                <td class="py-4 px-6">
                    {{$order->id}}
                </td>
                <td class="py-4 px-6">
                    {{$order->user->name}}
                </td>
                <td class="py-4 px-6">
                    {{$order->quantity}}
                </td>
                <td class="py-4 px-6">
                    {{$order->cost}}
                </td>
                <td class="py-4 px-6">
                    {{$order->status}}
                </td>
                <td class="pt-5 px-6 align-middle">
                    <form action="" method="">
                        <input type="hidden" name="orderId" value="{{$order->id}}">
                        <button type="button" class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">Details</button>

                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


@endsection()