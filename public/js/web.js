// ─ Sticky header shadow
/*const nav = document.getElementById('nav')
window.addEventListener('scroll', () => {
    nav.classList.toggle('shadow-lg', window.scrollY > 20)
})

// ─ Hamburger toggle
const ham = document.getElementById('ham')
const mob = document.getElementById('mob')
let open = false
ham.addEventListener('click', () => {
    open = !open
    mob.style.maxHeight = open ? mob.scrollHeight + 'px' : '0'
    const spans = ham.querySelectorAll('span')
    if (open) {
        spans[0].style.transform = 'rotate(45deg) translate(4px,4px)'
        spans[1].style.opacity = '0'
        spans[2].style.transform = 'rotate(-45deg) translate(4px,-4px)'
    } else {
        spans[0].style.transform = ''
        spans[1].style.opacity = ''
        spans[2].style.transform = ''
    }
})
function closeNav() {
    open = false
    mob.style.maxHeight = '0'
    ham.querySelectorAll('span').forEach((s) => {
        s.style.transform = ''
        s.style.opacity = ''
    })
}

// ─ Carta / Menu filter
function filterMenu(cat) {
    document.querySelectorAll('.carta-tab').forEach((t) => {
        t.classList.remove('active-carta')
        t.classList.add('bg-gray-100', 'text-gray-500')
    })
    const active = document.getElementById('tab-' + cat)
    active.classList.add('active-carta')
    active.classList.remove('bg-gray-100', 'text-gray-500')
    document.querySelectorAll('#menu-grid [data-cat]').forEach((c) => {
        c.style.display = cat === 'all' || c.dataset.cat === cat ? 'block' : 'none'
    })
}

// ─ Scroll reveal
const revEls = document.querySelectorAll('.reveal')
const revObs = new IntersectionObserver(
    (entries) => {
        entries.forEach((e) => {
            if (e.isIntersecting) {
                e.target.classList.add('on')
                revObs.unobserve(e.target)
            }
        })
    },
    { threshold: 0.1, rootMargin: '0px 0px -50px 0px' }
)
revEls.forEach((el) => revObs.observe(el))

// ─ FAQ Accordion
function toggleFaq(btn) {
    const item = btn.closest('.faq-item')
    const body = item.querySelector('.faq-body')
    const icon = btn.querySelector('.faq-icon')
    const isOpen = body.style.maxHeight && body.style.maxHeight !== '0px'
    // Close all
    document.querySelectorAll('.faq-item').forEach((i) => {
        i.querySelector('.faq-body').style.maxHeight = '0px'
        i.querySelector('.faq-icon').style.transform = 'rotate(0deg)'
        i.querySelector('.faq-icon').textContent = '+'
    })
    // Open clicked if it was closed
    if (!isOpen) {
        body.style.maxHeight = body.scrollHeight + 'px'
        icon.style.transform = 'rotate(45deg)'
        icon.textContent = '+'
    }
}

// ─ Smooth scroll
document.querySelectorAll('a[href^="#"]').forEach((a) => {
    a.addEventListener('click', (e) => {
        const t = document.querySelector(a.getAttribute('href'))
        if (t) {
            e.preventDefault()
            window.scrollTo({ top: t.offsetTop - 70, behavior: 'smooth' })
        }
    })
})
*/