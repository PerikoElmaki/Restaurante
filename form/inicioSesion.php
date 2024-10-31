<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicia sesión</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav>
        <h1>Empleados Vega Media</h1>
    </nav>
    <section>
        <div class="containerFomr">
            <form action="src/validarInicio.php" method="post">
                <div class="usu">
                    <input type="text" name="nombre" id="nombre" placeholder="Usuario" required>
                </div>
                <div class="clav">
                    <input type="password" name="contraseña" id="contraseña" placeholder="contraseña" required>
                </div>
                <div class="btn">
                    <input type="submit" value="Entrar">
                <div>
            </form>
        </div>
    </section>
</body>
</html>