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
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style2.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>

<!-- Llama 3 lineas de codigo que permiten mostrar un enlace para ir a la pag principal (LOGO)-->
<?php require 'partials/header.php' ?>

<?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>Ingresa</h1>
      <form action="login.php" method="POST"> <!-- Envia los datos ingresados de login.php a login.php --> 
      <input name="nick" type="text" placeholder="Nick">
      <input name="password" type="password" placeholder="Contraseña"   >
      <input type="submit" value="Login"><!-- Submit es un tipo de boton que permite ejecutar el formuladio/enviar la información -->
      <input type="submit" value="Iniciar sesión con Google">
</form>

<span>Don't have account? <a href="signup.php">REGISTER HERE</a></span>

</body>
</html>