<?php

namespace App\Http\Controllers\MercadoLivre;

use Ceman\Meli;
use Cookie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MLController extends Controller
{
    public function index()
    {
        $meli = new Meli(config('mercadolivre.app_id'), config('mercadolivre.secret_key'));

        if(isset($_GET['code']) || isset($_SESSION['access_token'])) {
            // If code exist and session is empty
            if(isset($_GET['code']) && !isset($_SESSION['access_token'])) {
                // //If the code was in get parameter we authorize
                try{
                    $user = $meli->authorize($_GET["code"], config('mercadolivre.redirect_uri'));

                    // Now we create the sessions with the authenticated user
                    $_SESSION['access_token'] = $user['body']->access_token;
                    $_SESSION['expires_in'] = time() + $user['body']->expires_in;
                    $_SESSION['refresh_token'] = $user['body']->refresh_token;

                    Cookie::queue(Cookie::make('ml_access_token', time() + $user['body']->expires_in, time() + $user['body']->expires_in));

                    return $user;
                }catch(\Exception $e){
                    echo "Exception: ",  $e->getMessage(), "\n";
                }
            } else {
                // We can check if the access token in invalid checking the time
                if($_SESSION['expires_in'] < time()) {
                    try {
                        // Make the refresh proccess
                        $refresh = $meli->refreshAccessToken();
                        // Now we create the sessions with the new parameters
                        $_SESSION['access_token'] = $refresh['body']->access_token;
                        $_SESSION['expires_in'] = time() + $refresh['body']->expires_in;
                        $_SESSION['refresh_token'] = $refresh['body']->refresh_token;
                    } catch (\Exception $e) {
                        echo "Exception: ",  $e->getMessage(), "\n";
                    }
                }
            }

        } else {
            echo '<a href="' . $meli->getAuthUrl(config('mercadolivre.redirect_uri'), Meli::$AUTH_URL[config('mercadolivre.site')]) . '">Login using MercadoLibre oAuth 2.0</a>';
        }
    }

    public function send()
    {

    }
}
