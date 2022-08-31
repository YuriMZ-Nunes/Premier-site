<?php

include_once('config.php');


if (!empty($_GET['dataInicio'])) {
  $data_inicio = $_GET['dataInicio'];
}
if (!empty($_GET['dataFinal'])) {
  $data_final = $_GET['dataFinal'];
}


$sqlSum = "SELECT id_emp, nome_emp, banco_emp, ag_emp, cnt_emp, pix_emp,soma_diaria, soma_vale, (COALESCE(soma_diaria,0)-COALESCE(soma_vale,0)) as subtração FROM (	SELECT e.id_emp, e.nome_emp,e.banco_emp, e.ag_emp, e.cnt_emp, e.pix_emp,SUM(d.valor_diariaEmp) AS soma_diaria, v.valor_vale as soma_vale FROM empregado AS e LEFT JOIN diaria_empregado as d ON e.id_emp = d.id_emp LEFT JOIN (	SELECT id_emp, SUM(valor_vale) AS valor_vale FROM vale WHERE dia_vale >= '$data_inicio' and dia_vale <= '$data_final' GROUP BY id_emp) AS v ON v.id_emp = e.id_emp WHERE d.dia_diariaEmp >= '$data_inicio' and d.dia_diariaEmp <= '$data_final' GROUP BY id_emp, nome_emp, valor_vale) AS calculos ";

$resultSum = $conexao->query($sqlSum);

$sqlTotal = "SELECT sum(COALESCE(soma_diaria,0)-COALESCE(soma_vale,0)) as total FROM (	SELECT e.id_emp, e.nome_emp,e.banco_emp, e.ag_emp, e.cnt_emp, e.pix_emp,SUM(d.valor_diariaEmp) AS soma_diaria, v.valor_vale as soma_vale FROM empregado AS e LEFT JOIN diaria_empregado as d ON e.id_emp = d.id_emp LEFT JOIN (	SELECT id_emp, SUM(valor_vale) AS valor_vale FROM vale WHERE dia_vale >= '$data_inicio' and dia_vale <= '$data_final' GROUP BY id_emp) AS v ON v.id_emp = e.id_emp WHERE d.dia_diariaEmp >= '$data_inicio' and d.dia_diariaEmp <= '$data_final' GROUP BY id_emp, nome_emp, valor_vale) AS calculos ";

$resultTotal = $conexao->query($sqlTotal);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" />
  <title>PDF</title>

  <script>
    var total = 0;
    $(document).ready(function() {
      $('table tbody tr').each(function() {
        total += parseFloat(this.children[7].innerHTML);
      });
      $('table tfoot td').text('Total: ' + total);
    });
  </script>

  <style>
    html {
      padding: 40px;
      width: 900px;
    }

    .dwn {
      display: flex;
      gap: 2rem;
      margin-bottom: 1rem;
    }
  </style>
</head>

<body>
  <div>
    <div class="dwn">

      <?php
      $inicio = new DateTime($data_inicio);
      $timeStampIni = $inicio->getTimestamp();
      $formatedIni = $inicio->format('d-m-Y');

      $final = new DateTime($data_final);
      $timeStampFinal = $final->getTimestamp();
      $formatedFinal = $final->format('d-m-Y');

      echo  "<h2> Relatório de " . $formatedIni . " até " . $formatedFinal . "</h2>";

      ?>
      <button id="download">Baixar</button>
    </div>

    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th scope="col">Empregado</th>
          <th scope="col">Total diarias</th>
          <th scope="col">Banco</th>
          <th scope="col">Agencia</th>
          <th scope="col">Conta</th>
          <th scope="col">PIX</th>
          <th scope="col">Total vales</th>
          <th scope="col">A receber</th>

        </tr>
      </thead>
      <tbody>
        <?php
        while ($sum_data = mysqli_fetch_assoc($resultSum)) {
          echo "<tr>";
          echo "<td>" . $sum_data['nome_emp'] . "</td>";
          echo "<td>" . $sum_data['soma_diaria'] . "</td>";
          echo "<td>" . $sum_data['banco_emp'] . "</td>";
          echo "<td>" . $sum_data['ag_emp'] . "</td>";
          echo "<td>" . $sum_data['cnt_emp'] . "</td>";
          echo "<td>" . $sum_data['pix_emp'] . "</td>";
          echo "<td>" . $sum_data['soma_vale'] . "</td>";
          echo "<td>" . $sum_data['subtração'] . "</td>";
        }
        ?>
      </tbody>
      <tfoot>
        <tr>
          <th scope="row" colspan=7>Total</th>
          <?php
          while ($sum_data = mysqli_fetch_assoc($resultTotal)) {
            echo "<td><b> R$ " . $sum_data['total'] . "</b></td>";
          }
          ?>

        </tr>
      </tfoot>
    </table>


  </div>
</body>

<script>
  function downloadPDFWithBrowserPrint() {
    window.print();
  }
  document.querySelector('#download').addEventListener('click', downloadPDFWithBrowserPrint);
</script>

</html>