<?php
  require 'database.php'; // LLama el codigo que conecta con la base de datos
  $message ='';
  $message2 ='';
  $message3 ='';

  date_default_timezone_set("America/Bogota"); 
  $dateRegister= date('Y-m-d H:i:s');
 //var_dump($dateRegister);
  session_start();

 function verficacionNick($NewNick)
 {
  require 'database.php';
   //Valida unicamente el nick
   //con ayuda de conn(de datavase.php),ejecutamos la consulta de sql
$records = $conn->prepare('SELECT nick  FROM users WHERE nick = :nick '); //ejecutar la consulta a la tabla user
$records->bindParam(':nick', $NewNick); 
$records->execute();
$results = $records->fetch(PDO::FETCH_ASSOC);
//var_dump($results);

if ($results== false)
$validar=0;
else 
$validar=count($results);

//var_dump($vp);
if ($validar > 0 ) {
   return 1;
  }else
  return 0;
 }



 function verficacionEmail($NewEmail)
 {
  require 'database.php';
   //Valida unicamente el nick
   //con ayuda de conn(de datavase.php),ejecutamos la consulta de sql
$records = $conn->prepare('SELECT email  FROM users WHERE email = :email '); //ejecutar la consulta a la tabla user
$records->bindParam(':email', $NewEmail); 
$records->execute();
$results = $records->fetch(PDO::FETCH_ASSOC);
//var_dump($results);

if ($results== false)
$validar=0;
else 
$validar=count($results);

//var_dump($vp);
if ($validar > 0 ) {
   return 1;
  }else
  return 0;
 }


 

  if (!empty($_POST['email']) && !empty($_POST['nick']) && !empty($_POST['password'])&& !empty($_POST['confirm_password'])   )
   {

    //Recaptcha
    $Captcha=$_POST['g-recaptcha-response'];
    $secret ='6LeQI-MUAAAAAN5WheI4jm0jJimDaFC_hcQ5l7a6';
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$Captcha");
    $arr=json_decode($response,TRUE);
    

    $vNick   = verficacionNick($_POST['nick']);
    $vEmail  = verficacionEmail($_POST['email']);


    if (   filter_var($_POST['email'],FILTER_VALIDATE_EMAIL ) && $_POST['password'] == $_POST['confirm_password'] && $Captcha &&  $arr['success'] && $vNick==0 && $vEmail ==0)
      $validaciones=1;
      else if ($_POST['password']== $_POST['confirm_password'])
      $validaciones=2;
      else 
      $validaciones=3;

       if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL ))
       {
         $validaciones=4;
       }








if ($validaciones==1)
{
    $sql = "INSERT INTO users (email, nick,password, age, gender, dateLogin) VALUES (:email, :nick,:password, :age, :gender, :dateLogin)";
    $stmt = $conn->prepare($sql); //variable cualquiera que por medio de conn adquirido de database.php, hace una consulta  con prepare un metosdo ya definido

    $stmt->bindParam(':email', $_POST['email']); //bincula los parametros y los parametors: con bindParam()
    $stmt->bindParam(':nick', $_POST['nick']);
    $stmt->bindParam(':age', $_POST['age']);
    $stmt->bindParam(':gender', $_POST['gender']);
    $stmt->bindParam(':dateLogin', $dateRegister);

    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);//cifrado de contraseña por medio de PASSWORD_BCRYPT, guarda la contrañada cifrada y no la ingresada
    $stmt->bindParam(':password', $password);
    
    if ($stmt->execute()) {
      $message = 'Successfully created new user';
    //  header("Location: /WikiA/LoginPHP/login.php");
    } else {
      $message = 'Sorry there must have been an issue creating your account';
    }
  }else if ($validaciones==2)
     $message = 'Verificar Captcha';
  else if ($validaciones==3)
     $message = 'La contraseña no coincide';
   else
     $message = 'Ingrese un correo valido';

  if($vNick!=0)
  $message3 = 'Lo sentimos nick ya existe';
   
 if($vEmail!=0)
  $message3 = 'Lo sentimos el correo ya tiene una cuenta';
   
  // if(!$vContra)
  // $message3 = 'Lo sentimos la contraseña debe tener una Mayuscula, una minuscula, 1 numero y tener por lo menos 8 caracteres';
   

    



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
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script
     src="https://code.jquery.com/jquery-3.4.1.js"
     integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
     crossorigin="anonymous">
     </script>

    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <meta name="google-signin-client_id" content="218346020250-f131mlbj5vmj9ea22u368qjpd77cb86q.apps.googleusercontent.com"  >


    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Varela+Round&display=swap" rel="stylesheet">
        <!-- <link rel="stylesheet" href="assets/css/style.css"> -->
    <link rel="stylesheet" type="text/css" href="assets/css/style2.css">
    <link rel="stylesheet" href="assets/css/estiloregistro.css"> 
                                      
                                                   

</head>
<body>
<!-- Llama 3 lineas de codigo que permiten mostrar un enlace para ir a la pag principal -->
<?php require 'partials/header.php' ?>

    <div class="form_env">
        <img src="images/logo.png" alt="">
        <h2>Registrate</h1>
         <span>Have account? <a href="login.php">Login</a></span>
         <form class="register" action="signup.php" method="POST">
                <input name="email" type="text" placeholder="Ingresa tu correo" maxlength="50" required="required" >
                <input name="nick" type="text" placeholder="Ingresa tu Nick" maxlength="15" required="required">
                <input name="age" type="number" placeholder="Ingresa tu edad" min="14" max="100">
                <h2>Género </h2>
                <div class="options">
                    <input type="radio" id="male" name="gender" value="male">
                    <label for="male">M</label>
                    <input type="radio" id="female" name="gender" value="female">
                    <label for="female">F </label><br>                    
                </div>     
                <input name="password" type="password" placeholder="Ingresa tu contraseña" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                <input name="confirm_password" type="password" placeholder="Confirma tu contraseña">
               <div class="options"> <div class="Cent_captcha g-recaptcha " data-sitekey="6LeQI-MUAAAAAFKltkA1NUanWb-G9-zgQ8GSKHbC"></div></div>
                <input type="submit" value="Registrarse">
                

         </form>
         <div class="g-signin2" data-onsuccess="onSignIn"></div>

         <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
      <p> <?= $message3 ?></p>
    <?php endif; ?>
    
    </div>
    <footer>
        <div class="containerfooter">
            <div class="blockfooter"><p>Creado en la Universidad Militar</p></div>
            <div class="blockfooter"><p>Contactanos al 781213213</p></div>
        </div>
    </footer>
   
    
</body>



<script>
function onSignIn(googleUser)
{

var profile =googleUser.getBasicProfile();
   console.log('User is '+ JSON.stringify(profile))
     var element = document.querySelector('#content')
 //  element.innerText = profile.getName();

}
</script>

</html>