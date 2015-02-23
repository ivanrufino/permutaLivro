<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Paciente extends CI_Controller {
    /* medico=1; atendente= 2;atendenteF= 3;paciente= 4; */

    public $css = null;
    public $js = null;
    private $cat = 4;
    public $usuario;

    public function __construct() {
        parent::__construct();
        $this->css=array('bootstrap','menu','small-business','painel_user','tabs','hover','../lighter/css/lighter');    
        $this->js = array('jquery-1.10.2', 'bootstrap', 'funcoesComuns', 'jquery.maskedinput.min','jquery.dataTables.min','jquery.form.min','bootstrap-filestyle.min' );
        //$this->load->helper();
        $this->load->model('usuario_model', 'usuarios');
        $this->load->model('atendente_model', 'atendente');
        $this->load->model('paciente_model', 'paciente');
        $this->load->model('config_model', 'configGeral');
        
        $this->usuario=$this->session->userdata('cod_usuario');
        
        
    }

    public function index() {
         $this->verificador->verificaCategoria($this->cat);
        $data=  $this->getDadosPaciente();
        $data['mensageFaixa']=$this->session->flashdata('mensagem');
        
        $tela=array(
            'cabecalho'=>'telas/cabecalho_logado.php', 
            'topo'=>'telas/vazio.php', //mostrar o topo somente quando n�o for a tela de login
            'faixa_horizontal'=>'telas/faixa_horizontal.php',
            //'modalPesquisaPaciente'=>'telas/pesquisaPaciente',
            'conteudo'=>'telas/index_paciente.php',
        );       
 
        $this->parser->adc_css($this->css);
        $this->parser->adc_js($this->js);
        $this->parser->mostrar('templates/template_corpo.php',$tela,$data);
        /*if ($this->cat != $this->session->userdata('categoria')) {
            $msg = "<div class='alert alert-warning'>Voce foi redirecionado porque tentou acessar uma tela que n&atilde;o tem permiss&atilde;o.</div>";
            $this->session->set_flashdata('mensagem_erro', $msg);
            redirect('/login', 'refresh');
        }
        $data['mensageFaixa'] = "Ola Paciente X";
        //$this->load->view('welcome_message');
        //  Os scripts e css podem ser adicionados tanto em um único comando ou em vários, bastando passar a info por array ou não
        $tela = array(
            'cabecalho' => 'telas/cabecalho.php',
            'topo' => 'telas/vazio.php', //mostrar o topo somente quando n�o for a tela de login
            'faixa_horizontal' => 'telas/faixa_horizontal.php',
            'conteudo' => 'telas/vazio.php',
        );


        $this->parser->adc_css($this->css);
        $this->parser->adc_js($this->js);
        $this->parser->mostrar('templates/template_corpo.php', $tela, $data);*/
    }
    public function configuracao($page='home')  {
        $this->verificador->verificaCategoria($this->cat);
        $data=  $this->getDadosPaciente();
       
        $data['mensageFaixa']="Ola Atendente";
        $data['page']=$page;
        $tela=array(
            'cabecalho'=>'telas/cabecalho_logado.php', 
            'topo'=>'telas/vazio.php', //mostrar o topo somente quando n�o for a tela de login
            'faixa_horizontal'=>'telas/vazio.php',
            'dadosUpdate' =>'telas/update/updatePaciente',
            'updateSenha' =>'telas/update/updateSenha',
            'conteudo'=>'telas/conteudo_usuario.php',
        );
        
        $this->parser->adc_css($this->css);
        $this->parser->adc_css("../font-awesome/css/font-awesome.min");
        $this->parser->adc_js($this->js);
        $this->parser->mostrar('templates/template_corpo.php',$tela,$data);
    }
    public function password_check($password) {
        $senha=$this->paciente->getSenha($this->input->post('codigo_pessoa'));
        
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
            $this->paciente->updatePessoa($dados,$codigo);
            $this->session->set_flashdata('msg', 'Sua senha foi alterada com sucesso!');
            redirect('paciente/configuracao');
           
        }
    }
    public function getDadosPaciente(){
         $data =array_change_key_case (  $this->paciente->getPaciente($this->usuario));
         $data['pasta']='paciente/';
         $data['ref']="paciente/";
        return $data;
    }
    public function telaCadastro() {
        $this->verificador->verificaCategoria(2);
        
         $data =array_change_key_case ( $this->atendente->getAtendente($this->usuario));
         $data['estado']=  $this->configGeral->getEstado();
         $estadoSelecionado=$this->session->flashdata('estado');
         if ($estadoSelecionado==""){$estadoSelecionado='RJ';}
        foreach ($data['estado'] as $key => $estado) {
            $data['estado'][$key]['SELECTED']='';
            if ($estado['UF']==$estadoSelecionado){
                $data['estado'][$key]['SELECTED']='SELECTED';                        
            }
        }
         $data['pasta']='atendente/';
        
        $data['mensageFaixa']="Colocar alguma frase";
        
        $tela=array(
            'cabecalho'=>'telas/cabecalho_logado.php', 
            'topo'=>'telas/vazio.php', //mostrar o topo somente quando n�o for a tela de login
            'faixa_horizontal'=>'telas/faixa_horizontal.php',
            'cadastroPaciente'=>'telas/cadastro/cadastroPaciente.php',
            'modalPesquisaPaciente'=>'telas/pesquisaPaciente',
            'conteudo'=>'telas/cadastro/cadastroPaciente.php',
        );       
 
        $this->parser->adc_css($this->css);
        $this->parser->adc_js($this->js);
        $this->parser->adc_js('mapa');
        $this->parser->mostrar('templates/template_corpo.php',$tela,$data);
    }
    
    public function buscarcpf($cpf){
        $dados=  $this->usuarios->buscarcpf($cpf);
        //rint_r($dados); 
        if(!is_null($dados)){
             $dados=array_change_key_case ( $dados);
            
            echo json_encode($dados);
//           echo" <div  class='alert alert-success'><pre>";
//           print_r($dados); // echo $dados['EMAIL']; 
//            echo "</pre></div>";
        }else{ echo 0;
            //echo "<div  class='alert alert-danger'>Não existe paciente cadastro com CPF.</div>";
        }
    }
    public function update() {
        $codigo =  $this->input->post('codigo'); 
        $nomeFoto= $this->input->post('nomeFoto'); 
        $msg = $this->uploadImagem($codigo,$nomeFoto,false);
         
        $dados['NOME'] = $this->input->post('nome'); 
        $dados['TELEFONE'] = $this->input->post('telefone'); 
        $dados['CELULAR'] = $this->input->post('celular'); 
        $dados['EMAIL'] = $this->input->post('email'); 
        
        $dados['DATA_NASCIMENTO'] = $this->input->post('data_nascimento'); 
        $dados['CPF'] = $this->input->post('cpf'); 
        $dados['CEP'] = $this->input->post('cep'); 
        $dados['ENDERECO'] = $this->input->post('endereco'); 
        $dados['NUMERO'] = $this->input->post('numero'); 
        $dados['BAIRRO'] = $this->input->post('bairro'); 
        $dados['ESTADO'] = $this->input->post('estado'); 
        $dados['CIDADE'] = $this->input->post('cidade'); 
       // print_r($this->input->post());
      //  die();
        
         $this->paciente->updatePessoa($dados,$codigo);
        $this->session->set_flashdata('msg', 'Seus dados foram alterados com sucesso!');
       redirect('paciente/configuracao');
    }
    public function cadastro() { 
         $this->form_validation->set_rules('nome', 'Paciente', 'required');
        $this->form_validation->set_message('is_unique', '%s já esta sendo utilizado.');
        $this->form_validation->set_rules('cpf', 'CPF', 'required|min_length[6]|is_unique[tcc_paciente.CPF]');
        $this->form_validation->set_rules('senha', 'Senha', 'required|min_length[6]');
        $this->form_validation->set_rules('email', 'Email do Paciente', 'required|email|is_unique[tcc_pessoa.EMAIL]');
       // $this->form_validation->set_rules('telefone', 'Telefone');
        $this->form_validation->set_rules('celular', 'Celular');
        

        if ($this->form_validation->run() == FALSE) {           
            $this->session->set_flashdata('errors', validation_errors());
            foreach ($this->input->post() as $key => $value) {
                $this->session->set_flashdata($key, $value);
            }
                
            redirect('atendente/cadastroPaciente');
        } else {
            
            //$this->session->userdata('cod_empresa')
            $dadosPessoa = array(
                    "NOME" => $this->input->post("nome"),
                    "LOGIN" => str_replace(array(".","-"), "",$this->input->post("cpf")),
                    "SENHA" =>  md5( $this->input->post("senha")),
                    "EMAIL" => $this->input->post("email"),
                    "TELEFONE" => $this->input->post("telefone"),
                    "CELULAR" => $this->input->post("celular"),
                    "CATEGORIA" => $this->cat,
                
            );
            $dadosPaciente=array(
                "CPF"=>$this->input->post("cpf"),
                "CEP"=>$this->input->post("cep"),
                "ENDERECO"=>$this->input->post("endereco"),
                "BAIRRO"=>$this->input->post("bairro"),
                "ESTADO"=>$this->input->post("estado"),
                "CIDADE"=>$this->input->post("cidade"),
                "NUMERO"=>$this->input->post("numero"),
                
            );
           
            $idPaciente = $this->paciente->novoPaciente($dadosPessoa,$dadosPaciente);
            if (!is_null($idPaciente)) {
                 $dados['id']=$idPaciente;
                    $dados["senha"]= $this->input->post("senha");
                    $dados["nome"]= $this->input->post("nome");
                    $dados["email"]= $this->input->post("email");
                    $dados["login"]= str_replace(array(".","-"), "",$this->input->post("cpf"));
                    $dados["redirect"]= "paciente";
                    $this->_email($dados);
                $this->session->set_flashdata('mensagem', "<div class='alert alert-success'>Cadastro realizado com successo.<br>Enviamos um email de ativação para conta criada, para que seja efetuada a ativaçao.</div>");
                    redirect('atendente');
                } else {
                     $this->session->set_flashdata('mensagem', "Não foi possivel efetuar a inserção do novo atendente");
                    redirect('atendente/cadastroPaciente');
                }
           
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
            $msg =$this->email->print_debugger();
        }
        return $msg;
    }
    
  
    public function ativarConta($id){
        $dados['STATUS']='1';
        $ret=$this->paciente->updatePaciente($dados,$id);
        if($ret){
             $msg  = "<div class='alert alert-success'>Seu cadastro foi ativado com sucesso.<br>Utilize os dados de acesso para entrar no sistema. <br></div>";
            $this->session->set_flashdata('mensagem', $msg);
            
        }else{
             $msg  = "<div class='alert alert-danger'>Houve uma falha na ativação do seu cadastro, por favor entre em contato com o desenvolvedor<br></div>";
            $this->session->set_flashdata('mensagem_erro', $msg);
        }
        redirect('login');
    }
    
    public function uploadImagem($id, $nomeFoto,$ajax=true) {
        $novoNomeFoto = "imagem_" . $id . ".jpg";
        
        $local = 'assets/fotos/paciente/';
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
            if ($nomeFoto == "paciente.png") {
                $dados['FOTO'] = $novoNomeFoto;
                $this->paciente->updatePaciente( $dados,$id);
            }
            $data = $this->upload->data();
            // echo "<img src='".$data['full_path']."'>";
            $ret = "<div class='alert alert-success'>";
           $ret.="<span>Arquivo Gravado com Sucesso</span>";
            $ret.="<br><strong>necessário atualizar a página para visualizar a nova imagem.</strong>";
            $ret.="<div>";
            if($ajax){ echo $ret;}
            // print_r($data);
        }
    }

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */