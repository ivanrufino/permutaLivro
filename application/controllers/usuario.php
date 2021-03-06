<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Usuario extends CI_Controller {

    public $css = null;
    public $js = null;
    public $usuario;
    public $cod_empresa;

    public function __construct() {
        parent::__construct();
        //$this->css = array('cadastroempresa','bootstrap', 'menu', 'small-business', 'painel_user', 'tabs','hover','../lighter/css/lighter');
        $this->css=array('comuns','bootstrap','bootstrap-social','menu','small-business','painel_user','tabs','hover','../lighter/css/lighter','star-rating');   
        $this->js = array('jquery-1.10.2', 'bootstrap', 'funcoesComuns', 'jquery.maskedinput.min','jquery.dataTables.min','jquery.form.min','bootstrap-filestyle.min','star-rating');
        
        $this->load->model('estanteVirtual_model', 'ev');
        $this->load->model('pedido_model', 'pedido');
        $this->load->model('mensagem_model', 'mensagem');
        $this->load->model('usuario_model', 'usuarios');  
        $this->load->model('livro_model', 'livro');
        $this->usuario = $this->session->userdata('cod_usuario');
        
        
    }
   
    public function index() {
        
        $this->verificador->verificarLogado();  
        
       
        $data ['usuario'] = $this->usuarios->getUsuario($this->usuario);       
        $data['queroLivros']=  $this->ev->livrosDisponiveis($this->usuario); 
        $data['maisLidos']=FALSE;
        $data['ultimosLivros']=  $this->livro->getLastInserted($this->usuario);  
        $data['usuarioLinkados']    =$this->getUsuarioLinkados();
        $data['livroRecomendados']    =$this->getLivrosLinkados();
     
    //    $this->printArray($data['usuarioLinkados']) ;die();
        //if (!$data['ultimosLivros']){
            $data['maisLidos']=  $this->livro->maisLidos(4);  
       // }
        /*Preenche os dados da lateral */
       
        $data += $this->dadoslateral->quantidadesLivros($this->usuario);
        $data += $this->dadoslateral->verificaRecados($this->usuario);
        $data['usuario']['porcentagem']= $this->dadoslateral->calculaPontuacao($data['usuario']['TITULO_QUALIFICACAO']);
        //print_r($data['usuario']);die();
        
       /* print_r($data['queroLivros']);
        echo "<hr>";
        print_r($data['ultimosLivros']);*/
        //die();
        $data['mensageFaixa'] = "";
        $tela = array('cabecalho' => 'telas/cabecalho.php',
            'topo' => 'telas/vazio.php', //mostrar o topo somente quando não for a tela de login
            'faixa_horizontal' => 'telas/faixa_horizontal.php',
            'lateral' => 'telas/lateral.php',
            'conteudo' => 'telas/index_usuario.php');
        $this->parser->adc_css($this->css);
        $this->parser->adc_js($this->js);
        $this->parser->mostrar('templates/template_corpo.php', $tela, $data);
    }
    public function getLivrosLinkados($limit=5) {
        $generos = $this->ev->getGenerosByUsuario($this->usuario);
         if ($generos){
            $livros = $this->ev->getLivrosbyGenero($this->usuario,$generos,$limit);
            return $livros;
         }
         return array();
    }
    public function getUsuarioLinkados() {
        $amigos= $this->usuarios->getAmigos($this->usuario);
        $naobusca=array();
        foreach ($amigos as $amigo) {
            $naobusca[] = $amigo['CODIGO'];
        }
        
       //print_r($naobusca);die();
        $limit = 10;//rand(1, 10);
            
        $generos = $this->ev->getGenerosByUsuario($this->usuario);
        // $data['usuarioLinkados'] = $this->ev->getUsuarioPerfilIgual($this->usuario);
        $usuarioLinkados =  array_merge($this->ev->getUsuarioPerfilGeneroIgual($this->usuario,$generos,$naobusca,$limit),$this->ev->getUsuarioPerfilIgual($this->usuario,$naobusca,$limit));
       // print_r($usuarioLinkados); die();
        $cod_unique=array();
       $array_unique=array();
        foreach ($usuarioLinkados as $chave => $usuarioLinkado) {
                       
            if (!in_array($usuarioLinkado['CODIGO'], $cod_unique) ){
                 $cod_unique[]=$usuarioLinkado['CODIGO'];
                  $array_unique[]=$usuarioLinkado;
            }else{
                $key = array_search($usuarioLinkado['CODIGO'], $cod_unique); // $key = 2;
                $array_unique[$key]['QUANTIDADE']+=$usuarioLinkado['QUANTIDADE'];
            }
        }
       
       
        return $array_unique;
    }
    public function recados() {
        $this->verificador->verificarLogado();         
        $data ['usuario']=  $this->usuarios->getUsuario($this->usuario);
         $data['usuario']['porcentagem']= $this->dadoslateral->calculaPontuacao($data['usuario']['TITULO_QUALIFICACAO']);
        $data += $this->dadoslateral->quantidadesLivros($this->usuario);
        $data['minhasmensagens'] = $this->mensagem->getMensagem($this->usuario);
        
        
        $data['mensageFaixa']="";
        $tela = array('cabecalho' => 'telas/cabecalho.php',
            'topo' => 'telas/vazio.php', //mostrar o topo somente quando não for a tela de login
            'faixa_horizontal' => 'telas/faixa_horizontal.php',
            'lateral' => 'telas/lateral.php',
            'conteudo' => 'telas/recado_usuario.php');
        $this->parser->adc_css($this->css);
        $this->parser->adc_js($this->js);
        $this->parser->mostrar('templates/template_corpo.php', $tela, $data);
    }
    public function marcarComoLido($codMensagem) {
        $dados['LIDO']='1';
        $this->mensagem->updateMensagem($codMensagem,$dados);
        //echo "alterar mensagem de codigo".$codMensagem;
    }
    public function seguir($usuarioAmigo) {
        $usuarioMeSeguem= $this->usuarios->getUsuarioMeSeguem($this->usuario,$usuarioAmigo);
      
        if (is_null($usuarioMeSeguem)){
            $dados['COD_USUARIO_DE']= $this->usuario;
            $dados['COD_USUARIO_PARA']= $usuarioAmigo;
            $this->usuarios->novoSegue($dados);
        }else{
            
            $dados['COD_USUARIO_PARA']= $this->usuario;
            $dados['COD_USUARIO_DE']= $usuarioAmigo;
            $dados['INVERSE']= 1;
            $this->usuarios->updateSegue($dados);
            
        }
        
        redirect('minhaestante');
        
    }
    public function cadastro() {
        $data['mensageFaixa'] = "Cadastre-se e aproveite todas as vantagens dos serviços do Club do Livro";        
        $tela = array(
            'cabecalho' => 'telas/cabecalho.php',
            'topo' => 'telas/vazio.php', //mostrar o topo somente quando n�o for a tela de login
            'faixa_horizontal' => 'telas/faixa_horizontal.php',
            'conteudo' => 'telas/cadastroUsuario.php',
        );
        $this->parser->adc_css($this->css);
        $this->parser->adc_js($this->js);
        $this->parser->adc_js('mapa');
        $this->parser->mostrar('templates/template_corpo.php', $tela, $data);
    }
    public function efetuarCadastro() {
        $this->form_validation->set_rules('nome', 'Usuário', 'required');
        $this->form_validation->set_message('is_unique', '%s já esta sendo utilizado.');
        $this->form_validation->set_rules('senha', 'Senha', 'required|min_length[6]');
        $this->form_validation->set_rules('email', 'Email', 'required||is_unique[usuario.EMAIL]');
        if ($this->form_validation->run() == FALSE) {
            $this->cadastro();
        } else {
            $dados = array(
                "NOME" => $this->input->post("nome"),
                "EMAIL" => $this->input->post("email"),
                "SENHA" => sha1($this->input->post("senha")),
            );
            $idUsuario = $this->usuarios->novoUsuario($dados);
            if (!is_null($idUsuario)) {
                $dados['id'] = sha1($idUsuario);
                $dados["senha"] = $this->input->post("senha");
                $dados["nome"] = $this->input->post("nome");
                $dados["email"] = $this->input->post("email");
                $dados["login"] = $this->input->post("email");
                $dados["redirect"] = "usuario";
                $this->_email($dados);
                // $this->_send_email_ativacao($dados);
                $this->session->set_flashdata('mensagem', "<div class='alert alert-success'>" . $this->mensagens->getMessage('cadastroRealizado') . "</div>");
                redirect('/login');
            } else {
                $this->cadastro();
            }
        }
    }
    public function ativarConta($id){
        $dados['STATUS']='1';
        $ret=$this->usuarios->ativarUsuario($dados,$id);
        if($ret){
             $msg  = "<div class='alert alert-success'>".$this->mensagens->getMessage('ativacaoSucesso')."</div>";
            $this->session->set_flashdata('mensagem', $msg);
            
        }else{
             $msg  = "<div class='alert alert-danger'>".$this->mensagens->getMessage('ativacaoErro')."</div>";
            $this->session->set_flashdata('mensagem', $msg);
        }
        
        redirect();
    }
    public function _email($dados) {   
     
        $this->email->from('ivan.rufino.m@gmail.com', 'Ivan Rufino');
        $this->email->to($dados['email']);
        $this->email->bcc('ivan.rufino.m@gmail.com');
        $this->email->subject('SISCORE: Ativação de Conta');
        $mensagem=$this->load->view('telas/email/ativacao_conta',$dados,true);
        $this->email->message($mensagem);
        $msg="ok";
        if (!$this->email->send()){            
            $msg = $this->email->print_debugger();
        }
        return $msg;
    }
    public function inserirEndereco() {
        echo "Inserir endereço";
    }
    public function alterarEndereco() {
        echo "Alterar endereço";
    }
    public function getFace() {
        $user = $this->facebook->getUser();

        if ($user) {
            try {
                $data['user_profile'] = $this->facebook->api('/me');
                //  $friends = $this->facebook->api('/me/taggable_friends');
                // $this->listaAmigos($friends);
               
            } catch (FacebookApiException $e) {
                $user = null;
            }
        } else {
            $this->facebook->destroySession();
            // $this->session->sess_destroy();
            //redirect();
        }

        if ($user) {
           $data['logout_url'] = site_url('login/efetuarLogout'); // Logs off application
            // OR 
            // Logs off FB!
            // $data['logout_url'] = $this->facebook->getLogoutUrl();
        } else {
            $data['login_url'] = $this->facebook->getLoginUrl(array(
                'redirect_uri' =>site_url('home'),//  'http://www.clubdolivro.com.br/teste/home',
                'scope' => array("email") // permissions here
            ));
        }
        $data['login_face']='logar';
        return $data;
    }
    public function listaAmigos($user_friends) {
        if (!is_null($user_friends)) {
            // pagination - how can i do that?
            $list_friends = $user_friends;
           // print_r($list_friends);
            foreach ($list_friends['data'] as $friend) {
                $imagem = $friend['picture']['data']['url'];
                //print_r($friend['picture']);die();
                echo $friend['id'];
                echo "<img src='$imagem'/>"."<br>";
//                        <img src="http://graph.facebook.com/{idfriend}/picture?type=small"/>
//                        <img src="http://graph.facebook.com/{idfriend}/picture?type=normal"/>
//                        <img src="http://graph.facebook.com/{idfriend}/picture?type=large"/>';
            }
            die();
        } else {
            echo "error";
        }
        
    }
    /*  public function getDadosAdministrador(){
        $data = array_change_key_case ($this->empresa->getAdministrador($this->usuario));
        $data['pasta']='administrador/';
        $data['ref']='admin/';
        $data['empresa']= array_change_key_case ($this->empresa->getEmpresas($this->cod_empresa)) ;
         return $data;
    }
    public function admin() {
        $this->verificador->verificarAdminLogado();
        $data=  $this->getDadosAdministrador();
        
        //$this->printArray($data);
        //die();
        $data['mensageFaixa'] = "Selecione a opção desejada, clicando sobre a imagem";
        $data['ref']="admin/";
        $tela = array('cabecalho' => 'telas/cabecalho_logado.php',
            'topo' => 'telas/vazio.php', //mostrar o topo somente quando n�o for a tela de login
            'faixa_horizontal' => 'telas/faixa_horizontal.php',
            'conteudo' => 'telas/index_admin.php');
        $this->parser->adc_css($this->css);
        $this->parser->adc_js($this->js);
        $this->parser->mostrar('templates/template_corpo.php', $tela, $data);
    }
   
   /* public function listaMedico(){
       $this->verificador->verificarAdminLogado();
        $data=  $this->getDadosAdministrador();
        $data['medicos']=$this->medico->getMedicoByEmpresa($this->session->userdata('cod_empresa'));
        $data['estado']=  $this->configGeral->getEstado();
        if(!is_null($data['medicos'])){
            foreach ($data['medicos'] as $key => $medico) {       
                $data['medicos'][$key]['ESPECIALIDADE']=  $this->getEspecialidade($medico['CODIGO']);          
            }
        }
        $data['ref']="admin/";
       $tela = array('cabecalho' => 'telas/cabecalho_logado.php',
            'topo' => 'telas/vazio.php', //mostrar o topo somente quando n�o for a tela de login
            'faixa_horizontal' => 'telas/vazio.php',
            'conteudo' => 'telas/lista/medico.php');
        $this->parser->adc_css($this->css);
        $this->parser->adc_js($this->js);
        $this->parser->mostrar('templates/template_corpo.php', $tela, $data);
    }
    public function getEspecialidade($cod_medico){
        $especialidades= $this->medico->getEspecialidadeMedico($cod_medico);
        $ret="";
        if(is_null($especialidades)){
            return "Não Informado";
        }else{
            foreach ($especialidades as $especialidade) {
                $ret.=ucfirst(mb_strtolower($especialidade['ESPECIALIDADE'])).", ";
            }
        }
        return $ret;
    }*/
    
   
 /*   public function cadastroAtendente() {
        $this->verificador->verificarAdminLogado();
        $data=  $this->getDadosAdministrador();
        $data['mensageFaixa'] = "Preencha todas as informações abaixo.";
        $tela = array('cabecalho' => 'telas/cabecalho_logado.php',
            'topo' => 'telas/vazio.php', //mostrar o topo somente quando n�o for a tela de login
            'faixa_horizontal' => 'telas/faixa_horizontal.php',
            'conteudo' => 'telas/cadastro/cadastroAtendente.php');
        $this->parser->adc_css($this->css);
        $this->parser->adc_js($this->js);
        $this->parser->mostrar('templates/template_corpo.php', $tela, $data);
    }

    public function cadastroMedico() {
        $this->verificador->verificarAdminLogado();
        
        $data['mensageFaixa'] = "Preencha todas as informações abaixo.";
        $data['dados_usuario'] = $this->empresa->getAdministrador($this->usuario);
        $tela = array('cabecalho' => 'telas/cabecalho_logado.php',
            'topo' => 'telas/vazio.php', //mostrar o topo somente quando n�o for a tela de login
            'faixa_horizontal' => 'telas/faixa_horizontal.php',
            'conteudo' => 'telas/cadastro/cadastroMedico.php');
        $this->parser->adc_css($this->css);
        $this->parser->adc_js($this->js);
        $this->parser->mostrar('templates/template_corpo.php', $tela, $data);
    }

    public function cadastroAtendenteF() {
        $this->verificador->verificarAdminLogado();
        $data =  $this->getDadosAdministrador();
        $data['mensageFaixa'] = "Preencha todas as informações abaixo.";
        //$data['dados_usuario'] = $this->empresa->getAdministrador($this->usuario);
        //print_r($data['dados_usuario']);die();
        $tela = array('cabecalho' => 'telas/cabecalho_logado.php',
            'topo' => 'telas/vazio.php', //mostrar o topo somente quando n�o for a tela de login
            'faixa_horizontal' => 'telas/faixa_horizontal.php',
            'conteudo' => 'telas/cadastro/cadastroAtendenteF.php');
        $this->parser->adc_css($this->css);
        $this->parser->adc_js($this->js);
        $this->parser->mostrar('templates/template_corpo.php', $tela, $data);
    }

    public function verificarLogado() {
        if (!$this->session->userdata('logged_admin_in')) {
            redirect('admin/login');
        }
    }*/
    
  
    public function testemail(){
        $dados['id']="00";
        $dados["senha"]= "123456";
        $dados["nome"]= "Teste de envio de email";
        $dados["email"]= "ivan.rufino.m@gmail.com";
        $dados["login"]= "Login de teste";
        $dados["redirect"]= "admin";
        $mail=$this->_email($dados);
        if($mail=="ok"){
            echo 'enviado';
        }else{
            echo $mail;
        }
    }
    
    
   /* public function getCidade($cod_estado){
        $cidades=  $this->configGeral->getCidade($cod_estado);
        $retorno="";
        foreach ($cidades as $key => $cidade) {
            $retorno.="<option value='".$cidade['NOME']."'>".$cidade['NOME']."</option>";
        }
        echo $retorno;
    }
 /*public function configuracao($page='home')  {
        $this->verificador->verificarAdminLogado();
        $data=  $this->getDadosAdministrador();
//        echo"<pre>";
//        print_r($data); 
//        echo"</pre>";
        //die();
        $data['mensageFaixa']="";
        
        $data['page']=$page;
        
        $tela=array(
            'cabecalho'=>'telas/cabecalho_logado.php', 
            'topo'=>'telas/vazio.php', //mostrar o topo somente quando n�o for a tela de login
            'faixa_horizontal'=>'telas/vazio.php',
            'dadosUpdate' =>'telas/update/updateAdmin',
            'dadosEmpresa'=>'telas/update/updateEmpresa',
            'updateSenha' =>'telas/update/updateSenha',
            'conteudo'=>'telas/conteudo_usuario.php',
        );
        
        $this->parser->adc_css($this->css);
        $this->parser->adc_css("../font-awesome/css/font-awesome.min");
        $this->parser->adc_js($this->js);
        $this->parser->adc_js('mapa');
        $this->parser->mostrar('templates/template_corpo.php',$tela,$data);
    }*/
    public function password_check($password) {
        $senha=$this->empresa->getSenha($this->input->post('codigo'));
        
        if (sha1($password) == $senha){
            return TRUE;
        }else{
            $this->form_validation->set_message('password_check', 'A %s não confere com a gravado no sistema');
            return FALSE;
        }
    }
    public function updateSenha() { 
        $this->form_validation->set_rules('senha_atual', 'Senha Atual', 'callback_password_check');
        $this->form_validation->set_message('matches', 'O campo Senha esta diferente do campo Repita a senha');
        $this->form_validation->set_rules('senha', 'Senha', 'required|min_length[6]|matches[confirma_senha]');
        
        if ($this->form_validation->run() == FALSE) {             
            $this->configuracao('seguranca');
            
        } else {
            
            //$this->session->userdata('cod_empresa')
            //$dadosPessoa = array("SENHA" =>  sha1( $this->input->post("senha")));
           
            $dados['SENHA']=sha1( $this->input->post("senha"));
            $codigo=$this->input->post('codigo');
            $this->empresa->updateAdmin($codigo,$dados);
            $this->session->set_flashdata('msg', 'Sua senha foi alterada com sucesso!');
            redirect('admin/configuracao');
           
        }
    }
    /*public function updateEmpresa() {
            $codigo = $this->input->post("codigo");
        $dados = array(
                "NOME" => $this->input->post("nome"),
                "RAZAO_SOCIAL" => $this->input->post("razao_social"),
                "DESCRICAO" => $this->input->post("descricao"),
                "CNPJ" => $this->input->post("cnpj"),
                "EMAIL" => $this->input->post("email_empresa"),
                "TELEFONE" => $this->input->post("telefone"),
                "CEP" => $this->input->post("cep"),
                "ESTADO" => $this->input->post("estado"),
                "ENDERECO" => $this->input->post("endereco"),
                "NUMERO" => $this->input->post("numero"),
                "BAIRRO" => $this->input->post("bairro"),
                "CIDADE" => $this->input->post("cidade"),
                "SEGMENTO" => $this->input->post("segmento"),
                "LATITUDE" => $this->input->post("latitude"),
                "LONGITUDE" => $this->input->post("longitude"),
            );
       
         if($this->empresa->updateEmpresa($codigo,$dados)){
            $this->session->set_flashdata('msg', 'Os dados informados foram alterados com sucesso!');
         }else{
             $this->session->set_flashdata('msg', 'Houve uma falha na gravação dos dados informados!<br> Por favor tente novamente.');
         }
            redirect('admin/configuracao');
        
    }*/
    public function update() {
        $codigo =  $this->input->post('codigo'); 
        $nomeFoto= $this->input->post('nomeFoto'); 
        $msg = $this->uploadImagem($codigo,$nomeFoto);
         
        $dados['NOME'] = $this->input->post('nome'); 
//        $dados['TELEFONE'] = $this->input->post('telefone'); 
//        $dados['CELULAR'] = $this->input->post('celular'); 
        $dados['EMAIL'] = $this->input->post('email'); 
        
        // $this->farmaceutico->updatePessoa($dados,$codigo);
         $this->empresa->updateAdmin($codigo,$dados);
        $this->session->set_flashdata('msg', 'Seus dados foram alterados com sucesso!');
       redirect('admin/configuracao');
    }
    public function uploadImagem($id,$nomeFoto){
        $novoNomeFoto="foto_usuario_".$id.".jpg";
        if ($nomeFoto=="usuario.png"){
            $dados['FOTO']=$novoNomeFoto;
//            $this->empresa->updateAdmin($id,$dados);
        }
            $local='assets/imagens/foto/';
                $config['upload_path'] = $local;
                
		$config['allowed_types'] = 'png|jpg';
		$config['max_size']	= '450';
		$config['max_width']  = '500';
		$config['max_height']  = '500';
                $config['overwrite']  = true;
                $config['file_name']  = $novoNomeFoto;
                $this->upload->initialize($config);
		//$this->load->library('upload', $config);
                $field_name = "foto";
                
		if ( ! $this->upload->do_upload($field_name)){
                    echo $this->upload->display_errors('<div class="alert alert-danger">', '</div>');
			
		}else{
                    if(isset($dados['FOTO'])){
                    $this->usuarios->updatePessoa($dados,$id);}
                   $data =  $this->upload->data();
                  // echo "<img src='".$data['full_path']."'>";
                  $ret = "<div class='alert alert-success'>";
                    //$ret.= "<img class='img_temp' src='" .base_url().$local . $data['orig_name'] . "'>";

                    $ret.="<span>Foto de exibição alterada com Sucesso</span>";
                   
                    $ret.="<div>";
                         echo $ret;
                  // print_r($data);
		
		}
        
    }
    public function getCep($cep){
        $reg = simplexml_load_file("http://cep.republicavirtual.com.br/web_cep.php?formato=xml&cep=" . $cep);
 
            $dados['sucesso'] = (string) $reg->resultado;
            $dados['rua']     = (string) $reg->tipo_logradouro . ' ' . $reg->logradouro;
            $dados['bairro']  = (string) $reg->bairro;
            $dados['cidade']  = (string) $reg->cidade;
            $dados['estado']  = (string) $reg->uf;

            echo json_encode($dados);
    }
    /*DAQUI PRA BAIXO É TESTE*/
    
   public function boleto($valor=35){
       
     $this->load->library("My_Boleto");
        //$boleto=new My_Boleto();
         $boleto=new My_Boleto();
        $bradesco= $boleto->setBanco('Bradesco');
        $bradesco->setValor($valor);
        $bradesco->setTaxaBoleto(0);
        
        
        $codigo="324846547"; //este numero vira do banco da tabela pagamento/ cada pagamento ser� gerado para um cliente
        $bradesco->setDadosBoleto($codigo);
        $cliente=array(
                'sacado'=>'Ivan Rufino Martins',
                'endereco1'=>'Rua Madureira, 240',
                'endereco2'=>'São João de Meriti - RJ - CEP: 25565-241'            
        );
        $demostrativo=array("Pagamento de Mensalidade Servi�o SISCORE","Plano Mensal", "www.siscore.com.br");
        $instrucoes=array(
            "- Sr. Caixa, cobrar multa de 2% após o vencimento",
            "- Receber até 10 dias após o vencimento", 
            "- Em caso de dúvidas entre em contato conosco: www.siscore.com.br",
            "- Atenciosamente");
            
        

// DADOS PERSONALIZADOS - Bradesco
        
        $dadosConta=array(
            'agencia'=>'0436',
            'agencia_dv'=>'0',
            'conta'=>'0455503',
            'conta_dv'=>'1',
            'conta_cedente'=>'0102003',
            'conta_cedente_dv'=>'4',
            'carteira'=>'6');
        $dadosEmpresa=array(
            "identificacao" => "SISCORE Sistema de Controle de Receitas",
            "cpf_cnpj" => "09878909897",
            "endereco" => "Endereço Completo, se tiver",
            "cidade_uf" => "RJ",
            "cedente" => "SISCORE",
        );
        $bradesco->setDadosCliente($cliente);
        $bradesco->setDemostrativo($demostrativo);
        $bradesco->setInstrucoes($instrucoes);
         $bradesco->setDadosConta($dadosConta);
         $bradesco->setDadosEmpresa($dadosEmpresa);
        
        $dados=$bradesco->gerarBoleto(); 
       $this->load->view("boleto/layout_bradesco",$dados);
      
         //$this->printArray($dados);
   }
   public function boletopdf($valor=35){
       
     $this->load->helper(array('dompdf', 'file'));
     $this->load->library("My_Boleto");
     $html=  file_get_contents(base_url()."admin/boleto/45.html");
      //  $html="<h1 style='color:red'>testador</h1><p>alguma coisa aqui</p>";
        pdf_create($html, 'boleto_nome_da_pessoa');
       
      //  $datas = pdf_create($html, '', false);
     //write_file('name', $datas);
         //$this->printArray($dados);
   }
   
    public function printArray($array){
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }

    
    public function carregaViewTab($view) {
       
        switch ($view) {
            case 'cadastroEndereco':
                $dados['endereco'] =  $this->usuarios->getEndereco($this->usuario);
                break;
            case 'qualificacao':
               $dados['qualificacao'] = $this->usuarios->getQualificacao($this->usuario);
               break;
           case 'amigos':
               $dados['amigos'] = $this->usuarios->getAmigos($this->usuario);
              break;
          case 'dadosPessoais':
               $dados['info'] = $this->usuarios->getUsuario2($this->usuario);
              break;
            case 'preferencias':
                $dados['preferencias'] = $this->usuarios->getPreferencias($this->usuario);
                break;
            default:
               // $dados=NULL;
                break;
        }
        
        echo $this->load->view("telas/$view",$dados,false);
       // echo "você esta vendo a view $view";
    }
    public function cadastroEndereco() {
        
        $this->form_validation->set_rules('ENDERECO', 'Endereço', 'required');
        $this->form_validation->set_rules('NUMERO', 'Número', 'required|numeric');        
        $this->form_validation->set_rules('CEP', 'Cep', 'required|exact_length[8]|numeric');
        $this->form_validation->set_rules('CIDADE', 'Cidade', 'required');
        $this->form_validation->set_rules('ESTADO', 'Estado', 'required|exact_length[2]');
        $this->form_validation->set_rules('BAIRRO', 'Bairro', 'required');
        if ($this->form_validation->run() == FALSE){
                echo validation_errors();
            }else{
                $dados = $this->input->post();
                $dados['COD_USUARIO'] = $this->usuario;
              //  print_r($dados);die();
                $id=$this->usuarios->salvarEndereco($dados);
                if (!is_null($id)){
                    echo "Endereço salvo com sucesso";
                }else{
                    echo "Não foi possivel registrar seu endereço, por favor tente mais tarde.";
                }
                //$this->load->view('formsuccess');
            }
    }
     public function updateEndereco($codigo) {
        
        $this->form_validation->set_rules('ENDERECO', 'Endereço', 'required');
        $this->form_validation->set_rules('NUMERO', 'Número', 'required|numeric');        
        $this->form_validation->set_rules('CEP', 'Cep', 'required|exact_length[8]|numeric');
        $this->form_validation->set_rules('CIDADE', 'Cidade', 'required');
        $this->form_validation->set_rules('ESTADO', 'Estado', 'required|exact_length[2]');
        $this->form_validation->set_rules('BAIRRO', 'Bairro', 'required');
        if ($this->form_validation->run() == FALSE){
                echo validation_errors();
            }else{
                $dados = $this->input->post();
                
                //print_r($codigo);die();
                $id=$this->usuarios->alterarEndereco($codigo,$dados);
                if (!is_null($id)){
                    echo "Endereço salvo com sucesso";
                }else{
                    echo "Não foi possivel registrar seu endereço, por favor tente mais tarde.";
                }
                //$this->load->view('formsuccess');
            }
    }
    public function cadastroDadosPessoais() {
        //die('Dados salvo com sucesso.');
        $this->form_validation->set_rules('NOME', 'Nome', 'required');
//        $this->form_validation->set_rules('NUMERO', 'Número', 'required|numeric');        
//        $this->form_validation->set_rules('CEP', 'Cep', 'required|exact_length[8]|numeric');
//        $this->form_validation->set_rules('CIDADE', 'Cidade', 'required');
//        $this->form_validation->set_rules('ESTADO', 'Estado', 'required|exact_length[2]');
//        $this->form_validation->set_rules('BAIRRO', 'Bairro', 'required');
        if ($this->form_validation->run() == FALSE){
                echo validation_errors();
            }else{
                $nomeFoto= $this->input->post('nomeFoto');
                $msg = $this->uploadImagem($this->usuario,$nomeFoto);
                $dados['NOME']=    $this->input->post('NOME');
                $up= $this->usuarios->updatePessoa($dados,$this->usuario);
                
                if ($up){
                     $ret=  "Dados salvo com sucesso";
                    $ret.="<br><strong>necessário atualizar a página para visualizar a nova imagem.</strong>";
                    echo $ret;
                }else{
                    
                    echo  "Não foi possivel alterar nome de Exibição, por favor tente mais tarde.";
                     
                }
                //$this->load->view('formsuccess');
            }
    }
    public function historico($id = NULL) {
        $dados = $this->usuarios->getUsuario($this->usuario);
        print_r($dados);
        $historico = unserialize($dados['historico']);

        if (!is_null($id)) {
            //$busca=array('data'=>'2015-02-01','id'=>$id);
            if (array_key_exists($id, $historico)) {
                //  echo Date('Y-m-d');
                unset($historico[$id]);
                // echo "encontrado";
            }
            $historico += array($id => Date('Y-m-d'));
        }
        arsort($historico);
        echo count($historico);
        if (count($historico) > 10) {
            array_pop($historico);
        }

        echo "<pre>";
        print_r($historico);
        echo "</pre>";
        echo serialize($historico);
    }
    public function getGrupo($codUsuario,$quant = 10) {
        $inicio=true;
        $ids[]=$codUsuario;
       for($x=0;$x<$quant;$x++){
             $this->db->select();
            $this->db->from('grafo AS p');
            $this->db->where_in('COD_USUARIO1', $ids);  
            if($inicio){
                $this->db->or_where_in('COD_USUARIO2', $ids);  
            }else{
                $this->db->where_not_in('COD_USUARIO2', $ids);  
            }
            $this->db->limit(1);
            $this->db->order_by('DISTANCIA_EUCLIDIANA ASC , COD_USUARIO2 asc');
            $sql=$this->db->get(); 
           // echo $this->db->last_query(); die();
            if($sql->num_rows > 0){
                $resultado=$sql->row_array();
                $ids[]=$resultado['COD_USUARIO2'];
                print_r($resultado);
                $inicio=false;
                echo "<br><br>";
            }else{ 
                echo  NULL;
            }
            
        }
    }
    public function criarGrafo() {
        // executar sempre que houver uma ação na estantevirutal(pedido enviado, pedido recebido, inserção de livros)
        
        $usuarios= $this->usuarios->getUsuarioGrafo(array('COD_USUARIO','NOME'));
        $grafos=array();

        foreach ($usuarios as $usuario) {
            $generos = $this->usuarios->getUsuarioGrafo(array('COD_GENERO','QUANT'),$usuario['COD_USUARIO']);
            foreach ($generos as $genero) {
                $grafos[$usuario['COD_USUARIO']][$genero['COD_GENERO']]=$genero['QUANT'];
            }
        }
        ksort($grafos);
        $grafos2=$grafos;
        //echo "<pre>";print_r($grafos);echo "</pre>"; die();
        $grafoDot="graph { <br>";
        $dados=array();
        foreach ($grafos as $usuario => $genero) {
             foreach ($grafos2 as $usuario2 => $genero2) {
                 if($usuario < $usuario2){
                    echo $usuario."-".$usuario2."<br>";
                    $produto= $this->calculaProdutoEscalar($genero,$genero2,4,4);
                    $DI= $this->calculaDistanciaEuclidiana($genero,$genero2,4,4);
                    if($produto > 0){
                    $dados[]=array(
                        'COD_USUARIO1'=>$usuario,
                        'COD_USUARIO2'=>$usuario2,
                        'PRODUTO'=>$produto,
                        'DISTANCIA_EUCLIDIANA'=>$DI
                            
                    );
                    //if($produto){
                     $grafoDot.="$usuario -- $usuario2 [label=\"$produto\",weight=\"$produto\"];<br>";
                    }
                 }
             }
            // die();
        }
        $grafoDot.=" } "; //$N=array('COD_USUARIO1'=>10,'COD_USUARIO2'=>11,'PRODUTO'=>26);//$N[]=array('COD_USUARIO1'=>10,'COD_USUARIO2'=>12,'PRODUTO'=>450);
       // $this->db->replace('grafo',$N);
        
       if($this->db->insert_batch('grafo', $dados)){
           echo "Gravado com sucesso";
       } else{
           echo "Não Gravado";
       }
      
        
    }
    public function calculaProdutoEscalar($genero,$genero2,$limit=30, $min=0) {
        $g=  array_intersect_key($genero, $genero2);
        $res=0;
       
        foreach ($g as $key => $vet) {
             $res += $genero[$key]*$genero2[$key];
             echo "Prod ($genero[$key] *  $genero2[$key] = ". $genero[$key] *  $genero2[$key].")<br>";
            
        }
        echo $res."<br><br>";
        return $res;
        
    }
        public function calculaDistanciaEuclidiana($genero,$genero2,$limit=30, $min=0) {
        $g=  array_intersect_key($genero, $genero2);
        $res=0;
        $n=0;
         /*√((x1 – x2)² + (y1 – y2)²)*/
        foreach ($g as $key => $vet) {
            $n++;
              $res += ($genero[$key]-$genero2[$key])*($genero[$key]-$genero2[$key]);
              echo "Deuc (($genero[$key] -  $genero2[$key])² = ". ($genero[$key]-$genero2[$key])*($genero[$key]-$genero2[$key]) .")<br>";
        }
        echo sqrt($res) ."<br><br>";
        
        return sqrt($res);
        
    }
    public function key_compare_func($key1, $key2){
    if ($key1 == $key2)
        return 0;
    else if ($key1 > $key2)
        return 1;
    else
        return -1;
}
    public function gerarGrafo() {
         $id=25;$limit=5; $limitProd=25;
        $user=  $this->getGrafo($id,$limit, $limitProd,1);
       
            $grafo = "graph {<br>";
            $grafo.=$user;
//            foreach ($user as $nodos) {
//                $grafo.="{$nodos['COD_USUARIO1']} -- {$nodos['COD_USUARIO2']} [label=\"{$nodos['PRODUTO']}\",weight=\"{$nodos['PRODUTO']}\"];<br>";
//                
//            }
           
            echo $grafo."}";
            echo "</pre>";
    }
    public function getGrafo( $id,$limit, $limitProd,$fim=0) {
       // if($fim ==1)return NULL;
        $this->db->select();
         $this->db->distinct();
        $this->db->from('v_grafo AS p');
        
        $this->db->where('COD_USUARIO1', $id );
        $this->db->or_where('COD_USUARIO2', $id );   
        if($limitProd>0){
            $this->db->where('PRODUTO > ', $limitProd );
        }
        $this->db->limit($limit);
       // $this->db->order_by('COD_GENERO');
        $sql=$this->db->get(); 
      //echo $this->db->last_query();
        
        if($sql->num_rows > 0){
            $grafo="";
            foreach ($sql->result_array() as $nodos) {
                $grafo.="{$nodos['USUARIO1']} -- {$nodos['USUARIO2']} [label=\"{$nodos['PRODUTO']}\",weight=\"{$nodos['PRODUTO']}\"];<br>";
                
                if($fim < 6){
                    ++$fim;
                    //echo $fim;
                    $grafo.= $this->getGrafo($nodos['COD_USUARIO1'],3,25,$fim);
                }
            }
           return $grafo;
        }else{ 
            return NULL;
        }
    }
    /*
     * public function login() {
        $mensagemTemp=$this->session->flashdata('mensagem');
        $mensagemTemp.=$this->session->flashdata('mensagem_erro');
        if($mensagemTemp!=""){
            $mensagem=$mensagemTemp;
        }else{
           $mensagem="Entre com  suas informações de adminstrador, <br> Se for novo aqui, cadastre sua empresa" ;
        }
        $data['mensageFaixa'] =$mensagem;
        $data['mensagem_erro'] = "";
        $data['lnklogin']=  base_url()."login";
        $data['labelLogin']="Acesso Usuário";
        $tela = array(
            'cabecalho' => 'telas/cabecalho.php',
            'topo' => 'telas/vazio.php', //mostrar o topo somente quando não for a tela de login
            'faixa_horizontal' => 'telas/faixa_horizontal.php',
            'conteudo' => 'telas/login_admin.php',
        );


        $this->parser->adc_css($this->css);
        $this->parser->adc_js($this->js);
        $this->parser->mostrar('templates/template_corpo.php', $tela, $data);
    }
     */

    

    

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */