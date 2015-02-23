<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Receita extends CI_Controller {
    /* medico=1; atendente= 2;atendenteF= 3;paciente= 4; */

    public $css = null;
    public $js = null;
    
    public $usuario;

    public function __construct() {
        parent::__construct();
        $this->css=array('bootstrap','menu','small-business','painel_user','tabs','hover','../lighter/css/lighter','comuns');    
        $this->js = array('jquery-1.10.2', 'bootstrap', 'funcoesComuns', 'jquery.maskedinput.min','jquery.dataTables.min','jquery.form.min' );
        //$this->load->helper();
        $this->load->model('usuario_model', 'usuarios');
        $this->load->model('paciente_model', 'paciente');
        $this->load->model('medico_model', 'medico');
        $this->load->model('farmaceutico_model', 'farmaceutico');
        $this->load->model('medicamento_model', 'medicamentos');
        $this->load->model('config_model', 'configGeral');
        
        $this->usuario=$this->session->userdata('cod_usuario');
        
        
    }

    public function _index() {
        if ($this->cat != $this->session->userdata('categoria')) {
            $msg = "<div class='alert alert-warning'>Voce foi redirecionado porque tentou acessar uma tela que n&atilde;o tem permiss&atilde;o.</div>";
            $this->session->set_flashdata('mensagem_erro', $msg);
            redirect('/login', 'refresh');
        }
        $data['mensageFaixa'] = "";
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
        $this->parser->mostrar('templates/template_corpo.php', $tela, $data);
    }
    
    public function telaBuscarReceita($cat){
        $this->verificador->verificaCategoria($cat); 
        switch ($cat) {
            case 1:
                $data =array_change_key_case ($this->medico->getMedico($this->usuario));
                $dadosMedico = array(
                   'codigoMedico'  => $data['codigo'],                  
               );

             $this->session->set_userdata($dadosMedico);
                $data['receitas']=$this->medicamentos->getReceitasByMedico($data['codigo']);
                $data['ref']=$data['pasta']='medico/'; 
                break;

            case 3:
                $data =array_change_key_case (  $this->farmaceutico->getFarmaceutico($this->usuario));
                $data['ref']=$data['pasta']='atendenteF/';      
                $data['receitas']=array();
                break;
            case 4:
                $data =array_change_key_case (  $this->paciente->getPaciente($this->usuario));
               // print_r($data); die();
                $data['ref']=$data['pasta']='paciente/';      
                $data['receitas']=$this->medicamentos->getReceitasByPaciente($data['cpf'],4);
                break; 
            
            default:
                break;
        }
       
        
//        if ($cat==1){
//              
//            
//        }else{
//          
//        }
        
        $data['cat']=$cat;
        
        
       // print_r($data['receitas']);die();
        $data['mensageFaixa'] = "Abaixo esta a listagem receitadas por você<br> Use o filtro para buscar outras receitas";
       $tela = array('cabecalho' => 'telas/cabecalho_logado.php',
            'topo' => 'telas/vazio.php', //mostrar o topo somente quando n�o for a tela de login
            'faixa_horizontal' => 'telas/faixa_horizontal.php',
            'conteudo' => 'telas/lista/receita.php');
        $this->parser->adc_css($this->css);
        $this->parser->adc_js($this->js);
        
        
        $this->parser->mostrar('templates/template_corpo.php', $tela, $data);
       
    }
    public function telaCadastro() {
        $this->verificador->verificaCategoria(1); //somente medicos
         $data = array_change_key_case (  $this->medico->getMedico($this->usuario));
         $data['empresa']=$this->medico->getEmpresaByMedico($data['codigo']);
         if(is_null($data['empresa'])){
              $this->session->set_flashdata('msg', 'Sua agenda nao permite acesso a esta area neste momento!<br>');
             redirect('medico/configuracao');
//             echo "sua agenda nao permite acesso a esta area neste momento";
//             die();
         }

         $data['pasta']='medico/';
         $data['ref']="medico/";
         
         
         $data['medicamentos']=  $this->medicamentos->getMedicamento(); 
         
        
        $tela=array(
            'cabecalho'=>'telas/cabecalho_logado.php', 
            'topo'=>'telas/vazio.php', //mostrar o topo somente quando n�o for a tela de login
            'faixa_horizontal'=>'telas/vazio.php',
           // 'cadastroPaciente'=>'telas/cadastro/cadastroPaciente.php',
            //'modalPesquisaPaciente'=>'telas/pesquisaPaciente',
            'conteudo'=>'telas/cadastro/cadastroReceita.php',
        );       
 
        $this->parser->adc_css($this->css);
        $this->parser->adc_js($this->js);
        $this->parser->mostrar('templates/template_corpo.php',$tela,$data);
    }
    
    public function cadastro() { 
        
        $dados['COD_MEDICO']=$this->input->post('codMedico');
        $dados['COD_PACIENTE']=$this->input->post('codPaciente');
        
        $dados['COD_EMPRESA']=$this->input->post('codEmpresa');
        $dados['COD_HASH']=$this->input->post('codHash');
        $dados['STATUS'] = $this->input->post('permissao')=='on'? '1':'0';           
        
       /* $codReceita*/ $codigos=  $this->medicamentos->novaReceita($dados);
        
        $medicamentos=$this->input->post('medicamento'); 
//        print_r($medicamentos);
//        die();
        $forma=$this->input->post('forma');
        $prescricao=$this->input->post('prescricao');
        foreach ($medicamentos as $key => $medicamento) {
            $dadosLista['COD_RECEITA']=$codigos['codReceita'];
            $dadosLista['COD_REMEDIO']= $medicamento;            
            $dadosLista['COD_FORMA']= $forma[$key];
            $dadosLista['PRESCRICAO']= $prescricao[$key];
              $codMedicamento=  $this->medicamentos->novaMedicamentoLista($dadosLista);  
        }
        
        $this->session->set_flashdata('mensagem', "<div class='alert alert-success'>Receita cadastrada com successo.<br> Entre em buscar receitas para encontrar todas as receitas separadas por filtro</div>");
        $this->buscaReceita($codigos['COD_HASH']);
            //redirect('medico');

    }
    public function buscaFormaFarma($codMedicamento) {
        $forma=  $this->medicamentos->buscaForma($codMedicamento);
        $option="";
        
        foreach ($forma as $value) {
            $option.="<option value='$value[CODIGO]'>$value[FORMA]</option>";
        }
                
        echo $option;
    }
  
    public function buscaReceita($codReceitaHash,$print=true,$local=2) { //funcão para buscar e imprimir receita
        $dados['receita'] =array_change_key_case($this->medicamentos->getReceitaByCod($codReceitaHash,$local));
        $codReceita = $dados['receita']['codigo'];        
        $listaMedicamentos=$this->medicamentos->getListaReceitaByCod($codReceita);
        if($listaMedicamentos){
            $dados['listagem']=array_change_key_case($listaMedicamentos);
        }else{
           $dados['listagem']=NULL; 
        }
        
        $arquivo="lista/receituario";
        
        if($print ==true){
            $arquivo="print/receituario";
            switch ($local) {
                case 1:
                $dados['local']='medico/buscarReceita/1';
                break;
                case 2:
                $dados['local']='medico';
                break;
                
            case 3:
                $dados['local']='atendentef/buscarReceita/3';
                break;
            case 4:
                $dados['local']='paciente/buscarReceita/4';
                break;
                default:
                    break;
            }
            
        }
            $this->load->view("telas/$arquivo",$dados);
        
    }
    public function getReceitaByCpf($cpf,$cat){// funcao para buscar receitar por cpf
      if ($cat==1){
          $cod_medico=$this->session->userdata('codigoMedico');
      }else{
          $cod_medico=NULL;
      }
       $receitas=$this->medicamentos->getReceitasByPaciente($cpf,$cat,$cod_medico);
        if($receitas){
        
        $retorno="";
        foreach ($receitas as $receita) {
            $receita =array_change_key_case($receita);
            $retorno.="<tr>";
            $retorno.="<td style='text-align:center'>$receita[cod_hash]</td>";
            $retorno.="<td>$receita[paciente]</td>";
            $retorno.="<td>$receita[data]</td>";
            $retorno.="<td><button class='btn btn-success btn-md visualizarReceita' data-title='Visualizar Receita' data-toggle='modal' data-codigo='$receita[cod_hash]' data-target='#visualizar' data-placement='top' rel='tooltip'><span class='glyphicon glyphicon-search'></span></button></td>";
            $retorno.="</tr>"; 
        }
        
        }else{
            $retorno="";
        }
        
        echo $retorno;
    }
    public function getReceitaByNumero($numero,$cat) {
        if ($cat==1){
          $cod_medico=$this->session->userdata('codigoMedico');
      }else{
          $cod_medico=NULL;
      }
        $receita=$this->medicamentos->getReceitaByCod($numero,$cat,$cod_medico);
        if($receita){
            $receita =array_change_key_case($receita);
            $retorno="<tr>";
        $retorno.="<td style='text-align:center'>$receita[cod_hash]</td>";
        $retorno.="<td>$receita[paciente]</td>";
        $retorno.="<td>$receita[data]</td>";
        $retorno.="<td><button class='btn btn-success btn-md visualizarReceita' data-title='Visualizar Receita' data-toggle='modal' data-codigo='$receita[cod_hash]' data-target='#visualizar' data-placement='top' rel='tooltip'><span class='glyphicon glyphicon-search'></span></button></td>";
        $retorno.="</tr>";
        }else{
            $retorno="";
        }
        
        echo $retorno;
    }
    public function buscaPermissao($cod_hash) {
        $dados=array_change_key_case($this->medicamentos->getPermissao($cod_hash)) ;
        
        $dados['cod_hash']=$cod_hash;
//        $dados['status']=1;
//        $dados['status_medico']=0;
         echo $this->load->view("telas/update/updatePermissao",$dados);
       
    }
    public function AlterarPermissao() {
        $cod_hash=$this->input->post('cod_hash');
        $dados['status']=$this->input->post('status');
        $dados['status']=$dados['status']==1? $dados['status']:'0';
        $dados['status_medico']=$this->input->post('status_medico');
        $this->medicamentos->updateReceita($cod_hash,$dados);
        echo "Permissões de visualização alteradas com sucesso.";
        //redirect("paciente/buscarReceita/4");
    }
    public function aprovacao() {
        $cod_hash=$this->input->post('cod_hash');
       $obs = $this->input->post('obs');
       $dados['OBS']=$obs;
        $status=$this->input->post('status');
        if ($status==1){
             $dados['APROVACAO_PACIENTE']=1;
            echo "Receita Aprovado";    
        }else{
            $dados['APROVACAO_PACIENTE']=0;
            echo "Não Aprovado";
        }
         $this->medicamentos->updateReceita($cod_hash,$dados);
        
    }

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */