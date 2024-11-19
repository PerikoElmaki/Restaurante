<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicia sesión</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <nav>
        <div class="centrar">
            <h1>Empleados Bresciano's</h1>
        </div>
    </nav>
    <section class="container">
        <form action="validarInicio.php" method="post" class="row justify-content-between">

            <div class="form-floating mb-3">
                <input type="text" name="nombre" id="nombre" class="form-control" placeholder="" required>
                <label for="nombre">Introduce tu nombre de usuario</label>
            </div>

            <div class="form-floating mb-3">
                <input type="password" name="contraseña" id="contraseña" class="form-control" placeholder="" required>
                <label for="contraseña">Contraseña</label>
            </div>

            <div class="col-11 col-7">
                <input class="enviar" type="submit" value="Entrar">
            <div>
        </form>
        
    </section>
</body>

</html>