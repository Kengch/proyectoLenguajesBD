<?php 
    include_once('../conexionBD.php');
    
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $detalle = $_POST['detalle'];
    $precio = $_POST['precio'];
    $peso = $_POST['peso'];
    $id_marca = $_POST['id_marca'];
    $id_lugar_creacion = $_POST['id_lugar_creacion'];
    
    if(!empty($id) && !empty($nombre) && !empty($detalle) && !empty($precio) && !empty($peso) && !empty($id_marca) && !empty($id_lugar_creacion)){
        $query = "BEGIN actualizar_producto(:id, :nombre, :detalle, :precio, :peso, :id_marca, :id_lugar_creacion); END;";
        $stmt = oci_parse($conn, $query);
       
        oci_bind_by_name($stmt, ':id', $id);
        oci_bind_by_name($stmt, ':nombre', $nombre);
        oci_bind_by_name($stmt, ':detalle', $detalle);
        oci_bind_by_name($stmt, ':precio', $precio);
        oci_bind_by_name($stmt, ':peso', $peso);
        oci_bind_by_name($stmt, ':id_marca', $id_marca);
        oci_bind_by_name($stmt, ':id_lugar_creacion', $id_lugar_creacion);
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