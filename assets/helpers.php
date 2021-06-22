<?php
//namespace assets;
class helpers
{

    public static function VerificarLogin()
    {
        $resultado=false;
        if(isset($_SESSION['id_utilizador']))
        $resultado=true;

        return $resultado;
        echo $resultado;
    }

    public static function VerificarLoginCliente()
    {
        $resultado=false;
        if(isset($_SESSION['id_cliente']))
        $resultado=true;

        return $resultado;
        echo $resultado;
    }

   
    public static function IniciarSessao($dados)
    {
        $_SESSION['id_utilizador']=$dados[0]['id_utilizador'];
        $_SESSION['nome_utilizador']=$dados[0]['nome'];
        $_SESSION['imagem_utilizador']=$dados[0]['imagem'];
       //$_SESSION['permissoes']=$dados[0]['permissoes'];
       
    }

    public static function DestroiSessao()
    {
        unset($_SESSION['id_utilizador']);
        unset($_SESSION['nome_utilizador']);
        unset($_SESSION['imagem_utilizador']);
        //unset($_SESSION['permissoes']);
    }

    public static function redirect($rota='')
    {
        header("Location: ".$config['BASE_URL']."?a=$rota");
        
    }
}

?>