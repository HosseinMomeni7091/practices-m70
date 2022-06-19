@extends("layout.main")


@section("body")
<div class="bg-gradient-to-r from-purple-500 to-pink-500 text-gray-800 py-6 px-6">
    <form action="{{route('profilesave')}}" method="post">
        @CSRF
        <p class="mb-4">
            <span>Name: {{$name}}</span>
            <input class="w-48 rounded-md ml-4 border-2 border-solid border-green-500" name="name" type="text">
        </p>
        <p class="mb-4">
            <span>Family: {{$family}}</span>
            <input class="w-48 rounded-md ml-4 border-2 border-solid border-green-500" name="family" type="text">
        </p>
        <p class="mb-4">
            <span>Phone: {{$phone}}</span>
            <input class="w-48 rounded-md ml-4 border-2 border-solid border-green-500" name="phone" type="text">
        </p>
        <p class="mb-4">
            <span>Email: {{$email}}</span>
            <input class="w-48 rounded-md ml-4 border-2 border-solid border-green-500" name="email" type="text">
        </p>
        <button class="border-solid border-2 bg-cyan-200 rounded-lg">Update</button>

    </form>
</div>
@endsection()