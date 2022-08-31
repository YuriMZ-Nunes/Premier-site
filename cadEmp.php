<?php

include_once('config.php');


if (isset($_POST['submit'])) {


  $nomeEmp = $_POST['nomeEmp'];
  $rgEmp = $_POST['rgEmp'];
  $cpfEmp = $_POST['cpfEmp'];
  $numEmp = $_POST['numEmp'];
  $valorEmp = $_POST['valorEmp'];
  $bancoEmp = $_POST['bancoEmp'];
  $agEmp = $_POST['agEmp'];
  $contaEmp = $_POST['contaEmp'];
  $pixEmp = $_POST['pixEmp'];

  $result = mysqli_query($conexao, "INSERT INTO empregado VALUES (0, '$nomeEmp', '$rgEmp', '$cpfEmp', '$numEmp', '$valorEmp', '$bancoEmp', '$agEmp', '$contaEmp', '$pixEmp')");
}

$sqlEmp = "SELECT * FROM empregado";

$resultEmp = $conexao->query($sqlEmp);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="style/style.css">
  <title>Cadastrar Empregado</title>
</head>

<body>


  <div class="container">
    <h1>Cadastrar empregado</h1>
    <form action="" method="post">
      <div class="input">
        <label for="nomeEmp">Nome:</label>
        <input type="text" name="nomeEmp" required />
      </div>
      <div class="input">
        <label for="rgEmp">RG:</label>
        <input type="text" name="rgEmp" maxlength="10"  />
      </div>
      <div class="input">
        <label for="cpfEmp">CPF:</label>
        <input type="text" name="cpfEmp" maxlength="11"  />
      </div>
      <div class="input">
        <label for="numEmp">Telefone:</label>
        <input type="text" name="numEmp" maxlength="11"  />
      </div>

      <div class="input">
        <label for="bancoEmp">Banco:</label>
        <input type="number" name="bancoEmp" />
      </div>
      <div class="input">
        <label for="agEmp">Agência:</label>
        <input type="number" name="agEmp" />
      </div>
      <div class="input">
        <label for="contaEmp">Conta:</label>
        <input type="number" name="contaEmp" />
      </div>
      <div class="input">
        <label for="pixEmp">PIX:</label>
        <input type="text" name="pixEmp" />
      </div>

      <button type="submit" name="submit">Cadastrar empregado</button>
    </form><br>
    <a class="btn btn-primary voltar" href="index.php">Voltar</a>



  </div>
  <div>
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">id_emp</th>
          <th scope="col">Nome</th>
          <th scope="col">RG</th>
          <th scope="col">CPF</th>
          <th scope="col">Numero</th>
          <th scope="col">Valor diaria</th>
          <th scope="col">Banco</th>
          <th scope="col">Agencia</th>
          <th scope="col">Conta</th>
          <th scope="col">Pix</th>
          <th scope="col">Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php
        while ($emp_data = mysqli_fetch_assoc($resultEmp)) {
          echo "<tr>";
          echo "<td>" . $emp_data['id_emp'] . "</td>";
          echo "<td>" . $emp_data['nome_emp'] . "</td>";
          echo "<td>" . $emp_data['rg_emp'] . "</td>";
          echo "<td>" . $emp_data['cpf_emp'] . "</td>";
          echo "<td>" . $emp_data['telefone_emp'] . "</td>";
          echo "<td>" . $emp_data['valorDiaria_emp'] . "</td>";
          echo "<td>" . $emp_data['banco_emp'] . "</td>";
          echo "<td>" . $emp_data['ag_emp'] . "</td>";
          echo "<td>" . $emp_data['cnt_emp'] . "</td>";
          echo "<td>" . $emp_data['pix_emp'] . "</td>";
          echo "<td> <a class = 'btn btn-primary' href='editEmp.php?id_emp=$emp_data[id_emp]'> Alterar </a>";
        }
        ?>
      </tbody>
    </table>
  </div>


</body>

</html>