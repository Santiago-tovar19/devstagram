@extends('layouts.app');

@section('titulo')
    Inicia sesion en Devstagram
@endsection

@section("contenido")
 <div class="md:flex md:justify-center md:items-center md:gap-10">
    <div class="md:w-6/12  p-5" >
    <img src="{{asset('img/login.jpg')}} " alt="imagen registro de usuarios">
   </div>
   <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
   <form method="POST" action="{{route('login')}}">
    @csrf




    <div class="mb-5">
        <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">Email</label>
        <input
        type="email"
        id="email"
        name="email"
        placeholder="Tu email"
        class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror"

        >
         @error("email")
            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}} </p>
        @enderror
    </div>
    <div class="mb-5">
        <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">Contraseña</label>
        <input
        type="password"
        id="password"
        name="password"
        placeholder="Tu Contraseña"
        class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror"


        >
         @error("password")
            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}} </p>
        @enderror
    </div>
    @if(session("status"))
        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{session("status")}} </p>

    @endif

    <div class="mb-5" >
        <input type="checkbox" name="remember" >
        <label for="" class="text-sm text-gray-600">Mantener mi sesión abierta</label>
    </div>

    <input type="submit" value="Iniciar sesion" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full text-white rounded-lg p-3">

   </form>
   </div>
  </div>
@endsection
