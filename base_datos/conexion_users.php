<?php
    //Conexi�n a la base de datos
	function Conectarse2()
	{
		if (!($link=mysqli_connect("localhost","root","CP69775WD"))) {
			echo "Error conectando a la base de datos Users.";
			exit();
		}
		if (!mysqli_select_db($link,"users")) {
			echo "Error seleccionando la base de datos Users";
			exit();
		}
		return $link;
	}
	$link = Conectarse2();
	return $link;
?>