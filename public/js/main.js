function toggleSidebar() {
    const sidebar = document.getElementById("sidebar");
    const mainArea = document.getElementById("main-area");
    const backdrop = document.getElementById("sidebar-backdrop");
    const isMobile = window.innerWidth < 1024; // Usando 1024 como break de LG para mayor seguridad

    if (isMobile) {
        // Toggle mobile visibility only
        const isHidden = sidebar.classList.contains("-translate-x-full");
        if (isHidden) {
            sidebar.classList.remove("-translate-x-full");
            sidebar.classList.add("translate-x-0");
            // Show backdrop
            if(backdrop) {
                backdrop.classList.remove("hidden", "opacity-0", "pointer-events-none");
                backdrop.classList.add("opacity-100");
            }
        } else {
            sidebar.classList.add("-translate-x-full");
            sidebar.classList.remove("translate-x-0");
            // Hide backdrop
            if(backdrop) {
                backdrop.classList.add("opacity-0", "pointer-events-none");
                setTimeout(() => backdrop.classList.add("hidden"), 300);
            }
        }
    } else {
        const collapsed = sidebar.classList.toggle("collapsed");
        mainArea.style.marginLeft = collapsed ? "80px" : "288px"; // Ajustado para el nuevo ancho
        if (collapsed) {
            document
                .querySelectorAll(".submenu-wrapper.open")
                .forEach((el) => el.classList.remove("open"));
            document
                .querySelectorAll(".nav-parent.open")
                .forEach((el) => el.classList.remove("open"));
        }
        localStorage.setItem(
            "paseillo-sidebar",
            collapsed ? "collapsed" : "expanded",
        );
    }
}

(function () {
    const state = localStorage.getItem("paseillo-sidebar");
    const isMobile = window.innerWidth < 768;
    if (state === "collapsed" && !isMobile) {
        document.getElementById("sidebar").classList.add("collapsed");
        const m = document.getElementById("main-area");
        if (m) m.style.marginLeft = "80px";
    }
})();

function toggleTheme() {
    const html = document.documentElement;
    const isDark = html.classList.toggle("dark");
    html.classList.toggle("light", !isDark);
    localStorage.setItem("paseillo-theme", isDark ? "dark" : "light");
}

(function () {
    const saved = localStorage.getItem("paseillo-theme") || "light";
    document.documentElement.className = saved;
})();

function toggleAccordion(btn) {
    const wrapper = btn.nextElementSibling;
    const isOpen = wrapper.classList.contains("open");
    document.querySelectorAll(".submenu-wrapper.open").forEach((el) => {
        el.classList.remove("open");
        el.previousElementSibling.classList.remove("open");
    });
    if (!isOpen) {
        wrapper.classList.add("open");
        btn.classList.add("open");
    }
}

function setActive(el) {
    document
        .querySelectorAll(".nav-link.active")
        .forEach((e) => e.classList.remove("active"));
    el.classList.add("active");
}

const profileWrap = document.getElementById("profile-wrap");
const profileDD = document.getElementById("profile-dropdown");

function toggleDropdown() {
    profileDD.classList.toggle("open");
}

document.addEventListener("click", (e) => {
    if (!profileWrap.contains(e.target)) profileDD.classList.remove("open");
});

const DAYS = [
    "Domingo",
    "Lunes",
    "Martes",
    "Miércoles",
    "Jueves",
    "Viernes",
    "Sábado",
];
const MONTHS = [
    "ene",
    "feb",
    "mar",
    "abr",
    "may",
    "jun",
    "jul",
    "ago",
    "sep",
    "oct",
    "nov",
    "dic",
];

function updateClock() {
    const now = new Date();
    const hh = String(now.getHours()).padStart(2, "0");
    const mm = String(now.getMinutes()).padStart(2, "0");
    const ss = String(now.getSeconds()).padStart(2, "0");
    document.getElementById("clock-time").textContent = `${hh}:${mm}:${ss}`;
    document.getElementById("clock-date").textContent =
        `${DAYS[now.getDay()]}, ${now.getDate()} ${MONTHS[now.getMonth()]} ${now.getFullYear()}`;
}

updateClock();
setInterval(updateClock, 1000);

document.addEventListener("DOMContentLoaded", () => {
    let currentPath = window.location.pathname.split("/").pop();
    if (currentPath === "") currentPath = "index.html";

    const activeLink = document.querySelector(
        `.nav-link[href="${currentPath}"]`,
    );

    if (activeLink) {
        document
            .querySelectorAll(".nav-link.active")
            .forEach((el) => el.classList.remove("active"));

        activeLink.classList.add("active");

        const submenuWrapper = activeLink.closest(".submenu-wrapper");
        if (submenuWrapper) {
            submenuWrapper.classList.add("open");

            const parentBtn = submenuWrapper.previousElementSibling;
            if (parentBtn && parentBtn.classList.contains("nav-parent")) {
                parentBtn.classList.add("open");
            }
        }
    }
});


//Paginacion
document.addEventListener('DOMContentLoaded', function () {
    // Selectores genéricos
    const tableBody = document.getElementById('tabla-paginada');
    const paginationContainer = document.getElementById('paginacion-contenedor');
    const searchInput = document.getElementById('searchInput');

    // Si no existen los elementos en esta página, detenemos el script sin errores
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
        if (isActive) {
            btn.className = baseClass + 'font-black bg-orange-500 text-white shadow-md';
        } else if (isDisabled) {
            btn.className = baseClass + 'font-bold text-gray-400 bg-transparent cursor-not-allowed';
        } else {
            btn.className = baseClass + 'font-bold text-gray-500 hover:bg-gray-200 dark:hover:bg-gray-700';
        }

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
        if (pageCount <= 1) { paginationContainer.style.display = 'none'; return; }
        paginationContainer.style.display = 'flex';

        let startPage, endPage;
        if (pageCount <= 5) {
            startPage = 1; endPage = pageCount;
        } else {
            if (currentPage <= 3) { startPage = 1; endPage = 4; }
            else if (currentPage + 2 >= pageCount) { startPage = pageCount - 3; endPage = pageCount; }
            else { startPage = currentPage - 1; endPage = currentPage + 1; }
        }

        // Botón Anterior
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

        // Botón Siguiente
        paginationContainer.appendChild(createBtn('→', false, currentPage === pageCount, currentPage + 1));
    }

    if (searchInput) {
        searchInput.oninput = function () {
            const term = this.value.toLowerCase();
            filteredRows = rows.filter(row => {
                const text = row.querySelector('.texto-buscar').textContent.toLowerCase();
                return text.includes(term);
            });
            currentPage = 1;
            displayRows(currentPage);
            setupPagination();
        };
    }

    displayRows(currentPage);
    setupPagination();
});


//Editar Categoria botton

function prepararEdicionCategoria(id, nombre) {
    const form = document.getElementById('form-categoria');
    const titulo = document.getElementById('cat-form-titulo');
    const subtitulo = document.getElementById('cat-form-subtitulo');
    const inputNombre = document.getElementById('cat_input_name');
    const metodoDiv = document.getElementById('cat-metodo-adicional');
    const btnSubmit = document.getElementById('cat-btn-submit');
    const btnCancelar = document.getElementById('cat-btn-cancelar');

    // 1. Cambiamos la ruta a la de UPDATE
    form.action = '/dashboard/categoryRegistration/' + id + '/update';

    // 2. Inyectamos el método PUT
    metodoDiv.innerHTML = '<input type="hidden" name="_method" value="PUT">';

    // 3. Rellenamos el campo
    inputNombre.value = nombre;

    // 4. Cambios visuales
    titulo.innerText = 'Editar Categoría';
    subtitulo.innerText = 'Modificando el nombre de la sección';
    btnSubmit.innerText = 'Actualizar Categoría';
    btnCancelar.classList.remove('hidden');

    // 5. Scroll al formulario
    window.scrollTo({top: 0, behavior: 'smooth'});
}

function cancelarEdicion() {
    location.reload(); // La forma más limpia de resetear todo el estado
}

document.addEventListener('DOMContentLoaded', function() {
    const selectProducto = document.getElementById('select-producto');
    const inputPrecioUnidad = document.getElementById('input-precio-unidad');
    const inputCantidad = document.getElementById('input-cantidad');
    const inputTotal = document.getElementById('input-total');

    function calcularPrecio() {
        const opcion = selectProducto.options[selectProducto.selectedIndex];

        if(opcion && opcion.value !== "") {
            // Saca el precio del data-precio de la opción de HTML
            const precio = parseFloat(opcion.getAttribute('data-precio'));
            inputPrecioUnidad.value = precio.toFixed(2);

            // Multiplica
            const cantidad = parseInt(inputCantidad.value) || 1;
            inputTotal.value = (precio * cantidad).toFixed(2);
        }
    }

    selectProducto.addEventListener('change', calcularPrecio);
    inputCantidad.addEventListener('input', calcularPrecio);
});

// -- SCRIPT PARA ABRIR Y CERRAR EL ACORDEÓN
function toggleDetalle(id) {
    const contenido = document.getElementById('detalle-' + id);
    const icono = document.getElementById('icon-' + id);

    if (contenido.classList.contains('hidden')) {
        // Abrir
        contenido.classList.remove('hidden');
        icono.style.transform = 'rotate(180deg)';
    } else {
        // Cerrar
        contenido.classList.add('hidden');
        icono.style.transform = 'rotate(0deg)';
    }
}

//Funcion de Editar Usuario
function editarUsuario(id, name, email, username, role_id) {
    // 1. Buscamos el formulario
    const form = document.getElementById('form-usuario');

    // 2. Cambiamos la ruta a la de UPDATE (según tu web.php)
    form.action = '/dashboard/userRegistration/' + id + '/update';

    // 3. Inyectamos el método PUT que Laravel necesita
    document.getElementById('metodo-adicional').innerHTML = '<input type="hidden" name="_method" value="PUT">';

    // 4. Rellenamos los campos usando los 'name' correctos de tu HTML
    form.querySelector('input[name="name"]').value = name;
    form.querySelector('input[name="email"]').value = email;
    form.querySelector('input[name="username"]').value = username;

    // Rellenamos el SELECT del Rol
    form.querySelector('select[name="role_id"]').value = role_id;

    // 5. Ajuste de contraseña (opcional para edición)
    let inputPass = form.querySelector('input[name="password"]');
    inputPass.value = "";
    inputPass.removeAttribute('required');
    inputPass.placeholder = "Dejar en blanco para no cambiar";

    // 6. Cambios visuales
    document.getElementById('form-titulo').innerText = 'Editar Usuario';
    document.getElementById('form-subtitulo').innerText = 'Modificando a: ' + name;
    document.getElementById('btn-submit').innerText = 'Actualizar Cambios';
    document.getElementById('btn-cancelar').classList.remove('hidden');

    // 7. Subir al formulario
    window.scrollTo({top: 0, behavior: 'smooth'});
}
function toggleDetalle(id) {
    const el = document.getElementById('detalle-' + id);
    const icon = document.getElementById('icon-' + id);
    if (el.classList.contains('hidden')) {
        el.classList.remove('hidden');
        icon.classList.add('rotate-180');
    } else {
        el.classList.add('hidden');
        icon.classList.remove('rotate-180');
    }
}
