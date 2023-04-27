<?php include_once('../header.php')?>
<?php include_once('../conexionBD.php')?>

<?php 
    //obtengo las personas
        $curs = oci_new_cursor($conn);

        // Preparación de la consulta que llama al procedimiento almacenado
        $query = "BEGIN obtener_personas(:param1); END;";
        $stmt = oci_parse($conn, $query);

    
        oci_bind_by_name($stmt, ':param1', $curs, -1, OCI_B_CURSOR);

        // Execute the statement as in your first try
        oci_execute($stmt);

        oci_execute($curs); 

        $personas = array();
        
        while ($data = oci_fetch_assoc($curs )) {
            $personas[] = $data;
        }
    //fin

    //obtengo las marcass
        $curs = oci_new_cursor($conn);

        // Preparación de la consulta que llama al procedimiento almacenado
        $query = "BEGIN obtener_marcas(:param1); END;";
        $stmt = oci_parse($conn, $query);


        oci_bind_by_name($stmt, ':param1', $curs, -1, OCI_B_CURSOR);

        // Execute the statement as in your first try
        oci_execute($stmt);

        oci_execute($curs); 

        $marcas = array();
        
        while ($data = oci_fetch_assoc($curs )) {
            $marcas[] = $data;
        }
    //fin

    //obtengo los lugares de creacion
        $curs = oci_new_cursor($conn);

        // Preparación de la consulta que llama al procedimiento almacenado
        $query = "BEGIN obtener_lugares_creacion(:param1); END;";
        $stmt = oci_parse($conn, $query);


        oci_bind_by_name($stmt, ':param1', $curs, -1, OCI_B_CURSOR);

        // Execute the statement as in your first try
        oci_execute($stmt);

        oci_execute($curs); 

        $lugar_creacion = array();
        
        while ($data = oci_fetch_assoc($curs )) {
            $lugar_creacion[] = $data;
        }
    //fin
?>

<div class="container">
    

    <form method="post" action="crear.php">
        <div class="form-group">
            <label for="TIPO_PERSONA">Seleccione un usuario</label>
            <select name="TIPO_PERSONA" id="TIPO_PERSONA" class="form-control">
                <?php foreach($personas as $k => $v):?>
                    <option value="<?php echo $v['ID']?>" data-descripcion="<?php echo $v['DESCRIPCION']?>"><?php echo $v['NOMBRE'] . ' ' . ' ' . $v['APELLIDOS'] . '(' . $v['DESCRIPCION'] . ')'?></option>
            <?php endforeach;?>
            </select>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Digite el nombre del producto</label>
            <input name="nombre" type="text" class="form-control" id="nombreInput" aria-describedby="emailHelp" placeholder="Coca Cola" disabled>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Digite algun detalle del producto</label>
            <input name="detalle" type="text" class="form-control" id="productoInput" aria-describedby="emailHelp" placeholder="Coca Cola" disabled>
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Digite el precio</label>
            <input name="precio" type="number" class="form-control" id="precioInput" placeholder="200" disabled>
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Digite el peso</label>
            <input name="peso" type="number" class="form-control" id="pesoInput" placeholder="30" disabled>
        </div>

        <div class="form-group">
            <label for="id_marca">Seleccione una marca</label>
            <select name="id_marca" id="marca" class="form-control" disabled>
                <?php foreach($marcas as $k => $v):?>
                    <option value="<?php echo $v['ID']?>"><?php echo $v['NOMBRE']?></option>
                <?php endforeach;?>
            </select>
        </div>

        <div class="form-group">
            <label for="id_lugar_creacion">Seleccione un lugar de creacion</label>
            <select name="id_lugar_creacion" id="lugar_creacion" class="form-control" disabled>
                <?php foreach($lugar_creacion as $k => $v):?>
                    <option value="<?php echo $v['ID']?>"><?php echo $v['DIRECCION']?></option>
                <?php endforeach;?>
            </select>
        </div>

        <input type="submit" value="Guardar" class="btn btn-primary btn-lg">
    </form>
</div>    

<script>
    $('#TIPO_PERSONA').on('change', function () {
        if($(this).find(':selected').data('descripcion') == 'Vendedor'){
            $('#nombreInput').attr('disabled', false);
            $('#productoInput').attr('disabled', false);
            $('#precioInput').attr('disabled', false);
            $('#pesoInput').attr('disabled', false);
            $('#marca').attr('disabled', false);
            $('#lugar_creacion').attr('disabled', false);
        }else{
            alert('solo los vendedores pueden agregar productos');
            $('#nombreInput').attr('disabled', true);
            $('#productoInput').attr('disabled', true);
            $('#precioInput').attr('disabled', true);
            $('#pesoInput').attr('disabled', true);
            $('#marca').attr('disabled', true);
            $('#lugar_creacion').attr('disabled', true);
        }
    });
</script>

<?php include_once('../footer.php')?>