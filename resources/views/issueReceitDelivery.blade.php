<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Delivery #{{ $id }} - Paseillo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        /* === ESTILOS EXCLUSIVOS PARA LA IMPRESORA TÉRMICA === */
        @media print {
            /* 1. Reset total de la página */
            @page {
                margin: 0;
            }
            body, html {
                margin: 0 !important;
                padding: 0 !important;
                background-color: white !important;
                /* Forzamos al body a centrar todo su contenido */
                width: 100% !important;
                display: flex !important;
                justify-content: center !important;
            }

            .no-print { display: none !important; }

            /* 2. EL CONTENEDOR CON EL ANCHO REAL DE IMPRESIÓN (72mm) */
            .ticket-container {
                box-shadow: none !important;
                width: 72mm !important; /* El ancho exacto del cabezal térmico */
                max-width: 72mm !important;
                margin: 0 !important;
                padding: 2mm 3mm !important; /* Equilibrio de respiro a los lados */
                border: none !important;
                box-sizing: border-box !important;
            }

            .text-center {
                width: 100% !important;
                text-align: center !important;
            }

            /* 3. Nitidez y Negro Puro */
            * {
                color: #000000 !important;
                font-weight: 700 !important;
                -webkit-font-smoothing: none !important;
                text-rendering: optimizeLegibility !important;
            }

            /* Forzar que las líneas separadoras y bordes rojos sean negros */
            .border-gray-400, .border-gray-300, .border-gray-100, .border-red-500 {
                border-color: #000000 !important;
            }

            .bg-gray-100 {
                background-color: transparent !important;
            }
        }
    </style>
</head>
<body class="bg-gray-200 flex flex-col items-center py-10 font-mono text-gray-900">

{{-- Botón de Imprimir (Solo visible en pantalla) --}}
<div class="mb-6 no-print">
    <button onclick="window.print()"
            class="px-8 py-3 bg-gradient-to-r from-orange-500 to-red-600 text-white font-black rounded-xl shadow-lg shadow-orange-500/25 hover:scale-[1.02] active:scale-95 transition-all flex items-center gap-2">
        <i data-lucide="printer" class="w-5 h-5"></i>
        IMPRIMIR DELIVERY
    </button>
</div>

{{-- Contenedor del Ticket (Diseño tipo rollo de papel) --}}
<div class="ticket-container bg-white p-6 rounded-sm shadow-xl w-[320px] text-sm border-t-8 border-red-500">

    {{-- Cabecera --}}
    <div class="text-center mb-5">
        <h1 class="font-black text-2xl mb-1">{{ $settings->company_name ?? 'PASEILLO' }}</h1>
        <p class="text-xs font-bold uppercase tracking-widest text-red-600">Servicio Delivery</p>
        <p class="text-xs mt-3 bg-gray-100 py-1 rounded-md font-black italic">DELIVERY: #{{ $id }}</p>
        <p class="text-[10px] text-gray-500 mt-2">Fecha: {{ \Carbon\Carbon::parse($sale->date)->format('d/m/Y H:i') }}</p>
    </div>

    <div class="border-b-2 border-dashed border-gray-400 mb-4"></div>

    {{-- Tabla de Productos --}}
    <table class="w-full mb-4">
        <thead>
        <tr class="border-b border-gray-300 text-[10px]">
            <th class="text-left pb-2 w-8">CANT</th>
            <th class="text-left pb-2">DESCRIPCIÓN</th>
            <th class="text-right pb-2">TOTAL</th>
        </tr>
        </thead>
        <tbody class="text-xs">
        @foreach ($saleDetails as $detalle)
            @php
                $nombre = $detalle->product ? $detalle->product->name : 'Desconocido';
            @endphp
            <tr class="border-b border-gray-100">
                <td class="py-2 align-top font-bold">{{ $detalle->quantity }}</td>
                <td class="py-2 px-1 pr-2 leading-tight">
                    {{ $nombre }}
                    @if ($detalle->customization)
                        <br><span class="text-[9px] text-gray-500 italic">({{ $detalle->customization }})</span>
                    @endif
                </td>
                <td class="py-2 text-right align-top font-black">S/ {{ number_format($detalle->subtotal, 2) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="border-b-2 border-dashed border-gray-400 mb-4"></div>

    {{-- Total a Pagar (Alineado a la derecha como en Mesas) --}}
    <div class="text-right font-black text-xl mb-6 w-full pr-1">
        <span class="mr-3">TOTAL:</span>
        <span>S/ {{ number_format($sale->total, 2) }}</span>
    </div>

    {{-- Pie de Ticket --}}
    <div class="text-center text-[10px] text-gray-500 border-t border-gray-200 pt-4">
        <p>*** TICKET DE DELIVERY ***</p>
        <p class="mt-1 font-bold italic underline">¡Gracias por tu pedido!</p>
        <p class="mt-1 uppercase">Paseillo Burger & Pizzas</p>
        <p class="mt-2 uppercase text-[8px] tracking-tighter opacity-70">Desarrollado por {{ $settings->company_name ?? 'Paseillo' }}</p>
    </div>
</div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
