<?php

// +----------------------------------------------------------------------+
// | BoletoPhp - Vers�o Beta                                              |
// +----------------------------------------------------------------------+
// | Este arquivo est� dispon�vel sob a Licen�a GPL dispon�vel pela Web   |
// | em http://pt.wikipedia.org/wiki/GNU_General_Public_License           |
// | Voc� deve ter recebido uma c�pia da GNU Public License junto com     |
// | esse pacote; se n�o, escreva para:                                   |
// |                                                                      |
// | Free Software Foundation, Inc.                                       |
// | 59 Temple Place - Suite 330                                          |
// | Boston, MA 02111-1307, USA.                                          |
// +----------------------------------------------------------------------+
// +----------------------------------------------------------------------+
// | Originado do Projeto BBBoletoFree que tiveram colabora��es de Daniel |
// | William Schultz e Leandro Maniezo que por sua vez foi derivado do	  |
// | PHPBoleto de Jo�o Prado Maia e Pablo Martins F. Costa			       	  |
// | 																	                                    |
// | Se vc quer colaborar, nos ajude a desenvolver p/ os demais bancos :-)|
// | Acesse o site do Projeto BoletoPhp: www.boletophp.com.br             |
// +----------------------------------------------------------------------+
// +----------------------------------------------------------------------+
// | Equipe Coordena��o Projeto BoletoPhp: <boletophp@boletophp.com.br>   |
// | Desenvolvimento Boleto Bradesco: Ramon Soares						            |
// +----------------------------------------------------------------------+

class Bradesco extends boletoFuncao{

// ------------------------- DADOS DIN�MICOS DO SEU CLIENTE PARA A GERA��O DO BOLETO (FIXO OU VIA GET) -------------------- //
// Os valores abaixo podem ser colocados manualmente ou ajustados p/ formul�rio c/ POST, GET ou de BD (MySql,Postgre,etc)	//
// DADOS DO BOLETO PARA O SEU CLIENTE
    public $prazoPagamento = 5;
  //  public $codigoBanco =   '237';
    public $taxa_boleto = 2.95;
    public $data_venc; //= date("d/m/Y", time() + ($this->dias_de_prazo_para_pagamento * 86400));  // Prazo de X dias OU informe data: "13/04/2006";
    public $valor_cobrado = "2950,00"; // Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal
    public $valor_boleto;
    public $dadosboleto = array();  // Nosso numero sem o DV - REGRA: M�ximo de 11 caracteres!
   // DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
    

// DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
//public $dadosboleto["quantidade"] = "001";
//public $dadosboleto["valor_unitario"] = $valor_boleto;
//public $dadosboleto["aceite"] = "";
//public $dadosboleto["especie"] = "R$";
//public $dadosboleto["especie_doc"] = "DS";
//
//
// ---------------------- DADOS FIXOS DE CONFIGURA��O DO SEU BOLETO --------------- //
// DADOS DA SUA CONTA - Bradesco
//public $dadosboleto["agencia"] = "1100"; // Num da agencia, sem digito
//public $dadosboleto["agencia_dv"] = "0"; // Digito do Num da agencia
//public $dadosboleto["conta"] = "0102003"; 	// Num da conta, sem digito
//public $dadosboleto["conta_dv"] = "4"; 	// Digito do Num da conta
// DADOS PERSONALIZADOS - Bradesco
//public $dadosboleto["conta_cedente"] = "0102003"; // ContaCedente do Cliente, sem digito (Somente N�meros)
//public $dadosboleto["conta_cedente_dv"] = "4"; // Digito da ContaCedente do Cliente
//public $dadosboleto["carteira"] = "06";  // C�digo da Carteira: pode ser 06 ou 03
// SEUS DADOS
// 
//public $dadosboleto["identificacao"] = "BoletoPhp - C�digo Aberto de Sistema de Boletos";
//public $dadosboleto["cpf_cnpj"] = "";
//public $dadosboleto["endereco"] = "Coloque o endere�o da sua empresa aqui";
//public $dadosboleto["cidade_uf"] = "Cidade / Estado";
//public $dadosboleto["cedente"] = "Coloque a Raz�o Social da sua empresa aqui";

    public function __construct() {
       
    }

//    public function getDadosBoleto() {
//        $this->setDadosOpcionais();
//        return $this->dadosboleto;
//    }
    public function gerarBoleto(){
        $this->setDadosOpcionais();
        $this->setDataVencimento();
         $this->dadosboleto['data_vencimento']  = $this->getDataVencimento(); // Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
         $this->dadosboleto['conta']=  $this->formata_numero($this->dadosboleto['conta'], 6, 0);
         
         $this->dadosboleto['conta_dv']=  $this->formata_numero($this->dadosboleto['conta_dv'], 1, 0);
         $this->dadosboleto['conta_cedente']=  $this->formata_numero($this->dadosboleto['conta_cedente'], 7, 0);
         $this->dadosboleto['conta_cedente_dv']=  $this->formata_numero($this->dadosboleto['conta_cedente_dv'], 1, 0);
         $this->agencia = $this->formata_numero( $this->dadosboleto['agencia'] , 4, 0); 
         //$this->dadosboleto['linha']=$this->getLinha($this->dadosboleto['carteira'],$this->dadosboleto['nosso_numero'],$this->getValor());
         $this->setFatorVencimento($this->getDataVencimento());
         $this->setDV($this->dadosboleto);
         $this->dadosboleto['linha']=  $this->getLinha();
         $this->dadosboleto['linhaDigitavel']=  $this->getLinhaDigitavel();
         $this->dadosboleto['nossoNumero']=$this->getNossoNumero();
         $this->dadosboleto['agenciaCodigo']=$this->getAgencia_Codigo();
         $this->getBarCode();
         $this->dadosboleto['barra']=$this->getBarras();
         
         
         
        return $this->dadosboleto;
    }
    public function setDadosBoleto($nosso_numero) {
        
        $dadosboleto["nosso_numero"] = $nosso_numero;  // Nosso numero sem o DV - REGRA: M�ximo de 11 caracteres!
        $dadosboleto["numero_documento"] = $nosso_numero; // Num do pedido ou do documento = Nosso numero
        $dadosboleto["data_vencimento"] = "";//$this->getDataVencimento(); // Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
        $dadosboleto["data_documento"] = date("d/m/Y"); // Data de emiss�o do Boleto
        $dadosboleto["data_processamento"] = date("d/m/Y"); // Data de processamento do boleto (opcional)
        $dadosboleto["valor_boleto"] = $this->getValorCobrado();  // Valor do Boleto - REGRA: Com v�rgula e sempre com duas casas depois da virgula
        $dadosboleto["codigo_banco_com_dv"]=$this->geraCodigoBancoDv($this->getCodigoBanco());
        $dadosboleto['linha']="";//$this->getLinha();
        $this->dadosboleto = array_merge($this->dadosboleto, $dadosboleto);
    }
    public function setDadosCliente($dadosCliente) {
        $this->dadosboleto = array_merge($this->dadosboleto, $dadosCliente);
    }

    public function setDemostrativo($dadosDemostrativo) {
        
            $dadosDemostrativoArray['demonstrativo']=$dadosDemostrativo;
            $dadosDemostrativo=$dadosDemostrativoArray;
        $this->dadosboleto = array_merge($this->dadosboleto, $dadosDemostrativo);
    }
    

    public function setInstrucoes($dadosInstrucoes) {
                    $dadosInstrucoesArray['instrucoes']=$dadosInstrucoes;
            $dadosInstrucoes=$dadosInstrucoesArray;
        
        $this->dadosboleto = array_merge($this->dadosboleto, $dadosInstrucoes);
    }
    public function setDadosOpcionais($quantidade=1,$aceite=" ",$especie="R$",$especie_doc="DS"){
        $dadosboleto["quantidade"] = $quantidade;
        $dadosboleto["valor_unitario"] = $this->getValor()/$quantidade;
        $dadosboleto["aceite"] = $aceite;
        $dadosboleto["especie"] = $especie;
        $dadosboleto["especie_doc"] = $especie_doc;
        $this->dadosboleto = array_merge($this->dadosboleto, $dadosboleto);
    
    }
    public function setDadosConta($dadosConta){      
        
        $this->dadosboleto = array_merge($this->dadosboleto, $dadosConta);
    }
    public function setDadosEmpresa($dadosEmpresa){
        $this->dadosboleto = array_merge($this->dadosboleto, $dadosEmpresa);
    }
    public function setDataVencimento() {
        $this->data_venc = date("d/m/Y", time() + ($this->getPrazoPagamento() * 86400));  // Prazo de X dias OU informe data: "13/04/2006";
    }

    private function getDataVencimento() {
        return $this->data_venc;
    }

    public function getValorCobrado() {
        return $this->valor_boleto = number_format($this->valor_cobrado + $this->getTaxaBoleto(), 2, ',', '');
    }

    public function setValor($valor) {
        $this->valor_cobrado = str_replace(",", ".", $valor);
        $this->valor_cobrado = $valor;
    }

    public function getValor() {
        return $this->valor_cobrado;
    }

    public function setTaxaBoleto($valor) {
        $this->taxa_boleto = $valor;
    }

    public function getTaxaBoleto() {
        return $this->taxa_boleto;
    }
    public function  setPrazoPagamento($dias){
         $this->prazoPagamento=$dias;
    }
    private function getPrazoPagamento(){
        return $this->prazoPagamento;
    }

}

// N�O ALTERAR!
$dados = new Bradesco();

// include("include/funcoes_bradesco.php");
// include("include/layout_bradesco.php");
?>
