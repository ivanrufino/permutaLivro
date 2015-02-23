<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Empresa_model extends CI_Model {

    public function novaEmpresa($dados) {
        if ($this->db->insert('tcc_empresa', $dados)) {
            //die($this->db->last_query());
            return $this->db->insert_id();
        } else {
            return null;
        }
    }

    public function novoAdministrador($dados) {
        if ($this->db->insert('tcc_administrador', $dados)) {
            return $this->db->insert_id();
        } else {
            return null;
        }
    }
    public function updateAdmin($id,$dados) {
        $this->db->where('CODIGO', $id);
       // $this->db->update('tcc_administrador', $dados)
        if ($this->db->update('tcc_administrador', $dados)) {
            return TRUE;
        } else {
            return null;
        }
    }
    public function updateEmpresa($id, $dados) {
        $this->db->where('CODIGO', $id);
        if ($this->db->update('tcc_empresa', $dados)) {
            return TRUE;
        } else {
            return null;
        }
    }
    public function getAdministrador($codigo = null) {        
        $ret='result_array';
        $this->db->select('ADM.*,EMP.LOGO');
        
        $this->db->from('tcc_administrador AS ADM');
        $this->db->join('tcc_empresa AS EMP', 'EMP.CODIGO = ADM.COD_EMPRESA');
        if (!is_null($codigo)) {
            $this->db->where('ADM.CODIGO', $codigo);
            $ret='row_array';
        }
        
        $sql = $this->db->get();
        
        if ($sql->num_rows > 0) {
            return $sql->$ret();
        } else {
            return NULL;
        }
    }

    public function getAdministradorByEmpresa($codEmpresa) {
        $this->db->select('*');
        $this->db->from('tcc_administrador');
        $this->db->where('COD_EMPRESA', $codEmpresa);
        $sql = $this->db->get();
        if ($sql->num_rows > 0) {
            return $sql->result_array();
        } else {
            return NULL;
        }
    }
    public function updateAdministrador($dados,$id){
        $this->db->where('CODIGO', $id);
        if ($this->db->update('tcc_administrador', $dados)){
            return true;
        } else{
            return false;
        }
    }
    public function getEmpresas($codigo=null){
        $ret='result_array';
        $this->db->select('*');        
        $this->db->from('tcc_empresa AS EMP');
        if (!is_null($codigo)) {
            $this->db->where('EMP.CODIGO', $codigo);
            $ret='row_array';
        }        
        $sql = $this->db->get();        
        if ($sql->num_rows > 0) {
            return $sql->$ret();
        } else {
            return NULL;
        }
    }
    public function getSenha($codPessoa) {
       $this->db->select('SENHA');
        $this->db->from('tcc_administrador as ADM');
        $this->db->where('ADM.CODIGO', $codPessoa);
        
        
        $sql = $this->db->get();
        
        if ($sql->num_rows > 0) {
            $linha= $sql->row_array(0);
            return  $linha['SENHA'];
        } else {
            return FALSE;
        } 
    }

}
