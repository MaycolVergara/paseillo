// resources/js/webPartials.js

// Navbar toggle
const navToggle = document.getElementById('nav-toggle');
const mMenu = document.getElementById('mobile-menu');
const bars = document.querySelectorAll('.nav-bar');
let navOpen = false;

if(navToggle && mMenu) {
    navToggle.addEventListener('click', () => {
        navOpen = !navOpen;
        mMenu.style.maxHeight = navOpen ? '520px' : '0';
        if(bars.length >= 3){
            bars[0].style.transform = navOpen ? 'translateY(6px) rotate(45deg)' : '';
            bars[1].style.opacity = navOpen ? '0' : '1';
            bars[2].style.transform = navOpen ? 'translateY(-6px) rotate(-45deg)' : '';
            bars[2].style.width = navOpen ? '20px' : '';
        }
    });

    mMenu.querySelectorAll('a').forEach((a) =>
        a.addEventListener('click', () => {
            navOpen = false;
            mMenu.style.maxHeight = '0';
            bars.forEach((b) => {
                b.style.transform = '';
                b.style.opacity = '1';
                b.style.width = '';
            });
        })
    );
}

// Scroll glass navbar
const navbar = document.getElementById('navbar');
if(navbar) {
    window.addEventListener('scroll', () => navbar.classList.toggle('scrolled', window.scrollY > 50), { passive: true });
}

// Scroll reveal
const revEls = document.querySelectorAll('.reveal,.reveal-l,.reveal-r');
const ro = new IntersectionObserver((entries) => {
    entries.forEach((e) => {
        if (e.isIntersecting) {
            e.target.classList.add('vis');
            ro.unobserve(e.target);
        }
    });
}, { threshold: 0.07, rootMargin: '0px 0px -28px 0px' });
revEls.forEach((el) => ro.observe(el));

// FAQ
document.querySelectorAll('.faq-btn').forEach((btn) => {
    btn.addEventListener('click', () => {
        const body = btn.nextElementSibling, icon = btn.querySelector('.faq-icon');
        const isOpen = body.classList.contains('open');
        document.querySelectorAll('.faq-body').forEach((b) => b.classList.remove('open'));
        document.querySelectorAll('.faq-icon').forEach((i) => i.classList.remove('open'));
        if (!isOpen) {
            body.classList.add('open');
            icon.classList.add('open');
        }
    });
});
