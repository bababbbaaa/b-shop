@extends('layout.app')

@section('title', 'B-Shop - Оформление заказа')

@section('content')
    <main class="py-16 lg:py-20">
        <div class="container">

            <!-- Breadcrumbs -->
            <ul class="breadcrumbs flex flex-wrap gap-y-1 gap-x-4 mb-6">
                <li><a href="/" class=" hover:text-pink text-xs">Главная</a></li>
                <li><span class=" text-xs">Заказ №4820 успешно оформлен</span></li>
            </ul>

            <section>
                <!-- Section heading -->
                <div class="flex flex-col 2xl:flex-row 2xl:items-center gap-3 md:gap-6 mb-8">
                    <h1 class="pb-4 2xl:pb-0 text-lg lg:text-[42px] grow font-bold">Заказ №{{$order->id}} успешно
                        оформлен</h1>
                    <div class="">
                        <div class="px-6 py-3 rounded-lg status-{{$order->status->value()}} ">
                            Статус: {{$order->status->humanValue()}}
                        </div>
                    </div>
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

                <div class="mt-12">
                    <!-- Summary -->

                    <table class="w-full text-left">
                        <tbody>
                        <tr>
                            <th scope="row" class="pb-2 text-xs font-medium">Имя и фамилия:</th>
                            <td class="pb-2 text-xs">{{$order->orderCustomer->first_name}} {{ $order->orderCustomer->last_name }}</td>
                        </tr>
                        <tr>
                            <th scope="row" class="pb-2 text-xs font-medium">Номер телефона:</th>
                            <td class="pb-2 text-xs">{{$order->orderCustomer->phone}}</td>
                        </tr>
                        <tr>
                            <th scope="row" class="pb-2 text-xs font-medium">E-mail:</th>
                            <td class="pb-2 text-xs">{{$order->orderCustomer->email}}</td>
                        </tr>
                        <tr>
                            <th scope="row" class="pb-2 text-xs font-medium">Способ доставки:</th>
                            <td class="pb-2 text-xs">{{$order->deliveryType->title}}</td>
                        </tr>
                        <tr>
                            <th scope="row" class="pb-2 text-xs font-medium">Метод оплаты:</th>
                            <td class="pb-2 text-xs">{{$order->paymentMethod->title}}</td>
                        </tr>

                        <tr>
                            <th scope="row" class="pb-2 text-xs font-medium">Промокод:</th>
                            <td class="pb-2 text-xs">15 398 ₽</td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-md 2xl:text-lg font-bold">Итого:</th>
                            <td class="text-md 2xl:text-lg font-bold">{{$order->amount}}</td>
                        </tr>
                        </tbody>
                    </table>

                    <div class="flex flex-wrap gap-4 mt-8">
                        <a href="{{route('catalog')}}" class="btn btn-pink">←&nbsp; За покупками</a>
                        <a href="{{route('account.orders')}}" class="btn btn-purple">Мои заказы</a>
                    </div>
                </div>

            </section>

        </div>
    </main>
@endsection
