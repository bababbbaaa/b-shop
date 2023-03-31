<?php

namespace Domain\Order\Payment\Gateways;

use Domain\Order\Contracts\PaymentGatewayContract;
use Domain\Order\Exceptions\PaymentProviderException;
use Domain\Order\Payment\PaymentData;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Lexty\Robokassa\Auth;
use Lexty\Robokassa\Payment;

class RoboKassa implements PaymentGatewayContract {

    protected Payment $kassa;

    protected PaymentData $payment_data;
    protected string $paymentId;

    public function __construct() {
        $this->kassa = new Payment(
            $this->configure( [
                'login'  => config( 'payment.robokassa.login' ),
                'pass_1' => config( 'payment.robokassa.pass_1' ),
                'pass_2' => config( 'payment.robokassa.pass_2' ),
            ] )
        );
    }


    /**
     * @throws PaymentProviderException
     */
    public function validate(): mixed {

        $request = request()->all();

        $validator = Validator::make( $request, [
            'OutSum'         => 'required',
            'InvId'          => 'required',
            'SignatureValue' => 'required',
        ] );

        $this->paymentId = $request['InvId'];

        if ( $validator->fails() ) {
            throw PaymentProviderException::validateFails();
        }

        return $this->paymentId;
    }


    public function paymentId(): string {
        return $this->paymentId;
    }

    public function paid(): bool {
        return true;
    }

    public function errorMessage(): PaymentGatewayContract {
        return $this;
    }

    public function configure( array $config ): Auth {
        return new Auth(
            $config['login'],
            $config['pass_1'],
            $config['pass_2'],
            true );
    }

    public function data( PaymentData $data ): PaymentGatewayContract {
        $this->payment_data = $data;

        return $this;
    }

    /**
     * @throws PaymentProviderException
     */
    public function request(): string {
        $this->kassa
            ->setTest( 1 )
            ->setId( $this->payment_data->id )
            ->setEmail( $this->payment_data->email )
            ->setSum( (float) $this->payment_data->amount->value() )
            ->setReceipt( $this->receipt() )
            ->setCulture( Payment::CULTURE_RU )
            ->setDescription( $this->payment_data->description );

        try {
            $request = Http::get( $this->kassa->getPaymentUrl() )->collect();

            if ( $request = $request->get( 'invoiceID' ) ) {
                return $request;
            }

            throw PaymentProviderException::serviceFails();

        } catch ( PaymentProviderException $e ) {
            throw $e::serviceFails();
        }

    }

    public function receipt(): string {

        $cart = [];

        foreach ( cart()->items() as $item ) {
            $cart[] = [
                'name'           => $item->product->title,
                'quantity'       => $item->quantity,
                'sum'            => $item->price->value(),
                'payment_method' => 'full_payment',
                'payment_object' => 'service',
                'tax'            => 'none'
            ];
        }

        $cart = [
            'sno'   => 'usn_income',
            'items' => $cart
        ];

        return urlencode( json_encode( $cart ) );

    }

    /**
     * @throws PaymentProviderException
     */
    public function url(): string {
        return "https://auth.robokassa.ru/Merchant/Index/" . $this->request();
    }

}
