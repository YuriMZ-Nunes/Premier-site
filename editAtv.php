<?php

include_once('config.php');


if (!empty($_GET['id_atv'])) {

  $id_atv = $_GET['id_atv'];

  $sqlSelect = "SELECT * FROM atividade WHERE id_atv = $id_atv";

  $result = $conexao->query($sqlSelect);

  if ($result->num_rows > 0) {
    while ($atv_data = mysqli_fetch_assoc($result)) {
      $atividade = $atv_data['atividade_atv'];
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
  <title>Alterar Atividade</title>


</head>

<body>
  <div class="container">
    <h1>Alterar Atividade</h1>
    <form action="updateAtv.php" method="post">
      <div class="input">
        <label for="atividade">Editar atividade</label>
        <input type="text" name="atividade" require value='<?php echo $atividade ?>' />
        <input type="hidden" name="id_atv" value="<?php echo $id_atv ?>">
      </div>

      <button type="submit" name="updateAtv">Alterar atividade</button><br>
    </form>
    <a class="btn btn-primary voltar" href="cadAtv.php">Voltar</a>
  </div>

</body>

</html>