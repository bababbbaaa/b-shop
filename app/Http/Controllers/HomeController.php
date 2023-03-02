<?php

namespace App\Http\Controllers;

use Domain\Catalog\ViewModels\BrandViewModel;
use Domain\Catalog\ViewModels\CategoryViewModel;
use Domain\Product\Models\Product;

class HomeController extends Controller {
    public function __invoke() {


        $categories = CategoryViewModel::make()->homePage();
        $brands     = BrandViewModel::make()->homePage();
        $products   = Product::query()->homePage()->get();

        return view( 'home', compact( [
            'categories',
            'brands',
            'products',
        ] ) );
    }
}
