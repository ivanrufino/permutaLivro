DROP TRIGGER IF EXISTS `plus_saldo`;
DELIMITER //
CREATE TRIGGER `plus_saldo` AFTER INSERT ON `endereco`
 FOR EACH ROW BEGIN
UPDATE saldo
   SET valor = valor + 10
 WHERE COD_USUARIO = NEW.COD_USUARIO;

END
//
DELIMITER ;

ALTER TABLE  `pedido` ADD  `MODO_ENTREGA` TINYINT NOT NULL DEFAULT  '1' AFTER  `COD_LIVRO`

CREATE TABLE `chat` (
 `CODIGO` int(11) NOT NULL AUTO_INCREMENT,
 `COD_PEDIDO` int(11) NOT NULL,
 `COD_USUARIO` int(11) NOT NULL,
 `COD_USUARIO_PARA` int(11) NOT NULL,
 `MENSAGEM` text COLLATE utf8_unicode_ci NOT NULL,
 `DATA_HORA` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
 PRIMARY KEY (`CODIGO`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci

CREATE ALGORITHM = UNDEFINED VIEW  `v_chat` AS SELECT chat.CODIGO, chat.MENSAGEM, chat.DATA_HORA, chat.COD_PEDIDO, pedido.COD_USUARIO_DE, pedido.COD_USUARIO_PARA
FROM  `chat` 
JOIN pedido ON chat.COD_PEDIDO = pedido.CODIGO


CREATE TABLE `admin` (
 `CODIGO` int(11) NOT NULL AUTO_INCREMENT,
 `NOME` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
 `EMAIL` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
 `SENHA` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
 `DATA_CADASTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
 PRIMARY KEY (`CODIGO`),
 UNIQUE KEY `CODIGO` (`CODIGO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci

CREATE TABLE `redes` (
 `CODIGO` int(11) NOT NULL AUTO_INCREMENT,
 `NOME` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
 `ID` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
 `SECRET` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
 PRIMARY KEY (`CODIGO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci

INSERT INTO `tcc`.`admin` (`CODIGO`, `NOME`, `EMAIL`, `SENHA`, `DATA_CADASTRO`) VALUES (NULL, 'Ivan Rufino Martins', 'ivan.rufino.m@hotmail.com.br', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2015-04-01 00:00:00');

INSERT INTO `tcc`.`redes` (`CODIGO`, `NOME`, `ID`, `SECRET`) VALUES (NULL, 'Facebook', '755823537846565', 'bb2ba923ee25e0ce2740803721a14e5f'), (NULL, 'Google', '1099466398618-49j6i6f1emp10pjjjkftqufhc9f6fe4g.apps.googleusercontent.com', 'H8tCITF_ELbSAdOsyS89cQNQ'), (NULL, 'Instagram', 'b96dc8b4b4eb4964bb522ca88246a1d7', '4b522ebaad9d47d28d1cdca83185d890'), (NULL, 'Windowslive', '0000000048145D2E', 'tNg6gGXoeTNIkGc3JeUWhFhRppuCKVoB'), (NULL, 'Linkedin', '756r2651ty0u1q', '7Vz2PPGBsLChwd4U'), (NULL, 'Github', 'ac3e705eb1a6fc9f017e', 'f23063916c478fa6f97374ac445204af993b880e');

ALTER TABLE  `redes` ADD  `SCOPE` TEXT NOT NULL

UPDATE  `tcc`.`redes` SET  `SCOPE` =  'a:1:{i:0;s:4:"user";}' WHERE  `redes`.`CODIGO` =6;


CREATE DEFINER=`root`@`localhost` EVENT `deleteRemovidos` ON SCHEDULE EVERY 10 SECOND STARTS '2015-02-03 17:21:34' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM `pedido` WHERE STATUS=3$$

CREATE DEFINER=`root`@`localhost` EVENT `deleteRemovidos2` ON SCHEDULE EVERY 1 DAY STARTS '2015-02-03 00:00:01' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM `pedido` WHERE STATUS=3$$

CREATE DEFINER=`root`@`localhost` EVENT `deletePedidosNaoEnviados` ON SCHEDULE EVERY 1 DAY STARTS '2015-02-03 00:00:01' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM `pedido`  where `COD_RASTREIO` ="" and `MODO_ENTREGA`='1' and DATEDIFF(`DATA_ACEITACAO`,CURDATE() ) < 5$$

ALTER TABLE  `estantevirtual` ADD  `GOSTO` BOOLEAN NULL DEFAULT NULL AFTER  `ESCOPO`

-- 2015-06-01
CREATE TABLE `preferencias` (
 `cod_usuario` int(11) NOT NULL,
 `genero` int(11) NOT NULL,
 `autor` int(11) DEFAULT NULL,
 `editora` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
 KEY `cod_usuario` (`cod_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE OR REPLACE 
ALGORITHM = UNDEFINED
VIEW  `v_preferencias` AS 
SELECT U.NOME, G.NOME AS GENERO, A.NOME AS AUTOR, L.EDITORA AS EDITORA
FROM  `preferencias` P
JOIN usuario U ON P.cod_usuario = U.CODIGO
JOIN genero G ON P.genero = G.CODIGO
LEFT JOIN autor A ON P.autor = A.CODIGO
LEFT JOIN livro L ON P.editora LIKE L.EDITORA;

-- 2015-06-02
CREATE OR REPLACE 
ALGORITHM = UNDEFINED
VIEW  `v_quantidadeGeneroPorUsuario` AS 
SELECT COD_USUARIO, NOME, COD_GENERO, GENERO, COUNT( COD_GENERO ) AS QUANT
FROM v_estante
GROUP BY COD_USUARIO, COD_GENERO
ORDER BY QUANT DESC;
UPDATE  `livro` SET  `COD_GENERO` =13 WHERE  `COD_GENERO` IN ( 14, 15, 11, 20, 19 )

--2015-06-02
CREATE TABLE `grafo` (
 `COD_USUARIO1` int(11) NOT NULL,
 `COD_USUARIO2` int(11) NOT NULL,
 `PRODUTO` int(11) NOT NULL,
 `EXTRA` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
 KEY `COD_USUARIO1` (`COD_USUARIO1`,`COD_USUARIO2`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE OR REPLACE ALGORITHM = UNDEFINED VIEW  `v_grafo` AS SELECT g.COD_USUARIO1, u1.NOME AS USUARIO1, g.COD_USUARIO2, u2.NOME AS USUARIO2, g.PRODUTO
FROM  `grafo` g
JOIN usuario u1 ON u1.CODIGO = g.COD_USUARIO1
JOIN usuario u2 ON u2.CODIGO = g.COD_USUARIO2
order by `g`.`COD_USUARIO1`,`g`.`PRODUTO`
;


ALTER TABLE  `grafo` ADD UNIQUE (
`COD_USUARIO1` ,
`COD_USUARIO2`
);