<?php 
    include_once('../conexionBD.php');

    $id_persona = $_POST['TIPO_PERSONA'];
    $nombre = $_POST['nombre'];
    $detalle = $_POST['detalle'];
    $precio = $_POST['precio'];
    $peso = $_POST['peso'];
    $id_marca = $_POST['id_marca'];
    $id_lugar_creacion = $_POST['id_lugar_creacion'];
    $tipo_movimiento = 1;

    if(!empty($id_persona) && !empty($nombre) && !empty($detalle) && !empty($precio) && !empty($peso) && !empty($id_marca) && !empty($id_lugar_creacion)){
        $query = "BEGIN insertar_producto(:detalle, :id_marca, :id_lugar_creacion ,:nombre, :precio, :peso, :tipo_movimiento, :id_persona); END;";
        $stmt = oci_parse($conn, $query);
    
        oci_bind_by_name($stmt, ':detalle', $detalle);
        oci_bind_by_name($stmt, ':id_marca', $id_marca);
        oci_bind_by_name($stmt, ':id_lugar_creacion', $id_lugar_creacion);
        oci_bind_by_name($stmt, ':nombre', $nombre);
        oci_bind_by_name($stmt, ':precio', $precio);
        oci_bind_by_name($stmt, ':peso', $peso);
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
    }

    header('Location: index.php');
    exit;
?>