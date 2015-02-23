<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Aula extends CI_Controller {
    public $css=null;
    public $js=null;
    public function __construct() {
        parent::__construct();
        $this->css = array('bootstrap', 'menu', 'small-business', 'painel_user', 'tabs','hover','../lighter/css/lighter');
        $this->js = array('jquery-1.10.2', 'bootstrap', 'funcoesComuns', 'jquery.maskedinput.min','jquery.dataTables.min','jquery.form.min' );
                //$this->load->helper();
                $this->load->model('home_model','home');
                //$this->load->dbforge();
        }
     public function index(){ 
         
        $data['mensageFaixa'] = "Selecione uma aula";
        $data['mensagem_erro'] = "";
        $data['categoria']=array(
            array("codigo"=>'1', 'imagem'=>'http://upload.wikimedia.org/wikipedia/commons/thumb/6/61/HTML5_logo_and_wordmark.svg/200px-HTML5_logo_and_wordmark.svg.png','titulo'=> 'HTML' ),
            array("codigo"=>'2', 'imagem'=>'http://ohdoylerules.com/content/images/css3.svg' ,'titulo'=> 'CSS' ),
            array("codigo"=>'3', 'imagem'=>'http://www.blogdopecmaia.com.br/wp-content/uploads/2014/05/jquery_white_contur.png' ,'titulo'=> 'Jquery' ),
            array("codigo"=>'4', 'imagem'=>'http://www.paulsodimu.co.uk/bootstrap3.png' ,'titulo'=> 'Bootstrap' ),
            array("codigo"=>'5', 'imagem'=>'' ,'titulo'=> 'Logica de Programa��o' ),
            array("codigo"=>'6', 'imagem'=>'http://www.lojamaxtech.com.br/maxhost/imagens/principal/php.png' ,'titulo'=> 'PHP' ),
            
        );
       $tela = array(
            'cabecalho' => 'telas/aula/cabecalho.php',
            'topo' => 'telas/vazio.php', //mostrar o topo somente quando n�o for a tela de login
            'faixa_horizontal' => 'telas/faixa_horizontal.php',
            'conteudo' => 'telas/aula/index.php',
        );


        $this->parser->adc_css($this->css);
        $this->parser->adc_js($this->js);
        $this->parser->mostrar('templates/template_corpo.php', $tela, $data);
    }
   public function login(){ 
        $data['mensageFaixa'] = "Entre com seus dados";
        $data['mensagem_erro'] = "";
        $data['lnklogin']=  base_url()."login";
        $data['labelLogin']="Acesso Usuário";
        $tela = array(
            'cabecalho' => 'telas/aula/cabecalho.php',
            'topo' => 'telas/vazio.php', //mostrar o topo somente quando n�o for a tela de login
            'faixa_horizontal' => 'telas/faixa_horizontal.php',
            'conteudo' => 'telas/login_admin.php',
        );


        $this->parser->adc_css($this->css);
        $this->parser->adc_js($this->js);
        $this->parser->mostrar('templates/template_corpo.php', $tela, $data);
    }
    public function xls($xls=null) {      
        $this->load->library('my_excel');
        $data = new Spreadsheet_Excel_Reader();
        $data->setOutputEncoding('CP1251');
       
        
        //$this->spreadsheet_excel_reader->setOutputEncoding('CP1251'); // Set output Encoding.
        $data->read('jxlrwtest.xls'); // relative path to .xls that was uploaded earlier
        
        $rows = $data->spreadsheet_excel_reader->sheets[0]['cells'];
        $row_count = count($data->spreadsheet_excel_reader->sheets[0]['cells']);
        echo 'my row count is'.$row_count;
    
        for ($i = 2; $i <= $row_count; $i++) {
            var_dump($rows[$i]);
            echo "<br><br><hr>";
        }

    
    }
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */