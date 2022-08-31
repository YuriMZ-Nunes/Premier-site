<?php

include_once('config.php');

if (!empty($_GET['id_obra'])) {

  $id_obra = $_GET['id_obra'];

  $sqlSelect = "SELECT * FROM obra WHERE id_obra = $id_obra ";

  $result = $conexao->query($sqlSelect);

  if ($result->num_rows > 0) {
    $sqlDelete = "DELETE FROM obra WHERE id_obra = $id_obra";

    $resultDelete = $conexao->query($sqlDelete);
    header('Location: cadObra.php');
  }
}
