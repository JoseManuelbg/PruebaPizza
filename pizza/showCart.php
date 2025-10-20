<?php
require_once("../layout/header.php");
require_once("../Database.php");
include("./orderFunction.php");
include("./pizzaFunctions.php");

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Order</title>
</head>
<body>
    <?php

        $ingredients = getIngredients();
        $size = getSizesDiameter();
        if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])){
            echo '<p>No tienes ninguna pizza encargada todavia, prueba a hacer una</p>';
        }else{
           foreach($_SESSION['cart'] as $pizza){
            $sizeText = getSizeById($size, $pizza['size_id']);
            echo "<p>".$sizeText['tamano']."</p>";
                foreach($pizza['ingredients'] as $ingredient){
                    $ing = getIngredientById($ingredients, $ingredient);
                    echo "<p>".$ing['ingrediente']," ", ($ing['precio'] * $sizeText['diametro'])."</p>";
                }
                echo '<hr>';
        }
        }
        
    ?>
    <form method="POST">
        <button type="submit">Comprar</button>
    </form>
</body>
</html>

<?php 
    require_once("../layout/footer.php");
?>

