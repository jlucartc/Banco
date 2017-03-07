<?php
session_start();
// exemplo1.php
// fazer uso da classe jpgraph padrão e sua especialização
// em gráfico de barras
include("jpgraph/src/jpgraph.php");
include("jpgraph/src/jpgraph_bar.php");
include('conecta_mysql.php');
/*
Definir um array para cada ponto da coordenada Y, especificando
seus pontos/valores, sendo:
$numGols = o número de gols marcados em cada dia da semana,
começando Domingo (8 gols) e terminando Sábado (11 gols)
*/

$receitasMes = $pdo->prepare("SELECT * FROM RECEITAS_DESPESAS WHERE USUARIO = ? AND TIPO = 1 ");
$despesasMes = $pdo->prepare("SELECT * FROM RECEITAS_DESPESAS WHERE USUARIO = ? AND TIPO = 2 ");

$receitasMes->execute(array($_SESSION['id_usuario']));
$despesasMes->execute(array($_SESSION['id_usuario']));

$receitasMes = $receitasMes->fetchAll();
$despesasMes = $despesasMes->fetchAll();

$recMesArray = array(0,0,0,0,0,0,0,0,0,0,0,0);
$desMesArray = array(0,0,0,0,0,0,0,0,0,0,0,0);

foreach ($receitasMes as $rec) {
  if($rec['classe'] == 1){
    $recMesArray[$rec['mes_referencia']] += $rec['valor'];
  }else if($rec['classe'] == 2){
    for($i = 0; $i < 12; $i++){
      $recMesArray[$i] += $rec['valor'];
    }
  }
}

foreach ($despesasMes as $des) {
  if($des['classe'] == 1){
    $desMesArray[$des['mes_referencia']] += $des['valor'];
  }else if($des['classe'] == 2){
    for($i = 0; $i < 12; $i++){
      $desMesArray[$i] += $des['valor'];
    }
  }
}

$shortMonths = array('Jan',' Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez');

$final = array();

for($i = 0; $i < 12; $i++){
  $final[$i] = strval($recMesArray[$i]);
  $final[$i+1] = strval($desMesArray[$i]);
}

//$numGols = array("8", "7", "12", "10", "7", "9", "11");

// iniciar criação do gráfico
$grafico = new graph(500,400,"png");

// ajustar alguns parâmetros
$grafico->SetScale("textlin");
$grafico->SetShadow();

$grafico->title->Set('Receitas/despesas por mês: ');

// criar o gráfico de barras
$gBarras1 = new BarPlot($recMesArray);
$gBarras2 = new BarPlot($desMesArray);
// ajuste de cores
$gBarras1->SetColor('yellow');
$gBarras2->SetColor('black');
//$gBarras->SetShadow("darkblue");
$group = new GroupBarPlot(array($gBarras1,$gBarras2));
// adicionar gráfico de barras ao gráfico
$grafico->Add($group);
$grafico->xaxis->setTickLabels($shortMonths);

// imprimir gráfico
$grafico->Stroke();
?>
