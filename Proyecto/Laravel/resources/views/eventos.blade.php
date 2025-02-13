<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mi Página</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .contenedor-imagen {
            position: absolute;
            margin-top: 12%;
            padding-bottom: 0;

        }

        .carousel-container {
            left: 40%;
            transform: translate(-50%, -60%);
            width: 70%;
            z-index: 10;
            margin: 10%;
        }

        .carousel-container img {
            width: 250px;
            /* Ancho fijo para todas las imágenes */
            height: 250px;
            /* Altura fija */
            object-fit: cover;
            /* Ajusta la imagen sin distorsionarla */
            margin-left: 10%;
        } 
        
        .proxEven{
            position: relative;
            margin-top: 55%;
        }

       
        .eventos {
            flex: 1;
            margin: 10%;
            margin-top: 25%;
            width: 80%;
            margin-bottom: -3%;
        }

        
        @media (max-width: 768px) {

            .contenedor-imagen {
            position: relative;            
            padding-bottom: 0;
            }

            .proxEven{
                margin-top:8%;
            position: relative;
        }
    }

        

    </style>
</head>
<?php

?>

<body>
    @include('layouts.navigation')

    <section class="contenedor-imagen">
        <img src="{{ asset('img/img_eventos/sanValentin.jpg') }}" alt="Imagen principal" class="img-fluid w-100"
            style="max-height: 400px; object-fit: cover;">

        <div id="carouselExample" class="carousel slide carousel-container" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="d-flex justify-content-center gap-3">
                        @foreach($array1 as $producto)
                            <div class="producto d-flex producto-eventos prodRespo" style="max-width:25%;  max-height:30%" data-nombre="{{ $producto->nombre }}"
                                data-precio="{{ $producto->precio }}">
                                <img src="{{ asset('img/productos/' . $producto->imagen_url) }}" class="d-block w-20"
                                    alt="{{ $producto->nombre }}">
                                <strong>{{ $producto->nombre }}</strong>
                                <p class="producto-precio pProdEventos">Precio: ${{ number_format($producto->precio, 2) }}</p>
                                <form action="{{ route('carrito.agregar') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                                    <input type="hidden" name="precio" value="{{ $producto->precio }}">
                                    <input type="hidden" name="cantidad" value="1">
                                    <x-primary-button class="button-primary agregar-carrito">
                                        {{ __('Añadir al carrito') }}
                                        <img src="{{ asset('img/carrito/carrito.svg') }}" id="carrito">
                                    </x-primary-button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="d-flex justify-content-center gap-3">
                        @foreach($array2 as $producto)
                            <div class="producto d-flex producto-eventos" style="max-width:25%; max-height:30%" data-nombre="{{ $producto->nombre }}"
                                data-precio="{{ $producto->precio }}">
                                <img src="{{ asset('img/productos/' . $producto->imagen_url) }}" class="d-block w-20"
                                    alt="{{ $producto->nombre }}">
                                <strong>{{ $producto->nombre }}</strong>
                                <p class="producto-precio">Precio: ${{ number_format($producto->precio, 2) }}</p>
                                <form action="{{ route('carrito.agregar') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                                    <input type="hidden" name="precio" value="{{ $producto->precio }}">
                                    <input type="hidden" name="cantidad" value="1">
                                    <x-primary-button class="button-primary agregar-carrito">
                                        {{ __('Añadir al carrito') }}
                                        <img src="{{ asset('img/carrito/carrito.svg') }}" id="carrito">
                                    </x-primary-button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev button-eventos" type="button" data-bs-target="#carouselExample"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next button-eventos" type="button" data-bs-target="#carouselExample"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    <div class="proxEven">
        <h2 class="text-center my-2">Próximos eventos</h2>
        <section class="py-5">
            <div class="row justify-content-center text-center">
                <div class="col-md-5 col-sm-6 mb-4 d-flex flex-column align-items-center">
                    <img src="{{ asset('img/img_eventos/fallas.jpg') }}" class="img-fluid evento-img" alt="Fallas">
                    <p class="mt-3" style="padding:5%"><strong>Las Fallas:</strong><br> Disfruta de esta festividad llena de fuego y tradición.
                        Cada marzo, Valencia se ilumina con impresionantes monumentos falleros que arden en una noche
                        mágica. Además de los espectaculares castillos de fuegos artificiales, podrás disfrutar de
                        música, gastronomía típica y una atmósfera vibrante. ¡No te lo pierdas!</p>
                </div>
                <div class="col-md-5 col-sm-6 mb-4 d-flex flex-column align-items-center">
                    <img src="{{ asset('img/img_eventos/pascua.jpg') }}" class="img-fluid evento-img" alt="Pascua">
                    <p class="mt-3" style="padding:5%"><strong>Pascua:</strong><br> Celebra con nosotros la llegada de la primavera y las
                        tradiciones pascuales. Disfruta de la típica mona de Pascua, los juegos con huevos de chocolate
                        y reuniones familiares llenas de alegría. Esta es una época perfecta para compartir, relajarse y
                        degustar los sabores de la temporada. ¡Únete a la celebración!</p>
                </div>
            </div>
        </section>
    </div>
    @include('layouts.footer')


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const carousel = document.querySelector('#carouselExample');
    const carouselInner = carousel.querySelector('.carousel-inner');
    const originalItems = carouselInner.innerHTML;
    let isMobileView = window.matchMedia('(max-width: 768px)').matches;

    function adjustMobileLayout() {
        if (isMobileView) {
            // Añadir margen superior al contenedor principal
            document.querySelector('.contenedor-imagen').style.marginTop = '80px';
            
            // Modificar posicionamiento del carrusel
            carousel.style.position = 'relative';
            carousel.style.left = '0';
            carousel.style.transform = 'none';
            carousel.style.width = '100%';
            carousel.style.margin = '20px auto';
            carousel.style.zIndex = '5';

            // Restructurar contenido
            const firstItemProducts = Array.from(carouselInner.querySelector('.carousel-item.active').children[0].children);
            
            const newContent = firstItemProducts.map((producto, index) => `
                <div class="carousel-item ${index === 0 ? 'active' : ''}">
                    <div class="mobile-product">
                        ${producto.innerHTML}
                    </div>
                </div>
            `).join('');

            carouselInner.innerHTML = newContent;
        }
    }

    function handleResize() {
        const wasMobile = isMobileView;
        isMobileView = window.matchMedia('(max-width: 768px)').matches;
        
        if (isMobileView !== wasMobile) {
            carouselInner.innerHTML = originalItems;
            if (isMobileView) {
                adjustMobileLayout();
            } else {
                document.querySelector('.contenedor-imagen').style.marginTop = '0';
                carousel.style = ''; // Restaurar estilos originales
            }
            
            // Reiniciar carrusel
            const bsCarousel = bootstrap.Carousel.getInstance(carousel);
            if (bsCarousel) bsCarousel.dispose();
            new bootstrap.Carousel(carousel);
        }
    }

    // Estilos CSS para móvil
    const mobileCSS = document.createElement('style');
    mobileCSS.innerHTML = `
        @media (max-width: 768px) {
            /* Asegurar navbar por encima del contenido */
            .sticky-top {
                z-index: 1000 !important;
            }
            
            /* Margen superior para evitar superposición */
            .contenedor-imagen {
                margin-top: 0px !important;
            }
            
            /* Ajustes de espaciado */
            .mobile-product {
                padding: 15px;
                margin: 0 auto;
                max-width: 90%;
                background: white;
                border-radius: 10px;
                box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            }
            
            .producto-eventos {
                flex-direction: column !important;
                align-items: center !important;
                text-align:center;
                gap: 10px !important;
                padding-left: 10% !important;
            }
            
            .producto-eventos img {
                width: 150px !important;
                height: 150px !important;
            }
            
            /* Ajustar sección eventos */
            .eventos {
                margin-top: 30px !important;
                margin-bottom: 30px !important;
            }
            
            /* Reducir tamaño botones */
            .agregar-carrito {
                padding: 8px 15px !important;
                font-size: 14px !important;
            }
        }
    `;
    document.head.appendChild(mobileCSS);

    if (isMobileView) adjustMobileLayout();
    window.addEventListener('resize', handleResize);
});
</script>