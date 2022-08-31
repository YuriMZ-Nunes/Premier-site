<?php

include_once('config.php');

if (!empty($_GET['id_diariaEmp'])) {

  $id_diariaEmp = $_GET['id_diariaEmp'];
  $dia_diariaEmp = $_GET['dia_diariaEmp'];

  $sqlSelectDia = "SELECT dia_diariaEmp FROM diaria_empregado WHERE id_diariaEmp = $dia_diariaEmp";

  $resultDia = $conexao->query($sqlSelectDia);

  if ($resultDia->num_rows > 0) {
    while ($dia_data = mysqli_fetch_assoc($resultDia)) {
      $dia_diaria = $dia_data['dia_diariaEmp'];
    }
  }

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
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="style/style.css">
  <title>Document</title>
</head>

<body>
  <div class="container">
    <h1>Editar diária</h1>
    <form action="updateAtv.php" method="post" id="diaria">
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
        <label for="diaDiaria">Selecionar dia:</label>
        <input type="date" name="diaDiaria" value="<?php echo $dia_diariaEmp ?>" require>
      </div>

      <input type="hidden" name="id_diariaEmp" value="<?php echo $id_diariaEmp ?>">

      <button type="submit" name="updateDia">Editar</button>
    </form><br>
    <a class="btn btn-primary voltar" href="index.php">Voltar</a>
  </div>
</body>

</html>