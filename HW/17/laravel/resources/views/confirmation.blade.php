@extends("layout.main")


@section("body")
<div class="bg-gradient-to-r from-purple-500 to-pink-500 text-gray-800 py-6 px-6">
    @CSRF
    <p class="mb-6 text-xl text-center font-bold border-solid border-b-4">Your Reservation has been created</p>
    <div class="flex justify-around">
        <div class="p-6 w-1/3 rounded-md border-solid border-4 border-orange-800">
            <div class="border-solid border-b-4 text-center font-bold text-2xl mb-4">Confirmation Info</div>
            <div class=" text-left font-bold text-lg">Tracking Code:{{$code}}</div>
            <div class=" text-left font-bold text-lg">Time Duration:{{$time}}</div>
            <div class=" text-left font-bold text-lg">Day:{{$day}}</div>
            <div class=" text-left font-bold text-lg mb-6">Service:{{$service}}</div>
            <div class="flex justify-between">
                <form action="../../../cancel" method="POST">
                    @CSRF
                    <input type="hidden" name="cancelcode" value={{$code}}>
                    <button class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-lg leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Cancel Booking</button>
                </form>
                <form action="edite" method="POST">
                    @CSRF
                    <input type="hidden" name="editecode" value={{$code}}>
                    <button class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-lg leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Edite</button>
                </form>

            </div>
        </div>

        <div class="p-6 w-1/3 rounded-md border-solid border-4 border-orange-800">
            <div class="border-solid border-b-4 text-center font-bold text-2xl mb-4">Commercial Invoice</div>
            <div class=" text-left font-bold text-lg">Day:{{$day}}</div>
            <div class=" text-left font-bold text-lg"> Service:{{$service}} -----Cost:{{$cost}}</div>
            <div class=" text-left font-bold text-lg"></div>
        </div>

    </div>


</div>

@endsection()