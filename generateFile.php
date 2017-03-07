<?php
session_start();
if(isset($_SESSION['nome_usuario'])){

include 'conecta_mysql.php';
$recdesp = $pdo->prepare("SELECT * FROM receitas_despesas WHERE USUARIO = ? ORDER BY mes_referencia");
$recdesp->execute(array($_SESSION['id_usuario']));
$recdesp = $recdesp->fetchAll();

$mes = array("Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro");


$recFix = $pdo->prepare("SELECT * FROM receitas_despesas WHERE USUARIO = ? AND TIPO = 1 AND CLASSE = 2");
$recVar = $pdo->prepare("SELECT * FROM receitas_despesas WHERE USUARIO = ? AND TIPO = 1 AND CLASSE = 1");
$desFix = $pdo->prepare("SELECT * FROM receitas_despesas WHERE USUARIO = ? AND TIPO = 2 AND CLASSE = 2");
$desVar = $pdo->prepare("SELECT * FROM receitas_despesas WHERE USUARIO = ? AND TIPO = 2 AND CLASSE = 1");

$recFix->execute(array($_SESSION['id_usuario']));
$recVar->execute(array($_SESSION['id_usuario']));
$desFix->execute(array($_SESSION['id_usuario']));
$desVar->execute(array($_SESSION['id_usuario']));

$recFix = $recFix->fetchAll();
$recVar = $recVar->fetchAll();
$desFix = $desFix->fetchAll();
$desVar = $desVar->fetchAll();

$receitasMes = array(0,0,0,0,0,0,0,0,0,0,0,0);
$despesasMes = array(0,0,0,0,0,0,0,0,0,0,0,0);
$receitaAno = 0;
$despesaAno = 0;

echo "Usuario: ".$_SESSION['nome_usuario']."<br>";
echo "Data: ".date("Y-m-d H:i:s")."<br><br>";

echo "<h2><b> ------ Receitas fixas ------ <b></h2><br><br>";
foreach($recFix as $linha){
  echo "-------------------------------------------------------------------<br>";
  echo " Data: ".$linha['datahora']." - Valor: ".$linha['valor'];
  echo "<br>Descrição: <br><p>".$linha['descricao']."</p><br>";
  echo "-------------------------------------------------------------------<br>";
  $receitaAno += 12*$linha['valor'];
  for($i = 0 ; $i < count($receitasMes); $i++){
    $receitasMes[$i] += $linha['valor'];
  }
}


echo "<br><br><h2><b> ------ Receitas variaveis ------ <b></h2><br><br>";
foreach($recVar as $linha){

    $mesAtual;
    switch($linha['mes_referencia']){
      case 0:
        $mesAtual = 0;
        break;
      case 1:
        $mesAtual = 1;
        break;
      case 2:
        $mesAtual = 2;
        break;
      case 3:
        $mesAtual = 3;
        break;
      case 4:
        $mesAtual = 4;
        break;
      case 5:
        $mesAtual = 5;
        break;
      case 6:
        $mesAtual = 6;
        break;
      case 7:
        $mesAtual = 7;
        break;
      case 8:
        $mesAtual = 8;
        break;
      case 9:
        $mesAtual = 9;
        break;
      case 10:
        $mesAtual = 10;
        break;
      case 11:
        $mesAtual = 11;
        break;
    }
    echo "-------------------------------------------------------------------<br>";
    echo "Mês: ".$mes[$mesAtual]." - Data: ".$linha['datahora']." - Valor: ".$linha['valor'];
    echo "<br>Descrição: <br><p>".$linha['descricao']."</p><br>";
    echo "-------------------------------------------------------------------<br>";
    $receitaAno += $linha['valor'];
    $receitasMes[$mesAtual] += $linha['valor'];
}

echo "<br><br><h2><b> ------ Despesas fixas ------ <b></h2><br><br>";
foreach($desFix as $linha){
  echo "-------------------------------------------------------------------<br>";
  echo " Data: ".$linha['datahora']." - Valor: ".$linha['valor'];
  echo "<br>Descrição: <br><p>".$linha['descricao']."</p><br>";
  echo "-------------------------------------------------------------------<br>";
  $despesaAno += 12*$linha['valor'];
  for($i = 0 ; $i < count($despesasMes); $i++){
    $despesasMes[$i] += $linha['valor'];
  }
}

echo "<br><br><h2><b> ------ Despesas variaveis ------ <b></h2><br><br>";
foreach($desVar as $linha){

    $mesAtual;
    switch($linha['mes_referencia']){
      case 0:
        $mesAtual = 0;
        break;
      case 1:
        $mesAtual = 1;
        break;
      case 2:
        $mesAtual = 2;
        break;
      case 3:
        $mesAtual = 3;
        break;
      case 4:
        $mesAtual = 4;
        break;
      case 5:
        $mesAtual = 5;
        break;
      case 6:
        $mesAtual = 6;
        break;
      case 7:
        $mesAtual = 7;
        break;
      case 8:
        $mesAtual = 8;
        break;
      case 9:
        $mesAtual = 9;
        break;
      case 10:
        $mesAtual = 10;
        break;
      case 11:
        $mesAtual = 11;
        break;
    }
    echo "-------------------------------------------------------------------<br>";
    echo "Mês: ".$mes[$mesAtual]." - Data: ".$linha['datahora']." - Valor: ".$linha['valor'];
    echo "<br>Descrição: <br><p>".$linha['descricao']."</p><br>";
    echo "-------------------------------------------------------------------<br>";
    $despesaAno += $linha['valor'];
    $despesasMes[$mesAtual] += $linha['valor'];
}

echo "<h2><b>Despesas Mensais: </b></h2><br><br>";
for($i = 0; $i < count($mes); $i++){
  echo $mes[$i]." -> R$ ".$despesasMes[$i]."<br>";
}
echo "<br><br><h2><b>Receitas Mensais: </b></h2><br><br>";
for($i = 0; $i < count($mes); $i++){
  echo $mes[$i]." -> R$ ".$receitasMes[$i]."<br>";
}
echo "<br><br><h2><b>Despesas anuais: </b></h2><br><br>";
  echo "R$ ".$despesaAno;

echo "<br><br><h2><b>Receitas anuais: </b></h2><br><br>";
  echo "R$ ".$receitaAno;

echo "<br><br><h2><b>Saldo anual: </b></h2><br><br>";
  echo "R$ ".($receitaAno - $despesaAno);
}else{

}
?>
