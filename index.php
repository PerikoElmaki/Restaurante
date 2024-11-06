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
            <h1>Empleados Vega Media</h1>
        </div>
    </nav>
    <section>
        <form action="validarInicio.php" method="post">
            <div class="col-12">
                <input type="text" name="nombre" id="nombre" placeholder="Usuario" required>
            </div>
            <div class="clav">
                <input type="password" name="contraseña" id="contraseña" placeholder="contraseña" required>
            </div>
            <div>
                <input class="enviar" type="submit" value="Entrar">
                <div>
        </form>

    </section>
</body>

</html>