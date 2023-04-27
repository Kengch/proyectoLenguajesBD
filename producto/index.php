<?php include_once('../header.php')?>
<?php include_once('../conexionBD.php')?>
<?php
     //para obtener todas las personas
        $curs = oci_new_cursor($conn);

        // Preparación de la consulta que llama al procedimiento almacenado
        $query = "BEGIN obtener_productos(:param1); END;";
        $stmt = oci_parse($conn, $query);

    
        oci_bind_by_name($stmt, ':param1', $curs, -1, OCI_B_CURSOR);

        // Execute the statement as in your first try
        oci_execute($stmt);

        oci_execute($curs); 

        $productos = array();
        
        while ($data = oci_fetch_assoc($curs )) {
            $productos[] = $data;
        }
    //fin

    // se cierra la conexion
    oci_close($conn);
?>


<div class=" mt-3 mb-3 mr-5 text-right">
    <div class="d-inline-block">
        <a class="btn btn-primary btn-lg" href="productoCrear.php">Agregar</a>
    </div>
</div>
<div class="">
    <div class="row">
        <div class="col-12">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Detalle</th>
                        <th scope="col">Marca</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Peso</th>
                        <th scope="col">Agregado por</th>
                        <th scope="col">Lugar de creacion</th>
                        <th scope="col">Fecha de creacion</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($productos)):?>
                        <?php foreach($productos as $k => $v):?>
                            <tr>
                                <th><?php echo $v['ID']?></th>
                                <th><?php echo $v['NOMBRE']?></th>
                                <th><?php echo $v['DETALLE']?></th>
                                <th><?php echo $v['MARCA']?></th>
                                <th><?php echo $v['PRECIO']?></th>
                                <th><?php echo $v['PESO']?> kg</th>
                                <th><?php echo $v['PERSONA']?></th>
                                <th><?php echo $v['LUGAR_CREACION']?></th>
                                <th><?php echo $v['FECHA_CREACION']?></th>
                                <th>
                                    <form method="post" action="productoEdit.php">
                                        <input type="hidden" name="id" value="<?php echo $v['ID']?>">
                                        <button type="submit" name="boton" class="btn btn-warning">Editar</button>
                                    </form>

                                    <form method="post" action="eliminar.php">
                                        <input type="hidden" name="id" value="<?php echo $v['ID']?>">
                                        <button type="submit" name="boton" class="btn btn-danger">Eliminar</button>
                                    </form>
                                </th>
                            </tr>
                        <?php endforeach;?>
                    <?php endif;?>
                </tbody>
            </table>
        </div>
    </div>        
</div>



<?php include_once('../footer.php')?>
