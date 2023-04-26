<?php include_once('../header.php')?>
<?php include_once('../conexionBD.php')?>

<?php 
    //obtengo el id de la persona
    $id = $_POST['id'];

    //obtengo la informacion de la persona
        $curs = oci_new_cursor($conn);

        // Preparación de la consulta que llama al procedimiento almacenado
        $query = "BEGIN obtener_persona(:param1, :param2); END;";
        $stmt = oci_parse($conn, $query);

    
        oci_bind_by_name($stmt, ':param1', $curs, -1, OCI_B_CURSOR);
        oci_bind_by_name($stmt, ':param2', $id);

        // Execute the statement as in your first try
        oci_execute($stmt);

        oci_execute($curs); 

        $persona = array();
        
        while ($data = oci_fetch_assoc($curs )) {
            $persona = $data;
        }
    //fin

    //obtengo los tipos de personas
        $curs = oci_new_cursor($conn);
        $query = "BEGIN obtener_tipo_personas(:param1); END;";
        $stmt = oci_parse($conn, $query);

        oci_bind_by_name($stmt, ':param1', $curs, -1, OCI_B_CURSOR);

        // Execute the statement as in your first try
        oci_execute($stmt);

        oci_execute($curs); 

        $tipo_personas = array();
        
        while ($data = oci_fetch_assoc($curs )) {
            $tipo_personas[] = $data;
        }
    //fin

    // se cierra la conexion
    oci_close($conn);
?>

<div class="container">
    <form method="post" action="editar.php">
        <div class="form-group">
            <label for="exampleInputEmail1">Digite su nombre</label>
            <input type="text" class="form-control" name="NOMBRE" value="<?php echo $persona['NOMBRE']?>">
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Digite su apellidos</label>
            <input type="text" class="form-control" name="APELLIDOS" value="<?php echo $persona['APELLIDOS']?>">
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Digite su correo</label>
            <input type="email" class="form-control" name="CORREO" value="<?php echo $persona['CORREO']?>">
        </div>

        <div class="form-group">
            <label for="TIPO_PERSONA">Tipo persona</label>
            <select name="TIPO_PERSONA" id="TIPO_PERSONA" class="form-control">
                <?php foreach($tipo_personas as $k => $v):?>
                    <option value="<?php echo $v['ID']?>"><?php echo $v['DESCRIPCION']?></option>
                <?php endforeach;?>
            </select>
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Cedula</label>
            <input type="number" class="form-control" id="cedulaInput" value="<?php echo $persona['CEDULA']?>" disabled>
        </div>

        <input type="text" name="id"  value="<?php echo $persona['ID']?>" hidden>

        <input type="submit" value="Guardar" class="btn btn-primary btn-lg">
    </form>
</div>    

<script>
    var opcion = document.querySelector('#TIPO_PERSONA');
    opcion.value = '<?php echo $persona['ID_TIPO']?>';
</script>

<?php include_once('../footer.php')?>