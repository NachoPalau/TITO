<link rel="stylesheet" href="{{ asset('css/styles.css') }}">

<nav class="container-fluid bg-light py-4">
        <div class="row justify-content-center">
            <div class="col-auto"><a href="{{ route('productos') }}" class="nav-link active" style="{{Route::currentRouteName() == 'productos' ? 
            'text-decoration: underline; text-decoration-color:#6B0200' : ''}}">PRODUCTOS</a></div>

            <div class="col-auto"><a href="{{route('recetas')}}" class="nav-link active " style="{{Route::currentRouteName() == 'recetas' ? 
            'text-decoration: underline; text-decoration-color:#6B0200' : ''}}">RECETAS</a></div>
            
            <div class="col-auto"><a href="{{route('eventos')}}" class="nav-link active" style="{{Route::currentRouteName() == 'eventos' ? 
            'text-decoration: underline; text-decoration-color:#6B0200' : ''}}">EVENTOS</a></div>
        </div>
</nav>