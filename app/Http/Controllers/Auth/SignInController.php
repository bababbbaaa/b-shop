<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignInFormRequest;
use Domain\Auth\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Support\SessionRegenerator;

class SignInController extends Controller {
    public function page(): Factory|View|Application {

        return view( 'auth.login' );
    }

    public function handle( SignInFormRequest $request ): RedirectResponse {

        if ( ! auth()->attempt( $request->validated() ) ) {
            return back()->withErrors( [
                'email' => 'Предоставленные учетные данные не соответствуют нашим записям.',
            ] )->onlyInput( 'email' );
        }

        $user = User::query()
                    ->where( 'email', $request->validated()['email'] )
                    ->first();

        SessionRegenerator::run( fn() => auth()->login( $user ) );

        return redirect()->intended( route( 'home' ) );

    }

    public function logout(): RedirectResponse {


        SessionRegenerator::run( fn() => auth()->logout() );

        return redirect()->route( 'home' );
    }

}
