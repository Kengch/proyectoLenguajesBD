<?php include_once('../header.php')?>
<?php include_once('../conexionBD.php')?>

<?php 
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
    <form method='post' action='crear.php'>
        <div class="form-group">
            <label for="exampleInputEmail1">Digite su nombre</label>
            <input type="text" name='nombre' class="form-control" id="nombreInput" aria-describedby="emailHelp" placeholder="Keng">
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Digite sus apellidos</label>
            <input type="text" name='apellidos' class="form-control" id="apellidoInput" placeholder="Chang Salas">
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Digite su correo</label>
            <input type="email" name='correo' class="form-control" id="correoInput" placeholder="keng@gmail.com">
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Digite su cedula</label>
            <input type="number" name='cedula' class="form-control" id="cedulaInput" placeholder="12345678">
        </div>

        <div class="form-group">
            <label for="TIPO_PERSONA">Tipo persona</label>
            <select name="TIPO_PERSONA" id="TIPO_PERSONA" class="form-control">
                <?php foreach($tipo_personas as $k => $v):?>
                    <option value="<?php echo $v['ID']?>"><?php echo $v['DESCRIPCION']?></option>
                <?php endforeach;?>
            </select>
        </div>

        <input type="submit" value="Guardar" class="btn btn-primary btn-lg">
    </form>
</div>    

<?php include_once('../footer.php')?>