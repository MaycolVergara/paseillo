export function initPagination() {
    const tableBody = document.getElementById('tabla-paginada');
    const paginationContainer = document.getElementById('paginacion-contenedor');
    const searchInput = document.getElementById('searchInput');

    if (!tableBody || !paginationContainer) return;

    const rows = Array.from(tableBody.querySelectorAll('tr.fila-paginada'));
    const rowsPerPage = 5;
    let currentPage = 1;
    let filteredRows = [...rows];

    function displayRows(page) {
        const start = (page - 1) * rowsPerPage;
        const end = start + rowsPerPage;
        rows.forEach(row => row.style.display = 'none');
        filteredRows.forEach((row, index) => {
            if (index >= start && index < end) row.style.display = '';
        });
    }

    function createBtn(text, isActive = false, isDisabled = false, pageTarget = null) {
        const btn = document.createElement('button');
        btn.innerHTML = text;
        btn.disabled = isDisabled;
        const baseClass = 'w-9 h-9 flex items-center justify-center text-sm rounded-xl transition-all ';
        if (isActive) btn.className = baseClass + 'font-black bg-orange-500 text-white shadow-md';
        else if (isDisabled) btn.className = baseClass + 'font-bold text-gray-400 bg-transparent cursor-not-allowed';
        else btn.className = baseClass + 'font-bold text-gray-500 hover:bg-gray-200 dark:hover:bg-gray-700';

        if (pageTarget !== null && !isDisabled && !isActive) {
            btn.onclick = (e) => {
                e.preventDefault();
                currentPage = pageTarget;
                displayRows(currentPage);
                setupPagination();
            };
        }
        return btn;
    }

    function setupPagination() {
        paginationContainer.innerHTML = '';
        const pageCount = Math.ceil(filteredRows.length / rowsPerPage);
        if (pageCount <= 1) {
            paginationContainer.style.display = 'none';
            return;
        }
        paginationContainer.style.display = 'flex';
        if (!paginationContainer.classList.contains('gap-1')) paginationContainer.classList.add('gap-1');

        let startPage, endPage;
        if (pageCount <= 5) {
            startPage = 1; endPage = pageCount;
        } else {
            if (currentPage <= 3) { startPage = 1; endPage = 4; }
            else if (currentPage + 2 >= pageCount) { startPage = pageCount - 3; endPage = pageCount; }
            else { startPage = currentPage - 1; endPage = currentPage + 1; }
        }

        paginationContainer.appendChild(createBtn('←', false, currentPage === 1, currentPage - 1));
        if (startPage > 1) {
            paginationContainer.appendChild(createBtn('1', false, false, 1));
            if (startPage > 2) paginationContainer.appendChild(createBtn('...', false, true));
        }
        for (let i = startPage; i <= endPage; i++) {
            paginationContainer.appendChild(createBtn(i, i === currentPage, false, i));
        }
        if (endPage < pageCount) {
            if (endPage < pageCount - 1) paginationContainer.appendChild(createBtn('...', false, true));
            paginationContainer.appendChild(createBtn(pageCount, false, false, pageCount));
        }
        paginationContainer.appendChild(createBtn('→', false, currentPage === pageCount, currentPage + 1));
    }

    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const term = this.value.toLowerCase();
            filteredRows = rows.filter(row => {
                const searchElements = row.querySelectorAll('.texto-buscar');
                if (searchElements.length > 0) {
                    return Array.from(searchElements).some(el => el.textContent.toLowerCase().includes(term));
                }
                return row.textContent.toLowerCase().includes(term);
            });
            currentPage = 1;
            displayRows(currentPage);
            setupPagination();
        });
    }

    displayRows(currentPage);
    setupPagination();
}
