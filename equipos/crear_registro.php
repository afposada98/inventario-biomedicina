<?php
session_start();
include '../base_datos/conexion_biomedicina.php';
include '../enlaces/enlaces.php';

echo '.';

$id_equipo = $_POST['id_equipo'];
$tipo_mantenimiento = $_POST['tipo_mantenimiento'];
$descripcion = $_POST['descripcion'];

//capturamos los datos del fichero subido    
$type=$_FILES['archivo']['type'];
$tmp_name = $_FILES['archivo']["tmp_name"];
$name = $_FILES['archivo']["name"];

//Creamos una nueva ruta (nuevo path)
//Así guardaremos nuestra imagen en la carpeta "archivo"
$nuevo_path="../pdf/".$name;

//Movemos el archivo desde su ubicación temporal hacia la nueva ruta
# $tmp_name: la ruta temporal del fichero
# $nuevo_path: la nueva ruta que creamos
move_uploaded_file($tmp_name,$nuevo_path);

//Extraer la extensión del archivo. P.e: jpg
# Con explode() segmentamos la cadena de acuerdo al separador que definamos. En este caso punto (.)
$array=explode('.',$nuevo_path);

# Capturamos el último elemento del array anterior que vendría a ser la extensión
$ext= end($array);

$sql = "INSERT INTO registros (id_equipo, tipo_actividad, descripcion, archivo)
VALUES ('$id_equipo','$tipo_mantenimiento','$descripcion','$name')";

$resultado = mysqli_query($link,$sql) or die("Error: ".mysqli_error($link));

if (isset($resultado)){ ?>
    <script>
    Swal.fire({
    icon: 'success',
    title: 'Registro Creado',
     confirmButtonText: `Aceptar`,
}).then((result) => {
  if (result.isConfirmed) {
      
    window.location='editar_equipo.php?id=<?=$id_equipo?>';
  } else if (result.isConfirmed == false) {
    window.location='../inicio.php';
  }
})
    </script> 
    <?php
}
?>

