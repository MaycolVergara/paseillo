@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto py-8">
        {{-- El formulario ahora apunta a la ruta de almacenamiento --}}
        <form action="{{ url('/dashboard/customerBallot/store') }}" method="POST">
            @csrf
            {{-- Vínculo vital con la venta actual --}}
            <input type="hidden" name="sale_id" value="{{ $sale->id }}" data-table-id="{{ $table_id }}" data-is-delivery="{{ $isDelivery ? '1' : '0' }}">

            <div
                class="bg-white dark:bg-gray-900 shadow-2xl rounded-3xl overflow-hidden border border-gray-100 dark:border-gray-800">

                {{-- ENCABEZADO --}}
                <div class="bg-gradient-to-r from-orange-500 to-red-600 p-6">
                    <div class="flex items-center justify-between">
                        <h3 class="text-white font-black uppercase tracking-tighter text-xl flex items-center gap-3">
                            <i data-lucide="receipt" class="w-7 h-7"></i>
                            Finalizar Comprobante
                        </h3>
                        <span
                            class="bg-white/20 text-white text-xs font-bold px-4 py-1 rounded-full backdrop-blur-md border border-white/30">
                            {{ $isDelivery ? 'Delivery' : 'Mesa' }} #{{ $sale->table_number ?? 'S/N' }}
                        </span>
                    </div>
                </div>

                <div class="p-6 md:p-8">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

                        {{-- COLUMNA IZQUIERDA: FORMULARIO --}}
                        <div class="lg:col-span-7 space-y-6">
                            <div class="flex items-center gap-2 pb-2 border-b border-gray-100 dark:border-gray-800">
                                <i data-lucide="user" class="w-4 h-4 text-orange-500"></i>
                                <span class="text-sm font-bold text-gray-400 uppercase tracking-widest">Información del
                                    Cliente</span>
                            </div>

                            {{-- Búsqueda de DNI --}}
                            <div class="flex gap-2">
                                <div class="relative flex-1">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i data-lucide="search" class="w-4 h-4 text-gray-400"></i>
                                    </div>
                                    <input type="text" id="customer_dni" name="customer_dni" maxlength="8" required
                                        class="block w-full pl-10 pr-3 py-3 bg-gray-50 dark:bg-gray-800 border-none rounded-2xl text-sm font-bold focus:ring-2 focus:ring-orange-500 transition-all shadow-sm"
                                        placeholder="Ingrese DNI">
                                </div>
                                <button type="button" id="btnBuscar"
                                    class="px-6 bg-gray-900 dark:bg-orange-600 text-white font-black rounded-2xl hover:scale-105 active:scale-95 transition-all shadow-lg flex items-center gap-2 group">
                                    <span>BUSCAR</span>
                                    <i data-lucide="zap" class="w-4 h-4 fill-current"></i>
                                </button>
                            </div>

                            {{-- Inputs de Nombres --}}
                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-1">
                                    <label class="text-[10px] font-black text-gray-400 uppercase ml-2">Nombres</label>
                                    <input type="text" id="customer_name" name="customer_name" readonly required
                                        class="w-full p-3 bg-gray-100/50 dark:bg-gray-800/50 border-none rounded-xl text-sm font-semibold text-gray-500 cursor-not-allowed">
                                </div>
                                <div class="space-y-1">
                                    <label class="text-[10px] font-black text-gray-400 uppercase ml-2">Apellidos</label>
                                    <input type="text" id="customer_surname" name="customer_surname" readonly required
                                        class="w-full p-3 bg-gray-100/50 dark:bg-gray-800/50 border-none rounded-xl text-sm font-semibold text-gray-500 cursor-not-allowed">
                                </div>
                            </div>

                            <div class="space-y-1">
                                <label class="text-[10px] font-black text-gray-400 uppercase ml-2">WhatsApp (Envío
                                    digital)</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i data-lucide="phone" class="w-4 h-4 text-green-500"></i>
                                    </div>
                                    <input type="text" id="customer_phone" name="customer_phone" maxlength="9"
                                        class="block w-full pl-10 p-3 bg-gray-50 dark:bg-gray-800
                                           border-none rounded-xl text-sm font-bold focus:ring-2 focus:ring-green-500 transition-all"
                                        placeholder="Ej: 987654321" required>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4 pt-4">
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-gray-400 uppercase ml-2">Formato
                                        Impresión</label>

                                    <select id="print_format_select" name="print_format"
                                        class="w-full p-3 bg-white dark:bg-gray-800 border-2 border-gray-100 dark:border-gray-700 rounded-xl text-sm font-bold focus:border-orange-500 transition-all cursor-pointer">
                                        <option value="detailed">Detallado (Lista)</option>
                                        <option value="consumption">Por Consumo (Resumen)</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        {{-- COLUMNA DERECHA: TICKET VISUAL --}}
                        <div class="lg:col-span-5">
                            <div
                                class="bg-gray-50 dark:bg-gray-800/40 rounded-3xl p-6 border border-gray-100 dark:border-gray-800 shadow-inner">

                                <div
                                    class="text-center mb-6 border-b-2 border-dashed border-gray-200 dark:border-gray-700 pb-4">
                                    <h1
                                        class="font-black text-xl text-gray-800 dark:text-white leading-none tracking-tighter">
                                        PASEILLO</h1>
                                    <p class="text-[10px] font-bold text-gray-500 uppercase">Pizzas & Burgers</p>
                                    <p class="text-[9px] text-gray-400 font-medium">JR. GERVASIO SANTILLANA 120</p>
                                    <p class="text-[9px] text-gray-400 font-medium">HUANTA - AYACUCHO</p>

                                    <div
                                        class="mt-4 text-left bg-white dark:bg-gray-900 p-3 rounded-xl space-y-1 border border-gray-100 dark:border-gray-700 shadow-sm">
                                        <p class="text-[10px] text-gray-400 font-bold uppercase">Fecha: <span
                                                class="text-gray-800 dark:text-gray-200">{{ now()->format('d/m/Y H:i') }}</span>
                                        </p>
                                        <p class="text-[10px] text-gray-400 font-bold uppercase">Cliente: <span
                                                id="display_name" class="text-gray-800 dark:text-gray-200">---</span>
                                        </p>
                                        <p class="text-[10px] text-gray-400 font-bold uppercase">DNI: <span id="display_dni"
                                                class="text-gray-800 dark:text-gray-200">---</span></p>
                                        <p class="text-[10px] text-gray-400 font-bold uppercase">Moneda: <span
                                                class="text-gray-800 dark:text-gray-200">SOLES</span></p>
                                    </div>
                                </div>

                                {{-- LISTA DE PRODUCTOS --}}
                                <div class="max-h-[250px] overflow-y-auto mb-6 pr-2 custom-scrollbar">
                                    <table class="w-full">
                                        <thead>
                                            <tr
                                                class="text-[9px] font-black text-gray-400 uppercase tracking-wider border-b border-gray-100 dark:border-gray-700">
                                                <th class="text-left pb-2">CANT</th>
                                                <th class="text-left pb-2 px-2">DESCRIPCIÓN</th>
                                                <th class="text-right pb-2">TOTAL</th>
                                            </tr>
                                        </thead>

                                        {{-- VISTA DETALLADA (Visible por defecto) --}}
                                        <tbody id="ticket_detailed" class="divide-y divide-gray-100 dark:divide-gray-800">
                                            @foreach ($saleDetails as $detalle)
                                                <tr>
                                                    <td class="py-3 text-xs font-black text-gray-400">
                                                        {{ $detalle->quantity }}</td>
                                                    <td class="py-3 px-2">
                                                        <span
                                                            class="text-xs font-bold text-gray-800 dark:text-gray-200 uppercase leading-tight">
                                                            {{ $detalle->product->name ?? 'Producto' }}
                                                        </span>
                                                    </td>
                                                    <td class="py-3 text-right">
                                                        <span class="text-xs font-black text-gray-900 dark:text-white">
                                                            S/ {{ number_format($detalle->subtotal, 2) }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>

                                        {{-- VISTA POR CONSUMO (Oculta por defecto con style="display: none;") --}}
                                        <tbody id="ticket_consumption"
                                            class="divide-y divide-gray-100 dark:divide-gray-800" style="display: none;">
                                            <tr>
                                                <td class="py-3 text-xs font-black text-gray-400">1</td>
                                                <td class="py-3 px-2">
                                                    <span
                                                        class="text-xs font-bold text-gray-800 dark:text-gray-200 uppercase leading-tight">
                                                        POR CONSUMO
                                                    </span>
                                                </td>
                                                <td class="py-3 text-right">
                                                    <span class="text-xs font-black text-gray-900 dark:text-white">
                                                        S/ {{ number_format($sale->total, 2) }}
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                {{-- TOTALES con IGV 18% --}}
                                @php
                                    $totalVenta = $sale->total;
                                    $baseImponible = round($totalVenta / 1.18, 2);
                                    $igv = round($totalVenta - $baseImponible, 2);
                                @endphp
                                <div class="space-y-2 pt-4 border-t-2 border-dashed border-gray-200 dark:border-gray-700">
                                    <div class="flex justify-between text-gray-400 font-bold text-[10px] uppercase">
                                        <span>Base Imponible</span>
                                        <span>S/ {{ number_format($baseImponible, 2) }}</span>
                                    </div>
                                    <div class="flex justify-between text-gray-400 font-bold text-[10px] uppercase">
                                        <span>IGV (18%)</span>
                                        <span>S/ {{ number_format($igv, 2) }}</span>
                                    </div>
                                    <div class="flex justify-between items-center pt-2">
                                        <span
                                            class="text-sm font-black text-gray-800 dark:text-white uppercase tracking-tighter">Total
                                            a Pagar</span>
                                        <span class="text-2xl font-black text-orange-500">S/
                                            {{ number_format($totalVenta, 2) }}</span>
                                    </div>
                                </div>

                                {{-- BOTONES --}}
                                <div class="space-y-3 mt-8">
                                    {{-- Botón Guardar Cliente --}}
                                    <button type="button" id="btnGuardarCliente"
                                        class="w-full bg-gradient-to-r from-green-600 to-emerald-700 hover:from-green-700 hover:to-emerald-800 text-white font-black py-4 rounded-2xl shadow-xl shadow-green-500/20 transition-all transform hover:scale-[1.02] active:scale-95 flex items-center justify-center gap-3">
                                        <i data-lucide="save" class="w-6 h-6"></i>
                                        GUARDAR CLIENTE
                                    </button>

                                    {{-- Botón Generar PDF (Oculto inicialmente) --}}
                                    <button type="button" id="btnGenerarPdf"
                                        class="w-full bg-gradient-to-r from-blue-600 to-indigo-700 hover:from-blue-700 hover:to-indigo-800 text-white font-black py-4 rounded-2xl shadow-xl shadow-blue-500/20 transition-all transform hover:scale-[1.02] active:scale-95 flex items-center justify-center gap-3 hidden"
                                        style="display: none;">
                                        <i data-lucide="file-text" class="w-6 h-6"></i>
                                        GENERAR PDF
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    {{-- SCRIPTS --}}
    <script>
        const btnBuscar = document.getElementById("btnBuscar");
        const btnGuardarCliente = document.getElementById("btnGuardarCliente");
        const btnGenerarPdf = document.getElementById("btnGenerarPdf");

        if (btnBuscar) {
            btnBuscar.addEventListener("click", consultardatos);
        }

        if (btnGuardarCliente) {
            btnGuardarCliente.addEventListener("click", guardarCliente);
        }

        if (btnGenerarPdf) {
            btnGenerarPdf.addEventListener("click", generarPdf);
        }
        document.addEventListener('DOMContentLoaded', function() {
            const selectFormat = document.getElementById('print_format_select');
            const tableDetailed = document.getElementById('ticket_detailed');
            const tableConsumption = document.getElementById('ticket_consumption');

            if (selectFormat) {
                selectFormat.addEventListener('change', function() {
                    if (this.value === 'consumption') {
                        // Ocultar detallado, mostrar consumo
                        tableDetailed.style.display = 'none';
                        tableConsumption.style.display =
                        'table-row-group'; // Es el display correcto para tbody
                    } else {
                        // Mostrar detallado, ocultar consumo
                        tableDetailed.style.display = 'table-row-group';
                        tableConsumption.style.display = 'none';
                    }
                });
            }
        });

        function consultardatos() {
            const inputDni = document.getElementById("customer_dni");
            const inputNombre = document.getElementById("customer_name");
            const inputApellido = document.getElementById("customer_surname");
            const displayName = document.getElementById("display_name");
            const displayDni = document.getElementById("display_dni");

            const dni = inputDni.value.trim();

            if (dni.length !== 8) {
                alert("Por favor, ingrese un DNI de 8 dígitos");
                return;
            }

            // Estado visual de carga
            inputNombre.value = "Buscando...";
            inputApellido.value = "Buscando...";

            const token = "9ab0c3b3b29b50a04d673ba8061795f130fec7d90be8e8625bc4a48db0274fb0";
            const url = "https://api.consultasperu.com/api/v1/query";

            fetch(url, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json"
                    },
                    body: JSON.stringify({
                        "token": token,
                        "type_document": "dni",
                        "document_number": dni
                    })
                })
                .then(response => response.json())
                .then(datos => {
                    if (datos.success && datos.data) {
                        // 1. Llenamos los inputs ocultos/read-only del form
                        inputNombre.value = datos.data.name;
                        inputApellido.value = datos.data.surname;

                        // 2. Actualizamos el ticket visual de la derecha
                        displayName.innerText = datos.data.name + " " + datos.data.surname;
                        displayDni.innerText = dni;
                    } else {
                        alert("DNI no encontrado");
                        inputNombre.value = "";
                        inputApellido.value = "";
                        displayName.innerText = "---";
                        displayDni.innerText = "---";
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    alert("Error de conexión. Revisa la consola.");
                    inputNombre.value = "";
                    inputApellido.value = "";
                });
        }

        function guardarCliente() {
            const dni = document.getElementById("customer_dni").value.trim();
            const nombre = document.getElementById("customer_name").value.trim();
            const apellido = document.getElementById("customer_surname").value.trim();
            const telefono = document.getElementById("customer_phone").value.trim();

            if (!dni || !nombre || !apellido) {
                alert("Por favor completa todos los campos requeridos");
                return;
            }

            if (dni.length !== 8) {
                alert("El DNI debe tener 8 dígitos");
                return;
            }

            // Mostrar estado de carga
            btnGuardarCliente.disabled = true;
            btnGuardarCliente.innerHTML =
                '<svg class="animate-spin h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Guardando...';

            // Enviar datos al servidor
            fetch('/dashboard/customerBallot/saveClient', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                    },
                    body: JSON.stringify({
                        customer_dni: dni,
                        customer_name: nombre,
                        customer_surname: apellido,
                        customer_phone: telefono
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('✅ Cliente guardado correctamente');
                        // Mostrar botón de generar PDF
                        btnGenerarPdf.style.display = 'flex';
                        btnGuardarCliente.style.display = 'none';
                    } else {
                        alert('❌ Error: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('❌ Error al guardar cliente');
                })
                .finally(() => {
                    btnGuardarCliente.disabled = false;
                    btnGuardarCliente.innerHTML = '<i data-lucide="save" class="w-6 h-6"></i> GUARDAR CLIENTE';
                });
        }

        function generarPdf() {
            const saleId = document.querySelector('input[name="sale_id"]').value;
            const tableId = document.querySelector('input[name="sale_id"]').dataset.tableId;
            const dni = document.getElementById("customer_dni").value.trim();
            const nombre = document.getElementById("customer_name").value.trim();
            const apellido = document.getElementById("customer_surname").value.trim();
            const telefono = document.getElementById("customer_phone").value.trim();
            const printFormat = document.querySelector('select[name="print_format"]').value;

            // Mostrar estado de carga
            btnGenerarPdf.disabled = true;
            btnGenerarPdf.innerHTML =
                '<svg class="animate-spin h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Generando PDF...';

            // Crear formulario oculto para descargar PDF
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '/dashboard/customerBallot/generatePdf';
            form.style.display = 'none';

            const fields = {
                '_token': document.querySelector('meta[name="csrf-token"]')?.content || '',
                'sale_id': saleId,
                'customer_dni': dni,
                'customer_name': nombre,
                'customer_surname': apellido,
                'customer_phone': telefono,
                'print_format': printFormat
            };

            for (let key in fields) {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = key;
                input.value = fields[key];
                form.appendChild(input);
            }

            document.body.appendChild(form);
            form.submit();

            // Redirigir después de 3 segundos al origen correcto
            const isDelivery = document.querySelector('input[name="sale_id"]').dataset.isDelivery === '1';
            setTimeout(() => {
                window.location.href = isDelivery
                    ? '/dashboard/tableOrderDetailsDelyvery/' + tableId
                    : '/dashboard/tableOrderDetails/' + tableId;
                document.body.removeChild(form);
            }, 3000);

            btnGenerarPdf.disabled = false;
            btnGenerarPdf.innerHTML = '<i data-lucide="file-text" class="w-6 h-6"></i> GENERAR PDF';
        }
    </script>
@endsection
