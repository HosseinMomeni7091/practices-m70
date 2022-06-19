@extends("layout.main")


@section("body")

<form action="/reservation2/Manual/pre_proccess/confirmed" method="POST">
    <div class="bg-gradient-to-r from-purple-500 to-pink-500 text-gray-800 py-6 px-6">
        @CSRF
        <?php
        // echo '<pre>';
        // print_r($final);
        // echo '</pre>' . '<br>';
        ?>
        <p class="text-center text-xl font-bold border-b-4 border-solid">According to your last request, the available duration are as below:</p>
        <div class="my-2">
            <label for="timeduratoin" class="block text-2xl font-bold text-gray-800 dark:text-gray-400">Day :</label>
            <select name="timeduratoin" id="timeduratoin" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" require>
                <option class="text-basic font-bold" selected="">Choose a duration</option>
                @foreach ($final as $value)
                <option class="text-basic font-bold" value=<?php echo $value["start"][0].".".$value["start"][1].".".$value["end"][0].".".$value["end"][1];?>>{{$value["start"][0].":".$value["start"][1]."-".$value["end"][0].":".$value["end"][1]}}</option>
                @endforeach
            </select>
        </div>
        <button class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Confirm</button>

    </div>
</form>

@endsection()