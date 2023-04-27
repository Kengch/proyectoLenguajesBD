<?php include_once('../header.php')?>
<?php include_once('../conexionBD.php')?>
<?php
     //para obtener la lista de compras
        $curs = oci_new_cursor($conn);

        // Preparación de la consulta que llama al procedimiento almacenado
        $query = "BEGIN obtener_lista_compras(:param1); END;";
        $stmt = oci_parse($conn, $query);

    
        oci_bind_by_name($stmt, ':param1', $curs, -1, OCI_B_CURSOR);

        // Execute the statement as in your first try
        oci_execute($stmt);

        oci_execute($curs); 

        $compras = array();
        
        while ($data = oci_fetch_assoc($curs )) {
            $compras[] = $data;
        }
    //fin
    // se cierra la conexion
    oci_close($conn);
?>


<div class=" mt-3 mb-3 mr-5 text-right">
    <div class="d-inline-block">
        <a class="btn btn-primary btn-lg" href="productoCompra.php">Comprar</a>
    </div>
</div>
<div class="">
    <div class="row">
        <div class="col-12">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellidos</th>
                        <th scope="col">Cedula</th>
                        <th scope="col">Detalle</th>
                        <th scope="col">Marca</th>
                        <th scope="col">Comprado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($compras)):?>
                        <?php foreach($compras as $k => $v):?>
                            <tr>
                                <th><?php echo $v['DESCRIPCION']?></th>
                                <th><?php echo $v['NOMBRE_PERSONA']?></th>
                                <th><?php echo $v['APELLIDOS']?></th>
                                <th><?php echo $v['CEDULA']?></th>
                                <th><?php echo $v['DETALLE']?></th>
                                <th><?php echo $v['MARCA']?></th>
                                <th><?php echo $v['FECHA_CREACION']?></th>
                        <?php endforeach;?>
                    <?php endif;?>
                </tbody>
            </table>
        </div>
    </div>        
</div>



<?php include_once('../footer.php')?>
