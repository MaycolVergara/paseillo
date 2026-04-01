@extends('layouts.web')

@section('content')

    <!-- ══════════════ LA CARTA ══════════════ -->
    <section id="carta" class="relative overflow-hidden py-24" style="background-color: #0f0f0f">
        <!-- Fondo con textura de cuadrícula sutil -->
        <div
            class="pointer-events-none absolute inset-0"
            style="
          background-image: linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
          background-size: 48px 48px;
        "
        ></div>
        <!-- Glows de color -->
        <div
            class="bg-brand/10 pointer-events-none absolute left-0 top-0 h-[500px] w-[500px] -translate-x-1/2 -translate-y-1/3 rounded-full blur-[140px]"
        ></div>
        <div
            class="bg-brand/8 pointer-events-none absolute bottom-0 right-0 h-[400px] w-[400px] translate-x-1/3 translate-y-1/3 rounded-full blur-[120px]"
        ></div>
        <!-- Texto fantasma de fondo -->
        <div
            class="pointer-events-none absolute inset-0 flex select-none items-center justify-center overflow-hidden"
        >
        <span
            class="font-anton whitespace-nowrap text-[220px] uppercase leading-none tracking-widest text-white/[0.02]"
        >PASEILLO</span
        >
        </div>

        <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-14 text-center">
                <div
                    class="reveal bg-brand/20 border-brand/40 mb-5 inline-flex items-center gap-2 rounded-full border px-4 py-1.5"
                >
            <span class="font-condensed font-700 text-brand text-xs uppercase tracking-[3px]"
            >Nuestros Platos</span
            >
                </div>
                <h2
                    class="reveal font-anton text-[clamp(36px,6vw,72px)] uppercase leading-none text-white"
                >
                    LA <span class="text-brand">CARTA</span>
                </h2>
                <p class="reveal mx-auto mt-3 max-w-md text-base text-white/50">
                    Burgers artesanales, pizzas al horno, krispy crujiente y combos irresistibles.
                </p>
            </div>

            <!-- Tabs -->
            <div class="reveal mb-10 flex flex-wrap justify-center gap-2">
                <button
                    onclick="filterMenu('all')"
                    id="tab-all"
                    class="carta-tab active-carta font-condensed font-700 rounded-full px-5 py-2 text-sm uppercase tracking-wide transition-all"
                >
                    Todo
                </button>
                <button
                    onclick="filterMenu('burger')"
                    id="tab-burger"
                    class="carta-tab font-condensed font-700 bg-white/8 rounded-full border border-white/10 px-5 py-2 text-sm uppercase tracking-wide text-white/60 transition-all hover:bg-white/15 hover:text-white"
                >
                    🍔 Burgers
                </button>
                <button
                    onclick="filterMenu('pizza')"
                    id="tab-pizza"
                    class="carta-tab font-condensed font-700 bg-white/8 rounded-full border border-white/10 px-5 py-2 text-sm uppercase tracking-wide text-white/60 transition-all hover:bg-white/15 hover:text-white"
                >
                    🍕 Pizzas
                </button>
                <button
                    onclick="filterMenu('krispy')"
                    id="tab-krispy"
                    class="carta-tab font-condensed font-700 bg-white/8 rounded-full border border-white/10 px-5 py-2 text-sm uppercase tracking-wide text-white/60 transition-all hover:bg-white/15 hover:text-white"
                >
                    🍗 Krispy
                </button>
                <button
                    onclick="filterMenu('salchi')"
                    id="tab-salchi"
                    class="carta-tab font-condensed font-700 bg-white/8 rounded-full border border-white/10 px-5 py-2 text-sm uppercase tracking-wide text-white/60 transition-all hover:bg-white/15 hover:text-white"
                >
                    🍟 Salchipapas
                </button>
                <button
                    onclick="filterMenu('alitas')"
                    id="tab-alitas"
                    class="carta-tab font-condensed font-700 bg-white/8 rounded-full border border-white/10 px-5 py-2 text-sm uppercase tracking-wide text-white/60 transition-all hover:bg-white/15 hover:text-white"
                >
                    🍗 Alitas
                </button>

                <!--<button
                    onclick="filterMenu('promo')"
                    id="tab-promo"
                    class="carta-tab font-condensed font-700 bg-white/8 rounded-full border border-white/10 px-5 py-2 text-sm uppercase tracking-wide text-white/60 transition-all hover:bg-white/15 hover:text-white"
                >
                    🔥 Promos
                </button>-->
            </div>

            <!-- Grid -->
            <div
                class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4"
                id="menu-grid"
            >
                @foreach($Hamburguesas as $hamburguesa)
                    <!-- BURGERS -->
                    <div
                        class="carta-card card-shine reveal hover:border-brand/50 group overflow-hidden
                        rounded-2xl border border-white/10 bg-white/[0.05] transition-all duration-300 hover:-translate-y-2
                        hover:shadow-[0_20px_50px_rgba(227,6,19,0.2)]"
                        data-cat="burger">
                        <div class="relative h-48 overflow-hidden">
                            <img
                                src="https://images.unsplash.com/photo-1571091718767-18b5b1457add?w=400&q=80"
                                alt="Classic Paseillo"
                                class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110"
                            />
                            <div class="absolute inset-0 bg-gradient-to-t
                             from-black/60 to-transparent"></div>
                            <div
                                class="bg-brand font-condensed absolute left-3 top-3
                                rounded-full px-2.5 py-1 text-[10px] font-bold uppercase
                                 tracking-wider text-white">
                                Popular
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="font-condensed text-lg font-bold text-white">
                                {{$hamburguesa->nombre_producto}}</h3>
                            <p class="mt-1 text-xs leading-relaxed text-white/50">
                                {{$hamburguesa->descripcion_producto}}
                            </p>
                            <div class="mt-4 flex items-center justify-between">
                                <span class="font-anton text-brand text-2xl">S/. {{$hamburguesa->precio}}</span>
                                <a
                                    href="https://wa.me/51000000000?text=Quiero%20Classic%20Paseillo"
                                    target="_blank"
                                    class="bg-brand hover:bg-brand-dark font-condensed font-800 rounded-xl px-4 py-2 text-xs uppercase tracking-wide text-white transition-all duration-300 hover:scale-105 hover:shadow-[0_6px_20px_rgba(227,6,19,0.4)]"
                                >Pedir</a
                                >
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- PIZZAS -->
                @foreach($Pizzas as $pizza)
                    <div
                        class="carta-card card-shine reveal hover:border-brand/50 group overflow-hidden rounded-2xl border border-white/10 bg-white/[0.05] transition-all duration-300 hover:-translate-y-2 hover:shadow-[0_20px_50px_rgba(227,6,19,0.2)]"
                        data-cat="pizza"
                    >
                        <div class="relative h-48 overflow-hidden">
                            <img
                                src="https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=400&q=80"
                                alt="Margherita"
                                class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110"
                            />
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            <div
                                class="bg-brand font-condensed absolute left-3 top-3 rounded-full px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider text-white"
                            >
                                Popular
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="font-condensed text-lg font-bold text-white">{{$pizza->nombre_producto}}</h3>
                            <p class="mt-1 text-xs leading-relaxed text-white/50">
                                {{$pizza->descripcion_producto}}
                            </p>
                            <div class="mt-4 flex items-center justify-between">
                                <span class="font-anton text-brand text-2xl">S/. {{$pizza->precio}}</span>
                                <a
                                    href="https://wa.me/51000000000?text=Quiero%20Margherita%20Cl%C3%A1sica"
                                    target="_blank"
                                    class="bg-brand hover:bg-brand-dark font-condensed font-800 rounded-xl px-4 py-2 text-xs uppercase tracking-wide text-white transition-all duration-300 hover:scale-105 hover:shadow-[0_6px_20px_rgba(227,6,19,0.4)]"
                                >+ Pedir</a
                                >
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- KRISPY -->
                @foreach($Krispys as $krispy)
                    <div
                        class="carta-card card-shine reveal hover:border-brand/50 group overflow-hidden rounded-2xl border border-white/10 bg-white/[0.05] transition-all duration-300 hover:-translate-y-2 hover:shadow-[0_20px_50px_rgba(227,6,19,0.2)]"
                        data-cat="krispy"
                    >
                        <div class="relative h-48 overflow-hidden">
                            <img
                                src="https://images.unsplash.com/photo-1562967914-608f82629710?w=400&q=80"
                                alt="Krispy Clásico"
                                class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110"
                            />
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            <div
                                class="bg-brand font-condensed absolute left-3 top-3 rounded-full px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider text-white"
                            >
                                Popular
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="font-condensed text-lg font-bold text-white">{{$krispy->nombre_producto}}</h3>
                            <p class="mt-1 text-xs leading-relaxed text-white/50">
                                {{$krispy->descripcion_producto	}}
                            </p>
                            <div class="mt-4 flex items-center justify-between">
                                <span class="font-anton text-brand text-2xl">S/. {{$krispy->precio}}</span>
                                <a
                                    href="https://wa.me/51000000000?text=Quiero%20Krispy%20Cl%C3%A1sico"
                                    target="_blank"
                                    class="bg-brand hover:bg-brand-dark font-condensed font-800 rounded-xl px-4 py-2 text-xs uppercase tracking-wide text-white transition-all duration-300 hover:scale-105 hover:shadow-[0_6px_20px_rgba(227,6,19,0.4)]"
                                >+ Pedir</a
                                >
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- SALCHIPAPAS -->
                @foreach($Salchipapas as $salchipapa)
                    <div
                        class="carta-card card-shine reveal hover:border-brand/50
                            group overflow-hidden rounded-2xl border border-white/10 bg-white/[0.05] transition-all duration-300
                            hover:-translate-y-2 hover:shadow-[0_20px_50px_rgba(227,6,19,0.2)]"
                        data-cat="salchi"
                    >
                        <div class="relative h-48 overflow-hidden">
                            <img
                                src="https://images.unsplash.com/photo-1573080496219-bb080dd4f877?w=400&q=80"
                                alt="Salchipapa Clásica"
                                class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110"
                            />
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        </div>
                        <div class="p-4">
                            <h3 class="font-condensed text-lg font-bold text-white">{{$salchipapa->nombre_producto}}</h3>
                            <p class="mt-1 text-xs leading-relaxed text-white/50">
                                {{$salchipapa->descripcion_producto	}}
                            </p>
                            <div class="mt-4 flex items-center justify-between">
                                <span class="font-anton text-brand text-2xl">S/. {{$salchipapa->precio}}</span>
                                <a
                                    href="https://wa.me/51000000000?text=Quiero%20Salchipapa%20Cl%C3%A1sica"
                                    target="_blank"
                                    class="bg-brand hover:bg-brand-dark font-condensed font-800 rounded-xl px-4 py-2 text-xs uppercase tracking-wide text-white transition-all duration-300 hover:scale-105 hover:shadow-[0_6px_20px_rgba(227,6,19,0.4)]"
                                >+ Pedir</a
                                >
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Alitas -->
                @foreach($Alitas as $alita)
                    <div
                        class="carta-card card-shine reveal hover:border-brand/50
                            group overflow-hidden rounded-2xl border border-white/10 bg-white/[0.05] transition-all duration-300
                            hover:-translate-y-2 hover:shadow-[0_20px_50px_rgba(227,6,19,0.2)]"
                        data-cat="alitas"
                    >
                        <div class="relative h-48 overflow-hidden">
                            <img
                                src="https://images.unsplash.com/photo-1573080496219-bb080dd4f877?w=400&q=80"
                                alt="Salchipapa Clásica"
                                class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110"
                            />
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        </div>
                        <div class="p-4">
                            <h3 class="font-condensed text-lg font-bold text-white">{{$alita->nombre_producto}}</h3>
                            <p class="mt-1 text-xs leading-relaxed text-white/50">
                                {{$alita->descripcion_producto	}}
                            </p>
                            <div class="mt-4 flex items-center justify-between">
                                <span class="font-anton text-brand text-2xl">S/. {{$alita->precio}}</span>
                                <a
                                    href="https://wa.me/51000000000?text=Quiero%20Salchipapa%20Cl%C3%A1sica"
                                    target="_blank"
                                    class="bg-brand hover:bg-brand-dark font-condensed font-800 rounded-xl px-4 py-2 text-xs uppercase tracking-wide text-white transition-all duration-300 hover:scale-105 hover:shadow-[0_6px_20px_rgba(227,6,19,0.4)]"
                                >+ Pedir</a
                                >
                            </div>
                        </div>
                    </div>
                @endforeach



                <!-- PROMOS-->
                <!--  <div
                    class="carta-card card-shine reveal hover:border-brand/50 group overflow-hidden rounded-2xl border border-white/10 bg-white/[0.05] transition-all duration-300 hover:-translate-y-2 hover:shadow-[0_20px_50px_rgba(227,6,19,0.2)]"
                    data-cat="promo"
                >
                    <div class="relative h-48 overflow-hidden">
                        <img
                            src="https://images.unsplash.com/photo-1594212699903-ec8a3eca50f5?w=400&q=80"
                            alt="Combo Dúo"
                            class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110"
                        />
                        <div class="from-brand/50 absolute inset-0 bg-gradient-to-t to-transparent"></div>
                        <div
                            class="font-condensed absolute bottom-3 left-3 text-sm font-bold tracking-wide text-white"
                        >
                            🔥 PROMO DÚO
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-condensed text-lg font-bold text-white">Combo Dúo</h3>
                        <p class="mt-1 text-xs leading-relaxed text-white/50">
                            2 Burgers Classic + 2 bebidas + papas fritas compartidas
                        </p>
                        <div class="mt-4 flex items-center justify-between">
                            <div>
                                <span class="font-anton text-brand text-2xl">S/. 48</span>
                                <span class="ml-2 text-xs text-white/30 line-through">S/. 60</span>
                            </div>
                            <a
                                href="https://wa.me/51000000000?text=Quiero%20Combo%20D%C3%BAo"
                                target="_blank"
                                class="bg-brand hover:bg-brand-dark font-condensed font-800 rounded-xl px-4 py-2 text-xs uppercase tracking-wide text-white transition-all duration-300 hover:scale-105 hover:shadow-[0_6px_20px_rgba(227,6,19,0.4)]"
                            >+ Pedir</a
                            >
                        </div>
                    </div>
                </div>
                   -->

            </div>
            <!-- /grid -->
        </div>
    </section>
@endsection
