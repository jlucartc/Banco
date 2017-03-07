google.charts.load('current', {'packages':['bar']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
  var rec = document.getElementsByName('recMes');
  var des = document.getElementsByName('desMes');
  var data = new google.visualization.DataTable();
  data.addColumn('string','Mês');
  data.addColumn('number','Receitas');
  data.addColumn('number','Despesas');
  //google.visualization.arrayToDataTable([
//    ['Mês', 'Receitas', 'Despesas'],
//  ]);

  var months = ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'];

  for(var i = 0; i < 12; i++){
    data.addRow([months[parseInt(rec[i].dataset.mes)],parseFloat(rec[i].dataset.valor),parseFloat(des[i].dataset.valor)]);
  }

  var options = {
    chart: {
      title: 'Receitas e Despesas ao longo do ano',
    }
  };

  var chart = new google.charts.Bar(document.getElementById('graph'));

  chart.draw(data, options);
}
