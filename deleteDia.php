<?php

include_once('config.php');

if (!empty($_GET['id_diariaEmp'])) {

  $id_diariaEmp = $_GET['id_diariaEmp'];

  $sqlSelect = "SELECT * FROM diaria_empregado WHERE id_diariaEmp = $id_diariaEmp ";

  $result = $conexao->query($sqlSelect);

  if ($result->num_rows > 0) {
    $sqlDelete = "DELETE FROM diaria_empregado WHERE id_diariaEmp = $id_diariaEmp";

    $resultDeleteDia = $conexao->query($sqlDelete);
    header('Location: cadDia.php');
  }
}
