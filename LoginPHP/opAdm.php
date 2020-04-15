

<?php

//Se planea organizar todo en forma de funciones pero miestras se determian el html de los articulos y el de la 
//pag de usuario y admin se deja el codigo puro unido de la infromación. 


$db = new BDConnect();
$dbConn = $db->connect();

if (!empty($user)) 
{
//    $records = $dbConn->prepare("SELECT * FROM articulos "); //ejecutar la consulta a la tabla user
  //   $records->execute();
    // $Total=$records->rowCount();

 //   $records = $db->pdo->query("SELECT count(1) FROM usuarios");
   // echo $records->fetchColumn()

        $records = $dbConn->prepare("SELECT count(1) FROM articulos "); //ejecutar la consulta a la tabla user
        $records->execute();
        $Total=$records->fetchColumn();
     echo "Articulos totales  $Total";


     //conteno 
        $records = $dbConn->prepare("SELECT count(1) FROM articulos WHERE Aprobado = 1 "); //ejecutar la consulta a la tabla user
        $records->execute();
        $TotalA=$records->fetchColumn();

        echo"<br>";
        echo "Articulos Aprobados  $TotalA";
        $TotalF = $Total-$TotalA;
        echo"<br>";
        echo "Articulos por revisar  $TotalF";

        //contar Usuarios

        $records = $conn->prepare("SELECT count(1) FROM users  "); //ejecutar la consulta a la tabla user
        $records->execute();
        $TotalU=$records->fetchColumn();

        echo"<br>";
        echo "Usuario con cuenta creada:  $TotalU";


        //Listados de aprobados


        echo "<table style='border: solid 1px black;'>";
        echo "<tr><th>Id</th><th>Titulo</th><th>Autor</th><th>Fecha</th><th>Aprobado</th><th>Check</th></tr>";
        $i=0;
        class TableRows extends RecursiveIteratorIterator {
            function __construct($it) {
                parent::__construct($it, self::LEAVES_ONLY);

                
            }
        
            function current() {
                return "<td style='width:110px;border:1px solid black ;'>" . parent::current(). "</td>";
                
            }
        
            function beginChildren() {
                echo "<tr>";
                
                echo "</tr>" . "\n";
      
            }
        
         
            function endChildren() {
                $i=+1;
                echo '<input type="checkbox" name="Ap" value="$i">Aprobar</label>' ;
                echo $i;
                echo "</tr>" . "\n";
            }
        
         
        

        }




        
}



?>

<br> <br> <br>



<form action="index.php" method="post">

<label class="heading">Seleccione los articulos a aprobar:</label>

<div class = "tamLetra">
<?php 

//$i=0;

 $records = $dbConn->prepare("SELECT id, Titulo, Autor, Fecha,Aprobado FROM articulos WHERE Aprobado = 0 ");
 $records->execute();

 $result = $records->setFetchMode(PDO::FETCH_ASSOC);
 foreach(new TableRows(new RecursiveArrayIterator($records->fetchAll())) as $k=>$v)
  {
      echo $v ;

      //  $i=$i+1;

    //  echo '<input type="checkbox" name="Ap" value="$i">Aprobar</label>' ;
    //  echo $i;

 }
 
?>

</div>


<div class="checkbox">
  <label><input type="checkbox" name="Aprob" value="Ap">Aprobar</label>
</div>

<button type="submit" class="btn btn-primary" name="enviar">Enviar Información</button>
</form>