<?php
    /*aqui se encuentran todas las variables y funciones para conectar la informacion desde el indexedit.php
    a la base de datos*/
    class Articles{
        private $id;
        private $titulo;
        private $descripcion;
        private $autor;
        private $fecha;
        protected $dbConn; /*variable para hacer la conexion con la base de datos*/
    

        /*setters y getters de cada elemento del articulo*/
        function setId($id){
            $this->id = $id;
        }
        function getId(){
            return $this->id;
        }
        function setTitle($titulo){
            $this->titulo = $titulo;
        }
        function getTitle(){
            return $this->titulo;
        }
        function setDescription($descripcion){
            $this->descripcion = $descripcion;
        }
        function getDescription(){
            return $this->descripcion;
        }
        function setAuthor($autor){
            $this->autor = $autor;
        }
        function getAuthor(){
            return $this->autor;
        }
        function setFecha($fecha){
            $this->fecha = $fecha;
        }
        function getFecha(){
            return $this->fecha;
        }

        /*estas funciones se pueden llamar en la interfaz de un usuario logueado o admin para modifica, agregar, u obtener articulos*/
        /*conexion a la base de datos*/
        public function __construct(){
            require_once('BDConnect.php');
            $db = new BDConnect();
            $this->dbConn = $db->connect();
        }
        public function save(){
            /*nombre de la tabla en la base de datos: articulos*/
            $sql = "INSERT INTO `articulos` (`id` , `titulo`, `descripcion`, `autor`, `fecha`) VALUES (null, :title, :descp, :author, :cdate)";
            $stmt = $this->dbConn->prepare($sql);
            /*asigna cada parametro con la informacion del articulo agregada dentro de las variables definidas
            en articles.php para enviarlas a la base de datos solicitando el archivo BDConnect.php una vez*/
            $stmt->bindParam(':title', $this->titulo);
            $stmt->bindParam(':descp', $this->descripcion);
            $stmt->bindParam(':author', $this->autor);
            $stmt->bindParam(':cdate', $this->fecha);
            
            /*reporta si la operacion fue exitosa o si hubo un error*/
            if($stmt->execute()){
                return true;
            }else{
                return false;
            }
        }
        public function update(){

        }
        public function getArticleById(){

        }
    }

?>