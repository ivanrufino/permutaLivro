<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cron extends CI_Controller {

    public $css = null;
    public $js = null;

    public function __construct() {
        parent::__construct();
     //   $this->css = array('bootstrap', 'menu', 'small-business', 'painel_user', 'tabs', 'hover', '../lighter/css/lighter');
     //   $this->js = array('jquery-1.10.2', 'bootstrap', 'funcoesComuns', 'jquery.maskedinput.min', 'jquery.dataTables.min', 'jquery.form.min');
        //$this->load->helper();
      //  $this->load->model('home_model', 'home');
        //$this->load->dbforge();
    }

    public function updateDataBase() {
        $this->load->helper('file');
        $string = read_file('migrates/migrate.sql');
         
         echo "<pre>";
        echo $string;
        echo "</pre>";
         
       // $sql=  explode(";", $string);
        
       // $this->db->query($sql['1']);
        
    }
    public function update($file) {
         $this->load->helper('file');
        $string = read_file("migrates/$file");
        $this->db->query($string);
    }
    function execcron()
   { 
      // evita uma chamada via navegador
     // if ( isset( $_SERVER['REMOTE_ADDR'] ) ) die( 'Chamada de um Browser.' );
      // aqui tarefas a serem executadas
     // SELECT * FROM pedido where DATA_ACEITACAO < DATE_SUB(now(),INTERVAL 2 DAY) and `COD_RASTREIO` ="" 
     // $quali_data=array('COD_USUARIO'=>'1','TITULO'=>'1','QUANTIDADE'=>'50');
     // $this->db->insert('qualificacao', $quali_data);
      echo "cheghe";
   }

}

/* End of file home.php */
/* Location: ./application/controllers/cron.php */