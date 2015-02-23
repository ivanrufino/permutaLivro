<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Config_Model extends CI_Model {

    public function getEstado() {
        $this->db->select('*');
        $this->db->from('tcc_estado as EST');
        $sql = $this->db->get();

        if ($sql->num_rows > 0) {
            return $sql->result_array();
        } else {
            return FALSE;
        }
    }

    public function getCidade($cod_estado) {
        $this->db->select('*');
        $this->db->from('tcc_cidade as cid');
        $this->db->where('COD_ESTADO', $cod_estado);
        $sql = $this->db->get();
        if ($sql->num_rows > 0) {
            return $sql->result_array();
        } else {
            return FALSE;
        }
    }
     public function getNovas() {
        $this->db->select('*');
        $mydate = date('Y-m-d H:i:s');
        $this->db->select("TIME_TO_SEC(TIMEDIFF('$mydate', EST.DATA )) as TEMPO");
        $this->db->where('STATUS', '0');
        $this->db->from('novas as EST');
        $this->db->order_by('DATA ASC');
        $sql = $this->db->get();

        if ($sql->num_rows > 0) {
            return $sql->result_array();
        } else {
            return FALSE;
        }
    }

}
