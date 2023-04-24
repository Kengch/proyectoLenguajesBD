<?php include_once('header.php')?>

<div class="container">
    <h1>preguntar</h1>
    <form>
        <div class="form-group">
            <label for="exampleInputEmail1">Digite su nombre</label>
            <input type="text" class="form-control" id="nombreInput" aria-describedby="emailHelp" placeholder="Keng Chang Salas">
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Digite el precio</label>
            <input type="number" class="form-control" id="precioInput" placeholder="200">
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Digite su peso</label>
            <input type="number" class="form-control" id="pesoInput" placeholder="30. kg">
        </div>

        <a class="btn btn-primary btn-lg" href="index.php">Guardar</a>
    </form>
</div>    

<?php include_once('footer.php')?>