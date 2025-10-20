<?php
require_once("../layout/header.php");
require_once('../Database.php');
include('./pizzaFunctions.php')


?>
<h1 class="text-center">Ingredientes disponibles</h1>
<div class="container mt-5">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Ingredientes</th>
                <th>Disponibilidad</th>
                <th>Pequeña</th>
                <th>Mediana</th>
                <th>Grande</th>
                <th>Extra Grande</th>
            </tr>
        </thead>
        <tbody>

           <?php
           printIngredients();
           ?>
        </tbody>
    </table>

    <a href="../index.php" class="btn btn-primary"><span class="glyphicon glyphicon-th-list"></span>Volver</a>
</div>
<?php
require_once("../layout/footer.php");
?>