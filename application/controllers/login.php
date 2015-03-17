<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller { 
    public $css=null;
    public $js=null;
    private $connection;
    public function __construct() {
        parent::__construct();
        $this->css=array('bootstrap','menu','small-business','../lighter/css/lighter');
        $this->js=array('jquery-1.10.2','bootstrap');
                //$this->load->helper();
        $this->load->model('usuario_model', 'usuarios'); 
        $this->load->library('twitteroauth');
		
        }
        public function provider($provider) {
            $rede=$provider;
            $provider = $this->oauth2->provider($provider, $this->getProviderArray($provider));

            if (!$this->input->get('code')) {
                redirect();
            } else {
            try {
                $code = $this->input->get('code');
                $token = $provider->access($code);
                $user = $provider->get_user_info($token);
                // Here you should use this information to A) look for a user B) help a new user sign up with existing data.
                // If you store it all in a cookie and redirect to a registration page this is crazy-simple.
               // echo "<pre>Tokens: ";
                //var_dump($token);
               // echo "\n\nUser Info: ";
               //var_dump($user);
               
                $dados['nome']   = $user['name']; 
                $dados['email']   = $user['email']; //  $this->input->post('email');
                $dados['senha']  = sha1(strtolower($rede)); //  $this->input->post('senha');
                $dados['id_rede']   = $user['uid']; 
                $dados['link_rede']   = array_shift( $user['urls']);
                $dados['foto_rede']   = $user['image'];
                $dados['nome_rede']   = strtolower($rede);
               // print_r($dados);
                
//            
              // echo strtolower($rede);die();
               $this->validarDados($dados,  strtolower($rede));
                
                
            } catch (OAuth2_Exception $e) {
                
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
        $dados['Github'] = array('id' => 'ac3e705eb1a6fc9f017e', 'secret' => 'f23063916c478fa6f97374ac445204af993b880e');
        if ($all){
            return $dados;
        }
        return $dados[ucfirst($rede)];
    }
    public function index()  {
         $this->session->set_flashdata('modal', true);
         
        $this->session->set_flashdata('mensagem_erro', $this->session->flashdata('mensagem_erro'));
        //$data['mensagem_erro']= $this->session->flashdata('mensagem_erro');
        redirect('home');
      //  $data['categoria']=$this->usuarios->buscarCategoria();
       
        $data['mensageFaixa']="Entre com seus dados para entrar no sistema, <br>Caso não seja cadastrado, cadastre-se e aproveite nossos serviços.";
       // $data['lnklogin']=  base_url()."admin";
       // $data['labelLogin']="Acesso Administrador";
            
         $tela=array(
             'cabecalho'=>'telas/cabecalho.php', 
            'topo'=>'telas/vazio.php', //mostrar o topo somente quando n�o for a tela de login
            'faixa_horizontal'=>'telas/faixa_horizontal.php',
             'conteudo'=>'telas/login.php',
        );
        
 
        $this->parser->adc_css($this->css);
        $this->parser->adc_js($this->js);
        $this->parser->mostrar('templates/template_corpo.php',$tela,$data);
    }
    public function efetuarLogin(){
            $dados['email']   =  $this->input->post('usuario');
            $dados['senha']  =   $this->input->post('senha');
        
        /*    $dados['nome']   = $this->session->flashdata('nome_facebook'); 
            $dados['email']   = $this->session->flashdata('email_facebook'); //  $this->input->post('email');
            $dados['senha']  = $this->session->flashdata('senha_facebook'); //  $this->input->post('senha');
            $dados['id_facebook']   = $this->session->flashdata('id_facebook'); 
            $dados['link_facebook']   = $this->session->flashdata('link_facebook');
            
        }*/
     $validar = $this->validarDados($dados);
        
    }
    public function loginface() {
         $user = $this->facebook->getUser();       
        if ($user) {
            try {
                $user_profile = $this->facebook->api('/me');
                $dados['nome']   = $user_profile['first_name']." ".$user_profile['last_name']; 
                $dados['email']   = $user_profile['email']; //  $this->input->post('email');
                $dados['senha']  = sha1('facebook'); //  $this->input->post('senha');
                $dados['id_facebook']   = $user_profile['id']; 
                $dados['link_facebook']   = $user_profile['link'];
                $this->validarDados($dados, 'facebook');
               
            } catch (FacebookApiException $e) {
                $user = null;
            }
        } else {
            $this->facebook->destroySession();
            // $this->session->sess_destroy();
           // redirect();
        }        
       
    }
    public function loginGoogle() {
        $this->load->library('googleplus');
        $dados['token']="";
        echo $this->input->post('code');
        if (isset($_GET['code'])) {
            $this->googleplus->client->authenticate();
            $data['token'] = $this->googleplus->client->getAccessToken();
           $this->session->set_userdata($data); 
      
            $this->session->userdata('token');
           
           /* $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
            header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));*/
        }
        if ($this->session->userdata('token')) {
            $this->googleplus->client->setAccessToken($this->session->userdata('token'));
             
        }
        if ($this->googleplus->client->getAccessToken()) {
            echo "algumas coisa";
            $this->googleplus->people->get('115414977082318263605');
//            $activities = $this->googleplus->activities->listActivities('115414977082318263605', 'public');
//                        
//            print 'Your Activities: <pre>' . print_r($activities, true) . '</pre>';
// We're not done yet. Remember to update the cached access token.
// Remember to replace $_SESSION with a real database or memcached.
            $data['token'] = $this->googleplus->client->getAccessToken();
             $this->session->set_userdata($data); 
        } else {
            $authUrl = $this->googleplus->client->createAuthUrl();
            print "<a href='$authUrl'>Connect Me!</a>";
        }
        
    }
    public function loginLinkedin() {
        
    }
    public function loginTwiter() {
        //futuras implementações
    }
    
    public function verificaLoginRede($dados,$rede) {
//        echo $rede."<br>";
//        print_r($dados['NOME_REDE']); die();
       if ( $dados['NOME_REDE']!= $rede){
           $msg="<div class='alert alert-danger'><strong>Já existe um registro utilizando este email.</strong><br>Caso seja o seu realize o login com sua senha ou com a rede social utilizada inicialmente.</div>";
           $this->session->set_flashdata('mensagem_erro', $msg);
           redirect('login');
       }
    }
    public function verificaLoginGoogle() {
        
    }
    public function verificaLoginLinkedin() {
        
    }
    public function verificaLoginTwiter() {
        //futuras implementações
    }    
    public function verificaStatus($status,$admin=false){
        if ($status==0){
            $msg  = "<div class='alert alert-danger'>Seu cadastro ainda não foi ativado. <br>Por favor verifique sua caixa de email e siga o procedimento de ativação descrito no email.<br>"
                    . "caso não esteja visualizando nosso email, entre em contato e tentaremos lhe ajudar.</div>";
            $this->session->set_flashdata('mensagem_erro', $msg);
            if($admin){
                redirect('admin/login');
            }else{
                redirect('login');
            }
        }
        
    }
    public function recuperaSenha() {
       // die($this->input->post('email')."asd");
        $this->form_validation->set_rules('usuario', 'Nome de Usuário', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'valid_email|required|trim');
        
         if ($this->form_validation->run() == FALSE) {
            echo validation_errors('<div class="alert alert-danger">', '</div>'); 
            die();
        } else {
            $data['login'] =  $this->input->post('usuario');
            $data['email'] =  $this->input->post('email');
            $user=$this->getIdByuser($data);
            if (is_null($user['CODIGO'])){
                $ret="<div class='alert alert-danger'>";
                $ret.="<h4><strong>Desculpe:</strong></h4> Não encontramos seus dados, por favor verifique se seu nome de usuário e email estão corretos.<br>";
                $ret.="<h5>Possíveis causas</h5>";
                $ret.="<ul>";
                $ret.="<li>Caractéres maiúsculos e minúsculos são diferenciados</li>";
                $ret.="<li>Pode estar faltando ou sobrando alguma letra em seu login ou email</li>";
                $ret.="<li>Pode não ser este email que você utiliza no cadastro</li>";
                $ret.="</ul>";
                $ret.="<br><strong>Caso ainda não consiga entre em contato e tentaremos resolver. </strong> <a href='mailto:contato@tcc.bl.ee?Subject=Esqueci%20minha%20senha' target='_blank'>Contato</a>";
                $ret.="</div>";            
            }else{
                $data['id'] =  sha1($user['CODIGO']);
                $data['nome'] =  $user['NOME'];

                $this->sendEmailRecuperaSenha($data);
                 $ret="<div class='alert alert-success'>";
                 $ret.="<strong>Confirmação:</strong> Olá, enviamos um email para você com as informações necessárias para alterar sua conta.<br> Siga os procedimentos descritos.";
                 $ret.="</div>";
            }
      
            echo $ret;
        }
      
    }
    public function getIdByuser($dados) { //recupera o id para enviar por email para recuperação de senha
        $dados = $this->usuarios->getId($dados);
        if(!is_null($dados)){
            return $dados;
        }else{
            return null;
        }
        //return $dados;
    }
    public function sendEmailRecuperaSenha($dados) {
        $this->email->from('ivan.rufino.m@gmail.com', 'Ivan Rufino');
        $this->email->to($dados['email']);
        $this->email->bcc('ivan.rufino.m@gmail.com');
        $this->email->subject('SISCORE: Recuperação de Senha');
        //$mensagem=$this->load->view('telas/email/recupera_senha',$dados,true);
        $mensagem=$this->load->view('telas/email/recupera_senha/email',$dados,true);
        $this->email->message($mensagem);
        //$msg="ok";
        if (!$this->email->send()){            
            $msg = $this->email->print_debugger();
        }
       // return $msg;
    }
    
    public function alteraSenha($id) {
       $data['mensageFaixa']="Digite sua nova senha e aperte o botão 'Confirmar alteração'.";
       $data['id']=$id;
      
        $tela=array(
             'cabecalho'=>'telas/cabecalho.php', 
            'topo'=>'telas/vazio.php', //mostrar o topo somente quando n�o for a tela de login
            'faixa_horizontal'=>'telas/faixa_horizontal.php',
             'conteudo'=>'telas/alterarSenha.php',
        );
        
 
        $this->parser->adc_css($this->css);
        $this->parser->adc_js($this->js);
        $this->parser->mostrar('templates/template_corpo.php',$tela,$data);
    
        
    }
    public function confirmaAlteracao() {
        $id=$this->input->post('id');
        if($id=='success'){
            $this->session->set_flashdata('mensagem', '<div class="alert alert-success">Sua senha já foi alterada!</div>');
           redirect("/login/alteraSenha/success"); 
        }
        $this->form_validation->set_rules('senha', 'Senha', 'required|trim|min_length[6]|matches[Repita_Senha]');
        
        
         if ($this->form_validation->run() == FALSE) {
            $erro= validation_errors('<div class="alert alert-danger">', '</div>'); 
            $this->session->set_flashdata('mensagem', $erro);
            redirect("/login/alteraSenha/$id");
            
        } else {
            $dados['SENHA']=md5( $this->input->post("senha"));
           // $codigo=$this->input->post('codigo');
            $this->usuarios->updatePessoa($dados,$id);
//            $this->session->set_flashdata('mensagem', 'Sua senha foi alterada com sucesso!');
            $this->session->set_flashdata('mensagem', '<div class="alert alert-success">Sua senha foi alterada com sucesso!</div>');
            redirect("/login/alteraSenha/success");
        }
    }
    public function testeTela() {
        $dados['nome']='ivan';
        $dados['id']='256413';
        $this->load->view('telas/email/recupera_senha/email',$dados);
    }
    public function efetuarLogout(){
       // $this->facebook->destroySession();
        // Make sure you destory website session as well.
         $this->session->sess_destroy();
        redirect();
        
    }

    public function validarDados($dados,$rede=NULL) {
        $validar=$this->usuarios->logar($dados,$rede);
       // print_r($dados);die();
       // print_r($validar);die();
       if ($validar != false){
            $this->verificaStatus($validar['STATUS']);
            $login = array(
                'cod_usuario'=> $validar['CODIGO'],
                'nome'  => $validar['NOME'],
                'email'  => $validar['EMAIL'],
                'logged_in' => TRUE
               );
            if (!is_null($rede)){                
                     $this->verificaLoginRede($validar,$rede);
                    
            }
            $this->session->set_userdata($login);
            
            redirect("minhaestante");
       
        
        }else{          
            if (!is_null($rede)){
                $dadosNovoUsuario= array_change_key_case($dados,CASE_UPPER) ;
                  $dadosNovoUsuario['STATUS']='1';
                  //print_r($dadosNovoUsuario);die();
                $this->cadastroRede($dadosNovoUsuario,$rede);  
                /*switch ($rede) {
                    case 'facebook':
                        $dados['LOGIN_FACEBOOK']='1';
                        $dados['STATUS']='1';
                        $this->cadastroFace($dados);
                        break;
                    case 'google':
                        $this->cadastroGoogle();
                        break;
                    case 'linkedin':
                        $this->cadastroLinkedin();
                        break;

                    default:
                        break;
                }*/
            }else{
                echo "Usuário não cadastrado";
            } 
        }
    }

    public function cadastroRede($dados,$rede) {       
        $idUsuario = $this->usuarios->novoUsuario($dados);
        if($idUsuario){
          $dados=  array_change_key_case($dados,CASE_LOWER);
            $this->validarDados($dados,$rede);
                 
        }
    }

    
    
    /*apagar se nao der certo*/
    public function auth() {
        if ($this->session->userdata('access_token') && $this->session->userdata('access_token_secret')) {
            // User is already authenticated. Add your user notification code here.
            redirect(base_url('/'));
        } else {
            // Making a request for request_token
            $request_token = $this->connection->getRequestToken(base_url('/twitter/callback'));

            $this->session->set_userdata('request_token', $request_token['oauth_token']);
            $this->session->set_userdata('request_token_secret', $request_token['oauth_token_secret']);

            if ($this->connection->http_code == 200) {
                $url = $this->connection->getAuthorizeURL($request_token);
                redirect($url);
            } else {
                // An error occured. Make sure to put your error notification code here.
                redirect(base_url('/'));
            }
        }
    }

    /**
     * Callback function, landing page for twitter.
     * @access	public
     * @return	void
     */
    public function callback() {
        if ($this->input->get('oauth_token') && $this->session->userdata('request_token') !== $this->input->get('oauth_token')) {
            $this->reset_session();
            redirect(base_url('/twitter/auth'));
        } else {
            $access_token = $this->connection->getAccessToken($this->input->get('oauth_verifier'));

            if ($this->connection->http_code == 200) {
                $this->session->set_userdata('access_token', $access_token['oauth_token']);
                $this->session->set_userdata('access_token_secret', $access_token['oauth_token_secret']);
                $this->session->set_userdata('twitter_user_id', $access_token['user_id']);
                $this->session->set_userdata('twitter_screen_name', $access_token['screen_name']);

                $this->session->unset_userdata('request_token');
                $this->session->unset_userdata('request_token_secret');

                redirect(base_url('/'));
            } else {
                // An error occured. Add your notification code here.
                redirect(base_url('/'));
            }
        }
    }

    public function post($in_reply_to) {
        $message = $this->input->post('message');
        if (!$message || mb_strlen($message) > 140 || mb_strlen($message) < 1) {
            // Restrictions error. Notification here.
            redirect(base_url('/'));
        } else {
            if ($this->session->userdata('access_token') && $this->session->userdata('access_token_secret')) {
                $content = $this->connection->get('account/verify_credentials');
                if (isset($content->errors)) {
                    // Most probably, authentication problems. Begin authentication process again.
                    $this->reset_session();
                    redirect(base_url('/twitter/auth'));
                } else {
                    $data = array(
                        'status' => $message,
                        'in_reply_to_status_id' => $in_reply_to
                    );
                    $result = $this->connection->post('statuses/update', $data);

                    if (!isset($result->errors)) {
                        // Everything is OK
                        redirect(base_url('/'));
                    } else {
                        // Error, message hasn't been published
                        redirect(base_url('/'));
                    }
                }
            } else {
                // User is not authenticated.
                redirect(base_url('/twitter/auth'));
            }
        }
    }

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */