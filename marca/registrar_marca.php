<?php  
session_start();
include '../enlaces/enlaces.php';
include '../base_datos/seguridad.php';
include '../base_datos/conexion_biomedicina.php';

echo '.';

$descripcion=preg_replace("/'/", "''",$_POST['descripcion']);

$sql = "INSERT INTO marca (descripcion) VALUES ('$descripcion')";
$resultado = mysqli_query($link,$sql) or die("Error: ".mysqli_error($link));	

if (isset($resultado)){ ?>
	<script>
	Swal.fire({
	icon: 'success',
	title: 'Marca Agregada',
	 confirmButtonText: `Aceptar`,
}).then((result) => {
  if (result.isConfirmed) {
	  
	window.location='ver_marcas.php';
  } else if (result.isConfirmed == false) {
	window.location='ver_marcas.php';
  }
})
	</script> 

	<?php } ?>