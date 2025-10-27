<?php 

function getIngredients(){

    $connection = Database::getInstance()->getConnection();
    $query = 'SELECT * FROM `ingrediente` ORDER BY ingrediente ASC';
    $stmt = $connection->query($query);
    $result = $stmt->fetchAll();
    return $result;
}

function getSizesDiameter(){
    $connection = Database::getInstance()->getConnection();
    $query = 'SELECT * FROM `tamano`';
    $stmt = $connection->query($query);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function printIngredients(){
    $ingredients = getIngredients();
    $sizes = getSizesDiameter();
    foreach($ingredients as $i){
           echo '<tr>';

        echo '<td>' . $i['ingrediente'] . '</td>';
        //Quantity
        echo '<td>';
        switch (true) {
            case ($i['stock'] > 150):
                echo 'No te preocupes, tenemos muchisimo';
                break;
            case ($i['stock']> 50):
                echo 'Hay bastante';
                break;
            case ($i['stock'] >10 ):
                echo 'Queda poco de este ingrediente';
                break;
            case ($i['stock'] <= 10):
                echo 'Se nos acabó el ingrediente';
                break;
            
        }
        echo '</td>';
        //SIzes
         foreach($sizes as $s){
            
        
        echo '<td>'.$s['diametro'] * $i['precio'].'</td>';
         }
           echo '</tr>';

    }

}


function renderIngredients($name, $ingredients){
    echo "<select name='$name'>";
    echo "<option value=''>-- Selecciona un ingrediente --</option>";
    foreach($ingredients as $ingredient){
        echo "<option value={$ingredient['id']}>". $ingredient['ingrediente']. "</option>";
    }
    echo'</select>';
}

function getIngredientById($ingredients, $id){
    foreach($ingredients as $ingredient){
        if($ingredient['id'] == $id){
            return $ingredient;
        }
    }
}

function getSizeById($sizes, $id){
    foreach($sizes as $size){

        if($size['id'] == $id){ 
            
            return $size;
        }
    }
}

/**
 * Orden para hacer un pedido
 * 1. Pizza X
 * 2. Pizza_Ingrediente X
 * 3. Pedido 
 * 4. Pedido_pizza
 */

function addPizzaOrder($username,$price, $sizeId, $ing1Id, $ing2Id, $ing3Id){
    $date = date('Y-m-d');
    $connection = Database::getInstance()->getConnection();
    $connection->beginTransaction();
    try {
        //Crear pizza
        $query = "INSERT INTO `pizza`(`tamano_id`) VALUES (:sizeId)";
        $stmt = $connection->prepare($query);
        $stmt->bindParam('sizeId', $sizeId);
        $stmt->execute();

        //Recuperar el ultimo insert
        $query = "SELECT pizza.id FROM pizza ORDER BY pizza.id DESC";
        $stmt = $connection->prepare($query);
        $stmt->execute();
        $lastInsertPizzaId = $stmt->fetchAll(PDO::FETCH_ASSOC);
        var_dump($lastInsertPizzaId);
        //Crear insert de los 3 ingredientes de la pizza
        $query = "INSERT INTO `pizza_ingrediente`(`pizza_id`, `flavor_id`) VALUES (:lastInsertedId, :ingId)";
        $stmt = $connection->prepare($query);
        $stmt->bindParam("lastInsertedId", $lastInsertPizzaId[0]['id']);
        $stmt->bindParam("ingId", $ing1Id);
        $stmt->execute();
        $query = "INSERT INTO `pizza_ingrediente`(`pizza_id`, `flavor_id`) VALUES (:lastInsertedId, :ingId)";
        $stmt = $connection->prepare($query);
        $stmt->bindParam("lastInsertedId", $lastInsertPizzaId[0]['id']);
        $stmt->bindParam("ingId", $ing2Id);
        $stmt->execute();
        $query = "INSERT INTO `pizza_ingrediente`(`pizza_id`, `flavor_id`) VALUES (:lastInsertedId, :ingId)";
        $stmt = $connection->prepare($query);
        $stmt->bindParam("lastInsertedId", $lastInsertPizzaId[0]['id']);
        $stmt->bindParam("ingId", $ing3Id);
        $stmt->execute();

        //Pedido
        $query = "INSERT INTO `pedido`(`username`, `precio`, `fecha`) VALUES (:username, :price, :date)";
        $stmt = $connection->prepare($query);
        $stmt->bindParam('username', $username);
        $stmt->bindParam("price", $price);
        $stmt->bindParam("date", $date);
        $stmt->execute();

        //Recuperar el ultimo pedido insertado
        $query = "SELECT pedido.id FROM `pedido` ORDER BY pedido.id DESC";
        $stmt = $connection->query($query);
        $stmt->execute();
        $orderId = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //Pedido pizza
        $query = "INSERT INTO `pedido_pizza`(`id_pedido`, `id_pizza`) VALUES (:orderId, :pizzaId)";
        $stmt = $connection->prepare($query);
        $stmt->bindParam("orderId", $orderId[0]['id']);
        $stmt->bindParam("pizzaId", $lastInsertPizzaId[0]['id']);
        $stmt->execute();

        $connection->commit();

    } catch (Exception $th) {
        $connection->rollBack();
        throw $th;
    }

}

