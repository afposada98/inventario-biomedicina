<?php
session_start();
include './base_datos/seguridad.php';
include './base_datos/conexion_biomedicina.php';

$estados = 1;
if(isset($_REQUEST['estados'])){
    $estados = $_REQUEST['estados'];
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
<link rel="stylesheet" href="./CSS/estilos.css">

<script type="text/javascript"> (function() { var css = document.createElement("link"); css.href = "https://use.fontawesome.com/releases/v5.1.0/css/all.css"; css.rel = "stylesheet"; css.type = "text/css"; document.getElementsByTagName("head")[0].appendChild(css); })(); </script>

<?php include './enlaces/enlaces.php'; ?>
    <title> Equipos Biomédicos </title>
</head>

<body style="margin-bottom: 20px;">
    <?php include './navbar/navbar.php';?>
    <script>
        $(document).ready(function() {
            $('#example2').DataTable({
                "order": [
                    [0, "desc"]
                ]
            });
        });
    </script>
    <div class="container">
        <div class="titulos" >
            <h1>Equipos Biomédicos</h1>
        </div>

        <div class="row tipo">
                <div class="col-md-2">
                    <a class="btn" style="background-color:teal;color:white;border-radius: 5px 15px 15px 15px" title="Agregar Equipo"
                     href="./equipos/crear_equipo.php"><i class="fas fa-plus-square" style="font-size: 25px;"></i> Agregar </a>
                     
                </div>
                <div class="col-md-10" style="text-align: right;">
                    <div style="display: inline-block; margin:0.3em;">
                        <label for="">Activos</label>

                        <?php if ($estados == 1) { ?>

                            <input value='1' checked type="radio" aria-label="Radio button for following text input">

                        <?php } else { ?>

                            <input  value='1' onclick="validar(1)" type="radio" aria-label="Radio button for following text input">

                        <?php } ?>
                    </div>
                    <div style="display: inline-block; margin:0.3em;">
                        <label for="">Inactivos</label>

                        <?php if ($estados == 2) { ?>

                            <input  value='2' checked type="radio" aria-label="Radio button for following text input">

                        <?php } else { ?>

                            <input  value='2' onclick="validar(2)" type="radio" aria-label="Radio button for following text input">

                        <?php } ?>
                    </div>

                    <div style="display: inline-block; margin:0.3em;">
                        <label for="">Retirados</label>

                        <?php if ($estados == 3) { ?>

                            <input  checked type="radio" aria-label="Radio button for following text input">

                        <?php } else { ?>

                            <input value="3"  onclick="validar(3)" type="radio" aria-label="Radio button for following text input">

                        <?php } ?>
                    </div>

                    <div style="display: inline-block; margin:0.3em;">
                        <label for="">Todos</label>

                        <?php if ($estados == 4) { ?>

                            <input checked type="radio" aria-label="Radio button for following text input">

                        <?php } else { ?>

                            <input value='4' onclick="validar(4)" type="radio" aria-label="Radio button for following text input">

                        <?php } ?>
                    </div>                    

                </div>
            </div>
                <?php 
                   $sql = "SELECT  equi.*,  ubi.descripcion AS ubicacion, marca.descripcion AS marca,
                   te.descripcion AS tipo_equipo FROM ft_equipo AS equi LEFT JOIN
                   ubicacion AS ubi ON equi.id_ubicacion = ubi.id_ubicacion LEFT JOIN
                   area ON area.id_area = ubi.id_area LEFT JOIN
                   marca ON marca.id_marca = equi.id_marca LEFT JOIN
                   tipo_equipo AS te ON te.id_tipo = equi.id_tipo_equipo";

               switch($estados) {
                        case 4:
                            // todos
                            break;
                        case 2:
                                // inactivos
                            $sql = $sql . " WHERE equi.id_estado = '2'";
                            break;
                        case 1;
                            // activos
                            $sql = $sql . " WHERE equi.id_estado = '1'";
                            break;
                       
                        case 3;
                            // retirados
                            $sql = $sql . " WHERE equi.id_estado = '3'";
                            break;
                    }

                $query = mysqli_query($link, $sql) or die(mysqli_error($link));
                ?>
        
        <div class="container">
            <table id="example2" class="table display table-bordered"  cellpadding='0' $().DataTable();. style="width: 100%;">
                <thead class="table-default" style=' background-color: lightsteelblue;'>
                    <th class="text-center">Id</th>
                    <th class="text-center">Tipo Equipo</th>
                    <th class="text-center">Marca</th>
                    <th class="text-center">Modelo</th>
                    <th class="text-center">Serie</th>
                    <th class="text-center">Activo FIjo</th>
                    <th class="text-center">Ubicación</th>
                    <th class="text-center">Estado</th>
                    <th class="text-center" style="width: 90px;">Opciones</th>                   
                </thead>
                <tbody>
                    <?php
                 
                    while ($f = mysqli_fetch_array($query)) { ?>
                        <tr>
                            <td class="orden-dato"><span><?php echo $f['id_equipo'] ?></span></td>
                            <td class="orden-dato"> <?php echo $f['tipo_equipo'] ?> </td>
                            <td class="orden-dato"><?php echo $f['marca'] ?></td>
                            <td class="orden-dato"> <?php echo $f['modelo'] ?></td>
                            <td class="orden-dato"><?php echo $f['serie'] ?></td>
                            <td class="orden-dato"><?php echo $f['activo_fijo'] ?></td>
                            <td class="orden-dato"><?php echo $f['ubicacion'] ?></td>

                            <td class="text-center">
                                <?php if ($f['id_estado'] == 1) {?>
                                                    <i  class="fas fa-power-off" style="color:white;background-color:#0f7e55;font-size:15px;padding:8px;border-radius:20px"></i>
                                                    <?php   } else 
                                      if($f['id_estado']== 2) { ?>
                                                        <i  class="fas fa-power-off" style="color:white;background-color:gray;font-size:15px;padding:8px;border-radius:50%"></i>
                                                    <?php } else { ?>
                                                        <i  class="fas fa-times-circle" style="color:white;background-color:#e31f11;font-size:15px;padding:8px;border-radius:50%"></i>
                                                    <?php } ?>
                            </td>
                            <td class="text-center">
                                    <a class="btn btn-secondary btn-sm" title="Ver Ficha Técnica" type="button" href="equipos/ficha_tecnica_equipo.php?id=<?php echo $f['id_equipo'] ?>" style="border-radius:8px 3px;"><i class="fas fa-search"></i></a>                               
                                    <?php if ($perfil == 3 || $perfil == 2)  { ?>
                                    <a class="btn btn-sm" title="Modificar Ficha Técnica" type="button" href="equipos/editar_equipo.php?id=<?php echo $f['id_equipo'] ?>" style="border-radius:8px 3px;background-color: slateblue;color:white;"><i class="fas fa-edit"></i></a>
                                    <a style="margin: 0;" title="Eliminar Equipo"
                                            class="btn btn-danger btn-sm" onclick="ConfirmDelete(<?php echo $f['id_equipo'];?>)">
                                            <i class="fas fa-trash-alt" style="color: white;"></i>
                                    </a>
                                    <?php } else { ?>
                                    <a class="btn btn-sm" title="Modificar Ficha Técnica" type="button" href="equipos/editar_equipo_practicante.php?id=<?php echo $f['id_equipo'] ?>" style="border-radius:8px 3px;background-color: slateblue;color:white;"><i class="fas fa-edit"></i></a>
                                    <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
</body>

</html>

<script type="text/javascript">
    function cargar_ajax1(div, url) {

        $.post(
            url,
            function(resp) {
                $("#" + div + "").html(resp);
            }
        );
    }
</script>


<!-- Inicio Modal Actualizar Localizacion -->
<div class="modal fade" id="modal_ooo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"> ... </h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
            </div>
        </div>
    </div>
</div>
<!-- Fin Modal Actuaizar Localizacion -->

<script>
function validar(estados){
    window.location = "inicio.php?estados="+estados;
}
</script>


<!----------------------------------------------------------- ELIMINAR PRODUCTO ------------------------------------------------>
<script type="text/javascript">
  function ConfirmDelete(id) {
    Swal.fire({
      title: '¿Eliminar Equipo?',
      icon: 'warning',
      showCancelButton: true,
      cancelButtonText: 'No',
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location = "equipos/eliminar_equipo.php?id="+id;
      } else {       
        swal.showInputError("error");
        return false;
      }
    })
  }
</script>
<!---------------------------------------------------------------------------------------------------------------->