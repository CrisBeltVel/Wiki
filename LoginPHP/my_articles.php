<?php
session_start();
require 'database.php';
require 'BDConnect.php';

$op=0;


if (isset($_SESSION['user_id'])) //Isset valida si existe la variable user_id dentro de $_SESSION[''], la sesión que se estableció con  "session_start()"
{
  $records = $conn->prepare('SELECT id, email,nick, password FROM users WHERE id = :id');
  $records->bindParam(':id', $_SESSION['user_id']);
  $records->execute();//ejecuta la busqueda
  $results = $records->fetch(PDO::FETCH_ASSOC); //almacena todos los datos del user en results

  $user = null;// 
  
  if (count($results) > 0) {// Count me cuenta los resultados de results, si la conección con la sesión es exitosa dara 4, por que son los parametros que se sacaron de la BD,con ese id
    $user = $results; //Lleno la variable user con los resultados
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis articulos</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Varela+Round&display=swap" rel="stylesheet">    
	<!-- estilos de Alejo -->
    <link rel="stylesheet" type="text/css" href="assets/css/style2.css"> 
    <link rel="stylesheet" type="text/css" href="assets/css/styleArticles.css"> 
 
</head>
<body>
  
<?php  include 'partials/header.php' ?>



<div class="columna  menu_lateral">
	<!-- Buscador -->
  <input id="buscador" class ="div_menu" type="text" name="" placeholder="Busca algun articulo">
    
    <a href="indexedit" class="div_menu">Crear</a>
    <a href="#" class="div_menu">Menu </a>

<form class="columna  menu_lateral" action="my_articles.php" method="post">
  <input class="div_menu" type="submit" name ="Created" value="Creados">
  <input class="div_menu" type="submit" name ="Edit" value="Editados">
  <input class="div_menu" type="submit"  name ="Delete" value="Eliminados">
  <input class="div_menu" type="submit"  name ="Request" value="Solicitados">
  <input class="div_menu" type="submit"  name ="Oadmin" value="OpAdmin">

  </form>

  </div>



  <div class="barra_superior">
  <a href="#" class="div_menu">Aceptar</a>
  <a href="#" class="div_menu">Editar</a>
  <a href="#" class="div_menu">Eliminar</a> 
  <!-- <a href="#" class="div_menu">Opciones del administrador</a>  -->
  </div>





  <div>
 <!-- pruebas php -->
 <?php


    if (!empty($_POST['Created']))
    $op=1;
    else if (!empty($_POST['Edit'])) 
    $op=2;
    else if (!empty($_POST['Delete'])) 
    $op=3;
    else if (!empty($_POST['Request'])) 
    $op=4;
    else if (!empty($_POST['Oadmin'])) 
    $op=5;
    else
    $op=0;

 if ($op!=0)
 {

 switch ($op){
 case '1':
    echo"<br>";

    include 'Art_Created.php'   ;   //Llama otro html(php) 
     //echo $res;

 break;
 case '2':
    echo"<br>";
    
 break;
 case '3':
    echo"<br>";
    include 'Art_Removed.php'   ; //Llama otro html(php) 
 break;
 case '4':

    echo"<br>";
    echo"<h2>4</h2>"; //De momento solo saca una constante

 break;

 case '5':

  echo"<br>";
  include 'opAdm.php'   ; //Llama otro html(php) 

break;
 }

 }
 else
 {
  echo"<br>";
  echo"Mis datos personales";
  echo "<table style='border: solid 1px black;'>";
  echo "<tr><th>Id</th><th>Nick</th><th>Email</th><th>Age</th><th>Gender</th><th>Fecha de registro</th></tr>";
  
  class TableRows extends RecursiveIteratorIterator {
      function __construct($it) {
          parent::__construct($it, self::LEAVES_ONLY);
      }
      function current() {
          return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
      }
      function beginChildren() {
          echo "<tr>";
      }
      function endChildren() {
          echo "</tr>" . "\n";
      }
  }
   
  $nn=$user['nick'];

  if (!empty($user)) 
  {
      $records = $conn->prepare("SELECT id, nick, email, age, gender, dateLogin FROM users WHERE nick = '$nn' "); //ejecutar la consulta a la tabla user
      //$stmt = $this->dbConn->prepare($sql);
      $records->bindParam(':Autor',  $nn); 
      $records->execute();
  
      $result = $records->setFetchMode(PDO::FETCH_ASSOC);
      foreach(new TableRows(new RecursiveArrayIterator($records->fetchAll())) as $k=>$v) {
          echo $v;
      }
  
  
  //  $results = $records->fetch(PDO::FETCH_ASSOC);
  // if ($results== false)
  // $validar=0;
  // else 
  // $validar=count($results);
  
  // var_dump($validar);
  // var_dump($results);
     }



 }


 ?>

 <!-- 
 //fin de pruebas php -->


</div>



<!--     
<footer class="fullrow">
        <div class="containerfooter">
            <div class="blockfooter"><p>Creado en la Universidad Militar</p></div>
            <div class="blockfooter"><p>Contactanos al 781213213</p></div>
        </div>
    </footer> -->

</body>
</html>