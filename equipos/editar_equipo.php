<?php
session_start();
include '../base_datos/seguridad.php';
include '../base_datos/conexion_biomedicina.php';

$id_equipo='';
if(isset($_REQUEST['id'])){
    $id_equipo=$_REQUEST['id'];
}

$carpetaDestino="..pdf/";


$sql = "SELECT ft_equipo.*, pr.nombre AS proveedor, te.descripcion AS tipo_equipo, m.descripcion AS marca,
ubi.descripcion AS ubicacion, cr.descripcion AS clasificacion, ti.descripcion AS tipo_ingreso, a.descripcion AS area FROM ft_equipo
LEFT JOIN proveedor AS pr ON pr.id_proveedor=ft_equipo.id_proveedor 
LEFT JOIN tipo_equipo AS te ON te.id_tipo=ft_equipo.id_tipo_equipo
LEFT JOIN marca AS m ON m.id_marca=ft_equipo.id_marca
LEFT JOIN ubicacion AS ubi ON ubi.id_ubicacion=ft_equipo.id_ubicacion
LEFT JOIN clasi_riesgo AS cr ON cr.id_clasificacion=ft_equipo.id_clasificacion
LEFT JOIN tipo_ingreso AS ti ON ti.id_ingreso=ft_equipo.id_tipo_ingreso
LEFT JOIN area AS a ON a.id_area=ubi.id_area
WHERE id_equipo = '$id_equipo'";

$query = mysqli_query($link, $sql) or die(mysqli_error($link));
$ficha = mysqli_fetch_array($query);

$sql3 = "SELECT count(id_registro) AS total FROM registros WHERE id_equipo='$id_equipo'"; 
$query3 = mysqli_query($link, $sql3) or die(mysqli_error($link));
$ficha3 = mysqli_fetch_array($query3);


$estado='';
if($ficha['id_estado']==1)
    $estado='Activo';
if ($ficha['id_estado']==2)
    $estado='Inactivo';
else 
    $estado='Retirado';


    $month= date("Y-m", strtotime($ficha['f_fabricacion'])); 

?>

<!DOCTYPE html>
<html lang="es">

<head>

<?php include '../enlaces/enlaces.php'; ?>
    <title> Editar Equipo </title>    
</head>

<body style="padding-bottom: 20px">
    <?php include '../navbar/navbar.php';     ?>
  
    <div class="container">
        <div class="titulos-crear">
            <a class="salida" href="../inicio.php">X</a>
            <h1><?php echo $ficha['tipo_equipo']; ?> </h1>
        </div>
        <div class="card bordecito">

        <form action="editar2_equipo.php" method="post" name="formulario" id="formulario">

        <div class="row informacion">

                <input type="hidden" name="id_equipo" value="<?php echo $id_equipo; ?>">
       
                <div class="form-group col-md-4">
                        <label class="descripcion">Tipo Equipo</label>
                        <select class="form-select" name="tipo_equipo">
                            <?php
                            $sql = "SELECT id_tipo, descripcion FROM tipo_equipo ORDER BY descripcion ASC";
                            $query = mysqli_query($link, $sql) or die("Error: " . mysqli_error($link));

                            while ($fila = mysqli_fetch_array($query)) { 
                                if($ficha['id_tipo_equipo']==$fila['id_tipo']) { ?>
                                <option value="<?php echo $fila['id_tipo']; ?>" selected><?php echo $fila['descripcion'] ?></option>
                            <?php } else { ?>
                                <option value="<?php echo $fila['id_tipo']; ?>"><?php echo $fila['descripcion'] ?></option>
                            <?php }} ?>

                        </select>
                </div> 

                <div class="form-group col-md-2">
                        <label class="descripcion">Modelo</label>
                        <input type="text" value="<?php echo $ficha['modelo'];?>" name="modelo" class="form-control" >
                </div>

                <div class="form-group col-md-2">
                        <label class="descripcion">Serie</label>
                        <input type="text" value="<?php echo $ficha['serie'];?>" name="serie" class="form-control" >
                </div>               

                <div class="form-group col-md-2">
                        <label class="descripcion">Activo Fijo</label>
                        <input type="text" value="<?php echo $ficha['activo_fijo'];?>" name="activo_fijo" class="form-control" >
                </div>
                  
                <div class="form-group col-md-2">
                        <label class="descripcion">Registro Invima</label>
                        <input type="text" value="<?php echo $ficha['registro_invima'];?>" name="invima" class="form-control" >
                </div>

                <div class="form-group col-md">
                        <label class="descripcion">Marca</label>
                        <select class="form-select" name="marca">
                            <?php
                            $sql = "SELECT * FROM marca ORDER BY descripcion ASC";
                            $query = mysqli_query($link, $sql) or die("Error: " . mysqli_error($link));

                            while ($fila = mysqli_fetch_array($query)) { 
                                if($ficha['id_marca']==$fila['id_marca']) { ?>
                                <option value="<?php echo $fila['id_marca']; ?>" selected><?php echo $fila['descripcion'] ?></option>
                            <?php } else { ?>
                                <option value="<?php echo $fila['id_marca']; ?>"><?php echo $fila['descripcion'] ?></option>
                            <?php }} ?>

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
                        <label class="descripcion">Ubicaci??n</label>
                        <select class="form-select" name="ubicacion" id="ubicacion">
                            <option>Seleccione...</option>
                            <?php
                            $sql = "SELECT * FROM ubicacion ORDER BY descripcion ASC";
                            $query = mysqli_query($link, $sql) or die("Error: " . mysqli_error($link));

                            while ($fila = mysqli_fetch_array($query)) { 
                                if($ficha['id_ubicacion']==$fila['id_ubicacion']) { ?>
                                <option value="<?php echo $fila['id_ubicacion']; ?>" selected><?php echo $fila['descripcion'] ?></option>
                            <?php }} ?>

                        </select>
                </div>

                <div class="form-group col-md-2">
                        <label class="descripcion">Tipo Ingreso</label>
                        <select class="form-select" name="tipo_ingreso">
                            <?php
                            $sql = "SELECT * FROM tipo_ingreso ORDER BY descripcion ASC";
                            $query = mysqli_query($link, $sql) or die("Error: " . mysqli_error($link));

                            while ($fila = mysqli_fetch_array($query)) { 
                                if($ficha['id_tipo_ingreso']==$fila['id_ingreso']) { ?>
                                <option value="<?php echo $fila['id_ingreso']; ?>" selected><?php echo $fila['descripcion'] ?></option>
                            <?php } else { ?>
                                <option value="<?php echo $fila['id_ingreso']; ?>"><?php echo $fila['descripcion'] ?></option>
                            <?php }} ?>

                        </select>
                </div>

                <div class="form-group col-md-2">
                        <label class="descripcion">Clasificaci??n Riesgo</label>
                        <select class="form-select" name="clasificacion">
                            <?php
                            $sql = "SELECT * FROM clasi_riesgo ORDER BY descripcion ASC";
                            $query = mysqli_query($link, $sql) or die("Error: " . mysqli_error($link));

                            while ($fila = mysqli_fetch_array($query)) { 
                                if($ficha['id_clasificacion']==$fila['id_clasificacion']) { ?>
                                <option value="<?php echo $fila['id_clasificacion']; ?>" selected><?php echo $fila['descripcion'] ?></option>
                            <?php } else { ?>
                                <option value="<?php echo $fila['id_clasificacion']; ?>"><?php echo $fila['descripcion'] ?></option>
                            <?php }} ?>

                        </select>
                </div>

                <div class="form-group col-md">
                        <label class="descripcion">Fecha Fabricaci??n</label>
                        <input type="month" value="<?php echo $month;?>" name="f_fabricacion" class="form-control">
                </div>   
                
                <div class="form-group col-md">
                        <label class="descripcion">Fecha Ingreso:</label>
                        <input type="date" value="<?php echo $ficha['f_ingreso']; ?>" name="f_ingreso" class="form-control">
                </div>                
              
                <div class="form-group col-md-3">
                        <label class="descripcion">Proveedor</label>
                        <select class="form-select" name="proveedor">
                            <?php
                            $sql = "SELECT * FROM proveedor ORDER BY nombre ASC";
                            $query = mysqli_query($link, $sql) or die("Error: " . mysqli_error($link));

                            while ($fila = mysqli_fetch_array($query)) { 
                                if($ficha['id_proveedor']==$fila['id_proveedor']) { ?>
                                <option value="<?php echo $fila['id_proveedor']; ?>" selected><?php echo $fila['nombre'] ?></option>
                            <?php } else { ?>
                                <option value="<?php echo $fila['id_proveedor']; ?>"><?php echo $fila['nombre'] ?></option>
                            <?php }} ?>

                        </select>
                </div>

                <div class="form-group col-md">    
                        <label class="descripcion" for="estado"> Estado </label>
                        <select class="form-select" name="estado">
                            <?php
                            if($ficha['id_estado']==1){?>
                                <option value="1" selected>Activo </option>
                                <option value="2">Inactivo</option>
                                <option value="3" > Retirado </option>
                        <?php } else
                            if($ficha['id_estado']==2) {?>                        
                                <option value="2" selected>Inactivo</option>  
                                <option value="1" > Activo </option>
                                <option value="3" > Retirado </option>

                        <?php } else { ?> 
                                <option value="3" selected> Retirado </option>
                                <option value="2" >Inactivo</option>  
                                <option value="1" > Activo </option>
                        <?php } ?>                
                         </select>
                    
                    </div> 
        </div>

        </form>

        <div class="card">
                <div class="row" style="margin-top:10px;">
                <div class="col-md-4"></div>
                    <div class="col-md-6">
                        <h2>Registro de Mantenimientos</h2>
                    </div>                  
                    <div class="col-md"><a title="Agregar Registro de Mantenimiento" data-toggle="modal" class="btn btn-sm" style="background-color: teal;color: white;font-size:16px" href='#agregar_registro'> <i class="fas fa-wrench" style=" font-size:25px;"></i> Agregar</a>
                    </div>                    
                    <small>
                        <table class="table table-bordered">
                            <thead style='color:black; background-color: lightgrey'>
                                <th class="text-center" >Id</th>
                                <th class="text-center" >Actividad</th>
                                <th class="text-center" >Descripci??n</th>
<!--                                 <th class="text-center" >Archivo</th>
 -->                                <th class="text-center" >Ver</th>  
                                <?php if ($perfil == 3 || $perfil == 2)  { ?>    
                                <th class="text-center" >Eliminar</th>                               
                                <?php } ?>
                            </thead>
                            <tbody>
                                <?php                               
                                $sql = "SELECT * FROM registros WHERE id_equipo='$id_equipo' ORDER BY id_registro DESC"; 
                                $query = mysqli_query($link, $sql) or die(mysqli_error($link));
                                while ($f = mysqli_fetch_array($query)){ ?>
                                <tr>
                                    <td class="orden-dato"><?php echo $f['id_registro'] ?></td>
                                    <td class="orden-dato"><?php echo $f['tipo_actividad'] ?></td>
                                    <td class="orden-dato"><?php echo $f['descripcion']; ?></td>  
<!--                                     <td class="orden-dato">< ?php echo $f['archivo']; ?></td>--> 
                                    <td class="text-center">
                                        <?php if($f['archivo']!=NULL) { ?> 
                                        <a title="Ver Documento" href="../pdf/<?php echo $f['archivo'];?>" target="_blank" >
                                            <i class="fa fa-file-pdf" style="color: slateblue;font-size:30px;"></i>
                                        </a>
                                        <?php } else { print "Sin archivo"; } ?>
                                    </td>
                                    <?php if ($perfil == 3 || $perfil == 2)  { ?>
                                    <td class="text-center">
                                        <a style="margin: 0;" title="Eliminar Producto"
                                            class="btn btn-danger btn-sm" onclick="ConfirmDelete(<?php echo $f['id_registro']?>,<?php echo $id_equipo ?>)">
                                            <i class="fas fa-trash-alt" style="color: white;"></i>
                                        </a>
                                    </td>
                                    <?php } ?>

                                </tr >
                                <?php } 
                                if($ficha3['total']>0) {?>                            
                                <tr>
                                    <td colspan="3" style="text-align: end;" ><h6><b> Total de Mantenimientos </b></h6></td>
                                    <td colspan="1"><h6><b><?php echo $ficha3['total'];?></b> </h6></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </small>
            </div>
        </div>

            <div class="col-md-12 text-center">
                <a href="javascript:void(document.forms.formulario.submit());" style="background-color: teal;color:white;" type="submit" class="btn">Guardar</a>
                <a type="button" href="../inicio.php" style="margin-top:10px;margin-bottom:10px;;color:white;background-color: slateblue;" class="btn">Volver Atr??s</a>
            </div>
        </div>

    </div>
</body>

</html>

<!---------------------------------------------------------------- INICIO MODAL AGREGAR REGISTRO ---------------------------------------------->
<div class="modal fade" id="agregar_registro" >

    <div class="modal-dialog">
        <div class="modal-content" >
            <div class="modal-header" style="background-color: gainsboro;">
                <h5 class="modal-title text-center w-100" id="exampleModalLabel">Agregar Mantenimiento</h5>

            </div>
            <div class="modal-body">
                <form class="row" action="crear_registro.php" method="POST" enctype="multipart/form-data">  

                    <input type="hidden" name="id_equipo" value="<?php echo $id_equipo; ?>">

                    <div class="form-group col-md-12">					
                    <label class="descripcion" for="estado">Actividad</label>
                        <select class="form-select" name="tipo_mantenimiento">
                        <option selected value="Ingreso">Ingreso</option>                 
                            <option value="Mantenimiento Correctivo">Mantenimiento Correctivo</option>                 
                            <option value="Mantenimiento Preventivo">Mantenimiento Preventivo </option>
                            <option value="Metrologia">Metrolog??a</option>
                        </select>                    
                    </div>                

                    <div class="form-group col-md-12">
                        <label class="descripcion" class="form-label" style="margin-top:5px;">Descripci??n </label>
                        <textarea name="descripcion" class="form-control" rows="4"></textarea>
                    </div>

                    
                    <div class="form-group col-md-12">
                        <label class="descripcion">Archivo</label>
                        <input type="file" name="archivo" class="form-control">
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Agregar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
                    </div>                    
                </form>
            </div>

        </div>
    </div>

</div>
<!----------------------------------------------------------------- FIN MODAL AGREGAR ----------------------------------------------->




<!------------------------------------------------------ ELIMINAR PRODUCTO -------------------------------------->
<script type="text/javascript">
  function ConfirmDelete(id_registro,id_equipo) {
    Swal.fire({
      title: '??Desea eliminar el registro?',
      icon: 'warning',
      showCancelButton: true,
      cancelButtonText: 'No',
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location = "eliminar_registro.php?id_registro="+id_registro+"&id_equipo="+id_equipo;
      } else {       
        swal.showInputError("error");
        return false;
      }
    })
  }
</script>
<!---------------------------------------------------------------------------------------------------------------->


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


