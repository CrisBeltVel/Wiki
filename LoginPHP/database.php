<?php
// permite conectarse a la BD

$server = 'localhost:3308';
$username = 'root';                
$password = '';                  
$database = 'php_login_database'; //Nombre de la base de datos
                  


try {
//conn es la variable de coneccion--El host el el servidor, parametros de conección
  $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch (PDOException $e) {
  die('Connection Failed: ' . $e->getMessage());
}

?>


