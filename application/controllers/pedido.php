    <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pedido extends CI_Controller {
    public $css=null;
    public $js=null;
    public function __construct() {
        parent::__construct();
                $this->css=array('cadastroempresa','bootstrap','menu','small-business','painel_user','tabs','hover','../lighter/css/lighter','star-rating.min');    
        $this->js = array('jquery-1.10.2', 'bootstrap', 'funcoesComuns', 'jquery.maskedinput.min', 'jquery.dataTables.min', 'jquery.form.min', 'bootstrap-filestyle.min','star-rating.min');
        //$this->load->helper();
        $this->load->model('estanteVirtual_model', 'ev');
        $this->load->model('pedido_model', 'pedido');
        $this->load->model('mensagem_model', 'mensagem');  
        $this->load->model('usuario_model', 'usuarios');
        $this->load->model('livro_model', 'livro');
        $this->load->model('saldo_model', 'saldo');

        $this->usuario = $this->session->userdata('cod_usuario');
              
        }
        public function gravarUsuarioPedido($codPedido, $codUsuario) {
        //  $dados['CODIGO'] = $codPedido;;
        $dados['COD_USUARIO_DE'] = $codUsuario;
        $detalhe = $this->pedido->updatePedido($codPedido, $dados);
        //mandar mensagem para o usuario destino
        $dados = array('tipo' => 'solicitacaoLivro', 'usuario' => $codUsuario, 'titulo' => 'Solicitação de Livro');
        
        $this->setMessage($dados);
        $msg = "<div class='alert alert-success'>" . $this->mensagens->getMessage('pedidoGravado') . "</div>";

        $this->session->set_flashdata('msgPedido', $msg);
        redirect('meusPedidos');
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
                    $this->alterarSaldo("-1",  $this->usuario);
                    $dados=array('tipo'=>'solicitacaoLivro','usuario'=>$cod_usuario_de,'titulo'=>'Solicitação de Livro');
                    $this->setMessage($dados);
                    $msg="<div class='alert alert-success'>".$this->mensagens->getMessage('pedidoGravado')."</div>";
                    
                }
                
                 $this->session->set_flashdata('msgPedido', $msg);
                redirect('meusPedidos');
                
            }else{
                $livrosEstante=  $this->ev->getLivrosTodos($cod_livro,  $this->usuario);
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
                       $this->alterarSaldo("-1",  $this->usuario);
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

    public function livrosUsuario($livrosEstante,$cod_livro,$cod_pedido=NULL) {
        
     
        $this->verificador->verificarLogado();
        $data ['usuario'] = $this->usuarios->getUsuario($this->usuario);    
        $meusLivros = $this->ev->getLivros($this->usuario);
         $data['livro'] = $this->livro->getLivrobyCodigo($cod_livro);
               $data += $this->dadoslateral->quantidadesLivros($this->usuario);      
           $data['codPedido']=   $cod_pedido; 

        $data['mensageFaixa'] = "";
        $data['infoLivros'] = $livrosEstante;
        $tela = array('cabecalho' => 'telas/cabecalho.php',
            'topo' => 'telas/vazio.php', //mostrar o topo somente quando não for a tela de login
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
       $data += $this->dadoslateral->quantidadesLivros($this->usuario);      
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
        $data += $this->dadoslateral->quantidadesLivros($this->usuario);     
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
        $data += $this->dadoslateral->quantidadesLivros($this->usuario);
        
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
    public function selecionarUsuarioPedido($url){
        $cod_livro = end(explode("_", $url));
        $temp = explode("_", $url);array_pop($temp);
        $cod_pedido = end($temp);
       
         $livrosEstante=  $this->ev->getLivrosTodos($cod_livro,  $this->usuario);
                if($livrosEstante){
                    $this->livrosUsuario($livrosEstante,$cod_livro,$cod_pedido);
                }
    }
    
    public function aceitarPedido($cod_pedido) {
        date_default_timezone_set("Brazil/East");
        //alterar status pedido
        $dados_pedido['STATUS']='2';
        $dados_pedido['DATA_ACEITACAO']= date('Y-m-d H:i:s'); //2015-01-19 00:00:00
        $detalhe = $this->pedido->updatePedido($cod_pedido,$dados_pedido);        
        //alterar status livro da estantevirtual
        $dados_livro['COD_LIVRO'] = $detalhe['COD_LIVRO'];
        $dados_livro['ESCOPO'] = '2'; 
       
         $this->ev->alterarEstante($this->usuario,$dados_livro);
            //mandar mensagem para o usuario destino
            $data_mensagem=array('titulo'=>'pedido Aceito','usuario'=>$detalhe['COD_USUARIO_PARA'],'tipo'=>'pedidoAceitoPara') ;
            $this->setMessage($data_mensagem);
            //avisar a ele que ele tem até o dia atual +3 para enviar o pedido e preencher o codigo de rastreio.    
            $data_mensagem=array('titulo'=>'pedido Aceito','usuario'=>$this->usuario,'tipo'=>'pedidoAceito') ;
            $this->setMessage($data_mensagem);
        
        $this->session->set_flashdata('msgPedido', $this->mensagens->getMessage('pedidoAceito'));
        redirect("pedido/recebidos");
    }
    public function recusarPedido($cod_pedido) {
        $dados['STATUS']='0';
        $detalhe =  $this->pedido->updatePedido($cod_pedido,$dados);
        //mandar mensagem para o usuario destino
            $data_mensagem=array('titulo'=>'pedido Recusado','usuario'=>$detalhe['COD_USUARIO_PARA'],'tipo'=>'pedidoRecusadoPara') ;
            $this->setMessage($data_mensagem);
            //avisar a ele que ele tem até o dia atual +3 para enviar o pedido e preencher o codigo de rastreio.    
            $data_mensagem=array('titulo'=>'pedido Recusado','usuario'=>$this->usuario,'tipo'=>'pedidoRecusado') ;
            $this->setMessage($data_mensagem);
        $this->session->set_flashdata('msgPedido', $this->mensagens->getMessage('pedidoRecusado'));
        redirect("pedido/recebidos");
        
    }
    public function enviarCR() {
        $cod_pedido=$this->input->post('codigo_pedido');
        $data['COD_RASTREIO']=  trim(strtoupper( $this->input->post('codigo_rastreio')));
        if ($data['COD_RASTREIO']==""){
             echo $this->mensagens->getMessage('codigoRastreioVazio');
        }else{
            $detalhe = $this->pedido->updatePedido($cod_pedido,$data);
           if ($detalhe){
               echo "<div class='alert alert-success'>".$this->mensagens->getMessage('rastreioInserido')."</div>";
               //mandar mensagem para o usuario destino
                $data_mensagem=array('titulo'=>'Código de Rastreio inserido','usuario'=>$detalhe['COD_USUARIO_PARA'],'tipo'=>'rastreioInseridoPara') ;
                $this->setMessage($data_mensagem);
           } else{
               echo "<div class='alert alert-danger'>".$this->mensagens->getMessage('falhaGravacao')."</div>";
           }
        }
        
    }
    public function rastrearPedido($cod_pedido) {/*alterado*/ 
        $data['pedido']=  $this->pedido->getPedidoDetalhe($cod_pedido);
       
        $this->load->library('correio',$data['pedido']);
        // $this->load->library('correio',array('COD_RASTREIO'=>'ASDA'));
        $erro = $this->correio->erro;
        $data['erro'] = $this->correio->erro;
        $data['erro_msg'] = isset($this->correio->erro_msg)? $this->correio->erro_msg:"";
        $data['cod_rastreio'] = $data['pedido']['COD_RASTREIO'];
        $data['caminho'] = json_decode(json_encode($this->correio->track), true); //converte o objeto multidimensional em array multidimensional
        echo $this->load->view('telas/rastreio',$data,TRUE);
        
    }
    public function confirmaEntrega() {/*inserido*/
          date_default_timezone_set("Brazil/East");
        
        $erro=0;
        $codigo = $this->input->post('codigo_pedido');
        $data['DATA_ENTREGA']= NULL;// date('Y-m-d H:i:s'); //2015-01-19 00:00:00
        $data['QUALIFICACAO'] = $this->input->post('avaliacao');
        $data['OBS'] = $this->input->post('obs');
        //$data['SITUACAO_RASTREIO'] = 'entregue';
        
        if($data['QUALIFICACAO']=="0"){
            echo "Avaliação obrigatória</br>";
            $erro++;
        }
        if ($data['OBS']==""){
            echo "Campo Observação obrigatório";
            $erro++;
        }
        
        if ($erro==0){
            $detalhe =$this->pedido->getPedidoDetalhe($codigo);  
            if (is_null($detalhe['DATA_ENTREGA'])){
                $this->pedido->updatePedido($codigo,$data); // alterar pedido
                
                $dados_livro['COD_LIVRO'] = $detalhe['COD_LIVRO'];
                $dados_livro['ESCOPO'] = '1'; 
                $dados_livro['STATUS'] = '0'; 
                $dados_livro['COD_USUARIO'] = $this->usuario; 
                print_r($dados_livro);
                $this->ev->alterarEstante($detalhe['COD_USUARIO_DE'],$dados_livro); // mudar o livro de estante
                $this->alterarSaldo('1',$detalhe['COD_USUARIO_DE']);// somar 1 saldo no USUARIO_DE
                $this->alterarQualificacao($data['QUALIFICACAO'],$detalhe['COD_USUARIO_DE']);  // altera a avaliacao do usuario;
                 $data=array('titulo'=>'Novo Livro','usuario'=>  $this->usuario,'tipo'=>'novoLivro') ;
                $this->setMessage($data);
                
                $data=array('titulo'=>'Livro Enviado com sucesso','usuario'=> $detalhe['COD_USUARIO_DE'],'tipo'=>'livroEnviado') ;
                $this->setMessage($data);
                $data=array('titulo'=>'Saldo atualizado','usuario'=>  $detalhe['COD_USUARIO_DE'],'tipo'=>'saldoAtualizado') ;
                $this->setMessage($data);
                $data=array('titulo'=>'Livro removido','usuario'=>  $detalhe['COD_USUARIO_DE'],'tipo'=>'livroRemovido') ;
                $this->setMessage($data);
                //echo "Enviar mensagem para o usuario informando o novo livro na sua estante<br>";
                //echo "Enviar mensagem para o usuario remetente informando a entrega do livro e o saldo somado e a retirada do livro de sua estante<br>";
                echo "As informações foram salvas com sucesso"; 
            }else{
                echo $this->mensagens->getMessage('confirmaEntrega');
               //echo $data['DATA_ENTREGA'];
            }
            
            
            
        }
        
    }
   public function alterarQualificacao($qualificacao, $cod_usuario) {/*inserido*/
     
       $dados= $this->usuarios->getUsuario($cod_usuario);
       $quali= json_decode($dados['TITULO_QUALIFICACAO'],true);       
       $quali[$qualificacao]++;
       $dadosUsuario['TITULO']=  json_encode($quali);
        $dadosUsuario['QUANTIDADE']=  $dados['TOTAL']+1;
        //$this->usuarios->alterarUsuario($cod_usuario,$dadosUsuario);
             $this->db->where('COD_USUARIO', $cod_usuario);
            $this->db->update('qualificacao', $dadosUsuario); 
              //  echo $this->db->last_query();
       // "Passar metodo para a model";
      
    }
    public function teste() {
        $parametros['usuario_para']="Ivan Solicitante";
        $parametros['livro']="Dom casmurro";
        $tipo="solicitacaoLivro";
       echo $this->mensagens->getMessage($tipo,$parametros);
        echo "treste";
    }

     public function alterarSaldo($saldo,$usuario) {
        $dados['VALOR']="VALOR +($saldo)";
       $result= $this->saldo->updateSaldo($usuario,$saldo);
       
    }

    public function setMessage($data) {
        $dados['TITULO']=$data['titulo'];
        $dados['COD_USUARIO']=$data['usuario'];
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
/*
 * $teste=array(
            '1'=>0,
            '2'=>0,
            '3'=>0,
            '4'=>0,
            '5'=>0,
        );
        $serializado= serialize($teste);
        echo $serializado;
        print_r( unserialize($serializado));
        
 */
/* End of file home.php */
/* Location: ./application/controllers/pedido.php */