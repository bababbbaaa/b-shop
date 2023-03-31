<?php

namespace App\Http\Controllers;

use Domain\Order\Models\Order;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AccountController extends Controller {
    public function orders(): Factory|View|Application {
        $orders = auth()->user()->orders;

        return view( 'account.orders', compact( 'orders' ) );
    }

    public function order( Order $order ): Factory|View|Application {
        return view( 'account.order', compact( 'order' ) );
    }

    public function edit(): Factory|View|Application {
        return view( 'auth.edit' );
    }
}
