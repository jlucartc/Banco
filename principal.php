<?php

include "valida_sessao.php";
include "conecta_mysql.php";
$nome_usuario = $_SESSION["nome_usuario"];
$perfil_usuario = $_SESSION["perfil_usuario"];
$resultado = $pdo->prepare("SELECT * FROM usuarios WHERE login = ? ");
$resultado->execute(array($nome_usuario));
$resultado = $resultado->fetchAll();
$sexo = $resultado[0]["sexo"];
$nome = $resultado[0]["nome"];
switch($sexo){
  case 1:
  $saud = " Olá, Sra. ".$nome ;
  break ;
  case 2:
  $saud = "Olá, Sr. " .$nome ;
  break ;
}
switch($perfil_usuario) {
  case 1:
  $perfil = "Padrão";
  break ;
  case 2:
  $perfil = "Administrador";
  break ;
}
?>
<html>
<head><title> Controle de Finanças </title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body style="background-color:#000033;">
  <form method ="POST" action ="login.php">
    <center>
      <img src="img/user.png" width ="15%"/>
      <h1> Sistema de Controle de Fianças Empresarial </h1>
      <hr><br>
      <?php echo "<p class='text-primary'>".$saud." [ Perfil : ".$perfil."]</p>";?> <a class="btn btn-primary" href="logout.php">Sair</a>
      <hr>
      <div class="container">
        <div class="table">
          <div class="row">
            <div class="col-sm-3" style="margin-left:37.5%;">
              <div class="panel panel-primary">
                <div class="panel-heading">
                  <p>Escolha a opção desejada : </p>
                </div>
                <div class="list-group">
                  <button class="list-group-item btn btn-default" style="background-color:#00ff66;color:#ffffff" type="button" name="button" onclick="redirect(1)">Incluir receitas</button>
                  <button class="list-group-item btn btn-default" style="background-color:#ff5555;color:#ffffff" type="button" name="button" onclick="redirect(2)">Incluir despesas</button>
                  <button class="list-group-item btn btn-default" style="background-color:#0077ff;color:#ffffff" type="button" name="button" onclick="redirect(3)">Consultar planilha</button>
                  <div class="dropup">
                    <button class="btn btn-default btn-block dropdown-toggle" style="background-color:#ffcc11;color:#ffffff" stype="button" data-toggle="dropdown">Exportar planilha
                      <span class="caret"></span></button>
                      <ul class="dropdown-menu dropdown-menu-left">
                        <li><a href="toPDF.php">PDF</a></li>
                        <li><a href="toXLS.php">XLS</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <script type="text/javascript" src="js/func.js"></script>
      </center>
    </form>
  </body>
  </html>
