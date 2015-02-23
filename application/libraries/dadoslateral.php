<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class dadosLateral { 
    /*Elementos que aparecem na tela principal e na lateral de todas as paginas*/
    public $CI;
    public function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->model('estanteVirtual_model', 'ev');
        $this->CI->load->model('usuario_model', 'usuarios');  
    
     
    }
    public function quantidadesLivros($codUsuario) {
        $meusLivros = $this->CI->ev->getLivros($codUsuario);
        $data['numQuantNaoLi']=   '0' ;
        $data['numQuantLi']=   '0' ;
        $data['numQuantLendo']='0';      
        foreach ($meusLivros as $value) {
            switch ($value['STATUS']){
                case '0':
                    $data['numQuantNaoLi']++;
                    break;
                case '1':
                     $data['numQuantLi']++;
                    break;
                case '2':
                    $data['numQuantLendo']++;
                    break;
            }
        }
        $data['numQuantTenho']=$data['numQuantNaoLi']+$data['numQuantLi']+$data['numQuantLendo'];
        return $data;
    }
    public function verificaRecados($codUsuario) {
        $minhasmensagens = $this->CI->mensagem->getMensagem($codUsuario);
        $recadonovo=0;
        if($minhasmensagens){
           foreach ($minhasmensagens as $value) {
               if($value['LIDO']==0) {
                $recadonovo++;                   
               }
           }          
           if($recadonovo==0){
               $data['meusrecados'] = NULL;// $this->CI->mensagens->getMessage('semRecadosNovos'); 
           }else{
               $data['meusrecados'] = $this->CI->mensagens->getMessage('RecadosNovos',$recadonovo); 
           }           
       }else{
           $data['meusrecados'] = NULL;//$this->CI->mensagens->getMessage('semRecados');
       }
       return $data;
    }
//    public function verificaQualificacao() {
//        $qualificacoes=5;
//        $data['total_qualificacao']= count($qualificacoes);
//        //print_r($data); die();
//        return $data;
//    }
}
