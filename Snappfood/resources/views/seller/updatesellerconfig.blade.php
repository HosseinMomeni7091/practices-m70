@extends("layout.seller")


@section("body")
<!-- messages -->
<div class="p-4 mb-4 text-sm text-blue-700 bg-blue-100 rounded-lg dark:bg-blue-200 dark:text-blue-800" role="alert">
    <span class="font-medium">Restaurant configuration Edite</span>
</div>


<form action="{{route('restaurants.update',['restaurant'=>$restinfo])}}" enctype="multipart/form-data" method="POST">
    @method('PATCH')
    @csrf
    <div class="px-2 mx-8">
        <div class="flex flex-wrap justify-around mx-3 mb-6">
            <div class="w-1/3  px-3 m-4">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                    Name
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text" name="name" value="{{ old('name') ?? $restinfo->name ?? 'Haj Rahim' }}">
            </div>
            <div class="w-1/3  px-3 m-4">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                    phone
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text" name="phone" value="{{ old('phone') ?? $restinfo->phone ?? '0919...' }}">
            </div>
            <div class="w-1/3  px-3 m-4">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                    Address
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text" name="address" value="{{ old('address') ?? $restinfo->restaddress->address ?? 'Semnan,...' }}">
            </div>
            <div class="w-1/3  px-3 m-4">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                    Freight
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="number" name="freight" value="{{ old('freight') ?? $restinfo->freight ?? '12000' }}">
            </div>
            <div class="w-1/3  px-3 m-4">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                    Latitude
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text" name="latitude" value="{{ old('latitude') ?? $restinfo->restaddress->latitude ?? '54.1212' }}">
            </div>
            <div class="w-1/3  px-3 m-4">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                    Longitude
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="number" name="longitude" value="{{ old('longitude') ?? $restinfo->restaddress->longitude ?? '34.1212' }}">
            </div>
            <div class="w-1/3  px-3 m-4">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                    Bank Account
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text" placeholder="IR0696000000010324200001" name="bank_account" value="{{ old('bank_account') ?? $restinfo->bank_account ?? 'IR0696000000010324200001' }}">
            </div>
            <div class="w-1/3  px-3 m-4">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                    Restaurant Category :(Selected:<span class="text-base text-red-700 font-bold">{{$restinfo->restcategory->name}}) </span>
                </label>
                <select class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="category">
                        @foreach ($restCategory as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
            </div>
            <p class="text-center font-bold text-xl mx-auto mt-4 w-full">Schedule</p>
            <div class="w-full text-center ml-32  flex flex-row flex-wrap">
                <div class="w-32  px-1 m-1">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                        Saturday start
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text" placeholder="09:00" name="sat_start" value="{{ old('sat_start') ?? $restinfo->schedule->sat_start ?? '09:00' }}" >
                </div>
                <div class="w-32  px-1 m-1">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                        Sunday start
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text" placeholder="09:00" name="sun_start" value="{{ old('sun_start') ?? $restinfo->schedule->sun_start ?? '09:00' }}" >
                </div>
                <div class="w-32  px-1 m-1">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                        Monday start
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text" placeholder="09:00" name="mon_start" value="{{ old('mon_start') ?? $restinfo->schedule->mon_start ?? '09:00' }}">
                </div>
                <div class="w-32  px-1 m-1">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                        Tuesday start
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text" placeholder="09:00" name="tues_start" value="{{ old('tues_start') ?? $restinfo->schedule->tues_start ?? '09:00' }}" >
                </div>
                <div class="w-32  px-1 m-1">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                        Wednesday start
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text" placeholder="09:00" name="wednes_start" value="{{ old('wednes_start') ?? $restinfo->schedule->wednes_start ?? '09:00' }}">
                </div>
                <div class="w-32  px-1 m-1">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                        Thursady start
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text" placeholder="09:00" name="thurs_start" value="{{ old('thurs_start') ?? $restinfo->schedule->thurs_start ?? '09:00' }}">
                </div>
                <div class="w-32  px-1 m-1">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                        Friday start
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text" placeholder="09:00" name="fri_start" value="{{ old('fri_start') ?? $restinfo->schedule->fri_start ?? '09:00' }}">
                </div>
            </div>
            <div class="w-full text-center ml-32  flex flex-row flex-wrap">
                <div class="w-32  px-1 m-1">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                        Saturday End
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text" placeholder="22:00" name="sat_end" value="{{ old('sat_end') ?? $restinfo->schedule->sat_end ?? '09:00' }}">
                </div>
                <div class="w-32  px-1 m-1">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                        Sunday end
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text" placeholder="22:00" name="sun_end" value="{{ old('sun_end') ?? $restinfo->schedule->sun_end ?? '09:00' }}">
                </div>
                <div class="w-32  px-1 m-1">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                        Monday end
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text" placeholder="22:00" name="mon_end" value="{{ old('mon_end') ?? $restinfo->schedule->mon_end ?? '09:00' }}">
                </div>
                <div class="w-32  px-1 m-1">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                        Tuesday end
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text" placeholder="22:00" name="tues_end" value="{{ old('tues_end') ?? $restinfo->schedule->tues_end ?? '09:00' }}">
                </div>
                <div class="w-32  px-1 m-1">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                        Wednesday end
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text" placeholder="22:00" name="wednes_end" value="{{ old('wednes_end') ?? $restinfo->schedule->wednes_end ?? '09:00' }}">
                </div>
                <div class="w-32  px-1 m-1">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                        Thursady end
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text" placeholder="22:00" name="thurs_end" value="{{ old('thurs_end') ?? $restinfo->schedule->thurs_end ?? '09:00' }}">
                </div>
                <div class="w-32  px-1 m-1">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                        Friday end
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text" placeholder="22:00" name="fri_end" value="{{ old('fri_end') ?? $restinfo->schedule->fri_end ?? '09:00' }}">
                </div>
            </div>
            @if($restinfo->picture!=null)
            <div class="inline text-center mx-auto w-1/3 h-52 mt-4">
                <div class="font-bold text-lg">Your Image is as below:</div>
                <img class="rounded-lg mx-auto" src="{{$restinfo->picture}}" alt="Your image">
            </div>
            @endif
            <div class="w-full mx-28">
                <label class="block mb-2 text-lg font-bold text-gray-900 dark:text-gray-300" for="file_input">Upload food picture</label>
                <input class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" name="image" type="file">

            </div>

            <button class=" mx-auto my-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Update
            </button>
        </div>
    </div>
</form>


<!-- Map -->
<div class="w-1/2 h-1/2 mx-auto my-16">
    <div class="text-center font-bold">Please Select your exact location on map and press location button accrdingly</div>
    <div class="border-2 border-gray-100 rounded-xl">
        <x-maps-leaflet :centerPoint="['long' => 51.336841699404374, 'lat' => 35.69914011873405]" :zoomLevel="11" :markers="[['long' => 51.336841699404374, 'lat' => 35.69914011873405]]"></x-maps-leaflet>
    </div>
</div>




@endsection()