<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav>
        <h1>Menu Encargado</h1>
        <!-- Saludar camarero -->
        <?php 
            session_start();
            $nombre = $_SESSION['nombre']; 
            echo "<h3>Bienvenido, $nombre</h3>";
        ?>
    </nav>
    <section>
        
    </section>
</body>
</html>