<?php
if(!isset($_SESSION['a']) || !isset($_SESSION['nome_utilizador']) )
helpers::redirect('login');

if($_GET['a']=='editar_perfil')
{
    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        if(!isset($_POST['txt_nome']))
        helpers::redirect('inicio');

        $file_imagem=$_FILES['file_imagem'];

        $gestor = new gestor();

        if($file_imagem['name']!="" && !is_null($file_imagem['name']) )
        {
            $params = [
                ':nome' => $_POST['txt_nome'],
                ':imagem' => $file_imagem['name'],
                ':id_utilizador' => $_SESSION['id_utilizador']
            ];
            $gestor->EXE_NON_QUERY("UPDATE utilizadores SET nome = :nome, imagem = :imagem WHERE id_utilizador = :id_utilizador",$params);
            move_uploaded_file($file_imagem['tmp_name'],'assets/images/'.$file_imagem['name']);
            users_data::AtualizarSessao();
        }else{
            $params = [
                ':nome' => $_POST['txt_nome'],
                ':id_utilizador' => $_SESSION['id_utilizador']
            ];
            $gestor->EXE_NON_QUERY("UPDATE utilizadores SET nome = :nome WHERE id_utilizador = :id_utilizador",$params);
            users_data::AtualizarSessao();
        }
    }
    
}
elseif($_GET['a']=='eliminar_perfil')
{
    $gestor = new gestor();
    $gestor->EXE_NON_QUERY("DELETE FROM utilizadores WHERE id_utilizador =".$_SESSION['id_utilizador']);
    helpers::DestroiSessao();
    helpers::redirect('login');
}
?>
<div class="container-fluid my-3">
<div class="container box-radius pad-20">
        <div>

            <div> 
            <div class="row text-center my-3">
                <div class="col" >
                 <h3 class="cor-azul"><?=$_SESSION['nome_utilizador']?></h3>
                </div>  
            </div>    
           
            <div class="row text-center my-3">
            <div class="col" >
                <img src="assets/images/<?=$_SESSION['imagem_utilizador']?>" class="img-border" width="300px">
                </div>  
            </div>
            </div>

            
            <hr>
            <form action="?a=editar_perfil" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label>Nome:</label>
                <input type="text" name="txt_nome" class="form-control" value="<?=$_SESSION['nome_utilizador']?>" required>
            </div>

            <div class="form-group">
            <a href=""  data-toggle="collapse" data-target="#editar_foto">Editar foto</a>
            </div>

            <div class="collapse" id="editar_foto">
                <div class="form-group">
                    Imagem: &nbsp;<input type="file" name="file_imagem">
                </div>
            </div>

           
                <div class="row">
                    <div class="col-sm-6 text-left">
                            <button role="submit" class="btn btn-primary btn-size-100">Editar</button> 
                            <a href="?a=inicio" class="btn btn-primary btn-size-100">Cancelar</a> 
                    </div>

                    <div class="col-sm-6 text-right mt-2">
                            <a href="?a=eliminar_perfil" class="text-danger">Eliminar conta</a> 
                    </div>
                </div>

                </form>

        </div>
  
   
    </div>
</div>
