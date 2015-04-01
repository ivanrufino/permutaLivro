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
                $this->load->model('estanteVirtual_model', 'ev');
                $this->load->model('admin_model', 'admin');
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

//     public function session($provider) {
//       // $provider = $this->oauth2->provider($provider, $this->getProviderArray($provider));
//        $provider = $this->oauth2->provider($provider, array_change_key_case($this->admin->getProviderArray($provider)[0],CASE_LOWER));
//
//        if (!$this->input->get('code')) {
//           
//            // By sending no options it'll come back here
//            $url = $provider->authorize();
//            echo "<a href='$url'>Acessar</a>";
//        } else {
//            // Howzit?
//            try {
//                $code = $this->input->get('code'); //"AQA56WaiBhIG7fe7btHL9eCCw3-3Y74fldbgN0PtXRMqMCgYDSdjaerXpCgrrXPOQrojKTeM0yG7jM-gJez2tcbO-y4KalCnI6VfwObw-x5sH090twvoKLX7-nS_I2rMtSOIdlYxmLe6nPSJID3CsZvY3oRjN9t-ajlpcVFaVL5odDVFHMy08_3uHnGaJM7j0RR2D1P5zrXifUeceNWQmKBvxJ2_vrKDdJksD0ijQWJdGGWh8GTSz__h3OcNba4mGOJrgkoNGViVk7qq3QZMbU6iLbliMnrnvIEZufAOfPxUjw-LVt-MvBiDtQiH4ejIPjGhkOuu1tF3kVepiSQU_FKn&state=f7f6277dc5d99aa13b688e1c60e50d2f#_=_";
//                $token = $provider->access($code);
//
//                $user = $provider->get_user_info($token);
//
//                // Here you should use this information to A) look for a user B) help a new user sign up with existing data.
//                // If you store it all in a cookie and redirect to a registration page this is crazy-simple.
//                echo "<pre>Tokens: ";
//                var_dump($token);
//
//                echo "\n\nUser Info: ";
//                var_dump($user);
//                echo "<img src='" . $user['image'] . "'>";
//            } catch (OAuth2_Exception $e) {
//                $this->passo('4');
//                show_error('That didnt work: ' . $e);
//            }
//        }
//    }
//    
//    public function getProviderArray5($rede,$all=false) {
//        $dados[0]['Facebook'] = array('id' => '755823537846565', 'secret' => 'bb2ba923ee25e0ce2740803721a14e5f');
//        $dados[0]['Google'] = array('id' => '1099466398618-v9otoh2rtol7rpbaddtpfsivfsisvuj5.apps.googleusercontent.com', 'secret' => 'FP3aCzgfsNOp_YgJfP0bcLv4');
//        $dados[0]['Instagram']=array('id' => 'b96dc8b4b4eb4964bb522ca88246a1d7','secret' => '4b522ebaad9d47d28d1cdca83185d890');
//        $dados[0]['Windowslive'] = array('id' => '0000000048145D2E', 'secret' => 'tNg6gGXoeTNIkGc3JeUWhFhRppuCKVoB');
//        $dados[0]['Linkedin'] = array('id' => '78nipe5g2bgn5u', 'secret' => 'NN6BqkpINlUHNnav');
//        $dados[0]['Github'] = array('id' => 'ac3e705eb1a6fc9f017e', 'secret' => 'f23063916c478fa6f97374ac445204af993b880e','scope'=>array('user'));
//        
//        $dados[2]['Facebook'] = array('id' => '755823537846565', 'secret' => 'bb2ba923ee25e0ce2740803721a14e5f');
//        $dados[2]['Google'] = array('id' => '1099466398618-49j6i6f1emp10pjjjkftqufhc9f6fe4g.apps.googleusercontent.com', 'secret' => 'H8tCITF_ELbSAdOsyS89cQNQ'); //alterado
//        $dados[1]['Instagram']=array('id' => 'b96dc8b4b4eb4964bb522ca88246a1d7','secret' => '4b522ebaad9d47d28d1cdca83185d890');
//        $dados[1]['Windowslive'] = array('id' => '0000000048145D2E', 'secret' => 'tNg6gGXoeTNIkGc3JeUWhFhRppuCKVoB');
//        $dados[1]['Linkedin'] = array('id' => '756r2651ty0u1q', 'secret' => '7Vz2PPGBsLChwd4U');
//        $dados[2]['Github'] = array('id' => 'ac3e705eb1a6fc9f017e', 'secret' => 'f23063916c478fa6f97374ac445204af993b880e','scope'=>array('user')); //alterado
//        if ($all){
//            return $dados[1];
//        }
//        return $dados[1][ucfirst($rede)];
//    }
    public function createButtonLogin() {
        
       // $redes=  $this->getProviderArray(NULL, TRUE);
 //       print_r($redes);
   //             echo "<br><br>";
//                echo "<br><br>";
        $redes=  $this->admin->getProviderArray();
     //    print_r($redes);
        $data=array();
        foreach ($redes as $options) {
            $rede[$options['NOME']]=  array(
                'id' =>$options['ID'],
                'secret' =>$options['SECRET'],
                'scope' => unserialize($options['SCOPE'])
            );
            if ($options['SCOPE'] == "" ){ 
                unset($rede[$options['NOME']]['scope']); 
                
            }
 //print_r($rede);
            $opt['redirect_uri']= base_url()."login/provider/".$options['NOME'].".html";
//            if ($rede=="Facebook"){
//                $opt['redirect_uri'].=".html";
//            }
           // $provider = $this->oauth2->provider($rede, $this->getProviderArray($rede));
            
            $provider = $this->oauth2->provider($options['NOME'],$rede[$options['NOME']] );
             $data[$options['NOME']]['link']=$url = $provider->authorize($opt);
        }
//        foreach ($data as $key => $value) {
//            echo "<a href=".$value['link'].">".$key."</a><br>";
//           
//        }
       return $data;
        
    }
    
    public function teste() {
       $generos = $this->ev->getGenerosByUsuario('1048');
        $amiguinhos =  $this->ev->getUsuarioPerfilGeneroIgual('1048',$generos,'10');
       $cod_unique=array();
       $array_unique=array();
        foreach ($amiguinhos as $chave => $amiguinho) {
                       
            if (!in_array($amiguinho['CODIGO'], $cod_unique) ){
                 $cod_unique[]=$amiguinho['CODIGO'];
                  $array_unique[]=$amiguinho;
            }else{
                $key = array_search($amiguinho['CODIGO'], $cod_unique); // $key = 2;
                $array_unique[$key]['QUANTIDADE']+=$amiguinho['QUANTIDADE'];
            }
        }
        arsort($array_unique);
        print_r($generos);
        echo "<pre>";
        print_r($array_unique);
        echo "</pre>";
    }
     public function ce($linha=1,$coluna=1) { 
         echo '<style>.bloco{width:50px;height:50px;border:1px solid black; display:inline-block}</style>';
         for ($linha = 1; $linha <= 5; $linha++) {
             for ($coluna = 1; $coluna <= 10; $coluna++) {
                 echo "<div class='bloco'>($linha,$coluna) </div>";
             }
             echo "<br>";
         }
         
     }
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */