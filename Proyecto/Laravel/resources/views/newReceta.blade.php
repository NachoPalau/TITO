<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis recetas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.9.6/lottie.min.js"></script>
    <style>
        .container-center {
            height: 100vh;
        }
        .producto {
            border: 1px solid #ddd;
            padding: 10px;
            margin: 5px;
            cursor: pointer;
            text-align: center;
            width: 100%;
            background: #f8f9fa;
            border-radius: 5px;
        }
        .producto img {
            max-width: 320px;
            height: auto;
            display: block;
            margin: auto;
        }
        .ingrediente-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 5px 10px;
            background: #e9ecef;
            border-radius: 5px;
            margin: 5px 0;
        }
        .ingrediente-item .remove {
            cursor: pointer;
            color: red;
            font-weight: bold;
        }
        #productos-container {
            max-height: 100vh;
            overflow-y: auto;
        }
    </style>
</head>
<body>
 @include('layouts.navigation')
    <div class="row">
        
        <!-- Lista de Productos (Izquierda) -->
        <div class="col-md-4">
                <h4>Seleccionar Ingredientes</h4>
                <input type="text" id="buscarProducto" class="form-control mb-2" placeholder="Buscar producto...">
                
                <!-- Contenedor con 2 columnas -->
                <div id="productos-container" class="row border p-2">
                    @foreach($productos as $producto)
                        <div class="col-6"> <!-- Ahora los productos están en 2 columnas -->
                            <div class="producto" data-nombre="{{ $producto->nombre }}">
                                <img src="{{ asset('img/productos/' . $producto->imagen_url) }}" alt="{{ $producto->nombre }}">
                                <strong>{{ $producto->nombre }}</strong>
                            </div>
                        </div>
                    @endforeach
                </div>
                </div>

        <!-- Formulario (Derecha) -->
        <div class="col-md-8">
            <h2>Crear Receta</h2>
            <form action="{{ route('recetas.store') }}" method="POST">
                @csrf
                <div class="row">
                    <!-- Primera columna -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="titulo">Título:</label>
                            <input type="text" name="titulo" id="titulo" class="form-control" required>
                        </div>
                    </div>

                    <!-- Segunda columna -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="descripcion">Descripción:</label>
                            <input type="text" name="descripcion" id="descripcion" class="form-control" required>
                        </div>
                    </div>

                    <!-- Tercera columna -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="guardados">¿Guardar receta?</label>
                            <input type="checkbox" name="guardados" id="guardados" value="1">
                        </div>
                    </div>
                </div>

                <!-- Ingredientes -->
                <div class="form-group mt-3">
                    <label>Ingredientes:</label>
                    <div id="ingredientes-list"></div>
                    <textarea name="ingredientes" id="ingredientes" class="form-control" required readonly></textarea>
                </div>

                <button type="submit" class="btn btn-primary mt-3">Guardar Receta</button>
            </form>
        </div>
    </div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let ingredientes = [];
        const ingredientesList = document.getElementById("ingredientes-list");
        const ingredientesTextarea = document.getElementById("ingredientes");

        // Agregar ingrediente al hacer clic en un producto
        document.querySelectorAll(".producto").forEach(producto => {
            producto.addEventListener("click", function () {
                const nombre = this.getAttribute("data-nombre");

                if (!ingredientes.includes(nombre)) {
                    ingredientes.push(nombre);
                    actualizarListaIngredientes();
                }
            });
        });

        // Actualizar la lista de ingredientes
        function actualizarListaIngredientes() {
            ingredientesList.innerHTML = "";
            ingredientes.forEach((ingrediente, index) => {
                const div = document.createElement("div");
                div.classList.add("ingrediente-item");
                div.innerHTML = `${ingrediente} <span class="remove" data-index="${index}">X</span>`;
                ingredientesList.appendChild(div);
            });

            // Actualizar el textarea con la lista en JSON
            ingredientesTextarea.value = JSON.stringify(ingredientes);
        }

        // Eliminar ingrediente al hacer clic en la "X"
        ingredientesList.addEventListener("click", function (e) {
            if (e.target.classList.contains("remove")) {
                const index = e.target.getAttribute("data-index");
                ingredientes.splice(index, 1);
                actualizarListaIngredientes();
            }
        });

        // Filtro de búsqueda de productos
        document.getElementById("buscarProducto").addEventListener("input", function () {
            const search = this.value.toLowerCase();
            document.querySelectorAll(".producto").forEach(producto => {
                const nombre = producto.getAttribute("data-nombre").toLowerCase();
                producto.style.display = nombre.includes(search) ? "block" : "none";
            });
        });
    });
</script>

</body>
</html>
