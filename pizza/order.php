<?php
require_once("../layout/header.php");
require_once("../Database.php");
include("./orderFunction.php");
include("./pizzaFunctions.php");

$successMsg;
$errorMsg;

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $size = $_POST['size']  ?? '';
    $ing1 = $_POST['ingredient1'] ?? '';
    $ing2 = $_POST['ingredient2'] ?? '';
    $ing3 = $_POST['ingredient3'] ?? '';

    $ingredients = array_filter([$ing1,$ing2,$ing3]);

    if($size == '' || count($ingredients) === 0){
        $errorMsg = 'Debes elegir un tamaño y unos ingredientes';
    }else{
        if(!isset($_SESSION['cart'])){
            $_SESSION['cart'] = [];
        }

        $pizza = [
            'size_id' => $size,
            'ingredients' => $ingredients
        ];

        $_SESSION['cart'][] = $pizza;

        $successMsg='Pizza agregada correctamente';
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Pizza</title>
</head>
<body>
    <?php 
    if(isset($successMsg)){
        echo "<p>".$successMsg."</p>";
    }
    if(isset($errorMsg)){
        echo "<p>".$errorMsg."</p>";
    }
    ?>
    <form method="post">
        <label for="size">Tamaño</label>
        <select name="size" id="size">
            <option value="">-- Selecciona un tamaño</option>t
            <?php 
            
            $sizes = getSizesDiameter();
            foreach($sizes as $size){
                echo "<option value=". $size['id'] .">".$size['tamano']."</option>";
            }

            ?>
            
        </select>
        <?php 
        $ingredients = getIngredients();

        renderIngredients('ingredient1', $ingredients);
        renderIngredients('ingredient2', $ingredients);
        renderIngredients('ingredient3', $ingredients);

        ?>
        <button type="submit">Pedir</button>
    </form>
</body>
</html>

<?php 
    require_once("../layout/footer.php");
?>

