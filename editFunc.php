<?php

include_once('config.php');

if (!empty($_GET['id_func'])) {

  $id_func = $_GET['id_func'];

  $sqlSelect = "SELECT * FROM funcao WHERE id_func = $id_func";

  $result = $conexao->query($sqlSelect);

  if ($result->num_rows > 0) {
    while ($func_data = mysqli_fetch_assoc($result)) {
      $funcao = $func_data['funcao_func'];
    }
  } else {
    header('Location: cadAtv.php');
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
  <title>Alterar Função</title>

  </style>
</head>

<body>

  <div class="container">
    <h1>Alterar Função</h1>
    <form action="updateAtv.php" method="post">
      <div class="input">
        <label for="funcao">Função:</label>
        <input type="text" name="funcao" value="<?php echo $funcao ?>" />
      </div>
      <input type="hidden" name="id_func" value="<?php echo $id_func ?>">
      <button type="submit" name="updateFunc">Alterar função</button><br>
    </form>
    <a class="btn btn-primary voltar" href="cadFunc.php">Voltar</a>
  </div>

</body>

</html>