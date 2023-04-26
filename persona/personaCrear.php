<?php include_once('header.php')?>

<div class="container">
    <form>
        <div class="form-group">
            <label for="exampleInputEmail1">Digite su nombre</label>
            <input type="text" class="form-control" id="nombreInput" aria-describedby="emailHelp" placeholder="Keng Chang Salas">
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Digite su apellido</label>
            <input type="text" class="form-control" id="apellidoInput" placeholder="200">
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Digite su correo</label>
            <input type="email" class="form-control" id="correoInput" placeholder="30. kg">
        </div>\

        <div class="form-group">
            <label for="exampleInputPassword1">Digite su cedula</label>
            <input type="number" class="form-control" id="cedulaInput" placeholder="30. kg">
        </div>

        <a class="btn btn-primary btn-lg" href="index.php">Guardar</a>
    </form>
</div>    

<?php include_once('footer.php')?>