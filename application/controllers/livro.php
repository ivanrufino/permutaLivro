<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Livro extends CI_Controller {

    public $css = null;
    public $js = null;
    public $usuario;
    public $cod_empresa;

    public function __construct() {
        parent::__construct();
        //$this->css = array('cadastroempresa','bootstrap', 'menu', 'small-business', 'painel_user', 'tabs','hover','../lighter/css/lighter');
        $this->css = array('cadastroempresa', 'bootstrap', 'menu', 'small-business', 'painel_user', 'tabs', 'hover', '../lighter/css/lighter','star-rating.min');
        $this->js = array('jquery-1.10.2', 'bootstrap', 'funcoesComuns', 'jquery.maskedinput.min', 'jquery.dataTables.min', 'jquery.form.min', 'bootstrap-filestyle.min','star-rating.min');
        //$this->load->helper();
        /*$this->load->model('empresa_model', 'empresa');
        
        $this->load->model('atendente_model', 'atendente');
        $this->load->model('farmaceutico_model', 'farmaceutico');
        $this->load->model('medico_model', 'medico');
        $this->load->model('config_model', 'configGeral');*/

        $this->usuario = $this->session->userdata('cod_usuario');
        $this->load->model('usuario_model', 'usuarios');
        $this->load->model('estanteVirtual_model', 'ev');
        $this->load->model('livro_model', 'livro');
        $this->load->model('pedido_model', 'pedido');
    }

    public function index() {
        $this->verificador->verificarLogado();
        $data ['usuario'] = $this->usuarios->getUsuario($this->usuario);
        $meusLivros = $this->ev->getLivros($this->usuario);
        $data['numQuantNaoLi'] = '0';
        $data['numQuantLi'] = '0';
        $data['numQuantLendo'] = '0';
        
        foreach ($meusLivros as $value) {
            switch ($value['STATUS']) {
                case '0':
                    $data['numQuantNaoLi'] ++;
                    break;
                case '1':
                    $data['numQuantLi'] ++;
                    break;
                case '2':
                    $data['numQuantLendo'] ++;
                    break;
            }
        }
        $data['numQuantTenho'] = $data['numQuantNaoLi'] + $data['numQuantLi'] + $data['numQuantLendo'];
        

        $data['mensageFaixa'] = "";
        $dados=$this->session->flashdata('dados');
        //var_dump($dados);die();
        if ($dados){
         $data=  array_merge($data,$dados);   
        }
        //print_r($data);die();
        $tela = array('cabecalho' => 'telas/cabecalho.php',
            'topo' => 'telas/vazio.php', //mostrar o topo somente quando n�o for a tela de login
            'faixa_horizontal' => 'telas/faixa_horizontal.php',
            'lateral' => 'telas/lateral.php',
            'conteudo' => 'telas/buscarLivro.php');
        $this->parser->adc_css($this->css);
        $this->parser->adc_js($this->js);
        $this->parser->mostrar('templates/template_corpo.php', $tela, $data);
    }

    public function getLivro($tipo) {
        $busca = "";
        switch ($tipo) {
            case "titulo":
                $titulo = $this->input->post('titulo');
                $busca = $titulo;
                if (trim($titulo) == "") {
                    echo "Campo Título não pode estar vazio";
                    die();
                }
                $data['livros'] = $this->livro->getLivrobyTitulo($titulo);

                break;
            case "autor":
                $autor = $this->input->post('autor');
                $busca = $autor;
                if (trim($autor) == "") {
                    echo "Campo Autor não pode estar vazio";
                    die();
                }
                $data['livros'] = $this->livro->getLivrobyAutor($autor);
                break;
            case "editora":
                $editora = $this->input->post('editora');
                $busca = $editora;
                if (trim($editora) == "") {
                    echo "Campo Editora não pode estar vazio";
                    die();
                }
                $data['livros'] = $this->livro->getLivrobyEditora($editora);
                break;
            case "isbn":
                $isbn = $this->input->post('isbn');
                $busca = $isbn;
                if (trim($isbn) == "") {
                    echo "Campo ISBN não pode estar vazio";
                    die();
                }
                $data['livros'] = $this->livro->getLivrobyIsbn($isbn);
                break;

            default:
                break;
        }

        if ($data['livros']) {
            echo $this->load->view('telas/resultadoBusca', $data, true);
        } else {
            echo "Nenhum livro foi encontrado para o termo de busca: <span style='font-weigh:bold'>$busca</span><br>"
            . "<a href='" . base_url() . "livro/novo'>Clique aqui</a> para cadastrar um novo Livro";
        }
    }

    public function novo() {
        $this->verificador->verificarLogado();
        $data ['usuario'] = $this->usuarios->getUsuario($this->usuario);
        $meusLivros = $this->ev->getLivros($this->usuario);
        $data['numQuantNaoLi'] = '0';
        $data['numQuantLi'] = '0';
        $data['numQuantLendo'] = '0';

        foreach ($meusLivros as $value) {
            switch ($value['STATUS']) {
                case '0':
                    $data['numQuantNaoLi'] ++;
                    break;
                case '1':
                    $data['numQuantLi'] ++;
                    break;
                case '2':
                    $data['numQuantLendo'] ++;
                    break;
            }
        }
        $data['numQuantTenho'] = $data['numQuantNaoLi'] + $data['numQuantLi'] + $data['numQuantLendo'];

        $data['mensageFaixa'] = "";
        $tela = array('cabecalho' => 'telas/cabecalho.php',
            'topo' => 'telas/vazio.php', //mostrar o topo somente quando n�o for a tela de login
            'faixa_horizontal' => 'telas/faixa_horizontal.php',
            'lateral' => 'telas/lateral.php',
            'conteudo' => 'telas/cadastroLivro.php');
        $this->parser->adc_css($this->css);
        $this->parser->adc_js($this->js);
        $this->parser->mostrar('templates/template_corpo.php', $tela, $data);
    }

    public function doLivro() {
        $this->form_validation->set_rules('titulo', 'Titulo', 'required');
        $this->form_validation->set_rules('autor', 'Autor', 'required');
        $this->form_validation->set_rules('ano', 'Ano', 'required|integer');
        $this->form_validation->set_rules('pagina', 'Página', 'required|integer');
        $this->form_validation->set_rules('editora', 'Editora', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->novo();
        } else {
            $dados['TITULO'] = $this->input->post('titulo');
            $dados['AUTOR'] = $this->input->post('autor');
            $dados['ANO'] = $this->input->post('ano');
            $dados['EDICAO'] = $this->input->post('edicao');
            $dados['PAGINAS'] = $this->input->post('pagina');
            $dados['EDITORA'] = $this->input->post('editora');
            $dados['ISBN'] = $this->input->post('isbn');
            //$dados['FOTO'] = '';

            $cod_livro = $this->livro->novoLivro($dados);
            if (!is_null($cod_livro)) {
                $this->session->set_flashdata('msg', '<span class="alert alert-success col-md-12">Livro gravado com sucesso</span>');
                redirect("livro/detalhes/$cod_livro");
            } else {
                $this->session->set_flashdata('msg', '<span class="alert alert-warning col-md-12">Houve uma falha na gravação do livro.<br> Por favor tente novamene </span>');
                redirect('livro/novo');
            }
            // die('agora cadastra e redireciona');
            // $this->load->view('formsuccess');
        }
    }

    public function detalhes($url) {
        $this->verificador->verificarLogado();
        $data ['usuario'] = $this->usuarios->getUsuario($this->usuario);
         $data['usuario']['porcentagem']= $this->calculaPontuacao($data['usuario']['TITULO_QUALIFICACAO']);
        $codigo = end(explode("_", $url));
       // echo $codigo;
        $data['livros'] = $this->livro->getLivrobyCodigo($codigo);
        
        //var_dump($tenho);die();
        $meusLivros = $this->ev->getLivros($this->usuario);
        $data += $this->dadoslateral->quantidadesLivros($this->usuario);
        $data['mensageFaixa'] = "";
        
        $tela = array(
            'cabecalho' => 'telas/cabecalho.php',
           //'topo' => 'telas/vazio.php', //mostrar o topo somente quando n�o for a tela de login
            'faixa_horizontal'      =>  'telas/faixa_horizontal.php',
            'lateral'               =>  'telas/lateral.php',
            'conteudo'              =>  'telas/detalhesLivro.php',
            'livroUsuario'            =>  'telas/vazio.php',
            //'pedidoLivro'           =>  'telas/vazio.php',
            //'adcionarEstantePedido' =>  'telas/vazio.php',
            );
        $tenho=$this->verificaLivroEstante($codigo);
        if ($tenho){
            $tela['livroUsuario']=$tenho;
        }else{ 
            $pedido=$this->verificaLivroPedido($codigo);
            if ($pedido){
                $tela['livroUsuario']=$pedido;
            }else{
                $tela['livroUsuario']='telas/adcionarEstanteouPedido';
            }
        }
        
        //$tela['tenhoLivro'] =$this->verificaLivroEstante($codigo);
        $this->parser->adc_css($this->css);
        $this->parser->adc_js($this->js);
        $this->parser->mostrar('templates/template_corpo.php', $tela, $data);
        /*

         * Buscar os detalhes do livro na tabela de livro
         * verificar se o livro esta na estante do usuario
         *    se estiver perguntar se que retirar ou alterar
         * senao
         *    verificar se esta nos pedidos de solicitação
         *        se estiver, perguntar se deseja remover
         *     senao
         *        perguntar se quer incluir na estante ou fazer uma solicitação de pedido
         * 
         *          */
    }

    public function verificaLivroEstante($cod_livro) {
        $tenho = $this->ev->getLivrosbyCodLivro($this->usuario,$cod_livro);
        if($tenho){
            return "telas/tenhoLivro.php";
        }else{
            return false;
        }
    }
    public function verificaLivroPedido($cod_livro) {
        $pedido = $this->pedido->getLivrosDesejados($this->usuario,$cod_livro);
       // print_r($pedido);die();
        if($pedido){
            return "telas/pedidoLivro.php";
        }else{
            return false;
        }
    }
    public function getAutores() {
        $autores_todos = $this->livro->getAutores();
        $autores_unicos=array();
        foreach ($autores_todos as $value) {
            $array_temp=  explode(",", $value['AUTOR']);
            $autores_unicos = array_merge($autores_unicos , $array_temp);
        }
        $data['autores'] = array_unique( array_map('trim',$autores_unicos));
        natcasesort($data['autores']);
        $this->verificador->verificarLogado();
        $data ['usuario'] = $this->usuarios->getUsuario($this->usuario);
        $meusLivros = $this->ev->getLivros($this->usuario);
        $data['numQuantNaoLi'] = '0';
        $data['numQuantLi'] = '0';
        $data['numQuantLendo'] = '0';

        foreach ($meusLivros as $value) {
            switch ($value['STATUS']) {
                case '0':
                    $data['numQuantNaoLi'] ++;
                    break;
                case '1':
                    $data['numQuantLi'] ++;
                    break;
                case '2':
                    $data['numQuantLendo'] ++;
                    break;
            }
        }
        $data['numQuantTenho'] = $data['numQuantNaoLi'] + $data['numQuantLi'] + $data['numQuantLendo'];
        $data['mensageFaixa'] = "";
        
        $tela = array(
            'cabecalho' => 'telas/cabecalho.php',
            'faixa_horizontal'      =>  'telas/faixa_horizontal.php',
            'lateral'               =>  'telas/lateral.php',
            'conteudo'              =>  'telas/autores.php',
            
            );
        
        
        //$tela['tenhoLivro'] =$this->verificaLivroEstante($codigo);
        $this->parser->adc_css($this->css);
        $this->parser->adc_js($this->js);
        $this->parser->adc_js(array('listnav'));
        
        $this->parser->mostrar('templates/template_corpo.php', $tela, $data);
       
    }
    public function getEditoras() {
        $data['editoras'] = $this->livro->getEditora();
        $this->verificador->verificarLogado();
        $data ['usuario'] = $this->usuarios->getUsuario($this->usuario);
        
        
        $meusLivros = $this->ev->getLivros($this->usuario);
        $data['numQuantNaoLi'] = '0';
        $data['numQuantLi'] = '0';
        $data['numQuantLendo'] = '0';

        foreach ($meusLivros as $value) {
            switch ($value['STATUS']) {
                case '0':
                    $data['numQuantNaoLi'] ++;
                    break;
                case '1':
                    $data['numQuantLi'] ++;
                    break;
                case '2':
                    $data['numQuantLendo'] ++;
                    break;
            }
        }
        $data['numQuantTenho'] = $data['numQuantNaoLi'] + $data['numQuantLi'] + $data['numQuantLendo'];
        $data['mensageFaixa'] = "";
        
        $tela = array(
            'cabecalho' => 'telas/cabecalho.php',
           //'topo' => 'telas/vazio.php', //mostrar o topo somente quando n�o for a tela de login
            'faixa_horizontal'      =>  'telas/faixa_horizontal.php',
            'lateral'               =>  'telas/lateral.php',
            'conteudo'              =>  'telas/editoras.php',
            
            );
        
        
        //$tela['tenhoLivro'] =$this->verificaLivroEstante($codigo);
        $this->parser->adc_css($this->css);
        $this->parser->adc_js($this->js);
        $this->parser->adc_js(array('listnav'));
        
        $this->parser->mostrar('templates/template_corpo.php', $tela, $data);
       
    }
    public function buscar($tipo,$pesquisa) {
        $dados["campo_".$tipo]=urldecode( $pesquisa);
        $this->session->set_flashdata('dados', $dados);
       // $this->index($dados);
       redirect("livro/index");
       // echo $tipo."-".urldecode( $pesquisa);
        //array('campo_autor'=>'ivan')
    }
      public function calculaPontuacao($pontuacao) {
        $Votantes=0;$porcentagem=0;$pontuacaoVoto=0;
       
        $quali = unserialize($pontuacao);
        foreach ($quali as $key => $q) {
            $pontuacaoVoto += $key * $q;
            if ($q > 0) {
                $Votantes += $q;
            }
        }
        if ($Votantes != 0) {
            $porcentagem = ((100 * $pontuacaoVoto) / ($Votantes * 5));
        }
            //$porcentagem=6;
            //$porcentagem = $porcentagem/20;
            //echo $pontuacaoVoto. " de " .$Votantes*5 ."<br>";


        return $porcentagem;
    }

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */