<?php 
    include_once('../conexionBD.php');

    $direccion = $_POST['direccion'];
    $canton = $_POST['canton'];

    if(!empty($direccioin) && !empty($canton)){
        $query = "BEGIN insertar_lugar_creacion(:direccion, :canton); END;";
        $stmt = oci_parse($conn, $query);
    
        oci_bind_by_name($stmt, ':direccion', $direccion);
        oci_bind_by_name($stmt, ':canton', $canton);
    
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
    

    header('Location: lugaresIndex.php');
    exit;
?>