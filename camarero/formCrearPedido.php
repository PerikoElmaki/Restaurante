<?php
include "../conexion.php";
include "../sesion.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <nav>
        <div class="volver">
            <h4><a href="salon.php">
                    <=Volver al salón
                        </a>
            </h4>
        </div>
        <div class="centrar">
            <?php
            $id = $_GET['id'];
            echo "<h1>Mesa $id</h1>";
            $nombre = $_SESSION['nombre'];
            echo "<h3>Camarero: $nombre</h3>";
            ?>
        </div>
    </nav>
    <section>
        <div class="container mt-5">
            <h2>Realiza tu Pedido</h2>
            <!-- Sección de Pizzas -->
            <div class="categoriasDiv row mb-3">
                <h4>Pizzas</h4>
                <div class="containerCateg col-md-3">
                    <select id="pizzaType" class="categoria form-select">
                        <option selected>Elige...</option>
                        <option value="margherita">Margherita</option>
                        <option value="pepperoni">Pepperoni</option>
                        <option value="vegetarian">Vegetariana</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="pizzaQuantity" class="form-label">Cantidad</label>
                    <input
                        type="number"
                        id="pizzaQuantity"
                        class="cant form-control"
                        min="1" />
                </div>
                <div class="col-md-4">
                    <label for="pizzaComment" class="form-label">Añadir Comentario</label>
                    <input type="text" id="pizzaComment" class="categoria form-control" />
                </div>
                <div class="col-md-3 align-self-end">
                    <button class="botonPedido btn btn-primary">Añadir al Pedido</button>
                </div>
            </div>
            <!-- Sección de Entrantes -->
            <div class="categoriasDiv row mb-3">
                <h4>Pizzas</h4>
                <div class="containerCateg col-md-3">
                    <select id="pizzaType" class="categoria form-select">
                        <option selected>Elige...</option>
                        <option value="margherita">Margherita</option>
                        <option value="pepperoni">Pepperoni</option>
                        <option value="vegetarian">Vegetariana</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="pizzaQuantity" class="form-label">Cantidad</label>
                    <input
                        type="number"
                        id="pizzaQuantity"
                        class="cant form-control"
                        min="1" />
                </div>
                <div class="col-md-4">
                    <label for="pizzaComment" class="form-label">Añadir Comentario</label>
                    <input type="text" id="pizzaComment" class="categoria form-control" />
                </div>
                <div class="col-md-3 align-self-end">
                    <button class="botonPedido btn btn-primary">Añadir al Pedido</button>
                </div>
            </div>
            <!-- Sección de Bocatas -->
            <div class="categoriasDiv row mb-3">
                <h4>Pizzas</h4>
                <div class="containerCateg col-md-3">
                    <select id="pizzaType" class="categoria form-select">
                        <option selected>Elige...</option>
                        <option value="margherita">Margherita</option>
                        <option value="pepperoni">Pepperoni</option>
                        <option value="vegetarian">Vegetariana</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="pizzaQuantity" class="form-label">Cantidad</label>
                    <input
                        type="number"
                        id="pizzaQuantity"
                        class="cant form-control"
                        min="1" />
                </div>
                <div class="col-md-4">
                    <label for="pizzaComment" class="form-label">Añadir Comentario</label>
                    <input type="text" id="pizzaComment" class="categoria form-control" />
                </div>
                <div class="col-md-3 align-self-end">
                    <button class="botonPedido btn btn-primary">Añadir al Pedido</button>
                </div>
            </div>

        </div>
    </section>
</body>

</html>