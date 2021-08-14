 

<!DOCTYPE html>
<html lang="es">
<head>
	<title>Login</title>
    <link rel="icon" type="image/png" href="./img/icono.ico"/>
  	<?php include './enlaces/enlaces.php'; ?>

	<script>
		function validar()
		{
			if(document.formulario.login.value=="" ||document.password.value=="")
			{
				alert("Todos los Campos deben ser Diligenciados.");
				return false;
			}
			
			else
				return true;
		}
		function volver()
		{
		document.location=('http://intranet/cpalmira/'); 
		}
		function contrasena()
		{
		document.location=('enviar.html');
		}
	</script>
</head><br><br>
<body style="background-color: slateblue">
<!--
<body style="background:url(./img/banner.jpg) no-repeat center center fixed; background-size: cover;
        -moz-background-size: cover;
        -webkit-background-size: cover;
        -o-background-size: cover;">-->
	<div class="container " >
		<div class="row justify-content-md-center" >
			<div class="col-md-12" style="padding: 30px;">
				<h1 class="text-center" style="margin-bottom: 20px; color:#edf0f7;font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;" > EQUIPOS DE INGENIERÍA CLÍNICA </h1>
				<div class="row">
					<div class="col-md-4 offset-md-4 col-sm-6 offset-sm-3" style="visibility: visible; animation-name: fadeInUp; box-shadow: 0px 2px 41px; border-radius: 10px; background: linen;padding:20px; height:300px;width:320;">

						<form class="form" role="form" method="POST" action="./page/validacion.php">
								<div class="text-center" style="margin-bottom: 20px;margin-top:20px;">
									<div class="">
										<i class=" fa fa-user-circle" aria-hidden="true" style="color: #348498;; font-size: 35px">	
										</i>
									</div>
									<div class="">	
										<h2 style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
											Iniciar Sesión
										</h2>
										
									</div>							
								</div>

								<div class="form-group">
									<label class="sr-only" for="form-first-name">login</label>
									<input type="text" name="login" required="required" placeholder="Usuario" class="form-first-name form-control" id="form-first-name" >
								</div>
								<div class="form-group">
									<label class="sr-only" for="form-last-name">Password</label>
									<input type="password" required="required" name="password" placeholder="Contraseña" class="form-last-name form-control" id="form-last-name" >
								</div>
								<div class=" row ">
									<div class=" col-md-8 offset-md-2 text-center" >
									<button type="submit" class="btn btn-xs float" style="background-color: dodgerblue;color:white;" id="btnLogin">Iniciar</button>
                                	<button type="button" class="btn btn-xs btn-secondary" onclick="volver();">Volver</button> 
									</div>			
								</div>	
                               
                        </form>						
					</div>
				</div>				
			</div>			
		</div>		
	</div>	
</body>
</html>

