<?php

include_once('config.php');

$data_inicio = '1900-01-01';
$data_final = '2100-01-01';





if (isset($_POST['submit'])) {

  $data_inicio = $_POST['dataInicial'];
  $data_final = $_POST['dataFinal'];

  /*$sqlSum = "SELECT e.nome_emp, sum(e.valorDiaria_emp), e.banco_emp, e.ag_emp, e.cnt_emp, e.pix_emp, sum(v.valor_vale) from empregado as e, diaria_empregado as d, vale as v WHERE (e.id_emp = d.id_emp and d.dia_diariaEmp >= '$data_inicio' and d.dia_diariaEmp <= '$data_final' and v.dia_vale >= '$data_inicio' and v.dia_vale <= '$data_final') GROUP BY e.nome_emp ";*/

  $sqlSum = "SELECT id_emp, nome_emp, banco_emp, ag_emp, cnt_emp, pix_emp,soma_diaria, soma_vale, (COALESCE(soma_diaria,0)-COALESCE(soma_vale,0)) as subtração FROM (	SELECT e.id_emp, e.nome_emp,e.banco_emp, e.ag_emp, e.cnt_emp, e.pix_emp,SUM(d.valor_diariaEmp) AS soma_diaria, v.valor_vale as soma_vale FROM empregado AS e LEFT JOIN diaria_empregado as d ON e.id_emp = d.id_emp LEFT JOIN (	SELECT id_emp, SUM(valor_vale) AS valor_vale FROM vale WHERE dia_vale >= '$data_inicio' and dia_vale <= '$data_final' GROUP BY id_emp) AS v ON v.id_emp = e.id_emp WHERE d.dia_diariaEmp >= '$data_inicio' and d.dia_diariaEmp <= '$data_final' GROUP BY id_emp, nome_emp, valor_vale) AS calculos ";

  /*$sqlSum = "SELECT id_emp, nome_emp, banco_emp, ag_emp, cnt_emp, pix_emp,soma_diaria, soma_vale, (COALESCE(soma_diaria,0)-COALESCE(soma_vale,0)) as subtração FROM (	SELECT e.id_emp, e.nome_emp,e.banco_emp, e.ag_emp, e.cnt_emp, e.pix_emp,COUNT(*)*d.valor_diariaEmp AS soma_diaria, v.valor_vale as soma_vale FROM empregado AS e LEFT JOIN diaria_empregado as d ON e.id_emp = d.id_emp LEFT JOIN (	SELECT id_emp, SUM(valor_vale) AS valor_vale FROM vale WHERE dia_vale >= '$data_inicio' and dia_vale <= '$data_final' GROUP BY id_emp) AS v ON v.id_emp = e.id_emp WHERE d.dia_diariaEmp >= '$data_inicio' and d.dia_diariaEmp <= '$data_final' GROUP BY id_emp, nome_emp, valor_vale) AS calculos ";*/

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
  <title>Relatório diaria</title>
</head>

<body>
  <div class="container">
    <h1>Gerar relatório</h1>
    <form action="relatorioDiaria.php" method="post">
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
    echo '<a class="btn btn-primary voltar" target="_blank" href="pdftest.php?dataInicio=' . $data_inicio . '&dataFinal=' . $data_final . '"> Baixar relatório pdf</a>';

    ?>
  </div>



  <div>
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">Empregado</th>
          <th scope="col">Total</th>
          <th scope="col">Banco</th>
          <th scope="col">Agencia</th>
          <th scope="col">Conta</th>
          <th scope="col">PIX</th>
          <th scope="col">Vale</th>
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
    </table>
  </div>
</body>

</html>