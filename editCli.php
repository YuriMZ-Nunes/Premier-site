<?php

include_once('config.php');

if (!empty($_GET['id_cli'])) {
  $id_cli = $_GET['id_cli'];

  $sqlSelect = "SELECT * FROM cliente WHERE id_cli = $id_cli";

  $result = $conexao->query($sqlSelect);

  if ($result->num_rows > 0) {
    while ($cli_data = mysqli_fetch_assoc($result)) {
      $nome_cli = $cli_data['nome_cli'];
      $cpf_cli = $cli_data['cpf_cli'];
      $telefone_cli = $cli_data['telefone_cli'];
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

  <title>Cadastrar Cliente</title>
</head>

<body>
  <div class="container">
    <h1>Cadastrar Cliente</h1>
    <form action="updateAtv.php" method="post">
      <div class="input">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" require value="<?php echo $nome_cli ?>" />
      </div>
      <div class="input">
        <label for="cpf">CPF:</label>
        <input type="text" name="cpf"  maxlength="11" value="<?php echo $cpf_cli ?>" />

      </div>
      <div class="input"><label for="telefone">Telefone:</label>
        <input type="text" name="telefone"  maxlength="11" value="<?php echo $telefone_cli ?>" />
      </div>
      <input type="hidden" name="id_cli" value="<?php echo $id_cli ?>">




      <button type="submit" name="updateCli">Alterar</button>
    </form><br>
    <a class="btn btn-primary voltar" href="index.php">Voltar</a>
  </div>



</body>

</html>