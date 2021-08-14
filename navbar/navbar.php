<?php
$tipo = $_SESSION['P28'];
?>


<nav class="navbar navbar-expand-lg" style="box-shadow: 0px 2px 11px;background-color: whitesmoke;">
  <div class="container-fluid">
    <a class="navbar-brand" href="/biomedicina/inicio.php">
      <h3 style="font-size: 25px;color: #777;">Equipos Ingeniería Clínica </h3>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" style="color: #777;" href="/biomedicina/inicio.php">Equipos</a>
        </li>
        <?php if ($perfil == 3 || $perfil == 2)  { ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" style="color: #777;" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Administrador
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          <li><a class="dropdown-item" href="/biomedicina/area/ver_areas.php">Áreas</a></li>
					<li>
						<hr class="dropdown-divider">
					</li>
          <li><a class="dropdown-item" href="/biomedicina/ubicacion/ver_ubicaciones.php">Ubicaciones</a></li>
					<li>
						<hr class="dropdown-divider">
					</li>
          <li><a class="dropdown-item" href="/biomedicina/marca/ver_marcas.php">Marcas</a></li>
					<li>
						<hr class="dropdown-divider">
					</li>
          <li><a class="dropdown-item" href="/biomedicina/proveedor/ver_proveedores.php">Proveedores</a></li>
					<li>
						<hr class="dropdown-divider">
					</li>
          <li><a class="dropdown-item" href="/biomedicina/tipo_equipo/ver_tipo_equipo.php">Tipos de Equipos</a></li>
					<li>
          </ul>
        </li>
        <?php } ?>
        </ul>
        </div>
        </div>
        <?php if($_SESSION['usuario'] == "  "){?>
          <div class="btn-group dropstart">
            <button type="button" class="btn btn dropdown-toggle" style="background-color: slateblue;color:white;" data-bs-toggle="dropdown" aria-expanded="false">  
            </button>       
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="/biomedicina/logout.php">Cerrar Sesión</a></li>
                </li>
              </ul>
          </div>


        <?php } else { ?>
          <ul class="nav navbar-nav navbar-right">
				  <li class="nav-item dropdown">
            <a href="#" class="dropdown-toggle" style="color: #777; text-decoration: none;" role="button" data-toggle="dropdown" aria-expanded="true"><?php echo $_SESSION['usuario']; ?> <b class="caret"></b></a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="/biomedicina/logout.php">Cerrar Sesión</a></li>        
            </ul>
          </li>
        </ul>
          <?php } ?>

        <!-- boton desabilitado
        <li class="nav-item">
          <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">hola</a>
        </li>  -->
      
      

</nav>