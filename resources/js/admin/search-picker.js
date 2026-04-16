export function initSearchPicker() {
    const searchInput = document.getElementById('search-producto');
    const resultsContainer = document.getElementById('search-results');
    const hiddenSelect = document.getElementById('select-producto');

    if (!searchInput || !resultsContainer || !hiddenSelect) return;

    const items = Array.from(resultsContainer.querySelectorAll('.search-item'));

    searchInput.addEventListener('focus', function() {
        const term = this.value.toLowerCase();
        items.forEach(item => {
            const name = item.getAttribute('data-nombre').toLowerCase();
            if (name.includes(term)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
        resultsContainer.classList.remove('hidden');
    });

    searchInput.addEventListener('input', function() {
        const term = this.value.toLowerCase();
        let hasResults = false;
        items.forEach(item => {
            const name = item.getAttribute('data-nombre').toLowerCase();
            if (name.includes(term)) {
                item.style.display = 'block';
                hasResults = true;
            } else {
                item.style.display = 'none';
            }
        });
        if (hasResults || term.length === 0) {
            resultsContainer.classList.remove('hidden');
        } else {
            resultsContainer.classList.add('hidden');
        }
    });

    items.forEach(item => {
        item.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const name = this.getAttribute('data-nombre');
            const price = this.getAttribute('data-precio');

            searchInput.value = name;
            hiddenSelect.value = id;

            const inputPrecio = document.getElementById('input-precio-unidad');
            if (inputPrecio) inputPrecio.value = price;

            hiddenSelect.dispatchEvent(new Event('change'));
            
            // Wait a tiny bit for the change event to be processed by our calculator
            setTimeout(() => {
                if (typeof window.calcularTotal === 'function') {
                    window.calcularTotal();
                }
            }, 0);

            resultsContainer.classList.add('hidden');
            const inputCantidad = document.getElementById('input-cantidad');
            if (inputCantidad) {
                inputCantidad.focus();
                inputCantidad.select();
            }
        });
    });

    document.addEventListener('click', (e) => {
        if (!searchInput.contains(e.target) && !resultsContainer.contains(e.target)) {
            resultsContainer.classList.add('hidden');
        }
    });
}
