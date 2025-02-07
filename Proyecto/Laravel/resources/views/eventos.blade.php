<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mi Página</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        .superpuesto {
            position: absolute;
            top: 105%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .contenedor-imagen {
            height: 50%;
            position: relative;
            text-align: center;
        }

        .imagen-cubo {
            width: 250px;
            height: 250px;
            object-fit: cover;
            border: 2px solid #fff;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        .contenedor-imagen img {
            display: block;
            margin: 0 auto;
        }

        .eventos {
            margin: 205px;
        }

        .eventos .row {
            display: flex;
            justify-content: center;
            gap: 30px;
        }
    </style>
</head>

<body>
    @include('layouts.navigation')
    @include('layouts.subnavbar')

    <section class="contenedor-imagen bg-light text-center py-5">
        <img src="{{ asset('img/img_eventos/eventoHindi.jpg') }}" alt="Imagen principal" style="width: 100%; height:400px">
        
        <div class="superpuesto" id="contenedorImagenes">
            <button class="btn btn-secondary" onclick="cambiarImagen(-1)">&#9665;</button>
            <img src="{{ asset('img/img_eventos/mona.jpg') }}" class="imagen-cubo" alt="Evento 1">
            <img src="{{ asset('img/img_eventos/pepito.jpg') }}" class="imagen-cubo" alt="Evento 2">
            <img src="{{ asset('img/img_eventos/titaina.jpg') }}" class="imagen-cubo" alt="Evento 3">
            <button class="btn btn-secondary" onclick="cambiarImagen(1)">&#9655;</button>
        </div>
    </section>

    <div class="eventos">
        <h2 class="text-center my-4">Próximos eventos</h2>
        <section class="text-center py-5">
            <div class="row">
                <div class="col-md-4 col-sm-6 mb-4">
                    <img src="{{ asset('img/img_eventos/eventoHindi.jpg') }}" class="img-fluid" alt="Receta 1">
                </div>
                <div class="col-md-4 col-sm-6 mb-4">
                    <img src="{{ asset('img/img_eventos/eventoHindi.jpg') }}" class="img-fluid" alt="Receta 2">
                </div>
            </div>
        </section>
    </div>

    @include('layouts.footer')

    <script>
        const nuevasImagenes = [
            "{{ asset('img/img_eventos/receta.jpg') }}",
            "{{ asset('img/img_eventos/recetasGanadoras.jpg') }}",
           
        ];
        
        let indiceNuevaImagen = 0;

        function cambiarImagen(direccion) {
            const contenedor = document.getElementById("contenedorImagenes");
            const imagenes = Array.from(contenedor.getElementsByClassName("imagen-cubo"));

            if (direccion === 1 && indiceNuevaImagen < nuevasImagenes.length) {
                imagenes[0].remove();
                const nuevaImg = document.createElement("img");
                nuevaImg.src = nuevasImagenes[indiceNuevaImagen];
                nuevaImg.className = "imagen-cubo";
                nuevaImg.alt = "Nueva imagen";
                contenedor.insertBefore(nuevaImg, contenedor.children[contenedor.children.length - 1]);
                indiceNuevaImagen++;
            } else if (direccion === -1 && indiceNuevaImagen > 0) {
                const ultimaImagen = imagenes[imagenes.length - 1];
                ultimaImagen.remove();
                const nuevaImg = document.createElement("img");
                nuevaImg.src = nuevasImagenes[indiceNuevaImagen - 1];
                nuevaImg.className = "imagen-cubo";
                nuevaImg.alt = "Nueva imagen";
                contenedor.insertBefore(nuevaImg, contenedor.children[1]);
                indiceNuevaImagen--;
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>