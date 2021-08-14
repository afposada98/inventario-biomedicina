<?php  
session_start();
include '../enlaces/enlaces.php';
include '../base_datos/seguridad.php';
include '../base_datos/conexion_biomedicina.php';

echo '.';

$id=$_POST['id'];
$descripcion=preg_replace("/'/", "''",$_POST['descripcion']);

$sql = "UPDATE tipo_equipo SET descripcion='$descripcion' WHERE id_tipo='$id'";
$resultado = mysqli_query($link,$sql) or die("Error: ".mysqli_error($link));	

if (isset($resultado)){ ?>
	<script>
	Swal.fire({
	icon: 'success',
	title: 'Tipo de Equipo Modificado',
	 confirmButtonText: `Aceptar`,
}).then((result) => {
  if (result.isConfirmed) {
	  
	window.location='ver_tipo_equipo.php';
  } else if (result.isConfirmed == false) {
	window.location='ver_tipo_equipo.php';
  }
})
	</script> 

	<?php } ?>