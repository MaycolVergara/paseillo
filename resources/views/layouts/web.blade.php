<!doctype html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Paseillo Pizzas & Burger — Huanta</title>
    <link rel="icon" href="img/logo_principal.png" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Barlow:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,800&family=Barlow+Condensed:wght@400;600;700;800;900&display=swap" rel="stylesheet" />
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: "#E30613",
                        "brand-dark": "#b80510",
                        "brand-black": "#0d0d0d",
                        "brand-gray": "#F5F5F5",
                    },
                    fontFamily: {
                        anton: ["Anton", "sans-serif"],
                        barlow: ["Barlow", "sans-serif"],
                        condensed: ["Barlow Condensed", "sans-serif"],
                    },
                    animation: {
                        float: "float 4s ease-in-out infinite",
                        float2: "float 4s ease-in-out 2s infinite",
                        ticker: "ticker 20s linear infinite",
                        "pulse-ring": "pulse-ring 2s ease-out infinite",
                        "slide-up": "slideUp 0.6s ease forwards",
                    },
                    keyframes: {
                        float: { "0%,100%": { transform: "translateY(0px)" }, "50%": { transform: "translateY(-12px)" } },
                        ticker: { "0%": { transform: "translateX(0)" }, "100%": { transform: "translateX(-50%)" } },
                        "pulse-ring": { "0%": { transform: "scale(1)", opacity: "0.8" }, "100%": { transform: "scale(1.5)", opacity: "0" } },
                        slideUp: { from: { opacity: "0", transform: "translateY(40px)" }, to: { opacity: "1", transform: "translateY(0)" } },
                    },
                },
            },
        };
    </script>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: "Barlow", sans-serif;
            overflow-x: hidden;
        }
        ::-webkit-scrollbar {
            width: 5px;
        }
        ::-webkit-scrollbar-thumb {
            background: #e30613;
            border-radius: 3px;
        }
        .font-anton {
            font-family: "Anton", sans-serif;
        }
        .font-condensed {
            font-family: "Barlow Condensed", sans-serif;
        }
        /* Reveal on scroll */
        .reveal {
            opacity: 0;
            transform: translateY(36px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }
        .reveal.on {
            opacity: 1;
            transform: translateY(0);
        }
        .reveal.d1 {
            transition-delay: 0.1s;
        }
        .reveal.d2 {
            transition-delay: 0.2s;
        }
        .reveal.d3 {
            transition-delay: 0.3s;
        }
        .reveal.d4 {
            transition-delay: 0.4s;
        }
        /* Diagonal cut */
        .clip-diagonal {
            clip-path: polygon(0 0, 100% 0, 100% 88%, 0 100%);
        }
        .clip-diagonal-top {
            clip-path: polygon(0 12%, 100% 0, 100% 100%, 0 100%);
        }
        /* Ticker */
        .ticker-wrap {
            overflow: hidden;
            white-space: nowrap;
        }
        .ticker-inner {
            display: inline-flex;
            animation: ticker 22s linear infinite;
        }
        /* Hover zoom image */
        .img-zoom {
            overflow: hidden;
        }
        .img-zoom img {
            transition: transform 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        .img-zoom:hover img {
            transform: scale(1.08);
        }
        /* Nav underline */
        .nav-link {
            position: relative;
        }
        .nav-link::after {
            content: "";
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: #e30613;
            transition: width 0.3s ease;
        }
        .nav-link:hover::after {
            width: 100%;
        }
        /* Card shine */
        .card-shine {
            position: relative;
            overflow: hidden;
        }
        .card-shine::before {
            content: "";
            position: absolute;
            top: 0;
            left: -75%;
            width: 50%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.08), transparent);
            transition: left 0.6s ease;
            z-index: 10;
        }
        .card-shine:hover::before {
            left: 125%;
        }
        /* Carta tabs */
        .carta-tab.active-carta {
            background: #e30613 !important;
            color: #fff !important;
        }
    </style>
</head>

<body class="bg-white text-gray-900">

{{-- CONTENIDO DE LA PÁGINA --}}
<main>
    @yield('content')
</main>

<!-- ══════════════ SCRIPTS ══════════════ -->
<script>
// ─ Sticky header shadow
const nav = document.getElementById("nav");
window.addEventListener("scroll", () => {
    nav.classList.toggle("shadow-lg", window.scrollY > 20);
});

// ─ Hamburger toggle
const ham = document.getElementById("ham");
const mob = document.getElementById("mob");
let open = false;
ham.addEventListener("click", () => {
    open = !open;
    mob.style.maxHeight = open ? mob.scrollHeight + "px" : "0";
    const spans = ham.querySelectorAll("span");
    if (open) {
        spans[0].style.transform = "rotate(45deg) translate(4px,4px)";
        spans[1].style.opacity = "0";
        spans[2].style.transform = "rotate(-45deg) translate(4px,-4px)";
    } else {
        spans[0].style.transform = "";
        spans[1].style.opacity = "";
        spans[2].style.transform = "";
    }
});

function closeNav() {
    open = false;
    mob.style.maxHeight = "0";
    ham.querySelectorAll("span").forEach((s) => {
        s.style.transform = "";
        s.style.opacity = "";
    });
}

// ─ Carta / Menu filter
function filterMenu(cat) {
    document.querySelectorAll(".carta-tab").forEach((t) => {
        t.classList.remove("active-carta");
        t.classList.add("bg-white/8", "border", "border-white/10", "text-white/60");
    });
    const active = document.getElementById("tab-" + cat);
    active.classList.add("active-carta");
    active.classList.remove("bg-white/8", "border", "border-white/10", "text-white/60");
    document.querySelectorAll("#menu-grid [data-cat]").forEach((c) => {
        c.style.display = cat === "all" || c.dataset.cat === cat ? "block" : "none";
    });
}

// ─ Scroll reveal
const revEls = document.querySelectorAll(".reveal");
const revObs = new IntersectionObserver(
    (entries) => {
        entries.forEach((e) => {
            if (e.isIntersecting) {
                e.target.classList.add("on");
                revObs.unobserve(e.target);
            }
        });
    },
    { threshold: 0.1, rootMargin: "0px 0px -50px 0px" }
);
revEls.forEach((el) => revObs.observe(el));

// ─ FAQ Accordion
function toggleFaq(btn) {
    const item = btn.closest(".faq-item");
    const body = item.querySelector(".faq-body");
    const icon = btn.querySelector(".faq-icon");
    const isOpen = body.style.maxHeight && body.style.maxHeight !== "0px";

    // Close all
    document.querySelectorAll(".faq-item").forEach((i) => {
        i.querySelector(".faq-body").style.maxHeight = "0px";
        i.querySelector(".faq-icon").style.transform = "rotate(0deg)";
        i.querySelector(".faq-icon").textContent = "+";
    });

    // Open clicked if it was closed
    if (!isOpen) {
        body.style.maxHeight = body.scrollHeight + "px";
        icon.style.transform = "rotate(45deg)";
        icon.textContent = "+";
    }
}

// ─ Smooth scroll
document.querySelectorAll('a[href^="#"]').forEach((a) => {
    a.addEventListener("click", (e) => {
        const t = document.querySelector(a.getAttribute("href"));
        if (t) {
            e.preventDefault();
            window.scrollTo({ top: t.offsetTop - 70, behavior: "smooth" });
        }
    });
});
</script>

</body>
</html>
