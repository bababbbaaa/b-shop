@extends('layout.app')
@section('title', 'Вход в аккаунт')

@section('content')

    <main class="md:min-h-screen md:flex md:items-center md:justify-center py-16 lg:py-20">
        <div class="container">

            <x-forms.auth-forms title="Вход в аккаунт" method="post" action="{{route('login.handle')}}">
                @csrf
                <x-forms.text-input
                    type="email"
                    name="email"
                    required="true"
                    placeholder="E-mail"
                    isError="{{$errors->has('email')}}"
                    value="{{old('email')}}"
                ></x-forms.text-input>

                @error('email')
                <x-forms.error class="error">{{$message}}</x-forms.error>
                @enderror


                <x-forms.text-input
                    type="password"
                    name="password"
                    required="true"
                    placeholder="Пароль"
                    isError="{{$errors->has('password')}}"
                ></x-forms.text-input>

                <x-forms.primery-button>
                    Войти
                </x-forms.primery-button>

                <x-slot:socialAuth>
                    <ul class="space-y-3 mt-3 text-white">

                        <li>
                            <a href="{{route('socialite.redirect', 'vkontakte')}}"
                               class="relative  flex items-center h-14 px-12 rounded-lg border border-[#A07BF0] bg-white/20 hover:bg-white/20 active:bg-white/10 active:translate-y-0.5">
                                <svg fill="#fff" class="shrink-0 absolute left-4 w-5 sm:w-6 h-5 sm:h-6"
                                     xmlns:xlink="http://www.w3.org/1999/xlink"
                                     style="enable-background:new 0 0 64 64;" version="1.1" viewBox="0 0 64 64"
                                     xml:space="preserve"><g id="guidlines"></g>
                                    <g id="FB"></g>
                                    <g id="ig"></g>
                                    <g id="yt"></g>
                                    <g id="twitter"></g>
                                    <g id="snapchat"></g>
                                    <g id="WA"></g>
                                    <g id="Pinterrest"></g>
                                    <g id="Layer_9"></g>
                                    <g id="Layer_10"></g>
                                    <g id="Layer_11">
                                        <path class="st13"
                                              d="M4,13.9c2.1,0,5.3,0,7.1,0c0.9,0,1.6,0.6,1.9,1.4c0.9,2.6,2.9,8.3,5.2,12.2c3.1,5.1,5.1,7,6.4,6.8   c1.3-0.3,0.9-3.7,0.9-6.4s0.3-7.3-1-9.4l-2-2.9c-0.5-0.7,0-1.6,0.8-1.6h11.4c1.1,0,2,0.9,2,2v14.5c0,0,0.5,2.6,3.3-0.1   c2.8-2.7,5.8-7.7,8.3-12.8l1-2.4c0.3-0.7,1-1.2,1.8-1.2h7.4c1.4,0,2.4,1.4,1.9,2.7l-0.8,2.1c0,0-2.7,5.4-5.5,9.2   c-2.8,3.9-3.4,4.8-3,5.8c0.4,1,7.6,7.7,9.4,10.9c0.5,0.9,0.9,1.7,1.3,2.4c0.7,1.3-0.3,3-1.8,3l-8.4,0c-0.7,0-1.4-0.4-1.7-1   l-0.8-1.3c0,0-5.1-6-8.2-7.9c-3.2-1.8-3.1,0.8-3.1,0.8v5.3c0,2.2-1.8,4-4,4h-2c0,0-11,0-19.8-13.1C5.1,26.7,2.8,20.1,2,16.3   C1.8,15.1,2.7,13.9,4,13.9z"></path>
                                    </g>
                                    <g id="Layer_12"></g>
                                    <g id="Layer_13"></g>
                                    <g id="Layer_14"></g>
                                    <g id="Layer_15"></g>
                                    <g id="Layer_16"></g>
                                    <g id="Layer_17"></g></svg>
                                <span class="grow text-xxs md:text-xs font-bold text-center">VK</span>
                            </a>
                        </li>
                    </ul>
                </x-slot:socialAuth>
                <x-slot:buttons>
                    <div class="space-y-3 mt-5 text-white">
                        <div class="text-xxs md:text-xs">
                            <a href="{{route('forgot.page')}}" class=" hover:/70 font-bold">
                                Забыли пароль?
                            </a>
                        </div>
                        <div class="text-xxs md:text-xs">
                            <a href="{{route('register.page')}}"
                               class=" hover:/70 font-bold">Регистрация</a>
                        </div>
                    </div>
                </x-slot:buttons>
            </x-forms.auth-forms>
        </div>
    </main>

@endsection
