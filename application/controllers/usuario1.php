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
        $this->css=array('cadastroempresa','bootstrap','menu','small-business','painel_user','tabs','hover','../lighter/css/lighter');    
        $this->js = array('jquery-1.10.2', 'bootstrap', 'funcoesComuns', 'jquery.maskedinput.min','jquery.dataTables.min','jquery.form.min','bootstrap-filestyle.min' );
        //$this->load->helper();
        $this->load->model('empresa_model', 'empresa');
        $this->load->model('usuario_model', 'usuarios');
        $this->load->model('atendente_model', 'atendente');
        $this->load->model('farmaceutico_model', 'farmaceutico');
        $this->load->model('medico_model', 'medico');
        $this->load->model('config_model', 'configGeral');

        $this->usuario = $this->session->userdata('cod_usuario');
        $this->cod_empresa= $this->session->userdata('cod_empresa');
        
    }
    
    public function hora($seconds){
        $hours = floor($seconds / 3600);
        $seconds -= $hours * 3600;
        $minutes = floor($seconds / 60);
        $seconds -= $minutes * 60;

        return "$hours : $minutes : $seconds";
    }
    public function index() {
      $this->verificador->verificarLogado();
        $data ['usuario']=  $this->usuarios->getUsuario( $this->usuario);
        $data['recados']='50';
        $data['numQuantLi']='20';
        $data['numQuantLendo']='24';
        $data['numQuantTenho']=$data['numQuantLi']+$data['numQuantLendo'];
        $data['queroLivros']=array(
            array('id'=>1,'capa'=>'http://tigubarcelos.files.wordpress.com/2008/07/capa_livro.jpg','autor'=>'Ivan Rufino Martins e bragança','titulo'=>'A noiva de todos os homens casados'),
            array('id'=>2,'capa'=>'http://tigubarcelos.files.wordpress.com/2008/07/capa_livro.jpg','autor'=>'Ivan Rufino Martins e bragança','titulo'=>'A noiva de todos os homens casados'),
            array('id'=>3,'capa'=>'http://tigubarcelos.files.wordpress.com/2008/07/capa_livro.jpg','autor'=>'Ivan Rufino Martins e bragança','titulo'=>'A noiva de todos os homens casados'),
            array('id'=>4,'capa'=>'http://tigubarcelos.files.wordpress.com/2008/07/capa_livro.jpg','autor'=>'Ivan Rufino Martins e bragança','titulo'=>'A noiva de todos os homens casados'),
            array('id'=>5,'capa'=>'http://tigubarcelos.files.wordpress.com/2008/07/capa_livro.jpg','autor'=>'Ivan Rufino Martins e bragança','titulo'=>'A noiva de todos os homens casados'),
            array('id'=>6,'capa'=>'http://tigubarcelos.files.wordpress.com/2008/07/capa_livro.jpg','autor'=>'Ivan Rufino Martins e bragança','titulo'=>'A noiva de todos os homens casados'),
            array('id'=>7,'capa'=>'http://tigubarcelos.files.wordpress.com/2008/07/capa_livro.jpg','autor'=>'Ivan Rufino Martins e bragança','titulo'=>'A noiva de todos os homens casados'),
            array('id'=>8,'capa'=>'http://tigubarcelos.files.wordpress.com/2008/07/capa_livro.jpg','autor'=>'Ivan Rufino Martins e bragança','titulo'=>'A noiva de todos os homens casados'),
        );
       // print_r($data);
      //  die();
     // die($this->session->userdata('logged_in'));
        $data['mensageFaixa']="";
        $tela = array('cabecalho' => 'telas/cabecalho.php',
            'topo' => 'telas/vazio.php', //mostrar o topo somente quando n�o for a tela de login
            'faixa_horizontal' => 'telas/faixa_horizontal.php',
            'lateral' => 'telas/lateral.php',
            'conteudo' => 'telas/index_usuario.php');
        $this->parser->adc_css($this->css);
        $this->parser->adc_js($this->js);
        $this->parser->mostrar('templates/template_corpo.php', $tela, $data);
    }
    public function recados() {
        echo 'meus recados';
    }
    public function login() {
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
            'topo' => 'telas/vazio.php', //mostrar o topo somente quando n�o for a tela de login
            'faixa_horizontal' => 'telas/faixa_horizontal.php',
            'conteudo' => 'telas/login_admin.php',
        );


        $this->parser->adc_css($this->css);
        $this->parser->adc_js($this->js);
        $this->parser->mostrar('templates/template_corpo.php', $tela, $data);
    }

    public function cadastro() {
        $data['mensageFaixa'] = "Cadastre-se e aproveite todas as vantagens dos serviços do Club do Livro";
        
        $tela = array(
            'cabecalho' => 'telas/cabecalho.php',
            'topo' => 'telas/vazio.php', //mostrar o topo somente quando n�o for a tela de login
            'faixa_horizontal' => 'telas/faixa_horizontal.php',
            'conteudo' => 'telas/cadastro/cadastroUsuario.php',
        );


        $this->parser->adc_css($this->css);
        $this->parser->adc_js($this->js);
        $this->parser->adc_js('mapa');
        $this->parser->mostrar('templates/template_corpo.php', $tela, $data);
    }

    public function efetuarCadastro() {
        $this->form_validation->set_rules('nome', 'Usuário', 'required');
        $this->form_validation->set_message('is_unique', '%s já esta sendo utilizado.');
//        $this->form_validation->set_rules('login', 'Login', 'required|min_length[6]|is_unique[tcc_administrador.LOGIN]');
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
                    $dados['id']=$idUsuario;
                    $dados["senha"]= $this->input->post("senha");
                    $dados["nome"]= $this->input->post("nome");
                    $dados["email"]= $this->input->post("email");
                    $dados["login"]= $this->input->post("email");
                    $dados["redirect"]= "usuario";
                    $this->_email($dados);
                    // $this->_send_email_ativacao($dados);
                    
                    $this->session->set_flashdata('mensagem', "<div class='alert alert-success'>Cadastro realizado com successo.<br>Utilize seu email e a senha pra entrar no sistema<br>Não esqueça de ativar a sua conta pelo email que enviamos</div>");
                    redirect('usuario/login');
                } else {
                    $this->cadastro();
                }
            
            
            
        }
    }
    public function getDadosAdministrador(){
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
    
   
    public function cadastroAtendente() {
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
    }
    public function ativarConta($id){
        $dados['STATUS']='1';
        $ret=$this->empresa->updateAdministrador($dados,$id);
        if($ret){
             $msg  = "<div class='alert alert-success'>Seu cadastro foi ativado com sucesso.<br>Utilize os dados de acesso para entrar no sistema. <br></div>";
            $this->session->set_flashdata('mensagem', $msg);
            
        }else{
             $msg  = "<div class='alert alert-danger'>Houve uma falha na ativação do seu cadastro, por favor entre em contato com o desenvolvedor<br></div>";
            $this->session->set_flashdata('mensagem_erro', $msg);
        }
        redirect('admin/login');
    }
  
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
    
    public function getCidade($cod_estado){
        $cidades=  $this->configGeral->getCidade($cod_estado);
        $retorno="";
        foreach ($cidades as $key => $cidade) {
            $retorno.="<option value='".$cidade['NOME']."'>".$cidade['NOME']."</option>";
        }
        echo $retorno;
    }
 public function configuracao($page='home')  {
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
    }
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
    public function updateEmpresa() {
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
        
    }
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
        $novoNomeFoto="imagem_".$id.".jpg";
        if ($nomeFoto=="administrador.jpg"){
            $dados['FOTO']=$novoNomeFoto;
            $this->empresa->updateAdmin($id,$dados);
        }
            $local='assets/fotos/administrador/';
                $config['upload_path'] = $local;
                
		$config['allowed_types'] = 'png|jpg';
		$config['max_size']	= '250';
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
                   $data =  $this->upload->data();
                  // echo "<img src='".$data['full_path']."'>";
                  $ret = "<div class='alert alert-success'>";
                    //$ret.= "<img class='img_temp' src='" .base_url().$local . $data['orig_name'] . "'>";

                    $ret.="<span>Arquivo Gravado com Sucesso</span>";
                    $ret.="<br><strong>necessário atualizar a página para visualizar a nova imagem.</strong>";
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
    public function deleteAtendenteInativo(){
        //Buscar e excluir atendentes que não fizeram a ativação do cadastro
        $empresas=$this->empresa->getEmpresas();
        foreach ($empresas as $empresa) {
            $dados="Os seguinte Usuarios foram excluidos por inatividade<br>";
            $atendentes=$this->atendente->getAtendenteByEmpresa($empresa['CODIGO'],'0'); 
            foreach ($atendentes as $atendente) {
                
           // EXCLUIR CADA ATENDENTE A PARTIR DAQUI
            $dados.="Nome: ".$atendente['NOME'];$dados.="<br>";
            $dados.="Login: ".$atendente['LOGIN'];$dados.="<br>";
            $dados.="Email: ".$atendente['EMAIL'];$dados.="<br>";
            $dados.="<hr>";
            }
            // ENVIAR EMAIL PARA O ADMINISTRADOR DA EMPRESA
            $this->printArray($dados);
        }
         
        die();
         
    }
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
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */