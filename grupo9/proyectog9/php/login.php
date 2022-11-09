<?php

use LDAP\Result;

/*
if (isset($_SESSION['user_id'])) {
  header('Location: ../../index.html');
}
*/
require 'database.php';

if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $query = 'SELECT avatar, u.idrole, u.iduser, u.name AS u_name, lastname, r.name AS r_name, u.password FROM user AS u INNER JOIN role AS r ON (u.idrole = r.idrole) WHERE email = :email';

    $records = $conn->prepare($query);
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);
    try {
        if (isset($results) > 0 && $_POST['password'] == $results['password']) {
            session_start();
            $_SESSION['user_rol'] = $results['idrole'];
            $_SESSION['user_id'] = $results['iduser'];
            $_SESSION['user_name'] = $results['u_name']." ".$results['lastname'];
            $_SESSION['user_rol_t'] = $results['r_name'];
            $_SESSION['user_avatar'] = $results['avatar'];
            header("Location: ../../home.php");
            //print_r($results);
        } else {
            header("Location: ../../index.html?ress=".$_POST['email']);
        }
    } catch (PDOException $e) {
        header("Location: ../../index.html?ress=".$_POST['email']);
    }
} else {
    header("Location: ../../index.html?ress=".$_POST['email']);
}
