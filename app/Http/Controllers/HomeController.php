<?php

namespace App\Http\Controllers;

use App\Models\Seo;
use Domain\Catalog\ViewModels\BrandViewModel;
use Domain\Catalog\ViewModels\CategoryViewModel;
use Domain\Catalog\ViewModels\ProductViewModel;
use Domain\Post\ViewModels\PostViewModel;
use Domain\Product\Models\Product;

class HomeController extends Controller {
    public function __invoke() {


        $categories = CategoryViewModel::make()->homePage();
        $brands     = BrandViewModel::make()->homePage();
        $posts      = PostViewModel::make()->homePage();
        $products   = ProductViewModel::make()->homePage();

        return view( 'home', compact( [
            'categories',
            'brands',
            'products',
            'posts',
        ] ) );
    }
}
