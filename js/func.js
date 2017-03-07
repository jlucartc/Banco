function redirect(id){
  switch (id) {
    case 1:
      window.location = "receitas_despesas.php?t=1";
      break;
    case 2:
      window.location = "receitas_despesas.php?t=2";
      break;
    case 3:
      window.location = "saldosMensaisPlan.php";
      break;
    case 4:
      window.location = 'toXLS.php';
      break;
    default:

  }
}
