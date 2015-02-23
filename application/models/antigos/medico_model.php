<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Medico_Model extends CI_Model {

    public function getMedico($codigoPessoa = null) {//busca pelo codigo da pessoa
        $ret = 'result_array';
        $this->db->select('MED.*,PES.NOME,PES.LOGIN,PES.TELEFONE,PES.CELULAR,PES.EMAIL,EMP.LOGO,EMP.CODIGO AS COD_EMPRESA');
        $this->db->from('tcc_medico as MED');
        $this->db->join('tcc_pessoa as PES', 'PES.CODIGO = MED.CODIGO_PESSOA');
        $this->db->join('tcc_medicoempresa AS MEP', 'MEP.COD_MEDICO = MED.CODIGO','left');
        $this->db->join('tcc_empresa AS EMP', 'EMP.CODIGO = MEP.COD_EMPRESA','left');
        if (!is_null($codigoPessoa)) {
            $this->db->where('MED.CODIGO_PESSOA', $codigoPessoa); //NAO MODIFICAR ESTA LINHA, CODIGO FOI ALTERADO PARA CODIGO_PESSOA E DEVE MANTER-SE ASSIM
            $ret = 'row_array';
        }
        $sql = $this->db->get();
//        echo $this->db->last_query();
//        die();
        if ($sql->num_rows > 0) {
            return $sql->$ret();
        } else {
            return NULL;
        }
    }
     public function getMedicobyCodigo($codigo = null,$comEmpresa=TRUE) {//busca pelo codigo do medico
        $ret = 'result_array';
        $this->db->select('MED.*,PES.NOME,PES.LOGIN');
        $this->db->from('tcc_medico as MED');
        $this->db->join('tcc_pessoa as PES', 'PES.CODIGO = MED.CODIGO_PESSOA');
        if($comEmpresa==TRUE){
             $this->db->select('EMP.LOGO');
            $this->db->join('tcc_medicoempresa AS MEP', 'MEP.COD_MEDICO = MED.CODIGO');
            $this->db->join('tcc_empresa AS EMP', 'EMP.CODIGO = MEP.COD_EMPRESA');
        }
        if (!is_null($codigo)) {
            $this->db->where('MED.CODIGO', $codigo); //NAO MODIFICAR ESTA LINHA, CODIGO FOI ALTERADO PARA CODIGO_PESSOA E DEVE MANTER-SE ASSIM
            $ret = 'row_array';
        }
        $sql = $this->db->get();
        //echo $this->db->last_query();
        if ($sql->num_rows > 0) {
            return $sql->$ret();
        } else {
            return NULL;
        }
    }
public function getMedicoByCrm($crm = null) {
        $ret = 'result_array';
        $this->db->select('MED.*,PES.NOME,PES.LOGIN,PES.EMAIL');
        $this->db->from('tcc_medico as MED');
        $this->db->join('tcc_pessoa as PES', 'PES.CODIGO = MED.CODIGO_PESSOA');
        /*$this->db->join('tcc_medicoempresa AS MEP', 'MEP.COD_MEDICO = MED.CODIGO');
        $this->db->join('tcc_empresa AS EMP', 'EMP.CODIGO = MEP.COD_EMPRESA');*/
        if (!is_null($crm)) {
            $this->db->where('MED.CRM', $crm);
            $ret = 'row_array';
        }
        $sql = $this->db->get();
        
        if ($sql->num_rows > 0) {
            return $sql->$ret();
        } else {
            return NULL;
        }
    }
    public function getMedicoByEmpresa($cod_empresa) {
        $this->db->select('MED.*,PES.NOME,PES.LOGIN,PES.EMAIL');
        $this->db->from('tcc_medicoempresa AS EMP');
        $this->db->join('tcc_medico as MED', "MED.CODIGO = EMP.COD_MEDICO ");
        $this->db->join('tcc_pessoa as PES', 'PES.CODIGO = MED.CODIGO_PESSOA');
         $this->db->where('EMP.COD_EMPRESA', $cod_empresa);
        $sql = $this->db->get();
        //return $this->db->last_query();
       // echo $this->db->last_query();die();
        if ($sql->num_rows > 0) {            
            return $sql->result_array();
        } else {
            return null;
        }
    }
    public function getEspecialidadeMedico($codMedico,$codEspecialidade=null){
        $this->db->select('ESP.NOME AS ESPECIALIDADE,ESP.CODIGO');
        $this->db->from('tcc_especialidade AS ESP');
        $this->db->join('tcc_medicoespecialidade as MES', "MES.COD_ESPECIALIDADE = ESP.CODIGO ");
        
         $this->db->where('MES.COD_MEDICO', $codMedico);
         if (!is_null($codEspecialidade)){
            $this->db->where('MES.COD_ESPECIALIDADE', $codEspecialidade);
         }
        $sql = $this->db->get();
        //echo $this->db->last_query();
        //die();
        if ($sql->num_rows > 0) {            
            return $sql->result_array();
        } else {
           return null;
        }
    }
    public function getEspecialidades(){ 
        $this->db->select('ESP.NOME AS ESPECIALIDADE,ESP.CODIGO');
        $this->db->from('tcc_especialidade AS ESP');
       // $this->db->join('tcc_medicoespecialidade as MES', "MES.COD_ESPECIALIDADE = ESP.CODIGO ");
        //$this->db->join('tcc_pessoa as PES', 'PES.CODIGO = MED.CODIGO_PESSOA');
        $sql = $this->db->get();
        //echo $this->db->last_query();
        //die();
        if ($sql->num_rows > 0) {            
            return $sql->result_array();
        } else {
           return null;
        }
    }
    public function novaEspecialidadeMedico($codMedico,$codEspecialidade){
        $existe = $this->getEspecialidadeMedico($codMedico, $codEspecialidade);
        if (is_null($existe)){
            $dadosMedicoEspecialidade=array('COD_MEDICO'=>$codMedico,'COD_ESPECIALIDADE'=>$codEspecialidade);
            if ($this->db->insert('tcc_medicoespecialidade', $dadosMedicoEspecialidade)){
                return $this->db->insert_id();
            }else{
                return null;
            }
        }
        
    }
    public function novoMedico($dados){
        if ($this->db->insert('tcc_pessoa', $dados)){
            $dadosMedico['CODIGO_PESSOA']=  $this->db->insert_id();
             $dadosMedico['CRM']= $dados['LOGIN'];
            if ($this->db->insert('tcc_medico', $dadosMedico)){
                return $this->db->insert_id();
            }else{
                return null;
            }
        }else{
            return null;
        }
    }
    public function vincularMedico($dadosMedico) {
        $codMedicoEmpresa = $this->getMedicosbyEmpresa($dadosMedico['COD_EMPRESA'], $dadosMedico['COD_MEDICO']);
        if(is_null($codMedicoEmpresa)){
            if ($this->db->insert('tcc_medicoempresa', $dadosMedico)) {
                return $this->db->insert_id();
            } else {
                return null;
            }
        }else{
            return $codMedicoEmpresa[0]['CODIGO'];
        }
    }
    public function gravarAgenda($dados){
        if ($this->db->insert('tcc_agenda', $dados)) {
            return $this->db->insert_id();
        } else {
            return null;
        }
    }
    public function alterarAgenda($codigo,$dados){
        $this->db->where('CODIGO', $codigo);
        
      if (  $this->db->update('tcc_agenda', $dados)) {
          
            return TRUE;
        } else {
          
            return null;
        }
    }
    public function getMedicoEmpresa($codEmpresa,$codMedico){
        //$this->db->select("*");
        $this->db->where('COD_MEDICO', $codMedico);
        $this->db->where('COD_EMPRESA', $codEmpresa);
        
         $sql = $this->db->get("tcc_medicoempresa");
      //  echo $this->db->last_query();
        if ($sql->num_rows > 0) {            
            return $sql->row_array();
        } else {
           return NULL;
        }
                
    }
    public function desvincularMedico($codEmpresa,$codMedico) {
        $codMedicoEmpresa=  $this->getMedicoEmpresa($codEmpresa, $codMedico);
        if($this->removerAgenda($codMedicoEmpresa)){
            $this->db->where('COD_MEDICO', $codMedico);
            $this->db->where('COD_EMPRESA', $codEmpresa);
            if($this->db->delete('tcc_medicoempresa')){
                return TRUE;
            } 
        }
        return FALSE;
      //  print_r($codMedicoEmpresa);
    }
    public function removerAgenda($codMedicoEmpresa) {
        $this->db->where('COD_MEDICO_EMPRESA', $codMedicoEmpresa['CODIGO']);
        if($this->db->delete('tcc_agenda')){
            return TRUE;
        } 
         return false;
        
       
    }
    public function getAgendaByMedico($codMedico){
         $this->db->select("AGE.*,MEP.COD_EMPRESA,PES.NOME,EMP.NOME AS NOME_EMPRESA");
        $this->db->where('COD_MEDICO', $codMedico);
        $this->db->join('tcc_medicoempresa as MEP', " AGE.COD_MEDICO_EMPRESA =MEP.CODIGO ");
        $this->db->join('tcc_empresa as EMP', "MEP.COD_EMPRESA =EMP.CODIGO ");
        $this->db->join('tcc_medico as MED','MEP.COD_MEDICO = MED.CODIGO');
        //$this->db->where('MED.CODIGO', $codMedico);
        
        $this->db->join('tcc_pessoa as PES', "MED.CODIGO_PESSOA =PES.CODIGO");
        $sql = $this->db->get("tcc_agenda as AGE");
     //   echo $this->db->last_query();
       // die();
        if ($sql->num_rows > 0) {            
            return $sql->result_array();
        } else {
           return NULL;
        }
    }
    public function getAgendaByEmpresa($codEmpresa){
        //IMPLEMENTAR
    }
    public function getAgendaByMedicoEmpresa($codMedicoEmpresa,$dia=null){
        $this->db->select('AGE.*');
        $this->db->from('tcc_agenda AS AGE');
        $this->db->join('tcc_medicoempresa as TME', "TME.CODIGO = AGE.COD_MEDICO_EMPRESA ");
        $this->db->where('AGE.COD_MEDICO_EMPRESA', $codMedicoEmpresa);
        if (!is_null($dia)){
            $this->db->where('AGE.DIA ', $dia);
        }
        
         $sql = $this->db->get();
        
        if ($sql->num_rows > 0) {            
            return $sql->result_array();
        } else {
           return NULL;
        }
        
    }
    public function getAgendaDisponivel($codMedico,$codEmpresa,$diaSemana,$horaInicio,$horaFim){
        $this->db->select('AGE.*');
        $this->db->from('tcc_agenda AS AGE');
        $this->db->join('tcc_medicoempresa as TME', "TME.CODIGO = AGE.COD_MEDICO_EMPRESA ");
        
        $this->db->where('TME.COD_MEDICO', $codMedico);
        $this->db->where('TME.COD_EMPRESA <>', $codEmpresa);
        $this->db->where('AGE.DIA', $diaSemana);
        $this->db->where("((($horaInicio  BETWEEN HORA_ENTRADA AND HORA_SAIDA-1) OR ($horaFim  BETWEEN HORA_ENTRADA+1 AND HORA_SAIDA-1))
                OR ((HORA_ENTRADA BETWEEN $horaInicio AND $horaFim-1)OR (HORA_SAIDA BETWEEN $horaInicio+1 AND $horaFim)))"               
                );
        
        
        $sql = $this->db->get();
        
        if ($sql->num_rows == 0) {            
            return true;
        } else {
           return false;
        }
    }
    public function getMedicosbyEmpresa($codEmpresa,$codMedico=null){
         $this->db->select('*');
         $this->db->from('tcc_medicoempresa as TME');
         $this->db->where('TME.COD_EMPRESA', $codEmpresa);
         if(!is_null($codMedico)){
             $this->db->where('TME.COD_MEDICO', $codMedico);
         }
        $sql = $this->db->get();
        
        if ($sql->num_rows > 0) {            
            return $sql->result_array();
        } else {
           return null;
        }
    }
    public function getEmpresaByMedico($codMedico){
       date_default_timezone_set("Brazil/East");
        $hora_atual=date('H');        
        $dia=  $this->diaSemanaString(date('N'));//'terca';
        
         $this->db->select('EMP.*');
         $this->db->from('tcc_medicoempresa as TME');
         $this->db->join('tcc_agenda as AGE', 'AGE.COD_MEDICO_EMPRESA = TME.CODIGO');
         $this->db->join('tcc_empresa as EMP', 'EMP.CODIGO = TME.COD_EMPRESA');
         
        $this->db->where('AGE.HORA_ENTRADA <=',$hora_atual );
        
         
         $this->db->where('AGE.dia ',$dia );
         $this->db->order_by('AGE.HORA_ENTRADA desc');   
         $this->db->limit('1');
        
         $this->db->where('TME.COD_MEDICO', $codMedico);
         
        $sql = $this->db->get();
       // die($this->db->last_query());
        if ($sql->num_rows > 0) {            
            return $sql->result_array();
        } else {
           return null;
        }
    }
    public function diaSemanaString($dia){
        switch ($dia) {
            case 1: $diaString='segunda';
                break;
            case 2: $diaString='terca';
                break;
            case 3: $diaString='quarta';
                break;
            case 4: $diaString='squinta';
                break;
            case 5: $diaString='sexta';
                break;
            case 6: $diaString='sabado';
                break;
            case 7: $diaString='domingo';
                break;
        }
        return $diaString;
    }
    public function updateMedico($dados,$id){
        $this->db->where('CODIGO', $id);
        if ($this->db->update('tcc_medico', $dados)) {
            return TRUE;
        } else {
            return null;
        }
    }
    
    /*public function updatePessoa($dados,$id){
        $this->db->where('CODIGO', $id);
       
        if ( $this->db->update('tcc_pessoa as PES', $dados)) {
            return TRUE;
        } else {
            return null;
        }
    }*/
    public function updatePessoa($dados,$id){
        $this->db->set($dados);
        $this->db->where('tcc_medico.CODIGO',$id);
        //$this->db->where('table2.poll_id',$row);
       if( $this->db->update('tcc_pessoa join tcc_medico ON tcc_medico.CODIGO_PESSOA= tcc_pessoa.CODIGO')){
//           echo $this->db->last_query();
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
/*ALTER TABLE  `tcc_medico` ADD  `FOTO` VARCHAR( 50 ) NOT NULL DEFAULT  'medico.png';
         */