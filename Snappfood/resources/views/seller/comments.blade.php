@extends("layout.seller")


@section("body")
<!-- messages -->
<div class="p-4 mb-4 text-sm text-blue-700 bg-blue-100 rounded-lg dark:bg-blue-200 dark:text-blue-800" role="alert">
    <span class="font-medium">Completed Orders with comments :</span>
</div>

<div class="flex mx-8 rounded-lg p-4 flex-row bg-slate-300 justify-around items-center">
    <form action="{{ route('searchCommentOfFood') }}" method="POST">
        @csrf
        <label class="text-lg font-bold " for="">Foods</label>
        <select class="w-64 h-10 rounded-md p-2 " name="foodidfilter">
            <option value="all">All</option>
            @foreach ($foodinfos as $foodinfo)
            <option value="{{$foodinfo->id}}">{{$foodinfo->name}}</option>
            @endforeach
        </select>
        <button class="w-32 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-lg px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Filter</button>
    </form>
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
                    Foods
                </th>
                <th scope="col" class="py-3 px-6">
                    Status
                </th>
                <th scope="col" class="py-3 px-6">
                    Comments
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
                     @foreach ($order->foods as $food)
                     {{$food->name}}
                    @Endforeach
                </td>
                <td class="py-4 px-6">
                    {{$order->status}}
                </td>
                <td class="pt-5 px-6 align-middle">
                    <form action="{{ route('comments') }}" method="get">
                        <input type="hidden" name="orderId" value="{{$order->id}}">
                        <button  class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">Comment</button>

                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


@endsection()