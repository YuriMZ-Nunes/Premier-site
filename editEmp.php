<?php

include_once('config.php');


if (!empty($_GET['id_emp'])) {

  $id_emp = $_GET['id_emp'];

  $sqlSelect = "SELECT * FROM empregado WHERE id_emp = $id_emp";

  $result = $conexao->query($sqlSelect);

  if ($result->num_rows > 0) {
    while ($emp_data = mysqli_fetch_assoc($result)) {
      $nomeEmp = $emp_data['nome_emp'];
      $rgEmp = $emp_data['rg_emp'];
      $cpfEmp = $emp_data['cpf_emp'];
      $numEmp = $emp_data['telefone_emp'];
      $valorEmp = $emp_data['valorDiaria_emp'];
      $bancoEmp = $emp_data['banco_emp'];
      $agEmp = $emp_data['ag_emp'];
      $contaEmp = $emp_data['cnt_emp'];
      $pixEmp = $emp_data['pix_emp'];
    }
  } else {
    header('Location: index.php');
  }
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
  <title>Alterar Empregado</title>

</head>

<body>
  <div class="container">
    <h1>Alterar empregado</h1>

    <form action="updateAtv.php" method="post">
      <div class="input">
        <label for="nomeEmp">Nome:</label>
        <input type="text" name="nomeEmp" required value="<?php echo $nomeEmp ?>" />
      </div>
      <div class="input">
        <label for="rgEmp">RG:</label>
        <input type="text" name="rgEmp" maxlength="10"  value="<?php echo $rgEmp ?>" />
      </div>
      <div class="input">
        <label for="cpfEmp">CPF:</label>
        <input type="text" name="cpfEmp" maxlength="11"  value="<?php echo $cpfEmp ?>" />
      </div>
      <div class="input">
        <label for="numEmp">Telefone:</label>
        <input type="text" name="numEmp"  maxlength="11" value="<?php echo $numEmp ?>" />
      </div>
      <div class="input">
        <label for="valorEmp">Valor diária:</label>
        <input type="number" name="valorEmp"  value="<?php echo $valorEmp ?>" />
      </div>
      <div class="input">
        <label for="bancoEmp">Banco:</label>
        <input type="number" name="bancoEmp" value="<?php echo $bancoEmp ?>" />
      </div>
      <div class="input">
        <label for="agEmp">Agência:</label>
        <input type="text" name="agEmp" value="<?php echo $agEmp ?>" />
      </div>
      <div class="input">
        <label for="contaEmp">Conta:</label>
        <input type="number" name="contaEmp" value="<?php echo $contaEmp ?>" />
      </div>
      <div class="input">
        <label for="pixEmp">PIX:</label>
        <input type="text" name="pixEmp" value="<?php echo $pixEmp ?>" />
      </div>

      <input type="hidden" name="id_emp" value="<?php echo $id_emp ?>">
      <button type="submit" name="updateEmp">Alterar empregado</button>
    </form><br>
    <a class="btn btn-primary voltar" href="cadEmp.php">Voltar</a>
  </div>

</body>

</html>