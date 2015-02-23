<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mensagens
 *
 * @author imartins
 */
class Mensagens {
    public function getMessage($tipo, $parametros=null){ /*alterado*/
        $dados['atencao']="<strong>Atenção<br></strong>"; 
        $dados['']="";
        $dados['pedidoGravadoSemUsuario']=$dados['atencao']."Nenhum usuário possui este livro <br>sua solicitação foi registrada, assim que um usuário disponibilizar este livro você será avisado.";
        $dados['pedidoGravado']="Pedido gravado com sucesso."; 
        $dados['rastreioInserido']=$dados['atencao']."Código de Rastreio inserido com sucesso."; 
        $dados['estanteGravado']="Livro inserido na estante com sucesso."; 
        $dados['pedidoExistente']= $dados['atencao']."Sua solicitação já existe no sistema, por favor verifique em seus pedidos.";
        $dados['falhaGravacao']=$dados['atencao']."Houve uma falha na gravação, por favor tente novamente";
        $dados['saldoZerado']="Você não tem saldo suficiente para solicitar Livros<br>";
        $dados['enderecoImcompleto']="Complete seu endereço para ganhar um ponto.";        
        $dados['ativacaoSucesso']="Seu cadastro foi ativado com sucesso.<br>Utilize os dados de acesso para entrar no sistema. <br>";
        $dados['ativacaoErro']="Houve uma falha na ativação do seu cadastro, por favor entre em contato com o desenvolvedor.<br>";
        $dados['usuarioNaoEncontrado']=$dados['atencao']."Este usuário nao existe. <br> Caso já tenha efetuado o cadastro certifique-se de ter ativado seu cadastro no email enviado.";
        $dados['cadastroRealizado']="Cadastro realizado com sucesso.<br>Utilize seu email e senha para entrar no sistema.<br>Não esqueça de ativar a sua conta pelo email que foi enviado.";
        //$dados['solicitacaoLivro']="O usuario $parametros[usuario_para] solicitou o livro $parametros[livro]";
        $dados['solicitacaoLivro']="Você recebeu uma solicitação de livro.
                                    Clique no link para gerenciar seus pedidos.<br>
                                    <a href='{base_url}meusPedidos/recebidos'>Gerenciar Pedido </a>";
        $dados['semRecados']='<div class="alert alert-danger">'.$dados['atencao'].' Você não tem nenhum recado. <br><br></div>';
        $dados['semRecadosNovos']='<div class="alert alert-info">'.$dados['atencao'].' Você não tem novos recados. <br><br><a href="meus_recados" >ir para recados</a></div>';
        $dados['RecadosNovos']='<div class="alert alert-info">'.$dados['atencao'].'Você tem <strong>'.$parametros.'</strong> novo(s) recado(s). <br><br><a href="meus_recados" >ir para recados</a></div>';
        $dados['pedidoAceito'] = "<div class='alert alert-info'>".$dados['atencao']."Você aceitou a solicitação de pedido.<br>Fique atento ao prazo de 3 dias para enviar por correio e inserir o codigo de rastreio no sistema.</div>";
        $dados['pedidoAceitoPara'] ="Um livro que você solicitou foi aceitou pelo usuário.<br> Aguarde o envio de mesmo no prazo máximo de 3 dias<br>
                                    Clique no link para gerenciar seus pedidos.<br>
                                    <a href='{base_url}meusPedidos/em_andamento'>Gerenciar Pedido </a>";
        $dados['pedidoRecusado'] = "<div class='alert alert-danger'>".$dados['atencao']."Você recusou a solicitação de pedido.<br>O usuário solicitante será informado.</div>";
        $dados['pedidoRecusadoPara'] = "".$dados['atencao']."Um livro que você solicitou foi recusado pelo usuario.<br>
                                    Clique no link para gerenciar seus pedidos.<br>
                                    <a href='{base_url}meusPedidos/recusado'>Gerenciar Pedido </a>";
        $dados['codigoRastreioVazio'] ="<div class='alert alert-warning'>".$dados['atencao']."O código de rastreio não pode estar vazio.</div>" ;
         $dados['rastreioInseridoPara'] = "".$dados['atencao']."Um livro que você solicitou foi enviado para você.<br>
                                    para rastrear a encomenda clique no link abaixo, e após clique sobre o livro solicitado.<br>
                                    <a href='{base_url}meusPedidos/em_andamento'>Gerenciar Pedido </a>";
        $dados['novoLivro']="<strong>Parabens.</strong><br>Foi adcionado um novo livro em sua Estante Virtual.";
        
        $dados['livroEnviado']=$dados['atencao']."O livro enviado chegou ao destinatário.";
        $dados['saldoAtualizado']=$dados['atencao']."Seu saldo foi atualizado.";
        $dados['livroRemovido']=$dados['atencao']."O livro enviado foi removido de sua estante Estante Virtual.";
        $dados['confirmaEntrega']= "A confirmação da entrega já foi realizada!";
         return $dados[$tipo];
    }
}
