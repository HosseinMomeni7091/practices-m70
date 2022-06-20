@extends("layout.manager")


@section("body")
<div class="bg-gradient-to-r from-purple-500 to-pink-500 text-gray-800 py-6 px-6">


    <div class="mx-auto font-bold text-2xl"></div>
    <table>
        <th>
        <td>name</td>
        <td>family</td>
        <td>email</td>
        <td>phone</td>
        <td>total cost</td>
        <td>last activity</td>
        <td>Details</td>
        </th>
        @foreach ($totalinfo as $info)
        <!-- <tr class="bg-{{$info['activitystatus']}}"> -->
        <tr class="bg-{{$info['activitystatus']}}-500">
            <td>{{$info["name"]}}</td>
            <td>{{$info["family"]}}</td>
            <td>{{$info["email"]}}</td>
            <td>{{$info["phone"]}}</td>
            <td>{{$info["totalcost"]}}</td>
            <td>{{$info["lastactivity"]}}</td>
            <td>
                <form action="{{route('reservedetail')}}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{$info['id']}}">
                    <button>Details </button>
                    
                </form>
            </td>
        </tr>
        @endforeach
    </table>


</div>

@endsection()