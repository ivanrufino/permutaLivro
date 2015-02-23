<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Empresa extends CI_Controller { 
    public $css=null;
    public $js=null;
    public function __construct() {
        parent::__construct();
        $this->css=array('bootstrap','menu','small-business');
        $this->js=array('jquery-1.10.2','bootstrap');
                //$this->load->helper();
                //$this->load->model();
        }
     public function index(){ 
         if (! $this->session->userdata('logged_admin_in')){
                redirect('empresa/login');
               
        }else{
                redirect('empresa/admin');
        }
        /*$data[]="";
        $data['mensageFaixa']="Outra frase qualquer";
            //$this->load->view('welcome_message');
             //  Os scripts e css podem ser adicionados tanto em um único comando ou em vários, bastando passar a info por array ou não
         $tela=array(
             'cabecalho'=>'telas/cabecalho_menu.php', 
            'topo'=>'telas/topo.php', 
            'faixa_horizontal'=>'telas/faixa_horizontal.php',
             'conteudo'=>'telas/conteudo.php',
        );
        
 
        $this->parser->adc_css($this->css);
        $this->parser->adc_js($this->js);
        $this->parser->mostrar('templates/template_corpo.php',$tela,$data);*/
    }
    public function login()  {
        $data[]="";
        $data['mensageFaixa']="Entre com  suas informações de adminstrador, <br> Se for novo aqui, cadastre sua empresa";
        $data['mensagem_erro']="";
        $tela=array(
             'cabecalho'=>'telas/cabecalho_menu.php', 
            'topo'=>'telas/vazio.php', //mostrar o topo somente quando n�o for a tela de login
            'faixa_horizontal'=>'telas/faixa_horizontal.php',
             'conteudo'=>'telas/login_admin.php',
        );
        
 
        $this->parser->adc_css($this->css);
        $this->parser->adc_js($this->js);
        $this->parser->mostrar('templates/template_corpo.php',$tela,$data);
    }
    public function admin(){
        echo "Voce esta em admin";
    }
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */