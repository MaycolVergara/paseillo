// resources/js/web/web.js

// ─ Sticky header shadow
const nav = document.getElementById('nav');
if (nav) {
    window.addEventListener('scroll', () => {
        nav.classList.toggle('shadow-lg', window.scrollY > 20);
    }, { passive: true });
}

// ─ Hamburger toggle
const ham = document.getElementById('ham');
const mob = document.getElementById('mob');
let open = false;

if (ham && mob) {
    ham.addEventListener('click', () => {
        open = !open;
        mob.style.maxHeight = open ? mob.scrollHeight + 'px' : '0';
        const spans = ham.querySelectorAll('span');
        if (open) {
            spans[0].style.transform = 'rotate(45deg) translate(4px,4px)';
            spans[1].style.opacity = '0';
            spans[2].style.transform = 'rotate(-45deg) translate(4px,-4px)';
        } else {
            spans[0].style.transform = '';
            spans[1].style.opacity = '';
            spans[2].style.transform = '';
        }
    });
}

window.closeNav = function() {
    if (!mob || !ham) return;
    open = false;
    mob.style.maxHeight = '0';
    ham.querySelectorAll('span').forEach(s => { s.style.transform = ''; s.style.opacity = ''; });
}

// ─ Carta / Menu filter
window.filterMenu = function(cat) {
    document.querySelectorAll('.carta-tab').forEach(t => {
        t.classList.remove('active-carta');
        t.classList.add('bg-white/8', 'border', 'border-white/10', 'text-white/60');
    });
    const active = document.getElementById('tab-' + cat);
    if (active) {
        active.classList.add('active-carta');
        active.classList.remove('bg-white/8', 'border', 'border-white/10', 'text-white/60');
    }
    document.querySelectorAll('#menu-grid [data-cat]').forEach(c => {
        c.style.display = (cat === 'all' || c.dataset.cat === cat) ? 'block' : 'none';
    });
}

// ─ Scroll reveal
const revEls = document.querySelectorAll('.reveal');
if (revEls.length > 0) {
    const revObs = new IntersectionObserver(entries => {
        entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('on'); revObs.unobserve(e.target); } });
    }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });
    revEls.forEach(el => revObs.observe(el));
}

// ─ FAQ Accordion
window.toggleFaq = function(btn) {
    const item = btn.closest('.faq-item');
    if (!item) return;
    const body = item.querySelector('.faq-body');
    const icon = btn.querySelector('.faq-icon');
    const isOpen = body.style.maxHeight && body.style.maxHeight !== '0px';

    // Close all
    document.querySelectorAll('.faq-item').forEach(i => {
        const b = i.querySelector('.faq-body');
        const ic = i.querySelector('.faq-icon');
        if (b) b.style.maxHeight = '0px';
        if (ic) {
            ic.style.transform = 'rotate(0deg)';
            ic.textContent = '+';
        }
    });

    // Open clicked if it was closed
    if (!isOpen && body && icon) {
        body.style.maxHeight = body.scrollHeight + 'px';
        icon.style.transform = 'rotate(45deg)';
        icon.textContent = '+';
    }
}

// ─ Smooth scroll
document.querySelectorAll('a[href^="#"]').forEach(a => {
    a.addEventListener('click', e => {
        const href = a.getAttribute('href');
        if (href === '#') return;
        const t = document.querySelector(href);
        if (t) { 
            e.preventDefault(); 
            window.scrollTo({ top: t.offsetTop - 70, behavior: 'smooth' }); 
            if (typeof closeNav === 'function') closeNav();
        }
    });
});

// Initialize Lucide Icons
document.addEventListener('DOMContentLoaded', () => {
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
});
