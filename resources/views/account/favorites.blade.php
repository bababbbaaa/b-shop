@extends('layout.app')

@section('title', 'B-Shop - Избранное')

@section('content')
    <main class="py-16 lg:py-20">
        <div class="container">

            <!-- Breadcrumbs -->
            <ul class="breadcrumbs flex flex-wrap gap-y-1 gap-x-4 mb-6">
                <li><a href="{{route('home')}}" class=" hover:text-pink text-xs">Главная</a></li>
                <li><span class=" text-xs">Избранное</span></li>
            </ul>

            <section>
                <!-- Section heading -->
                <h1 class="mb-8 text-lg lg:text-[42px] font-bold">Избранное</h1>

                @if($favoriteItems->isEmpty())
                    <div class="text-white font-medium py-3 px-6 rounded-lg bg-pink ">Здесь пока ни чего нет</div>
                @else
                    <!-- Message -->
                    <div class="lg:hidden py-3 px-6 rounded-lg bg-pink ">Таблицу можно пролистать вправо →
                    </div>

                    <!-- Adaptive table -->
                    <div class="overflow-auto">
                        <table class="min-w-full border-spacing-y-4  text-sm text-left"
                               style="border-collapse: separate">
                            <thead class="text-xs uppercase">
                            <th scope="col" class="py-3 px-6">Товар</th>
                            <th scope="col" class="py-3 px-6">Цена</th>
                            <th scope="col" class="py-3 px-6"></th>
                            </thead>
                            <tbody>

                            @foreach($favoriteItems as $item)
                                <tr>
                                    <td scope="row" class="py-4 px-4 md:px-6 rounded-l-2xl bg-card">
                                        <div class="flex flex-col lg:flex-row min-w-[200px] gap-2 lg:gap-6">
                                            <div
                                                class="shrink-0 overflow-hidden w-[64px] lg:w-[84px] h-[64px] lg:h-[84px] rounded-2xl">
                                                <img
                                                    src="{{$item->product->makeThumbnail('84x84', $item->id, 'resize')}}"
                                                    class="object-cover w-full h-full"
                                                    alt="SteelSeries Aerox 3 Snow">
                                            </div>
                                            <div class="py-3">
                                                <h4 class="text-xs sm:text-sm xl:text-md font-bold">
                                                    <a href="{{route('product', $item->product->slug)}}"
                                                       class="inline-block  hover:text-pink">
                                                        {{$item->product->title}}
                                                    </a></h4>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-4 md:px-6 bg-card">
                                        <div class="font-medium whitespace-nowrap">{{$item->product->price}}</div>
                                    </td>

                                    <td class="py-4 px-4 md:px-6 rounded-r-2xl bg-card">
                                        <form action="{{route('favorite.delete', $item->product->id)}}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button href="#" class="w-12 !h-12 !px-0 btn btn-pink"
                                                    title="Удалить из избранного">
                                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg"
                                                     fill="currentColor"
                                                     viewBox="0 0 52 52">
                                                    <path
                                                        d="M49.327 7.857H2.673a2.592 2.592 0 0 0 0 5.184h5.184v31.102a7.778 7.778 0 0 0 7.776 7.776h20.735a7.778 7.778 0 0 0 7.775-7.776V13.041h5.184a2.592 2.592 0 0 0 0-5.184Zm-25.919 28.51a2.592 2.592 0 0 1-5.184 0V23.409a2.592 2.592 0 1 1 5.184 0v12.96Zm10.368 0a2.592 2.592 0 0 1-5.184 0V23.409a2.592 2.592 0 1 1 5.184 0v12.96ZM20.817 5.265h10.367a2.592 2.592 0 0 0 0-5.184H20.817a2.592 2.592 0 1 0 0 5.184Z"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>

                @endif


            </section>

        </div>
    </main>
@endsection
