@extends("layout.seller")


@section("body")
<!-- messages -->
<div class="p-4 mb-4 text-sm text-blue-700 bg-blue-100 rounded-lg dark:bg-blue-200 dark:text-blue-800" role="alert">
    <span class="font-medium">food dashboard</span>
</div>
<div class="flex flex-row flex-wrap mx-2 my-2 gap-1">
    @foreach ($foodinfos as $foodinfo)
    <div class="mx-8 my-2 max-w-sm bg-rose-100 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
        <a href="#">
            <img class="p-8 rounded-[40px]" src="{{$foodinfo->image}}" alt="product image">
        </a>
        <div class="px-5 pb-5">
            <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">{{$foodinfo->name}} <span class="from-neutral-500 text-sm">({{$foodinfo->raw}})</span> </h5>
            <div class="flex flex-row justify-between items-center">
                <div class="flex items-center mt-2.5 mb-5">
                    @for ($i = 0; $i < $foodinfo->score; $i++)
                        <svg class="w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        @endfor
                        <span class="bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ml-3">{{$foodinfo->score}}</span>
                </div>
                @if ($foodinfo->is_foodparty)
                <div class="w-24 h-[28px] font-bold text-base text-center text-yellow-400 align-middle bg-red-600 rounded-lg">
                    Food Party
                </div>
                @endif
            </div>

            <div class="flex justify-between items-center">
                @if(($foodinfo->discount)==0)
                <span class="text-3xl font-bold text-gray-900 dark:text-white">{{$foodinfo->price}}</span>
                @endif
                @if(($foodinfo->discount)!=0)
                <span class="text-3xl font-bold text-gray-500 dark:text-white line-through ">{{$foodinfo->price}}</span>
                @endif
            </div>
            <div class="flex flex-row justify-between">
                <a href="#" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Edite</a>
                <a href="#" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Remove</a>
            </div>
        </div>
    </div>
    @endforeach
</div>


</div>



@endsection()