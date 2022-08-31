<?php

include_once('config.php');

if (isset($_POST['submitAE'])) {
  $idteste = $_POST['teste'];
}

echo $_POST['teste'] . ' = foda';

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <input type="text" name="test" value="<?php echo $idteste ?>">
</body>

</html>