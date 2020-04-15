<?php
//Inicio de sesion, toma la sesión de el usuario logeado en caso de estarlo
session_start();
 
//Requerir conexión con la BD
  require '/wamp64/www/WikiA/LoginPHP/database.php';

//php mailer 

//  require 'vendor/autoload.php';


  if (isset($_SESSION['user_id'])) //Isset valida si existe la variable user_id dentro de $_SESSION[''], la sesión que se estableció con  "session_start()"
  {

    $records = $conn->prepare('SELECT id, email,nick, password FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();//ejecuta la  busqueda
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
    
    <!-- archivos de boostrap para el campo de titulo, autor y boton "SUBIR ARTICULO"-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    
    <!--se llama la libreria de ckeditor.js-->
    <script type="text/javascript" src="ckeditor/ckeditor.js"></script>

<!-- estilo agregados -->
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Varela+Round&display=swap" rel="stylesheet">    
    <!-- estilos de Alejo -->
      <link rel="stylesheet" type="text/css" href="assets\css\style2.css"> 

    <!-- fin de estilos -->

    <!--centrar el editor de texto-->
    <style type="text/css">#cke_editor1 {margin:auto;}</style>
    <title>Document</title>

</head>
<body>



<?php  include '/wamp64/www/WikiA/LoginPHP/partials/header.php' ?>
    
    <div class="container espacioindexedit ">
        <div class="nav-article">
            <h2 class="text-center">Wiki Multimedia</h2>
            <hr>
        </div>
        <div>
            <?php
                /*Cuando se oprime el boton SUBIR ARTICULO*/
                if(isset($_REQUEST['save'])){
                    require "articles.php"; /*Llama a articles.php para guardar cada parametro en la BD*/
                    $objArticle = new Articles();

                    /*con la instancia objArticle creada se solicita la info del articulo*/
                    $objArticle->setTitle($_REQUEST['title']);
                    $objArticle->setDescription($_REQUEST['editor1']);
                    $objArticle->setAuthor($_REQUEST['autor']);
                    date_default_timezone_set("America/Bogota");
                    $objArticle->setFecha(date('Y-m-d H:i:s'));
                    
                    if($objArticle->save()){
                        /*recuadro verde, registo exitoso en la BD*/
                        echo '<div class="alert alert-success" role="alert">
                        <div id="result">Inserted Successfully.</div></div>';
                    }else{
                        /*ERROR*/
                        echo '<div class="alert alert-success" role="alert">
                        <div id="result">Failed to Upload.</div></div>';
                    }
                }
            ?>
        </div>
        <div class="col-md-9 col-md-offset-1">
                <form id="article-frm" role="form" method="post" action="submit.php" class="form-horizontal cuadrarAncho">
                    <input type="hidden" name="aid" id="aid">
                    <div class="form-group">
                        <div class="input-group"> 
                            <!--Add on y recuadro de boostrap con un icono de lapiz por defecto-->
                            <div class="input-group-addon addon-diff-color">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </div>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Titulo del Articulo" >
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                             <!--Add on y recuadro de boostrap con un icono de usuario por defecto-->
                            <div class="input-group-addon addon-diff-color">
                                <span class="glyphicon glyphicon-user"></span>
                            </div>
                            <input type="text" class="form-control" id="title" name="autor" placeholder="Nombre del Autor" value= "<?= $user['nick']; ?>" readonly="readonly">
                        </div>
                    </div>

                    <div class="form-group">
                        <!--textarea es el recuadro para ingresar la informacion del articulo-->
                        <textarea name="editor1" class="form-control">Ingrese texto aqui...</textarea>
                    </div>
                    <div class="form-group">
                        <!--Boton de SUBIR ARTICULO-->
                        <input type="submit" name="save" class="btn btn-info" id="save" value="SUBIR ARTICULO">
                        <input type="submit" name="editor_submit" class="btn btn-info" id="save" value="VER ARTICULO">
                    </div>
                </form>
         </div>
    </div>


<?php



// $op=0;
// if (!empty($_POST['editor_submit']))
// $op=1;
// else if (!empty($_POST['save'])) 
// $op=2;


//  if ($op!=0)
//  {

//  switch ($op){
//  case '1':
//     echo"<br>";

//     include 'Art_Created.php'   ;   //Llama otro html(php) 
//      //echo $res;

//  break;
//  case '2':
//     echo"<br>";
    
//  break;
//  }
// }

?>
    <footer>
        <div class="containerfooter">
            <div class="blockfooter"><p>Creado en la Universidad Militar</p></div>
            <div class="blockfooter"><p>Contactanos al 781213213</p></div>
        </div>
    </footer>

    
    <script>
        /*CKEditor tiene una funcion .replace para reemplazar el textarea con la informacion ingresada para poder 
        guardarla en la base de datos*/
        CKEDITOR.replace('editor1', {
            /*permite almacenar las imagenes que adjunte el usuario*/
            filebrowserUploadUrl: 'ckeditor/ck_upload.php',
            filebrowserUploadMethod: 'form'
        });
        /*con la funcion .on se modificaron opciones dentro de la funcion que permite adjuntar una imagen*/
        CKEDITOR.on('dialogDefinition', function(e){
            /*se solicita el nombre de las variables para poder eliminar la funcion a la que corresponden*/
            dialogName = e.data.name;
            dialogDefinition = e.data.definition;
            console.log(dialogDefinition);
            if(dialogName == 'image'){
                dialogDefinition.removeContents('Link');/*Link y advance se encontraban dentro de la funcion para adjuntar 
                una imagen*/
                dialogDefinition.removeContents('advanced');
                var tabContent = dialogDefinition.getContents('info');
                /*variables que se eliminaron*/
                tabContent.remove('txtHSpace');
                tabContent.remove('txtVSpace');
            }
        })
         
        
    </script>
</body>
</html>