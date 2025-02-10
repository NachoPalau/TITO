<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Productos</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        .container { display: flex; gap: 20px; }
        .listado { width: 50%; border-right: 1px solid #ccc; padding-right: 20px; height: 90vh; overflow-y: auto; }
        .formulario { width: 50%; padding-left: 20px; }
        #productos-container { display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px; }
        .producto { cursor: pointer; padding: 10px; border: 1px solid #ddd; border-radius: 8px; text-align: center; background: #f9f9f9; }
        .producto img { width: 100%; height: 120px; object-fit: cover; border-radius: 5px; }
        #buscarProducto { width: 100%; padding: 8px; margin-bottom: 10px; }
    </style>
</head>
<body>
    <h2>Listado de Productos</h2>

    <div class="container">
        <!-- Listado de productos -->
        <div class="listado">
            <input type="text" id="buscarProducto" placeholder="Buscar producto...">
            <div id="productos-container">
                @foreach($productos as $producto)
                    <div class="producto product-link" data-id="{{ $producto->id }}">
                        <img src="{{ asset('img/productos/' . $producto->imagen_url) }}" alt="{{ $producto->nombre }}">
                        <strong>{{ $producto->nombre }}</strong>
                        <p>Descripción: {{ $producto->descripcion }}</p>
                        <p class="producto-precio">Precio: ${{ number_format($producto->precio, 2) }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Formulario de edición -->
        <div class="formulario">
            <h3>Editar Producto</h3>
            <form id="editProductForm">
                @csrf
                <input type="hidden" id="product_id">

                <label>Nombre:</label>
                <input type="text" id="nombre"><br><br>

                <label>Descripción:</label>
                <textarea id="descripcion"></textarea><br><br>

                <label>Precio:</label>
                <input type="number" id="precio" step="0.01"><br><br>

                <label>Stock:</label>
                <input type="number" id="stock"><br><br>

                <label>Imagen URL:</label>
                <input type="text" id="imagen_url"><br><br>

                <label>Destacado:</label>
                <input type="checkbox" id="destacado"><br><br>

                <button type="submit">Actualizar</button>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            let page = 1;
            let loading = false;

            // Cargar más productos al hacer scroll
            $(".listado").scroll(function () {
                if (!loading && $(".listado").scrollTop() + $(".listado").innerHeight() >= $(".listado")[0].scrollHeight - 10) {
                    loading = true;
                    page++;
                    $.get(`/products?page=${page}`, function (data) {
                        $("#productos-container").append(data);
                        loading = false;
                    });
                }
            });

            // Filtrar productos en tiempo real
            $("#buscarProducto").on("keyup", function () {
                let query = $(this).val().toLowerCase();
                $(".producto").each(function () {
                    let nombre = $(this).find("strong").text().toLowerCase();
                    $(this).toggle(nombre.includes(query));
                });
            });

            // Cargar datos del producto en el formulario al hacer clic
            $(document).on("click", ".product-link", function () {
                let productId = $(this).data("id");

                $.get(`/products/${productId}/edit`, function (data) {
                    $("#product_id").val(data.id);
                    $("#nombre").val(data.nombre);
                    $("#descripcion").val(data.descripcion);
                    $("#precio").val(data.precio);
                    $("#stock").val(data.stock);
                    $("#imagen_url").val(data.imagen_url);
                    $("#destacado").prop("checked", data.destacado);
                });
            });

            // Enviar formulario de actualización
            $("#editProductForm").submit(function (e) {
                e.preventDefault();
                let productId = $("#product_id").val();

                $.post(`/products/${productId}/update`, {
                    _token: "{{ csrf_token() }}",
                    nombre: $("#nombre").val(),
                    descripcion: $("#descripcion").val(),
                    precio: $("#precio").val(),
                    stock: $("#stock").val(),
                    imagen_url: $("#imagen_url").val(),
                    destacado: $("#destacado").is(":checked") ? 1 : 0
                }, function (response) {
                    alert(response.success);
                });
            });
        });
    </script>
</body>
</html>
