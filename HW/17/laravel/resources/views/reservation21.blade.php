@extends("layout.main")


@section("body")



<div class="bg-gradient-to-r from-purple-500 to-pink-500 text-gray-800 py-6 px-6">
    <form action="/reservation2" method="POST">
        @CSRF
        <div class="Block my-2 mx-6 text-center font-bold text-xl">
            According to your last information, The erliest reservation time is as below:
        </div>

        <!-- Day -->
        
        <div class="Block my-2 mx-6 text-center font-bold text-xl">
            <p class="text-2xl font-bold text-green-300">Day: {{$Day}}</p>
        </div>

        <!-- Time -->
        <div class="Block my-2 mx-6 text-center font-bold text-xl">
            <p class="text-2xl font-bold text-green-300">Time: {{$Time}}</p>
        </div>

        <a class="inline-block 	items-center px-6 py-2.5 bg-blue-600 text-white font-medium text-base leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out" data-mdb-ripple="true" data-mdb-ripple-color="light" href="#!" role="button">Confirm</a>

    </form>

    <a class="inline-block px-6 py-2.5 my-4 bg-blue-600 text-white font-medium text-sm leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out" data-mdb-ripple="true" data-mdb-ripple-color="light" href="#!" role="button">Back</a>
</div>

@endsection()