<?php
require_once("../layout/header.php");
require_once("../Database.php");
require_once("./clientFunction.php");

if(isset($_SESSION['okRegister'])){
    echo'<p class="bg-success text-center pt-4 pb-4 text-white">'.$_SESSION['okRegister'].'</p>';
    unset($_SESSION['okRegister']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username']) && isset($_POST["password"]) && !empty($_POST['username']) && !empty($_POST["password"])) {
        try {
            if (getUser($_POST['username'], $_POST["password"])){
                $_SESSION['user'] = $_POST['username'];
                echo "<script>window.location.href = '../index.php';</script>";
            }else{
                echo '<div class="alert alert-danger mt-3">Usuario o contraseña incorrectos.</div>';
            }
        

        } catch (PDOException $e) {
            echo "<div class=\"alert alert-danger mt-3\">{$e->getMessage()}</div>";

        }
    } else {
        echo '<div class="alert alert-danger mt-3">Usuario o password no enviado.</div>';

    }

}

?>

<div class="container mt-5">
    <h2 class="text-center">Iniciar Sesión</h2>
    <form action="login.php" method="POST" class="mt-4">
        <div class="mb-3">
            <label for="username" class="form-label">Usuario</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
    </form>
</div>
<div class="container mt-5">
    <a href="../index.php" class="btn btn-primary"><span class="glyphicon glyphicon-th-list"></span>Volver</a>
</div>
<?php 
    require_once("../layout/footer.php");
?>

