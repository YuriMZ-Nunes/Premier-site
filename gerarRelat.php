<?php

include_once('config.php');


if (!empty($_GET['dataInicio'])) {
  $data_inicio = $_GET['dataInicio'];
  echo $data_inicio;
}
if (!empty($_GET['dataFinal'])) {
  $data_final = $_GET['dataFinal'];
  echo $data_final;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <?php
  $arquivo = 'relatorioTeste.xls';
  $html = '';
  $html .= '<table border="1">';
  $html .= '<tr>';
  $html .= '<td colspan="6"> Relatorio de ' . $data_inicio . ' até ' . $data_final;
  $html .= '</tr>';

  $html .= '<tr>';
  $html .= '<td><b> Empregado </b></td>';
  $html .= '<td><b> Total </b></td>';
  $html .= '<td><b> Banco </b></td>';
  $html .= '<td><b> Agencia </b></td>';
  $html .= '<td><b> Conta </b></td>';
  $html .= '<td><b> PIX </b></td>';
  $html .= '</tr>';

  $sqlSum = "SELECT e.nome_emp, sum(d.valor_diariaEmp), e.banco_emp, e.ag_emp, e.cnt_emp, e.pix_emp from empregado as e, diaria_empregado as d WHERE (e.id_emp = d.id_emp and d.dia_diariaEmp >= '$data_inicio' and d.dia_diariaEmp <= '$data_final') ";

  $resultSum = $conexao->query($sqlSum);

  while ($sum_data = mysqli_fetch_assoc($resultSum)) {
    $html .= '<tr>';
    $html .= '<td>' . $sum_data['nome_emp'] . '</td>';
    $html .= '<td>R$' . $sum_data['sum(d.valor_diariaEmp)'] . '</td>';
    $html .= '<td>' . $sum_data['banco_emp'] . '</td>';
    $html .= '<td>' . $sum_data['ag_emp'] . '</td>';
    $html .= '<td>' . $sum_data['cnt_emp'] . '</td>';
    $html .= '<td>' . $sum_data['pix_emp'] . '</td>';
    $html .= '</tr>';
  }






  header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
  header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache");
  header("Content-type: application/x-msexcel");
  header("Content-Disposition: attachment; filename=\"{$arquivo}\"");
  header("Content-Description: PHP Generated Data");
  echo $html;


  ?>
</body>

</html>