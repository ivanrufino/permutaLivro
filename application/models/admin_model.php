<?php

if (!defined('BASEPATH')) 
    exit('No direct script access allowed');

class Admin_Model extends CI_Model {
    public function getProviderArray($rede=null) {
        
        $this->db->select('*');
        $this->db->from('redes AS re');  
        if (!is_null($rede)){
            $this->db->where('NOME', $rede ); 
        }
        $sql=$this->db->get(); 
        
        if($sql->num_rows > 0){
            return $sql->result_array();
        }else{ 
            return FALSE;
        }
    }

   
}
  /*SELECT *,  COUNT(COD_LIVRO) AS QUANTIDADE  FROM `v_estante` WHERE `COD_USUARIO` <> 1043 and `COD_LIVRO` IN (SELECT COD_LIVRO FROM v_estante WHERE COD_USUARIO = 1043)
GROUP BY COD_USUARIO  HAVING QUANTIDADE > 1 ORDER BY QUANTIDADE DESC, NOME ASC LIMIT 15*/
