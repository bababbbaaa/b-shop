<?php

namespace Database\Factories;

use Domain\Catalog\Models\Brand;
use Domain\Product\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory {

    protected $model = Product::class;

    public function definition(): array {
        return [
            'title'        => ucfirst( $this->faker->words( 2, true ) ),
            'price'        => $this->faker->numberBetween( 100000, 150000 ),
            'old_price'    => $this->faker->numberBetween( 150000, 200000 ),
            'brand_id'     => Brand::query()->inRandomOrder()->value( 'id' ),
            'thumbnail'    => $this->faker->fixturesImage( 'products', 'products' ),
            'on_home_page' => $this->faker->boolean(),
            'sorting'      => $this->faker->numberBetween( 1, 900 ),
            'quantity'     => $this->faker->numberBetween( 20, 100 ),
            'text'         => $this->faker->realText(),
        ];
    }
}
