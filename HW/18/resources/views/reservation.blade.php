@extends("layout.main")


@section("body")
<form action="/reservation2" method="POST">
    <div class="bg-gradient-to-r from-purple-500 to-pink-500 text-gray-800 py-6 px-6">
        @CSRF
        <div class="my-2">
            <label for="Service" class="block text-2xl font-bold text-gray-800 dark:text-gray-400">Service :</label>
            <select name="service" id="Service" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                <option class="text-basic font-bold" selected="">Choose a ServiceType</option>
                @foreach ($services as $service)
                <option class="text-basic font-bold" value="{{$service['name']}}">{{$service["name"]}} CarWash (D:{{$service["time"]}} Min)</option>
                @endforeach
            </select>
        </div>


        <div class="my-2">
            <label for="timetype" class="block text-2xl font-bold text-gray-800 dark:text-gray-400">Reserve Type :</label>
            <select name="timetype" id="timetype" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                <option class="text-basic font-bold" selected="">Choose a ReserveType</option>
                <option class="text-basic font-bold" value="Automatic">Automatic (Earliest Time)</option>
                <option class="text-basic font-bold" value="Manually">Manually</option>
            </select>
        </div>

        <button class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Next</button>

    </div>
</form>

@endsection()