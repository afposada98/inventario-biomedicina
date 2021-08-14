<?php

include '../base_datos/conexion_biomedicina.php';

$id = $_REQUEST['id'];

$sql = "SELECT * FROM marca WHERE id_marca = '$id'";

$query = mysqli_query($link, $sql) or die(mysqli_error($link));
$ficha = mysqli_fetch_array($query);
 

?>

<div class="card mx-auto" style="width: 35rem; text-align:center; margin-top:12em;border-radius: 10px;">
 <h5 class="card-header">Modificar Marca</h5>
    <h5 class="card-title" style="padding: 10px;"><?=$ficha['descripcion'];?></h5> 
    <form action="editar_marca.php" method="POST" class="form-group">
        <div class="card-body">

            <input type="hidden" name="id" value="<?=$id?>" id="">

            <div class="form-group col-md-12">
                        <label for="" class="form-label" style="float:left;">Marca</label>
                        <input type="text" class="form-control" id="descripcion" value="<?php echo $ficha['descripcion'];?>" name="descripcion">
            </div> 
            </div>

            <div class="modal-footer">
                    <button type="submit" href="#" style="color:white;background-color:teal;margin-bottom: -15px;" class="btn">Guardar</button>
                    <button type="button" class="btn" style="color:white;background-color: slateblue;margin-bottom: -15px;" data-dismiss="modal">Cancelar</button>
            </div>
    </form>    

  </div>

</div>