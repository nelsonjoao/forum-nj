<!-- navbar -->
<nav class="navbar navbar-expand-lg navbar-primary navbar-light navbar-cor" id="navegacao"> 
    <div class="container-fluid">
         
      <a class="navbar-brand" href="?a=inicio"><h4><strong>forumNJ</strong></h4></a> 
         
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"> 
              <span class="navbar-toggler-icon"></span> 
            </button> 
            
            <div class="collapse navbar-collapse" id="navbarNav"> 
                <ul class="navbar-nav ml-auto"> 
                    <li class="nav-item"> <a class="nav-link active mr-2 ml-2" aria-current="page" href="?a=inicio"><h5>Página inicial</h5></a> </li> 
                    <li class="nav-item"> <a class="nav-link active mr-2 ml-2" href="?a=perfil"><h5>Perfil</h5></a> </li> 
                    <li class="nav-item"> <a class="nav-link active mr-2 ml-2" href="?a=usuarios"><h5>Usuários</h5></a> </li>
                    <li class="nav-item"> <a class="nav-link active mr-2 ml-2" href="?a=logout"><h5>Terminar sessão</h5></a> </li>
                    </ul> 
            </div> 
    </div> 
</nav>

<div class="container-fluid">
<header>
      <div class="row barra-user" id="barra-utilizador">
      <div class="col m-2">
            <a href="?a=perfil"><img src="assets/images/<?=$_SESSION['imagem_utilizador']?>" class="img-border" width="45px"></a> 
            <a href="?a=perfil"><span class="cor-azul titulo-post"><strong><?=$_SESSION['nome_utilizador']?></strong></span></a>
      </div>
    </div>
</header>
</div>