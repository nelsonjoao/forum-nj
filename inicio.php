<?php
if(!isset($_GET['a']) || !isset($_SESSION['a']) || !isset($_SESSION['nome_utilizador']) )
helpers::redirect('login');

$erro=false;
$mensagem=null;
$sucesso=false;
//--------------------------------------------------------------------------------
//OBS FALTOU VALIDAR CASO OS IDES PASSADOS VIA GET NÃO EXISTAM NA BD
//-------------------------------------------------------------------------------
if(isset($_GET['id_comentario']))
    {
        $gestor = new gestor();
        $gestor->EXE_NON_QUERY("DELETE FROM comentarios WHERE id_comentario=".$_GET['id_comentario']);
        helpers::redirect("inicio");
    }

    if(isset($_GET['id_post_deleted']))
    {
        $gestor = new gestor();
        $gestor->EXE_NON_QUERY("DELETE FROM posts WHERE id_post=".$_GET['id_post_deleted']);
        helpers::redirect("inicio");
    }

if($_SERVER['REQUEST_METHOD']=='POST')
{
    if(!isset($_POST['txt_comentario']))
    {
        $erro=true;
        helpers::redirect("inicio");
    }

    $id_post='';
    if(isset($_GET['id_post']))
    {
           $id_post=$_GET['id_post'];
    } 
    else 
    {
        $erro=true;
    }
    if(!$erro)
    {
        $params=[
            ':comentario' => $_POST['txt_comentario'],
            ':id_utilizador' => $_SESSION['id_utilizador'],   
            ':id_post' =>  $id_post
        ];

        $gestor = new gestor();
        $gestor->EXE_NON_QUERY("INSERT INTO comentarios (comentario,id_utilizador,id_post) VALUES (:comentario,:id_utilizador,:id_post)",$params);
        helpers::redirect("inicio");
    } 
}

$gestor = new gestor();
$posts=$gestor->EXE_QUERY("SELECT p.id_post, p.titulo, p.post, p.id_utilizador, p.criado_em, u.imagem, u.nome FROM posts as p join utilizadores as u on u.id_utilizador=p.id_utilizador order by p.id_post desc");
$comentarios=$gestor->EXE_QUERY("SELECT * FROM comentarios");
?>

<div class="container-fluid my-3">
    <div class="container box-radius-azul p-3">
        <div class="row">
            <div class="col-sm-8 offset-sm-2 text-center"><h4 class="cor-azul">Seja bem-vindo ao forumNJ. Partilhe o que pensa!</h4></div>
            <div class="col-sm-2 text-center"><a href="?a=add_post" class="btn btn-primary">Publicar</a></div>
        </div>
    </div>
</div>

<?php foreach($posts as $post):?>
    <div class="container-fluid my-3">
        <div class="container box-radius pad-20">
            
                        <img src="assets/images/<?=$post['imagem']?>" class="img-border mr-2" width="60px">
                        <span class="cor-azul"><?=$post['nome']?></span>
                        <br>
                        <p class="mt-2">Titulo -> <strong><?=$post['titulo']?></strong></p>
                        <hr>

                        <?php $corpo_msg = $post['post']; 
                            $id=$post['id_post']; 
                        ?>
                        <input type="hidden" id="post_hidden_<?=$post['id_post']?>" value="<?=$post['post']?>">
                        <small id="sml_post_<?=$post['id_post']?>"><?=mb_strimwidth($post['post'],0,400,'<a href="#" onclick="altera_post('.$id.')" return false>...Ver mais</a>')?></small>
                        <hr>

                    <div class="row">

                        <div class="col-sm-6 text-left">
                            <small><?=$post['criado_em']?></small>
                        </div>  
                        
                        <div class="col-sm-6 text-right">
                            <?php if($post['id_utilizador']==$_SESSION['id_utilizador']):?>
                            <a href="?a=editar_post&id_post=<?=$post['id_post']?>">Editar</a> |
                            <a href="?a=inicio&id_post_deleted=<?=$post['id_post']?>">Eliminar</a> |
                            <?php endif;?>

                            <?php 
                            $countComment=0;
                            foreach($comentarios as $commentRow)
                            {
                                if($post['id_post']==$commentRow['id_post'])
                                 $countComment++;
                            }?>
                                <a href=""  data-toggle="collapse" data-target="#comentario_<?=$post['id_post']?>">Cometários <?=($countComment!=0)?('('.$countComment.')'):('')?></a>
                        </div> 
                        
                    </div>
    
         

                <div class="collapse" id="comentario_<?=$post['id_post']?>">
                     <hr>
                     <form action="?a=inicio&id_post=<?=$post['id_post']?>" method="post">

                            <?php foreach($comentarios as $comentario):?>
                                <?php if($post['id_post']==$comentario['id_post']):?>
                                <div >
                                    <label class="cor-azul">
                                        <?php 
                                        $user = users_data::getUserById($comentario['id_utilizador']);
                                        echo $user['nome'];?>
                                     </label><br>

                                    <small><?=$comentario['comentario']?></small>
                                    
                                    <?php if($comentario['id_utilizador']==$_SESSION['id_utilizador'] || $post['id_utilizador']==$_SESSION['id_utilizador']):?>
                                        <div class="text-right">
                                            <a href="?a=inicio&id_comentario=<?=$comentario['id_comentario']?>"><small>Eliminar comentário</small></a>
                                        </div>
                                    <?php endif;?>
                                    <hr>
                                </div>
                                <?php endif;?>
                            <?php endforeach;?>

                            <div class="form-group">
                                    <label>Comentar:</label>
                                    <textarea rows="2" name="txt_comentario" class="custom-scroll form-control" required></textarea> 
                            </div>
                        <button role="submit" class="btn btn-primary">Comentar</button> 
                     </form>
                </div>
        </div>
    </div>
<?php endforeach; ?>



