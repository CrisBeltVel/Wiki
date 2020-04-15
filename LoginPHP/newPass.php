<?php

session_start(); //inicializar sesiones

require 'database.php'; // Llama el arch database.php, encargado de la coneccion con la BD

//$sql = "UPDATE tblUsuario SET codigo = :p_codigo, fechaRecuperacion = :p_fechaRecuperacion WHERE correoElectronico = :p_correoElectronico";


           


if (!empty($_POST['txtContrasena'])  &&  !empty($_POST['txtRepetirContrasena']) )
{

// $sql = 'UPDATE users SET password = $_POST["txtContrasena"] WHERE nick= $_POST["txtContrasena"] ';
// //$stmt = $conn->prepare($sql); //variable cualquiera que por medio de conn adquirido de database.php, hace una consulta  con prepare un metosdo ya definido
// $stmt= $conn->prepare($sql);


// $passwordN = password_hash($_POST['txtContrasena'], PASSWORD_BCRYPT);//cifrado de contraseña por medio de PASSWORD_BCRYPT, guarda la contrañada cifrada y no la ingresada

// var_dump($_POST["txtContrasena"]);
// var_dump($passwordN );


// $stmt->execute($passwordN);

try {
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $npass=  $_POST["txtContrasena"];
  $nn =$_POST["nick"];
 $passwordN = password_hash($_POST['txtContrasena'], PASSWORD_BCRYPT);//cifrado de contraseña por medio de PASSWORD_BCRYPT, guarda la contrañada cifrada y no la ingresada


   $sql = "UPDATE users SET password ='$passwordN'  WHERE nick='$nn'  ";
var_dump($npass);
    // Prepare statement
    $stmt = $conn->prepare($sql);
    var_dump($stmt);
    // execute the query
    $stmt->execute();

    // echo a message to say the UPDATE succeeded
    echo $stmt->rowCount() . " records UPDATED successfully";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;


}
else
{
$v2 = ($_GET['prueba']);
echo "$v2";
}

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Wiki Multimedia
        <?php echo $title; ?>
    </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link href="login_libs/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="login_libs/login.css" rel="stylesheet">

</head>




<body>

    <div class="wrapper">
        <div id="formContent">
            <!-- Tabs Titles -->

            <div>
                <h4>
                <b>Wiki</b> Multimedia
                </h4>
            </div>

            <!-- Icon -->
            <div>
                <img src="login_libs/candado-056.png" id="icon" alt="User Icon" />
            </div>
            
           <?php
        // if (isset($_GET['prueba'])){
        // $v2 = ($_GET['prueba']);
        // $count = 2;
        //     echo "$v2";
        // }
           
?>



            <form method="POST" action="newPass.php">
                <!-- <input type="hidden" id="txtNick" name="txtNick" placeholder="Código del Usuario" value="<?php /*echo $v2*/ ?>"> -->
                <input name="nick" type="text" placeholder="Ingresa tu Nick" maxlength="15" required="required">
                <input type="password" id="txtContrasena" name="txtContrasena" placeholder="Nueva Contraseña">
                <input type="password" id="txtRepetirContrasena" name="txtRepetirContrasena" placeholder="Repetir Contraseña">
                
                <div class="loginButton">
                    <input id="btnGuardar" name="btnGuardar" type="submit" value="Cambiar Contraseña" >
                    
                </div>
                
            </form>

            <!-- Remind Passowrd -->
            <div id="formFooter">
                <a class="underlineHover" href="login">Volver a iniciar sesión</a>
            </div>

        </div>
    </div>

    <script>
        var url = "<?php echo URL; ?>";

         function comparePassword(){
                var contrasena = document.getElementById('txtContrasena').value;
                var repetirContrasena = document.getElementById('txtRepetirContrasena').value;

                if(contrasena != repetirContrasena){
                    alert('Las contraseñas no coinciden.');
                    return false;
                }else{
                    return true;
                }

            }

    </script>

    <script src="<?php echo URL; ?>login_libs/jquery.min.js"></script>
    <script src="<?php echo URL; ?>login_libs/bootstrap.min.js"></script>

    <?php if(isset($mensaje)){ ?>

        <script>
            
            window.onload = function(){
                alert('<?php echo $mensaje; ?>');
            }

        </script>

    <?php } ?>

</body>

</html>