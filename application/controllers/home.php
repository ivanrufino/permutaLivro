<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
    public $css=null;
    public $js=null;
    public function __construct() {  
        parent::__construct();
//         $this->css=array('bootstrap','bootstrap-social','menu','small-business','painel_user','tabs','hover','star-rating.min','../lighter/css/lighter');    
//        $this->js = array('jquery-1.10.2', 'bootstrap.min', 'funcoesComuns', 'jquery.maskedinput.min','jquery.dataTables.min','jquery.form.min','scripts' ,'star-rating.min');
          $this->css=array('comuns','bootstrap','bootstrap-social','menu','small-business','painel_user','tabs','hover','../lighter/css/lighter','star-rating');   
        $this->js = array('jquery-1.10.2', 'bootstrap', 'funcoesComuns', 'jquery.maskedinput.min','jquery.dataTables.min','jquery.form.min','bootstrap-filestyle.min','star-rating');
        
                //$this->load->helper();
                $this->load->model('home_model','home');
                //$this->load->dbforge();
              
        }
     public function index(){ 
         $data['modal']= $this->session->flashdata('modal')==1? $this->session->flashdata('modal'):'0';
         $data['btn_rede']=  $this->createButtonLogin();
         
        // var_dump($data); die();
        if ($this->session->userdata('logged_in')){
            //redirect('minhaestante');
        }
       // $data=$this->loginFace();
//        $data['login_url'] = $this->facebook->getLoginUrl(array(
//                'redirect_uri' =>site_url('login/loginface'),//  'http://www.clubdolivro.com.br/teste/home',
//                'scope' => array("email,public_profile,user_friends") // permissions here
//            ));
       // $data=array();
        $tela=array('cabecalho'=>'telas/cabecalho.php',
            'vazio'=>'telas/vazio.php',
            'login_all'=>'telas/loginAll.php',
            'tela_erros'=>'telas/vazio.php',
            'esqueciSenha'=>'telas/esqueciSenha.php',
            'login_modal'=>'telas/login_modal.php',);
 
        $this->parser->adc_css($this->css);
        $this->parser->adc_js($this->js);
        
        $this->parser->mostrar('templates/template_home.php',$tela,$data);
    }
//    public function login()  {
//        $data[]="";
//        $data['mensageFaixa']="Entre com seus dados para entrar no sistema, lembre-se de selecionar a categoria correta";
//            //$this->load->view('welcome_message');
//             //  Os scripts e css podem ser adicionados tanto em um único comando ou em vários, bastando passar a info por array ou não
//         $tela=array(
//             'cabecalho'=>'telas/cabecalho_menu.php', 
//            'topo'=>'telas/vazio.php', //mostrar o topo somente quando n�o for a tela de login
//            'faixa_horizontal'=>'telas/faixa_horizontal.php',
//             'conteudo'=>'telas/login.php',
//        );
//        
// 
//        $this->parser->adc_css($this->css);
//        $this->parser->adc_js($this->js);
//        $this->parser->mostrar('templates/template_corpo.php',$tela,$data);
//    }
//    public function teste(){
//        $med =  $this->home->query();
//        foreach ($med as $value) {
//            $medicamento=$value['MEDICAMENTO'];
//            $det=$this->home->concentracao($medicamento);
//            echo $value['CODIGO']."<hr>";
//            $detArray="";
//            foreach ($det as $detentor) {
//                //$detArray=  explode(";", $detentor['CONCENTRACAO']);
//                $detArray .= $detentor['CONCENTRACAO'].";";
//                
//              //  $this->home->insertMedForma($value['CODIGO'],$detentor['FORMA_FARMACEUTICA']);
//                
//            }
//            $detArray=  explode(";", $detArray);
//            $detArray=  $this->unico($detArray);
//            foreach ($detArray as $conc) {
//                $this->home->insertMedconcetracao($value['CODIGO'],$conc);
//            }
//            print_r($detArray);
//                echo "<br>";
//          //  echo $medicamento;
//            echo '<br>';
//        }
//    }
    public function unico($array){
         return array_unique($array);
    }

//    public function loginFace() {
//        $user = $this->facebook->getUser();
//       
//        if ($user) {
//            try {
//                $data['user_profile'] = $this->facebook->api('/me');
//               
//            } catch (FacebookApiException $e) {
//                $user = null;
//            }
//        } else {
//            $this->facebook->destroySession();
//             $this->session->sess_destroy();
//           // redirect();
//        }
//
//        if ($user) {
//            $email=$data['user_profile']['email'];
//            $senha=  'facebook';
//            $nome= $data['user_profile']['first_name']." ".$data['user_profile']['last_name'];
//            
//           
//            $this->session->set_flashdata('nome_facebook', $nome);
//            $this->session->set_flashdata('email_facebook', $email);
//            $this->session->set_flashdata('senha_facebook', $senha);
//            $this->session->set_flashdata('id_facebook', $data['user_profile']['id']);
//            $this->session->set_flashdata('link_facebook', $data['user_profile']['link']);
//            
//            redirect("login/efetuarLogin");
//            $data['logout_url'] = site_url('login/efetuarLogout'); // Logs off application
//            // OR 
//            // Logs off FB!
//            // $data['logout_url'] = $this->facebook->getLogoutUrl();
//        } else {
//            $data['login_url'] = $this->facebook->getLoginUrl(array(
//                'redirect_uri' =>site_url('home'),//  'http://www.clubdolivro.com.br/teste/home',
//                'scope' => array("email,public_profile,user_friends") // permissions here
//            ));
//        }
//        $data['login_face']='logar';
//        return $data;
//    }

     public function session($provider) {
        $provider = $this->oauth2->provider($provider, $this->getProviderArray($provider));

        if (!$this->input->get('code')) {
           
            // By sending no options it'll come back here
            $url = $provider->authorize();
            echo "<a href='$url'>Acessar</a>";
        } else {
            // Howzit?
            try {
                $code = $this->input->get('code'); //"AQA56WaiBhIG7fe7btHL9eCCw3-3Y74fldbgN0PtXRMqMCgYDSdjaerXpCgrrXPOQrojKTeM0yG7jM-gJez2tcbO-y4KalCnI6VfwObw-x5sH090twvoKLX7-nS_I2rMtSOIdlYxmLe6nPSJID3CsZvY3oRjN9t-ajlpcVFaVL5odDVFHMy08_3uHnGaJM7j0RR2D1P5zrXifUeceNWQmKBvxJ2_vrKDdJksD0ijQWJdGGWh8GTSz__h3OcNba4mGOJrgkoNGViVk7qq3QZMbU6iLbliMnrnvIEZufAOfPxUjw-LVt-MvBiDtQiH4ejIPjGhkOuu1tF3kVepiSQU_FKn&state=f7f6277dc5d99aa13b688e1c60e50d2f#_=_";
                $token = $provider->access($code);

                $user = $provider->get_user_info($token);

                // Here you should use this information to A) look for a user B) help a new user sign up with existing data.
                // If you store it all in a cookie and redirect to a registration page this is crazy-simple.
                echo "<pre>Tokens: ";
                var_dump($token);

                echo "\n\nUser Info: ";
                var_dump($user);
                echo "<img src='" . $user['image'] . "'>";
            } catch (OAuth2_Exception $e) {
                $this->passo('4');
                show_error('That didnt work: ' . $e);
            }
        }
    }
    
    public function getProviderArray($rede,$all=false) {
        $dados['Facebook'] = array('id' => '755823537846565', 'secret' => 'bb2ba923ee25e0ce2740803721a14e5f');
        $dados['Google'] = array('id' => '1099466398618-v9otoh2rtol7rpbaddtpfsivfsisvuj5.apps.googleusercontent.com', 'secret' => 'FP3aCzgfsNOp_YgJfP0bcLv4');
        $dados['Instagram']=array('id' => 'b96dc8b4b4eb4964bb522ca88246a1d7','secret' => '4b522ebaad9d47d28d1cdca83185d890');
        $dados['Windowslive'] = array('id' => '0000000048145D2E', 'secret' => 'tNg6gGXoeTNIkGc3JeUWhFhRppuCKVoB');
        $dados['Linkedin'] = array('id' => '78nipe5g2bgn5u', 'secret' => 'NN6BqkpINlUHNnav');
        $dados['Github'] = array('id' => 'ac3e705eb1a6fc9f017e', 'secret' => 'f23063916c478fa6f97374ac445204af993b880e','scope'=>array('user'));
        if ($all){
            return $dados;
        }
        return $dados[ucfirst($rede)];
    }
    public function createButtonLogin() {
        $redes=  $this->getProviderArray(NULL, TRUE);
        $data=array();
        foreach ($redes as $rede => $options) {
            //echo $rede;
            $opt['redirect_uri']= base_url()."login/provider/".$rede.".html";
//            if ($rede=="Facebook"){
//                $opt['redirect_uri'].=".html";
//            }
            $provider = $this->oauth2->provider($rede, $this->getProviderArray($rede));
             $data[$rede]['link']=$url = $provider->authorize($opt);
        }
//        foreach ($data as $key => $value) {
//            echo "<a href=".$value['link'].">".$key."</a><br>";
//           
//        }
       return $data;
        
    }
    

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */