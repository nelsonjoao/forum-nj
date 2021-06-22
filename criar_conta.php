<?php 

if(isset($_SESSION['nome_utilizador']) )
{
    helpers::redirect('inicio');
}

        $erro=false;
        $mensagem=null;
        $sucesso=false;
		$imagem='img1.jpg';
    if($_SERVER['REQUEST_METHOD']=='POST')
    { 

            if(!isset($_POST['txt_utilizador']) || !isset($_POST['txt_senha']) || !isset($_POST['txt_senha2']) )
            {
                $erro=true;
                $mensagem='Dados inválidos';
            }

            if($_POST['txt_senha'] != $_POST['txt_senha2'])
            {
                $erro=true;
                $mensagem='Senhas diferentes';
            }

            if( (isset($_FILES['file_imagem']['name]'])) && ( ($_FILES['file_imagem']['type'] != "image/jpeg") &&  ($_FILES['file_imagem']['type'] != "image/jpg")) )
            {
                $erro=true;
                $mensagem='Imagem inválida';
            }

            if($_FILES['file_imagem']['name'] != "")
            {
                $imagem=$_FILES['file_imagem']['name']; 
            }    
        
        if(!$erro)
            {
                $parms = [':nome' => $_POST['txt_utilizador'], ':senha' => $_POST['txt_senha']];

                $gestor=new gestor();
                $results = $gestor->EXE_QUERY("SELECT * FROM utilizadores WHERE nome = :nome AND senha = :senha",$parms);
                if(count($results)>0)
                {
                    $erro=true;
                    $mensagem='Conta já existente.';
                }     
            }

        if(!$erro)
        {
            $parms=[
                ':nome' => $_POST['txt_utilizador'],
                ':senha' => $_POST['txt_senha'],
                ':imagem' => $imagem
            ];

            $gestor = new gestor();
            $gestor->EXE_NON_QUERY("INSERT INTO utilizadores (nome,senha,imagem) VALUES (:nome,:senha,:imagem)",$parms);

            move_uploaded_file($_FILES['file_imagem']['tmp_name'],"assets/images/".$imagem);
            $sucesso=true;
            $mensagem="Conta criada com sucesso!";
        }
    }
?>

<div class="container-fluid back-azul mb-3">
    <div class="row">
        <div class="col-2 text-left p-3">
            <h4><strong>forumNJ</strong></h4> 
        </div>

        <div class="col-8 text-center p-3">
            <h5>A melhor plataforma para partilhar suas idéias!</h5> 
        </div>

        <div class="col-2 text-right p-3"></div>
    </div>
</div>

<div class="container mt-3">
<?php if($sucesso):?>
<div class="alert alert-success text-center"><?=$mensagem?></div>
<?php elseif($erro):?>
    <div class="alert alert-danger text-center"><?=$mensagem?></div>
<?php endif;?>
    <div class="row m-5 justify-content-center">
        <div class="col-sm-6 m-3 p-4 box-radius-azul">

          <div class="form-group text-center">
               <h4>Criar conta</h4>
            </div>   
            <form action="?a=criar_conta" method="post" enctype="multipart/form-data">
                <div class="form-group">
                <input type="text" name="txt_utilizador" class="form-control" placeholder="Utilizador" maxlength="50" minlength="3" required>
                </div>

                <div class="form-group">
                <input type="password" name="txt_senha" class="form-control" placeholder="Senha" maxlength="50" minlength="3" required>
                </div>

                <div class="form-group">
                <input type="password" name="txt_senha2" class="form-control" placeholder="Repita a senha" maxlength="50" minlength="3" required>
                </div>

                <div class="my-3">
                <small> Imagem: &nbsp;<input type="file" name="file_imagem"></small>
                </div>

                <div class="form-group text-center">
                <button role="submit" class="btn btn-primary btn-size-150"> Registar</button>
                </div>
            </form>
            <div class="text-center">
                <a href="?a=login">Voltar</a>
            </div>
        </div>
               
    </div>

</div>