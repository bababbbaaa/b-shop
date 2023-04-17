<?php

namespace Tests\Feature\App\Http\Controllers;

use App\Http\Controllers\Auth\SignInController;
use App\Http\Controllers\FavoriteController;
use Database\Factories\ProductFactory;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FavoriteControllerTest extends TestCase {
    use RefreshDatabase;

    public function test_is_add_favorite(): void {
        $product = ProductFactory::new()->createOne();

        $user = UserFactory::new()->create( [
            'email' => 'mihail.burlet@gmail.com'
        ] );

        $this->actingAs( $user );

        favorite()->add( $product );

        $this->get( action( [ FavoriteController::class, 'index' ] ) )
             ->assertOk()
             ->assertViewIs( 'account.favorites' )
             ->assertViewHas( 'favoriteItems', favorite()->favoriteItems() );
    }

    public function test_is_delete_favorite(): void {
        $product = ProductFactory::new()->createOne();

        $user = UserFactory::new()->create( [
            'email' => 'mihail.burlet@gmail.com'
        ] );

        $this->actingAs( $user );

        favorite()->add( $product );

        $this->delete( action( [ FavoriteController::class, 'delete' ], $product->id ) );

        $this->assertEquals( 0, favorite()->count() );
    }


}
