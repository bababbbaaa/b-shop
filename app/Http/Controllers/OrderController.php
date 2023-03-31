<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderFormRequest;
use Domain\Cart\Models\Cart;
use Domain\Cart\Models\CartItem;
use Domain\Order\Actions\NewOrderAction;
use Domain\Order\Exceptions\OrderProcessException;
use Domain\Order\Exceptions\PaymentProviderException;
use Domain\Order\Models\DeliveryType;
use Domain\Order\Models\Order;
use Domain\Order\Models\PaymentMethod;
use Domain\Order\Payment\PaymentData;
use Domain\Order\Payment\PaymentSystem;
use Domain\Order\Processes\AssignCustomer;
use Domain\Order\Processes\AssignProducts;
use Domain\Order\Processes\ChangeStateToPending;
use Domain\Order\Processes\CheckProductQuantities;
use Domain\Order\Processes\ClearCart;
use Domain\Order\Processes\DecreaseProductsQuantities;
use Domain\Order\Processes\OrderProcess;
use DomainException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Support\ValueObjects\Price;

class OrderController extends Controller {
    public function index(): Factory|View|Application {
        $items = cart()->items();
        if ( $items->isEmpty() ) {
            throw new DomainException( 'Корзина пуста' );
        }

        return view( 'order.order', [
            'items'      => $items,
            'payments'   => PaymentMethod::query()->get(),
            'deliveries' => DeliveryType::query()->get(),
        ] );
    }

    // TODO DTO Customer

    /**
     * @throws PaymentProviderException
     */
    public function handle( OrderFormRequest $request, NewOrderAction $action ): RedirectResponse {

        $order = $action( $request );

        $customer = request( 'customer' );

        if ( $order->paymentMethod->redirect_to_pay ) {
            $url = PaymentSystem::create( new PaymentData(
                $order->id,
                $customer['email'],
                cart()->amount(),
                'Покупка товара в магазине CoffeeBoom на сумму ' . cart()->amount(),
            ) )->url();
        }

        ( new OrderProcess( $order ) )->processes( [
            new CheckProductQuantities(),
            new AssignCustomer( $customer ),
            new AssignProducts(),
            new ChangeStateToPending(),
            new DecreaseProductsQuantities(),
            new ClearCart()
        ] )->run();

        if ( isset( $url ) ) {
            return redirect( $url );
        }

        session()->put( session_id(), $order->id );

        return redirect()->route( 'order.success' );
    }


    public function success(): Factory|View|Application {

        if ( ! $order_id = session( session_id() ) ) {
            return abort( 404 );
        }

        $order = Order::query()
                      ->where( 'id', $order_id )
                      ->firstOrFail();

        return view( 'order.success', compact( 'order' ) );
    }

}
