/**
 * Public Web Interactions (Landing Page / Carta)
 * Merged from old web.js and layout inline scripts.
 */
export function initWebInteractions() {
    
    // 1. Hamburger Toggle (mob/ham/spans)
    const ham = document.getElementById("ham");
    const mob = document.getElementById("mob");
    let isOpen = false;

    if (ham && mob) {
        ham.addEventListener("click", () => {
            isOpen = !isOpen;
            mob.style.maxHeight = isOpen ? mob.scrollHeight + "px" : "0";
            const spans = ham.querySelectorAll("span");
            if (isOpen) {
                if (spans.length >= 3) {
                    spans[0].style.transform = "rotate(45deg) translate(4px,4px)";
                    spans[1].style.opacity = "0";
                    spans[2].style.transform = "rotate(-45deg) translate(4px,-4px)";
                }
            } else {
                spans.forEach(s => {
                    s.style.transform = "";
                    s.style.opacity = "";
                });
            }
        });

        // Close when clicking a link
        mob.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                isOpen = false;
                mob.style.maxHeight = "0";
                ham.querySelectorAll("span").forEach(s => {
                    s.style.transform = "";
                    s.style.opacity = "";
                });
            });
        });
    }

    // 2. Sticky Header Shadow
    const nav = document.getElementById("nav");
    if (nav) {
        window.addEventListener("scroll", () => {
            nav.classList.toggle("shadow-lg", window.scrollY > 20);
        }, { passive: true });
    }

    // 3. Scroll Reveal (Intersection Observer)
    const revEls = document.querySelectorAll(".reveal");
    if (revEls.length > 0) {
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
    }

    // 4. FAQ Accordion
    window.toggleFaq = function(btn) {
        const item = btn.closest(".faq-item");
        if (!item) return;
        const body = item.querySelector(".faq-body");
        const icon = btn.querySelector(".faq-icon");
        const alreadyOpen = body.style.maxHeight && body.style.maxHeight !== "0px";

        // Close all
        document.querySelectorAll(".faq-item").forEach((i) => {
            const b = i.querySelector(".faq-body");
            const ic = i.querySelector(".faq-icon");
            if (b) b.style.maxHeight = "0px";
            if (ic) {
                ic.style.transform = "rotate(0deg)";
                ic.textContent = "+";
            }
        });

        // Open clicked if it was closed
        if (!alreadyOpen && body) {
            body.style.maxHeight = body.scrollHeight + "px";
            if (icon) {
                icon.style.transform = "rotate(45deg)";
                icon.textContent = "+";
            }
        }
    };

    // 5. Carta / Menu Filter
    window.filterMenu = function(cat) {
        document.querySelectorAll(".carta-tab").forEach((t) => {
            t.classList.remove("active-carta");
            t.classList.add("bg-white/8", "border", "border-white/10", "text-white/60");
        });
        const active = document.getElementById("tab-" + cat);
        if (active) {
            active.classList.add("active-carta");
            active.classList.remove("bg-white/8", "border", "border-white/10", "text-white/60");
        }
        document.querySelectorAll("#menu-grid [data-cat]").forEach((c) => {
            c.style.display = (cat === "all" || c.dataset.cat === cat) ? "block" : "none";
        });
    };

    // 6. Smooth Scroll
    document.querySelectorAll('a[href^="#"]').forEach((a) => {
        a.addEventListener("click", (e) => {
            const href = a.getAttribute("href");
            if (href === "#") return;
            const target = document.querySelector(href);
            if (target) {
                e.preventDefault();
                window.scrollTo({
                    top: target.offsetTop - 70,
                    behavior: "smooth"
                });
            }
        });
    });
}
