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

    // se cierra la conexion
    oci_close($conn);
?>

<div class="container mb-2">
    <h6>Para obtener esta lista se esta usando un procedimiento almacenado y dos inner joins</h6>
    select p.id, p.nombre, p.apellidos,p.correo, p.cedula, tp.descripcion, p.fecha_creacion
    <br>
    from persona p
    <br>
    inner join persona_tipo_persona ptp on p.id = ptp.id_persona
    <br>
    inner join tipo_persona tp on tp.id = ptp.id_tipo_persona;   
</div>

<div class=" mt-3 mb-3 mr-5 text-right">
    <div class="d-inline-block">
        <a class="btn btn-primary btn-lg" href="personaCrear.php">Agregar</a>
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
                        <th scope="col">Apellidos</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Cedula</th>
                        <th scope="col">Tipo persona</th>
                        <th scope="col">Fecha de creacion</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($personas)):?>
                        <?php foreach($personas as $k => $v):?>
                            <tr>
                                <th><?php echo $v['ID']?></th>
                                <th><?php echo $v['NOMBRE']?></th>
                                <th><?php echo $v['APELLIDOS']?></th>
                                <th><?php echo $v['CORREO']?></th>
                                <th><?php echo $v['CEDULA']?></th>
                                <th><?php echo $v['DESCRIPCION']?></th>
                                <th><?php echo $v['FECHA_CREACION']?></th>
                                <th>
                                    <form method="post" action="personaEdit.php">
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