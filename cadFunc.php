<?php

include_once('config.php');

if (isset($_POST['submit'])) {

  $funcao = $_POST['funcao'];

  $result = mysqli_query($conexao, "INSERT INTO funcao VALUES (0, '$funcao')");
}
$sqlFunc = "SELECT * FROM funcao";

$resultFunc = $conexao->query($sqlFunc);
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="style/style.css">
  <title>Cadastrar Função</title>
</head>

<body>
  <div class="container">
    <h1>Cadastrar Função</h1>
    <form action="cadFunc.php" method="post">
      <div class="input">
        <label for="funcao">Função:</label>
        <input type="text" name="funcao" />
      </div>

      <button type="submit" name="submit">cadastrar função</button>
    </form><br>
    <a class="btn btn-primary voltar" href="index.php">Voltar</a>
  </div>


  <div>
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">id_func</th>
          <th scope="col">Função</th>
          <th scope="col">Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php
        while ($func_data = mysqli_fetch_assoc($resultFunc)) {
          echo "<tr>";
          echo "<td>" . $func_data['id_func'] . "</td>";
          echo "<td>" . $func_data['funcao_func'] . "</td>";
          echo "<td> <a class = 'btn btn-primary' href='editFunc.php?id_func=$func_data[id_func]'> Alterar </a>";
        }
        ?>
      </tbody>
    </table>
  </div>

</body>

</html>