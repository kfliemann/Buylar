
@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg text-center leading-loose">
            <h1 class="text-6xl">Buylar</h1>
            <p class="pt-8 text-xl"><u>Picture the following situation:</u> You're in a Supermarket and forgot your grocery list and you don't know if you need a certain item or not</p>
            <p class="text-xl">Wouldn't it be useful to have a helper telling you what you should consider buying, based on your buying behaviour?</p>
            <p class="pt-10 text-5xl italic">Here comes Buylar!</p>
            <p class="p-5 text-xl pt-5 ">Buylar learns your consumption behaviour and tells you what you should buy, even if you don't know that you might need it.</p>
            @guest
            <p class="pt-8 text-3xl" ><a href="{{route('register')}}" class="underline">Register</a> and try it yourself or</p>
            <p class="text-3xl" ><a href="{{route('login')}}" class="underline">Login</a> if you're already a user!</p>
            @endguest 
        </div>
    </div>
@endsection


  


