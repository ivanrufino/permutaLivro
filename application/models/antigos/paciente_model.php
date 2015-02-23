<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Paciente_Model extends CI_Model {

    public function getPaciente($codigo = null) {
        $ret = 'result_array';
        $this->db->select('ATE.*,PES.NOME,PES.EMAIL,PES.LOGIN,PES.TELEFONE,PES.CELULAR');
        $this->db->from('tcc_paciente as ATE');
        $this->db->join('tcc_pessoa as PES', 'PES.CODIGO = ATE.CODIGO_PESSOA');
        
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

  
    public function novoPaciente($dadosPessoa,$dadosPaciente){
        if ($this->db->insert('tcc_pessoa', $dadosPessoa)){
            $dadosPaciente['CODIGO_PESSOA']=  $this->db->insert_id();
            if ($this->db->insert('tcc_paciente', $dadosPaciente)){
                return $this->db->insert_id();
            }else{
                return null;
            }
        }else{
            return null;
        }
    }
    public function updatePaciente($dados,$id){
        $this->db->where('CODIGO', $id);
        if ($this->db->update('tcc_paciente', $dados)) {
            return TRUE;
        } else {
            return null;
        }
    }
    public function updatePessoa($dados,$id){
        $this->db->set($dados);
        $this->db->where('tcc_paciente.CODIGO',$id);
        //$this->db->where('table2.poll_id',$row);
       if( $this->db->update('tcc_pessoa join tcc_paciente ON tcc_paciente.CODIGO_PESSOA= tcc_pessoa.CODIGO')){
           return TRUE;
        } else {
            return null;
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

}
//ALTER TABLE  `tcc_paciente` ADD  `DATA_NASCIMENTO` DATE NOT NULL AFTER  `CODIGO` ;