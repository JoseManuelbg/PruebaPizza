<?php


function getUser($username,$password){
    $connection = Database::getInstance()->getConnection();
    $query = "SELECT username,password FROM cliente 
            WHERE username=:username";
            $stmt = $connection->prepare($query); 
            $stmt->bindParam(':username', $username); 
            $stmt->execute(); 
            $result = $stmt->fetch(PDO::FETCH_ASSOC); 
            if (empty($result)) {
                return false;
            }
            else{
                return password_verify($password,$result['password']);
                
            }
}


function validatePhone($number){
    $exists = false;
    $connection = Database::getInstance()->getConnection();
    $query = 'SELECT * FROM `cliente` WHERE cliente.telefono = :phone';
    $stms = $connection->prepare($query);
    $stms->bindParam('phone', $number);
    $stms->execute();
    $result = $stms->fetchAll(PDO::FETCH_ASSOC);
    if(sizeof($result) > 0){
        $exists = true;
    }
    return $exists;
}

function validateUsername($name){
    $exists = false;
    $connection = Database::getInstance()->getConnection();
    $query = 'SELECT * FROM `cliente` WHERE cliente.username = :name';
    $stms = $connection->prepare($query);
    $stms->bindParam('name', $name);
    $stms->execute();
    $result = $stms->fetchAll(PDO::FETCH_ASSOC);
    if(sizeof($result) > 0){
        $exists = true;
    }
    return $exists;
}

function validatePasswd($passwd, $passwd2){
    if($passwd === $passwd2){
        return true;
    }else{
        return false;
    }
}

function encryptPasswd($passwd){
    return password_hash($passwd, PASSWORD_BCRYPT);
}

function registerClient($name, $surname, $address, $phone, $age, $passwd, $username){
    $connection = Database::getInstance()->getConnection();
    $query = 'INSERT INTO `cliente`(`nombre`, `apellido`, `direccion`, `username`, `password`, `edad`, `telefono`)  VALUES (:name, :surname, :address, :username, :passwd, :age, :phone)';
    $stmt = $connection->prepare($query);
    $stmt->bindParam('name', $name);
    $stmt->bindParam('surname', $surname);
    $stmt->bindParam('username', $username);
    $stmt->bindParam('passwd', $passwd);
    $stmt->bindParam('phone', $phone);
    $stmt->bindParam('address', $address);
    $stmt->bindParam('age', $age);
    $stmt->execute();
}

