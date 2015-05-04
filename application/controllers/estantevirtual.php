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
        $this->css = array('cadastroempresa', 'bootstrap', 'menu', 'small-business', 'painel_user', 'tabs', 'hover', '../lighter/css/lighter', 'star-rating.min','comuns');
        $this->js = array('jquery-1.10.2', 'bootstrap', 'funcoesComuns', 'jquery.maskedinput.min', 'jquery.dataTables.min', 'jquery.form.min', 'bootstrap-filestyle.min', 'star-rating.min');
        //$this->load->helper();
        $this->load->model('pedido_model', 'pedido');
        $this->load->model('usuario_model', 'usuarios');
        $this->load->model('estanteVirtual_model', 'ev');


        $this->usuario = $this->session->userdata('cod_usuario');
        $this->cod_empresa = $this->session->userdata('cod_empresa');
    }

    public function meusLivros($opt = "") {
        $this->verificador->verificarLogado();
        
        $data ['usuario'] = $this->usuarios->getUsuario($this->usuario);
        $data['usuario']['porcentagem']= $this->dadoslateral->calculaPontuacao($data['usuario']['TITULO_QUALIFICACAO']);
        $data += $this->dadoslateral->quantidadesLivros($this->usuario);
        $data['livro_in'] = 'in';
        
        if ($opt == 'nao_lidos') {
            $data['titulo_legenda'] = 'Livro(s) que estou lendo.';
             $data['queroLivros']= $this->ev->getLivros($this->usuario,'0');
        } else if ($opt == 'estou_lendo') {
            $data['titulo_legenda'] = 'Livro(s) que estou lendo.';
            $data['queroLivros']= $this->ev->getLivros($this->usuario,'2');
            //buscar somente os livros que estou lendo
        } else if ($opt == 'lidos') {
            $data['titulo_legenda'] = 'Livro(s) que já li.';
            $data['queroLivros']= $this->ev->getLivros($this->usuario,'1');
            //buscar somente os livros lidos
        } else {
            $data['titulo_legenda'] = 'Meus Livros.';
            $data['queroLivros']= $this->ev->getLivros($this->usuario);
        }
       
       
        $data['mensageFaixa'] = $this->session->flashdata('msgPedido');
        $tela = array('cabecalho' => 'telas/cabecalho.php',
            'topo' => 'telas/vazio.php', //mostrar o topo somente quando não for a tela de login
            'faixa_horizontal' => 'telas/faixa_horizontal.php',
            'lateral' => 'telas/lateral.php',
            'conteudo' => 'telas/livros_tenho.php');
        $this->parser->adc_css($this->css);
        $this->parser->adc_js($this->js);
        $this->parser->mostrar('templates/template_corpo.php', $tela, $data);
    }

    public function adcionarLivro($cod_livro) {
        $dados['COD_USUARIO'] = $this->usuario;
        if (is_int($cod_livro)){
            $dados['COD_LIVRO'] = $cod_livro;
        }else{
            $dados['COD_LIVRO']= end(explode("_", $cod_livro));
        }
        
       
        $codPedido = $this->ev->novoLivro($dados);
        if ($codPedido === false) {
            $msg = "<div class='alert alert-danger'>" . $this->mensagens->getMessage('falhaGravacao') . "</div>";
        }else {
            if ($codPedido=='existe'){
                $msg = "<div class='alert alert-info'>" . $this->mensagens->getMessage('livroExistenteEstante') . "</div>";
            }else{
                $msg = "<div class='alert alert-success'>" . $this->mensagens->getMessage('estanteGravado') . "</div>";
            }
        }
 
        $this->session->set_flashdata('msgPedido', $msg);
        redirect('meus_livros');
    }
    public function editaLivro() {
        $dados['COD_LIVRO'] = $this->input->post('codLivro');
        $dados['STATUS'] = $this->input->post('STATUS');
        $dados['ESCOPO'] = $this->input->post('ESCOPO');
       // echo $cod_livro;
        //print_r ($dados);
        if($this->ev->alterarEstante($this->usuario, $dados)){
            echo "<div class='alert alert-success'> Dados salvos com sucesso.</div>";
        }else{
            echo "<div class='alert alert-danger'>Houve um erro na gravação dos dados.</div>";
        }
    }
    
  

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */