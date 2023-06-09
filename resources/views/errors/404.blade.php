@extends('layout.app')

@section('title', 'Ошибка 404')

@section('content')
    <main class="md:min-h-screen md:flex md:items-center md:justify-center py-16 lg:py-20">
        <div class="container">

            <h1 class="text-2xl font-bold text-center">Ошибка 404</h1>
            <p class="max-w-[720px] mx-auto mt-4  text-center">Похоже, что данная страница не найдена, вы
                можете
                вернуться на главную страницу.</p>
            <div class="mt-8 text-center">
                <a href="{{route('home')}}" class="btn btn-pink" rel="home">Вернутся на главную</a>
            </div>

        </div>
    </main>
@endsection


