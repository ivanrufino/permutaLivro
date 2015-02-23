<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Teste extends CI_Controller {
    public function __construct() {
    parent::__construct();
    
    }
    public function index() {
        echo "<a href='https://www.facebook.com/dialog/oauth?client_id=1559535154288023&redirect_uri=http%3A%2F%2Fwww.login.com.br%2Fauth%2Fsession%2Ffacebook.html&state=f7f6277dc5d99aa13b688e1c60e50d2f&sdk=php-sdk-3.2.3&scope=email%2Cpublic_profile%2Cuser_friends'>entrar</a>";
        //redirect('Auth/session/facebook');
    }
}
