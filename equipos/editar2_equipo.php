<?php  
session_start();
include '../enlaces/enlaces.php';
include '../base_datos/seguridad.php';
include '../base_datos/conexion_biomedicina.php';

date_default_timezone_set("America/Bogota");
echo '.';

$id_equipo=$_POST['id_equipo'];
$tipo_equipo=$_POST['tipo_equipo'];
$modelo = $_POST['modelo'];
$serie = $_POST['serie'];
$activo_fijo = $_POST['activo_fijo'];
$invima = $_POST['invima'];
$marca = $_POST['marca'];
$ubicacion = $_POST['ubicacion'];
$clasificacion = $_POST['clasificacion'];
$tipo_ingreso = $_POST['tipo_ingreso'];
$f_ingreso = $_POST['f_ingreso'];
$proveedor = $_POST['proveedor'];
$estado = $_POST['estado'];



$f_fabricacion = $_POST['f_fabricacion'];
$f_fabricacion=$f_fabricacion."-01";

$fecha_modifica=date("Y-m-d-H:i:s"); 

$sql = "UPDATE ft_equipo SET id_tipo_equipo='$tipo_equipo', modelo='$modelo', serie='$serie', id_estado='$estado',
activo_fijo='$activo_fijo', registro_invima='$invima', id_marca='$marca', id_clasificacion='$clasificacion',id_ubicacion='$ubicacion',
id_tipo_ingreso='$tipo_ingreso', f_fabricacion='$f_fabricacion', f_ingreso='$f_ingreso', id_proveedor='$proveedor' WHERE id_equipo='$id_equipo'";

$resultado = mysqli_query($link,$sql) or die("Error: ".mysqli_error($link));	

$last_id = mysqli_insert_id($link);

if (isset($resultado)){ ?>
	<script>
	Swal.fire({
	icon: 'success',
	title: 'Equipo Modificado',
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