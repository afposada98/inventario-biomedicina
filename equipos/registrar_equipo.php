<?php  
session_start();
include '../enlaces/enlaces.php';
include '../base_datos/seguridad.php';
include '../base_datos/conexion_biomedicina.php';

echo '.';
$tipo_equipo = $_POST['tipo_equipo'];
$modelo = $_POST['modelo'];
$serie = $_POST['serie'];
$activo_fijo = $_POST['activo_fijo'];
$invima = $_POST['invima'];
$marca = $_POST['marca'];
$ubicacion = $_POST['ubicacion'];
$clasificacion = $_POST['clasificacion'];
$ingreso = $_POST['ingreso'];
$f_ingreso = $_POST['f_ingreso'];
$proveedor = $_POST['proveedor'];

//Convertir el campo de tipo mes, para que lo reciba la base de datos en tipo date
$f_fabricacion = $_POST['f_fabricacion'];
$f_fabricacion=$f_fabricacion."-01";

$sql = "INSERT INTO ft_equipo (id_tipo_equipo, id_marca, modelo, serie, activo_fijo, id_ubicacion, id_estado, registro_invima, id_clasificacion, id_tipo_ingreso, f_fabricacion, f_ingreso, id_proveedor)
VALUES ('$tipo_equipo','$marca','$modelo','$serie','$activo_fijo','$ubicacion',1,'$invima','$clasificacion','$ingreso','$f_fabricacion','$f_ingreso','$proveedor')" ;

$resultado = mysqli_query($link,$sql) or die("Error: ".mysqli_error($link));	

if (isset($resultado)){ ?>
	<script>
	Swal.fire({
	icon: 'success',
	title: 'Equipo Creado',
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