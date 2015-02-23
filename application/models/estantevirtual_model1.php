<?php

if (!defined('BASEPATH')) 
    exit('No direct script access allowed');

class EstanteVirtual_Model extends CI_Model {
    public function getLivros($cod_usuario) {
        $this->db->select('*');
        $this->db->from('estantevirtual AS evi');                         
        $this->db->where('COD_USUARIO', $cod_usuario );  
        $sql=$this->db->get(); 
        
        if($sql->num_rows > 0){
            return $sql->result_array();
        }else{ 
            return array();
        }
    }
    public function getLivrosbyCodLivro($cod_usuario,$codLivro) { 
        /*Busca um determinado livro do usuario logado*/
        $this->db->select('*');
        $this->db->from('estantevirtual AS evi');                         
        $this->db->where('COD_USUARIO', $cod_usuario ); 
        $this->db->where('COD_LIVRO', $codLivro ); 
        $sql=$this->db->get(); 
        
        if($sql->num_rows > 0){
            return $sql->row_array();
        }else{ 
            return FALSE;
        }
    }
    public function getLivrosTodos($codLivro) {
        /*Busca um determinado livro de todos os usuario*/
        $this->db->select('EVI.*,USU.CODIGO AS COD_USUARIO, USU.NOME,USU.FOTO,END.*');
        $this->db->from('estantevirtual AS EVI');                         
        $this->db->where('ESCOPO', '1' ); 
        $this->db->where('COD_LIVRO', $codLivro ); 
        $this->db->join('usuario as USU', 'USU.CODIGO = EVI.COD_USUARIO');
        $this->db->join('endereco as END', 'END.CODIGO = USU.ENDERECO');
        $sql=$this->db->get(); 
        
        if($sql->num_rows > 0){
            return $sql->result_array();
        }else{ 
            return FALSE;
        }
    }
    public function livrosDisponiveis($cod_usuario) {
         //$this->db->select('*');
        
        $this->db->where('COD_USUARIO_PARA', $cod_usuario); 
        $sql=$this->db->get('v_pedidospendentesdisponiveis'); 
        
        if($sql->num_rows > 0){
            return $sql->result_array();
        }else{ 
            return FALSE;
        }
    }
}

