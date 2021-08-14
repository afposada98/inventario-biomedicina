<?php
    require '../base_datos/conexion_biomedicina.php';    
	
	$id_area = $_POST['area'];

	$queryM = "SELECT * FROM ubicacion WHERE id_area='$id_area'";

	$resultadoM = mysqli_query($link, $queryM);
	
	$html= "<option value='0'>Seleccione...</option>";
	
    while ($fila = mysqli_fetch_array($resultadoM)) {
		$html =$html."<option value='".$fila['id_ubicacion']."'>".$fila['descripcion']."</option>";
    }
	echo $html;	
?>