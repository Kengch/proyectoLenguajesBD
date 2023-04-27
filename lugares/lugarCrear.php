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

   
?>

<div class="container">
    <form method='post' action='crear.php'>
        <div class="form-group">
            <label for="TIPO_PERSONA">Seleccione un usuario</label>
            <select name="TIPO_PERSONA" id="TIPO_PERSONA" class="form-control">
                <?php foreach($personas as $k => $v):?>
                    <option value="<?php echo $v['ID']?>" data-descripcion="<?php echo $v['DESCRIPCION']?>"><?php echo $v['NOMBRE'] . ' ' . ' ' . $v['APELLIDOS'] . '(' . $v['DESCRIPCION'] . ')'?></option>
            <?php endforeach;?>
            </select>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Digite la direccion</label>
            <input type="text" name="direccion" class="form-control" id="direcicon" placeholder="Conpcecion de Alajuelita" disabled>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Digite el canton</label>
            <input type="text" name="canton" class="form-control" id="canton" placeholder="Alajuelita" disabled>
        </div>

        <input type="submit" value="Guardar" class="btn btn-primary btn-lg">
    </form>
</div>    

<script>
    $('#TIPO_PERSONA').on('change', function () {
        if($(this).find(':selected').data('descripcion') == 'Vendedor'){
            $('#direcicon').attr('disabled', false);
            $('#canton').attr('disabled', false);
        }else{
            alert('solo los vendedores pueden agregar lugares');
            $('#direcicon').attr('disabled', true);
            $('#canton').attr('disabled', true);
        }
    });
</script>

<?php include_once('../footer.php')?>