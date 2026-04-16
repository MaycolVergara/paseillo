export function initCalculator() {
    const selectProducto = document.getElementById('select-producto');
    const inputPrecioUnidad = document.getElementById('input-precio-unidad');
    const inputCantidad = document.getElementById('input-cantidad');
    const inputTotal = document.getElementById('input-total');

    if (!selectProducto || !inputPrecioUnidad || !inputCantidad || !inputTotal) return;

    window.calcularTotal = function() {
        const opcion = selectProducto.options[selectProducto.selectedIndex];
        if (opcion && opcion.value !== "") {
            const precio = parseFloat(opcion.getAttribute('data-precio')) || 0;
            inputPrecioUnidad.value = precio.toFixed(2);
            const cantidad = parseInt(inputCantidad.value) || 1;
            inputTotal.value = (precio * cantidad).toFixed(2);
        } else {
            // Fallback for direct manual values
            const precio = parseFloat(inputPrecioUnidad.value) || 0;
            const cantidad = parseInt(inputCantidad.value) || 1;
            inputTotal.value = (precio * cantidad).toFixed(2);
        }
    };

    selectProducto.addEventListener('change', window.calcularTotal);
    inputCantidad.addEventListener('input', window.calcularTotal);
    
    // Initial calculation if there is a selected product
    if (selectProducto.value) window.calcularTotal();
}
