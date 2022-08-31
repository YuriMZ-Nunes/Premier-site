<?php

include_once('config.php');


if (isset($_POST['submit'])) {

  include_once('config.php');

  $atividade = $_POST['atividade'];

  $result = mysqli_query($conexao, "INSERT INTO atividade VALUES (0, '$atividade')");
}


$sqlAtv = "SELECT * FROM atividade";

$resultAtv = $conexao->query($sqlAtv);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="style/style.css">
  <title>Cadastrar Atividade</title>



</head>

<body>
  <div class="container">
    <h1>Cadastrar Atividade</h1>
    <form action="" method="post">
      <div class="input">
        <label for="atividade">Atividade:</label>
        <input type="text" name="atividade" require />
      </div>

      <button type="submit" name="submit">cadastrar atividade</button>
    </form><br>
    <a class="btn btn-primary voltar" href="index.php">Voltar</a>





  </div>
  <div>
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">id_atv</th>
          <th scope="col">Atividade</th>
          <th scope="col">Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php
        while ($atv_data = mysqli_fetch_assoc($resultAtv)) {
          echo "<tr>";
          echo "<td>" . $atv_data['id_atv'] . "</td>";
          echo "<td>" . $atv_data['atividade_atv'] . "</td>";
          echo "<td> <a class = 'btn btn-primary' href='editAtv.php?id_atv=$atv_data[id_atv]'> Alterar </a>";
        }
        ?>
      </tbody>
    </table>
  </div>
</body>

</html>