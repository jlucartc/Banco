<?php
session_start();

if(isset($_SESSION["nome_usuario"]))
$nome_usuario = $_SESSION["nome_usuario"];
if(isset($_SESSION["senha_usuario"]))
$senha_usuario = $_SESSION["senha_usuario"];

if (!(empty($nome_usuario) and !empty($senha_usuario)))
{
include "conecta_mysql.php";
$resultado = $pdo->prepare("SELECT * FROM usuarios WHERE login = ? ");
$resultado->execute(array($nome_usuario));
if(count($resultado = $resultado->fetchAll()) == 1)
{
if($senha_usuario != md5($resultado[0]["senha"]))
{
unset($_SESSION['nome_usuario']);
unset($_SESSION['senha_usuario']);
unset($_SESSION['perfil_usuario']);
echo "Voce nao efetuou o LOGIN !"."<br/>";
echo "<p align = center><a href = index.html> Voltar </a></p>";
exit;
}
}
else
{
echo count($resultado)."<br>";
unset($_SESSION['nome_usuario']);
unset($_SESSION['senha_usuario']);
unset($_SESSION['perfil_usuario']);
echo "Voce nao efetuou o LOGIN !";
echo "<p align = center><a href = index.html> Voltar </a></p>";
exit;
}
}
else
{
echo "Voce nao efetuou o LOGIN !";
echo "<p align = center><a href = index.html> Voltar </a></p>";
exit;
}
?>
