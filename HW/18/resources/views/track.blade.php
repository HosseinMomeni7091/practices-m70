@extends("layout.main")


@section("body")
<form action="/searchtracknumber" method="POST">
        <div class="bg-gradient-to-r from-purple-500 to-pink-500 text-gray-800 py-6 px-6">
            @CSRF
            <div class="block my-2">
                <label class="text-2xl font-bold mt-0 mb-6 pr-[106px]">Track Number : </label>
                <input class="rounded-md w-48 h-8" type="text" name="track" required></br>
            </div>

            <div class="my-2">
                <label class="text-2xl font-bold mt-0 mb-6">Phone Number : </label>
                <input class="rounded-md w-48 h-8" type="text" name="phone" required></br>
            </div>

            <button class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Search</button>
   
        </div>
    </form>

@endsection()