<?php include_once('../header.php')?>
<?php include_once('../conexionBD.php')?>

<?php
     //para obtener todas las personas
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

    //para obtener todos los productos
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
            <label for="producto">Seleccione un producto</label>
            <select name="producto" id="producto" class="form-control" >
                <?php foreach($productos as $k => $v):?>
                    <option value="<?php echo $v['ID']?>"><?php echo $v['NOMBRE']?></option>
                <?php endforeach;?>
            </select>
        </div>

        <input type="submit" value="Comprar" class="btn btn-primary btn-lg">
    </form>
</div>

<script>
    $('#TIPO_PERSONA').on('change', function () {
        if($(this).find(':selected').data('descripcion') == 'Comprador'){
            $('#producto').attr('disabled', false);
        }else{
            alert('solo los compradores pueden comprar productos');
            $('#producto').attr('disabled', true);
        }
    });
</script>

<?php include_once('../footer.php')?>