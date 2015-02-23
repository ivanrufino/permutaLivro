<?php
$codigo= $receita['cod_hash'];
$this->load->view('phpqrcode/qrlib.php');
QRcode::png("Olá Visitante!!!","assets/qrcodes/".$codigo.".png");
?>

