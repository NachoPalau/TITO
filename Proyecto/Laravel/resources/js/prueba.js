console.log('El archivo prueba.js está cargado');
axios.get('/api/productos')
    .then(function (response) {
        let productos = response.data;
        let productosDiv = document.getElementById('productos');
        
        productos.forEach(function(producto) {
            let productoHTML = `
                <div class="producto">
                    <strong>${producto.nombre}</strong> - $${producto.precio}
                    <p>${producto.descripcion}</p>
                    <p>Stock: ${producto.stock}</p>
                    <img src="${producto.imagen_url}" alt="${producto.nombre}" width="100">
                </div>
            `;
            productosDiv.innerHTML += productoHTML;
        });
    })
    .catch(function (error) {
        console.error('Error al obtener los productos:', error);
    });

