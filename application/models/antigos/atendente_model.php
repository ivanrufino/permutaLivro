<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Atendente_Model extends CI_Model {

    public function getAtendente($codigo = null) {
        $ret = 'result_array';
        $this->db->select('ATE.*,PES.NOME,PES.EMAIL,PES.LOGIN,PES.TELEFONE,PES.CELULAR,EMP.LOGO');
        $this->db->from('tcc_atendente as ATE');
        $this->db->join('tcc_pessoa as PES', 'PES.CODIGO = ATE.CODIGO_PESSOA');
        $this->db->join('tcc_empresa AS EMP', 'EMP.CODIGO = ATE.CODIGO_EMPRESA');
        if (!is_null($codigo)) {
            $this->db->where('PES.CODIGO', $codigo);
            $ret = 'row_array';
        }
        $sql = $this->db->get();
        
        if ($sql->num_rows > 0) {
            return $sql->$ret();
        } else {
            return FALSE;
        }
    }
    public function getSenha($codPessoa) {
       $this->db->select('SENHA');
        $this->db->from('tcc_pessoa as PES');
        $this->db->where('PES.CODIGO', $codPessoa);
        
        
        $sql = $this->db->get();
        
        if ($sql->num_rows > 0) {
            $linha= $sql->row_array(0);
            return  $linha['SENHA'];
        } else {
            return FALSE;
        } 
    }
    public function getAtendenteByEmpresa($cod_empresa,$ativo=null) {
        $this->db->select("IF(ATE.STATUS = 0 , 'Inativo' , 'Ativo' )AS STATUS_N ",false);

        //$this->db->select("IF(1<2,'yes','no')as 'st';");
        $this->db->select('ATE.*,PES.NOME,PES.LOGIN,PES.EMAIL');
        $this->db->from('tcc_atendente as ATE');
        $this->db->where('CODIGO_EMPRESA', $cod_empresa);
        $this->db->join('tcc_pessoa as PES', 'PES.CODIGO = ATE.CODIGO_PESSOA');
        if(!is_null($ativo)){
            $this->db->where('STATUS', $ativo);
        }
        $sql = $this->db->get();
        if ($sql->num_rows > 0) {
            //DIE($this->db->last_query());
            return $sql->result_array();
        } else {
            return FALSE;
        }
    }
    public function novoAtendente($dadosPessoa,$dadosAtendente){
        if ($this->db->insert('tcc_pessoa', $dadosPessoa)){
            $dadosAtendente['CODIGO_PESSOA']=  $this->db->insert_id();
            if ($this->db->insert('tcc_atendente', $dadosAtendente)){
                return $this->db->insert_id();
            }else{
                return null;
            }
        }else{
            return null;
        }
    }
    public function ativarAtendente($dados,$id){
        $this->db->where('MD5(CODIGO)', $id);
        if ($this->db->update('tcc_atendente', $dados)){
            return true;
        } else{
            return false;
        }
    }
    
    public function updateAtendente($dados,$id){
        $this->db->where('CODIGO', $id);        
        if ($this->db->update('tcc_atendente', $dados)) {
            return TRUE;
        } else {
            return null;
        }
    }
    public function updatePessoa($dados,$id){
        $this->db->set($dados);
        $this->db->where('tcc_atendente.CODIGO',$id);
        //$this->db->where('table2.poll_id',$row);
       if( $this->db->update('tcc_pessoa join tcc_atendente ON tcc_atendente.CODIGO_PESSOA= tcc_pessoa.CODIGO')){
           return TRUE;
        } else {
            return null;
        }
       

//        $this->db->join('tcc_atendente as ATE', ' ATE.CODIGO_PESSOA=PES.CODIGO ');
//        $this->db->where('ATE.CODIGO', $id); 
//        if ($this->db->update('tcc_pessoa', $dados)) {
//            return TRUE;
//        } else {
//            return null;
//        }
    }

}
