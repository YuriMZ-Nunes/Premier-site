<?php

include_once('config.php');

$id_obra = '';
$data_inicio = '1900-01-01';
$data_final = '2100-01-01';

$sqlSelectObra = "SELECT * FROM obra";
$resultObra = $conexao->query($sqlSelectObra);
$option = '';
while ($row = mysqli_fetch_array($resultObra)) {
  $option = $option . "<option value='$row[0]'>$row[3]<option>";
}

if (isset($_POST['submit'])) {
  $id_obra = $_POST['id_obra'];
  $data_inicio = $_POST['dataInicial'];
  $data_final = $_POST['dataFinal'];

  $sqlSum = "SELECT e.nome_emp, sum(valor_diariaEmp), count(d.id_emp),(SELECT sum(valor_diariaEmp) FROM empregado as e, diaria_empregado as d WHERE d.id_emp = e.id_emp AND d.dia_diariaEmp >= '$data_inicio' and d.dia_diariaEmp <= '$data_final' and d.id_obra = '$id_obra') AS total FROM empregado as e, diaria_empregado as d WHERE d.id_emp = e.id_emp AND d.dia_diariaEmp >= '$data_inicio' and d.dia_diariaEmp <= '$data_final' and d.id_obra = '$id_obra' GROUP BY e.nome_emp";

  $resultSum = $conexao->query($sqlSum);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="style/style.css">
  <title>Relatório de obra</title>
</head>

<body>
  <div class="container">
    <h1>Gerar relatório</h1>
    <form action="relatorioObra.php" method="post">
      <div class="input">
        <label for="id_obra">Selecionar obra:</label>
        <select name="id_obra" require>
          <option value="" data-default disabled selected></option>
          <?php echo $option ?>
        </select>
      </div>
      <div class="input">
        <label for="dataInicial">Data inicial:</label>
        <input type="date" name="dataInicial" require> <br>
      </div>
      <div class="input">
        <label for="dataFinal">Data final:</label>
        <input type="date" name="dataFinal" require>
      </div>


      <button type="submit" name="submit">Gerar relatório</button><br><br>
    </form>
    <?php
    echo '<a class="btn btn-primary voltar" href="index.php">Voltar</a><br><br>';
    echo '<a class="btn btn-primary voltar" target="_blank" href="pdfObra.php?dataInicio=' . $data_inicio . '&dataFinal=' . $data_final . '&id_obra=' . $id_obra . '"> Baixar relatório pdf</a>';

    ?>
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
        echo "<td> R$ " . $sum_data['sum(valor_diariaEmp)'] . "</td>";
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
</body>

</html>