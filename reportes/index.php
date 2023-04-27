<?php include_once('../header.php')?>
<?php include_once('../conexionBD.php')?>

<?php 
    //para obtener todas las personas
        $curs = oci_new_cursor($conn);

        // Preparación de la consulta que llama al procedimiento almacenado
        $query = "BEGIN obtener_lugares_agregan_mas_productos(:param1); END;";
        $stmt = oci_parse($conn, $query);


        oci_bind_by_name($stmt, ':param1', $curs, -1, OCI_B_CURSOR);

        // Execute the statement as in your first try
        oci_execute($stmt);

        oci_execute($curs); 

        $lugares = array();

        while ($data = oci_fetch_assoc($curs )) {
            $lugares[] = $data;
        }
    //fin

    //para obtener las marcas mas compradas
        $curs = oci_new_cursor($conn);

        // Preparación de la consulta que llama al procedimiento almacenado
        $query = "BEGIN obtener_marcas_mas_compradas(:param1); END;";
        $stmt = oci_parse($conn, $query);


        oci_bind_by_name($stmt, ':param1', $curs, -1, OCI_B_CURSOR);

        // Execute the statement as in your first try
        oci_execute($stmt);

        oci_execute($curs); 

        $marcas = array();

        while ($data = oci_fetch_assoc($curs )) {
            $marcas[] = $data;
        }
        //echo '<pre>', var_dump($marcas);die;
    //fin

     //para obtener el total de vendores y compradores
        $curs = oci_new_cursor($conn);

        // Preparación de la consulta que llama al procedimiento almacenado
        $query = "BEGIN obtener_cauntos_tipos_personas_hay(:param1); END;";
        $stmt = oci_parse($conn, $query);


        oci_bind_by_name($stmt, ':param1', $curs, -1, OCI_B_CURSOR);

        // Execute the statement as in your first try
        oci_execute($stmt);

        oci_execute($curs); 

        $personas = array();

        while ($data = oci_fetch_assoc($curs )) {
            $personas[] = $data;
        }
        //echo '<pre>', var_dump($personas);die;
    //fin

     //para obtener el total de tipo de movimiento
        $curs = oci_new_cursor($conn);

        // Preparación de la consulta que llama al procedimiento almacenado
        $query = "BEGIN obtener_cauntos_movimientos_hay(:param1); END;";
        $stmt = oci_parse($conn, $query);


        oci_bind_by_name($stmt, ':param1', $curs, -1, OCI_B_CURSOR);

        // Execute the statement as in your first try
        oci_execute($stmt);

        oci_execute($curs); 

        $movimientos = array();

        while ($data = oci_fetch_assoc($curs )) {
            $movimientos[] = $data;
        }
        //echo '<pre>', var_dump($movimientos);die;
    //fin

    //para obtener el total de tipo de movimiento
        $curs = oci_new_cursor($conn);

        // Preparación de la consulta que llama al procedimiento almacenado
        $query = "BEGIN obtener_total_generado_por_dia(:param1); END;";
        $stmt = oci_parse($conn, $query);


        oci_bind_by_name($stmt, ':param1', $curs, -1, OCI_B_CURSOR);

        // Execute the statement as in your first try
        oci_execute($stmt);

        oci_execute($curs); 

        $ganancias = array();

        while ($data = oci_fetch_assoc($curs )) {
            $ganancias[] = $data;
        }
        //echo '<pre>', var_dump($ganancias);die;
    //fin

    //para obtener el total de tipo de movimiento
        $curs = oci_new_cursor($conn);

        // Preparación de la consulta que llama al procedimiento almacenado
        $query = "BEGIN obtener_marcas_sin_productos(:param1); END;";
        $stmt = oci_parse($conn, $query);


        oci_bind_by_name($stmt, ':param1', $curs, -1, OCI_B_CURSOR);

        // Execute the statement as in your first try
        oci_execute($stmt);

        oci_execute($curs); 

        $marcas_sin_registrarse = array();

        while ($data = oci_fetch_assoc($curs )) {
            $marcas_sin_registrarse[] = $data;
        }
        //echo '<pre>', var_dump($ganancias);die;
    //fin

    // se cierra la conexion
    oci_close($conn);
?>


<div class="container">
    <div class="row">
        <div class="col-12">
            <h3>Los lugares que se agregan mas productos</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Direecion</th>
                        <th>Canton</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($lugares)):?>
                        <?php foreach($lugares as $k => $v):?>
                            <tr>
                                <th><?php echo $v['DIRECCION']?></th>
                                <th><?php echo $v['CANTON']?></th>
                                <th><?php echo $v['COUNT(1)']?></th>
                            </tr>
                        <?php endforeach;?>
                    <?php endif;?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h3>Las marcas mas compradas</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Marca</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($marcas)):?>
                        <?php foreach($marcas as $k => $v):?>
                            <tr>
                                <th><?php echo $v['NOMBRE']?></th>
                                <th><?php echo $v['COUNT(1)']?></th>
                            </tr>
                        <?php endforeach;?>
                    <?php endif;?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h3>Total de compradores y vendedores registrados</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Tipo persona</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($personas)):?>
                        <?php foreach($personas as $k => $v):?>
                            <tr>
                                <th><?php echo $v['DESCRIPCION']?></th>
                                <th><?php echo $v['COUNT(1)']?></th>
                            </tr>
                        <?php endforeach;?>
                    <?php endif;?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h3>Cual es el tipo movimiento mas realizado</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Tipo persona</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($movimientos)):?>
                        <?php foreach($movimientos as $k => $v):?>
                            <tr>
                                <th><?php echo $v['DESCRIPCION']?></th>
                                <th><?php echo $v['COUNT(1)']?></th>
                            </tr>
                        <?php endforeach;?>
                    <?php endif;?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h3>Total de dinero generado por dia</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Tipo persona</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($ganancias)):?>
                        <?php foreach($ganancias as $k => $v):?>
                            <tr>
                                <th><?php echo $v['DIA']?></th>
                                <th><?php echo $v['TOTAL']?></th>
                            </tr>
                        <?php endforeach;?>
                    <?php endif;?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h3>Marcas sin registrarse en un producto</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Marca</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($marcas_sin_registrarse)):?>
                        <?php foreach($marcas_sin_registrarse as $k => $v):?>
                            <tr>
                                <th><?php echo $v['NOMBRE']?></th>
                            </tr>
                        <?php endforeach;?>
                    <?php endif;?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include_once('../footer.php')?>