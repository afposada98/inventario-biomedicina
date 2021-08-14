<?php
session_start();
error_reporting(0);

// conexion users
include("../base_datos/conexion_users.php");

//VARIABLE CON EL USUARIO CON QUE INGRESO
$login = $_REQUEST['login'];

//VARIABLE CON LA CONTRASEÑA CON QUE INGRESO
$password = $_REQUEST['password'];

//SE CONSULTA EN LA BASE DE DATOS EL USUARIO, LA ONTRASEÑA, EL ID DEL USUARIO Y LA CEDULA DEL USUARIO
$sql = "SELECT * FROM usuarios WHERE login='$login'";

$query = mysqli_query($link, $sql);
$select = mysqli_fetch_array($query);

//DATOS DE LA CONSULTA

//$pass = $select['pass'];
$pwd = $select['passwd'];		// CONTRASEÑA 
$lgn = $select['login'];		// USUARIO	
$id = $select['id'];			// ID USUARIO
$cedula = $select['cedula'];	// CEDULA USUARIO

$_SESSION['RUTA_BIOMEDICINA'] = $_SERVER["DOCUMENT_ROOT"] . '/biomedicina';


//ESTA CONDICION VA A VER SI LOS DATOS QUE LA PERSONA INGRESO SON LOS MISMOS QUE ESTAN EN LA BASE DE DATOS
if(($lgn == $login)&&($pwd == md5($password))) {
	
	$sql = "SELECT * FROM permisos WHERE id='$id' and cod_programa=29";
	
	$query = mysqli_query($link, $sql);
	$fila = mysqli_fetch_array($query);
	
	$tipo = $fila['cod_perfil'];

	// conexion talento
	include("../base_datos/conexion_talento.php");
	
		$sql = "SELECT * FROM empleados WHERE cedula='$cedula'";
		
		$query = mysqli_query($link, $sql);
		$selec = mysqli_fetch_array($query);
		
		$cod_area = $selec['cod_area'];
		$tipo_empleado = $selec['tipo_empleado'];
		
		$sql = "SELECT * FROM areas WHERE cod_area='$cod_area'";
		
		$query = mysqli_query($link, $sql);
		$sele = mysqli_fetch_array($query);

		$area = $sele['nom_area'];
		
		$sql = "SELECT * FROM empleados WHERE cedula='$cedula'";
		
		$query = mysqli_query($link, $sql);
		$select2 = mysqli_fetch_array($query);

		$nombre = $select2['nombres'] . " " . $select2['primer_apellido'] . " " . $select2['segundo_apellido'];
	
		$_SESSION['id']= $id;
		$_SESSION['usuario']= $nombre;
		$_SESSION['area']= $area;
		$_SESSION['P29']= $tipo;
		header("Location:../inicio.php"); // usuario normal

		if($tipo==1) {
			if($tipo== 1) {
				header("Location:../inicio.php"); // usuario normal
			} else {
				echo "<script> alert('Permisos insuficientes para ingresar.1'); document.location=(\"../index.php\");</script>";
			}			
			
		} else {
			if($tipo==5 || $tipo == 2) {
				header("Location:../inicio.php"); // usuario2
			} else {
				if($tipo==2) {
					header("Location:../inicio.php"); //super admin
				} else {
					echo "<script> alert('Permisos insuficientes para ingresar..2'); document.location=(\"../index.php\");</script>";
				}
			}
		}
	} else {
		echo "<script> alert('Login y/o Password Incorrectos...'); document.location=(\"../index.php\");</script>";
	}
	
	
	
mysqli_close($link);
?>
	
	