<?php

include_once('config.php');

if (isset($_POST['submit'])) {

  $nome_cli = $_POST['nome'];
  $cpf_cli = $_POST['cpf'];
  $telefone_cli = $_POST['telefone'];


  $result = mysqli_query($conexao, "INSERT INTO cliente VALUES (0, '$nome_cli', '$cpf_cli', '$telefone_cli')");
}
$sqlCli = "SELECT * FROM cliente";

$resultCli = $conexao->query($sqlCli);


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="style/style.css">

  <title>Cadastrar Cliente</title>
</head>

<body>
  <div class="container">
    <h1>Cadastrar Cliente</h1>
    <form action="cadCli.php" method="post">
      <div class="input">
        <label for="nome">Nome: (obrigatorio)</label>
        <input type="text" name="nome" require /> 
      </div>
      <div class="input">
        <label for="cpf">CPF:</label>
        <input type="text" name="cpf" maxlength="15"  />

      </div>
      <div class="input"><label for="telefone">Telefone:</label>
        <input type="text" name="telefone" maxlength="15"  />
      </div>



      <button type="submit" name="submit">cadastrar cliente</button>
    </form><br>
    <a class="btn btn-primary voltar" href="index.php">Voltar</a>
  </div>


  <div>
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">id_cli</th>
          <th scope="col">Nome</th>
          <th scope="col">CPF</th>
          <th scope="col">Telefone</th>
          <th scope="col">Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php
        while ($cli_data = mysqli_fetch_assoc($resultCli)) {
          echo "<tr>";
          echo "<td>" . $cli_data['id_cli'] . "</td>";
          echo "<td>" . $cli_data['nome_cli'] . "</td>";
          echo "<td>" . $cli_data['cpf_cli'] . "</td>";
          echo "<td>" . $cli_data['telefone_cli'] . "</td>";

          echo "<td> <a class = 'btn btn-primary' href='editCli.php?id_cli=$cli_data[id_cli]'> Alterar </a> ";
        }
        ?>
      </tbody>
    </table>
  </div>



</body>

</html>