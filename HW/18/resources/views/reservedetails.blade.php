@extends("layout.manager")


@section("body")
<div class="bg-gradient-to-r from-purple-500 to-pink-500 text-gray-800 py-6 px-6">


    <div class="mx-auto font-bold text-2xl">Details</div>
    <table>
        <th>
            <td>user_id</td>
            <td>day</td>
            <td>service</td>
            <td>time</td>
            <td>cost</td>
            <td>code</td>
        </th>
        @foreach ($users as $user)
        <tr class="">
            <td>{{$user->user_id}}</td>
            <td>{{$user->day}}</td>
            <td>{{$user->service}}</td>
            <td>{{$user->time}}</td>
            <td>{{$user->cost}}</td>
            <td>{{$user->code}}</td>
          </tr>
        @endforeach
    </table>


</div>

@endsection()