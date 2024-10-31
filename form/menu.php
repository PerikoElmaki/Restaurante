<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include("src/validarInicio.php"); $nombre =$_SESSION['nombre'] ?>
    <nav>
        <h1>Menu</h1>
        <!-- Saludar camarero -->
        <?php 
            echo "<h3>Bienvenido, $nombre</h3>";
        ?>
    </nav>
    <section>
        
    </section>
</body>
</html>