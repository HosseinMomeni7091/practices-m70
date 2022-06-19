@extends("layout.main")


@section("body")
<form action="" method="POST">
    <div class="bg-gradient-to-r from-purple-500 to-pink-500 text-gray-800 py-6 px-6">
        @CSRF
        <p class="font-extrabold text-lg text-center mb-8 border-b-2">Your all reservation are as below:</p>
        <table class="m-auto font-bold text-lg text-black-600">
            <th>
                <td>Day</td>
                <td>Time</td>
                <td>Action</td>
            </th>
            @foreach ($turns as $turn)
            <tr>
                <td class="mr-8">{{$turn->day}}</td>
                <td class="mx-4">{{$turn->time}}</td>
                <td class="flex flex-row mx-4">
                    <form action="" method="post">
                        <input type="hidden" name="reserveid" value="{{$turn->id}}">
                        <button>Cancel</button>
                    </form>
                    <form action="" method="post">
                        <input type="hidden" name="reserveid" value="{{$turn->id}}">
                        <button>Edite</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>

    </div>
</form>

@endsection()