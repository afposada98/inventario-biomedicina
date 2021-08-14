<?php  
session_start();
include '../enlaces/enlaces.php';
include '../base_datos/seguridad.php';
include '../base_datos/conexion_biomedicina.php';

echo '.';

$id=$_POST['id'];
$descripcion=$_POST['descripcion'];
$telefono=$_POST['telefono'];
$correo=$_POST['correo'];


$sql = "UPDATE proveedor SET nombre='$descripcion', telefono='$telefono', correo='$correo' WHERE id_proveedor='$id'";
$resultado = mysqli_query($link,$sql) or die("Error: ".mysqli_error($link));	

if (isset($resultado)){ ?>
	<script>
	Swal.fire({
	icon: 'success',
	title: 'Proveedor Modificado',
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