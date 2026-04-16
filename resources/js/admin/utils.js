/**
 * Helpers / Global functions for Admin Dashboard
 */
export function initUtils() {
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
    };

    window.cancelarEdicion = function() {
        location.reload();
    };

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
    };

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
    };

    window.marcarPagado = function(btn, staffId) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        if (!csrfToken) {
            console.error('CSRF token not found');
            return;
        }

        let w = btn.offsetWidth;
        btn.style.width = w + 'px';
        btn.innerHTML = '<i data-lucide="loader-2" class="animate-spin h-3.5 w-3.5 inline"></i>';
        if(window.lucide) window.lucide.createIcons();

        fetch(`/dashboard/staffReport/pay/${staffId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                let container = btn.parentElement;
                container.innerHTML = '<span class="text-[11px] font-bold text-emerald-500/80 italic">—</span>';

                let row = container.closest('tr');
                let cells = row.querySelectorAll('td');
                if (cells.length >= 7) {
                    let estadoTd = cells[6];
                    estadoTd.innerHTML = `
                        <span class="animate-in fade-in zoom-in duration-300 inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-[10px] font-black uppercase tracking-wider bg-emerald-100 text-emerald-700 dark:bg-emerald-500/20 border border-emerald-200 dark:border-emerald-500/30">
                            <i data-lucide="check" class="w-2.5 h-2.5"></i> Pagado
                        </span>
                    `;
                    if(window.lucide) window.lucide.createIcons();
                }
            } else {
                alert('Error: ' + (data.message || 'No se pudo registrar el pago.'));
                btn.innerHTML = 'Pagar';
                if(window.lucide) window.lucide.createIcons();
            }
        })
        .catch(error => {
            alert('Hubo un error al registrar el pago');
            console.error(error);
            btn.innerHTML = 'Pagar';
            if(window.lucide) window.lucide.createIcons();
        });
    };
}
