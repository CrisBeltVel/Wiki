
<?php

// permite Salir

  session_start();//inica la sesion

  session_unset();//Termina la sesion

  session_destroy();//Destruye la sesion

  header('Location: /WikiA/LoginPHP');
?>