<?php

include_once('config.php');


if (!empty($_GET['id_obra'])) {

  $id_obra = $_GET['id_obra'];


  $sqlSelect = "SELECT * FROM obra WHERE id_obra = $id_obra";

  $result = $conexao->query($sqlSelect);

  if ($result->num_rows > 0) {
    while ($obra_data = mysqli_fetch_assoc($result)) {
      $condObra = $obra_data['condominio_obra'];
      $loteObra = $obra_data['lote_obra'];
      $endObra = $obra_data['endereco_obra'];
      $tipoObra = $obra_data['tipo_obra'];
      $areaObra = $obra_data['area_obra'];
      $piscObra = $obra_data['piscina_obra'];
      $iniObra = $obra_data['dataInicio_obra'];
      $termObra = $obra_data['dataEntrega_obra'];
    }
  } else {
    header('Location: index.php');
  }
}

$sqlSelectCli = "SELECT * FROM cliente";
$resultCli = $conexao->query($sqlSelectCli);
$optionCli = '';

while ($rowCli = mysqli_fetch_array($resultCli)) {
  $optionCli = $optionCli . "<option value='$rowCli[0]'>$rowCli[1]<option>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="style/style.css">
  <title>Alterar Obra</title>

</head>

<body>
  <h1>Alterar Obra</h1>

  <div class="container">
    <form action="updateAtv.php" method="post">
      <div class="input">
        <label for="nomeCli">Nome do cliente:</label>
        <select name="nomeCli">
          <option value="" data-default disabled selected></option>
          <?php echo $optionCli ?>
        </select>

      </div>
      <div class="input">
        <label for="condObra">Condomínio:</label>
        <input type="text" name="condObra" value="<?php echo $condObra ?>" />
      </div>
      <div class="input">
        <label for="loteObra">Lote:</label>
        <input type="text" name="loteObra" value="<?php echo $loteObra ?>" />
      </div>
      <div class="input">
        <label for="endObra">Endereço:</label>
        <input type="text" name="endObra"  value="<?php echo $endObra ?>" />
      </div>
      <div class="input">
        <label for="tipoObra">Tipo:</label>
        <input type="text" name="tipoObra" maxlength="7"  value="<?php echo $tipoObra ?>" />
      </div>
      <div class="input">
        <label for="areaObra">Área:</label>
        <input type="number" name="areaObra"  value="<?php echo $areaObra ?>" />
      </div>
      <div class="input">
        <label for="piscObra">Piscina:</label>
        <input type="text" name="piscObra"  value="<?php echo $piscObra ?>" />
      </div>
      <div class="input">
        <label for="iniObra">Data de início:</label>
        <input type="date" name="iniObra"  value="<?php echo $iniObra ?>" />
      </div>
      <div class="input">
        <label for="termObra">Data de término:</label>
        <input type="date" name="termObra"  value="<?php echo $termObra ?>" />
      </div>

      <input type="hidden" name="id_obra" value="<?php echo $id_obra ?>">
      <button type="submit" name="updateObra">Alterar obra</button>
    </form><br>
    <a class="btn btn-primary voltar" href="cadObra.php">Voltar</a>
  </div>



</body>

</html>