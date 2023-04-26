<?php 
    // se crea la conexion a la bd
    $conn = oci_connect("admin", "admin", "//localhost/orcl");
    if (!$conn) {
        $m = oci_error();
        echo $m['message'], "\n";die;
        exit;
    }
?>