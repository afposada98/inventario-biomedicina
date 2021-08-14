<?php
    //Conexión a la base de datos
	function Conectarse3()
	{
		if (!($link=mysqli_connect("localhost","root","CP69775WD"))) {
			echo "Error conectando a la base de datos Talento.";
			exit();
		}
		if (!mysqli_select_db($link,"talento")) {
			echo "Error seleccionando la base de datos Talento.";
			exit();
		}
		return $link;
	}
	$link = Conectarse3();
	return $link;
?>