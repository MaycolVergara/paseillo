export function initTheme() {
    window.toggleTheme = function() {
        const html = document.documentElement;
        const isDark = html.classList.toggle("dark");
        html.classList.toggle("light", !isDark);
        localStorage.setItem("paseillo-theme", isDark ? "dark" : "light");
    };

    const saved = localStorage.getItem("paseillo-theme") || "light";
    document.documentElement.className = saved;
}
