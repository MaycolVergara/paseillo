// resources/js/product-search.js
// Funcionalidad de búsqueda de productos para formularios de ventas

document.addEventListener('DOMContentLoaded', function() {
    // Verificar si los elementos existen en la página
    const searchInput = document.getElementById('search-producto');
    const searchResults = document.getElementById('search-results');
    const selectProducto = document.getElementById('select-producto');

    // Si no existen los elementos, no ejecutar el script
    if (!searchInput || !searchResults || !selectProducto) {
        return;
    }

    const searchItems = document.querySelectorAll('.search-item');

    // Función de búsqueda
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        let hasResults = false;

        // Si no hay término de búsqueda, mostrar todos los productos
        if (searchTerm.length === 0) {
            searchItems.forEach(item => {
                item.style.display = 'block';
                hasResults = true;
            });
            searchResults.style.display = hasResults ? 'block' : 'none';
            return;
        }

        // Filtrar productos según el término de búsqueda
        searchItems.forEach(item => {
            const productName = item.getAttribute('data-nombre').toLowerCase();
            if (productName.includes(searchTerm)) {
                item.style.display = 'block';
                hasResults = true;
            } else {
                item.style.display = 'none';
            }
        });

        searchResults.style.display = hasResults ? 'block' : 'none';
    });

    // Seleccionar producto de la lista
    searchItems.forEach(item => {
        item.addEventListener('click', function() {
            const productId = this.getAttribute('data-id');
            const productName = this.getAttribute('data-nombre');
            const productPrice = this.getAttribute('data-precio');

            // Actualizar el input de búsqueda
            searchInput.value = productName;

            // Seleccionar la opción en el select oculto
            selectProducto.value = productId;

            // Actualizar precio
            const inputPrecio = document.getElementById('input-precio-unidad');
            if (inputPrecio) {
                inputPrecio.value = productPrice;
            }

            // Ocultar resultados
            searchResults.style.display = 'none';

            // Calcular total
            calcularTotal();
        });
    });

    // Ocultar resultados al hacer clic fuera
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.relative')) {
            searchResults.style.display = 'none';
        }
    });

    // Mostrar todos los productos al hacer focus en el input
    searchInput.addEventListener('focus', function() {
        // Mostrar todos los productos
        searchItems.forEach(item => {
            item.style.display = 'block';
        });
        searchResults.style.display = 'block';
    });

    // Limpiar búsqueda al hacer doble clic
    searchInput.addEventListener('dblclick', function() {
        this.value = '';
        selectProducto.value = '';

        const inputPrecio = document.getElementById('input-precio-unidad');
        const inputTotal = document.getElementById('input-total');

        if (inputPrecio) inputPrecio.value = '';
        if (inputTotal) inputTotal.value = '';

        // Mostrar todos los productos
        searchItems.forEach(item => {
            item.style.display = 'block';
        });
        searchResults.style.display = 'block';
    });

    // Event listener para cantidad
    const inputCantidad = document.getElementById('input-cantidad');
    if (inputCantidad) {
        inputCantidad.addEventListener('input', calcularTotal);
    }

    // Función para calcular total
    function calcularTotal() {
        const inputPrecio = document.getElementById('input-precio-unidad');
        const inputCantidad = document.getElementById('input-cantidad');
        const inputTotal = document.getElementById('input-total');

        if (!inputPrecio || !inputCantidad || !inputTotal) return;

        const precio = parseFloat(inputPrecio.value) || 0;
        const cantidad = parseInt(inputCantidad.value) || 0;
        inputTotal.value = (precio * cantidad).toFixed(2);
    }

    // Hacer la función global para que pueda ser llamada desde otros lugares
    window.calcularTotal = calcularTotal;
});
