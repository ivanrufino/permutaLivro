<?php
$local=$_SERVER['HTTP_HOST'];

if($local=="localhost"){
    $config['protocol'] = 'smtp';
}else{
    $config['protocol'] = 'mail';
}
$config['smtp_host'] = 'ssl://smtp.gmail.com';
$config['smtp_port'] = '465';
$config['smtp_timeout'] = '7';
$config['smtp_user'] = 'ivan.rufino.m@gmail.com';
$config['smtp_pass'] = '098789akuma2010';

$config['newline'] = "\r\n";
$config['mailpath'] = '/usr/sbin/sendmail';
$config['mailtype'] = 'html';
$config['charset'] = 'utf-8';
$config['wordwrap'] = TRUE;

