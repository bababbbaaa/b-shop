<?php

use Domain\Favorite\Models\Favorite;
use Domain\Product\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create( 'favorite_items', function ( Blueprint $table ) {
            $table->id();
            $table->foreignIdFor( Favorite::class, 'favorite_id' )->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor( Product::class, 'product_id' )->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
            $table->unique( [ 'favorite_id', 'product_id' ] );
        } );
    }

    public function down(): void {
        if ( ! app()->isProduction() ) {
            Schema::dropIfExists( 'favorite_items' );
        }
    }
};
