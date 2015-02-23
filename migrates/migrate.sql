UPDATE `usuario`
SET `EMAIL` = REPLACE(`EMAIL`, 'paciente', 'usuario');


CREATE TABLE IF NOT EXISTS `mensagem` (
  `CODIGO` int(11) NOT NULL AUTO_INCREMENT,
  `COD_USUARIO` int(11) NOT NULL,
  `TITULO` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `MENSAGEM` text COLLATE utf8_unicode_ci NOT NULL,
  `LIDO` tinyint(4) NOT NULL DEFAULT '0',
  `DATA_CADASTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`CODIGO`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

ALTER TABLE  `estantevirtual` CHANGE  `STATUS`  `STATUS` TINYINT( 4 ) NOT NULL DEFAULT  '0' COMMENT  '0:NAO_LIDO, 1:LIDO, 2:LENDO';
ALTER TABLE  `livro` ADD  `FOTO` VARCHAR( 60 ) NOT NULL DEFAULT  'semcapa.jpg' AFTER  `ISBN`


UPDATE `livro`
SET `AUTOR` = REPLACE(`AUTOR`, ' & ', ',');

UPDATE  `u762709049_tcc`.`livro` SET  `AUTOR` =  'Allan Pease,Barbara Pease' WHERE  `livro`.`CODIGO` in(335,301,120,119,103,14);

ALTER TABLE  `pedido` CHANGE  `COD_USUARIO_DE`  `COD_USUARIO_DE` INT( 11 ) NULL DEFAULT NULL COMMENT 'Quando esta null, é por que não tem nenhum usuário com este livro ou o usuario que tem recusou a solicitação';

UPDATE  `usuario` SET  `SENHA` =  '7c4a8d09ca3762af61e59520943dc26494f8941b';
ALTER TABLE  `usuario` ADD  `STATUS` INT NOT NULL DEFAULT  '0' AFTER  `ENDERECO`;
UPDATE  `usuario` SET  `STATUS` =  '1';

--
-- Estrutura para visualizar `v_estante`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`u762709049_tcc`@`localhost` SQL SECURITY DEFINER VIEW `v_estante` AS select `EST`.`CODIGO` AS `CODIGO`,`EST`.`STATUS` AS `STATUS`,`EST`.`ESCOPO` AS `ESCOPO`,`EST`.`FOTO` AS `FOTO`,`EST`.`OBS` AS `OBS`,`LIV`.`CODIGO` AS `COD_LIVRO`,`LIV`.`TITULO` AS `TITULO`,`LIV`.`AUTOR` AS `AUTOR`,`LIV`.`FOTO` AS `CAPA`,`LIV`.`EDITORA` AS `EDITORA`,`USU`.`CODIGO` AS `COD_USUARIO`,`USU`.`NOME` AS `NOME`,`USU`.`EMAIL` AS `EMAIL`,`USU`.`FOTO` AS `FOTO_USUARIO` from ((`estantevirtual` `EST` join `livro` `LIV` on((`LIV`.`CODIGO` = `EST`.`COD_LIVRO`))) join `usuario` `USU` on((`USU`.`CODIGO` = `EST`.`COD_USUARIO`))) where (`EST`.`ESCOPO` = 1);

--
-- VIEW  `v_estante`
-- Dados: Nenhum
--
/*
SELECT usuario.CODIGO,usuario.ENDERECO,endereco.CODIGO AS COD_ENDERECO,endereco.COD_USUARIO FROM `usuario` 
left join endereco on endereco.codigo = usuario.ENDERECO
WHERE endereco.COD_USUARIO IS NULL
ORDER BY `usuario`.`CODIGO`  DESC
*/