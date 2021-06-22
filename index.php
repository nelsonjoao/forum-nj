<?php

//index
session_start();
 
if(isset($_SESSION['nome_utilizador']))
$_SESSION['a']='inicio';
else
$_SESSION['a']='login';

include_once('assets/helpers.php');
include_once('assets/datas.php');
include_once('assets/gestor.php');
include_once('classes/users_data.php');
$config=include_once('assets/config.php');

if(isset($_SESSION['nome_utilizador']))
{
    include_once('_html_header.php');
    include_once('_header.php');
    include_once('routes.php');
    include_once('_footer.php');
    include_once('_html_footer.php');
}
else{
    include_once('_html_header.php');
    include_once('routes.php');
    include_once('_html_footer.php');
}


?>