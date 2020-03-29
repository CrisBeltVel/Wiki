
<?php

//Inicio de la pagina

//Inicio de sesion
session_start();
//Requerir conexión con la BD

  require 'database.php';

  if (isset($_SESSION['user_id'])) //si existe la variable user_id dentro de $_SESSION['']
  {
    $records = $conn->prepare('SELECT id, email,nick, password FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();//ejecuta la busqueda
    $results = $records->fetch(PDO::FETCH_ASSOC); //almacena todos los datos del user en results

    $user = null;

     var_dump($results);//borrar
     
     var_dump(count($results));
        
    if (count($results) > 0) {
      $user = $results; //Lleno la variable user con los resultados
    }
  }

  ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to our Login WikiA</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">



    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <meta name="google-signin-client_id" content="218346020250-gp4f05ehl0blphvpa7u002sgj6v1ri1v.apps.googleusercontent.com"  >

    <div class="g-signin2" data-onsuccess="onSignIn"></div>



</head>
<body>


<!-- Llama 3 lineas de codigo que permiten mostrar un enlace para ir a la pag principal (LOGO) -->
<?php require 'partials/header.php' ?>   

<?php if(!empty($user)): ?>
      <br> Welcome. <?= $user['nick']; ?>
      <br>You are Successfully Logged In
      <a href="logout.php">
        Logout
      </a>
    <?php else: ?>

<h1>Please Login or SignUP</h1>
<!-- Enlaces de Logeo y registro -->
<a href="login.php">Login</a> or  <a href="signup.php">SignUp</a>

<?php endif; ?>

</body>
</html>




