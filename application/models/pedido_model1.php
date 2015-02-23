<?php

if (!defined('BASEPATH')) 
    exit('No direct script access allowed');

class Pedido_Model extends CI_Model {
    public function getLivrosDesejados($cod_usuario,$cod_livro=null,$todos=false) {
        $this->db->select('PED.*,LIV.TITULO,LIV.FOTO,LIV.AUTOR');
        $this->db->from('pedido AS PED');         
        $this->db->join('livro as LIV', 'LIV.CODIGO = PED.COD_LIVRO');
        if (!$todos){
            $this->db->where('COD_USUARIO_DE', NULL);  
        }
        $this->db->where('DATA_ENTREGA', NULL);  
        
        $this->db->where('COD_USUARIO_PARA', $cod_usuario );  
        if(!is_null($cod_livro)){
            $this->db->where('COD_LIVRO', $cod_livro );  
        }
        
        $sql=$this->db->get(); 
        
        //colocar um if para verificar se foi entregue 
        if($sql->num_rows > 0){
            return $sql->result_array();
        }else{ 
            return FALSE;
        }
    }
    public function getPedidobyStatus($cod_usuario,$status=null) {
        $this->db->select('PED.*,LIV.TITULO,LIV.FOTO,LIV.AUTOR');
        $this->db->from('pedido AS PED');         
        $this->db->join('livro as LIV', 'LIV.CODIGO = PED.COD_LIVRO');       
         
       
        $this->db->where('COD_USUARIO_PARA', $cod_usuario );  
        if(!is_null($status)){
            $this->db->where('COD_USUARIO_DE >', 0); 
            $this->db->where('STATUS', $status );  
        }
        $this->db->where('DATA_ENTREGA', NULL); 
        $sql=$this->db->get(); 
        //colocar um if para verificar se foi entregue 
        if($sql->num_rows > 0){
            return $sql->result_array();
        }else{ 
            return FALSE;
        }
    }
    public function getSolicitacaoPedido($cod_usuario) {
        $this->db->select('PED.*,LIV.TITULO,LIV.FOTO,LIV.AUTOR');
        $this->db->from('pedido AS PED');         
        $this->db->join('livro as LIV', 'LIV.CODIGO = PED.COD_LIVRO');       
        $this->db->join('estantevirtual as EST', 'LIV.CODIGO = EST.COD_LIVRO');       
         
       
        $this->db->where('COD_USUARIO_DE', $cod_usuario ); 
        $status = array('1', '2');
        $this->db->where_in('PED.STATUS', $status ); 
        $this->db->where('EST.COD_USUARIO', $cod_usuario ); 
        $this->db->order_by('PED.DATA_PEDIDO ASC');
        $sql=$this->db->get(); 
        //echo $this->db->last_query();die(); 
        //colocar um if para verificar se foi entregue 
        if($sql->num_rows > 0){
            return $sql->result_array();
        }else{ 
            return FALSE;
        }
    }
    
    public function getPedidoDetalhe($codPedido) {
        $this->db->select('PED.*,LIV.TITULO,LIV.FOTO,LIV.AUTOR,LIV.CODIGO AS CODLIVRO,USU.NOME,USU.FOTO,USU.CODIGO AS CODUSUARIO');
        $this->db->from('pedido AS PED');         
        $this->db->join('livro as LIV', 'LIV.CODIGO = PED.COD_LIVRO');       
         $this->db->join('usuario as USU', 'USU.CODIGO = PED.COD_USUARIO_DE','LEFT');       
         
       
        $this->db->where('PED.CODIGO', $codPedido );  
        
        $sql=$this->db->get(); 
        //colocar um if para verificar se foi entregue 
        if($sql->num_rows > 0){
            return $sql->row_array();
        }else{ 
            return FALSE;
        }
    }
    public function novoPedido($dados) {
        //verificar se já existe uma solicitação de pedido para o usuario, caso tenha informar 
        if ($this->getLivrosDesejados($dados['COD_USUARIO_PARA'], $dados['COD_LIVRO'], true)){
           RETURN 'existe';
        }else{
             
            if ($this->db->insert('pedido', $dados)){
                return $this->db->insert_id();
            }else{
                return false;
            }
        }
    }
    public function updatePedido($id, $dados) {
        $this->db->where('CODIGO', $id);
        if ($this->db->update('pedido', $dados)) {
            return TRUE;
        } else {
            return null;
        }
    }
    
    
}

