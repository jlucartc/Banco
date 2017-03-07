<?php
include "valida_sessao.php";
include "conecta_mysql.php";
$nome_usuario = $_SESSION["nome_usuario"];
$id_usuario = $_SESSION["id_usuario"];
if(!isset($_GET['mes'])){
  $mes = date('n')-1;
}else{
  $mes = $_GET['mes'];
}
$meses = array("Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho",
"Agosto","Setembro","Outubro","Novembro","Dezembro");

$resRecVar = $pdo->prepare("SELECT * FROM receitas_despesas WHERE classe = ? and mes_referencia = ? and tipo = ? and usuario = ?");
$resRecVar->execute(array(1,$mes,1,$id_usuario));
$resDesVar = $pdo->prepare("SELECT * FROM receitas_despesas WHERE classe = ? and mes_referencia = ? and tipo = ? and usuario = ?");
$resDesVar->execute(array(1,$mes,2,$id_usuario));
$resRecFix = $pdo->prepare("SELECT * FROM receitas_despesas WHERE classe = ? and tipo = ? and usuario = ?");
$resRecFix->execute(array(2,1,$id_usuario));
$resDesFix = $pdo->prepare("SELECT * FROM receitas_despesas WHERE classe = ? and tipo = ? and usuario = ?");
$resDesFix->execute(array(2,2,$id_usuario));
// Valores Totais Receitas e Despesas
$recVarTotal = 0; $recFixTotal = 0; $desVarTotal = 0; $desFixTotal = 0;
?>
<html>
<head><title> Controle de Finanças </title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body style="background-color:#7799aa;">
  <form method ="GET" name ="fmes" action ="saldosMensaisPlan.php">
    <center>
      <img src="img/calc.png" width ="15%"/>
      <h1> Sistema de Controle de Finanças Empresarial </h1><br>
      <p><h4 class="text-warning">Favor , escolha o mes que deseja visualizar :</h4>
        <select name ="mes" onchange="javascript: document.fmes.submit();">
          <option value=""> - </option>
          <option value ="0" onclick ="javascript: document.fmes.submit();">
            Janeiro </option>
            <option value ="1" onclick ="javascript: document.fmes.submit();">
              Fevereiro </option>
              <option value ="2" onclick ="javascript: document.fmes.submit();">
                Marco </option>
                <option value ="3" onclick ="javascript: document.fmes.submit();">
                  Abril </option>
                  <option value ="4" onclick ="javascript: document.fmes.submit();">
                    Maio </option>
                    <option value ="5" onclick ="javascript: document.fmes.submit();">
                      Junho </option>
                      <option value ="6" onclick ="javascript: document.fmes.submit();">
                        Julho </option>
                        <option value ="7" onclick ="javascript:document.fmes.submit();">
                          Agosto </option>
                          <option value ="8" onclick ="javascript: document.fmes.submit ();">
                            Setembro </option>
                            <option value ="9" onclick ="javascript: document.fmes.submit();">
                              Outubro </option>
                              <option value ="10" onclick ="javascript: document.fmes.submit();">
                                Novembro </option>
                                <option value ="11" onclick ="document.getElementByName('fmes').submit();">
                                  Dezembro </option>
                                </select >
                              </p>
                              <?php if(isset($mes))
                              {
                                ?>
                                <h2 class="text-success">Lista de RECEITAS - Mes de <?php echo $meses[$mes]?></h2><br><br>
                                <div class="container">
                                  <div class="panel-group">
                                    <div class="panel panel-success">
                                      <div class = "panel-heading" width =700 px border =0px >Fixas</div>
                                      <table class="table">
                                        <th> Nome </th> <th> Data e Hora de Cadastro </th><th> Valor (R$ )</th>
                                        <?php
                                        while(($linha = $resRecFix->fetch(PDO::FETCH_ASSOC))!= null)
                                        {
                                          echo "<tr>";
                                          echo "<td width =33%>".$linha["nome"]."</td>";
                                          echo "<td width =33%>".$linha["datahora"]."</td>";
                                          echo "<td width =33%>".$linha["valor"]."</td>";
                                          echo "</tr>";
                                          // Incrementar o valor total
                                          $recFixTotal = $recFixTotal + $linha["valor"];
                                        }
                                        ?>
                                        <tr>
                                          <td width =33%></td ><td width =33%><b> Total : </b></td><td width =33%><b><?php echo $recFixTotal ?></b></td>
                                        </tr>
                                      </table></div><br>
                                      <div class="panel panel-success">
                                        <div class = "panel-heading" width =700 px border =0px >Variaveis</div>
                                        <table class="table" width =700 px border =0px>
                                          <th> Nome </th> <th> Data e Hora de Cadastro </th><th> Valor (R$ )</th>
                                          <?php
                                          while(($linha = $resRecVar->fetch(PDO::FETCH_ASSOC)) != null)
                                          {
                                            echo "<tr>";
                                            echo "<td width =33%>".$linha["nome"]."</td>";
                                            echo "<td width =33%>".$linha["datahora"]."</td>";
                                            echo "<td width =33%>".$linha["valor"]."</td>";
                                            echo " </tr>";
                                            // Incrementar o valor total
                                            $recVarTotal = $recVarTotal + $linha["valor"];
                                          } ?>
                                          <tr>
                                            <td width =33%></td ><td width =33%><b> Total : </b></td><td width =33%><b><?php echo $recVarTotal ?></b></td>
                                          </tr>
                                        </table ></div></div></div><br/>
                                        <h2 class="text-danger">Lista de DESPESAS - Mes de <?php echo $meses[$mes]?></h2><br><br/>
                                        <div class="container">
                                          <div class="panel-group">
                                            <div class="panel panel-danger">
                                              <div class="panel-heading">Fixas</div>
                                              <table class="table" width =700 px border =0px >
                                                <th> Nome </th> <th> Data e Hora de Cadastro </th><th> Valor (R$ )</th>
                                                <?php
                                                while($linha = $resDesFix->fetch(PDO::FETCH_ASSOC))
                                                {
                                                  echo "<tr>";
                                                  echo "<td width =33%>".$linha["nome"]."</td >";
                                                  echo "<td width =33%>".$linha["datahora"]."</t>";
                                                  echo "<td width =33%>".$linha["valor"]."</td>";
                                                  echo "</tr>";
                                                  // Incrementar o valor total
                                                  $desFixTotal = $desFixTotal + $linha["valor"];
                                                } ?>
                                                <tr>
                                                  <td width =33%></td><td width =33%><b> Total : </b></td><td width =33%><b><?php echo $desFixTotal ?></b></td>
                                                </tr>
                                              </table></div><br/>
                                              <div class='panel panel-danger'>
                                                <div class="panel-heading">Variaveis</div>
                                                <table class="table "width =700 px border =0px>
                                                  <th> Nome </th> <th> Data e Hora de Cadastro </th><th> Valor (R$ )</th>
                                                  <?php
                                                  while($linha = $resDesVar->fetch(PDO::FETCH_ASSOC)){
                                                    echo "<tr>";
                                                    echo "<td width =33%>".$linha["nome"]."</td>";
                                                    echo "<td width =33%>".$linha["datahora"]."</td>";
                                                    echo "<td width =33%>".$linha["valor"]."</td>";
                                                    echo "</tr>";
                                                    // Incrementar o valor total
                                                    $desVarTotal = $desVarTotal + $linha["valor"];
                                                  } ?>
                                                  <tr>
                                                    <td width =33%></td><td width =33%><b> Total : </b></td><td width =33%><b><?php echo $desVarTotal ?></b></td>
                                                  </tr>
                                                </table></div></div></div><br/>
                                                <div class="container">
                                                  <div class="panel panel-warning">
                                                    <div class="panel-heading"><h2 class="text-warning">SALDO </h2></div>
                                                    <table class='table' width =700 px border =0px>
                                                      <tr>
                                                        <td width ="50%">Receitas : </td>
                                                        <td align ="right" width ="50%"><?php echo($recFixTotal + $recVarTotal); ?></td>
                                                      </tr>
                                                      <tr>
                                                        <td width ="50%">Despesas : </td>
                                                        <td align ="right" width ="50%"><?php echo($desFixTotal + $desVarTotal); ?></td>
                                                      </tr>
                                                      <tr>
                                                        <td width ="50%">Saldo : </td>
                                                        <td align ="right" width ="50%">
                                                          <b><?php echo ($recFixTotal + $recVarTotal )-($desFixTotal + $desVarTotal); ?></b></td>
                                                        </tr>
                                                      </table></div></div>
                                                      <?php
                                                    }
                                                    ?>
                                                    <div style="width:80%;" align="left">
                                                    <table>
                                                        <tr>
                                                          <td><div style="height:40px;width:40px;background-color:#6495ed;"></div></td><td><label style="margin-left:10px;margin-right:30px;">Receita</label></td><td><div style="width:40px;height:40px;background-color:#ff82ab"></div></td><td><label style="margin-left:10px;">Despesas</label></td>
                                                        </tr>
                                                    </table>
                                                  </div>
                                                    <br><img src="graphs.php" style="width:80%;" height=300>
                                                    <br><br><input type ="button" class="btn btn-primary" onClick ="location.href = 'principal.php'" value ='Voltar '>
                                                  </center>
                                                </form>
                                              </body>
                                              </html>
