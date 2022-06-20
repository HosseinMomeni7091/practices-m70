<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Document</title>
</head>
<!-- header -->
<header>
    <!-- Navbar -->
    <nav class="flex justify-between px-6 py-2 my-4 font-extrabold text-3xl">
        <div>
            Momeni CarWash
        </div>
        <div class="flex inline-flex font-bold text-xl">
            @auth
            <div class="px-4 ">
                <a href="{{route('reservationlist')}}">Reservation</a>
            </div>
            <div class="px-4 ">
                <a href="{{route('userlist')}}">Users</a>
            </div>
            <div class="px-4 ">
                <a href="{{route('servicelist')}}">Services</a>
            </div>
            <div class="mx-4">
                Welcome {{auth()->user()->name}}
                <a href="{{route('logout')}}">LogOut</a>
            </div>
            <div>
                <a href="{{route('profilepage')}}">profile</a>
            </div>
            @endauth
        </div>
        @guest
        <div class="px-4 ">
            <a class="font-bold text-xl" href="{{route('loginform')}}">Login</a>
        </div>
        <div class="px-4 ">
            <a class="font-bold text-xl" href="{{route('registerform')}}">Register</a>
        </div>
        @endguest


    </nav>
</header>





<body>
    <!-- body -->
    @yield("body")
</body>

</html>