<?php  
session_start();
include '../enlaces/enlaces.php';
include '../base_datos/seguridad.php';
include '../base_datos/conexion_biomedicina.php';

echo '.';
$id_area=$_POST['area'];
$descripcion=preg_replace("/'/", "''",$_POST['descripcion']);

$sql = "INSERT INTO ubicacion (id_area,descripcion) VALUES ('$id_area','$descripcion')";
$resultado = mysqli_query($link,$sql) or die("Error: ".mysqli_error($link));	

if (isset($resultado)){ ?>
	<script>
	Swal.fire({
	icon: 'success',
	title: 'Ubicación Agregada',
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