<?php
// configuracoes do banco de dados
$bd = "mysql";
$servidor = "localhost";
$usuario_bd = "root";
$senha_bd = "";
$banco = "exemplo_ntwi";
$pdo = new PDO($bd.":host=".$servidor.";dbname=".$banco,$usuario_bd,$senha_bd);
?>
