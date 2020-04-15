<?php

echo "<table style='border: solid 1px black;'>";       // ayuda a crear el grafico en forma de tabla donde se presentan los datos de los articulos
echo "<tr><th>Id</th><th>Titulo</th><th>Autor</th><th>Fecha</tr>";

class TableRows extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }

    function current() {
        return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
    }

    function beginChildren() {
        echo "<tr>";
    }

    function endChildren() {
        echo "</tr>" . "\n";
    }

}



$db = new BDConnect();
$dbConn = $db->connect();

$nn=$user['nick'];

if (!empty($user)) 
{
    $records = $dbConn->prepare("SELECT id, Titulo, Autor, Fecha FROM articulos WHERE Autor = '$nn' "); //ejecutar la consulta a la tabla user
    //$stmt = $this->dbConn->prepare($sql);
    $records->bindParam(':Autor',  $nn); 
    $records->execute();

    $result = $records->setFetchMode(PDO::FETCH_ASSOC);
    foreach(new TableRows(new RecursiveArrayIterator($records->fetchAll())) as $k=>$v) {
        echo $v;
    }
   }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<h1>ArticulosCreados de este usuario(completar)</h1>

<a href="">Mira tus Articulos <?= $user['nick']; ?>  ▼</a>



</body>
</html>
