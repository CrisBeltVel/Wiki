
<?php

//Inicio de sesion, toma la sesión de el usuario logeado en caso de estarlo
session_start();
 
//Requerir conexión con la BD
  require 'database.php';

//php mailer 

//  require 'vendor/autoload.php';


  if (isset($_SESSION['user_id'])) //Isset valida si existe la variable user_id dentro de $_SESSION[''], la sesión que se estableció con  "session_start()"
  {
//records es una varible cualquiera que se iguala a la busqueda, hehca con $conn,
//$conn viene de "database.php", es la varibale que almacena la conección con la BD
//->prepare, Prepara una sentencia SQL para su ejecución, en este caso 'SELECT id......
//SELECT como ya sabemos hace una consulta en la base de datos, todo lo anterior fue para preparar
//consulta y asignarla "$records",
//bindParam, relaciona :id con id, :id es un valor de referencia es decir podria llamarce :id_user o 
//id_loQuesea, esta ahí para relacionarce, para compararce con $_SESSION['user_id'], que es el id que esta en la sesion actual
//la sesion actual viene de "session_start()", de nuevo todo seguarda en $records,
//"->execute()", ejecuta la bisqueda, es como si se presionara un boton para validar que id, que llego de la sesion
// este dentro de la tabla de usuarios correspodiendo a un id existente, 
// "$results" es otra variable cualquiera que alamcenara todos los datos de la consulta, en este caso son 3: id,email,el nick y el password
//esto por medio de ->fetch(PDO::FETCH_ASSOC)
//Lo se, lo se esto es mas enrredado de lo que debería, pero así funciona esto...
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
    <title>Welcome to our  Wiki</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Varela+Round&display=swap" rel="stylesheet">    
	<!-- estilos de Alejo -->
    <link rel="stylesheet" type="text/css" href="assets/css/style2.css"> 

</head>
<body >
<!-- require e include parecen hacer lo mismo. Se llama al archivo “header.php”, ubicado en la carpeta partials, este es todo el header del html, se usara también en las demás ventanas de la wiki -->
<?php  include 'partials/header.php' ?>  
<!-- el "!empty" hace lo mismo que el isset, en este caso, se valida que la variable "$user" creada arriba no este vacia, es decir que haya un usuario validado por la BD  -->
   <div id="particles-js">


  <div class="auximgpriciple allcenter">
		<div class="imgpriciple">
			<div>DESCUBRE</div>
			<div>EL</div>
			<div>MUNDO</div>
			<div>MULTIMEDIA</div>
		</div>
	</div>

    
	<div class="container ">
		<div class="horizontalspace noticias">
			<div class="articulo">
				<h2>INTERACCION CON DISPOSITIVOS</h2>
				<div class="infoarticle">
					<img  src="images/user.png" alt="" >
					<span >Fernanda789</span>
					<img  src="images/time.png" alt="" >
					<span >23 de marzo 2020</span>
				</div>
				<a href=""><img class="imgarticle" src="images/article1.jpg" alt=""></a>
				<p class="descripcionart">Las interacciones en moviles usualmente son limitadas, por eso en este articulo exploramos nuevas formas de interaccion</p>
			</div>
			<div class="articulo">
				<h2>UX MULTIMEDIA</h2>
				<div class="infoarticle">
					<img  src="images/user.png" alt="" >
					<span >Fernanda789</span>
					<img  src="images/time.png" alt="" >
					<span >23 de marzo 2020</span>
				</div>	
				<a href=""><img class="imgarticle" src="images/article2.jpg" alt=""></a>
				<p class="descripcionart">El diseño de experiencias de usuario es uno de los elementos mas importantes en del desarrollo de un producto y su impacto en el mercado</p>			
			</div>			
		</div>
	</div>

	<div class="containercategorias">
		<div class="categoriastitulo">
			<a href="" onclick="showcategorias(); return false; "><h2>Categorias</h2></a>
		</div>
		<div id="selectcategorias" class="categorias">
			<div class="gridcontainer">
				<div class="cat1">CIENCIAS DE LA COMPUTACION</div>
				<div class="cat2">DISEÑO</div>
				<div class="cat3">ANIMACION Y CINE</div>
				<div class="cat4">PROCESAMIENTO DE DATOS</div>
				<div class="cat5">ARTES COMPUTACIONALES</div>
				<div class="cat6">EXPRESION GRAFICA</div>
			</div>			
		</div>
	</div>

	<footer>
		<div class="containerfooter">
			<div class="blockfooter"><p>Creado en la Universidad Militar</p></div>
			<div class="blockfooter"><p>Contactanos al 781213213</p></div>
		</div>
	</footer>
	
	<script type="text/javascript" src="openandclose.js"></script>
  <script src="particles.js"></script>
    <script src="app.js"></script>
	</div>
</body>
</html>




