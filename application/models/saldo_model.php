<?php
if (!defined('BASEPATH')) 
    exit('No direct script access allowed');

class Saldo_Model extends CI_Model{
    public function getSaldo($cod_usuario){
        $this->db->select('USU.ENDERECO,SAL.VALOR');
        $this->db->from('saldo AS SAL');
        $this->db->join('usuario AS USU', 'USU.CODIGO = SAL.COD_USUARIO');
        $this->db->where('USU.CODIGO',$cod_usuario);  
        $sql=$this->db->get(); 
      //  echo $this->db->last_query();die();
        if($sql->num_rows > 0){
            return $sql->row_array();
        }else{ 
            return FALSE;
        }
    }
    public function updateSaldo($cod_usuario,$dados) {
        $sql=$this->db->query("UPDATE `saldo` SET `VALOR` = VALOR +($dados) WHERE COD_USUARIO= $cod_usuario");
        //$this->db->where('COD_USUARIO',  $cod_usuario);
        //$this->db->where('table2.poll_id',$row);
     //  if( $this->db->update('saldo')){
        if ($sql){
            
           return TRUE;
        } else {
            return null;
        }
    }
}
