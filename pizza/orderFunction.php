<?php 

function showSizes(){
    $sizes = getSizesDiameter();

    foreach($sizes as $size){
        echo    "<option value=". $size['tamano'] . ">".$size['tamano']." ". $size['precio']."</option>";
    }



}

