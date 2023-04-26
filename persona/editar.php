<?php 
    include_once('../conexionBD.php');

    //obtengo el id de la persona
    $id = $_POST['id'];
    //obtengo el nombre de la persona
    $nombre = $_POST['NOMBRE'];
    //obtengo los apellidos de la persona
    $apellidos = $_POST['APELLIDOS'];
    //obtengo el correo de la persona
    $correo = $_POST['CORREO'];
    //obtengo el tipo de persona de la persona
    $tipo_persona = $_POST['TIPO_PERSONA'];

    //verifica el tipo de persona, si es 23 es comprador y si es 24 es vendedor
    if($tipo_persona == '23'){
        $tipo_persona = 1;
    }
    else{
        $tipo_persona = 2;
    }
    
    //verifica si el id existe
    if(isset($id)){
        // llama al procedimiento almacenado
        $query = "BEGIN actualizar_persona(:id, :nombre, :apellidos, :correo, :tipo_persona); END;";
        $stmt = oci_parse($conn, $query);

        oci_bind_by_name($stmt, ':id', $id);
        oci_bind_by_name($stmt, ':nombre', $nombre);
        oci_bind_by_name($stmt, ':apellidos', $apellidos);
        oci_bind_by_name($stmt, ':correo', $correo);
        oci_bind_by_name($stmt, ':tipo_persona', $param1);

        // Ejecución de la consulta
        $resultado = oci_execute($stmt);
        
        // Verificación de errores en la ejecución de la consulta
        if (!$resultado) {
            $e = oci_error($stmt);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }
    }

    // se cierra la conexion
    oci_close($conn);

    header('Location: personaIndex.php');
    exit;
?>