@extends('layout.app')

@section('title', 'B-Shop - Главная страница')

@section('content')

    <main class="py-16 lg:py-20">
        <div class="container">
            <section class="">
                <h2 class="text-lg lg:text-[42px] font-bold">Категории</h2>

                <div class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-5 gap-3 sm:gap-4 md:gap-5 mt-8">
                    @each('catalog.shared.category', $categories, 'item')
                </div>
            </section>

            <section class="mt-16 lg:mt-24">
                <h2 class="text-lg lg:text-[42px] font-bold">Каталог товаров</h2>
                <div
                    class="products grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-x-8 gap-y-8 lg:gap-y-10 2xl:gap-y-12 mt-8">
                    @each('catalog.shared.product', $products, 'item')
                </div>
                <div class="mt-12 text-center">
                    <a href="{{route('catalog')}}" class="btn btn-purple">Все товары &nbsp;→</a>
                </div>
            </section>

            <section class="mt-20">
                <h2 class="text-lg lg:text-[42px] font-bold">Бренды</h2>
                <div class="grid grid-cols-2 md:grid-cols-3 2xl:grid-cols-6 gap-4 md:gap-8 mt-12">
                    @each('catalog.shared.brand', $brands, 'item')
                </div>
            </section>

            <section class="mt-20">
                <h2 class="text-lg lg:text-[42px] font-bold">Статьи</h2>
                <div class="grid grid-cols-3 md:grid-cols-3 2xl:grid-cols-3 gap-4 md:gap-8 mt-12">
                    @each('posts.shared.post', $posts, 'item')
                </div>

                <div class="mt-12 text-center">
                    <a href="{{route('posts')}}" class="btn btn-purple">Все статьи &nbsp;→</a>
                </div>
            </section>

        </div>
    </main>
@endsection
