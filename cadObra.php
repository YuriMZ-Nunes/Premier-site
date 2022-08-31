<?php

include_once('config.php');


if (isset($_POST['submit'])) {

  $nomeCli = $_POST['nomeCli'];
  $condObra = $_POST['condObra'];
  $loteObra = $_POST['loteObra'];
  $endObra = $_POST['endObra'];
  $tipoObra = $_POST['tipoObra'];
  $areaObra = $_POST['areaObra'];
  $piscObra = $_POST['piscObra'];
  $iniObra = $_POST['iniObra'];
  $termObra = $_POST['termObra'];

  $result = mysqli_query($conexao, "INSERT INTO obra VALUES (0, '$nomeCli', '$condObra', '$loteObra', '$endObra', '$tipoObra', '$areaObra', '$piscObra', '$iniObra', '$termObra')");
}
$sqlObra = "SELECT * FROM obra as o, cliente as c WHERE o.id_cli = c.id_cli";

$resultObra = $conexao->query($sqlObra);


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
  <title>Cadastrar Obra</title>
</head>

<body>
  <div class="container">
    <h1>Cadastrar Obra</h1>

    <form action="" method="post">
      <div class="input">
        <label for="nomeCli">Nome:</label>
        <select name="nomeCli">
          <option value="" data-default disabled selected></option>
          <?php echo $optionCli ?>
        </select>
      </div>
      <div class="input">
        <label for="condObra">Condomínio:</label>
        <input type="text" name="condObra" />
      </div>
      <div class="input">
        <label for="loteObra">Lote:</label>
        <input type="text" name="loteObra" />
      </div>
      <div class="input">
        <label for="endObra">Endereço</label>
        <input type="text" name="endObra"  />
      </div>
      <div class="input">
        <label for="tipoObra">Tipo:</label>
        <input type="text" name="tipoObra" maxlength="7"  />
      </div>
      <div class="input">
        <label for="areaObra">Área:</label>
        <input type="number" name="areaObra"  />
      </div>
      <div class="input">
        <label for="piscObra">Piscina:</label>
        <input type="text" name="piscObra"  />
      </div>
      <div class="input">
        <label for="iniObra">Data de início:</label>
        <input type="date" name="iniObra"  />
      </div>
      <div class="input">
        <label for="termObra">Data de término:</label>
        <input type="date" name="termObra"  />
      </div>

      <button type="submit" name="submit">Cadastrar obra</button>
    </form><br>

    <a class="btn btn-primary voltar" href="index.php">Voltar</a>

  </div>


  <div>
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">id_obra</th>
          <th scope="col">Nome cliente</th>
          <th scope="col">Condominio</th>
          <th scope="col">Lote</th>
          <th scope="col">Endereço</th>
          <th scope="col">Tipo</th>
          <th scope="col">Area</th>
          <th scope="col">Piscina</th>
          <th scope="col">Data de inicio</th>
          <th scope="col">Data de entrega</th>

          <th scope="col">Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php
        while ($obra_data = mysqli_fetch_assoc($resultObra)) {
          echo "<tr>";
          echo "<td>" . $obra_data['id_obra'] . "</td>";
          echo "<td>" . $obra_data['nome_cli'] . "</td>";
          echo "<td>" . $obra_data['condominio_obra'] . "</td>";
          echo "<td>" . $obra_data['lote_obra'] . "</td>";
          echo "<td>" . $obra_data['endereco_obra'] . "</td>";
          echo "<td>" . $obra_data['tipo_obra'] . "</td>";
          echo "<td>" . $obra_data['area_obra'] . "</td>";
          echo "<td>" . $obra_data['piscina_obra'] . "</td>";
          echo "<td>" . $obra_data['dataInicio_obra'] . "</td>";
          echo "<td>" . $obra_data['dataEntrega_obra'] . "</td>";
          echo "<td> <a class = 'btn btn-primary' href='editObra.php?id_obra=$obra_data[id_obra]'> Alterar </a> <a class = 'btn btn-danger' href='deleteObra.php?id_obra=$obra_data[id_obra]'> Excluir   </a> </td>";
        }
        ?>
      </tbody>
    </table>
  </div>

</body>

</html>