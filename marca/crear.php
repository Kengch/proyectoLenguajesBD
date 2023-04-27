<?php 
    include_once('../conexionBD.php');

    $nombre = $_POST['nombre'];

    if(!empty($nombre)){
        $query = "BEGIN insertar_marca(:nombre); END;";
        $stmt = oci_parse($conn, $query);
    
        oci_bind_by_name($stmt, ':nombre', $nombre);
    
        // Ejecución de la consulta
        $resultado = oci_execute($stmt);
            
        // Verificación de errores en la ejecución de la consulta
        if (!$resultado) {
            $e = oci_error($stmt);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }
    
        // se cierra la conexion
        oci_close($conn);
    }

    header('Location: marcaIndex.php');
    exit;
?>