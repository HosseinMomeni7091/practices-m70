@extends("layout.admin")


@section("body")
<!-- messages -->
<div class="p-4 mb-4 text-sm text-blue-700 bg-blue-100 rounded-lg dark:bg-blue-200 dark:text-blue-800" role="alert">
    <span class="font-medium">Comments with delete request :</span>
</div>

<div class="overflow-x-auto relative shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="py-3 px-6">
                    No.
                </th>
                <th scope="col" class="py-3 px-6">
                    Username
                </th>
                <th scope="col" class="py-3 px-6">
                    Restaurant
                </th>
                <th scope="col" class="py-3 px-6">
                    Comment
                </th>
                <th scope="col" class="py-3 px-6">
                    Status
                </th>
                <th scope="col" class="py-3 px-6">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($comments as $key => $comment)
            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                <td class="py-4 px-6">
                    {{$key+1}}
                </td>
                <td class="py-4 px-6">
                    {{$comment->user->name}}
                </td>
                <td class="py-4 px-6">
                    {{$comment->order->restaurant->name}}
                </td>
                <td class="py-4 px-6">
                    {{$comment->comment}}
                </td>
                <td class="py-4 px-6">
                    {{$comment->status}}
                </td>
                <td class="pt-5 px-6 align-middle">
                    <form action="{{ route('actionOnComment') }}" method="get">
                        <input type="hidden" name="commentId" value="{{$comment->id}}">
                        <select class="border-2 border-gray-300 rounded-lg" name="status">
                            <option  selected>{{$comment->status}}</option>
                            <option value="approved">approved</option>
                            <option value="deleted">deleted </option>
                        </select>
                        <button  class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-0.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">Finalize</button>

                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


@endsection()