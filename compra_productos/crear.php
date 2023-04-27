<?php 
    include_once('../conexionBD.php');

    $id_persona = $_POST['TIPO_PERSONA'];
    $id_producto = $_POST['producto'];
    $tipo_movimiento = 2;

    $query = "BEGIN insertar_movimiento(:id_producto, :tipo_movimiento, :id_persona); END;";
    $stmt = oci_parse($conn, $query);

    oci_bind_by_name($stmt, ':id_producto', $id_producto);
    oci_bind_by_name($stmt, ':tipo_movimiento', $tipo_movimiento);
    oci_bind_by_name($stmt, ':id_persona', $id_persona);
    // Ejecución de la consulta
    $resultado = oci_execute($stmt);
        
    // Verificación de errores en la ejecución de la consulta
    if (!$resultado) {
        $e = oci_error($stmt);
        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    }

    // se cierra la conexion
    oci_close($conn);

    header('Location: index.php');
    exit;
?>