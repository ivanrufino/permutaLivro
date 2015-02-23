<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pedido extends CI_Controller {
    public $css=null;
    public $js=null;
    public function __construct() {
        parent::__construct();
                $this->css=array('cadastroempresa','bootstrap','menu','small-business','painel_user','tabs','hover','../lighter/css/lighter');    
        $this->js = array('jquery-1.10.2', 'bootstrap', 'funcoesComuns', 'jquery.maskedinput.min','jquery.dataTables.min','jquery.form.min','bootstrap-filestyle.min' );
        //$this->load->helper();
        $this->load->model('estanteVirtual_model', 'ev');
        $this->load->model('pedido_model', 'pedido');
        $this->load->model('mensagem_model', 'mensagem');  
        $this->load->model('usuario_model', 'usuarios');
        $this->load->model('livro_model', 'livro');
        $this->load->model('saldo_model', 'saldo');

        $this->usuario = $this->session->userdata('cod_usuario');
              
        }
        public function novoPedido($cod_livro,$cod_usuario_de=null) {
            $this->verificaSaldo();
            $msg="";
            if (!is_null($cod_usuario_de)){
                $dados['COD_USUARIO_DE']=$cod_usuario_de;
                $dados['COD_USUARIO_PARA']= $this->usuario;
                $dados['COD_LIVRO']= $cod_livro;
                $dados['STATUS']= '1';
                $codPedido=$this->pedido->novoPedido($dados);
                if ($codPedido===false){
                    $msg="<div class='alert alert-danger'>".$this->mensagens->getMessage('falhaGravacao')."</div>";
                    
                }elseif($codPedido=='existe'){
                    $msg="<div class='alert alert-warning'>".$this->mensagens->getMessage('pedidoExistente')."</div>";
                }else{
                    $this->alterarSaldo("-1");
                    $dados=array('tipo'=>'solicitacaoLivro','usuario_de'=>$cod_usuario_de,'titulo'=>'Solicitação de Livro');
                    $this->setMessage($dados);
                    $msg="<div class='alert alert-success'>".$this->mensagens->getMessage('pedidoGravado')."</div>";
                    
                }
                
                 $this->session->set_flashdata('msgPedido', $msg);
                redirect('meusPedidos');
                
            }else{
                $livrosEstante=  $this->ev->getLivrosTodos($cod_livro);
                if($livrosEstante){
                    $this->livrosUsuario($livrosEstante,$cod_livro);
                    //echo "Mostrar tela de todos os usuarios";
                }else{
                    $dados['COD_USUARIO_DE']=NULL;
                    $dados['COD_USUARIO_PARA']= $this->usuario;
                    $dados['COD_LIVRO']= $cod_livro;
                    $dados['STATUS']= '1';
                    $codPedido=$this->pedido->novoPedido($dados);
                    
                    if ($codPedido===false){
                        $msg="<div class='alert alert-danger'>".$this->mensagens->getMessage('falhaGravacao')."</div>";
                    }elseif($codPedido=='existe'){
                       $msg="<div class='alert alert-warning'>".$this->mensagens->getMessage('pedidoExistente')."</div>";
                    }else{
                       $this->alterarSaldo("-1");
                        $msg="<div class='alert alert-success'>".$this->mensagens->getMessage('pedidoGravadoSemUsuario')."</div>";
                        
                        //echo "Arquivo gravado com sucesso";
                    }
                     $this->session->set_flashdata('msgPedido', $msg);
                    redirect('meusPedidos');
                }
              
              
            }
            
        }
        public function removerPedido($codigo) {
            echo "remover pedido";
        }

    public function livrosUsuario($livrosEstante,$cod_livro) {
     //   print_r($livrosEstante) ;        
        $this->verificador->verificarLogado();
        $data ['usuario'] = $this->usuarios->getUsuario($this->usuario);
        $meusLivros = $this->ev->getLivros($this->usuario);
         $data['livro'] = $this->livro->getLivrobyCodigo($cod_livro);
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
        $data['infoLivros'] = $livrosEstante;
        $tela = array('cabecalho' => 'telas/cabecalho.php',
            'topo' => 'telas/vazio.php', //mostrar o topo somente quando n�o for a tela de login
            'faixa_horizontal' => 'telas/faixa_horizontal.php',
            'lateral' => 'telas/lateral.php',
            'conteudo' => 'telas/livroTodosUsuarios.php');
        $this->parser->adc_css($this->css);
        $this->parser->adc_js($this->js);
        $this->parser->mostrar('templates/template_corpo.php', $tela, $data);
    
    }
     public function meusPedidos($status=NULL) {
       $this->verificador->verificarLogado();
        $data ['usuario'] = $this->usuarios->getUsuario($this->usuario);
        $meusLivros = $this->ev->getLivros($this->usuario);
        $data['pedidos_in'] = 'in';
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
        if (is_null($status)){
            $data['livrosDesejados'] = $this->pedido->getPedidobyStatus($this->usuario);
        }else{
            switch ($status) {
                case 'pendentes':
                    $data['livrosDesejados'] = $this->pedido->getLivrosDesejados($this->usuario);
                    break;
                case 'aguardando':
                    $data['livrosDesejados'] = $this->pedido->getPedidobyStatus($this->usuario,'1');
                    break;
                case 'em_andamento':
                    $data['livrosDesejados'] = $this->pedido->getPedidobyStatus($this->usuario,'2');
                    break;
                 case 'recusado':
                    $data['livrosDesejados'] = $this->pedido->getPedidobyStatus($this->usuario,'0');
                    break;

                default:
                    break;
            }
        } 
        if($data['livrosDesejados']){
        foreach ($data['livrosDesejados'] as $key => $value) {
            if ($value['COD_USUARIO_DE']==NULL){
                $data['livrosDesejados'][$key]['class']='c_pendente';
            }else{
                switch ($value['STATUS']) {
                    case 0:
                        $data['livrosDesejados'][$key]['class']='c_recusado';
                        break;
                    case 1:
                        $data['livrosDesejados'][$key]['class']='c_aguardando';
                        break;
                    case 2:
                        $data['livrosDesejados'][$key]['class']='c_aceito';
                        break;
                    case 3:
                        $data['livrosDesejados'][$key]['class']='c_removido';
                        break;
                    

                    default:
                        break;
                }
            }
            
           // echo $value['COD_USUARIO_DE'];
        }
        }
        $data['mensageFaixa']=  $this->session->flashdata('msgPedido');
        $tela = array('cabecalho' => 'telas/cabecalho.php',
            'topo' => 'telas/vazio.php', //mostrar o topo somente quando n�o for a tela de login
            'faixa_horizontal' => 'telas/faixa_horizontal.php',
            'lateral' => 'telas/lateral.php',
            'conteudo' => 'telas/livros_quero.php');
        $this->parser->adc_css($this->css);
        $this->parser->adc_js($this->js);
        $this->parser->mostrar('templates/template_corpo.php', $tela, $data);
    }
    public function recebidos($status=NULL) {
       $this->verificador->verificarLogado();
        $data ['usuario'] = $this->usuarios->getUsuario($this->usuario);
        $meusLivros = $this->ev->getLivros($this->usuario);
        $data['pedidos_in'] = 'in';
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
        $data['livrosSolicitados']=  $this->pedido->getSolicitacaoPedido($this->usuario);
        
        
        $data['mensageFaixa']=  $this->session->flashdata('msgPedido');
        $tela = array('cabecalho' => 'telas/cabecalho.php',
            'topo' => 'telas/vazio.php', //mostrar o topo somente quando n�o for a tela de login
            'faixa_horizontal' => 'telas/faixa_horizontal.php',
            'lateral' => 'telas/lateral.php',
            'conteudo' => 'telas/livros_solicitados.php');
        $this->parser->adc_css($this->css);
        $this->parser->adc_js($this->js);
        $this->parser->mostrar('templates/template_corpo.php', $tela, $data);
    }
    public function detalhes($url) {
        $this->verificador->verificarLogado();
        $data ['usuario'] = $this->usuarios->getUsuario($this->usuario);
        $codigo = end(explode("_", $url));
       // echo $codigo;
        $data['pedido']=  $this->pedido->getPedidoDetalhe($codigo);
        switch ( $data['pedido']['STATUS']) {
            case 0:
                 $data['situacao']="Recusado";
                break;
            case 1:
                 $data['situacao']="Aguardando";
                break;
            case 2:
                 $data['situacao']="Aceito";
                break;
            case 3:
                 $data['situacao']="Removido";
                break;
            

            default:
                break;
        }
        if(is_null($data['pedido']['COD_USUARIO_DE'])){
           $data['situacao']="Pendente"; 
           $data['pedido']['NOME']="Não definido";
        }
        
        $data['livros'] = $this->livro->getLivrobyCodigo($data['pedido']['CODLIVRO']);
        $data['pedidos_in'] = 'in';
       // var_dump( $data['pedidos']);die();
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
            'conteudo'              =>  'telas/detalhesPedido.php',
     
            );
       /* $tenho=$this->verificaLivroEstante($codigo);
        if ($tenho){
            $tela['livroUsuario']=$tenho;
        }else{ 
            $pedido=$this->verificaLivroPedido($codigo);
            if ($pedido){
                $tela['livroUsuario']=$pedido;
            }else{
                $tela['livroUsuario']='telas/adcionarEstanteouPedido';
            }
        }*/
        
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
    public function verificaSaldo() {
        $saldo = $this->saldo->getSaldo($this->usuario);
        if(!$saldo){
            $this->session->set_flashdata('msgPedido', "<div class='alert alert-danger'>".$this->mensagens->getMessage('atencao').$this->mensagens->getMessage('saldoZerado').$this->mensagens->getMessage('enderecoImcompleto')."</div>");
            redirect('meusPedidos');
            
        }else{
            if($saldo['VALOR']==0){
                $this->session->set_flashdata('msgPedido', "<div class='alert alert-danger'>".$this->mensagens->getMessage('atencao').$this->mensagens->getMessage('saldoZerado')."</div>");
                redirect('meusPedidos');
               // echo "Você não tem saldo para solicitar livros.";                
               
            }
        }
        
    }
    public function aceitarPedido($cod_pedido) {
        date_default_timezone_set("Brazil/East");
        $dados['STATUS']='2';
        $dados['DATA_ACEITACAO']= date('Y-m-d H:i:s'); //2015-01-19 00:00:00
        $this->pedido->updatePedido($cod_pedido,$dados);
        
        $this->session->set_flashdata('msgPedido', $this->mensagens->getMessage('pedidoAceito'));
        redirect("pedido/recebidos");
    }
    public function recusarPedido($cod_pedido) {
        $dados['STATUS']='0';
        $this->pedido->updatePedido($cod_pedido,$dados);
        $this->session->set_flashdata('msgPedido', $this->mensagens->getMessage('pedidoRecusado'));
        redirect("pedido/recebidos");
        
    }
    public function enviarCR($cod_pedido) {
        
    }
    public function teste() {
        $parametros['usuario_para']="Ivan SOlicitante";
        $parametros['livro']="Dom casmurro";
        $tipo="solicitacaoLivro";
       echo $this->mensagens->getMessage($tipo,$parametros);
        echo "treste";
    }

    public function alterarSaldo($saldo) {
        $dados['VALOR']="VALOR +($saldo)";
       $result= $this->saldo->updateSaldo($this->usuario,$saldo);
    }

    public function setMessage($data) {
        $dados['TITULO']=$data['titulo'];
        $dados['COD_USUARIO']=$data['usuario_de'];
        $dados['MENSAGEM']= $this->mensagens->getMessage($data['tipo']);
        $cod=$this->mensagem->novaMensagem($dados);

    }
    public function somar_dias_uteis($str_data, $int_qtd_dias_somar = 7) {

    // Caso seja informado uma data do tipo DATETIME - aaaa-mm-dd 00:00:00
    // Transforma para DATE - aaaa-mm-dd
    $str_data = substr($str_data,0,10);
    
    // Se a data estiver no formato brasileiro: dd/mm/aaaa
    // Converte-a para o padrão americano: aaaa-mm-dd
    if ( preg_match("@/@",$str_data) == 1 ) {
        $str_data = implode("-", array_reverse(explode("/",$str_data)));
    }
    
    $array_data = explode('-', $str_data);
    $count_days = 0;
    $int_qtd_dias_uteis = 0;
    while ( $int_qtd_dias_uteis < $int_qtd_dias_somar ) {
        $count_days++;
                if ( ( $dias_da_semana = gmdate('w', strtotime('+'.$count_days.' day', mktime(0, 0, 0, $array_data[1], $array_data[2], $array_data[0]))) ) != '0' && $dias_da_semana != '6' ) {
            $int_qtd_dias_uteis++;
        }
    }
    return gmdate('Y-m-d',strtotime('+'.$count_days.' day',strtotime($str_data)));
}



    public function testandoTrans(){
        echo $this->pedido->teste();
    }
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */