<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Teste extends CI_Controller {
    /* medico=1; atendente= 2;atendenteF= 3;paciente= 4; */

    public $css = null;
    public $js = null;
    private $cat = 2;

    public function __construct() {
        parent::__construct();
        $this->css = array('bootstrap', 'menu', 'small-business', 'painel_user', 'tabs');

        $this->js = array('jquery-1.10.2', 'bootstrap', 'funcoesComuns', 'jquery.maskedinput.min');
        //$this->load->helper();
        $this->load->model('usuario_model', 'usuarios');
       
    }
    public function index(){
        
    }

}
