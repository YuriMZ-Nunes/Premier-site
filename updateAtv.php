<?php

include_once('config.php');

if (isset($_POST['updateAtv'])) {

  $editId_atv = $_POST['id_atv'];
  $editAtividade = $_POST['atividade'];

  $sqlAtvUp = "UPDATE atividade SET atividade_atv='$editAtividade' WHERE id_atv = $editId_atv";

  $resultAtv = $conexao->query($sqlAtvUp);

  header('Location: cadAtv.php');
} elseif (isset($_POST['updateFunc'])) {
  $editId_func = $_POST['id_func'];
  $editFuncao = $_POST['funcao'];

  $sqlFuncUp = "UPDATE funcao SET funcao_func='$editFuncao' WHERE id_func = $editId_func";

  $resultFunc = $conexao->query($sqlFuncUp);

  header('Location: cadFunc.php');
} elseif (isset($_POST['updateEmp'])) {
  $editId_emp = $_POST['id_emp'];
  $nomeEmp = $_POST['nomeEmp'];
  $rgEmp = $_POST['rgEmp'];
  $cpfEmp = $_POST['cpfEmp'];
  $numEmp = $_POST['numEmp'];
  $valorEmp = $_POST['valorEmp'];
  $bancoEmp = $_POST['bancoEmp'];
  $agEmp = $_POST['agEmp'];
  $contaEmp = $_POST['contaEmp'];
  $pixEmp = $_POST['pixEmp'];

  $sqlEmpUp = "UPDATE empregado SET 
  nome_emp = '$nomeEmp', 
  rg_emp = '$rgEmp',  
  cpf_emp = '$cpfEmp',
  telefone_emp = '$numEmp',
  valorDiaria_emp = '$valorEmp',
  banco_emp = '$bancoEmp',
  ag_emp = '$agEmp',
  cnt_emp = '$contaEmp',
  pix_emp = '$pixEmp' 
  WHERE id_emp = $editId_emp";

  $resultEmp = $conexao->query($sqlEmpUp);

  header('Location: cadEmp.php');
} elseif (isset($_POST['updateObra'])) {
  $editId_obra = $_POST['id_obra'];
  $nomeCli = $_POST['nomeCli'];
  $condObra = $_POST['condObra'];
  $loteObra = $_POST['loteObra'];
  $endObra = $_POST['endObra'];
  $tipoObra = $_POST['tipoObra'];
  $areaObra = $_POST['areaObra'];
  $piscObra = $_POST['piscObra'];
  $iniObra = $_POST['iniObra'];
  $termObra = $_POST['termObra'];

  $sqlObraUp = "UPDATE obra SET
  id_cli = '$nomeCli',
  condominio_obra = '$condObra',
  lote_obra = '$loteObra',
  endereco_obra = '$endObra',
  tipo_obra = '$tipoObra',
  area_obra = '$areaObra',
  piscina_obra = '$piscObra',
  dataInicio_obra = '$iniObra',
  dataEntrega_obra = '$termObra'
  WHERE id_obra = $editId_obra";

  $resultObra = $conexao->query($sqlObraUp);


  header('Location: cadObra.php');
} elseif (isset($_POST['updateDia'])) {
  $editId_diariaEmp = $_POST['id_diariaEmp'];
  $id_obra = $_POST['id_obra'];
  $id_atv = $_POST['id_atv'];
  $id_emp = $_POST['id_emp'];
  $id_func = $_POST['id_func'];
  $diaDiaria = $_POST['diaDiaria'];

  $sqlDiaUp = "UPDATE diaria_empregado SET
  id_obra = '$id_obra',
  id_atv = '$id_atv',
  id_emp = '$id_emp',
  id_func = '$id_func',
  dia_diariaEmp = '$diaDiaria'
  WHERE id_diariaEmp = $editId_diariaEmp";


  $resultDia = $conexao->query($sqlDiaUp);

  header('Location: cadDia.php');
} elseif (isset($_POST['updateCli'])) {
  $editId_cli = $_POST['id_cli'];
  $nome = $_POST['nome'];
  $cpf_cli = $_POST['cpf'];
  $telefone_cli = $_POST['telefone'];

  $sqlCliUp = "UPDATE cliente SET
  nome_cli = '$nome',
  cpf_cli='$cpf_cli',
  telefone_cli='$telefone_cli'
  WHERE id_cli = $editId_cli";

  $resultCli = $conexao->query($sqlCliUp);

  header('Location: cadCli.php');
}
