<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* 
| ------------------------------------------------------------------- 
| EMAIL CONFING 
| ------------------------------------------------------------------- 
| Configuration of outgoing mail server. 
| */
$config['protocol'] = 'smtp';
$config['smtp_host'] = 'ssl://smtp.googlemail.com';  
$config['smtp_port'] = '465';  
$config['smtp_timeout'] = '30';  
$config['smtp_user'] = 'forisu.1000@gmail.com';  
$config['smtp_pass'] = 'isuadmin./!';
$config['charset'] = 'utf-8';
$config['mailtype'] = 'html';
$config['wordwrap'] = TRUE;
$config['newline'] = "\r\n";
/* End of file email.php */  
/* Location: ./system/application/config/email.php */
?>