<?php
class users_data
{
    public static function getAllUsers()
    {
        $gestor = new gestor();
        return $gestor->EXE_QUERY("SELECT * FROM utilizadores");
    }

    public static function getUserById($id)
    {
        $gestor = new gestor();
        $user = $gestor->EXE_QUERY("SELECT * FROM utilizadores WHERE id_utilizador=$id");
        return $user[0];
    }

    public static function AtualizarSessao()
    {
        $gestor = new gestor();
        $user = $gestor->EXE_QUERY("SELECT * FROM utilizadores WHERE id_utilizador = ".$_SESSION['id_utilizador']);

        $_SESSION['nome_utilizador']=$user[0]['nome'];
        $_SESSION['imagem_utilizador']=$user[0]['imagem'];
    }
}
?>