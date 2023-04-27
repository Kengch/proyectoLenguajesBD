<?php 
    include_once('../conexionBD.php');

    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $correo = $_POST['correo'];
    $cedula = $_POST['cedula'];
    $tipo_persona = $_POST['TIPO_PERSONA'];
    if($tipo_persona == 23){
        $tipo_persona = 1;
    }
    else{
        $tipo_persona = 2;
    }

    if(!empty($nombre) && !empty($apellidos) && !empty($correo) && !empty($cedula)){
        $query = "BEGIN insertar_persona(:nombre, :apellidos, :correo, :cedula, :tipo_persona); END;";
        $stmt = oci_parse($conn, $query);
    
        oci_bind_by_name($stmt, ':nombre', $nombre);
        oci_bind_by_name($stmt, ':apellidos', $apellidos);
        oci_bind_by_name($stmt, ':correo', $correo);
        oci_bind_by_name($stmt, ':cedula', $cedula);
        oci_bind_by_name($stmt, ':tipo_persona', $tipo_persona);
    
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

    header('Location: personaIndex.php');
    exit;
?>