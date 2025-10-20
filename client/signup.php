<?php 
require_once('../Database.php');
require_once("../layout/header.php");
require('clientFunction.php');
$errors = array();
$values = [];
if($_SERVER['REQUEST_METHOD']=== 'POST'){

    //Save values
    isset($_POST['name']) ? $values['name'] = $_POST['name'] : '';
    isset($_POST['surname']) ? $values['surname'] = $_POST['surname'] : '';
    isset($_POST['address']) ? $values['address'] = $_POST['address'] : '';
    isset($_POST['age']) ? $values['age'] = $_POST['age'] : '';

    
    if(!empty($_POST['phoneNumber'])){


        $values['phoneNumber'] = $_POST['phoneNumber'];
        if(validatePhone($_POST['phoneNumber'])){
        
        array_push($errors, 'El numero ya existe');
    }
    }else{
        array_push($errors, 'El numero de telefono es un campo obligatorio');
    }

    if(!empty($_POST['username'])){
        $values['username'] = $_POST['username'];

            if(validateUsername($_POST['username'])){
        array_push($errors, 'Ya hay un usuario con ese nombre');
    }
    }else{
        array_push($errors, 'El nombre de usuario es un campo obligatorio');
    }

    if(!empty($_POST['passwd']) && !empty($_POST['passwdRe'])){
        if(!validatePasswd($_POST['passwd'], $_POST['passwdRe'])){
        array_push($errors, 'Las contraseñas no coinciden');
    }else{
        $passwd = encryptPasswd($_POST['passwd']);
    }
    }else{
        array_push($errors, 'Ambas contraseñas deben estar rellenas');
    }

    //Validacion para registrar
    if(empty($errors)){
        registerClient($_POST['name'], $_POST['surname'], $_POST['address'], $_POST['phoneNumber'], $_POST['age'],$passwd , $_POST['username']);
        $_SESSION['okRegister'] = '“Ya te has registrado, puedes entrar y pedir nuestras pizzas
cuando quieras';
        echo '<script>window.location.href = "login.php" </script>>';

    }

}

?>
<div class="container mt-5">
    <h2 class="text-center">Registrarse</h2>
    

    <form method="post" class="mt-4" >
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" value=<?php echo isset($values['name']) ? $values['name'] : ''?>>
        </div>

        <div class="mb-3">
            <label for="surname" class="form-label">Apellido</label>
            <input type="text" class="form-control" id="surname" name="surname" value=<?php echo isset($values['surname']) ? $values['surname'] : ''?>>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Dirección</label>
            <input type="text" class="form-control" id="address" name="address" required value=<?php echo isset($values['address']) ? $values['address'] : ''?>>
        </div>
<!--Other fields-->
        <div class="mb-3">
            <label for="phoneNumber" class="form-label">Telefono</label>
            <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" required value=<?php echo isset($values['phoneNumber']) ? $values['phoneNumber'] : ''?>>
        </div>
        <div class="mb-3">
            <label for="age" class="form-label">Edad</label>
            <input type="text" class="form-control" id="age" name="age" value=<?php echo isset($values['age']) ? $values['age'] : ''?>>
        </div>
        <div class="mb-3">
            <label for="passwd" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="passwd" name="passwd" required>
        </div>
         <div class="mb-3">
            <label for="passwdRe" class="form-label">Repite la contraseña</label>
            <input type="password" class="form-control" id="passwdRe" name="passwdRe" required>
        </div>
        <div class="mb-3">
            <label for="username" class="form-label">Usuario</label>
            <input type="text" class="form-control" id="username" name="username" maxlength="10" required value=<?php echo isset($values['username']) ? $values['username'] : ''?>>
        </div>
        
        <button type="submit" class="btn btn-primary w-100">Registrarse</button>
    </form>
</div>
<div class="container mt-5">
    <?php
        foreach($errors as $error){
            print '<p class="p-3 bg-danger">'.$error.'</p>';
        }
    ?>
</div>
<div class="container mt-5">
    <a href="../index.php" class="btn btn-primary"><span class="glyphicon glyphicon-th-list"></span>Volver</a>
</div>
<?php 
    require_once("../layout/footer.php");
?>

