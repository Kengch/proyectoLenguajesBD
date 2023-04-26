<?php include_once('../header.php')?>

<?php
// Create connection to Oracle
$conn = oci_connect("admin", "admin", "//localhost/orcl");
if (!$conn) {
   $m = oci_error();
   echo $m['message'], "\n";die;
   exit;
}
else {
   // Preparación de la consulta que llama al procedimiento almacenado
    $query = "BEGIN obtener_detalles(:param1, :param2); END;";
    $stmt = oci_parse($conn, $query);
}
// Close the Oracle connection
oci_close($conn);
?>


<div class=" mt-3 mb-3 mr-5 text-right">
    <div class="d-inline-block">
        <a class="btn btn-primary btn-lg" href="crear.php">Agregar</a>
    </div>
</div>
<div class="">
    <div class="row">
        <div class="col-12">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Id de detalle</th>
                        <th scope="col">Id de marca</th>
                        <th scope="col">Id de lugar de creacion</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Peso</th>
                        <th scope="col">Fecha de vencimiento</th>
                        <th scope="col">Fecha de creacion</th>
                        <th scope="col">Fecha de modificacion</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>        
</div>



<?php include_once('../footer.php')?>
