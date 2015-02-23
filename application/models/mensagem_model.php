<?php

if (!defined('BASEPATH')) 
    exit('No direct script access allowed');

class Mensagem_Model extends CI_Model {
    public function getMensagem($cod_usuario) {
        $this->db->select('*');
        $this->db->from('mensagem AS men');                         
        $this->db->where('COD_USUARIO', $cod_usuario ); 
        $this->db->order_by("CODIGO", "desc"); 
        $sql=$this->db->get(); 
        
        if($sql->num_rows > 0){
            return $sql->result_array();
        }else{ 
            return 0;
        }
    }
    public function novaMensagem($dados){
        if ($this->db->insert('mensagem', $dados)){            
            return $this->db->insert_id();
            
        }else{
            return false;
        }
    }
    public function updateMensagem($id,$dados) {
        $this->db->where('CODIGO', $id);
        if ($this->db->update('mensagem', $dados)) {
            return TRUE;
        } else {
            return null;
        }
    }
    
   
}

