<?php  
session_start();
include '../enlaces/enlaces.php';
include '../base_datos/seguridad.php';
include '../base_datos/conexion_biomedicina.php';

echo '.';

$nombre=$_POST['descripcion'];
$telefono=$_POST['telefono'];
$correo=$_POST['correo'];

$sql = "INSERT INTO proveedor (nombre,telefono,correo) VALUES ('$nombre','$telefono','$correo')";
$resultado = mysqli_query($link,$sql) or die("Error: ".mysqli_error($link));	

if (isset($resultado)){ ?>
	<script>
	Swal.fire({
	icon: 'success',
	title: 'Proveedor Agregado',
	 confirmButtonText: `Aceptar`,
}).then((result) => {
  if (result.isConfirmed) {
	  
	window.location='ver_proveedores.php';
  } else if (result.isConfirmed == false) {
	window.location='ver_proveedores.php';
  }
})
	</script> 

	<?php } ?>