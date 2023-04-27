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
        $query = "BEGIN obtener_lugar_creacion(:param1); END;";
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

    //obtengo el producto
        $id = $_POST['id'];
        $curs = oci_new_cursor($conn);

        // Preparación de la consulta que llama al procedimiento almacenado
        $query = "BEGIN obtener_producto(:param1, :param2); END;";
        $stmt = oci_parse($conn, $query);

    
        oci_bind_by_name($stmt, ':param1', $curs, -1, OCI_B_CURSOR);
        oci_bind_by_name($stmt, ':param2', $id);

        // Execute the statement as in your first try
        oci_execute($stmt);

        oci_execute($curs); 

        $producto = array();
        
        while ($data = oci_fetch_assoc($curs )) {
            $producto = $data;
        }
        //echo '<pre>', var_dump($producto);die;
    //fin
?>

<div class="container">
    
    <p>HAY UN BUG DESPUES DE TOCAR EL BOTON DE GUARDAR, ERROR DE PHP</p>

    <form method="post" action="editar.php">
        <div class="form-group">
            <label for="TIPO_PERSONA">Seleccione un usuario</label>
            <select name="TIPO_PERSONA" id="TIPO_PERSONA" class="form-control" disabled>
                <?php foreach($personas as $k => $v):?>
                    <option value="<?php echo $v['ID']?>" data-descripcion="<?php echo $v['DESCRIPCION']?>"><?php echo $v['NOMBRE'] . ' ' . ' ' . $v['APELLIDOS'] . '(' . $v['DESCRIPCION'] . ')'?></option>
            <?php endforeach;?>
            </select>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Digite el nombre del producto</label>
            <input name="nombre" value="<?php echo $producto['NOMBRE']?>"  type="text" class="form-control" id="nombreInput" aria-describedby="emailHelp" placeholder="Coca Cola" >
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Digite algun detalle del producto</label>
            <input name="detalle" value="<?php echo $producto['DETALLE']?>" type="text" class="form-control" id="productoInput" aria-describedby="emailHelp" placeholder="Coca Cola" >
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Digite el precio</label>
            <input name="precio" value="<?php echo $producto['PRECIO']?>" type="number" class="form-control" id="precioInput" placeholder="200" >
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Digite el peso</label>
            <input name="peso" value="<?php echo $producto['PESO']?>" type="number" class="form-control" id="pesoInput" placeholder="30" >
        </div>

        <div class="form-group">
            <label for="id_marca">Seleccione una marca</label>
            <select name="id_marca" id="marca" class="form-control" >
                <?php foreach($marcas as $k => $v):?>
                    <option value="<?php echo $v['ID']?>"><?php echo $v['NOMBRE']?></option>
                <?php endforeach;?>
            </select>
        </div>

        <div class="form-group">
            <label for="id_lugar_creacion">Seleccione un lugar de creacion</label>
            <select name="id_lugar_creacion" id="lugar_creacion" class="form-control" >
                <?php foreach($lugar_creacion as $k => $v):?>
                    <option value="<?php echo $v['ID']?>"><?php echo $v['DIRECCION']?></option>
                <?php endforeach;?>
            </select>
        </div>
        <input type="text" name="id"  value="<?php echo $producto['ID']?>" hidden>
        <input type="submit" value="Guardar" class="btn btn-primary btn-lg">
    </form>
</div>    

<script>
    var persona = document.querySelector('#TIPO_PERSONA');
    persona.value = '<?php echo $producto['PERSONA_ID']?>';

    var marca = document.querySelector('#marca');
    marca.value = '<?php echo $producto['ID_MARCA']?>';

    lugar_creacion = document.querySelector('#lugar_creacion');
    lugar_creacion.value = '<?php echo $producto['ID_LUGAR_CREACION']?>';
</script>

<?php include_once('../footer.php')?>