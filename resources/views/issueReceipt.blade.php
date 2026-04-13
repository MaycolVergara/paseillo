<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Mesa {{ $sale->table_number }} - Paseillo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            body { background-color: white; margin: 0; padding: 0; }
            .no-print { display: none; }
            .ticket-container { box-shadow: none; width: 100%; max-width: 320px; margin: 0 auto; }
        }
    </style>
</head>
<body class="bg-gray-200 flex flex-col items-center py-10 font-mono text-gray-900">

    {{-- Botón de Imprimir (Solo visible en pantalla) --}}
    <div class="mb-6 no-print">
        <button onclick="window.print()"
            class="px-8 py-3 bg-gradient-to-r from-orange-500 to-red-600 text-white font-black rounded-xl shadow-lg shadow-orange-500/25 hover:scale-[1.02] active:scale-95 transition-all flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="6 9 6 2 18 2 18 9" />
                <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2" />
                <rect width="12" height="8" x="6" y="14" />
            </svg>
            IMPRIMIR TICKET
        </button>
    </div>

    {{-- Contenedor del Ticket (Diseño tipo rollo de papel) --}}
    <div class="ticket-container bg-white p-6 rounded-sm shadow-xl w-[320px] text-sm border-t-8 border-amber-500">

        {{-- Cabecera --}}
        <div class="text-center mb-5">
            <h1 class="font-black text-2xl mb-1">{{ $settings->company_name ?? 'PASEILLO' }}</h1>
            <p class="text-xs font-bold uppercase tracking-widest text-amber-600">Servicio Mesa</p>
            <p class="text-xs mt-3 bg-gray-100 py-1 rounded-md font-black italic">MESA: #{{ $sale->table_number }}</p>
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

        {{-- Total a Pagar --}}
        <div class="flex justify-between items-center font-black text-xl mb-6">
            <span>TOTAL:</span>
            <span>S/ {{ number_format($sale->total, 2) }}</span>
        </div>

        {{-- Pie de Ticket --}}
        <div class="text-center text-[10px] text-gray-500 border-t border-gray-200 pt-4">
            <p>¡Gracias por tu preferencia!</p>
            <p class="mt-1 font-bold italic underline">Vuelve pronto a Paseillo</p>
            <p class="mt-2 uppercase text-[8px] tracking-tighter opacity-70">Desarrollado por {{ $settings->company_name ?? 'Paseillo' }}</p>
        </div>
    </div>

</body>
</html>
