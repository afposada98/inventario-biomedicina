<?php 
    //Conexión a la base de datos
	function Conectarse()
	{
		if (!($link=mysqli_connect("localhost","root","CP69775WD"))) {
			echo "Error conectandose al Servidor.";
			exit();
		}
		if (!mysqli_select_db($link,"biomedicina")) {
			echo "Error conectando la Base de Datos.";
			exit();
		}
		return $link;
	}
	$link = Conectarse();
	mysqli_set_charset($link,"UTF8");
	return $link;	
?>