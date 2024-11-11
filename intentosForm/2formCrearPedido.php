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
    <link rel="stylesheet" href="stylesPedido.css">
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
    <!-- Contenedor cuerpo -->
    <div class="container">
        <section class="row">
            <!-- Elementos generados a partir del JSON dentro del main -->
            <main id="items" class="col-12 col-md-8 row"></main>
            <!-- Carrito -->
            <aside class="col-12 col-md-4 align-self-center">
                <h2>Carrito</h2>
                <!-- Elementos del carrito -->
                <ul id="carrito" class="list-group"></ul>
                <hr>
                <!-- Precio total -->
                <p class="text-right">Total: <span id="total"></span>&euro;</p>
                <button id="boton-vaciar" class="btn btn-danger">Vaciar</button>
                <button id="boton-enviar" class="btn btn-success">Enviar Carrito</button>
            </aside>
        </section>
    </div>

    <!-- Formulario que se llenará dinámicamente (oculto) -->
    <form id="carritoForm" method="POST" action="/submitCarrito" style="display: none;">
    </form>

    <?php

    // Consulta SQL para obtener los productos
    $consulta = "SELECT * FROM productos";
    $resultado = mysqli_query($conn, $consulta);

    // Verificamos si hubo algún error en la consulta
    if (!$resultado) {
        echo json_encode(["error" => "Error en la consulta: " . mysqli_error($conn)]);
        exit();
    }

    // Creamos el array de productos
    $productos = [];
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $productos[] = [
            "id" => $fila['id'],
            "nombre" => $fila['nombre'],
            "categoria" => $fila['categoria'],
            "precio" => $fila['precio'],
            "stock" => $fila['stock']
        ];
    }

    // Establecemos el encabezado para JSON y devolvemos los productos

    $productos_json = json_encode($productos);
    ?>

    <script>
        // Variables
        let carrito = [];
        const divisa = '€';
        const DOMitems = document.querySelector('#items');
        const DOMcarrito = document.querySelector('#carrito');
        const DOMtotal = document.querySelector('#total');
        const DOMbotonVaciar = document.querySelector('#boton-vaciar');
        const DOMbotonEnviar = document.querySelector('#boton-enviar');
        const DOMcarritoForm = document.querySelector('#carritoForm');

        // Variable donde se almacenarán los productos desde el servidor
        const baseDeDatos = <?php echo $productos_json; ?>;

        // Función para renderizar los productos
        function renderizarProductos() {
            baseDeDatos.forEach((info) => {
                //Estructura
                const miNodo = document.createElement('div');
                miNodo.classList.add('productosCaja', 'col-sm-4');
                // Body
                const miNodoCardBody = document.createElement('div');
                miNodoCardBody.classList.add('row', 'justify-content-between');
                //Id 
                const miNodoId = document.createElement('label');
                miNodoId.classList.add('productosItem');
                miNodoId.textContent = info.id;

                //Nombre
                const miNodoTitle = document.createElement('label');
                miNodoTitle.classList.add('productosItem');
                miNodoTitle.textContent = info.nombre;

                //Categoria 
                const miNodoCateg = document.createElement('label');
                miNodoCateg.classList.add('productosItem');
                miNodoCateg.textContent = info.categoria;

                //Precio
                const miNodoPrecio = document.createElement('label');
                miNodoPrecio.classList.add('productosItem');
                miNodoPrecio.textContent = `${info.precio}${divisa}`;

                //Stock 
                const miNodoStock = document.createElement('label');
                miNodoStock.classList.add('productosItem');
                miNodoStock.textContent = info.stock + ' u';

                //Boton añadir
                const miNodoBoton = document.createElement('button');
                miNodoBoton.classList.add('productosItem', 'btn', 'btn-primary');
                miNodoBoton.textContent = '+';
                miNodoBoton.setAttribute('marcador', info.id);
                miNodoBoton.addEventListener('click', (evento) => {
                    console.log('Botón + clickeado', evento.target);
                    añadirProductoAlCarrito(evento); // Llamada a la función al hacer clic
                });
                //insertar


                miNodoCardBody.appendChild(miNodoId);
                miNodoCardBody.appendChild(miNodoTitle);
                miNodoCardBody.appendChild(miNodoCateg);
                miNodoCardBody.appendChild(miNodoPrecio);
                miNodoCardBody.appendChild(miNodoStock);
                miNodoCardBody.appendChild(miNodoBoton);
                miNodo.appendChild(miNodoCardBody);
                DOMitems.appendChild(miNodo);
            });
        }

        function añadirProductoAlCarrito(evento) {
            carrito.push(evento.target.getAttribute('marcador'));
            renderizarCarrito();
            actualizarFormulario();
        }



        // Modificar la función renderizarCarrito para mostrar comentarios
        function renderizarCarrito() {
            DOMcarrito.textContent = '';

            carrito.forEach((item) => {
                const producto = baseDeDatos.find((producto) => producto.id === parseInt(item.id));

                if (producto) {
                    const nodoProducto = document.createElement('li');
                    nodoProducto.classList.add('list-group-item', 'text-right', 'mx-2');
                    nodoProducto.textContent = `${item.cantidad} x ${producto.nombre} - ${producto.precio}${divisa}`;

                    // Mostrar comentario
                    if (item.comentario) {
                        const nodoComentario = document.createElement('p');
                        nodoComentario.classList.add('text-muted');
                        nodoComentario.textContent = `Comentario: ${item.comentario}`;
                        nodoProducto.appendChild(nodoComentario);
                    }

                    // Botón para eliminar el producto del carrito
                    const botonEliminar = document.createElement('button');
                    botonEliminar.classList.add('btn', 'btn-danger', 'mx-5');
                    botonEliminar.textContent = 'X';
                    botonEliminar.dataset.item = item.id;
                    botonEliminar.addEventListener('click', borrarItemCarrito);

                    nodoProducto.appendChild(botonEliminar);
                    DOMcarrito.appendChild(nodoProducto);
                } else {
                    console.error(`Producto con ID ${item.id} no encontrado en baseDeDatos.`);
                }
            });

            DOMtotal.textContent = calcularTotal();
        }

        // Función para borrar un item del carrito
        function borrarItemCarrito(evento) {
            const id = evento.target.dataset.item;
            carrito = carrito.filter((carritoId) => {
                return carritoId !== id;
            });
            renderizarCarrito();
            actualizarFormulario();
        }


        function calcularTotal() {
            return carrito.reduce((total, item) => {
                const miItem = baseDeDatos.filter((itemBaseDatos) => {
                    return itemBaseDatos.id === parseInt(item);
                });
                return total + miItem[0].precio;
            }, 0).toFixed(2);
        }



        // Función para vaciar el carrito
        function vaciarCarrito() {
            carrito = [];
            renderizarCarrito();
            actualizarFormulario();
        }

        function actualizarFormulario() {
            DOMcarritoForm.innerHTML = '';
            carrito.forEach((item, index) => {
                const inputId = document.createElement('input');
                inputId.type = 'hidden';
                inputId.name = `item${index}_id`;
                inputId.value = item.id;

                const inputCantidad = document.createElement('input');
                inputCantidad.type = 'hidden';
                inputCantidad.name = `item${index}_cantidad`;
                inputCantidad.value = item.cantidad;

                const inputComentario = document.createElement('input');
                inputComentario.type = 'hidden';
                inputComentario.name = `item${index}_comentario`;
                inputComentario.value = item.comentario;

                DOMcarritoForm.appendChild(inputId);
                DOMcarritoForm.appendChild(inputCantidad);
                DOMcarritoForm.appendChild(inputComentario);
            });
        }
        // Función para enviar el carrito
        function enviarCarrito() {
            const mesa = "<?php echo $id; ?>"; // Obtén la mesa desde PHP
            const pedido = Math.floor(Math.random() * 100000); // Número de pedido (generado aleatoriamente)

            // Construir la URL con los parámetros
            const url = new URL('/ruta/crearPedido.php', window.location.origin);

            // Añadir los parámetros del pedido
            url.searchParams.append('mesa', mesa);
            url.searchParams.append('pedido', pedido);

            // Añadir los artículos del carrito
            carrito.forEach((item, index) => {
                url.searchParams.append(`item${index}_id`, item.id);
                url.searchParams.append(`item${index}_cantidad`, item.cantidad);
                url.searchParams.append(`item${index}_comentario`, item.comentario);
            });

            // Redirigir a la URL de creación de pedido
            window.location.href = url.toString();
        }
        
        // Eventos para el carrito
        DOMbotonVaciar.addEventListener('click', vaciarCarrito);
        DOMbotonEnviar.addEventListener('click', () => {
            actualizarFormulario();
            DOMcarritoForm.submit();
        });

        // Llamada inicial para cargar los productos
        renderizarProductos();
        renderizarCarrito();
    </script>

</body>

</html>