<?php
if(!isset($_SESSION['a']) || !isset($_SESSION['nome_utilizador']) )
helpers::redirect('login');
$users = users_data::getAllUsers();
?>
<div class="container-fluid my-3">
    <div class="container box-radius pad-20">
        
            <h4 class="cor-azul text-center">Utilizadores</h4>
            <hr>

            <div class="m-2 p-3">
            <table class="table table-striped">
                <thead class="back-azul">
                <th width="30px"></th>
                <th>Utilizadores</th>
                </thead>
                <tbody>
                <?php foreach($users as $user):?>
                <tr>
                <td width="30px"><img src="assets/images/<?=$user['imagem']?>" class="img-border mr-2" width="50px"></td>
                <td><?=$user['nome']?></td>
                </tr>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>
  
   
    </div>
</div>
