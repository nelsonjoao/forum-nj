<?php

if(!isset($_SESSION['a']))
exit();


$a='inicio';
if(isset($_GET['a']))
$a=$_GET['a'];


switch ($a) {
     case 'login': include_once('login.php'); break;
    case 'criar_conta': include_once('criar_conta.php'); break; 
    case 'inicio': include_once('inicio.php'); break;
    case 'editar_post': include_once('post.php'); break;
    case 'add_post': include_once('post.php'); break;
    case 'perfil':include_once('perfil.php');break;
    case 'editar_perfil':include_once('perfil.php');break;
    case 'eliminar_perfil':include_once('perfil.php');break;
    case 'usuarios':include_once('usuarios.php');break;
    case 'logout': { helpers::DestroiSessao(); helpers::redirect('login'); break;}
}

?>