<?php

if (!defined('BASEPATH')) 
    exit('No direct script access allowed');

class EstanteVirtual_Model extends CI_Model {
    public function getLivros($cod_usuario,$status=NULL,$escopo=NULL) {
        $this->db->where('COD_USUARIO', $cod_usuario );  
        if (!is_null($status)){
            $this->db->where('STATUS', $status );  
        }
        if (!is_null($escopo)){
            $this->db->where('ESCOPO', $escopo );  
        }
        $sql=$this->db->get('v_estante'); 
        
        if($sql->num_rows > 0){
            return $sql->result_array();
        }else{ 
            return array();
        }
    }
    public function getLivrosbyCodLivro($cod_usuario,$codLivro) { 
        /*Busca um determinado livro do usuario logado*/
        $this->db->select('*');
        $this->db->from('estantevirtual AS evi');                         
        $this->db->where('COD_USUARIO', $cod_usuario ); 
        $this->db->where('COD_LIVRO', $codLivro ); 
        $sql=$this->db->get(); 
        
        if($sql->num_rows > 0){
            return $sql->row_array();
        }else{ 
            return FALSE;
        }
    }
    public function getLivrosTodos($codLivro,$exceto_eu=false) {
        /*Busca um determinado livro de todos os usuario*/
        $this->db->select('EVI.*,USU.CODIGO AS COD_USUARIO, USU.NOME,USU.FOTO,USU.ID_REDE,USU.LINK_REDE,USU.FOTO_REDE,END.*');
        $this->db->from('estantevirtual AS EVI');                         
        $this->db->where('ESCOPO', '1' ); 
        $this->db->where('COD_LIVRO', $codLivro ); 
        if($exceto_eu){
            $this->db->where('EVI.COD_USUARIO <>', $exceto_eu ); 
        }
        $this->db->join('usuario as USU', 'USU.CODIGO = EVI.COD_USUARIO');
        $this->db->join('endereco as END', 'END.COD_USUARIO = USU.CODIGO','left');
        $sql=$this->db->get(); 
        //echo $this->db->last_query();die();
        if($sql->num_rows > 0){
            return $sql->result_array();
        }else{ 
            return FALSE;
        }
        //SELECT `EVI`.*, `USU`.`CODIGO` AS COD_USUARIO, `USU`.`NOME`, `USU`.`FOTO`, `END`.* FROM (`estantevirtual` AS EVI) JOIN `usuario` as USU ON `USU`.`CODIGO` = `EVI`.`COD_USUARIO` JOIN `endereco` as END ON `END`.`CODIGO` = `USU`.`ENDERECO` WHERE `ESCOPO` = '1' AND `COD_LIVRO` = 9 AND `EVI`.`COD_USUARIO` <> '1042'
    }
        public function livrosDisponiveis($cod_usuario) {
         //$this->db->select('*');
        
        $this->db->where('COD_USUARIO_PARA', $cod_usuario); 
        $sql=$this->db->get('v_pedidospendentesdisponiveis'); 
        
        if($sql->num_rows > 0){
            return $sql->result_array();
        }else{ 
            return FALSE;
        }
    }
    public function novoLivro($dados){
        if ($this->getLivrosbyCodLivro($dados['COD_USUARIO'],$dados['COD_LIVRO'])){
            return 'existe';
        }
        
        if ($this->db->insert('estantevirtual', $dados)){
                return $this->db->insert_id();
            }else{
                return false;
            }
    }
    public function alterarEstante($cod_usuario, $dados) {
        $this->db->where('COD_USUARIO', $cod_usuario);
        $this->db->where('COD_LIVRO', $dados['COD_LIVRO']);
        if ($this->db->update('estantevirtual', $dados)) {
            //return true;
        } else {
            //return false;
        }
        return $this->db->last_query();
    }
    public function getUsuarioPerfilIgual($cod_usuario,$amigos,$limit=5) { //MESMA QUANTIDADE DE LIVROS
      //  $cod_usuario='1043';
       
        $listAmigos = implode(',', $amigos);
        $query="SELECT  COUNT(COD_LIVRO) AS QUANTIDADE ,VU.CODIGO, VU.NOME,VU.EMAIL,VU.LINK_REDE,VU.NOME_REDE, VU.FOTO_REDE,VU.FOTO AS FOTO_USUARIO,TITULO_QUALIFICACAO AS QUALIFICACAO,VU.CIDADE,VU.ESTADO "
                . "FROM `v_estante` JOIN v_usuario VU on VU.CODIGO = v_estante.COD_USUARIO "
                . "WHERE `COD_USUARIO` <> $cod_usuario AND ";
        if(count($amigos)>0){
                $query .= "`COD_USUARIO` NOT IN ($listAmigos) AND";
        }
                $query.= "`COD_LIVRO` IN (SELECT COD_LIVRO FROM v_estante WHERE COD_USUARIO = $cod_usuario)
                    
                GROUP BY COD_USUARIO  HAVING QUANTIDADE > 0 ORDER BY QUANTIDADE DESC, v_estante.NOME ASC LIMIT $limit";
        $sql=$this->db->query($query);
      //  echo $this->db->last_query();die();
        if($sql->num_rows > 0){
            return $sql->result_array();
        }else{ 
            return array();
        }
    }
    public function getUsuarioPerfilGeneroIgual($cod_usuario,$generos,$amigos,$limitTotal=10) {
        $dados=array();
        
        if($generos){
        $total = 0;
            foreach($generos as $num => $genero) {
            $total += $genero[ 'QUANTIDADE' ];
        }
        foreach ($generos as $genero) {   
            $limit = round($genero['QUANTIDADE']/$total*$limitTotal);
            $this->db->select('COUNT(GE.CODIGO) AS QUANTIDADE,USU.CODIGO,USU.NOME,USU.EMAIL,USU.LINK_REDE,USU.NOME_REDE, USU.FOTO_REDE,USU.FOTO AS FOTO_USUARIO,TITULO_QUALIFICACAO AS QUALIFICACAO,USU.CIDADE,USU.ESTADO');
            $this->db->from('estantevirtual as ES');
            $this->db->join('v_usuario as USU','USU.CODIGO = ES.COD_USUARIO');
            $this->db->join('livro as LI', 'LI.CODIGO = ES.COD_LIVRO');
            $this->db->join('genero as GE', 'GE.CODIGO = LI.COD_GENERO');
            $this->db->where('GE.CODIGO',$genero['CODIGO']);
            if(count($amigos)>0){
                $this->db->where_not_in('USU.CODIGO',$amigos);
            }
            $this->db->where('USU.CODIGO <>',$cod_usuario);
            $this->db->group_by("USU.CODIGO"); 
            $this->db->order_by('QUANTIDADE','DESC');
            $this->db->limit($limit);

            $sql=$this->db->get();
          
        
        //echo $this->db->last_query();die();
            if($sql->num_rows > 0){
                
                $dados= array_merge($dados, $sql->result_array());
            }
            $sql->free_result();
        }
        }
       
        return $dados ;
          /*SELECT USU.CODIGO,USU.NOME,COUNT(GE.CODIGO) AS QUANTIDADE
from estantevirtual ES 
JOIN usuario USU ON USU.CODIGO = ES.COD_USUARIO 
JOIN livro LI ON LI.CODIGO = ES.COD_LIVRO
JOIN genero GE ON GE.CODIGO = LI.COD_GENERO

WHERE GE.CODIGO IN (10)
and USU.CODIGO <>1048
 GROUP BY USU.CODIGO
 ORDER BY QUANTIDADE DESC
LIMIT 2*/
    }
    public function getGenerosByUsuario($cod_usuario,$limit=10) { 
        $this->db->select('USU.NOME,GE.CODIGO,COUNT(GE.CODIGO) AS QUANTIDADE');
        $this->db->from('estantevirtual as ES');
        $this->db->join('usuario as USU','USU.CODIGO = ES.COD_USUARIO');
        $this->db->join('livro as LI', 'LI.CODIGO = ES.COD_LIVRO');
        $this->db->join('genero as GE', 'GE.CODIGO = LI.COD_GENERO');
        
        $this->db->where('ES.COD_USUARIO',$cod_usuario);
        $this->db->group_by("GE.CODIGO"); 
        $this->db->order_by('QUANTIDADE','DESC');
        $this->db->limit($limit);
        
        $sql=$this->db->get(); 
        //echo $this->db->last_query();die();
        if($sql->num_rows > 0){
            return $sql->result_array();
        }else{ 
            return FALSE;
        }
        
      
        
        
        /*SELECT USU.NOME,GE.CODIGO, count(GE.CODIGO) AS QUANTIDADE from estantevirtual ES 
JOIN usuario USU ON USU.CODIGO = ES.COD_USUARIO 
JOIN livro LI ON LI.CODIGO = ES.COD_LIVRO
JOIN genero GE ON GE.CODIGO = LI.COD_GENERO

WHERE COD_USUARIO = 1048
GROUP BY GE.CODIGO
ORDER BY QUANTIDADE DESC
LIMIT 2*/
    }
   
}
  /*SELECT *,  COUNT(COD_LIVRO) AS QUANTIDADE  FROM `v_estante` WHERE `COD_USUARIO` <> 1043 and `COD_LIVRO` IN (SELECT COD_LIVRO FROM v_estante WHERE COD_USUARIO = 1043)
GROUP BY COD_USUARIO  HAVING QUANTIDADE > 1 ORDER BY QUANTIDADE DESC, NOME ASC LIMIT 15*/
