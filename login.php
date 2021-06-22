<?php
if(isset($_SESSION['nome_utilizador']) )
helpers::redirect('inicio');
   $erro=false;
   $mensagem=null;
   $sucesso=false;

    if($_SERVER['REQUEST_METHOD']=='POST')
    {
            if(!isset($_POST['txt_utilizador']) || !isset($_POST['txt_senha']))
            {
                $erro=true;
                $mensagem='Login inválidos';
            }

            if(!$erro)
            {
                $parms = [':nome' => $_POST['txt_utilizador'], ':senha' => $_POST['txt_senha']];
                $gestor=new gestor();
                $results = $gestor->EXE_QUERY("SELECT * FROM utilizadores WHERE nome = :nome AND senha = :senha",$parms);
                if(count($results)==1)
                {
                    helpers::IniciarSessao($results);
                    helpers::redirect('inicio');
                  
                }else{
                    $erro=true;
                    $mensagem='Login inválido.';
                }
                
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
<?php if($erro):?>
    <div class="alert alert-danger text-center"><?=$mensagem?></div>
<?php endif;?>
    <div class="row m-5 justify-content-center">
        <div class="col-sm-6 m-3 p-4 box-radius-azul">
          <div class="form-group text-center">
               <h4>Login</h4>
            </div>   
            <form action="?a=login" method="post">
                <div class="form-group">
                <input type="text" name="txt_utilizador" class="form-control" placeholder="Utilizador" maxlength="50" minlength="3" required>
                </div>

                <div class="form-group">
                <input type="password" name="txt_senha" class="form-control" placeholder="Senha" maxlength="50" minlength="3" required>
                </div>

                <div class="form-group text-center">
                <button role="submit" class="btn btn-primary btn-size-150"> Login </button>
                </div>
            </form>
            <div class="text-center">
                <a href="?a=criar_conta">Criar conta</a>
            </div>
        </div>
               
    </div>

</div>