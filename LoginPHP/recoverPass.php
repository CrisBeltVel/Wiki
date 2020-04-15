

<?php

/*
//no revisar aun
function sendRecoveryCode()

    {
        if (isset($_POST["txtCorreoElectronico"]) && trim($_POST["txtCorreoElectronico"] != '')) {
            $correoElectronico = $_POST['txtCorreoElectronico'];
            $codigo = $this->createRandomCode();
            $fechaRecuperacion = date("Y-m-d H:i:s", strtotime('+24 hours'));
            $userModel = new User(); //llama al modelo, verificar , creo que es buscar en la db si existe le correo E
            $user = $userModel->getUserWithEmail($correoElectronico);

            if ($user === false) {
                $mensaje = 'El correo electrónico no se encuentra registrado en el sistema.';
                $this->render('login/recover', 'Recuperar Contraseña', array('mensaje' => $mensaje), false);
            } else {
                $respuesta = $userModel->recoverPassword($correoElectronico, $codigo, $fechaRecuperacion);
            
                if ($respuesta) {
                    $this->sendMail($correoElectronico, $user->nombreCompleto, $codigo);
                    
                    $mensaje = 'Se ha enviado un correo electrónico con las instrucciones para el cambio de tu contraseña. Por favor verifica la información enviada.';
                    $this->render('login/recover', 'Recuperar Contraseña', array('mensaje' => $mensaje), false);
                } else {
                    $mensaje = 'No se recuperar la cuenta. Si los errores persisten comuniquese con el administrador del sitio.';
                    $this->render('login/recover', 'Recuperar Contraseña', array('mensaje' => $mensaje), false);
                }
            }
        } else {
            $mensaje = 'El campo de correo electrónico es requerido.';
            $this->render('login/recover', 'Recuperar Contraseña', array('mensaje' => $mensaje), false);
        }
    }
*/

// Llena  la plantilla para el correo E
 function sendMail($correoElectronico, $nombre) //,$codigo
    {
        $template = file_get_contents('partials/template1.php');
        $template = str_replace("{{name}}", $nombre, $template);
        // $template = str_replace("{{action_url_2}}", '<b>http:'.URL.'login/newPassword/'.$codigo.'</b>', $template);
        // $template = str_replace("{{action_url_1}}", 'http:'.URL.'login/newPassword/'.$codigo, $template);
        $template = str_replace("{{year}}", date('Y'), $template);

echo "$template"; //imprimir plantilla
//codigo para correo E ->no revisar aun
        // $template = str_replace("{{operating_system}}", getOS(), $template);
        // $template = str_replace("{{browser_name}}", getBrowser(), $template);

        // $mail = new PHPMailer(true); //verificar 
        // $mail->CharSet = "UTF-8";

        // try {
        //     $mail->isSMTP();
        //     $mail->Host = 'smtp.googlemail.com';  //gmail SMTP server
        //     $mail->SMTPAuth = true;
        //     $mail->Username = 'wikimultimedia00@gmail.com';   //username
        //     $mail->Password = 'Tecnologiasdeinternet01';   //password
        //     $mail->SMTPSecure = 'ssl';
        //     $mail->Port = 465;                    //smtp port

        //     $mail->setFrom('wikimultimedia00@gmail.com', 'Variedades y Comunicaciones');
        //     $mail->addAddress($correoElectronico, $nombre);

        //     $mail->isHTML(true);

        //     $mail->Subject = 'Recuperación de contraseña - asuntoWikiA';
        //     $mail->Body    = $template;

        //     if (!$mail->send()) {
        //         return false;
        //     } else {
        //         return true;
        //     }
        // } catch (Exception $e) {
        //     return false;
      
        // }
    }
/*
 function createRandomCode()
    {
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz0123456789";
        srand((double)microtime()*1000000);
        $i = 0;
        $pass = '' ;
    
        while ($i <= 7) {
            $num = rand() % 33;
            $tmp = substr($chars, $num, 1);
            $pass = $pass . $tmp;
            $i++;
        }
    
        return time().$pass;
    }


function getOS()
    {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];

        $os_platform  = "Unknown OS Platform";

        $os_array     = array(
                          '/windows nt 10/i'      =>  'Windows 10',
                          '/windows nt 6.3/i'     =>  'Windows 8.1',
                          '/windows nt 6.2/i'     =>  'Windows 8',
                          '/windows nt 6.1/i'     =>  'Windows 7',
                          '/windows nt 6.0/i'     =>  'Windows Vista',
                          '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                          '/windows nt 5.1/i'     =>  'Windows XP',
                          '/windows xp/i'         =>  'Windows XP',
                          '/windows nt 5.0/i'     =>  'Windows 2000',
                          '/windows me/i'         =>  'Windows ME',
                          '/win98/i'              =>  'Windows 98',
                          '/win95/i'              =>  'Windows 95',
                          '/win16/i'              =>  'Windows 3.11',
                          '/macintosh|mac os x/i' =>  'Mac OS X',
                          '/mac_powerpc/i'        =>  'Mac OS 9',
                          '/linux/i'              =>  'Linux',
                          '/ubuntu/i'             =>  'Ubuntu',
                          '/iphone/i'             =>  'iPhone',
                          '/ipod/i'               =>  'iPod',
                          '/ipad/i'               =>  'iPad',
                          '/android/i'            =>  'Android',
                          '/blackberry/i'         =>  'BlackBerry',
                          '/webos/i'              =>  'Mobile'
                    );

        foreach ($os_array as $regex => $value) {
            if (preg_match($regex, $user_agent)) {
                $os_platform = $value;
            }
        }

        return $os_platform;
    }
 function getBrowser()
    {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        
        $browser        = "Unknown Browser";

        $browser_array = array(
                            '/msie/i'      => 'Internet Explorer',
                            '/firefox/i'   => 'Firefox',
                            '/safari/i'    => 'Safari',
                            '/chrome/i'    => 'Chrome',
                            '/edge/i'      => 'Edge',
                            '/opera/i'     => 'Opera',
                            '/netscape/i'  => 'Netscape',
                            '/maxthon/i'   => 'Maxthon',
                            '/konqueror/i' => 'Konqueror',
                            '/mobile/i'    => 'Handheld Browser'
                     );

        foreach ($browser_array as $regex => $value) {
            if (preg_match($regex, $user_agent)) {
                $browser = $value;
            }
        }

        return $browser;
    }

*/
    //verifica si el correo exite o no ->//no revisar aun
    function getUserWithEmail($p_correoElectronico) {
        $sql = "SELECT idUsuario, usuario, contrasena, nombreCompleto, correoElectronico, estado, rol, codigo, fechaRecuperacion FROM tblUsuario WHERE correoElectronico = :p_correoElectronico LIMIT 1";
        $parameters = array(':p_correoElectronico' => $p_correoElectronico);

        try {

            $query = $this->db->prepare($sql);
            $query->execute($parameters);
            return ($query->rowcount() ? $query->fetch() : false);

        } catch (PDOException $e) {

            $logModel = new Log();
            $sql = Helper::debugPDO($sql, $parameters);
            $logModel->addLog($sql, 'User', $e->getCode(), $e->getMessage());
            return false;

        } catch (Exception $e) {
            
            $logModel = new Log();
            $sql = Helper::debugPDO($sql, $parameters);
            $logModel->addLog($sql, 'User', $e->getCode(), $e->getMessage());
            return false;
        }}

//no revisar aun
     function recoverPassword($p_correoElectronico, $p_codigo, $p_fechaRecuperacion){
        $sql = "UPDATE tblUsuario SET codigo = :p_codigo, fechaRecuperacion = :p_fechaRecuperacion WHERE correoElectronico = :p_correoElectronico";
        $parameters = array(
            ':p_correoElectronico' => $p_correoElectronico,
            ':p_codigo' => $p_codigo,
            ':p_fechaRecuperacion' => $p_fechaRecuperacion
        );

        try {

            $query = $this->db->prepare($sql);
            return $query->execute($parameters);

        } catch (PDOException $e) {

            $logModel = new Log();
            $sql = Helper::debugPDO($sql, $parameters);
            $logModel->addLog($sql, 'User', $e->getCode(), $e->getMessage());
            return false;

        } catch (Exception $e) {
            
            $logModel = new Log();
            $sql = Helper::debugPDO($sql, $parameters);
            $logModel->addLog($sql, 'User', $e->getCode(), $e->getMessage());
            return false;
        }}    
//no revisar aun
function newPassword($code = null)
    {
        if (isset($code)) {
            // Instance new Model (Song)
            $userModel = new User();
            // do deleteSong() in model/model.php
            $user = $userModel->getUserWithCode($code);

            if ($user === false) {
                $mensaje = 'El código de recuperación de contraseña no es valido. Por favor intenta de nuevo.';
                $this->render('recoverPass.php', 'Recuperar Contraseña', array('mensaje' => $mensaje), false);
            } else {
                $current = date("Y-m-d H:i:s");

                if (strtotime($current) > strtotime($user->fechaRecuperacion)) {
                    $mensaje = 'El código de recuperación de contraseña ha expirado. Por favor intenta de nuevo.';
                    $this->render('login/recover', 'Recuperar Contraseña', array('mensaje' => $mensaje), false);
                } else {
                    $this->render('login/newPassword', 'Nueva Contraseña', array('user' =>  $user), false);
                }
            }
        } else {
            header('location: ' . URL);
        }
    }

//no revisar aun
function getUserWithCode($p_codigo)
    {
        $sql = "SELECT idUsuario, usuario, contrasena, nombreCompleto, correoElectronico, estado, rol, codigo, fechaRecuperacion FROM tblUsuario WHERE codigo = :p_codigo LIMIT 1";
        $parameters = array(':p_codigo' => $p_codigo);

        try {

            $query = $this->db->prepare($sql);
            $query->execute($parameters);
            return ($query->rowcount() ? $query->fetch() : false); //se retorna con "fetch" quei sabe que se eso

        } catch (PDOException $e) {

            $logModel = new Log();
            $sql = Helper::debugPDO($sql, $parameters);
            $logModel->addLog($sql, 'User', $e->getCode(), $e->getMessage());
            return false;

        } catch (Exception $e) {
            
            $logModel = new Log();
            $sql = Helper::debugPDO($sql, $parameters);
            $logModel->addLog($sql, 'User', $e->getCode(), $e->getMessage());
            return false;
        }
    }


?> 




<?php

session_start(); //inicializar sesiones

require 'database.php'; // Llama el arch database.php, encargado de la coneccion con la BD

  //si el nick y la contraseña no estan vacios entonces, toda la explicación de este if esta en "index.php"
if (!empty($_POST['txtCorreoElectronico'])) {
  //con ayuda de conn(de datavase.php),ejecutamos la consulta de sql
    $records = $conn->prepare('SELECT id, nick, password FROM users WHERE email = :email'); //ejecutar la consulta a la tabla user
    $records->bindParam(':email', $_POST['txtCorreoElectronico']); 
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);
    $message = '';

    //count me permite contar los resultados

if ($results== false)
$validar=0;
else 
$validar=count($results);


    if ($validar > 0) {
         sendMail($_POST['txtCorreoElectronico'], $results['nick']) ;
      } 
    }

?>




<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">

    <title>Wiki Multimedia |
        <?php echo $title; ?>
    </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link href="login_libs/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="login_libs/login.css" rel="stylesheet">
 <link rel="stylesheet" type="text/css" href="assets/css/style2.css">
    <link rel="stylesheet" href="assets/css/estiloregistro.css">
	<script>
		function quitar(){

			document.getElementById("negro").style.display="none";
			document.getElementById("dialogo").style.display="none";
		}
     </script>
</head>

<body>
 <?php require 'partials/header.php' ?> <!--llama la barra de inicio que aparece siempre -->

    <div class="wrapper">
        <div id="formContent">
            <div>
                <h4>
                    <b>Wiki</b> Multimedia
                </h4>
            </div>
            <div>
                <img src="login_libs/principleimage.png" id="icon" alt="User Icon" />
            </div>
            <!-- Login Form -->
            <form method="POST" action="recoverPass.php">
                <input type="email" id="txtCorreoElectronico" name="txtCorreoElectronico" placeholder="Correo Electrónico">
                
                <div class="loginButton">
                    <input type="submit" value="Enviar Contraseña">
                </div>
                
            </form>
            
            <div id="formFooter">
                <a class="underlineHover" href="login">Volver a iniciar sesión</a>
            </div>
     <!-- onclick='quitar()' -->
        </div>
        
        <?php 

		if(isset($validar) ){
			if($validar > 0){
				echo "
				<div onclick='quitar()' id='negro'>
				</div>

				<div id='dialogo'>
					<p>Se ha enviado un correo electrónico . Por favor verifica la información enviada.</p>
				</div>";


			}else if($validar == 0){
				echo "
				<div onclick='quitar()' id='negro'>
				</div>

				<div id='dialogo'>
					<p>El correo electrónico no se encuentra registrado en el sistema.</p>
				</div>";
			}
		}

	 ?>

    </div>

    <footer>
        <div class="containerfooter">
            <div class="blockfooter"><p>Creado en la Universidad Militar</p></div>
            <div class="blockfooter"><p>Contactanos al 781213213</p></div>
        </div>
    </footer>


<!-- verificar  para borrar -->
    <script src="<?php echo URL; ?>login_libs/jquery.min.js"></script> 
    <script src="<?php echo URL; ?>login_libs/bootstrap.min.js"></script>



</body>

</html>


