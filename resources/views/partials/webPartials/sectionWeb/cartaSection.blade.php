<!-- ══════════════ LA CARTA ══════════════ -->
<section id="carta" class="py-24 relative overflow-hidden" style="background-color: #0f0f0f">
    <!-- Fondo con textura de cuadrícula sutil -->
    <div class="absolute inset-0 pointer-events-none" style="background-image: linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px), linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px); background-size: 48px 48px"></div>
    <!-- Glows de color -->
    <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-brand/10 rounded-full blur-[140px] pointer-events-none -translate-x-1/2 -translate-y-1/3"></div>
    <div class="absolute bottom-0 right-0 w-[400px] h-[400px] bg-brand/8 rounded-full blur-[120px] pointer-events-none translate-x-1/3 translate-y-1/3"></div>
    <!-- Texto fantasma de fondo -->
    <div class="absolute inset-0 flex items-center justify-center pointer-events-none select-none overflow-hidden">
        <span class="font-anton text-[220px] text-white/[0.02] uppercase tracking-widest leading-none whitespace-nowrap">PASEILLO</span>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- Header -->
        <div class="text-center mb-14">
            <div class="reveal inline-flex items-center gap-2 bg-brand/20 border border-brand/40 rounded-full px-4 py-1.5 mb-5">
                <span class="font-condensed text-xs font-700 tracking-[3px] text-brand uppercase">Nuestros Platos</span>
            </div>
            <h2 class="reveal font-anton text-[clamp(36px,6vw,72px)] text-white uppercase leading-none">LA <span class="text-brand">CARTA</span></h2>
            <p class="reveal text-white/50 mt-3 text-base max-w-md mx-auto">Burgers artesanales, pizzas al horno, krispy crujiente y combos irresistibles.</p>
        </div>
        <!-- Tabs -->
        <div class="reveal flex flex-wrap justify-center gap-2 mb-10">
            <button onclick="filterMenu('all')" id="tab-all" class="carta-tab active-carta font-condensed font-700 text-sm uppercase tracking-wide rounded-full px-5 py-2 transition-all">Todo</button>
            <button onclick="filterMenu('burger')" id="tab-burger" class="carta-tab font-condensed font-700 text-sm uppercase tracking-wide bg-white/8 border border-white/10 text-white/60 rounded-full px-5 py-2 transition-all hover:text-white hover:bg-white/15">🍔 Burgers</button>
            <button onclick="filterMenu('pizza')" id="tab-pizza" class="carta-tab font-condensed font-700 text-sm uppercase tracking-wide bg-white/8 border border-white/10 text-white/60 rounded-full px-5 py-2 transition-all hover:text-white hover:bg-white/15">🍕 Pizzas</button>
            <button onclick="filterMenu('krispy')" id="tab-krispy" class="carta-tab font-condensed font-700 text-sm uppercase tracking-wide bg-white/8 border border-white/10 text-white/60 rounded-full px-5 py-2 transition-all hover:text-white hover:bg-white/15">🍗 Krispy</button>
            <button onclick="filterMenu('salchi')" id="tab-salchi" class="carta-tab font-condensed font-700 text-sm uppercase tracking-wide bg-white/8 border border-white/10 text-white/60 rounded-full px-5 py-2 transition-all hover:text-white hover:bg-white/15">🍟 Salchipapas</button>
            <button onclick="filterMenu('promo')" id="tab-promo" class="carta-tab font-condensed font-700 text-sm uppercase tracking-wide bg-white/8 border border-white/10 text-white/60 rounded-full px-5 py-2 transition-all hover:text-white hover:bg-white/15">🔥 Promos</button>
        </div>
        <!-- Grid -->
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4" id="menu-grid">
            <!-- BURGERS -->
            <div class="carta-card card-shine reveal group bg-white/[0.05] border border-white/10 rounded-2xl overflow-hidden hover:border-brand/50 hover:-translate-y-2 hover:shadow-[0_20px_50px_rgba(227,6,19,0.2)] transition-all duration-300" data-cat="burger">
                <div class="relative h-48 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1571091718767-18b5b1457add?w=400&q=80" alt="Classic Paseillo" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110" />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="bg-brand font-condensed absolute left-3 top-3 rounded-full px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider text-white">Popular</div>
                </div>
                <div class="p-4">
                    <h3 class="font-condensed text-lg font-bold text-white">Classic Paseillo</h3>
                    <p class="mt-1 text-xs text-white/50 leading-relaxed">Carne 180g, queso cheddar, lechuga, tomate, salsa de la casa</p>
                    <div class="mt-4 flex items-center justify-between">
                        <span class="font-anton text-brand text-2xl">S/. 22</span>
                        <a href="https://wa.me/51000000000?text=Quiero%20Classic%20Paseillo" target="_blank" class="bg-brand hover:bg-brand-dark text-white font-condensed font-800 text-xs uppercase tracking-wide px-4 py-2 rounded-xl transition-all duration-300 hover:scale-105 hover:shadow-[0_6px_20px_rgba(227,6,19,0.4)]">+ Pedir</a>
                    </div>
                </div>
            </div>
            <!-- Más burgers... -->
            <div class="carta-card card-shine reveal d1 group bg-white/[0.05] border border-white/10 rounded-2xl overflow-hidden hover:border-brand/50 hover:-translate-y-2 hover:shadow-[0_20px_50px_rgba(227,6,19,0.2)] transition-all duration-300" data-cat="burger">
                <div class="relative h-48 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1553979459-d2229ba7433b?w=400&q=80" alt="Double Smoke" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110" />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="font-condensed absolute left-3 top-3 rounded-full bg-yellow-500 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider text-black">Nuevo</div>
                </div>
                <div class="p-4">
                    <h3 class="font-condensed text-lg font-bold text-white">Double Smoke</h3>
                    <p class="mt-1 text-xs text-white/50 leading-relaxed">Doble carne 360g, bacon crujiente, queso gouda ahumado, pepinillos</p>
                    <div class="mt-4 flex items-center justify-between">
                        <span class="font-anton text-brand text-2xl">S/. 34</span>
                        <a href="https://wa.me/51000000000?text=Quiero%20Double%20Smoke" target="_blank" class="bg-brand hover:bg-brand-dark text-white font-condensed font-800 text-xs uppercase tracking-wide px-4 py-2 rounded-xl transition-all duration-300 hover:scale-105 hover:shadow-[0_6px_20px_rgba(227,6,19,0.4)]">+ Pedir</a>
                    </div>
                </div>
            </div>
            <!-- PIZZAS -->
            <div class="carta-card card-shine reveal group bg-white/[0.05] border border-white/10 rounded-2xl overflow-hidden hover:border-brand/50 hover:-translate-y-2 hover:shadow-[0_20px_50px_rgba(227,6,19,0.2)] transition-all duration-300" data-cat="pizza">
                <div class="relative h-48 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=400&q=80" alt="Margherita" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110" />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="bg-brand font-condensed absolute left-3 top-3 rounded-full px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider text-white">Popular</div>
                </div>
                <div class="p-4">
                    <h3 class="font-condensed text-lg font-bold text-white">Margherita Clásica</h3>
                    <p class="mt-1 text-xs text-white/50 leading-relaxed">Salsa de tomate artesanal, mozzarella fresca, albahaca, aceite de oliva</p>
                    <div class="mt-4 flex items-center justify-between">
                        <span class="font-anton text-brand text-2xl">S/. 28</span>
                        <a href="https://wa.me/51000000000?text=Quiero%20Margherita%20Clásica" target="_blank" class="bg-brand hover:bg-brand-dark text-white font-condensed font-800 text-xs uppercase tracking-wide px-4 py-2 rounded-xl transition-all duration-300 hover:scale-105 hover:shadow-[0_6px_20px_rgba(227,6,19,0.4)]">+ Pedir</a>
                    </div>
                </div>
            </div>
            <!-- KRISPY -->
            <div class="carta-card card-shine reveal group bg-white/[0.05] border border-white/10 rounded-2xl overflow-hidden hover:border-brand/50 hover:-translate-y-2 hover:shadow-[0_20px_50px_rgba(227,6,19,0.2)] transition-all duration-300" data-cat="krispy">
                <div class="relative h-48 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1562967914-608f82629710?w=400&q=80" alt="Krispy Clásico" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110" />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="bg-brand font-condensed absolute left-3 top-3 rounded-full px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider text-white">Popular</div>
                </div>
                <div class="p-4">
                    <h3 class="font-condensed text-lg font-bold text-white">Krispy Clásico</h3>
                    <p class="mt-1 text-xs text-white/50 leading-relaxed">Pollo crocante marinado en especias, jugoso por dentro, dorado por fuera</p>
                    <div class="mt-4 flex items-center justify-between">
                        <span class="font-anton text-brand text-2xl">S/. 16</span>
                        <a href="https://wa.me/51000000000?text=Quiero%20Krispy%20Clásico" target="_blank" class="bg-brand hover:bg-brand-dark text-white font-condensed font-800 text-xs uppercase tracking-wide px-4 py-2 rounded-xl transition-all duration-300 hover:scale-105 hover:shadow-[0_6px_20px_rgba(227,6,19,0.4)]">+ Pedir</a>
                    </div>
                </div>
            </div>
            <!-- SALCHIPAPAS -->
            <div class="carta-card card-shine reveal group bg-white/[0.05] border border-white/10 rounded-2xl overflow-hidden hover:border-brand/50 hover:-translate-y-2 hover:shadow-[0_20px_50px_rgba(227,6,19,0.2)] transition-all duration-300" data-cat="salchi">
                <div class="relative h-48 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1573080496219-bb080dd4f877?w=400&q=80" alt="Salchipapa Clásica" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110" />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                </div>
                <div class="p-4">
                    <h3 class="font-condensed text-lg font-bold text-white">Salchipapa Clásica</h3>
                    <p class="mt-1 text-xs text-white/50 leading-relaxed">Papas crocantes, salchicha y las salsas de la casa que marcan la diferencia</p>
                    <div class="mt-4 flex items-center justify-between">
                        <span class="font-anton text-brand text-2xl">S/. 10</span>
                        <a href="https://wa.me/51000000000?text=Quiero%20Salchipapa%20Clásica" target="_blank" class="bg-brand hover:bg-brand-dark text-white font-condensed font-800 text-xs uppercase tracking-wide px-4 py-2 rounded-xl transition-all duration-300 hover:scale-105 hover:shadow-[0_6px_20px_rgba(227,6,19,0.4)]">+ Pedir</a>
                    </div>
                </div>
            </div>
            <!-- PROMOS -->
            <div class="carta-card card-shine reveal group bg-white/[0.05] border border-white/10 rounded-2xl overflow-hidden hover:border-brand/50 hover:-translate-y-2 hover:shadow-[0_20px_50px_rgba(227,6,19,0.2)] transition-all duration-300" data-cat="promo">
                <div class="relative h-48 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1594212699903-ec8a3eca50f5?w=400&q=80" alt="Combo Dúo" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110" />
                    <div class="absolute inset-0 bg-gradient-to-t from-brand/50 to-transparent"></div>
                    <div class="font-condensed absolute bottom-3 left-3 text-sm font-bold text-white tracking-wide">🔥 PROMO DÚO</div>
                </div>
                <div class="p-4">
                    <h3 class="font-condensed text-lg font-bold text-white">Combo Dúo</h3>
                    <p class="mt-1 text-xs text-white/50 leading-relaxed">2 Burgers Classic + 2 bebidas + papas fritas compartidas</p>
                    <div class="mt-4 flex items-center justify-between">
                        <div>
                            <span class="font-anton text-brand text-2xl">S/. 48</span>
                            <span class="ml-2 text-xs text-white/30 line-through">S/. 60</span>
                        </div>
                        <a href="https://wa.me/51000000000?text=Quiero%20Combo%20Dúo" target="_blank" class="bg-brand hover:bg-brand-dark text-white font-condensed font-800 text-xs uppercase tracking-wide px-4 py-2 rounded-xl transition-all duration-300 hover:scale-105 hover:shadow-[0_6px_20px_rgba(227,6,19,0.4)]">+ Pedir</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- CTA bottom -->
        <div class="reveal text-center mt-14">
            <p class="text-white/40 text-sm mb-5">¿No encuentras lo que buscas? Escríbenos y lo preparamos.</p>
            <a href="https://wa.me/51000000000?text=Hola%20Paseillo%2C%20quiero%20hacer%20un%20pedido" target="_blank" class="inline-flex items-center gap-3 bg-[#25D366] hover:bg-[#1ebe5c] text-white font-condensed font-800 text-sm uppercase tracking-wider px-8 py-4 rounded-full shadow-[0_6px_24px_rgba(37,211,102,0.4)] hover:-translate-y-1 transition-all duration-300">
                <span class="text-xl">💬</span> Ordenar por WhatsApp
            </a>
        </div>
    </div>
</section>