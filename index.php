<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicia sesión</title>
    <link rel="stylesheet" href="styles.css">
    <!-- Boostras -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- Fuente -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gabarito:wght@400..900&family=Roboto&display=swap" rel="stylesheet">
</head>

<body class="cuerpoIndex">
    <nav>
        <div class="centrar">
            <h3>Empleados Il Bresciano</h3>
        </div>
    </nav>
    <section class="container">
        <form action="validarInicio.php" method="post" class="row justify-content-center g-4">
            <div class="row g-5">
                <div class="col-12 col-md-6 form-floating mb-3 g-3">
                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="" required>
                    <label for="nombre">Introduce tu nombre de usuario</label>
                </div>

                <div class="col-12 col-md-6 form-floating mb-3 g-3">
                    <input type="password" name="contraseña" id="contraseña" class="form-control" placeholder="" required>
                    <label for="contraseña">Contraseña</label>
                </div>
                <div class="col-12 d-flex justify-content-center">
                    <div class="d-grid col-6 col-md-4">
                        <input class="btn btn-warning" type="submit" value="Entrar">
                        <div>
                    <div>
                </div>
        </form>


    </section>
</body>

</html>