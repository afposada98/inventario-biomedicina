<?php  
session_start();
include '../enlaces/enlaces.php';
include '../base_datos/seguridad.php';
include '../base_datos/conexion_biomedicina.php';

echo '.';

$id=$_POST['id'];
$id_area=$_POST['area'];
$descripcion=preg_replace("/'/", "''",$_POST['descripcion']);

$sql = "UPDATE ubicacion SET id_area='$id_area', descripcion='$descripcion' WHERE id_ubicacion='$id'";
$resultado = mysqli_query($link,$sql) or die("Error: ".mysqli_error($link));	

if (isset($resultado)){ ?>
	<script>
	Swal.fire({
	icon: 'success',
	title: 'Ubicación Modificada',
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