<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Arquivo extends CI_Controller {

    public $css = null;
    public $js = null;
    public $usuario;
    public $cod_empresa;

    public function __construct() {
        parent::__construct();
        $this->css = array('cadastroempresa','bootstrap', 'menu', 'small-business', 'painel_user', 'tabs','hover','../lighter/css/lighter');
        $this->js = array('jquery-1.10.2', 'bootstrap', 'funcoesComuns', 'jquery.maskedinput.min','jquery.dataTables.min','jquery.form.min','bootstrap-filestyle.min' );
        //$this->load->helper();
        $this->load->model('empresa_model', 'empresa');
        $this->load->model('atendente_model', 'atendente');
        $this->load->model('farmaceutico_model', 'farmaceutico');
        $this->load->model('medico_model', 'medico');
        $this->load->model('config_model', 'configGeral');
        $this->load->model('medicamento_model', 'receita');

        $this->usuario = $this->session->userdata('cod_admin');
        $this->cod_empresa= $this->session->userdata('cod_empresa');
        
    }
    public function index() {
        /*
         * FTP, VAMOS VER O QUE DA PARA FAZER.
         */
        
        $this->lerFtp();
    }
    public function zip() {
        /*
         * PRIMEIRA INSTALAÇÃO
         * PEGAR AS PASTAS PRINCIPAIS DO SISTEMA TRANSFORMAR EM ZIP E OFERECER DOWNLOAD OU VIA FTP
         * ATUALIZAÇÃO VERIFICAR QUAL PASTA OU ARQUIVO FOI MODIFICADO E O SISTEMA OFERECER DOWNLOAD POR ZIP OU VIA FTP.
         */
        $this->load->library('zip');
//        $name = 'mydata1.txt';
//        $data = 'Um arquivo criado por mim!';
//
//        $this->zip->add_data($name, $data);
        
       // $path = '../public_html/';        
        $path = 'assets/';        
        $this->zip->read_dir($path);
        $path = 'application/';        
        $this->zip->read_dir($path);
        
        // Write the zip file to a folder on your server. Name it "my_backup.zip"
        $this->zip->archive('assets/arquivo/my_backup2.zip'); 

        // Download the file to your desktop. Name it "my_backup.zip"
       // $this->zip->download('my_backup.zip');
        echo 'arquivos';
    }
    
   
    

    public function lerFtp($pasta='public_html') {
        $this->load->library('ftp');
        $pasta= str_replace('-', '/', $pasta);
        
        //echo $pasta."<br>";
       // echo
        $config['hostname'] = 'ftp.tcc.bl.ee';
        $config['username'] = 'u762709049';
        $config['password'] = 'akuma2010';
        $config['debug']	= TRUE;

        $this->ftp->connect($config);

        $lists = $this->ftp->list_files("/$pasta/");
        foreach ($lists as $list) {
            switch ($list) {
                case '.':
                    echo "<a href='".base_url()."arquivo/'>Home</a><br>";
                    break;
                case '..':
                    echo "<a href='".base_url()."arquivo/'>Voltar</a><br>";
                    break;

                default:
                     $local= str_replace('/', '-', $pasta)."-".$list;
                echo "<a href='".base_url()."arquivo/lerFtp/$local'>$list</a>-----<a href='".  base_url()."arquivo/download/$local'>Download</a>";
                echo '<br>';
                    break;
            }
           // if(trim($list)=="." || trim($list)==".."){
              //  echo "<a href='".base_url()."arquivo/'>Voltar</a><br>"; 
            /*}else{
                $local= str_replace('/', '-', $pasta);
                echo "<a href='".base_url()."arquivo/lerFtp/$local-$list'>$list</a>";
                echo '<br>';
            }*/
        }
        //$this->printArray($list);
//      http://tcc.bl.ee/arquivo/lerFtp/arquivo/lerFtp/public_html-application-controllers
//      http://tcc.bl.ee/arquivo/lerFtp/public_html-application-controllers

        $this->ftp->close();
    }
    public function download($arquivo,$local="F:\\xampp\\htdocs\\teste\\") {
        $this->load->library('ftp');
        $arquivo= str_replace('-', '/', $arquivo);
        if (@is_dir($local)) {
            $local   = rtrim($local, '/');
          
       }else{
           echo $local."<br>";
           die('porra');
       }

        $this->ftp->download("$arquivo", "$local./admin.php", 'binary');
        echo "de $arquivo para $local";
    }
    public function printArray($array){
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }
    public function login_ajax($nome,$senha) {
        header('Access-Control-Allow-Origin: *');
        $nome=  trim(urldecode($nome));
        $senha=  md5(trim(urldecode($senha)));
        if ($nome!="ivan"){
            $dados=array('msg'=>'ok',
                'id'=>'1',
                'nome'=>$nome,
                'email'=>'irmao_de_jorel@gmail.com',
                'telefone'=>"465341564",
                'celular'=>'98796546');
                
        }else{
            $dados=array('msg'=>$nome); 
        }
        echo json_encode($dados);
    }
    public function receita_ajax($usuario){
         header('Access-Control-Allow-Origin: *');
         $dados=$this->receita->getReceitasByPacienteApp($usuario);
         $dadosRet=array('cod_msg'=>'0');
         $i=0;
         if($dados){
            foreach ($dados as $value) {
                $dadosRet[$i]['id']=$value['CODIGO'];
                $dadosRet[$i]['cod_hash']=$value['COD_HASH'];
                $dadosRet[$i]['medico']=$value['MEDICO'];
                $dadosRet[$i]['empresa']=$value['EMPRESA'];
                $dadosRet[$i]['data']=$value['DATA'];
                $dadosRet[$i]['lista']=$this->receita->getListaReceitaByCod($value['CODIGO']);
                $i++;
            }
        }else{
           $dadosRet=array('cod_msg'=>'1','msg'=>"Você não possui nenhuma receita");
           
        }
//         echo "<pre>";
//         print_r($dadosRet);
//          echo "</pre>";
         echo json_encode($dadosRet);
        
    }

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */