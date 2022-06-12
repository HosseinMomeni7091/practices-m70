@extends("layout.main")


@section("body")
<form action="/reservation2/Manual/pre_proccess" method="POST">
    <div class="bg-gradient-to-r from-purple-500 to-pink-500 text-gray-800 py-6 px-6">
    @CSRF
 
        <!-- Available Time Table -->
        <div class="py-2">
            <table>
                <tr>
                    <td class="font-bold">Day</td>
                    @for ($i = 9; $i < 21; $i++) 
                        @for ($j=1; $j < 13; $j++) 
                            <!-- <td>{{$i.$j}}</td> -->
                            @if ($j==1) <td class="font-bold">{{ $i }}</td>
                            @else
                            <td> </td>
                            @endif
                        @endfor
                    @endfor
                </tr>
                <tr>
                    <td class="font-bold">Saturday</td>
                    @foreach ($final[0] as $key => $value)
                        <td class={{$value}}>.</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="font-bold">Sunday</td>
                    @foreach ($final[1] as $key => $value)
                        <td class={{$value}}>.</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="font-bold">Monday</td>
                    @foreach ($final[2] as $key => $value)
                        <td class={{$value}}>.</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="font-bold">Tuesday</td>
                    @foreach ($final[3] as $key => $value)
                        <td class={{$value}}>.</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="font-bold">Wednesday</td>
                    @foreach ($final[4] as $key => $value)
                        <td class={{$value}}>.</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="font-bold">Thursday</td>
                    @foreach ($final[5] as $key => $value)
                        <td class={{$value}}>.</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="font-bold">Friday</td>
                    @foreach ($final[6] as $key => $value)
                        <td class={{$value}}>.</td>
                    @endforeach
                </tr>
            </table>

        </div>


        <div class="my-2">
            <label for="Day" class="block text-2xl font-bold text-gray-800 dark:text-gray-400">Day :</label>
            <select name="day" id="Day" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" require>
                <option class="text-basic font-bold" selected="">Choose a Day</option>
                <option class="text-basic font-bold" value="Saturday">Saturday</option>
                <option class="text-basic font-bold" value="Sunday">Sunday</option>
                <option class="text-basic font-bold" value="Monday">Monday</option>
                <option class="text-basic font-bold" value="Tuesday">Tuesday</option>
                <option class="text-basic font-bold" value="Wednesday">Wednesday</option>
                <option class="text-basic font-bold" value="Thursday">Thursday</option>
                <option class="text-basic font-bold" value="Friday">Friday</option>
            </select>
        </div>


        <!-- <div class="my-2">
            <label for="time" class="block text-2xl font-bold text-gray-800 dark:text-gray-400">Time :</label>
            <select name="time" id="time" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" require>
                <option class="text-basic font-bold" selected="">Choose a Time</option>
                <option class="text-basic font-bold" value="Manually">9-9:15</option>
            </select>
        </div> -->

        <button class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Next</button>

    </div>
</form>

@endsection()