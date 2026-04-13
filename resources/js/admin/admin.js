// resources/js/admin/admin.js

window.toggleSidebar = function() {
    const sidebar = document.getElementById("sidebar");
    const mainArea = document.getElementById("main-area");
    const backdrop = document.getElementById("sidebar-backdrop");
    const isMobile = window.innerWidth < 1024;

    if (sidebar) {
        if (isMobile) {
            const isHidden = sidebar.classList.contains("-translate-x-full");
            if (isHidden) {
                sidebar.classList.remove("-translate-x-full");
                sidebar.classList.add("translate-x-0");
                if(backdrop) {
                    backdrop.classList.remove("hidden", "opacity-0", "pointer-events-none");
                    backdrop.classList.add("opacity-100");
                }
            } else {
                sidebar.classList.add("-translate-x-full");
                sidebar.classList.remove("translate-x-0");
                if(backdrop) {
                    backdrop.classList.add("opacity-0", "pointer-events-none");
                    setTimeout(() => backdrop.classList.add("hidden"), 300);
                }
            }
        } else {
            const collapsed = sidebar.classList.toggle("collapsed");
            if (mainArea) mainArea.style.marginLeft = collapsed ? "80px" : "288px";
            if (collapsed) {
                document.querySelectorAll(".submenu-wrapper.open").forEach((el) => el.classList.remove("open"));
                document.querySelectorAll(".nav-parent.open").forEach((el) => el.classList.remove("open"));
            }
            localStorage.setItem("paseillo-sidebar", collapsed ? "collapsed" : "expanded");
        }
    }
};

// Initial sidebar state
(function () {
    const state = localStorage.getItem("paseillo-sidebar");
    const isMobile = window.innerWidth < 1024;

    function initSidebar() {
        const sidebar = document.getElementById("sidebar");
        const mainArea = document.getElementById("main-area");
        if (sidebar && state === "collapsed" && !isMobile) {
            sidebar.classList.add("collapsed");
            if (mainArea) mainArea.style.marginLeft = "80px";
        }
    }

    if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", initSidebar);
    } else {
        initSidebar();
    }
})();

/**
 * Dark/Light Mode
 */
window.toggleTheme = function() {
    const html = document.documentElement;
    const isDark = html.classList.toggle("dark");
    html.classList.toggle("light", !isDark);
    localStorage.setItem("paseillo-theme", isDark ? "dark" : "light");
};

(function () {
    const saved = localStorage.getItem("paseillo-theme") || "light";
    document.documentElement.className = saved;
})();

/**
 * Accordions and Dropdowns
 */
window.toggleAccordion = function(btn) {
    const wrapper = btn.nextElementSibling;
    if (wrapper) {
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
}

window.toggleDropdown = function() {
    const profileDD = document.getElementById("profile-dropdown");
    if (profileDD) profileDD.classList.toggle("open");
}

document.addEventListener("click", (e) => {
    const profileWrap = document.getElementById("profile-wrap");
    const profileDD = document.getElementById("profile-dropdown");
    if (profileWrap && profileDD && !profileWrap.contains(e.target)) {
        profileDD.classList.remove("open");
    }
});

/**
 * Real-time Clock
 */
window.updateClock = function() {
    const clockTime = document.getElementById("clock-time");
    const clockDate = document.getElementById("clock-date");
    if (!clockTime || !clockDate) return;

    const DAYS = ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"];
    const MONTHS = ["ene", "feb", "mar", "abr", "may", "jun", "jul", "ago", "sep", "oct", "nov", "dic"];

    const now = new Date();
    const hh = String(now.getHours()).padStart(2, "0");
    const mm = String(now.getMinutes()).padStart(2, "0");
    const ss = String(now.getSeconds()).padStart(2, "0");

    clockTime.textContent = `${hh}:${mm}:${ss}`;
    clockDate.textContent = `${DAYS[now.getDay()]}, ${now.getDate()} ${MONTHS[now.getMonth()]} ${now.getFullYear()}`;
}

/**
 * Initialization
 */
function initAll() {
    updateClock();
    setInterval(updateClock, 1000);

    // Lucide initialization is now handled in the layout for better stability
    if (window.lucide) {
        window.lucide.createIcons();
    }

    // Active Link Highlighting
    let currentPath = window.location.pathname.split("/").pop();
    if (!currentPath || currentPath === "") currentPath = "dashboard";

    const activeLink = document.querySelector(`.nav-link[href*="${currentPath}"]`);
    if (activeLink) {
        document.querySelectorAll(".nav-link.active").forEach((el) => el.classList.remove("active"));
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
}

if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", initAll);
} else {
    initAll();
}

/**
 * Helpers / Global functions
 */
window.prepararEdicionCategoria = function(id, nombre) {
    const form = document.getElementById('form-categoria');
    const inputNombre = document.getElementById('cat_input_name');
    if (!form || !inputNombre) return;

    form.action = '/dashboard/categoryRegistration/' + id + '/update';
    const metodoDiv = document.getElementById('cat-metodo-adicional');
    if (metodoDiv) metodoDiv.innerHTML = '<input type="hidden" name="_method" value="PUT">';
    inputNombre.value = nombre;

    const titulo = document.getElementById('cat-form-titulo');
    const subtitulo = document.getElementById('cat-form-subtitulo');
    const btnSubmit = document.getElementById('cat-btn-submit');
    const btnCancelar = document.getElementById('cat-btn-cancelar');

    if (titulo) titulo.innerText = 'Editar Categoría';
    if (subtitulo) subtitulo.innerText = 'Modificando el nombre de la sección';
    if (btnSubmit) btnSubmit.innerText = 'Actualizar Categoría';
    if (btnCancelar) btnCancelar.classList.remove('hidden');
    window.scrollTo({top: 0, behavior: 'smooth'});
}

window.cancelarEdicion = function() {
    location.reload();
}

window.editarUsuario = function(id, name, email, username, role_id) {
    const form = document.getElementById('form-usuario');
    if (!form) return;

    form.action = '/dashboard/userRegistration/' + id + '/update';
    const metodoDiv = document.getElementById('metodo-adicional');
    if (metodoDiv) metodoDiv.innerHTML = '<input type="hidden" name="_method" value="PUT">';

    const inputName = form.querySelector('input[name="name"]');
    const inputEmail = form.querySelector('input[name="email"]');
    const inputUser = form.querySelector('input[name="username"]');
    const selectRole = form.querySelector('select[name="role_id"]');

    if (inputName) inputName.value = name;
    if (inputEmail) inputEmail.value = email;
    if (inputUser) inputUser.value = username;
    if (selectRole) selectRole.value = role_id;

    let inputPass = form.querySelector('input[name="password"]');
    if (inputPass) {
        inputPass.value = "";
        inputPass.removeAttribute('required');
        inputPass.placeholder = "Dejar en blanco para no cambiar";
    }

    const titulo = document.getElementById('form-titulo');
    const subtitulo = document.getElementById('form-subtitulo');
    const btnSubmit = document.getElementById('btn-submit');
    const btnCancelar = document.getElementById('btn-cancelar');

    if (titulo) titulo.innerText = 'Editar Usuario';
    if (subtitulo) subtitulo.innerText = 'Modificando a: ' + name;
    if (btnSubmit) btnSubmit.innerText = 'Actualizar Cambios';
    if (btnCancelar) btnCancelar.classList.remove('hidden');
    window.scrollTo({top: 0, behavior: 'smooth'});
}

window.toggleDetalle = function(id) {
    const contenido = document.getElementById('detalle-' + id);
    const icono = document.getElementById('icon-' + id);
    if (!contenido) return;

    if (contenido.classList.contains('hidden')) {
        contenido.classList.remove('hidden');
        if (icono) icono.classList.add('rotate-180');
    } else {
        contenido.classList.add('hidden');
        if (icono) icono.classList.remove('rotate-180');
    }
}
