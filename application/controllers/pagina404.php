<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pagina404 extends CI_Controller {

    public $css = null;
    public $js = null;

    public function __construct() {
        parent::__construct();
        $this->css=array('hover','bootstrap','../lighter/css/lighter','animate');
        $this->js = array('jquery-1.10.2','bootstrap','outrasFuncoes');
        //$this->load->helper();
        $this->load->model('home_model', 'home');
        //$this->load->dbforge();
    }

    public function index() {
        echo "Página não encontrada";
        die();
        $data[]="";
        $tela=array('tela_erros'=>'telas/erros/pagina404.php');
 
        $this->parser->adc_css($this->css);
        $this->parser->adc_js($this->js);
        $this->parser->mostrar('templates/template_home.php',$tela,$data);
    }
    public function zip(){
        $this->load->library('zip');
        $data = array(
                'outros/mydata1.txt' => 'A Data String!',
                'outros/mydata2.txt' => 'Another Data String!'
            );

$this->zip->add_data($data);

$this->zip->download('my_backup.zip');
    }

}
