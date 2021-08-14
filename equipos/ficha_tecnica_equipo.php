<?php
session_start();
include '../base_datos/seguridad.php';
include '../base_datos/conexion_biomedicina.php';

$id_equipo='';
if(isset($_REQUEST['id'])){
    $id_equipo=$_REQUEST['id'];
}

$sql = "SELECT ft_equipo.*, pr.nombre AS proveedor, te.descripcion AS tipo_equipo, m.descripcion AS marca,
ubi.descripcion AS ubicacion, cr.descripcion AS clasificacion, ti.descripcion AS tipo_ingreso, a.descripcion AS area, esta.descripcion AS estado
FROM ft_equipo
LEFT JOIN estado AS esta ON esta.id_estado=ft_equipo.id_estado
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
    <title> Detalle Equipo </title>    
</head>

<body style="padding-bottom: 20px">
    <?php include '../navbar/navbar.php';     ?>
  
    <div class="container">
        <div class="titulos-crear">
            <a class="salida" href="../inicio.php">X</a>
            <h1><?php echo $ficha['tipo_equipo']; ?> </h1>
        </div>
        <div class="card bordecito">

        <form action="editar2_factura.php" method="post" name="formulario" id="formulario">

        <div class="row informacion">
       
                <div class="form-group col-md-4">
                        <label class="descripcion">Tipo Equipo</label>
                        <input type="text" value="<?php echo $ficha['tipo_equipo']; ?>" name="tipo" class="form-control" readonly>
                </div>

                <div class="form-group col-md-2">
                        <label class="descripcion">Modelo</label>
                        <input type="text" value="<?php echo $ficha['modelo'];?>" name="modelo" class="form-control" readonly>
                </div>

                <div class="form-group col-md-2">
                        <label class="descripcion">Serie</label>
                        <input type="text" value="<?php echo $ficha['serie'];?>" name="serie" class="form-control" readonly>
                </div>               

                <div class="form-group col-md-2">
                        <label class="descripcion">Activo Fijo</label>
                        <input type="text" value="<?php echo $ficha['activo_fijo'];?>" name="activo_fijo" class="form-control" readonly>
                </div>
                  
                <div class="form-group col-md-2">
                        <label class="descripcion">Registro Invima</label>
                        <input type="text" value="<?php echo $ficha['registro_invima'];?>" name="invima" class="form-control" readonly>
                </div>

                <div class="form-group col-md-2">
                        <label class="descripcion">Marca</label>
                        <input type="text" value="<?php echo $ficha['marca'];?>" name="marca" class="form-control" readonly>
                </div>

                <div class="form-group col-md-4">
                        <label class="descripcion">Área</label>
                        <input type="text" value="<?php echo $ficha['area'];?>" name="are" class="form-control" readonly>
                </div>

                <div class="form-group col-md-4">
                        <label class="descripcion">Ubicación</label>
                        <input type="text" value="<?php echo $ficha['ubicacion'];?>" name="ubicacion" class="form-control" readonly>
                </div>

                <div class="form-group col-md-2">
                        <label class="descripcion">Tipo Ingreso</label>
                        <input type="text" value="<?php echo $ficha['tipo_ingreso'];?>" name="tipo_ingreso" class="form-control" readonly>
                </div>

                <div class="form-group col-md">
                        <label class="descripcion">Clasificación Riesgo</label>
                        <input type="text" value="<?php echo $ficha['clasificacion'];?>" name="clasificacion" class="form-control" readonly>
                </div>

                <div class="form-group col-md-auto">
                        <label class="descripcion">Fecha Fabricación</label>
                        <input type="month" value="<?php echo $month; ?>" name="f_fabricacion" class="form-control" readonly>
                </div>   
                
                <div class="form-group col-auto">
                        <label class="descripcion">Fecha Ingreso</label>
                        <input type="date" value="<?php echo $ficha['f_ingreso']; ?>" name="f_ingreso" class="form-control" readonly>
                </div>
                
                <div class="form-group col-md-3">
                        <label class="descripcion">Proveedor</label>
                        <input type="text" value="<?php echo $ficha['proveedor'];?>" name="proveedor" class="form-control" readonly>
                </div>

                <div class="form-group col-2">
                        <label class="descripcion">Estado</label>
                        <input type="text" value="<?php echo $ficha['estado']; ?>" name="estado" class="form-control" readonly>
                </div>
        </div>

        </form>

        
        <div class="card">
                <div class="row" style="margin-top:5px;">
                <div class="text-center">           
                    <h2>Registro de Actividades</h2>
                </div>
                    <small>
                        <table id="" class="table table-striped table-bordered">
                            <thead style='color:black; background-color: lightgrey'>
                                <th class="text-center" >Id Registro</th>
                                <th class="text-center" >Actividad</th>
                                <th class="text-center" >Descripción</th>
                                <th class="text-center" >Archivo</th>
                                <th class="text-center" >Ver</th>                                                              
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
                                    <td class="orden-dato"><?php echo $f['archivo']; ?></td>
                                    <td class="text-center">
                                        <?php if($f['archivo']!=NULL) { ?> 
                                        <a href="../pdf/<?php echo $f['archivo'];?>" target="_blank" >
                                            <i class="fa fa-file-pdf" style="vertical-align: middle;color: slateblue;font-size:26px;margin: -6px"></i>
                                        </a>
                                        <?php } else { print "Sin archivo"; } ?>

                                    </td>
                                </tr >
                                <?php } 
                                if($ficha3['total']>0) {
                                ?>                            
                                <tr>
                                    <td colspan="3" style="text-align: end;" ><h6><b> Total de Mantenimientos </b></h6></td>
                                    <td colspan="2"><h6><b><?php echo $ficha3['total'];?></b> </h6></td>
                                </tr>

                                <?php } ?>
                            </tbody>
                        </table>
</small>
            </div>
        </div>

            <div class="col-md-12 text-center">
                <a type="button" href="../inicio.php" style="margin-top:10px;margin-bottom:10px;background-color: slateblue;color:white;" class="btn">Volver Atrás</a>
            </div>
        </div>

    </div>
</body>

</html>
