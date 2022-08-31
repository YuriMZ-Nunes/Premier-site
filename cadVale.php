<?php

include_once('config.php');

if (isset($_POST['submit'])) {
  $id_emp = $_POST['id_emp'];
  $dia_vale = $_POST['diaVale'];
  $valor_vale = $_POST['valorVale'];

  $sqlVale = mysqli_query($conexao, "INSERT INTO vale VALUES (0, '$id_emp', '$dia_vale', '$valor_vale')");
}


$sqlSelectEmp = "SELECT * FROM empregado";
$resultEmp = $conexao->query($sqlSelectEmp);
$optionEmp = '';
while ($rowEmp = mysqli_fetch_array($resultEmp)) {
  $optionEmp = $optionEmp . "<option value='$rowEmp[0]'>$rowEmp[1]<option>";
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

  <title>Cadastrar vale</title>
</head>

<body>
  <div class="container">
    <h1>Cadastrar vale</h1>
    <form action="cadVale.php" method="post">
      <div class="input">
        <label for="id_emp">Empregado:</label>
        <select name="id_emp">
          <option value="" data-default disabled selected></option>
          <?php echo $optionEmp ?>
        </select>
      </div>
      <div class="input"><label for="diaVale">Dia do recebimento:</label><input type="date" name="diaVale" require></div>
      <div class="input"><label for="valorVale">Valor do vale:</label><input type="number" name="valorVale" require></div>



      <button type="submit" name="submit">Cadastrar vale</button>
    </form><br>
    <a class="btn btn-primary voltar" href="index.php">Voltar</a>

  </div>

</body>

</html>