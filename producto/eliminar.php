<?php 
    include_once('../conexionBD.php');

    $id = $_POST['id'];

    if(!empty($id)){
        $query = "BEGIN eliminar_producto(:id); END;";
        $stmt = oci_parse($conn, $query);
    
        oci_bind_by_name($stmt, ':id', $id);
    
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
    
    header('Location: index.php');
    exit;

?>