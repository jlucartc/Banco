<?php
include "valida_sessao.php";
// include " conecta_mysql .inc ";
$nome_usuario = $_SESSION["nome_usuario"];

// £resultado = mysql_query (" SELECT id FROM usuarios WHERE login =’ £nome_usuario ’");
// £id = mysql_result ( £resultado ,0," id ");
// mysql_close ( £con );

$t = $_GET['t'];
switch($t){
case 1:
$tipo = "receita";
break ;
case 2:
$tipo = "despesa";
break ;}
?>
<html>
<head><title> Controle de Finanças </title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<?php if($t == 2){
?>
<body style="background-color:#ff5555;">
<?php
}else{
?>
<body style="background-color:#00ff66;">
<?php
}?>
<body>
<center>
<?php
if($t == 1){
?>
<img src="img/cifrao.jpg" width ="15%"/>
<?php
}else{
?>
<img src="img/desp.png" width ="15%"/>
<?php
}
?>
<h1>Sistema de Controle de Finanças Empresarial</h1>
<hr><br>

<div class="container">
<div class="panel panel-success">
<div class="panel-heading"><h4>Formulário para cadastro de <?php echo $tipo ?> (* Obrigatório )</h4></div>
<form method ="post" action ="gravar.php" name ='fCadRecDes' >
<table class="table">
<tr class="bg-primary">
<td width ="200 px" ><input class="form-control" size ="80" type ="text" name ="nome" placeholder="Nome*"></td >
</tr>
<tr class="bg-primary">
<td width ="130 px"><br>Classe *:<br>
<div class="radio" style="margin-left:50px"><input type ="radio" name ="classe" value ="1" checked >Variável</div>
<div class="radio" style="margin-left:50px"><input type ="radio" name ="classe" value ="2" >Fixa</div>
</td>
</tr>
<tr class="bg-primary">
<td width ="130 px"><br>Mês de referência *:<br><br>
<select style="color:#000000" name ="mesRef">
<option style="color:#000000" value ="0">Janeiro </option>
<option style="color:#000000" value ="1">Fevereiro </option>
<option style="color:#000000" value ="2">Março </option>
<option style="color:#000000" value ="3">Abril </option>
<option style="color:#000000" value ="4">Maio </option>
<option style="color:#000000" value ="5">Junho </option>
<option style="color:#000000" value ="6">Julho </option>
<option style="color:#000000" value ="7">Agosto </option>
<option style="color:#000000" value ="8">Setembro </option>
<option style="color:#000000" value ="9">Outubro </option>
<option style="color:#000000" value ="10">Novembro </option>
<option style="color:#000000" value ="11">Dezembro </option>
</select><br><br>
</td>
</tr>
<tr class="bg-primary">
<td>
<input class="form-control" size ="40" type ="text" name ="valor" placeholder="Valor* (R$) | (formato (xx.xx) )">
</td>
</tr>
<tr class="bg-primary">
<td width ="200 px">
<br>
<textarea class="form-control" rows ="7" cols ="69" name ="descricao" placeholder="Descrição"></textarea>
</td>
</tr>
<tr class="bg-primary">
<td width ="130 px">
<input class="btn btn-success" type ="button" value ="Voltar" name ="voltar"
onclick ="javascript:history.back()">
<input class="btn btn-success" type ="reset" value ="Limpar">
<input class="btn btn-success" type ="submit" value ="Salvar">
<input class="btn btn-success" type ="hidden" name ="t"
value =" <?php echo $t?>">
</td>
</tr>
</table>
</form>
</div>
</div>
</center>
</body>
</html>
