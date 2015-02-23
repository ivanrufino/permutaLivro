<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of my_boleto
 *
 * @author Ivan
 */
class My_excel {
    public $banco;
    public function My_excel() {
        require_once('excel/reader.php');
       
    }
//    public function bradesco(){
//        
//        
//    }
//    public function getNome(){
//        return "Ivan";
//    }
//    public function setBanco($banco){
//        $this->banco=new $banco();
//        return $this->banco;
//    }
//    public function setValor($valor){
//        $this->banco->setValor($valor);
//        //$this->valor_cobrado=$valor;
//    }
}
