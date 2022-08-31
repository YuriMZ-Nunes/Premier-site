<?php
include_once('config.php');

if (!empty($_GET['id_obra'])) {
  $id_obra = $_GET['id_obra'];
}
if (!empty($_GET['dataInicio'])) {
  $data_inicio = $_GET['dataInicio'];
}
if (!empty($_GET['dataFinal'])) {
  $data_final = $_GET['dataFinal'];
}

$sqlSum = "SELECT e.nome_emp, sum(valorDiaria_emp), count(d.id_emp),(SELECT sum(valorDiaria_emp) FROM empregado as e, diaria_empregado as d WHERE d.id_emp = e.id_emp AND d.dia_diariaEmp >= '$data_inicio' and d.dia_diariaEmp <= '$data_final' and d.id_obra = '$id_obra') AS total FROM empregado as e, diaria_empregado as d WHERE d.id_emp = e.id_emp AND d.dia_diariaEmp >= '$data_inicio' and d.dia_diariaEmp <= '$data_final' and d.id_obra = '$id_obra' GROUP BY e.nome_emp";

$resultSum = $conexao->query($sqlSum);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" />
  <title>Relatório de obra</title>

  <style>
    html {
      padding: 40px;
      width: 1200px;
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
      $formatedIni = $inicio->format('d/m/Y');

      $final = new DateTime($data_final);
      $timeStampFinal = $final->getTimestamp();
      $formatedFinal = $final->format('d/m/Y');

      $sqlObra = "SELECT lote_obra FROM obra WHERE id_obra = $id_obra";
      $resultObra = $conexao->query($sqlObra);

      while ($obra_data = mysqli_fetch_assoc($resultObra)) {
        echo  "<h2> Relatório da " . $obra_data['lote_obra'] . " de " . $formatedIni . " até " . $formatedFinal . "</h2>";
      }



      ?>
      <button id="download">Baixar</button>
    </div>

    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th scope="col">Empregado</th>
          <th scope="col">Dias de trabalho</th>
          <th scope="col">Total diárias</th>
        </tr>
      </thead>
      <tbody>
        <?php
        while ($sum_data = mysqli_fetch_assoc($resultSum)) {
          echo "<tr>";
          echo "<td>" . $sum_data['nome_emp'] . "</td>";
          echo "<td>" . $sum_data['count(d.id_emp)'] . "</td>";
          echo "<td> R$ " . $sum_data['sum(valorDiaria_emp)'] . "</td>";
          $total = $sum_data['total'];
        }
        ?>
      </tbody>
      <tfoot>
        <tr>
          <th scope="row">Total</th>
          <td> - </td>
          <?php echo "<td><b> R$ " . $total . "</b></td>" ?>
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