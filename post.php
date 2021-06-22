<?php
if(!isset($_SESSION['a']) || !isset($_GET['a'])  || !isset($_SESSION['nome_utilizador']) )
helpers::redirect('login');


$add=false;
$operacao=$_GET['a'] ;

$erro=false;
$mensagem=null;
$sucesso=false;

$titulo='';
$post='';

if($_GET['a'] == 'add_post')
{ 
   $add=true;
   $titulo_header='Adicionar';
  
   if($_SERVER['REQUEST_METHOD']=='POST')
   {
        if(!isset($_POST['txt_titulo']) || !isset($_POST['txt_post']) )
        {
            $erro=true;
            $mensagem='Preencha os campos corretamente';
        }

        if(!$erro)
        {
            $params=[
                ':titulo' => $_POST['txt_titulo'],
                ':post' => $_POST['txt_post'],
                ':id_utilizador' => $_SESSION['id_utilizador']
            ];

            $gestor = new gestor();
            $gestor->EXE_NON_QUERY("INSERT INTO posts (titulo,post,id_utilizador) VALUES (:titulo,:post,:id_utilizador)",$params);

            helpers::redirect('inicio');
        }
   }

}elseif($_GET['a'] == 'editar_post' && isset($_GET['id_post'])){
   
    $add=false;
    $titulo_header='Editar';
    $id_post=$_GET['id_post'];
    
    $gestor = new gestor();
    $params = [':id_post' =>  $id_post];
    $user = $gestor->EXE_QUERY("SELECT id_utilizador FROM posts WHERE id_post = :id_post",$params);
    
    if(count($user)==1)
    {
         if($user[0]['id_utilizador']!=$_SESSION['id_utilizador'])
         helpers::redirect('inicio');
    }else  helpers::redirect('inicio');
   

    $gestor = new gestor();
    $params = [':id_post' =>  $id_post, ':id_utilizador' => $_SESSION['id_utilizador']];
    $results = $gestor->EXE_QUERY("SELECT * FROM posts WHERE id_post = :id_post AND id_utilizador = :id_utilizador",$params );

    if(count($results)==1)
    {
        $titulo=$results[0]['titulo'];
        $post=$results[0]['post'];

        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            if(!isset($_POST['txt_titulo']) || !isset($_POST['txt_post']))
            helpers::redirect('inicio');

            $gestor = new gestor();
            $params = [
                ':titulo' => $_POST['txt_titulo'], 
                ':post' => $_POST['txt_post'], 
                ':id_utilizador' => $_SESSION['id_utilizador'],
                'id_post' => $id_post
            ];
            $gestor->EXE_NON_QUERY('UPDATE posts SET titulo = :titulo ,post = :post WHERE id_utilizador = :id_utilizador AND id_post = :id_post',$params);
            helpers::redirect('inicio');
        }
    }
    else helpers::redirect('inicio');
}

?>
<div class="container-fluid ">
<div class="container box-radius my-3 pad-20">
        
        <div>
                    <div>
                        <h4 class="cor-azul text-center"><?=$titulo_header?> Publicação</h4>
                        <img src="assets/images/<?=$_SESSION['imagem_utilizador']?>" class="img-border" width="60px">
                        <span class="cor-azul titulo-post ml-2"><strong><?=$_SESSION['nome_utilizador']?></strong></span>
                    </div>
                <hr>
                <form action="<?php  if($operacao=='add_post') echo '?a='.$operacao; elseif ($operacao=='editar _post') echo '?a='.$operacao.'&id_post='.$id_post;?>" 
                method="post">
                            <div class="form-group">
                                <label>Titulo:</label>
                                <input type="text" name="txt_titulo" class="form-control" value="<?=$titulo?>" required>
                            </div>

                            <div class="form-group">
                                        <label><?=$titulo_header?> publicação:</label>
                                        <textarea rows="4" name="txt_post" class="custom-scroll form-control" required><?=$post?></textarea> 
                            </div>
                            
                                <button role="submit" class="btn btn-primary btn-size-100"><?=$titulo_header?></button> 
                                <a href="?a=inicio" class="btn btn-primary btn-size-100">Cancelar</a> 
                       
                </form>
        </div>
  
   
    </div>
</div>
