<?php

if (!defined('BASEPATH')) 
    exit('No direct script access allowed');

class Home_model extends CI_Model {
    public function query(){
            $query = $this->db->query("select * from medicamento ");

          return  $query->result_array(); 
    }
    public function detentor($med){
        $query = $this->db->query("select  * from tcc_medicamentos2 join detentor on DESCRICAO=DETENTOR where GENERICO like '$med' ");

          return  $query->result_array(); 
    }
     public function concentracao($med){
        $query = $this->db->query("select  distinct(`GENERICO`),`CONCENTRACAO` from tcc_medicamentos2 where GENERICO like '$med' ");
       // die($this->db->last_query());
          return  $query->result_array(); 
    }
     public function forma($med){
        $query = $this->db->query("select  distinct(`GENERICO`),`FORMA_FARMACEUTICA` from tcc_medicamentos2 where GENERICO like '$med' ");
       // die($this->db->last_query());
          return  $query->result_array(); 
    }
    public function insertMedDet($codMedicamento,$codDetentor){
        $data = array(
            'COD_MEDICAMENTO' => $codMedicamento ,
            'COD_DETENTOR' => $codDetentor ,
            
        );

            $this->db->insert('medicamentodetentor', $data); 
    }
    public function insertMedForma($codMedicamento,$forma){
        $data = array(
            'COD_MEDICAMENTO' => $codMedicamento ,
            'FORMA' => $forma ,
            
        );

            $this->db->insert('medicamento_formafarma', $data); 
    }
      public function insertMedconcetracao($codMedicamento,$conc){
        $data = array(
            'COD_MEDICAMENTO' => $codMedicamento ,
            'CONCENTRACAO' => $conc ,
            
        );

            $this->db->insert('medicamento_concentracao', $data); 
    }
    
}

