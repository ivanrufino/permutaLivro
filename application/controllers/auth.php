<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url_helper');
    }

    public function index() {
        /* facebook */
        $provider = $this->oauth2->provider('Facebook', array(
            'id' => '755823537846565',
            'secret' => 'bb2ba923ee25e0ce2740803721a14e5f',
        ));echo "aqui";
    }

    public function session($provider) {
        $provider = $this->oauth2->provider($provider, $this->getProviderArray($provider));

        if (!$this->input->get('code')) {
           
            // By sending no options it'll come back here
            $url = $provider->authorize();
            echo "<a href='$url'>Acessar</a>";
        } else {
            // Howzit?
            try {
                $code = $this->input->get('code'); //"AQA56WaiBhIG7fe7btHL9eCCw3-3Y74fldbgN0PtXRMqMCgYDSdjaerXpCgrrXPOQrojKTeM0yG7jM-gJez2tcbO-y4KalCnI6VfwObw-x5sH090twvoKLX7-nS_I2rMtSOIdlYxmLe6nPSJID3CsZvY3oRjN9t-ajlpcVFaVL5odDVFHMy08_3uHnGaJM7j0RR2D1P5zrXifUeceNWQmKBvxJ2_vrKDdJksD0ijQWJdGGWh8GTSz__h3OcNba4mGOJrgkoNGViVk7qq3QZMbU6iLbliMnrnvIEZufAOfPxUjw-LVt-MvBiDtQiH4ejIPjGhkOuu1tF3kVepiSQU_FKn&state=f7f6277dc5d99aa13b688e1c60e50d2f#_=_";
                $token = $provider->access($code);

                $user = $provider->get_user_info($token);

                // Here you should use this information to A) look for a user B) help a new user sign up with existing data.
                // If you store it all in a cookie and redirect to a registration page this is crazy-simple.
                echo "<pre>Tokens: ";
                var_dump($token);

                echo "\n\nUser Info: ";
                var_dump($user);
                echo "<img src='" . $user['image'] . "'>";
            } catch (OAuth2_Exception $e) {
                $this->passo('4');
                show_error('That didnt work: ' . $e);
            }
        }
    }
    public function getProviderArray($rede) {
        $dados['Facebook'] = array('id' => '755823537846565', 'secret' => 'bb2ba923ee25e0ce2740803721a14e5f');
        $dados['Google'] = array('id' => '1099466398618-v9otoh2rtol7rpbaddtpfsivfsisvuj5.apps.googleusercontent.com', 'secret' => '3ouxfDwjh_MZtUA1L9mwV6TZ');
        $dados['Instagram']=array('id' => 'b96dc8b4b4eb4964bb522ca88246a1d7','secret' => '4b522ebaad9d47d28d1cdca83185d890');
        $dados['Windowslive'] = array('id' => '0000000048145D2E', 'secret' => 'tNg6gGXoeTNIkGc3JeUWhFhRppuCKVoB');
        $dados['Linkedin'] = array('id' => '78nipe5g2bgn5u', 'secret' => 'NN6BqkpINlUHNnav');
        return $dados[ucfirst($rede)];
    }
    public function passo($passo) {
        echo "passo $passo <br>";
    }

   

}
