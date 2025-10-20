<?php
require_once("../layout/header.php");
require_once("../Database.php");
include("./orderFunction.php");
include("./pizzaFunctions.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order num</title>
</head>
<body>
    <h2>Pedido hecho correctamente</h2>
    <p>Aqui tiene su numero para rastrear su pedido: </p>
</body>
</html>

<?php 
    require_once("../layout/footer.php");
?>

