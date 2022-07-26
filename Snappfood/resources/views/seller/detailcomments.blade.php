@extends("layout.seller")


@section("body")
<!-- messages -->
<div class="p-4 mb-4 text-sm text-blue-700 bg-blue-100 rounded-lg dark:bg-blue-200 dark:text-blue-800" role="alert">
    <span class="font-medium">All comments for order id {{$orderId}} :</span>
</div>


<div class="overflow-x-auto relative shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="py-3 px-6">
                    No.
                </th>
                <th scope="col" class="py-3 px-6">
                    Comment
                </th>
                <th scope="col" class="py-3 px-6">
                    Score
                </th>
                <th scope="col" class="py-3 px-6">
                    Status
                </th>
                <th scope="col" class="py-3 px-6">
                    Reply
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
                    {{$comment->comment}}
                </td>
                <td class="py-4 px-6">
                    {{$comment->score}}
                </td>
                <td class="py-4 px-6">
                    <form action="{{route('updateCommentStatus')}}" method="">
                        @csrf
                        <input type="hidden" name="comment_id" value="{{$comment->id}}">
                        <input type="hidden" name="orderId" value="{{$orderId}}">
                        <select name="status">
                            <option selected>{{$comment->status}}</option>
                            <option value="waiting">waiting</option>
                            <option value="approved">approved</option>
                            <option value="delete request">delete request</option>
                        </select>
                        <button class="my-4 focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">Update</button>
                    </form>
                </td>
                <td class="py-4 px-6">
                    <form action="{{route('sendCommentReply')}}" method="" >
                        @csrf
                        <input class="w-64 border-2 border-gray-300 h-8 rounded-lg" type="text" name="reply" value="{{$comment->reply}}" >
                        <input type="hidden" name="comment_id" value="{{$comment->id}}">
                        <input type="hidden" name="orderId" value="{{$orderId}}">
                        <button class="my-4 focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">Send</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


@endsection()