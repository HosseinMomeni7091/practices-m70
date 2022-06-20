@extends("layout.manager")


@section("body")
<div class="bg-gradient-to-r from-purple-500 to-pink-500 text-gray-800 py-6 px-6">


    <div class="mx-auto font-bold text-2xl">Total reservation</div>
    <div>
        <form class="my-4" action="{{route('servicefilter')}}" method="post">
            @csrf
            <select name="service" id="">
                <option value="all">all</option>
                @foreach ($services as $service)
                <option value="{{$service}}">{{$service}}</option>
                @endforeach
            </select>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold  px-4 rounded">
                Filter
            </button>
        </form>
        <form action="{{route('dayfilter')}}" method="post">
            @csrf
            <select name="day" id="">
                <option value="all">all</option>
                @foreach ($days as $day)
                <option value="{{$day}}">{{$day}}</option>
                @endforeach
            </select>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold  px-4 rounded">
                Filter
            </button>
        </form>
    </div>
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