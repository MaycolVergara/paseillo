export function initSidebar() {
    window.toggleSidebar = function() {
        const sidebar = document.getElementById("sidebar");
        const mainArea = document.getElementById("main-area");
        const backdrop = document.getElementById("sidebar-backdrop");
        const isMobile = window.innerWidth < 1024;

        if (sidebar) {
            if (isMobile) {
                const isHidden = sidebar.classList.contains("-translate-x-full");
                if (isHidden) {
                    sidebar.classList.remove("-translate-x-full");
                    sidebar.classList.add("translate-x-0");
                    if(backdrop) {
                        backdrop.classList.remove("hidden", "opacity-0", "pointer-events-none");
                        backdrop.classList.add("opacity-100");
                    }
                } else {
                    sidebar.classList.add("-translate-x-full");
                    sidebar.classList.remove("translate-x-0");
                    if(backdrop) {
                        backdrop.classList.add("opacity-0", "pointer-events-none");
                        setTimeout(() => backdrop.classList.add("hidden"), 300);
                    }
                }
            } else {
                const collapsed = sidebar.classList.toggle("collapsed");
                if (mainArea) mainArea.style.marginLeft = collapsed ? "80px" : "288px";
                localStorage.setItem("paseillo-sidebar", collapsed ? "collapsed" : "expanded");
            }
        }
    };

    // Accordions and Dropdowns
    window.toggleAccordion = function(btn) {
        const wrapper = btn.nextElementSibling;
        if (wrapper) {
            const isOpen = wrapper.classList.contains("open");
            document.querySelectorAll(".submenu-wrapper.open").forEach((el) => {
                el.classList.remove("open");
                el.previousElementSibling.classList.remove("open");
            });
            if (!isOpen) {
                wrapper.classList.add("open");
                btn.classList.add("open");
            }
        }
    };

    window.toggleDropdown = function() {
        const profileDD = document.getElementById("profile-dropdown");
        if (profileDD) profileDD.classList.toggle("open");
    };

    document.addEventListener("click", (e) => {
        const profileWrap = document.getElementById("profile-wrap");
        const profileDD = document.getElementById("profile-dropdown");
        if (profileWrap && profileDD && !profileWrap.contains(e.target)) {
            profileDD.classList.remove("open");
        }
    });

    // Sidebar state restoration
    const state = localStorage.getItem("paseillo-sidebar");
    const sidebar = document.getElementById("sidebar");
    const mainArea = document.getElementById("main-area");
    if (sidebar && state === "collapsed" && window.innerWidth >= 1024) {
        sidebar.classList.add("collapsed");
        if (mainArea) mainArea.style.marginLeft = "80px";
    }
}
