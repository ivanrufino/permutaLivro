<?php

if (!defined('BASEPATH')) 
    exit('No direct script access allowed');

class Usuario_Model extends CI_Model {
    
    public function logar($dados,$rede=NULL){ 
        $this->db->select('*');
        $this->db->from('usuario AS usu');
        /*$this->db->join($dados['categoria']. ' AS CAT', 'CAT.CODIGO_PESSOA = PES.CODIGO');*/
        $this->db->where('email',$dados['email']);  
        if (is_null($rede)){
            $this->db->where('SENHA',  sha1($dados['senha']));  
        }
       // $this->db->where('STATUS', '1');  
        $sql=$this->db->get(); 
       //echo $this->db->last_query();die();
        if($sql->num_rows > 0){
            return $sql->row_array();
        }else{ 
            return FALSE;
        }
        
    }
    public function getUsuario($codigo) {
        $this->db->where('CODIGO', $codigo );  
        $sql=$this->db->get('v_usuario'); 
        
        
        if($sql->num_rows > 0){
            return $sql->row_array();
        }else{ 
            return FALSE;
        }
    }
    public function getUsuario2($CODIGO) {
        $this->db->select('CODIGO,NOME,EMAIL,DATA_CADASTRO,FOTO');
        $this->db->from('usuario AS usu');
         
        $this->db->where('CODIGO', $CODIGO );  
        $sql=$this->db->get(); 
        
        if($sql->num_rows > 0){
            return $sql->row_array();
        }else{ 
            return FALSE;
        }
    }
    
    /*public function logarAdmin($dados){
        $this->db->select('*');
        $this->db->from('tcc_administrador AS PES');
        
        $this->db->where('LOGIN',$dados['usuario']);  
        $this->db->where('SENHA',  sha1($dados['senha']));  
        $sql=$this->db->get();
        
        if($sql->num_rows > 0){
            return $sql->row_array();
        }else{
            return FALSE;
        }
        
    }*/
    
    
    public function getId($dados) {//recupera as informações pelo nome e senha para recuperação de senha
        $this->db->select('PES.CODIGO,PES.NOME');
        $this->db->from('tcc_pessoa AS PES');
      
         $this->db->where('LOGIN',$dados['login']);  
         $this->db->where('EMAIL',$dados['email']);  
        
        $dados=$this->db->get();
      //  echo $this->db->last_query();
        if($dados->num_rows>0){
            return $dados->row_array();
        }else{
            return NULL;
        }
    }
    public function updatePessoa($dados,$id){
        $this->db->set($dados);
        $this->db->where('sha1(tcc_pessoa.CODIGO)',  $id);
        //$this->db->where('table2.poll_id',$row);
       if( $this->db->update('tcc_pessoa')){
            // echo $this->db->last_query();
            
           return TRUE;
        } else {
            return null;
        }
    }
    public function novoUsuario($dados){
        if ($this->db->insert('usuario', $dados)){
            return $this->db->insert_id();
            
        }else{
            return null;
        }
      
    }
    public function salvarEndereco($dados){
        
        if ($this->db->insert('endereco', $dados)){
            return $this->db->insert_id();            
        }else{
           return null;
        }
      
    }
    public function alterarEndereco($codigo,$dados) {
         $this->db->set($dados);
        $this->db->where('CODIGO',  $codigo);
        //$this->db->where('table2.poll_id',$row);
       if( $this->db->update('endereco')){
            // echo $this->db->last_query();
            
           return TRUE;
        } else {
            return null;
        }
    }
    public function getEndereco($cod_usuario) {//recupera as informações pelo nome e senha para recuperação de senha
        $this->db->select('*');
        $this->db->from('endereco AS END');      
         $this->db->where('COD_USUARIO',$cod_usuario);  
          
        $dados=$this->db->get();
      //  echo $this->db->last_query();
        if($dados->num_rows>0){
            return $dados->row_array();
        }else{
            return NULL;
        }
    }
    public function getQualificacao($cod_usuario) {
        $this->db->select('*');
        $this->db->from('qualificacao AS QUA');      
         $this->db->where('COD_USUARIO',$cod_usuario);  
          
        $dados=$this->db->get();
       // echo $this->db->last_query();
        if($dados->num_rows>0){
            return $dados->row_array();
        }else{
            return NULL;
        }
    }
    public function getUsuarioMeSeguem($eu,$amigo=NULL) {
        $this->db->select('*');
        $this->db->from('segue');
        if (!is_null($amigo)){
            $this->db->where('COD_USUARIO_DE',$amigo);
        }
        $this->db->where('COD_USUARIO_PARA',$eu);
        $this->db->where('INVERSE','0');
        $dados=$this->db->get();
       // echo $this->db->last_query();
        if($dados->num_rows>0){
            return $dados->result_array();
        }else{
            return NULL;
        }
    }
    public function novoSegue($dados) {
        if ($this->db->insert('segue', $dados)){
            return true;            
        }else{
           return FALSE;
        }
    }

    public function updateSegue($dados) {
        $this->db->where('COD_USUARIO_DE', $dados['COD_USUARIO_DE']);
        $this->db->where('COD_USUARIO_PARA', $dados['COD_USUARIO_PARA']);
       if( $this->db->update('segue', $dados)){
           return TRUE;
       }else{
           return FALSE;
       }
    }

    public function getAmigos($cod_usuario) {
        //SELECT * FROM segue WHERE COD_USUARIO_DE = id_usuario or  (COD_USUARIO_PARA = id_usuario and INVERSE = 1);
        
        $this->db->select('*');
        $this->db->from('segue');
        $this->db->where('COD_USUARIO_DE',$cod_usuario,FALSE);
        $this->db->or_where('(COD_USUARIO_PARA',$cod_usuario);
        $this->db->where("INVERSE = '1')",NULL,FALSE);
        $dados=$this->db->get();
            //echo $this->db->last_query();
//        $query1= $this->db->query("call quem_eu_sigo($cod_usuario)");
//        
//        $dados = $query1->result_array();
        $sigo=array();
        
        foreach ($dados->result_array() as $value) {
            if ($value['COD_USUARIO_DE']!=$cod_usuario){
                $sigo[]=$value['COD_USUARIO_DE'];
            }else{
                $sigo[]=$value['COD_USUARIO_PARA'];
            }
            
        }
        
        $dados->free_result();
       $amigos=array();
       
        for ($index = 0; $index < count($sigo); $index++) {
            $amigos[]= $this->getUsuario($sigo[$index]);
        }
//      
       return $amigos ;
       
    }
   
    public function ativarUsuario($dados,$id_hash) {
        $this->db->set($dados);
        $this->db->where('sha1(CODIGO)',  $id_hash);
       if( $this->db->update('usuario')){
            
           return TRUE;
        } else {
            return null;
        }
    }
   
}

