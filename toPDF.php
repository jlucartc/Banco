<?php
session_start();
if(isset($_SESSION['nome_usuario'])){
require_once 'vendor/mpdf/mpdf/mpdf.php';

$mpdf = new mPDF();
ob_start();
include "generateFile.php";
$html = ob_get_clean();
$mpdf->WriteHTML($html);
$mpdf->Output("planilha.pdf","D");
header('Location: principal.php');
}
?>
