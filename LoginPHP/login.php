<?php
// permite registrarnos

session_start(); //inicializar sesiones

// //Revisar, NEN--> pendiente para borrar
// if (isset($_SESSION['user_id'])) {
//     header('Location: /WikiA/LoginPHP');
//   }


  require 'database.php'; // Llama el arch database.php, encargado de la coneccion con la BD

  //si el nick y la contraseña no estan vacios entonces, toda la explicación de este if esta en "index.php"
if (!empty($_POST['nick']) && !empty($_POST['password'])) {
  //con ayuda de conn(de datavase.php),ejecutamos la consulta de sql
    $records = $conn->prepare('SELECT id, nick, password FROM users WHERE nick = :nick'); //ejecutar la consulta a la tabla user
    $records->bindParam(':nick', $_POST['nick']); 
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);
    $message = '';

    //count me permite contar los resultados

if ($results== false)
$validar=0;
else 
$validar=count($results);

var_dump($validar);
 

    if ($validar > 0 && password_verify($_POST['password'], $results['password'])) {
        $_SESSION['user_id'] = $results['id'];
        
        header("Location: /WikiA/LoginPHP");
      } else {
        $message = 'Sorry, those credentials do not match';
      }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <!-- <link rel="stylesheet" href="assets/css/style.css"> -->
    <link rel="stylesheet" type="text/css" href="assets/css/style2.css">
    <link rel="stylesheet" href="assets/css/estiloregistro.css">
    <link href="https://fonts.googleapis.com/css?family=Varela+Round&display=swap" rel="stylesheet">
</head>
<body>

<!-- Llama 3 lineas de codigo que permiten mostrar un enlace para ir a la pag principal (LOGO)-->
<?php require 'partials/header.php' ?>

<?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

   


    <div class="form_env">
        <img src="images/logo.png" alt="">
        <h2>Iniciar Sesion</h1>
        <form class="register" action="login.php" method="POST"> <!-- Envia los datos ingresados de login.php a login.php --> 
            <input name="nick" type="text" placeholder="Nick">
            <input name="password" type="password" placeholder="Contraseña" >
            <input type="submit" value="Login">
            <input type="submit" value="Iniciar sesión con Google">
        </form>
        <span>¿No tienes una cuenta?</span>
        <a href="signup.php"> REGISTRATE AQUI</a>
        <span>¿Olvidaste la contraseña? Create otra cuenta!! <a href="Recuperar.php">RECUPERAR</a></span>
    </div>

    <footer>
        <div class="containerfooter">
            <div class="blockfooter"><p>Creado en la Universidad Militar</p></div>
            <div class="blockfooter"><p>Contactanos al 781213213</p></div>
        </div>
    </footer>



</body>
</html>