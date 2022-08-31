<?php

include_once('config.php');

$sqlSelectObra = "SELECT * FROM obra";
$resultObra = $conexao->query($sqlSelectObra);
$option = '';
while ($row = mysqli_fetch_array($resultObra)) {
  $option = $option . "<option value='$row[0]'>$row[3]<option>";
}

$sqlSelectAtv = "SELECT * FROM atividade";
$resultAtv = $conexao->query($sqlSelectAtv);
$optionAtv = '';
while ($rowAtv = mysqli_fetch_array($resultAtv)) {
  $optionAtv = $optionAtv . "<option value='$rowAtv[0]'>$rowAtv[1]<option>";
}

$sqlSelectEmp = "SELECT * FROM empregado";
$resultEmp = $conexao->query($sqlSelectEmp);
$optionEmp = '';
while ($rowEmp = mysqli_fetch_array($resultEmp)) {
  $optionEmp = $optionEmp . "<option value='$rowEmp[0]'>$rowEmp[1]<option>";
}

$sqlSelectFunc = "SELECT * FROM funcao";
$resultFunc = $conexao->query($sqlSelectFunc);
$optionFunc = '';
while ($rowFunc = mysqli_fetch_array($resultFunc)) {
  $optionFunc = $optionFunc . "<option value='$rowFunc[0]'>$rowFunc[1]<option>";
}

if (isset($_POST['submit'])) {
  $id_obra = $_POST['id_obra'];
  $id_atv = $_POST['id_atv'];
  $id_emp = $_POST['id_emp'];
  $id_func = $_POST['id_func'];
  $valorDiaria = $_POST['valorDiaria'];
  $diaDiaria = $_POST['diaDiaria'];

  $sqlDia = mysqli_query($conexao, "INSERT INTO diaria_empregado VALUES (0, '$id_obra', '$id_atv', '$id_emp', '$id_func', '$valorDiaria','$diaDiaria')");
}

$sqlSelectDia = "SELECT d.id_diariaEmp, o.lote_obra, a.atividade_atv, e.nome_emp, f.funcao_func, d.dia_diariaEmp FROM diaria_empregado as d, obra as o, atividade as a, empregado as e, funcao as f WHERE d.id_obra = o.id_obra and d.id_atv = a.id_atv and d.id_emp = e.id_emp and d.id_func = f.id_func";

$resultDia = $conexao->query($sqlSelectDia);


?>



<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="style/style.css">

  <title>Registrar diaria</title>
</head>

<body>
  <div class="container">
    <h1>Registrar diária</h1>
    <form action="" method="post" id="diaria">
      <div class="input">
        <label for="id_obra">Selecionar obra:</label>
        <select name="id_obra" require>
          <option value="" data-default disabled selected></option>
          <?php echo $option ?>
        </select>
      </div>
      <div class="input">
        <label for="id_atv">Selecionar atividade:</label>
        <select name="id_atv" require>
          <option value="" data-default disabled selected></option>
          <?php echo $optionAtv ?>
        </select>
      </div>
      <div class="input">
        <label for="id_emp">Selecionar empregado:</label>
        <select name="id_emp" require>
          <option value="" data-default disabled selected></option>
          <?php echo $optionEmp ?>
        </select>
      </div>
      <div class="input">
        <label for="id_func">Selecionar função:</label>
        <select name="id_func" require>
          <option value="" data-default disabled selected></option>
          <?php echo $optionFunc ?>
        </select>
      </div>
      <div class="input">
        <label for="valorDiaria">Valor da diaria</label>
        <input type="number" name="valorDiaria" require>
      </div>
      <div class="input">
        <label for="diaDiaria">Selecionar dia:</label>
        <input type="date" name="diaDiaria" require>
      </div>


      <button type="submit" name="submit"> registrar</button>
    </form><br>
    <a class="btn btn-primary voltar" href="index.php">Voltar</a>
  </div>

  <div class="table-dados">
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">id_diariaEmp</th>
          <th scope="col">Obra</th>
          <th scope="col">Atividade</th>
          <th scope="col">Empregado</th>
          <th scope="col">Função</th>
          <th scope="col">Dia</th>
        </tr>
      </thead>
      <tbody>
        <?php
        while ($dia_data = mysqli_fetch_assoc($resultDia)) {
          echo "<tr>";
          echo "<td>" . $dia_data['id_diariaEmp'] . "</td>";
          echo "<td>" . $dia_data['lote_obra'] . "</td>";
          echo "<td>" . $dia_data['atividade_atv'] . "</td>";
          echo "<td>" . $dia_data['nome_emp'] . "</td>";
          echo "<td>" . $dia_data['funcao_func'] . "</td>";
          echo "<td>" . $dia_data['dia_diariaEmp'] . "</td>";
          echo "<td> <a class = 'btn btn-primary' href='editDia.php?id_diariaEmp=$dia_data[id_diariaEmp]&dia_diariaEmp=$dia_data[dia_diariaEmp]'> Alterar </a> <a name='deleteDia' class = 'btn btn-danger' href='deleteDia.php?id_diariaEmp=$dia_data[id_diariaEmp]'> Excluir   </a> </td>";
        }
        ?>
      </tbody>
    </table>
  </div>

</body>

</html>