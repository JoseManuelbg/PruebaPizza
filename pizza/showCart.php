<?php
require_once("../layout/header.php");
require_once("../Database.php");
include("./orderFunction.php");
include("./pizzaFunctions.php");

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $totalPrice = 0;
    var_dump($_SESSION['cart']);
    foreach($_SESSION['cart'] as $pizza){
        $sizeDiameter = getSizeById(getSizesDiameter(),$pizza['size_id']);
        $totalPrice=+ $sizeDiameter['diametro'] * $pizza['ingredients']['0'];
        $totalPrice=+ $sizeDiameter['diametro'] * $pizza['ingredients']['1'];
        $totalPrice=+ $sizeDiameter['diametro'] * $pizza['ingredients']['2'];
        $username = $_SESSION['user'];
        $price = $totalPrice;
        $sizeId = $pizza['size_id'];
        $ing1Id = $pizza['ingredients']['0'];
        $ing2Id = $pizza['ingredients']['1'];
        $ing3Id = $pizza['ingredients']['2'];
        addPizzaOrder($username, $price, $sizeId, $ing1Id, $ing2Id, $ing3Id);
        unset($_SESSION['cart']);
        echo "<script>window.location.href = './orderNumber.php'</script>";
    }
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
        $totalPrice = 0;
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
                    $totalPrice += ($ing['precio'] * $sizeText['diametro']);
                }
                echo '<hr>';
        }
        echo " <form method='POST'>
        <button type='submit'>Comprar</button>
    </form>";
    echo "Total: ",  $totalPrice;

        }
        
    ?>
   
</body>
</html>

<?php 
    require_once("../layout/footer.php");
?>

