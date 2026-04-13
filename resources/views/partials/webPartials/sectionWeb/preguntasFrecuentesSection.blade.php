<!-- ══════════════ FAQ ══════════════ -->
<section
    id="faq"
    class="py-24 bg-brand-gray"
>
    <div class="max-w-3xl mx-auto px-4 sm:px-6">
        <!-- Header -->
        <div class="text-center mb-14">
            <div
                class="reveal inline-flex items-center gap-2 bg-brand/10 border border-brand/20 rounded-full px-4 py-1.5 mb-5"
            >
            <span class="font-condensed text-xs font-700 tracking-[3px] text-brand uppercase"
            >FAQ</span
            >
            </div>
            <h2
                class="reveal font-anton text-[clamp(32px,5vw,64px)] text-gray-900 uppercase leading-none"
            >
                PREGUNTAS <span class="text-brand">FRECUENTES</span>
            </h2>
            <p class="reveal font-barlow text-gray-500 mt-4 text-base">
                Todo lo que necesitas saber antes de pedir.
            </p>
        </div>

        <!-- FAQ Items -->
        <div
            class="flex flex-col gap-3"
            id="faqList"
        >
            <div
                class="faq-item reveal d1 bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300"
            >
                <button
                    onclick="toggleFaq(this)"
                    class="w-full flex items-center justify-between px-6 py-5 text-left gap-4"
                >
              <span class="font-condensed font-800 text-base text-gray-900 uppercase tracking-wide"
              >¿Cómo puedo hacer un pedido?</span
              >
                    <span
                        class="faq-icon text-brand text-xl font-bold transition-transform duration-300 flex-shrink-0"
                    >+</span
                    >
                </button>
                <div class="faq-body max-h-0 overflow-hidden transition-[max-height] duration-400">
                    <p class="font-barlow text-gray-500 text-sm leading-relaxed px-6 pb-5">
                        Puedes pedir directamente por <strong class="text-brand">WhatsApp</strong> haciendo
                        clic en el botón flotante de la página o en cualquier botón "Ordenar ahora". Te
                        atendemos al instante y confirmamos tu pedido en minutos.
                    </p>
                </div>
            </div>

            <div
                class="faq-item reveal d2 bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300"
            >
                <button
                    onclick="toggleFaq(this)"
                    class="w-full flex items-center justify-between px-6 py-5 text-left gap-4"
                >
              <span class="font-condensed font-800 text-base text-gray-900 uppercase tracking-wide"
              >¿Hacen delivery a domicilio?</span
              >
                    <span
                        class="faq-icon text-brand text-xl font-bold transition-transform duration-300 flex-shrink-0"
                    >+</span
                    >
                </button>
                <div class="faq-body max-h-0 overflow-hidden transition-[max-height] duration-400">
                    <p class="font-barlow text-gray-500 text-sm leading-relaxed px-6 pb-5">
                        Sí, contamos con servicio de delivery en Huanta y alrededores. El tiempo de entrega
                        varía según tu ubicación. Consúltanos por WhatsApp para confirmar cobertura y
                        tiempos de entrega en tu zona.
                    </p>
                </div>
            </div>

            <div
                class="faq-item reveal d3 bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300"
            >
                <button
                    onclick="toggleFaq(this)"
                    class="w-full flex items-center justify-between px-6 py-5 text-left gap-4"
                >
              <span class="font-condensed font-800 text-base text-gray-900 uppercase tracking-wide"
              >¿Cuáles son sus horarios de atención?</span
              >
                    <span
                        class="faq-icon text-brand text-xl font-bold transition-transform duration-300 flex-shrink-0"
                    >+</span
                    >
                </button>
                <div class="faq-body max-h-0 overflow-hidden transition-[max-height] duration-400">
                    <p class="font-barlow text-gray-500 text-sm leading-relaxed px-6 pb-5">
                        Atendemos de
                        <strong class="text-gray-900">lunes a domingo de 12:00 pm a 10:00 pm</strong>. Los
                        fines de semana podemos extender el horario. Escríbenos si tienes dudas sobre
                        disponibilidad en fechas especiales.
                    </p>
                </div>
            </div>

            <div
                class="faq-item reveal d4 bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300"
            >
                <button
                    onclick="toggleFaq(this)"
                    class="w-full flex items-center justify-between px-6 py-5 text-left gap-4"
                >
              <span class="font-condensed font-800 text-base text-gray-900 uppercase tracking-wide"
              >¿Puedo personalizar mi pedido?</span
              >
                    <span
                        class="faq-icon text-brand text-xl font-bold transition-transform duration-300 flex-shrink-0"
                    >+</span
                    >
                </button>
                <div class="faq-body max-h-0 overflow-hidden transition-[max-height] duration-400">
                    <p class="font-barlow text-gray-500 text-sm leading-relaxed px-6 pb-5">
                        ¡Por supuesto! Puedes indicarnos ingredientes adicionales, nivel de picante, salsas
                        extra o cualquier modificación en tu pedido directamente por WhatsApp. Nos adaptamos
                        a tus preferencias.
                    </p>
                </div>
            </div>

            <div
                class="faq-item reveal bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300"
            >
                <button
                    onclick="toggleFaq(this)"
                    class="w-full flex items-center justify-between px-6 py-5 text-left gap-4"
                >
              <span class="font-condensed font-800 text-base text-gray-900 uppercase tracking-wide"
              >¿Qué métodos de pago aceptan?</span
              >
                    <span
                        class="faq-icon text-brand text-xl font-bold transition-transform duration-300 flex-shrink-0"
                    >+</span
                    >
                </button>
                <div class="faq-body max-h-0 overflow-hidden transition-[max-height] duration-400">
                    <p class="font-barlow text-gray-500 text-sm leading-relaxed px-6 pb-5">
                        Aceptamos <strong class="text-gray-900">efectivo</strong> y
                        <strong class="text-gray-900">transferencias bancarias / Yape / Plin</strong>. Al
                        confirmar tu pedido te indicamos los datos para el pago según tu preferencia.
                    </p>
                </div>
            </div>

            <div
                class="faq-item reveal bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300"
            >
                <button
                    onclick="toggleFaq(this)"
                    class="w-full flex items-center justify-between px-6 py-5 text-left gap-4"
                >
              <span class="font-condensed font-800 text-base text-gray-900 uppercase tracking-wide"
              >¿Los ingredientes son frescos?</span
              >
                    <span
                        class="faq-icon text-brand text-xl font-bold transition-transform duration-300 flex-shrink-0"
                    >+</span
                    >
                </button>
                <div class="faq-body max-h-0 overflow-hidden transition-[max-height] duration-400">
                    <p class="font-barlow text-gray-500 text-sm leading-relaxed px-6 pb-5">
                        100%. En Paseillo usamos ingredientes frescos y de calidad en cada preparación.
                        Nuestras pizzas tienen masa artesanal, las hamburguesas llevan carne fresca y
                        nuestras salchipapas se preparan al momento. Sin congelados, sin compromisos.
                    </p>
                </div>
            </div>
        </div>

        <!-- CTA -->
        <div class="reveal text-center mt-12">
            <p class="font-barlow text-gray-400 text-sm mb-4">
                ¿Tienes otra pregunta? Escríbenos directamente.
            </p>
            <a
                href="https://wa.me/51000000000?text=Hola%20Paseillo%2C%20tengo%20una%20pregunta"
                target="_blank"
                class="inline-flex items-center gap-2 bg-brand hover:bg-brand-dark text-white font-condensed font-800 text-sm uppercase tracking-widest px-8 py-4 rounded-full shadow-[0_6px_24px_rgba(227,6,19,0.35)] hover:-translate-y-0.5 hover:shadow-[0_10px_30px_rgba(227,6,19,0.45)] transition-all duration-300"
            >
                <img
                    src="icon/whatsapp.png"
                    alt="Paseillo Pizzas & Burger"
                    class="h-8 w-a8 object-contain"
                /> Pregúntanos por WhatsApp
            </a>
        </div>
    </div>
</section>
