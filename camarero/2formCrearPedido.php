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

    <script>
        // Insertar el valor de las variables tras consulta en bbdd
        //  
        // ej: id = $id 
        const baseDeDatos = [{
                id: 1,
                nombre: 'Agua',
                categoria: 'bebida',
                precio: 1,
                stock: 10
            },
            {
                id: 2,
                nombre: 'COca',
                categoria: 'bebida',
                precio: 1,
                stock: 10
            },
            {
                id: 3,
                nombre: 'Fanta',
                categoria: 'bebida',
                precio: 1,
                stock: 10
            },
            {
                id: 4,
                nombre: 'Cerveza',
                categoria: 'bebida',
                precio: 1,
                stock: 10
            }
        ];

        let carrito = [];
        const divisa = '€';
        const DOMitems = document.querySelector('#items');
        const DOMcarrito = document.querySelector('#carrito');
        const DOMtotal = document.querySelector('#total');
        const DOMbotonVaciar = document.querySelector('#boton-vaciar');
        const DOMbotonEnviar = document.querySelector('#boton-enviar');
        const DOMcarritoForm = document.querySelector('#carritoForm');

        function renderizarProductos() {
            // Cambiar por productos consulta 
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
                // FUtura comprobación,  (if info.categoria = pizza )si es categoria pizza, cambiar clase 
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
                //insertar
                miNodoBoton.setAttribute('marcador', info.id);
                miNodoBoton.addEventListener('click', añadirProductoAlCarrito);
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

        function renderizarCarrito() {
            DOMcarrito.textContent = '';
            const carritoSinDuplicados = [...new Set(carrito)];
            carritoSinDuplicados.forEach((item) => {
                const miItem = baseDeDatos.filter((itemBaseDatos) => {
                    return itemBaseDatos.id === parseInt(item);
                });
                const numeroUnidadesItem = carrito.reduce((total, itemId) => {
                    return itemId === item ? total += 1 : total;
                }, 0);
                const miNodo = document.createElement('li');
                miNodo.classList.add('list-group-item', 'text-right', 'mx-2');
                miNodo.textContent = `${numeroUnidadesItem} x ${miItem[0].nombre} - ${miItem[0].precio}${divisa}`;
                const miBoton = document.createElement('button');
                miBoton.classList.add('btn', 'btn-danger', 'mx-5');
                miBoton.textContent = 'X';
                miBoton.style.marginLeft = '1rem';
                miBoton.dataset.item = item;
                miBoton.addEventListener('click', borrarItemCarrito);
                miNodo.appendChild(miBoton);
                DOMcarrito.appendChild(miNodo);
            });
            DOMtotal.textContent = calcularTotal();
        }

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

        function vaciarCarrito() {
            carrito = [];
            renderizarCarrito();
            actualizarFormulario();
        }

        function actualizarFormulario() {
            DOMcarritoForm.innerHTML = '';
            carrito.forEach((item, index) => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = `item${index}`;
                input.value = item;
                DOMcarritoForm.appendChild(input);
            });
        }
        // Nueva función para enviar los datos del carrito al servidor
        function enviarCarrito() {
            const productos = [];
            const carritoSinDuplicados = [...new Set(carrito)];
            carritoSinDuplicados.forEach((item) => {
                const miItem = baseDeDatos.filter((itemBaseDatos) => itemBaseDatos.id === parseInt(item));
                const numeroUnidadesItem = carrito.reduce((total, itemId) => (itemId === item ? total + 1 : total), 0);
                productos.push({
                    id: miItem[0].id,
                    cantidad: numeroUnidadesItem
                });
            });

            fetch('crearPedido.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        productos: productos
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Pedido creado exitosamente');
                        carrito = [];
                        renderizarCarrito();
                    } else {
                        alert('Hubo un error al crear el pedido');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al enviar el pedido');
                });
        }

        DOMbotonVaciar.addEventListener('click', vaciarCarrito);

        DOMbotonEnviar.addEventListener('click', () => {
            actualizarFormulario();
            DOMcarritoForm.submit();
        });

        renderizarProductos();
        renderizarCarrito();
    </script>
</body>

</html>