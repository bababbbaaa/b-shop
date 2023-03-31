@extends('layout.app')

@section('title', 'B-Shop - Мои заказы')

@section('content')
    <main class="py-16 lg:py-20">
        <div class="container">

            <!-- Breadcrumbs -->
            <ul class="breadcrumbs flex flex-wrap gap-y-1 gap-x-4 mb-6">
                <li><a href="{{route('home')}}" class=" hover:text-pink text-xs">Главная</a></li>
                <li><span class=" text-xs">Мои заказы</span></li>
            </ul>

            <section>
                <!-- Section heading -->
                <h1 class="mb-8 text-lg lg:text-[42px] font-bold">Мои заказы</h1>

                <!-- Orders list -->
                <div class="w-full space-y-4  text-sm text-left">

                    <!-- Order item -->

                    @if(count($orders))
                        @foreach($orders as $order)
                            <div
                                class="flex flex-col lg:flex-row lg:items-center lg:justify-between px-4 md:px-6 rounded-xl md:rounded-2xl bg-card">
                                <div class="py-4">
                                    <div class="flex gap-6">
                                        <div class="grow py-2">
                                            <div class="flex flex-col md:flex-row md:items-center gap-2">
                                                <h4 class="pr-3 text-md font-bold">
                                                    <a href="{{route('account.order', $order)}}"
                                                       class="inline-block text-black hover:text-pink">
                                                        Заказ №{{$order->id}}</a></h4>
                                                <div
                                                    class="px-3 py-1 rounded-md bg-purple text-xxs status-{{$order->status->value()}}">{{$order->status->humanValue()}}</div>
                                                <div
                                                    class="px-3 py-1  rounded-md bg-white/10 text-xxs">{{$order->created_at->format('d.m.Y')}}</div>
                                            </div>
                                            <div class="mt-3  text-xs">На сумму: {{$order->amount}}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="py-4">
                                    <div class="flex items-center gap-4">
                                        <a href="{{route('account.order', $order)}}" class="!h-14 btn btn-purple">Подробнее</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                </div>
            </section>

        </div>
    </main>
@endsection
