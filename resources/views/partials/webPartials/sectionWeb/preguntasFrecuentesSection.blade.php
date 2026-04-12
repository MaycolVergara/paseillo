<!-- ══════════════ FAQ ══════════════ -->
<section id="preguntas" class="bg-brand-gray py-24">
    <div class="mx-auto max-w-3xl px-4 sm:px-6">
        <!-- Header -->
        <div class="mb-14 text-center">
            <div
                class="reveal bg-brand/10 border-brand/20 mb-5 inline-flex items-center gap-2 rounded-full border px-4 py-1.5"
            >
            <span class="font-condensed font-700 text-brand text-xs uppercase tracking-[3px]"
            >PREGUNTAS</span
            >
            </div>
            <h2
                class="reveal font-anton text-[clamp(32px,5vw,64px)] uppercase leading-none text-gray-900"
            >
                PREGUNTAS <span class="text-brand">FRECUENTES</span>
            </h2>
            <p class="reveal font-barlow mt-4 text-base text-gray-500">
                Todo lo que necesitas saber antes de pedir.
            </p>
        </div>

        <!-- FAQ Items -->
        <div class="flex flex-col gap-3" id="faqList">
            <div
                class="faq-item reveal d1 overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm transition-shadow duration-300 hover:shadow-md"
            >
                <button
                    onclick="toggleFaq(this)"
                    class="flex w-full items-center justify-between gap-4 px-6 py-5 text-left"
                >
              <span class="font-condensed font-800 text-base uppercase tracking-wide text-gray-900"
              >¿Cómo puedo hacer un pedido?</span
              >
                    <span
                        class="faq-icon text-brand flex-shrink-0 text-xl font-bold transition-transform duration-300"
                    >+</span
                    >
                </button>
                <div class="faq-body duration-400 max-h-0 overflow-hidden transition-[max-height]">
                    <p class="font-barlow px-6 pb-5 text-sm leading-relaxed text-gray-500">
                        Puedes pedir directamente por <strong class="text-brand">WhatsApp</strong> haciendo
                        clic en el botón flotante de la página o en cualquier botón "Ordenar ahora". Te
                        atendemos al instante y confirmamos tu pedido en minutos.
                    </p>
                </div>
            </div>

            <div
                class="faq-item reveal d2 overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm transition-shadow duration-300 hover:shadow-md"
            >
                <button
                    onclick="toggleFaq(this)"
                    class="flex w-full items-center justify-between gap-4 px-6 py-5 text-left"
                >
              <span class="font-condensed font-800 text-base uppercase tracking-wide text-gray-900"
              >¿Hacen delivery a domicilio?</span
              >
                    <span
                        class="faq-icon text-brand flex-shrink-0 text-xl font-bold transition-transform duration-300"
                    >+</span
                    >
                </button>
                <div class="faq-body duration-400 max-h-0 overflow-hidden transition-[max-height]">
                    <p class="font-barlow px-6 pb-5 text-sm leading-relaxed text-gray-500">
                        Sí, contamos con servicio de delivery en Huanta y alrededores. El tiempo de entrega
                        varía según tu ubicación. Consúltanos por WhatsApp para confirmar cobertura y
                        tiempos de entrega en tu zona.
                    </p>
                </div>
            </div>

            <div
                class="faq-item reveal d3 overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm transition-shadow duration-300 hover:shadow-md"
            >
                <button
                    onclick="toggleFaq(this)"
                    class="flex w-full items-center justify-between gap-4 px-6 py-5 text-left"
                >
              <span class="font-condensed font-800 text-base uppercase tracking-wide text-gray-900"
              >¿Cuáles son sus horarios de atención?</span
              >
                    <span
                        class="faq-icon text-brand flex-shrink-0 text-xl font-bold transition-transform duration-300"
                    >+</span
                    >
                </button>
                <div class="faq-body duration-400 max-h-0 overflow-hidden transition-[max-height]">
                    <p class="font-barlow px-6 pb-5 text-sm leading-relaxed text-gray-500">
                        Atendemos de
                        <strong class="text-gray-900">lunes a domingo de 12:00 pm a 10:00 pm</strong>. Los
                        fines de semana podemos extender el horario. Escríbenos si tienes dudas sobre
                        disponibilidad en fechas especiales.
                    </p>
                </div>
            </div>

            <div
                class="faq-item reveal d4 overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm transition-shadow duration-300 hover:shadow-md"
            >
                <button
                    onclick="toggleFaq(this)"
                    class="flex w-full items-center justify-between gap-4 px-6 py-5 text-left"
                >
              <span class="font-condensed font-800 text-base uppercase tracking-wide text-gray-900"
              >¿Puedo personalizar mi pedido?</span
              >
                    <span
                        class="faq-icon text-brand flex-shrink-0 text-xl font-bold transition-transform duration-300"
                    >+</span
                    >
                </button>
                <div class="faq-body duration-400 max-h-0 overflow-hidden transition-[max-height]">
                    <p class="font-barlow px-6 pb-5 text-sm leading-relaxed text-gray-500">
                        ¡Por supuesto! Puedes indicarnos ingredientes adicionales, nivel de picante, salsas
                        extra o cualquier modificación en tu pedido directamente por WhatsApp. Nos adaptamos
                        a tus preferencias.
                    </p>
                </div>
            </div>

            <div
                class="faq-item reveal overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm transition-shadow duration-300 hover:shadow-md"
            >
                <button
                    onclick="toggleFaq(this)"
                    class="flex w-full items-center justify-between gap-4 px-6 py-5 text-left"
                >
              <span class="font-condensed font-800 text-base uppercase tracking-wide text-gray-900"
              >¿Qué métodos de pago aceptan?</span
              >
                    <span
                        class="faq-icon text-brand flex-shrink-0 text-xl font-bold transition-transform duration-300"
                    >+</span
                    >
                </button>
                <div class="faq-body duration-400 max-h-0 overflow-hidden transition-[max-height]">
                    <p class="font-barlow px-6 pb-5 text-sm leading-relaxed text-gray-500">
                        Aceptamos <strong class="text-gray-900">efectivo</strong> y
                        <strong class="text-gray-900">transferencias bancarias / Yape / Plin</strong>. Al
                        confirmar tu pedido te indicamos los datos para el pago según tu preferencia.
                    </p>
                </div>
            </div>

            <div
                class="faq-item reveal overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm transition-shadow duration-300 hover:shadow-md"
            >
                <button
                    onclick="toggleFaq(this)"
                    class="flex w-full items-center justify-between gap-4 px-6 py-5 text-left"
                >
              <span class="font-condensed font-800 text-base uppercase tracking-wide text-gray-900"
              >¿Los ingredientes son frescos?</span
              >
                    <span
                        class="faq-icon text-brand flex-shrink-0 text-xl font-bold transition-transform duration-300"
                    >+</span
                    >
                </button>
                <div class="faq-body duration-400 max-h-0 overflow-hidden transition-[max-height]">
                    <p class="font-barlow px-6 pb-5 text-sm leading-relaxed text-gray-500">
                        100%. En Paseillo usamos ingredientes frescos y de calidad en cada preparación.
                        Nuestras pizzas tienen masa artesanal, las hamburguesas llevan carne fresca y
                        nuestras salchipapas se preparan al momento. Sin congelados, sin compromisos.
                    </p>
                </div>
            </div>
        </div>

        <!-- CTA -->
        <div class="reveal mt-12 text-center">
            <p class="font-barlow mb-4 text-sm text-gray-400">
                ¿Tienes otra pregunta? Escríbenos directamente.
            </p>
            <a
                href="#"
                target="_blank"
                class="bg-brand hover:bg-brand-dark font-condensed font-800 inline-flex items-center gap-2 rounded-full px-8 py-4 text-sm uppercase tracking-widest text-white shadow-[0_6px_24px_rgba(227,6,19,0.35)] transition-all duration-300 hover:-translate-y-0.5 hover:shadow-[0_10px_30px_rgba(227,6,19,0.45)]"
            >
                <img src="/icon/whatsapp.png" alt="WhatsApp" class="w-9 h-9"> Pregúntanos por WhatsApp
            </a>
        </div>
    </div>
</section>
