<?php

namespace App\Http\Middleware;

use App\Models\Seo;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SeoMiddleware {
    public function handle( Request $request, Closure $next ) {

        $seo = Cache::rememberForever( 'seo_' . str( $request->getPathInfo() )->slug( '_' ), function () use ( $request ) {
            return Seo::query()->where( 'url', $request->getPathInfo() )->first() ?? false;
        } );


        if ( $seo ) {
            view()->share( 'seo_title', $seo->seo_title );
            view()->share( 'seo_description', $seo->seo_description );
            view()->share( 'seo_keywords', $seo->seo_keywords );
            view()->share( 'seo_text', $seo->seo_text );
        }

        return $next( $request );
    }
}
