@extends("layout.seller")


@section("body")
<!-- messages -->
<div class="p-4 mb-4 text-sm text-blue-700 bg-blue-100 rounded-lg dark:bg-blue-200 dark:text-blue-800" role="alert">
    <span class="font-medium">Current Orders :</span>
</div>
<div>
    <div>Id: {{}}</div>
    <div>Name: {{}}</div>
    <div>Total Cost: {{}}</div>
    <div>Total Quantity: {{}}</div>
    <div>Status: {{}}</div>
    <div>Placed at: {{}}</div>
    <div>
        <form action="" method="">
            <input type="hidden" name="orderId" value="">
            <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Select New Status</label>
            <select id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="status">
                <option selected>Select Status</option>
                <option value="Ordering">Ordering</option>
                <option value="Paid">Paid</option>
                <option value="Progressing">Progressing</option>
                <option value="Preparing">Preparing</option>
                <option value="Delivering">Delivering</option>
                <option value="Delivered">Delivered</option>
            </select>
        </form>
    </div>

</div>
<p?>Foods List</p>
    <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
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
                @foreach ($result as $order)
                <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                    <td class="py-4 px-6">
                        {{$order->id}}
                    </td>
                    <td class="py-4 px-6">
                        {{$order->user->name}}
                    </td>
                    <td class="py-4 px-6">
                        {{$order->cost}}
                    </td>
                    <td class="py-4 px-6">
                        {{$order->quantity}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    @endsection()