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

