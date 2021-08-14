<?php
session_start();
include '../base_datos/seguridad.php';
include '../base_datos/conexion_biomedicina.php';
?>



<!DOCTYPE html>
<html lang="es">

<head>
<link rel="stylesheet" href="../CSS/estilos.css">
<?php include '../enlaces/enlaces.php'; ?>
    <title> Áreas </title>

<!-- AJAX ----->

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

<!-------------------------->
</head>

<body style="margin-bottom: 20px;">
    <?php include '../navbar/navbar.php';?>
    <script>
        $(document).ready(function() {
            $('#example2').DataTable({
                "order": [
                    [1, "asc"]
                ]
            });
        });
    </script>
    <div class="container">
        <div class="titulos" >
            <h1>Áreas</h1>
        </div>

        <div class="row tipo">
                <div class="col-md-2">
                    <a data-toggle="modal" class="btn" href='#registro' style="background-color:teal;color:white;border-radius: 5px 15px 15px 15px"><i class="fas fa-plus-square" style="font-size: 25px;"></i> Agregar</a>  
                </div>
            </div>
                <?php 
                    $sql = "SELECT * FROM area";
                    $query = mysqli_query($link, $sql) or die(mysqli_error($link));
                ?>
        
        <div class="container">
            <table id="example2" class="table display table-bordered">
                <thead class="table-default" style=' background-color: lightsteelblue;'>
                    <th class="">Id</th>
                    <th class="">Proceso</th>
                    <?php if ($perfil == 3 || $perfil == 2)  { ?>
                    <th style="max-width: 35px;">Editar</th>
                    <th style="max-width: 50px;">Eliminar</th>
                    <?php } ?>                            
                </thead>
                <tbody>
                    <?php
                 
                    while ($f = mysqli_fetch_array($query)) { ?>
                        <tr>
                            <td class="orden-dato"><span><?php echo $f['id_area'] ?></span></td>
                            <td class="orden-dato"> <?php echo $f['descripcion'] ?> </td>
                                <?php if ($perfil == 3 || $perfil == 2)  { ?>                     
                            <td class="text-center"> <a href="javascript:void(0);" type="button"
                                onclick="cargar_ajax1('modal_ooo', 'modal_modificar_area.php?id=<?= $f['id_area'] ?>');" title="Modificar Proceso" 
                                data-toggle="modal" data-target="#modal_ooo"> <i class="fas fa-pen-square" style="color: slateblue; font-size:34px;"></i>
                            </td>                             
                            <td class="text-center">
                                        <a style="margin: 0;" title="Eliminar Producto"
                                            class="btn btn-danger btn-sm" onclick="ConfirmDelete(<?php echo $f['id_area'];?>)">
                                            <i class="fas fa-trash-alt" style="color: white;"></i>
                                        </a>
                            </td>
                            <?php } ?>

                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
</body>

</html>


<!------------------------------------------ MODAL EDITAR ------------------>
<div class="modal" id="modal_ooo" tabindex="1" data-dismiss="modal" role="dialog" aria-labelledby="myModalLabel">
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
 <!--------------------- FIN MODAL EDITAR------->

 <!---------------------------------------------------------------- INICIO MODAL CREAR ACTIVO FIJO ---------------------------------------------------------------->
<div class="modal fade" id="registro">

<div class="modal-dialog" style="margin-top: 9rem;">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Agregar Proceso</h5>
        </div>

            <form action="registar_area.php" method="post">
                <div class="modal-body">                                
                    <div class="form-group col-md-12">
                        <label for="" class="form-label" style="float:left;">Nombre del Proceso </label>
                        <input type="text" class="form-control" id="descripcion" name="descripcion">
                    </div> 
                </div>

                <div class="modal-footer">
                    <button type="submit" href="#" style="color:white;background-color: teal;" class="btn">Agregar</button>
                    <button type="button" class="btn" style="color:white;background-color: slateblue;" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
    </div>
</div>

</div>

<!------------------------------------------------------------ FIN MODAL CREAR ----------------------------------------------------->

<!----------------------------------------------------------- ELIMINAR PRODUCTO ------------------------------------------------>
<script type="text/javascript">
  function ConfirmDelete(id) {
    Swal.fire({
      title: '¿Eliminar Proceso?',
      icon: 'warning',
      showCancelButton: true,
      cancelButtonText: 'No',
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location = "eliminar_area.php?id="+id;
      } else {       
        swal.showInputError("error");
        return false;
      }
    })
  }
</script>
<!---------------------------------------------------------------------------------------------------------------->