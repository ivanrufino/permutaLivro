<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Medicamento_Model extends CI_Model {
    
    
    public function getMedicamento($codigo=NULL){
        $this->db->select('*');
        $this->db->from('tcc_medicamentos');
        $this->db->order_by("CODIGO asc");      
        if(!is_null( $codigo)){
            $this->db->where('CODIGO',$codigo);  
        }
        $dados=$this->db->get();
        
        if ($dados->num_rows > 0) {
            return $dados->result_array();
        } else {
            return FALSE;
        }
    }
    public function novaReceita($dados){
        if ($this->db->insert('tcc_receita', $dados)){
            $id = $this->db->insert_id();
            $newDados['COD_HASH']=$dados['COD_HASH'].$id; 
            $this->setNumero($id,$newDados);
            $newDados['codReceita']=$id;
            return $newDados;
        }else{
            return null;
        }
    }
    public function novaMedicamentoLista($dados){
        if ($this->db->insert('tcc_lista_remedio', $dados)){
            return $this->db->insert_id();
        }else{
            return null;
        }
    }
    
    public function buscaForma($codMedicamento) {
        $this->db->select('*');
        $this->db->from('medicamento_formafarma');
        $this->db->order_by("CODIGO asc");      
        
            $this->db->where('COD_MEDICAMENTO',$codMedicamento);  
        $dados=$this->db->get();
        
        if ($dados->num_rows > 0) {
            return $dados->result_array();
        } else {
            return FALSE;
        }
    }
    public function getReceitaByCod($codReceita,$cat,$cod_medico=NULL) {
        $this->db->select('REC.*,PES_MED.NOME AS MEDICO, MED.CRM, PES_PAC.NOME AS PACIENTE,PAC.CPF,EMP.NOME AS EMPRESA');
        $this->db->from('tcc_receita AS REC');
        
        $this->db->join('tcc_empresa AS EMP', 'EMP.CODIGO = REC.COD_EMPRESA');
        
        $this->db->join('tcc_medico AS MED', 'MED.CODIGO = REC.COD_MEDICO');
        $this->db->join('tcc_pessoa AS PES_MED', 'PES_MED.CODIGO = MED.CODIGO_PESSOA');
        
        $this->db->join('tcc_paciente AS PAC', 'PAC.CODIGO = REC.COD_PACIENTE');
        $this->db->join('tcc_pessoa AS PES_PAC', 'PES_PAC.CODIGO = PAC.CODIGO_PESSOA');
        
        if ($cat==3){
            $this->db->where('REC.STATUS','1');  
            $this->db->where('REC.APROVACAO_PACIENTE','1');  
        }
       
        $this->db->order_by("REC.CODIGO desc");      
        $this->db->where('REC.COD_HASH',$codReceita);  
         if ($cat==1){ 
//              $this->db->where('REC.APROVACAO_PACIENTE','1');
             $where = "(REC.STATUS_MEDICO='1' OR REC.COD_MEDICO='$cod_medico')";
             $this->db->where($where);
             $where2 = "(REC.APROVACAO_PACIENTE='1' OR REC.COD_MEDICO='$cod_medico')";
             $this->db->where($where2);
            // $this->db->where('REC.APROVACAO_PACIENTE','1');  
          
        }
            
            
        $dados=$this->db->get();
        
        if ($dados->num_rows > 0) {
            return $dados->row_array();
        } else {
            return FALSE;
        }
    }
    public function getReceitasByMedico($codMedico) {
        $this->db->select('REC.*,PES_MED.NOME AS MEDICO, MED.CRM, PES_PAC.NOME AS PACIENTE,PAC.CPF,EMP.NOME AS EMPRESA');
        $this->db->from('tcc_receita AS REC');
        
        $this->db->join('tcc_empresa AS EMP', 'EMP.CODIGO = REC.COD_EMPRESA');
        
        $this->db->join('tcc_medico AS MED', 'MED.CODIGO = REC.COD_MEDICO');
        $this->db->join('tcc_pessoa AS PES_MED', 'PES_MED.CODIGO = MED.CODIGO_PESSOA');
        
        $this->db->join('tcc_paciente AS PAC', 'PAC.CODIGO = REC.COD_PACIENTE');
        $this->db->join('tcc_pessoa AS PES_PAC', 'PES_PAC.CODIGO = PAC.CODIGO_PESSOA');
        
        $this->db->order_by("REC.CODIGO desc");      
        $this->db->where('REC.COD_MEDICO',$codMedico);  
        
            
            
        $dados=$this->db->get();
        //echo $this->db->last_query();
        if ($dados->num_rows > 0) {
            return $dados->result_array();
        } else {
            return FALSE;
        }
    }
    public function getReceitasByPaciente($cpf,$cat,$cod_medico=NULL) {
        $this->db->select('REC.*,PES_MED.NOME AS MEDICO, MED.CRM, PES_PAC.NOME AS PACIENTE,PAC.CPF,EMP.NOME AS EMPRESA');
        $this->db->from('tcc_receita AS REC');
        
        $this->db->join('tcc_empresa AS EMP', 'EMP.CODIGO = REC.COD_EMPRESA');
        
        $this->db->join('tcc_medico AS MED', 'MED.CODIGO = REC.COD_MEDICO');
        $this->db->join('tcc_pessoa AS PES_MED', 'PES_MED.CODIGO = MED.CODIGO_PESSOA');
        
        $this->db->join('tcc_paciente AS PAC', 'PAC.CODIGO = REC.COD_PACIENTE');
        $this->db->join('tcc_pessoa AS PES_PAC', 'PES_PAC.CODIGO = PAC.CODIGO_PESSOA');
          $this->db->where('PAC.CPF',$cpf);  
        if ($cat==3){
            $this->db->where('REC.STATUS','1');  
            $this->db->where('REC.APROVACAO_PACIENTE','1');  
        }
       
          
      
         if ($cat==1){   
             $where = "(REC.STATUS_MEDICO='1' OR REC.COD_MEDICO='$cod_medico')";
             $this->db->where($where); 
              $where2 = "(REC.APROVACAO_PACIENTE='1' OR REC.COD_MEDICO='$cod_medico')";
             $this->db->where($where2);
          
        }
         $this->db->order_by("REC.CODIGO desc");   
        //$this->db->where('REC.COD_PACIENTE',$codPaciente);  
        
            
            
        $dados=$this->db->get();
       // echo $this->db->last_query();
       // die();
        if ($dados->num_rows > 0) {
            return $dados->result_array();
        } else {
            return FALSE;
        }
    }
    public function getListaReceitaByCod($codReceita) {
        $this->db->select('LIS.CODIGO,LIS.PRESCRICAO,MED.MEDICAMENTO,MFF.FORMA');
        $this->db->from('tcc_lista_remedio AS LIS');
        
        $this->db->join('tcc_medicamentos AS MED', 'MED.CODIGO = LIS.COD_REMEDIO');
        $this->db->join('medicamento_formafarma AS MFF', 'MFF.CODIGO = LIS.COD_FORMA');
//        
//        $this->db->join('tcc_medico AS MED', 'MED.CODIGO = REC.COD_MEDICO');
//        $this->db->join('tcc_pessoa AS PES_MED', 'PES_MED.CODIGO = MED.CODIGO_PESSOA');
//        
//        $this->db->join('tcc_paciente AS PAC', 'PAC.CODIGO = REC.COD_PACIENTE');
//        $this->db->join('tcc_pessoa AS PES_PAC', 'PES_PAC.CODIGO = PAC.CODIGO_PESSOA'); 
        
        $this->db->order_by("LIS.CODIGO asc");       
        $this->db->where('LIS.COD_RECEITA',$codReceita);  
        
            
            
        $dados=$this->db->get();
        
        if ($dados->num_rows > 0) {
            return $dados->result_array();
        } else {
            return FALSE;
        }
    }

    public function setNumero($id,$dados) {
         $this->db->where('CODIGO', $id);
        $this->db->update('tcc_receita', $dados);
      
    }
    public function getPermissao($cod_hash) {
         $this->db->select('REC.STATUS,REC.STATUS_MEDICO');
         $this->db->from('tcc_receita AS REC');
        $this->db->where('REC.COD_HASH',$cod_hash);  
        
            
            
        $dados=$this->db->get();
        
        if ($dados->num_rows > 0) {
            return $dados->row_array();
        } else {
            return FALSE;
        }
    }
    public function updateReceita($cod_hash,$dados) {
         $this->db->where('COD_HASH', $cod_hash);
        $this->db->update('tcc_receita', $dados);
    }

    /*
    public function loadCategoria(){
        $this->db->select('*');
        $this->db->from('categoria');
        $this->db->order_by("idCategoria asc");         
        $dados=$this->db->get();
        return $dados->result_array();
    }
    public function loadSubcategoria($idCategoria){
        $this->db->select('*');
        $this->db->from('subCategoria');
        $this->db->where('idCategoria',$idCategoria);
        $this->db->order_by("idSubcategoria asc");         
        $dados=$this->db->get();
        return $dados->result_array();
    }
    public function loadProdutosPorSubcategoria($idSubcategoria){
        $this->db->select('*');
        $this->db->from('produtos');
        $this->db->where('idSubcategoria',$idSubcategoria);
        $this->db->order_by("idProduto asc"); 
        
        $dados=$this->db->get();
        //echo $this->db->last_query();
        return $dados->result_array();
    }
    public function buscaNomeCatSubcat($idSubcategoria){
        $this->db->select('subCategoria.descricao as subcategoria,categoria.descricao as categoria');
        $this->db->from('subCategoria');
        $this->db->where('idSubcategoria',$idSubcategoria);
        $this->db->join('categoria', 'categoria.idCategoria = subCategoria.idCategoria');
        $this->db->order_by("idSubcategoria asc");         
        $dados=$this->db->get();
        return $dados->result_array();
    }
    public function loadAllProdutos(){
        
    }*/
}

//ALTER TABLE  `tcc_receita` ADD  `COD_EMPRESA` INT NOT NULL AFTER  `COD_PACIENTE` ;