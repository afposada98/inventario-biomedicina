<?php
session_start();
include '../base_datos/conexion_biomedicina.php';
include '../enlaces/enlaces.php';

$id_equipo=$_REQUEST['id_equipo'];

$id_registro=0;
if(isset($_REQUEST['id_registro'])){
    $id_registro=$_REQUEST['id_registro'];
}

echo '.';


$sql = "DELETE FROM registros WHERE id_registro='$id_registro'";

$resultado = mysqli_query($link,$sql) or die("Error: ".mysqli_error($link));	


if (isset($resultado)){ ?>
    <script>
    Swal.fire({
    icon: 'success',
    title: 'Registro Eliminado',
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