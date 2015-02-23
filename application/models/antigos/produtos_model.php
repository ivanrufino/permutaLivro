<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Produtos_Model extends CI_Model {

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
        
    }
}

