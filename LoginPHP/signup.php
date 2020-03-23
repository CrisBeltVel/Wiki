<?php
  require 'database.php'; // LLama el codigo que conecta con la base de datos
  $message ='';
  $message2 ='';


  

  if (!empty($_POST['email']) && !empty($_POST['nick']) && !empty($_POST['password'])&& !empty($_POST['confirm_password'])   )
   {

    $Captcha=$_POST['g-recaptcha-response'];
    $secret ='6LeQI-MUAAAAAN5WheI4jm0jJimDaFC_hcQ5l7a6';
    //
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$Captcha");
   // var_dump($response);
    $arr=json_decode($response,TRUE);

//

    if ($_POST['password']== $_POST['confirm_password'] && $Captcha &&  $arr['success'])
      $validaciones=1;
      else if ($_POST['password']== $_POST['confirm_password'])
      $validaciones=2;
      else 
      $validaciones=3;



       if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL ))
       {
         $validaciones=1;
       }else 
       $validaciones=4;

      //  function buscarRepetido($email,$user)
      //  {
      //    $sqlnick = "SELECT nick from users where nick='$user' ";
       
      //   if(mysqli_num_rows($sqlnick) == 0)
      //     return 0;
      //   else 
      //     return 1;
        
      // }
      

      //  if(!buscarRepetido($_POST['email'],$_POST['nick']))
      //  {
      //    $validaciones=5;
      //  }


    

      


if ($validaciones==1)
{
    $sql = "INSERT INTO users (email, nick,password, age, gender) VALUES (:email, :nick,:password, :age, :gender)";
    $stmt = $conn->prepare($sql); //variable cualquiera que por medio de conn adquirido de database.php, hace una consulta  con prepare un metosdo ya definido

    $stmt->bindParam(':email', $_POST['email']); //bincula los parametros y los parametors: con bindParam()
    $stmt->bindParam(':nick', $_POST['nick']);
    $stmt->bindParam(':age', $_POST['age']);
    $stmt->bindParam(':gender', $_POST['gender']);

    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);//cifrado de contraseña por medio de PASSWORD_BCRYPT, guarda la contrañada cifrada y no la ingresada
    $stmt->bindParam(':password', $password);
    
    if ($stmt->execute()) {
      $message = 'Successfully created new user';
    } else {
      $message = 'Sorry there must have been an issue creating your account';
    }
  }else if ($validaciones==2)
     $message = 'Verificar Captcha';
  else if ($validaciones==3)
     $message = 'La contraseña no coincide';
else 
     $message = 'Ingrese un correo valido';

  


    



//inserta dentro de la tabla los valores de las variables :email y :pass en donde se remplazaran los valores 
// se hace por medio de una variable sql         
    
  }


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
<!-- Llama 3 lineas de codigo que permiten mostrar un enlace para ir a la pag principal -->
<?php require 'partials/header.php' ?>

  <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
      <p> <?= $message2 ?></p>
    <?php endif; ?>

<h1>Registrate</h1>
    <span>Have account? <a href="login.php">Login</a></span>
    <!-- Envia los datos ingresados de signup.php a signup.php, ademas de resivirlos datos -->
      <form action="signup.php" method="POST">
      <input name="email" type="text" placeholder="Ingresa tu correo">
      <input name="nick" type="text" placeholder="Ingresa tu Nick">
      <input name="password" type="password" placeholder="Ingresa tu contraseña">
      <input name="confirm_password" type="password" placeholder="Confirma tu contraseña">
      <input name="age" type="number" placeholder="Ingresa tu edad" min="14" max="100">
      <h3>Genero </h3>     
      <input type="radio" id="male" name="gender" value="male">
      <label for="male">M</label>
      <input type="radio" id="female" name="gender" value="female">
      <label for="female">F </label><br>
      <div class="Cent_captcha g-recaptcha " data-sitekey="6LeQI-MUAAAAAFKltkA1NUanWb-G9-zgQ8GSKHbC"></div>
      <input type="submit" value="Restrarse">

    </form>

    
</body>
</html>