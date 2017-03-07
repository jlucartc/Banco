<?php
include_once 'securimage/securimage.php';

$securimage = new Securimage();

// ´eobtm os valores digitados
$username = $_POST["username"];
// md5 - evitar que a senha do usuario seja armazenada limpa no banco .
$senha = md5($_POST["senha"]);
// acesso ao banco de dados
include "conecta_mysql.php";
$resultado = $pdo->prepare("SELECT * FROM usuarios where login = ? ");
$resultado->execute(array($username));
$linhas = count(($resultado = $resultado->fetchAll()));
if($linhas == 0) // testa se a consulta retornou algum registro
{
  echo "<html><body>";
  echo "<p align = center>Usuário não encontrado !</p>";
  echo "<p align = center><a href = index.php> Voltar </a></p>";
  echo "</body></html>";
}
else
{
  if ($senha != md5($resultado[0]['senha'])){// confere senha
    echo "<html><body>";
    echo "<p align = center >A senha está incorreta !</p>";
    echo "<p align = center ><a class='btn btn-primary' href = index.php> Voltar </a></p>";
    echo "</body></html>";
  }else if($securimage->check($_POST['captcha_code']) == false){
    echo "<html><body>";
    echo "<p class='alert alert-warning' align = center >Captcha incorreto!</p>";
    echo "<p align = center ><a class='btn btn-primary' href = index.php> Voltar </a></p>";
    echo "</body></html>";
  }
  else // ´ausurio e senha corretos . Vamos gravar as ¸c~oinformaes na ~asesso .
  {
    $id = $resultado[0]['id']; // id do usuario .
    $perfil = $resultado[0]['perfil']; // perfil do usuario .
    // Iniciar Sessão .
    session_start();
    $_SESSION['nome_usuario'] = $username ;
    $_SESSION['senha_usuario'] = $senha ;
    $_SESSION['perfil_usuario'] = $perfil ;
    $_SESSION['id_usuario'] = $id;
    // direciona para a ´apgina inicial do sistema .
    header("Location: principal.php");
  }
}
// Encerrar ~aconexo com o banco de dados .
?>
