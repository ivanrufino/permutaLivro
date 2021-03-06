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
        $this->db->where('STATUS <>', 3);  
        
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
         
        $this->db->select('UDE.NOME AS NOME_USUARIO_DE');
            $this->db->join('usuario as UDE', 'UDE.CODIGO = PED.COD_USUARIO_DE','left'); 
        $this->db->where('COD_USUARIO_PARA', $cod_usuario );  
        if(!is_null($status)){
            
            $this->db->where('COD_USUARIO_DE >', 0); 
        
            $this->db->where('PED.STATUS', $status );  
        }
        $this->db->where('PED.STATUS', $status ); 
         $this->db->where('COD_USUARIO_DE IS NOT NULL',  NULL,FALSE); 
        $this->db->where('DATA_ENTREGA IS NULL', NULL); 
        $sql=$this->db->get(); 
        //colocar um if para verificar se foi entregue 
        if($sql->num_rows > 0){
            return $sql->result_array();
        }else{ 
            return FALSE;
        }
    }
    public function getSolicitacaoPedido($cod_usuario) {
        $this->db->select('PED.*,LIV.TITULO,LIV.FOTO,LIV.AUTOR,USU.NOME AS NOME_USUARIO');
        $this->db->from('pedido AS PED');         
        $this->db->join('livro as LIV', 'LIV.CODIGO = PED.COD_LIVRO');       
        $this->db->join('estantevirtual as EST', 'LIV.CODIGO = EST.COD_LIVRO');
        $this->db->join('usuario as USU', 'USU.CODIGO = PED.COD_USUARIO_PARA'); 
         
       
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
            return $this->getPedidoDetalhe($id);
        } else {
            return null;
        }
    }
    public function getMensagem($codPedido,$codigo=NULL) {     
        
        $ret="result_array";
        $this->db->select('*');
        $this->db->from('v_chat AS MEN'); 
        $this->db->where('MEN.COD_PEDIDO', $codPedido );  
       if(!is_null($codigo)){
            $this->db->where('MEN.CODIGO >', $codigo );  
            $ret="result_array";
       }
      // $this->db->order('MEN.CODIGO','ASC');
     
        $query=$this->db->get();
//          echo $this->db->last_query().'<br>';
//       die();
       // $query->free_result();
        //colocar um if para verificar se foi entregue 
        if($query->num_rows > 0){
            return $query->$ret();
        }else{ 
            return FALSE;
        }
    }
    public function verificaUsuarioPedido($cod_usuario,$codPedido) {
        $this->db->select();
        $this->db->from('pedido');
        $this->db->where('CODIGO',$codPedido);
        $this->db->where("(COD_USUARIO_DE = $cod_usuario",NULL);
        $this->db->or_where("COD_USUARIO_PARA = $cod_usuario)",NULL);
        $query = $this->db->get();
        if($query->num_rows > 0){
            return true;
        }else{ 
            return FALSE;
        }
    }
    
    
}

