<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Livro_Model extends CI_Model {

    public function getLivrobyTitulo($titulo) {
        $this->db->select('*');
        $this->db->from('livro as LIV');
        $this->db->like('LIV.TITULO', $titulo);
        $sql = $this->db->get();        
        if ($sql->num_rows > 0) {
            return $sql->result_array();
        } else {
            return FALSE;
        }
    }    
    public function getLivrobyAutor($autor) {
        $this->db->select('*');
        $this->db->from('livro as LIV');
        $this->db->like('LIV.AUTOR', $autor);
        $sql = $this->db->get();
        if ($sql->num_rows > 0) {   
            return $sql->result_array();
        } else {
            return FALSE;
        }
    }    
    public function getLivrobyEditora($editora) {
        $this->db->select('*');
        $this->db->from('livro as LIV');
        $this->db->like('LIV.EDITORA', $editora);
        $sql = $this->db->get();
        if ($sql->num_rows > 0) {
            return $sql->result_array();
        } else {
            return FALSE;
        }
    }    
    public function getLivrobyIsbn($isbn) {
        $this->db->select('*');
        $this->db->from('livro as LIV');
        $this->db->like('LIV.ISBN', $isbn);
        $sql = $this->db->get();
        if ($sql->num_rows > 0) {
            return $sql->result_array();
        } else {
            return FALSE;
        }
    }
    public function getLivrobyCodigo($codigo) {
        $this->db->select('*');
        $this->db->from('livro as LIV');
        $this->db->like('LIV.CODIGO', $codigo);
        $sql = $this->db->get();
        if ($sql->num_rows > 0) {
            return $sql->row_array();
        } else {
            return FALSE;
        }
    }  
    public function novoLivro($dados) {
        if ($this->db->insert('livro', $dados)) {
            return $this->db->insert_id();
        } else {
            return null;
        }
    }
    public function getAutores() {
        $this->db->select('AUTOR');
        $this->db->from('livro as LIV');
        $sql = $this->db->get();
        
        if ($sql->num_rows > 0) {
            return $sql->result_array();
        } else {
            return FALSE;
        }
    }
    public function getEditora() {
        $sql =$this->db->query("SELECT DISTINCT(EDITORA) FROM livro order by EDITORA ASC");
       // $sql = $this->db->get('livro');
       // echo $this->db->last_query();die();
        if ($sql->num_rows > 0) {
            return $sql->result_array();
        } else {
            return FALSE;
        }
    }
    
    public function getLastInserted($cod_usuario,$quantidade=5,$dias=105) {
        $where ="SELECT COD_LIVRO FROM estantevirtual WHERE COD_USUARIO = $cod_usuario UNION SELECT COD_LIVRO FROM pedido WHERE COD_USUARIO_PARA = $cod_usuario";
        $where_and ="`DATA_CADASTRO` > DATE_ADD(NOW(), INTERVAL -$dias DAY)";
        $this->db->select('LIV.*');
        $this->db->from('v_livros as LIV');
        $this->db->limit($quantidade);
        //$this->db->join('estantevirtual as EST', 'EST.COD_LIVRO <> LIV.CODIGO');
        $this->db->where_not_in('LIV.CODIGO',$where);
        $this->db->where($where_and);
        $this->db->order_by('LIV.CODIGO DESC');
        $sql = $this->db->get();
       // echo $this->db->last_query();die();
        if ($sql->num_rows > 0) {
            return $sql->result_array();
        } else {
            return FALSE;
        }
        /*SELECT LIV.* FROM v_livros as LIV WHERE CODIGO NOT IN (
SELECT COD_LIVRO FROM estantevirtual WHERE COD_USUARIO = 1048
UNION
SELECT COD_LIVRO FROM pedido WHERE COD_USUARIO_PARA = 1048
)
AND `DATA_CADASTRO` > DATE_ADD(NOW(), INTERVAL -300 DAY) ORDER BY `LIV`.`CODIGO` DESC LIMIT 5*/
    }
    public function maislidos($quantidade=5) {
        
        $this->db->select('*,CAPA AS FOTO,COUNT(COD_LIVRO) AS QUANTIDADE');
        $this->db->from('v_estante as vest');
        $this->db->limit($quantidade);
        $this->db->where_in('STATUS',array('1','2'));
        $this->db->group_by("COD_LIVRO"); 
        $this->db->order_by('QUANTIDADE DESC');
        $sql = $this->db->get();
     //   echo $this->db->last_query();die();
        if ($sql->num_rows > 0) {
            return $sql->result_array();
        } else {
            return FALSE;
        }
    }
}
//SELECT DISTINCT(EDITORA) FROM `livro` order by EDITORA ASC