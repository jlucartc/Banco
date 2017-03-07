<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment;Filename=planilha.xls");

echo "<html>";
echo "<meta http-equiv=Content-Type content=text/html; charset=Windows-1252>";

echo "<body>";
include 'generateFile.php';
echo "</body>";
echo "</html>";
?>
