<?php  
session_start();
include '../enlaces/enlaces.php';
include '../base_datos/seguridad.php';
include '../base_datos/conexion_biomedicina.php';

echo '.';

$id=$_REQUEST['id'];

$sql = "DELETE FROM ubicacion WHERE id_ubicacion='$id'";
$resultado = mysqli_query($link,$sql) or die("Error: ".mysqli_error($link));	

if (isset($resultado)){ ?>
	<script>
	Swal.fire({
	icon: 'success',
	title: 'Ubicación Eliminada',
	 confirmButtonText: `Aceptar`,
}).then((result) => {
  if (result.isConfirmed) {
	  
	window.location='ver_ubicaciones.php';
  } else if (result.isConfirmed == false) {
	window.location='ver_ubicaciones.php';
  }
})
	</script> 

	<?php } ?>