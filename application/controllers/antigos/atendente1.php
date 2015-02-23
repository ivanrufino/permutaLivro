<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Atendente extends CI_Controller {
    /*medico=1; atendente= 2;atendenteF= 3;paciente= 4;*/
    public $css=null;
    public $js=null;
    private $cat=2;
    public $usuario;
    public $user_admin;
    public function __construct() {
        parent::__construct();
        $this->css=array('bootstrap','menu','small-business','painel_user','tabs','hover','../lighter/css/lighter');    
        $this->js = array('jquery-1.10.2', 'bootstrap', 'funcoesComuns', 'jquery.maskedinput.min','jquery.dataTables.min','jquery.form.min','bootstrap-filestyle.min');
                //$this->load->helper();
        $this->load->model('usuario_model', 'usuarios');
        $this->load->model('atendente_model', 'atendente');
        $this->load->model('empresa_model', 'empresa');
        $this->usuario=$this->session->userdata('cod_usuario');
        $this->user_admin=$this->session->userdata('cod_admin');
    }
    public function getDadosAtendente(){
       $dados= $this->atendente->getAtendente($this->usuario);
        if(!$dados){  
            $this->session->set_flashdata('mensagem', '<div class="alert alert-danger"><strong>Usuário</strong> ou <strong>empresa vinculada</strong> não existe.<br> Por favor contactar administrador</div>');
             redirect('login');
        }
         $data =array_change_key_case ($dados);
         
         $data['pasta']='atendente/';
         $data['ref']="atendente/";
        return $data;
    }
   public function index(){
      
        $this->verificador->verificaCategoria($this->cat);
        $data=  $this->getDadosAtendente();
        
        $data['mensageFaixa']=$this->session->flashdata('mensagem');;
        
        $tela=array(
            'cabecalho'=>'telas/cabecalho_logado.php', 
            'topo'=>'telas/vazio.php', //mostrar o topo somente quando n�o for a tela de login
            'faixa_horizontal'=>'telas/faixa_horizontal.php',
            'cadastroPaciente'=>'telas/cadastro/cadastroPaciente.php',
            'modalPesquisaPaciente'=>'telas/pesquisaPaciente',
            'conteudo'=>'telas/index_atendente.php',
        );       
 
        $this->parser->adc_css($this->css);
        $this->parser->adc_js($this->js);
        $this->parser->mostrar('templates/template_corpo.php',$tela,$data);
   }
    public function configuracao($page='home')  {
        $this->verificador->verificaCategoria($this->cat);
        $data=  $this->getDadosAtendente();
        
        //print_r($data); die();
        $data['mensageFaixa']="Ola Atendente";
        $data['page']=$page;
        $tela=array(
            'cabecalho'=>'telas/cabecalho_logado.php', 
            'topo'=>'telas/vazio.php', //mostrar o topo somente quando n�o for a tela de login
            'faixa_horizontal'=>'telas/vazio.php',
            'dadosUpdate' =>'telas/update/updateAtendente',
            'updateSenha' =>'telas/update/updateSenha',
            'conteudo'=>'telas/conteudo_usuario.php',
        );
        
        $this->parser->adc_css($this->css);
        $this->parser->adc_css("../font-awesome/css/font-awesome.min");
        $this->parser->adc_js($this->js);
        $this->parser->mostrar('templates/template_corpo.php',$tela,$data);
    }
   public function lista(){
        $this->verificador->verificarAdminLogado();
        $data=   array_change_key_case (  $this->empresa->getAdministrador($this->user_admin) );
        $data['pasta']='administrador/';
        $data['ref']="admin/";
        $data['atendentes']=$this->atendente->getAtendenteByEmpresa($this->session->userdata('cod_empresa'));
        
        $tela = array('cabecalho' => 'telas/cabecalho_logado.php',
            'topo' => 'telas/vazio.php', //mostrar o topo somente quando n�o for a tela de login
            'faixa_horizontal' => 'telas/vazio.php',
            'conteudo' => 'telas/lista/atendente.php');
        $this->parser->adc_css($this->css);
        $this->parser->adc_js($this->js);
        $this->parser->mostrar('templates/template_corpo.php', $tela, $data);
    }
    public function password_check($password) {
        $senha=$this->atendente->getSenha($this->input->post('codigo_pessoa'));
        
        if (md5($password) == $senha){
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
            //$dadosPessoa = array("SENHA" =>  md5( $this->input->post("senha")));
           
            $dados['SENHA']=md5( $this->input->post("senha"));
            $codigo=$this->input->post('codigo');
            $this->atendente->updatePessoa($dados,$codigo);
            $this->session->set_flashdata('msg', 'Sua senha foi alterada com sucesso!');
            redirect('atendente/configuracao');
           
        }
    }
    public function cadastro() { 
        $this->form_validation->set_rules('nome', 'Atendente', 'required');
        $this->form_validation->set_message('is_unique', '%s já esta sendo utilizado.');
        $this->form_validation->set_rules('login', 'Login', 'required|min_length[6]|is_unique[tcc_pessoa.LOGIN]');
        $this->form_validation->set_rules('senha', 'Senha', 'required|min_length[6]');
        $this->form_validation->set_rules('email', 'Email do Atendente', 'required|email|is_unique[tcc_pessoa.EMAIL]');
        $this->form_validation->set_rules('telefone', 'Telefone');
        $this->form_validation->set_rules('celular', 'Celular');
        

        if ($this->form_validation->run() == FALSE) {           
            $this->session->set_flashdata('errors', validation_errors());
            foreach ($this->input->post() as $key => $value) {
                $this->session->set_flashdata($key, $value);
            }
                
            redirect('admin/cadastroAtendente');
        } else {
            //$this->session->userdata('cod_empresa')
            $dadosPessoa = array(
                    "NOME" => $this->input->post("nome"),
                    "LOGIN" => $this->input->post("login"),
                    "SENHA" =>  md5( $this->input->post("senha")),
                    "EMAIL" => $this->input->post("email"),
                    "TELEFONE" => $this->input->post("telefone"),
                    "CELULAR" => $this->input->post("celular"),
                    "CATEGORIA" => $this->cat,
                
            );
            $dadosAtendente=array(
                "CODIGO_EMPRESA"=>$this->session->userdata('cod_empresa'),
            );
            $idAtendente = $this->atendente->novoAtendente($dadosPessoa,$dadosAtendente);
            if (!is_null($idAtendente)) {
                 $dados['id']=$idAtendente;
                    $dados["senha"]= $this->input->post("senha");
                    $dados["nome"]= $this->input->post("nome");
                    $dados["email"]= $this->input->post("email");
                    $dados["login"]= $this->input->post("login");
                    $dados["redirect"]= "atendente";
                    $this->_email($dados);
                $this->session->set_flashdata('mensagem', "<div class='alert alert-success'>Cadastro realizado com successo.<br>Enviamos um email de ativação para conta criada, para que seja efetuada a ativaçao.</div>");
                    redirect('admin/listaAtendente');
                } else {
                     $this->session->set_flashdata('errors', "Não foi possivel efetuar a inserção do novo atendente");
                    redirect('admin/cadastroAtendente');
                }
           
        }
    }
//    public function _email($dados) {      
//        $config = $this->configEmail();
//        $this->email->initialize($config);
//        $this->email->from('ivan.rufino.m@gmail.com', 'Ivan Rufino');
//        $this->email->to($dados['email']);
//        $this->email->subject('SISCORE: Ativação de Conta');
//        $mensagem=$this->load->view('telas/email/ativacao_conta',$dados,true);
//        $this->email->message($mensagem);
//        if (!$this->email->send()){
//            echo $this->email->print_debugger();
//        }
//        
//    }
    public function _email($dados) {        
        $this->email->from('ivan.rufino.m@gmail.com', 'Ivan Rufino');
        $this->email->to($dados['email']);
        $this->email->bcc('ivan.rufino.m@gmail.com');
        $this->email->subject('SISCORE: Ativação de Conta');
        $mensagem=$this->load->view('telas/email/ativacao_conta',$dados,true);
        $this->email->message($mensagem);
        $msg="ok";
        
        if (!$this->email->send()){            
            $msg =$this->email->print_debugger();
        }
        return $msg;
    }
    
    public function ativarConta($id){
        $dados['STATUS']='1';
        $ret=$this->atendente->updateAtendente($dados,$id);
        if($ret){
             $msg  = "<div class='alert alert-success'>Seu cadastro foi ativado com sucesso.<br>Utilize os dados de acesso para entrar no sistema. <br></div>";
            $this->session->set_flashdata('mensagem', $msg);
            
        }else{
             $msg  = "<div class='alert alert-danger'>Houve uma falha na ativação do seu cadastro, por favor entre em contato com o desenvolvedor<br></div>";
            $this->session->set_flashdata('mensagem_erro', $msg);
        }
        redirect('login');
    }
    public function update() {
        $codigo =  $this->input->post('codigo'); 
        $nomeFoto= $this->input->post('nomeFoto'); 
        $msg = $this->uploadImagem($codigo,$nomeFoto,false);
         
        $dados['NOME'] = $this->input->post('nome'); 
        $dados['TELEFONE'] = $this->input->post('telefone'); 
        $dados['CELULAR'] = $this->input->post('celular'); 
        $dados['EMAIL'] = $this->input->post('email'); 
        
         $this->atendente->updatePessoa($dados,$codigo);
        $this->session->set_flashdata('msg', 'Seus dados foram alterados com sucesso!');
        redirect('atendente/configuracao');
    }
    public function uploadImagem($id, $nomeFoto,$ajax=true) {
        $novoNomeFoto = "imagem_" . $id . ".jpg";
        
        $local = 'assets/fotos/atendente/';
        $config['upload_path'] = $local;

        $config['allowed_types'] = 'png|jpg';
        $config['max_size'] = '250';
        $config['max_width'] = '500';
        $config['max_height'] = '500';
        $config['overwrite'] = true;
        $config['file_name'] = $novoNomeFoto;
        $this->upload->initialize($config);
        //$this->load->library('upload', $config);
        $field_name = "foto";

        if (!$this->upload->do_upload($field_name)) {
          $ret= $this->upload->display_errors('<div class="alert alert-danger">', '</div>');
           if($ajax){ echo $ret;}
        } else {
            if ($nomeFoto == "atendente.png") {
                $dados['FOTO'] = $novoNomeFoto;
                $this->atendente->updateAtendente($dados,$id);
            }
            $data = $this->upload->data();
            // echo "<img src='".$data['full_path']."'>";
            $ret = "<div class='alert alert-success'>";
            //$ret.= "<img class='img_temp' src='" .base_url().$local . $data['orig_name'] . "'>";
            
            $ret.="<span>Arquivo Gravado com Sucesso</span>";
            $ret.="<br><strong>necessário atualizar a página para visualizar a nova imagem.</strong>";
            $ret.="<div>";
            if($ajax){ echo $ret;}
            
        }
    }

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */