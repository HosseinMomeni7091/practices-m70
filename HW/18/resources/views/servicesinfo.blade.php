@extends("layout.manager")


@section("body")
<div class="bg-gradient-to-r from-purple-500 to-pink-500 text-gray-800 py-6 px-6">


    <div class="mx-auto font-bold text-2xl">All Services</div>
    <table>
        <th>
        <td>id</td>
        <td>service</td>
        <td>time</td>
        <td>cost</td>
        <td>Action</td>
        </th>
        @foreach ($services as $service)
        <tr class="">
            <form action="{{route('editeservice')}}" method="post">
            @csrf
                <td>{{$service->id}}</td>
                <td>
                    {{$service->name}}
                    <input type="text" name="name">
                </td>
                <td>
                    {{$service->time}}
                    <input type="text" name="time">
                </td>
                <td>
                    {{$service->cost}}
                    <input type="text" name="cost">
                    <input type="hidden" name="id" value="{{$service->id}}">
                    <button>Edite</button>
                </td>
                <td>
            </form>
            <form action="{{route('removeservice')}}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{$service->id}}">
                <button>Remove</button>
            </form>
            </td>
        </tr>
        @endforeach
    </table>
    <div class="my-4">
        <form action="{{route('createservice')}}" method="post">
            @csrf
            <label for="">Name</label>
            <input class="my-4" type="text" name="name"><br>
            <label for="">Time</label>
            <input class="my-4" type="text" name="time"><br>
            <label for="">Cost</label>
            <input class="my-4" type="text" name="cost"><br>
            <button>Create</button>
        </form>

    </div>


</div>

@endsection()