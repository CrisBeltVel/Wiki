<?php
    class BDConnect{
        private $host = 'localhost:3308'; /*manejando MySQL*/
        private $username = 'root';
        private $password = '';
        private $dbName = 'contenido';/*Nombre de la base de datos*/

        public function connect(){
            try {
                //conn es la variable de conexion--El host el servidor, parametros de conexión
                  $conn2 = new PDO('mysql:host=' . $this->host . '; dbname=' . $this->dbName, $this->username, $this->password);
                  $conn2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                  return $conn2;
                } catch (PDOException $e) {
                  die('Connection Failed: ' . $e->getMessage());
                }
        }

    }
?>