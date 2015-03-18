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