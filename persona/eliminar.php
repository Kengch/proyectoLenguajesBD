<?php 
    include_once('../conexionBD.php');

    $id = $_POST['id'];

    //verifica si el id existe si existe lo borra y si no no
    if(isset($id)){
        // llama al procedimiento almacenado
        $query = "BEGIN eliminar_persona(:param1); END;";
        $stmt = oci_parse($conn, $query);

        $param1 = $id;
        oci_bind_by_name($stmt, ':param1', $param1);

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