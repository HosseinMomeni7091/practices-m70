@extends("layout.seller")


@section("body")
<!-- messages -->
<div class="p-4 mb-4 text-sm text-blue-700 bg-blue-100 rounded-lg dark:bg-blue-200 dark:text-blue-800" role="alert">
    <span class="font-medium">All orders that they have been delivering/delivered :</span>
</div>

<div class="flex mx-8 rounded-lg p-4 flex-row bg-slate-300 justify-around items-center">
    <form action="{{ route('filterOnReport') }}" method="POST">
        @csrf
        <label class="text-lg font-bold " for="">Filter on period</label>
        <select name="filter">
            <option selected>{{old('filter')}}</option>
            <option value="all">All</option>
            <option value="lastWeek">Last Week</option>
            <option value="lastMonth">Last Month</option>
        </select>
        <button class="w-32 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-lg px-4 py-1 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Filter</button>
    </form>
</div>

<div class="overflow-x-auto relative shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="py-3 px-6">
                    No.
                </th>
                <th scope="col" class="py-3 px-6">
                    Primay Cost
                </th>
                <th scope="col" class="py-3 px-6">
                    Discount
                </th>
                <th scope="col" class="py-3 px-6">
                    Cost after discount
                </th>
                <th scope="col" class="py-3 px-6">
                    Quantity
                </th>
                <th scope="col" class="py-3 px-6">
                    Status
                </th>
                <th scope="col" class="py-3 px-6">
                    Order Placed at
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $key => $order)
            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                <td class="py-4 px-6">
                    {{$key+1}}
                </td>
                <td class="py-4 px-6">
                    {{$TotalPrice[$key]}}
                </td>
                <td class="py-4 px-6">
                    {{$OrderDiscount[$key]}}
                </td>
                <td class="py-4 px-6">
                    {{$TotalOrderPrice[$key]}}
                </td>
                <td class="py-4 px-6">
                    {{$order->quantity}}
                </td>
                <td class="py-4 px-6">
                    {{$order->status}}
                </td>
                <td class="py-4 px-6">
                    {{$order->created_at}}
                </td>
            </tr>
            @endforeach
            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700 font-bold text-lg text-black">
                <td class="py-4 px-6">
                    <span>Total</span>
                </td>
                <td class="py-4 px-6">
                    <span>{{$TotalPriceForAllOrder}}</span>
                </td>
                <td class="py-4 px-6">
                    <span>{{$TotalDiscountForAllOrder}}</span>
                </td>
                <td class="py-4 px-6">
                    <span>{{$TotalPriceForAllOrderAfterDiscount}}</span>
                </td>
                <td class="py-4 px-6">
                    <span>{{$TotalAllOrderQuantity}}</span>
                </td>
                <td class="py-4 px-6">
                    <span>----</span>
                </td>
                <td class="py-4 px-6">
                    <span>----</span>
                </td>
            </tr>
        </tbody>
    </table>
</div>


@endsection()