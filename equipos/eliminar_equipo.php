<?php  
session_start();
include '../enlaces/enlaces.php';
include '../base_datos/seguridad.php';
include '../base_datos/conexion_biomedicina.php';

echo '.';

$id=$_REQUEST['id'];

$sql = "DELETE FROM ft_equipo WHERE id_equipo='$id'";
$resultado = mysqli_query($link,$sql) or die("Error: ".mysqli_error($link));	

if (isset($resultado)){ ?>
	<script>
	Swal.fire({
	icon: 'success',
	title: 'Equipo Eliminado',
	 confirmButtonText: `Aceptar`,
}).then((result) => {
  if (result.isConfirmed) {
	  
	window.location='../inicio.php';
  } else if (result.isConfirmed == false) {
	window.location='../inicio.php';
  }
})
	</script> 

	<?php } ?>