@extends('layout.app')

@section('title', 'B-Shop - Каталог')

@section('content')
    <main class="py-16 lg:py-20">
        <div class="container">

            <!-- Breadcrumbs -->
            <ul class="breadcrumbs flex flex-wrap gap-y-1 gap-x-4 mb-6">
                <li><a href="{{route('home')}}" class=" hover:text-pink text-xs">Главная</a></li>
                @if($category->exists)
                    <li><a href="{{route('catalog')}}" class=" hover:text-pink text-xs">Каталог</a></li>
                    <li><span class="text-xs">{{$category->title}}</span></li>
                @else
                    <li><span class="text-xs">Каталог</span></li>
                @endif
            </ul>

            <section>
                <!-- Section heading -->
                <h2 class="text-lg lg:text-[42px] font-bold">Категории</h2>

                <!-- Categories -->
                <div class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-5 gap-3 sm:gap-4 md:gap-5 mt-8">
                    @each('catalog.shared.category', $categories, 'item')
                </div>
            </section>

            <section class="mt-16 lg:mt-24">
                <!-- Section heading -->
                <h2 class="text-lg lg:text-[42px] font-bold">Каталог товаров</h2>

                <div class="flex flex-col lg:flex-row gap-12 lg:gap-6 2xl:gap-8 mt-8">

                    <!-- Filters -->
                    <aside class="basis-2/5 xl:basis-1/4">
                        <form
                            action="{{route('catalog', $category)}}"
                            class="overflow-auto max-h-[320px] lg:max-h-[100%] space-y-10 p-6 2xl:p-8 rounded-2xl bg-card">


                            @foreach(filters() as $filter)
                                {!! $filter !!}
                            @endforeach
                            <input type="hidden" name="sort" value="{{request('sort')}}">
                            <button type="submit" class="w-full !h-16 btn btn-pink">Найти</button>

                            @if(request('filters'))
                                <a href="{{route('catalog', $category)}}" class="w-full !h-16 btn btn-outline">Сбросить
                                    фильтры</a>
                            @endif
                        </form>
                    </aside>

                    <div class="basis-auto xl:basis-3/4">
                        <!-- Sort by -->
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                            <div class="flex items-center gap-4">
                                <div class="flex items-center gap-2">
                                    <a href="{{filter_url($category, ['view' => 'grid'])}}"
                                       class="@if(is_catalog_view('grid')) pointer-events-none text-pink @endif inline-flex items-center justify-center w-10 h-10 rounded-md bg-card hover:text-pink">
                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                             viewBox="0 0 52 52">
                                            <path fill-rule="evenodd"
                                                  d="M2.6 28.6h18.2a2.6 2.6 0 0 1 2.6 2.6v18.2a2.6 2.6 0 0 1-2.6 2.6H2.6A2.6 2.6 0 0 1 0 49.4V31.2a2.6 2.6 0 0 1 2.6-2.6Zm15.6 18.2v-13h-13v13h13ZM31.2 0h18.2A2.6 2.6 0 0 1 52 2.6v18.2a2.6 2.6 0 0 1-2.6 2.6H31.2a2.6 2.6 0 0 1-2.6-2.6V2.6A2.6 2.6 0 0 1 31.2 0Zm15.6 18.2v-13h-13v13h13ZM31.2 28.6h18.2a2.6 2.6 0 0 1 2.6 2.6v18.2a2.6 2.6 0 0 1-2.6 2.6H31.2a2.6 2.6 0 0 1-2.6-2.6V31.2a2.6 2.6 0 0 1 2.6-2.6Zm15.6 18.2v-13h-13v13h13ZM2.6 0h18.2a2.6 2.6 0 0 1 2.6 2.6v18.2a2.6 2.6 0 0 1-2.6 2.6H2.6A2.6 2.6 0 0 1 0 20.8V2.6A2.6 2.6 0 0 1 2.6 0Zm15.6 18.2v-13h-13v13h13Z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    </a>
                                    <a href="{{filter_url($category, ['view' => 'list'])}}"
                                       class="@if(is_catalog_view('list')) pointer-events-none text-pink @endif inline-flex items-center justify-center w-10 h-10 rounded-md bg-card  hover:text-pink">
                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                             viewBox="0 0 52 52">
                                            <path fill-rule="evenodd"
                                                  d="M7.224 4.875v4.694h37.555V4.875H7.224ZM4.877.181a2.347 2.347 0 0 0-2.348 2.347v9.389a2.347 2.347 0 0 0 2.348 2.347h42.25a2.347 2.347 0 0 0 2.347-2.347v-9.39A2.347 2.347 0 0 0 47.127.182H4.877Zm2.347 23.472v4.694h37.555v-4.694H7.224Zm-2.347-4.695a2.347 2.347 0 0 0-2.348 2.348v9.389a2.347 2.347 0 0 0 2.348 2.347h42.25a2.347 2.347 0 0 0 2.347-2.348v-9.388a2.347 2.347 0 0 0-2.347-2.348H4.877ZM7.224 42.43v4.695h37.555v-4.694H7.224Zm-2.347-4.694a2.347 2.347 0 0 0-2.348 2.347v9.39a2.347 2.347 0 0 0 2.348 2.346h42.25a2.347 2.347 0 0 0 2.347-2.347v-9.389a2.347 2.347 0 0 0-2.347-2.347H4.877Z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    </a>
                                </div>
                                <div class=" text-xxs sm:text-xs">
                                    Найдено: {{trans_choice(':count товар|:count товара|:count товаров', (int)$products->total(), [], 'ru')}}</div>
                            </div>
                            <div x-data="{sort: '{{filter_url($category, ['sort' => request('sort')])}}'}"
                                 class="flex flex-col sm:flex-row sm:items-center gap-3">
                                <span class=" text-xxs sm:text-xs whitespace-nowrap">Сортировать по</span>

                                <select name="sort"
                                        x-model="sort"
                                        x-on:change="window.location = sort"

                                        class="form-select text-black w-full h-14 px-4 rounded-lg border border-[#85552d] bg-white/20 focus:border-pink focus:shadow-[0_0_0_2px_#85552d] outline-none transition text-xxs md:text-xs font-semibold">

                                    <option value="{{filter_url($category, ['sort' => ''])}}" class="text-dark">по
                                        умолчанию
                                    </option>
                                    <option value="{{filter_url($category, ['sort' => 'price'])}}"
                                            class="text-dark">от дешевых к дорогим
                                    </option>
                                    <option value="{{filter_url($category, ['sort' => '-price'])}}"
                                            class="text-dark">от дорогих к дешевым
                                    </option>
                                    <option value="{{filter_url($category, ['sort' => 'title'])}}"
                                            class="text-dark">наименованию
                                    </option>
                                </select>

                            </div>
                        </div>


                        <div
                            class="products grid grid-cols-1 gap-y-8 @if(is_catalog_view('grid')) sm:grid-cols-2 xl:grid-cols-3 gap-x-6 2xl:gap-x-8 lg:gap-y-10 2xl:gap-y-12 @endif">
                            @each('catalog.shared.product' . (is_catalog_view('list') ? '-inline' : ''), $products, 'item')
                        </div>

                        <div class="mt-12">
                            {{$products->withQueryString()->links()}}
                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main>
@endsection
