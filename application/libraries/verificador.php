<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Verificador {
    public $CI;
    public function __construct(){
        $this->CI =& get_instance();
    }
    public function verificarLogado(){
        if (! $this->CI->session->userdata('logged_in')) {
           redirect('/login');
        }
        
    }
    public function verificarAdminLogado(){
        if (! $this->CI->session->userdata('logged')) {
            redirect('admin/login');
        }else{die('fodas-e');}
    }
    public function verificaCategoria($cat){
        $this->verificarLogado();
        if ($cat !=  $this->CI->session->userdata('categoria')) {
                $msg = "<div class='alert alert-danger'>Voce foi redirecionado porque tentou acessar uma area que n&atilde;o tem permiss&atilde;o.</div>";
                 $this->CI->session->set_flashdata('mensagem_erro', $msg);
                redirect('/login');
            }
            
    }
    
}