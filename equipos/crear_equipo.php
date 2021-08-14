<?php
session_start();
include '../base_datos/seguridad.php';
include '../base_datos/conexion_biomedicina.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
<?php include '../enlaces/enlaces.php'; ?>
    <title> Crear Equipo</title>
</head>

<body style="padding-bottom: 20px">
    <?php include '../navbar/navbar.php';?>
   
    <div class="container">
        <div class="titulos-crear">
            <a class="salida" href="../inicio.php">X</a>
            <h1>Registrar Equipo</h1>
        </div>

        <div class="card edicion">
        <form action="registrar_equipo.php" method="post">
                <div class="row informacion">

                <div class="form-group col-md-4">
                        <label class="descripcion">Tipo Equipo</label>
                        <select class="form-select" name="tipo_equipo">
                            <?php
                            $sql = "SELECT id_tipo, descripcion FROM tipo_equipo ORDER BY descripcion ASC";
                            $query = mysqli_query($link, $sql) or die("Error: " . mysqli_error($link));

                            while ($fila = mysqli_fetch_array($query)) { ?>
                                <option required value="<?php echo $fila['id_tipo']; ?>" selected><?php echo $fila['descripcion'] ?></option>
                            <?php  } ?>
                        </select>
                </div> 

                 <div class="form-group col-md-2">
                        <label class="descripcion">Modelo</label>
                        <input type="text" name="modelo" class="form-control">
                </div>

                <div class="form-group col-md-2">
                        <label class="descripcion">Serie</label>
                        <input type="text" name="serie" class="form-control">
                </div>               

                <div class="form-group col-md-2">
                        <label class="descripcion">Activo Fijo</label>
                        <input type="text" name="activo_fijo" class="form-control">
                </div>
                  
                <div class="form-group col-md-2">
                        <label class="descripcion">Registro Invima</label>
                        <input type="text" name="invima" class="form-control">
                </div>
                
                <div class="form-group col-md-2">
                        <label class="descripcion">Marca</label>
                        <select class="form-select" name="marca">
                            <?php
                            $sql = "SELECT id_marca, descripcion FROM marca";
                            $query = mysqli_query($link, $sql) or die("Error: " . mysqli_error($link));

                            while ($fila = mysqli_fetch_array($query)) { ?>
                                <option required value="<?php echo $fila['id_marca']; ?>"><?php echo $fila['descripcion']; ?></option>
                            <?php  } ?>
                        </select>
                </div> 

                <div class="form-group col-md-4">
                        <label class="descripcion">Proceso</label>
                        <select class="form-select" name="area" id="area">
                            <option value="0" selected>Seleccione...</option>

                            <?php
                            $sql = "SELECT * FROM area ORDER BY descripcion ASC";
                            $query = mysqli_query($link, $sql) or die("Error: " . mysqli_error($link));

                            while ($fila = mysqli_fetch_array($query)) { ?>
                                <option value="<?php echo $fila['id_area']; ?>"><?php echo $fila['descripcion'] ?></option>
                            <?php } ?>
                        </select>
                </div> 
                
                <div class="form-group col-md-4">
                        <label class="descripcion">Ubicación</label>
                        <select class="form-select" name="ubicacion" id="ubicacion">
                            <option>Seleccione...</option>                         
                        </select>
                </div> 

                <div class="form-group col-md-2">
                        <label class="descripcion">Clasificación Riesgo</label>
                        <select class="form-select" name="clasificacion">
                            <?php
                            $sql = "SELECT id_clasificacion, descripcion FROM clasi_riesgo";
                            $query = mysqli_query($link, $sql) or die("Error: " . mysqli_error($link));

                            while ($fila = mysqli_fetch_array($query)) { ?>
                                <option required value="<?php echo $fila['id_clasificacion']; ?>"><?php echo $fila['descripcion']; ?></option>
                            <?php  } ?>
                        </select>
                </div>  

                <div class="form-group col-md-2">
                        <label class="descripcion">Tipo Ingreso</label>
                        <select class="form-select" name="ingreso">
                            <?php
                            $sql = "SELECT id_ingreso, descripcion FROM tipo_ingreso ORDER BY descripcion ASC";
                            $query = mysqli_query($link, $sql) or die("Error: " . mysqli_error($link));

                            while ($fila = mysqli_fetch_array($query)) { ?>
                                <option required value="<?php echo $fila['id_ingreso']; ?>"><?php echo $fila['descripcion']; ?></option>
                            <?php  } ?>
                        </select>
                </div>  

                <div class="form-group col-md-auto">
                        <label class="descripcion">Fecha Fabricación</label>
                        <input type="month" name="f_fabricacion" class="form-control">
                </div>   
                
                <div class="form-group col-auto">
                        <label class="descripcion">Fecha Ingreso:</label>
                        <input type="date" name="f_ingreso" class="form-control">
                </div> 
                
                <div class="form-group col-md">
                        <label class="descripcion">Proveedor:</label>
                        <select class="form-select" name="proveedor">
                            <?php
                            $sql = "SELECT id_proveedor, nombre FROM proveedor";
                            $query = mysqli_query($link, $sql) or die("Error: " . mysqli_error($link));

                            while ($fila = mysqli_fetch_array($query)) { ?>
                                <option required value="<?php echo $fila['id_proveedor']; ?>"><?php echo $fila['nombre']; ?></option>
                            <?php  } ?>
                        </select>
                </div>

                <div class="col-md-12 text-center" style="margin: 7px;">
                    <button type="submit" class="btn" style="background-color: teal;color:white;">Guardar</button>
                    <a type="button" href="../inicio.php" class="btn" style="background-color: slateblue; color:white;">Cancelar</a>
                </div>
            </div>
        </form>
        </div>

    </div>
</body>

</html>

<script language="javascript">
	$(document).ready(function(){
		$("#area").on('change', function () {
			$("#area option:selected").each(function () {
				var area = $(this).val();
				$.post("ubicaciones.php", { area: area }, function(data) {
					$("#ubicacion").html(data);
				});			
			});
	   });
	});
</script>