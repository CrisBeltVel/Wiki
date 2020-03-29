
<!-- Codigo que permite mostrar un enlace para ir a la pag principal desde el directorio donde esta el proyecto -->


<!-- <a href="/WikiA/LoginPHP"> LOGO</a> -->

<header class="horizontalspace">
		<div class="auxnavleft">
			<!-- Logo -->
			<div class="auxresponsive">
			<a href="/WikiA/LoginPHP"><img   src="images/logo.png" class="imglogo"> </a>  
				<a href="" onclick="showburger(); return false; "  class="burgermenu">
					<img src="images/menu.png" >
				</a>
			</div>
			<!-- Buscador -->
			<input id="buscador" type="text" name="" placeholder="Busca algun articulo">
		</div>
		<nav id="menunavegacion">
			<ul>
				<li><a href="">Categorias</a>
					<ul class="dropdown">
						<li><a href="">Ciencias de la computacion</a></li>
						<li><a href="">Diseño</a></li>
						<li><a href="">Animacion y cine</a></li>
						<li><a href="">Procesamiento de datos</a></li>
						<li><a href="">Artes computacionales</a></li>
						<li><a href="">Expresion Grafica</a></li>
					</ul>
				</li>        
				<li><a href="login.php">Iniciar Sesion</a></li>
				<li><a href="signup.php">Registro</a></li>
			</ul>
		</nav>		
	</header>