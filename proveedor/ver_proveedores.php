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
    <title> Proveedores </title>

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
            <h1>Proveedores</h1>
        </div>

        <div class="row tipo">
                <div class="col-md-2">
                    <a data-toggle="modal" class="btn" href='#registro' style="background-color:teal;color:white;border-radius: 5px 15px 15px 15px"><i class="fas fa-plus-square" style="font-size: 25px;"></i> Agregar</a>  
                </div>
            </div>
                <?php 
                    $sql = "SELECT * FROM proveedor";
                    $query = mysqli_query($link, $sql) or die(mysqli_error($link));
                ?>
        
        <div class="container">
            <table id="example2" class="table display table-bordered">
                <thead class="table-default" style=' background-color: lightsteelblue;'>
                    <th class="">Id</th>
                    <th class="">Proveedor</th>
                    <th class="">Teléfono</th>
                    <th class="">Correo</th>
                    <?php if ($perfil == 3 || $perfil == 2)  { ?>
                    <th style="max-width: 35px;">Editar</th>
                    <th style="max-width: 50px;">Eliminar</th>
                    <?php } ?>                            
                </thead>
                <tbody>
                    <?php
                 
                    while ($f = mysqli_fetch_array($query)) { ?>
                        <tr>
                            <td class="orden-dato"><span><?php echo $f['id_proveedor'] ?></span></td>
                            <td class="orden-dato"> <?php echo $f['nombre'] ?> </td>
                            <td class="orden-dato"> <?php echo $f['telefono'] ?> </td>
                            <td class="orden-dato"> <?php echo $f['correo'] ?> </td>
                                <?php if ($perfil == 3 || $perfil == 2)  { ?>                     
                            <td class="text-center"> <a href="javascript:void(0);" type="button"
                                onclick="cargar_ajax1('modal_ooo', 'modal_modificar_proveedor.php?id=<?= $f['id_proveedor'] ?>');" title="Modificar Marca" 
                                data-toggle="modal" data-target="#modal_ooo"> <i class="fas fa-pen-square" style="color: slateblue; font-size:34px;"></i>
                            </td>                             
                            <td class="text-center">
                                        <a style="margin: 0;" title="Eliminar Proveedor"
                                            class="btn btn-danger btn-sm" onclick="ConfirmDelete(<?php echo $f['id_proveedor'];?>)">
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

 <!---------------------------------------------------------------- INICIO MODAL CREAR ---------------------------------------------------------------->
<div class="modal fade" id="registro">

<div class="modal-dialog" style="margin-top: 9rem;">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Agregar Proveedor </h5>
        </div>

            <form action="registrar_proveedor.php" method="post">
                <div class="modal-body">
                    <div class="row">
                    <div class="form-group col-md-12">
                        <label class="descripcion">Nombre del proveedor</label>
                        <input type="text" class="form-control" id="descripcion" name="descripcion" maxlength="50" required>
                    </div> 
                    
                    <div class="form-group col-md-4">
                        <label class="descripcion">Teléfono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono">
                    </div> 
                    
                    <div class="form-group col-md-8">
                        <label class="descripcion">Correo</label>
                        <input type="email" class="form-control" id="correo" name="correo" maxlength="35">
                    </div> 
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

<!----------------------------------------------------------- ELIMINAR ------------------------------------------------>
<script type="text/javascript">
  function ConfirmDelete(id) {
    Swal.fire({
      title: '¿Eliminar Proveedor?',
      icon: 'warning',
      showCancelButton: true,
      cancelButtonText: 'No',
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location = "eliminar_proveedor.php?id="+id;
      } else {       
        swal.showInputError("error");
        return false;
      }
    })
  }
</script>
<!---------------------------------------------------------------------------------------------------------------->