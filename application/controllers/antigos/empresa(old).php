<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Empresa extends CI_Controller {

    public $css = null;
    public $js = null;
    public $usuario;

    public function __construct() {
        parent::__construct();
        $this->css = array('bootstrap', 'menu', 'small-business', 'painel_user', 'tabs');
        $this->js = array('jquery-1.10.2', 'bootstrap', 'funcoesComuns', 'jquery.maskedinput.min', );
        //$this->load->helper();
        $this->load->model('empresa_model', 'empresa');

        $this->usuario = $this->session->userdata('cod_admin');
    }

    public function index() {
        $this->admin();
    }

    public function login() {
        $data['mensageFaixa'] = "Entre com  suas informações de adminstrador, <br> Se for novo aqui, cadastre sua empresa";
        $data['mensagem_erro'] = "";
        $tela = array(
            'cabecalho' => 'telas/cabecalho_menu.php',
            'topo' => 'telas/vazio.php', //mostrar o topo somente quando n�o for a tela de login
            'faixa_horizontal' => 'telas/faixa_horizontal.php',
            'conteudo' => 'telas/login_admin.php',
        );


        $this->parser->adc_css($this->css);
        $this->parser->adc_js($this->js);
        $this->parser->mostrar('templates/template_corpo.php', $tela, $data);
    }

    public function cadastro() {
        $data['mensageFaixa'] = "Colocar Uma frase qualquer";
        $tela = array(
            'cabecalho' => 'telas/cabecalho.php',
            'topo' => 'telas/vazio.php', //mostrar o topo somente quando n�o for a tela de login
            'faixa_horizontal' => 'telas/vazio.php',
            'conteudo' => 'telas/cadastro/cadastroEmpresa.php',
        );


        $this->parser->adc_css($this->css);
        $this->parser->adc_js($this->js);
        $this->parser->adc_js('mapa');
        $this->parser->mostrar('templates/template_corpo.php', $tela, $data);
    }

    public function efetuarCadastro() {
        $this->form_validation->set_rules('nome', 'Administrador', 'required');
        $this->form_validation->set_message('is_unique', '%s já esta sendo utilizado.');
        $this->form_validation->set_rules('login', 'Login', 'required|min_length[6]|is_unique[tcc_administrador.LOGIN]');
        $this->form_validation->set_rules('senha', 'Senha', 'required');
        $this->form_validation->set_rules('email', 'Email do Administrador', 'required||is_unique[tcc_administrador.EMAIL]');
        $this->form_validation->set_rules('nome_empresa', 'Nome da Empresa');
        $this->form_validation->set_rules('razao_social', 'Razão Social', 'is_unique[tcc_empresa.RAZAO_SOCIAL]');
        $this->form_validation->set_rules('descricao', 'Descrição');
        $this->form_validation->set_rules('cnpj', 'CNPJ');
        $this->form_validation->set_rules('email_empresa', 'Email da Empresa');
        $this->form_validation->set_rules('telefone', 'Telefone');
        $this->form_validation->set_rules('cep', 'CEP');
        $this->form_validation->set_rules('endereco', 'Endereço');
        $this->form_validation->set_rules('bairro', 'Bairro');
        $this->form_validation->set_rules('cidade', 'Cidade');

        if ($this->form_validation->run() == FALSE) {
            $this->cadastro();
        } else {

            $dadosEmpresa = array(
                "NOME" => $this->input->post("nome_empresa"),
                "RAZAO_SOCIAL" => $this->input->post("razao_social"),
                "DESCRICAO" => $this->input->post("descricao"),
                "CNPJ" => $this->input->post("cnpj"),
                "EMAIL" => $this->input->post("email_empresa"),
                "TELEFONE" => $this->input->post("telefone"),
                "CEP" => $this->input->post("cep"),
                "ESTADO" => $this->input->post("estado"),
                "ENDERECO" => $this->input->post("endereco"),
                "BAIRRO" => $this->input->post("bairro"),
                "CIDADE" => $this->input->post("cidade"),
                "LATITUDE" => $this->input->post("latitude"),
                "LONGITUDE" => $this->input->post("longitude"),
            );
            $idEmpresa = $this->empresa->novaEmpresa($dadosEmpresa);
            if (!is_null($idEmpresa)) {
                $dadosAdministrador = array(
                    "NOME" => $this->input->post("nome"),
                    "EMAIL" => $this->input->post("email"),
                    "LOGIN" => $this->input->post("login"),
                    "SENHA" => md5($this->input->post("senha")),
                    "COD_EMPRESA" => $idEmpresa,
                );
                $idAdministrador = $this->empresa->novoAdministrador($dadosAdministrador);
                if (!is_null($idAdministrador)) {
                    $dados['id']=$idAdministrador;
                    $dados["senha"]= $this->input->post("senha");
                    $dados["nome"]= $this->input->post("nome");
                    $dados["email"]= $this->input->post("email");
                    $dados["login"]= $this->input->post("login");
                    $this->_email($dados);
                    $this->session->set_flashdata('mensagem', "<div class='alert alert-success'>Cadastro realizado com successo.<br>Enviamos um email de ativação para sua conta, siga o procedimento descrito no email para ativaçao.</div>");
                    redirect('empresa/login');
                } else {
                    $this->cadastro();
                }
            } else {
                $this->cadastro();
            }
        }
    }
    
    public function admin() {
        $this->verificarLogado();
        $data['mensageFaixa'] = "Selecione a apção desejada, clicando sobre a imagem";
        $data['dados_usuario'] = $this->empresa->getAdministrador($this->usuario);
        $data['CODIGO']=$data['dados_usuario'][0];
       // print_r($data['dados_usuario']);
       // die();
        $tela = array('cabecalho' => 'telas/cabecalho_logado.php',
            'topo' => 'telas/vazio.php', //mostrar o topo somente quando n�o for a tela de login
            'faixa_horizontal' => 'telas/faixa_horizontal.php',
            'conteudo' => 'telas/index_admin.php');
        $this->parser->adc_css($this->css);
        $this->parser->adc_js($this->js);
        $this->parser->mostrar('templates/template_corpo.php', $tela, $data);
    }

    public function cadastroAtendente() {
        $this->verificarLogado();
        $data['mensageFaixa'] = "Preencha todas as informações abaixo.";
        $data['dados_usuario'] = $this->empresa->getAdministrador($this->usuario);
        $tela = array('cabecalho' => 'telas/cabecalho_logado.php',
            'topo' => 'telas/vazio.php', //mostrar o topo somente quando n�o for a tela de login
            'faixa_horizontal' => 'telas/faixa_horizontal.php',
            'conteudo' => 'telas/cadastro/cadastroAtendente.php');
        $this->parser->adc_css($this->css);
        $this->parser->adc_js($this->js);
        $this->parser->mostrar('templates/template_corpo.php', $tela, $data);
    }

    public function cadastroMedico() {
        $this->verificarLogado();
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
        $this->verificarLogado();
        $data['mensageFaixa'] = "Preencha todas as informações abaixo.";
        $data['dados_usuario'] = $this->empresa->getAdministrador($this->usuario);
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
            redirect('empresa/login');
        }
    }
    public function ativarConta($id){
        $dados['STATUS']='1';
        $ret=$this->empresa->updateAdministrador($dados,$id);
        if($ret){
             $msg  = "<div class='alert alert-success'>Seu cadastro foi ativado com sucesso.<br>Utilize os dados de acesso para entrar no sistema. <br></div>";
            $this->session->set_flashdata('mensagem', $msg);
            
        }else{
             $msg  = "<div class='alert alert-danger'>Houve uma falha na ativação do seu cadastro, por favor entre em contato com o desenvolvedor";
        }
        redirect('empresa/login');
    }
}