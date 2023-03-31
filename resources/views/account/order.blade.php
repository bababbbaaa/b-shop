@extends('layout.app')

@section('title', 'B-Shop - Мои заказы')

@section('content')
    <main class="py-16 lg:py-20">
        <div class="container">

            <!-- Breadcrumbs -->
            <ul class="breadcrumbs flex flex-wrap gap-y-1 gap-x-4 mb-6">
                <li><a href="{{route('home')}}" class=" hover:text-pink text-xs">Главная</a></li>
                <li><a href="{{route('account.orders')}}" class=" hover:text-pink text-xs">Мои заказы</a></li>
                <li><span class=" text-xs">Заказ №{{$order->id}}</span></li>
            </ul>

            <section>
                <!-- Section heading -->
                <div class="flex flex-col md:flex-row md:items-center gap-3 md:gap-6 mb-8">
                    <h1 class="pb-4 md:pb-0 text-lg lg:text-[42px] font-bold">Заказ №{{$order->id}}</h1>
                    <div
                        class="px-6 py-3 rounded-lg bg-purple status-{{$order->status->value()}}">{{$order->status->humanValue()}}</div>
                    <div class="px-6 py-3 rounded-lg bg-card">Дата
                        заказа: {{$order->created_at->format('d.m.y')}}</div>
                </div>

                <!-- Message -->
                <div class="md:hidden py-3 px-6 rounded-lg bg-pink ">Таблицу можно пролистать вправо →</div>

                <!-- Adaptive table -->
                <div class="overflow-auto">
                    <table class="min-w-full border-spacing-y-4 text-sm text-left"
                           style="border-collapse: separate">
                        <thead class="text-xs uppercase">
                        <th scope="col" class="py-3 px-6">Товар</th>
                        <th scope="col" class="py-3 px-6">Цена</th>
                        <th scope="col" class="py-3 px-6">Количество</th>
                        <th scope="col" class="py-3 px-6">Сумма</th>
                        </thead>
                        <tbody>
                        @foreach($order->orderItems as $order_item)

                            <tr>
                                <td scope="row" class="py-4 px-6 rounded-l-2xl bg-card">
                                    <div class="flex flex-col items-center lg:flex-row min-w-[200px] gap-2 lg:gap-6">
                                        <div
                                            class="shrink-0 overflow-hidden w-[64px] lg:w-[84px] h-[64px] lg:h-[84px] rounded-2xl">
                                            <img
                                                src="{{$order_item->product->makeThumbnail('84x84', $order_item->product->id, 'resize')}}"
                                                class="object-cover w-full h-full"
                                                alt="{{$order_item->product->title}}">
                                        </div>
                                        <div class="py-3">
                                            <h4 class="text-xs sm:text-sm xl:text-md font-bold">
                                                <a href="{{route('product', $order_item->product->slug)}}"
                                                   class="inline-block hover:text-pink">
                                                    {{$order_item->product->title}}
                                                </a>
                                            </h4>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-6 bg-card">
                                    <div class="font-medium whitespace-nowrap"> {{$order_item->price}}</div>
                                </td>
                                <td class="py-4 px-6 bg-card"> {{$order_item->quantity}}</td>
                                <td class="py-4 px-6 bg-card rounded-r-2xl">
                                    <div class="font-medium whitespace-nowrap">{{$order_item->amount}}</div>
                                </td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="flex flex-col-reverse md:flex-row md:items-center md:justify-between mt-8 gap-6">
                    <div class="flex md:justify-end">
                        <a href="{{route('account.orders')}}" class="btn btn-pink">←&nbsp; Вернуться назад</a>
                    </div>
                    <div class="text-[32px] font-bold md:text-right">Итого: {{$order->amount}}</div>
                </div>

            </section>

        </div>
    </main>
@endsection
