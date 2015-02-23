<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pasta_Model extends CI_Model {
    
    public function logar($dados){
        $this->db->select('*');
        $this->db->from('tcc_pessoa AS PES');
        /*$this->db->join($dados['categoria']. ' AS CAT', 'CAT.CODIGO_PESSOA = PES.CODIGO');*/
        $this->db->where('LOGIN',$dados['usuario']);  
        $this->db->where('SENHA',  md5($dados['senha']));  
        $sql=$this->db->get();
        
        if($sql->num_rows > 0){
            return $sql->row_array();
        }else{
            return FALSE;
        }
        
    }
    public function buscarPasta($raiz=NULL){
        $this->db->select('*');
        $this->db->from('pasta');
        $this->db->order_by("CODIGO asc");  
         $this->db->where('PASTA_MAE',$raiz);
//        if(!is_null( $codigo)){
//            $this->db->where('CODIGO',$codigo);  
//        }
        $dados=$this->db->get();
        return $dados->result_array();
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

