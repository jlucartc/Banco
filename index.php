<?php
session_start();

if(isset($_SESSION['nome_usuario'])){ header("Location: principal.php"); }else{
?>
<html>
<head><title>Controle de Finanças </title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body style="background-color:#ADD8E6">
  <div class="container">
    <div class="table">
      <div class="row">
        <div class="col-sm-12">
          <form method="POST" action="login.php">
            <center>
              <img src ="img/dinheiro.png" width="30%" height ="30%"/>
              <h1>$$$ Sistema de Controle de Financas $$$ </h1>
              <hr><br>
              <p class="text-primary">Favor entre com os dados de identificacao para acessar o sistema :</p>
              <br><br>
              <table>
                <tr>
                  <td width="200 px"><input class="form-control" type="text" name="username" size ="20" placeholder="Usuario">
                  </td>
                </tr>
                <tr>
                  <td width="200 px"><input class="form-control" type="password" name="senha" size ="20" placeholder="Senha">
                  </td>
                </tr>
                <tr>
                  <td>
                    <br><br><img id="captcha" src="securimage/securimage_show.php" alt="CAPTCHA Image" />
                  </td>
                </tr>
                <tr align="center">
                  <td>
                    <br><input type="text" name="captcha_code" size="10" maxlength="6"/>
                    <a href="#" onclick="document.getElementById('captcha').src = 'securimage/securimage_show.php?' + Math.random();" class="btn btn-link">Different Image</a>
                  </td>
                </tr>
                <tr align="center">
                  <td><br><input class="btn btn-primary" type="submit" value ="Enviar" name="enviar">
                  </td>
                </tr>
              </table>
              <br><hr><br>
              <p class="bg-info">Caso tenha problemas para acessar o sistema , favor enviar
                email para administrador@minhaempresa .com.br </p>
              </center>
            </form>
          </div>
        </div>
      </div>
    </div>
  </body>
  </html>
<?php } ?>
