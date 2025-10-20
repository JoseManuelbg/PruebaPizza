<?php 
require_once("layout/header.php");

 ?>
<div><h1 class="text-center"><Basefont>Pizzeria a domicilio o a recoger Jacaranda</Basefont></h1></div>
<?php 
if(!isset($_SESSION['user'])){
echo '<main class="container my-5">
        <section id="funciones" class="text-center">
            <h2 class="mb-4">¿Qué puedes hacer aquí?</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            <h5 class="card-title">Nuestras Pizzas</h5>
                            <p class="card-text">Podrás personalizar las pizzas según prefieras</p>
                            <img src="img/pizza.jpeg">

                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            <h5 class="card-title">Nuestros ingredientes</h5>
                            <p class="card-text">Consulta aquí los ingredientes de nuestras pizzas</p>
                            <a href="./pizza/ingredients.php" class="btn btn-primary">Ver ingredientes</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            <h5 class="card-title">Zona de reparto</h5>
                            <p class="card-text">Comprrueba aquí nuestra sona de reparto.</p>
                            <a href="zone.php" class="btn btn-primary">Ver zonas</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="mt-5 text-center">
            <h2 class="mb-4">¡Haz tu registro!</h2>
            <p>Si eres nuevo, crea una cuenta para poder realizar los pedidos.</p>
            <a href="client/signup.php" class="btn btn-success btn-lg">Registrarme</a>
        </section>
    </main>';
}else{
   echo '<main class="container my-5">
        <section id="funciones" class="text-center">
            <h2 class="mb-4">¿Qué puedes hacer aquí?</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            <h5 class="card-title">Nuestras Pizzas</h5>
                            <p class="card-text">Podrás personalizar las pizzas según prefieras</p>
                            <img src="img/pizza.jpeg">

                        </div>
                    </div>
                </div>
  
        </section>
    </main>';
}
?>
<?php 
    require_once("layout/footer.php");
?>

