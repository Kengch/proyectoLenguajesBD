<?php include_once('../header.php')?>
<?php include_once('../conexionBD.php')?>
<?php 
    //para obtener todos los movimientos
        $curs = oci_new_cursor($conn);

        // Preparación de la consulta que llama al procedimiento almacenado
        $query = "BEGIN obtener_movimientos(:param1); END;";
        $stmt = oci_parse($conn, $query);

    
        oci_bind_by_name($stmt, ':param1', $curs, -1, OCI_B_CURSOR);

        // Execute the statement as in your first try
        oci_execute($stmt);

        oci_execute($curs); 

        $movimientos = array();
        
        while ($data = oci_fetch_assoc($curs )) {
            $movimientos[] = $data;
        }
    //fin

    // se cierra la conexion
    oci_close($conn);
?>

<div class="">
    <div class="row">
        <div class="col-12">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Detalle</th>
                        <th scope="col">Realizado por</th>
                        <th scope="col">Fecha de creacion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($movimientos)):?>
                        <?php foreach($movimientos as $k => $v):?>
                            <tr>
                                <th><?php echo $v['ID']?></th>
                                <th><?php echo $v['DESCRIPCION']?></th>
                                <th><?php echo $v['NOMBRE']?></th>
                                <th><?php echo $v['FECHA_CREACION']?></th>
                            </tr>
                        <?php endforeach;?>
                    <?php endif;?>
                </tbody>
            </table>
        </div>
    </div>        
</div>




<?php include_once('../footer.php')?>