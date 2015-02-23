<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class EstanteVirtual extends CI_Controller {

    public $css = null;
    public $js = null;
    public $usuario;
    public $cod_empresa;

    public function __construct() {
        parent::__construct();
        //$this->css = array('cadastroempresa','bootstrap', 'menu', 'small-business', 'painel_user', 'tabs','hover','../lighter/css/lighter');
        $this->css=array('cadastroempresa','bootstrap','menu','small-business','painel_user','tabs','hover','../lighter/css/lighter','star-rating.min');   
        $this->js = array('jquery-1.10.2', 'bootstrap', 'funcoesComuns', 'jquery.maskedinput.min','jquery.dataTables.min','jquery.form.min','bootstrap-filestyle.min' ,'star-rating.min');
        //$this->load->helper();
       $this->load->model('pedido_model', 'pedido');
        $this->load->model('usuario_model', 'usuarios');
//        $this->load->model('atendente_model', 'atendente');
//        $this->load->model('farmaceutico_model', 'farmaceutico');
//        $this->load->model('medico_model', 'medico');
//        $this->load->model('config_model', 'configGeral');

        $this->usuario = $this->session->userdata('cod_usuario');
        $this->cod_empresa= $this->session->userdata('cod_empresa');
        
    }
    public function meusLivros($opt="") {
      $this->verificador->verificarLogado();
       $data['numQuantLi']='20';
        $data['numQuantLendo']='24';
        $data['numQuantTenho']=$data['numQuantLi']+$data['numQuantLendo'];
        $data ['usuario']=  $this->usuarios->getUsuario( $this->usuario);
      //die($opt);
        //mudar a query
      
         if($opt=='nao_lidos'){
             $data['titulo_legenda']='Livro(s) que estou lendo.';
            //buscar somente os livros que estou lendo
        }else if($opt=='estou_lendo'){
             $data['titulo_legenda']='Livro(s) que estou lendo.';
            //buscar somente os livros que estou lendo
        }else if($opt=='lidos'){
            $data['titulo_legenda']='Livro(s) que já li.';
            //buscar somente os livros lidos
        }else {
            $data['titulo_legenda']='Meus Livros.';
            //buscar todos meus livros
        }
//        $data['queroLivros']=array(
//            array('id'=>1,'capa'=>'http://tigubarcelos.files.wordpress.com/2008/07/capa_livro.jpg','autor'=>'Ivan Rufino Martins e bragança','titulo'=>'A noiva de todos os homens casados'),
//            array('id'=>2,'capa'=>'http://tigubarcelos.files.wordpress.com/2008/07/capa_livro.jpg','autor'=>'Ivan Rufino Martins e bragança','titulo'=>'A noiva de todos os homens casados'),
//            array('id'=>3,'capa'=>'http://tigubarcelos.files.wordpress.com/2008/07/capa_livro.jpg','autor'=>'Ivan Rufino Martins e bragança','titulo'=>'A noiva de todos os homens casados'),
//            array('id'=>4,'capa'=>'http://tigubarcelos.files.wordpress.com/2008/07/capa_livro.jpg','autor'=>'Ivan Rufino Martins e bragança','titulo'=>'A noiva de todos os homens casados'),
//            array('id'=>5,'capa'=>'http://tigubarcelos.files.wordpress.com/2008/07/capa_livro.jpg','autor'=>'Ivan Rufino Martins e bragança','titulo'=>'A noiva de todos os homens casados'),
//            array('id'=>6,'capa'=>'http://tigubarcelos.files.wordpress.com/2008/07/capa_livro.jpg','autor'=>'Ivan Rufino Martins e bragança','titulo'=>'A noiva de todos os homens casados'),
//            array('id'=>7,'capa'=>'http://tigubarcelos.files.wordpress.com/2008/07/capa_livro.jpg','autor'=>'Ivan Rufino Martins e bragança','titulo'=>'A noiva de todos os homens casados'),
//            array('id'=>8,'capa'=>'http://tigubarcelos.files.wordpress.com/2008/07/capa_livro.jpg','autor'=>'Ivan Rufino Martins e bragança','titulo'=>'A noiva de todos os homens casados'),
//        );
       // print_r($data);
      //  die();
     // die($this->session->userdata('logged_in'));
        $data['mensageFaixa']="";
        $tela = array('cabecalho' => 'telas/cabecalho.php',
            'topo' => 'telas/vazio.php', //mostrar o topo somente quando n�o for a tela de login
            'faixa_horizontal' => 'telas/faixa_horizontal.php',
            'lateral' => 'telas/lateral.php',
            'conteudo' => 'telas/livros_tenho.php');
        $this->parser->adc_css($this->css);
        $this->parser->adc_js($this->js);
        $this->parser->mostrar('templates/template_corpo.php', $tela, $data);
    }
    
    public function adcionarLivro($codigo) {
        echo $codigo;
    }
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */