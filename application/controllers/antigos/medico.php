<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Medico extends CI_Controller {
    /*medico=1; atendente= 2;atendenteF= 3;paciente= 4;*/
    public $css=null;
    public $js=null;
    private $cat=1;
    public $usuario;
    public $user_admin;
    public $cod_empresa;
    public $errosAgenda=0;
    public function __construct() {
        parent::__construct();
        $this->css=array('bootstrap','menu','small-business','painel_user','tabs','hover','../lighter/css/lighter');    
        $this->js = array('jquery-1.10.2', 'bootstrap', 'funcoesComuns', 'jquery.maskedinput.min','jquery.dataTables.min','jquery.form.min','bootstrap-filestyle.min');
                //$this->load->helper();
        $this->load->model('usuario_model', 'usuarios');
        $this->load->model('empresa_model', 'empresa');
        $this->load->model('medico_model', 'medico');
        $this->load->model('config_model', 'configGeral');
        $this->load->model('atendente_model', 'atendente');
        $this->load->model('farmaceutico_model', 'farmaceutico');
        $this->usuario=$this->session->userdata('cod_usuario');
        $this->user_admin=$this->session->userdata('cod_admin');
        $this->cod_empresa= $this->session->userdata('cod_empresa');

    }
   
    public function index()  {
        $this->verificador->verificaCategoria($this->cat);
        $data=  $this->getDadosMedico();
        
        if ($data['cod_empresa']==NULL){
            echo "Você precisa estar vinculadoa à uma empresa para ter acesso a esta área";
            die();
        }
        $data['ref']="medico/";
        $data['mensageFaixa']=$this->session->flashdata('mensagem');
        
        $tela=array(
            'cabecalho'=>'telas/cabecalho_logado.php', 
            'topo'=>'telas/vazio.php', //mostrar o topo somente quando n�o for a tela de login
            'faixa_horizontal'=>'telas/faixa_horizontal.php',
           // 'cadastroPaciente'=>'telas/cadastro/cadastroPaciente.php',
            'modalPesquisaPaciente'=>'telas/pesquisaPaciente',
            'conteudo'=>'telas/index_medico.php',
        );       
 
        $this->parser->adc_css($this->css);
        $this->parser->adc_js($this->js);
        $this->parser->mostrar('templates/template_corpo.php',$tela,$data);
    }
    public function getDadosMedico(){
         $data =array_change_key_case ($this->medico->getMedico($this->usuario));  //       print_r($data);die();
         $data['pasta']='medico/';
         $data['ref']="medico/";
        return $data;
    }
    public function buscaAgenda($codMedico) {
        $dados['codigo']=$codMedico;
       // $dados['medico'] =array_change_key_case ($this->medico->getMedico($codMedico));
        $dados['agenda']=$this->medico->getAgendaByMedico($codMedico);
       $dados['is_medico']=FALSE;
       //var_dump($dados);die(0);
        echo $this->load->view('telas/lista/agendaMedicoAjax',$dados);
    }
    public function AgendaMedico($cat) {
        
        $this->verificador->verificaCategoria($cat);
        switch ($cat) {
            case 2: // atendente 
                $data =array_change_key_case ( $this->atendente->getAtendente($this->usuario));
                $data['pasta']='atendente/';
                $data['ref']="atendente/";
                break;
            case 1: // atendente de farmacia
                $data=  $this->getDadosMedico();
                 $data['ref']="medico/";
                break;
            case 5: //acesso do admin
                 $data['ref']="admin/";
                break;
            default:
                echo "Voce Não tem permissão para acessar esta area"; //redirecionar para config mostrando a mensagem
                die();
                break;
        }
        $data['medicos']=$this->medico->getMedicoByEmpresa($data['codigo_empresa']);
        if(!is_null($data['medicos'])){
            foreach ($data['medicos'] as $key => $medico) {       
                $data['medicos'][$key]['ESPECIALIDADE']=  $this->getEspecialidade($medico['CODIGO']);          
            }
        }
       
        $tela = array('cabecalho' => 'telas/cabecalho_logado.php',
            'topo' => 'telas/vazio.php', //mostrar o topo somente quando n�o for a tela de login
            'faixa_horizontal' => 'telas/vazio.php',
            'conteudo' => 'telas/lista/medicoAgenda.php');
        $this->parser->adc_css($this->css);
        $this->parser->adc_css('sumoselect');
        $this->parser->adc_js($this->js);
        $this->parser->adc_js('jquery.sumoselect.min');
        
        $this->parser->mostrar('templates/template_corpo.php', $tela, $data);
    }
    public function lista(){
       $this->verificador->verificarAdminLogado();
       
        $data=   array_change_key_case (  $this->empresa->getAdministrador($this->user_admin) );
       $data['pasta']='administrador/';
       
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
        $this->parser->adc_css('sumoselect');
        $this->parser->adc_js($this->js);
        $this->parser->adc_js('jquery.sumoselect.min');
        
        $this->parser->mostrar('templates/template_corpo.php', $tela, $data);
    }
    public function buscarMedico($crm_num,$uf){
       $crm= $uf."-".$crm_num;
       $dados['medico']=  $this->medico->getMedicoByCrm($crm);
       
       if(is_null($dados['medico'])){
           $this->getMedicoOut($crm_num,$uf);
       }/*else{
           $dadosMedico=array(
               'COD_MEDICO'=>$dados['medico']['CODIGO'],
               'COD_EMPRESA'=>$this->cod_empresa
           );
           $this->medico->vincularMedico($dadosMedico);
       }*/
       $dados['especialidadesMedico']=$this->medico->getEspecialidadeMedico($dados['medico']['CODIGO']);
              
       //print_r($dados);die();
       $dadosMedicoEmpresa = $this->medico->getMedicoEmpresa($this->cod_empresa,$dados['medico']['CODIGO']);
       $dadosAgenda=array();
       if (!is_null($dadosMedicoEmpresa)){
            $agendas = $this->medico->getAgendaByMedicoEmpresa($dadosMedicoEmpresa['CODIGO']);
            $dadosAgenda = $this->createArrayAgenda($agendas);
       }
       
       $dados=  array_merge($dados,$dadosAgenda);

            $dados['especialidades']=$this->medico->getEspecialidades(); 
           echo $this->load->view('telas/cadastro/vinculoMedico',$dados);
          
       
      
    }
    public function createArrayAgenda($agendas){
        $dados=array();
        if(!is_null($agendas)){
        foreach ($agendas as $agenda) {
            $de = "de_". substr($agenda['DIA'], 0, 3);//.$agenda['HORA_ENTRADA'];
            $ate = "ate_". substr($agenda['DIA'], 0, 3);//.$agenda['HORA_SAIDA'];
            $dados[$de]=$agenda['HORA_ENTRADA'];
            $dados[$ate]=$agenda['HORA_SAIDA'];
        }}
        return $dados;
    }
    public function getMedicoOut($crm_num,$uf){
        $uf=strtoupper($uf);
        $url="http://portal.cfm.org.br/index.php?medicosNome=&medicosCRM=$crm_num&medicosUF=$uf&medicosSituacao=A&medicosTipoInscricao=&medicosEspecialidade=&buscaEfetuada=true&option=com_medicos#buscaMedicos";
        $retorno=  file_get_contents($url);
        preg_match_all( '/<td class="valorNome"><span>([^<]++)/', $retorno, $nomeMedicos);
        preg_match_all( '/<td class="valorCRM"><span>([^<]++)/', $retorno, $valorCRM);
        preg_match_all( '/<td class="valorUF"><span>([^<]++)/', $retorno, $valorUF);
       /* preg_match_all( '/<td class="valorSituacao"><span>([^<]++)/', $dados, $situacao);
        
        preg_match_all( '/<tr class="extraRow"><td><span>([^<]++) /', $dados, $extra);*/
       
        //preg_match_all('/<table>(.+)<\/table>/', $dados, $conteudo);
        if(!empty($nomeMedicos[0])) {
            foreach ($nomeMedicos[0] as $cod => $medico) {
                if($cod!=0){
                    $medico= str_replace('<td class="valorNome"><span>', "", $medico);
                    $UF=str_replace('<td class="valoruf"><span>', "", strtolower($valorUF[0][$cod]) );//."-".$valorCRM[0][$cod]); ;
                    $CRM=str_replace('<td class="valorCRM"><span>', "", $valorCRM[0][$cod]); 
                    
                    $dados['NOME'] = $medico; 
                    $dados['LOGIN']= $UF."-".$CRM;
                    $dados['SENHA'] = md5($CRM)  ; //SENHA É A PARTE NUMERICA DO CRM, DEVE SER ALTERADA NA PRIMEIRA ENTRADA DE LOGIN
                    $dados['CATEGORIA']=1;
                    $this->medico->novoMedico($dados);
                  // $this->printArray($dados);
                  redirect("medico/buscarMedico/$CRM/$UF");
                }
            }
            
        }else{
            $dados=array(
              'CRM'  =>$crm_num,
              'estado'=>$uf
            );
            echo $this->load->view('telas/erros/medicoInexistente',$dados,true);
            die();
        }
       
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
            $ret=substr($ret, 0, -2).".";
        }
        return $ret;
    }
    public function cadastro(){
       $semanaDe=array(
            'domingo'=>$this->input->post('de_dom'),
            'segunda'=>$this->input->post('de_seg'),
            'terca'=>$this->input->post('de_ter'),
            'quarta'=>$this->input->post('de_qua'),
            'quinta'=>$this->input->post('de_qui'),
            'sexta'=>$this->input->post('de_sex'),
            'sabado'=>$this->input->post('de_sab'),
        );
        $semanaAte=array(
            'domingo'=>$this->input->post('ate_dom'),
            'segunda'=>$this->input->post('ate_seg'),
            'terca'=>$this->input->post('ate_ter'),
            'quarta'=>$this->input->post('ate_qua'),
            'quinta'=>$this->input->post('ate_qui'),
            'sexta'=>$this->input->post('ate_sex'),
            'sabado'=>$this->input->post('ate_sab'),
        );
        $especialidade=$this->input->post('especialidade');
        $codMedico = $this->input->post("codigo");
        $this->_updateEmailMedico($this->input->post('email'),$codMedico);
        
        if($especialidade==""){
            echo "<strong>Selecione no minimo 1(uma) especialidade.</strong>";
            die();    
        }
        
            
        
        
       // print_r($especialidade);
        $this->_gravarEspecialidade($especialidade,$codMedico);
        
        $this->validarAgenda($semanaDe,$semanaAte);
       // print_r($this->input->post());
    }
    public function _updateEmailMedico($email,$codMedico){
        if ($email==""){
            echo "Por favor, preencha o email do médico";
            die();
        }else{
            $dadosMedico = $this->medico->getMedicobyCodigo($codMedico,FALSE);
            
            $id = $dadosMedico['CODIGO'];
            $dados['EMAIL'] = $email;
            $ret = $this->medico->updatePessoa($dados,$id);
//            echo $email;
//            die();
        }
       
    }
    public function _gravarEspecialidade($especialidades,$codMedico){
        foreach ($especialidades as $especialidade) {
            $this->medico->novaEspecialidadeMedico($codMedico,$especialidade);
          //  echo $especialidade."-<br>-".$codMedico."<br>";
            
        }
    }
    public function validarAgenda($semanaDe,$semanaAte){
        $msg="";
        if ($this->errosAgenda==0){
            $msg.="A gravação dos dados informados foram efetuadas com succeso.<br><strong>Obs:</strong><br>";
        }
         $msg.=$this->_validarHorario($semanaDe,$semanaAte);
         echo $msg;
        
    }
    public function _validarHorario($semanaDe,$semanaAte){
        $msg="";
        $erros=0;
        foreach ($semanaDe as $key => $hora) {
            if ($hora!="" && $semanaAte[$key]!="") {
                $msg.= $this->_validarHoraInicioFim($hora, $semanaAte[$key],$key);
                
            }else{
                $msg.="<strong>".  ucfirst($key). ":</strong> Campo horario vazio!<br>";
              
            }

        }
        return $msg;
    }
    public function _validarHoraInicioFim($horaInicio, $horaFim,$diaSemana){
        $msg="";
        if ($horaInicio>=$horaFim){
            $msg.= "<strong>".ucfirst($diaSemana).":</strong> Hora de Inicio maior ou igual que hora final.<br>";
        }else{
            $msg.= $this->_verificarPermissaoAgenda($horaInicio, $horaFim,$diaSemana);
        }
        return $msg;
    }
    public function _verificarPermissaoAgenda($horaInicio, $horaFim,$diaSemana){
        $msg="";
        $codMedico=$this->input->post("codigo");
        
        $ret=$this->medico->getAgendaDisponivel($codMedico, $this->cod_empresa,$diaSemana,$horaInicio,$horaFim);
        if ($ret){
            $dadosMedico=array(
               'COD_MEDICO'=>$codMedico,
               'COD_EMPRESA'=>$this->cod_empresa
           );
          $codMedicoEmpresa =  $this->medico->vincularMedico($dadosMedico);
           $this->_opcaoAgenda($codMedicoEmpresa,$codMedico,$horaInicio,$horaFim,$diaSemana); 
        }else{
             $msg.= "<strong>".ucfirst($diaSemana).":</strong> Conflito de Horario, por favor conferir agenda do Médico.<br>";
        } 
        return $msg;
    }
    public function _opcaoAgenda($codMedicoEmpresa,$codMedico,$horaInicio,$horaFim,$diaSemana){
        $dados['COD_MEDICO_EMPRESA'] = $codMedicoEmpresa;
        $dados['DIA']=$diaSemana;
        $dados['HORA_ENTRADA']=$horaInicio;
        $dados['HORA_SAIDA']=$horaFim;
        $dataAgenda=$this->medico->getAgendaByMedicoEmpresa($codMedicoEmpresa,$diaSemana);
         if (is_null($dataAgenda)){
             return $this->_gravarAgenda($dados);
         }else{
             $codigoAgenda=$dataAgenda['0']['CODIGO'];
             return $this->_alterarAgenda($codigoAgenda,$dados);
         }
        
    }
    public function _gravarAgenda($dados){
        $msg="";
       if (is_null( $this->medico->gravarAgenda($dados))){
           $msg.="Falha ao gravar agenda do dia ".$dados['DIA'];
           $this->errosAgenda=$this->errosAgenda+1;
                   
       }
       return $msg;
        // 0 é igual sem erro e 1 igual a erros
    }
    public function _alterarAgenda($codigoAgenda,$dados){
        $msg="";
         if (is_null( $this->medico->alterarAgenda($codigoAgenda,$dados))){
         $msg.="Falha ao gravar agenda do dia ".$dados['DIA'];
         $this->errosAgenda=$this->errosAgenda+1;
       }
       return $msg;
        // 0 é igual sem erro e 1 igual a erros
    }
    public function desvincular() {
        $codEmpresa= $this->cod_empresa."<br>";
        $codMedico= $this->input->post('codigo');
       if($this->medico->desvincularMedico($codEmpresa,$codMedico)){
           die('apagado');
       }
          die('erro ao apagar')     ;
        
    }
    public function uploadImagem($id, $nomeFoto) {
        $novoNomeFoto = "imagem_" . $id . ".jpg";
        
        $local = 'assets/fotos/medico/';
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
            echo $this->upload->display_errors('<div class="alert alert-danger">', '</div>');
        } else {
            if ($nomeFoto == "medico.png") {
                $dados['FOTO'] = $novoNomeFoto;
                $this->medico->updateMedico($dados,$id);
            }
            $data = $this->upload->data();
            // echo "<img src='".$data['full_path']."'>";
            $ret = "<div class='alert alert-success'>";
            $ret.= "<img src='" . $local . $data['orig_name'] . "'>";
            $ret.="<br><span>Arquivo Gravado com Sucesso</span>";
            $ret.="<div>";
            echo $ret;
            // print_r($data);
            
        }
       // die();
    }
    public function configuracao($page='home')  {
        $this->verificador->verificaCategoria($this->cat);
        $dados=  $this->getDadosMedico();
        
        //print_r($data); die();
        
        $dados['page']=$page;
        
        $dados['agenda']=$this->medico->getAgendaByMedico($dados['codigo']);
        $dados['is_medico']=TRUE;
        $tela=array(
            'cabecalho'=>'telas/cabecalho_logado.php', 
            'topo'=>'telas/vazio.php', //mostrar o topo somente quando n�o for a tela de login
            'faixa_horizontal'=>'telas/vazio.php',
            'dadosUpdate' =>'telas/update/updateAtendente',
            'updateSenha' =>'telas/update/updateSenha',
            'agenda' =>'telas/lista/agendaMedicoAjax',
            'conteudo'=>'telas/conteudo_usuario.php',
        );
        
        $this->parser->adc_css($this->css);
        $this->parser->adc_css("../font-awesome/css/font-awesome.min");
        $this->parser->adc_js($this->js);
        $this->parser->mostrar('templates/template_corpo.php',$tela,$dados);
    }
    public function update() {
        $codigo =  $this->input->post('codigo'); 
        $nomeFoto= $this->input->post('nomeFoto'); 
        $msg = $this->uploadImagem($codigo,$nomeFoto);
       
        $dados['NOME'] = $this->input->post('nome'); 
        $dados['TELEFONE'] = $this->input->post('telefone'); 
        $dados['CELULAR'] = $this->input->post('celular'); 
        $dados['EMAIL'] = $this->input->post('email'); 
        
         $this->medico->updatePessoa($dados,$codigo);
        $this->session->set_flashdata('msg', 'Seus dados foram alterados com sucesso!');
       redirect('medico/configuracao');
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
            redirect('medico/configuracao');
           
        }
    }
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */

/* 
 
 * Criar cadastro de especialidade de medico
 * trazer as especialidades que foram gravadas previamente.
 * criar tela de checagem de agenda do medico
 * criar tela de alteração de agenda do medico, tanto para medico, como para empresa
 * trazer email do medico ou inserir se necessario na tela de vinculo do medico
 * alterar o rodape na receita
 * colocar opção para permitir visualização da farmacia
 * terminar tela de cadastro de paciente
 * terminar tela de busca de paciente
 * criar tela de paciente
 * tela de paciente mostrar as receitas cadastradas
 * acertar tela de cadastro de atendente
 * criar tela de atendente de farmacia
 * criar tela de visualização de receita selecionada para atendentes de farmacia
 
 
 * Terminar agenda de medico;
 
  
 
 
 
 */