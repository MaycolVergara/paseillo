export function initClock() {
    function updateClock() {
        const clockTime = document.getElementById("clock-time");
        const clockDate = document.getElementById("clock-date");
        if (!clockTime || !clockDate) return;

        const DAYS = ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"];
        const MONTHS = ["ene", "feb", "mar", "abr", "may", "jun", "jul", "ago", "sep", "oct", "nov", "dic"];

        const now = new Date();
        const hh = String(now.getHours()).padStart(2, "0");
        const mm = String(now.getMinutes()).padStart(2, "0");
        const ss = String(now.getSeconds()).padStart(2, "0");

        clockTime.textContent = `${hh}:${mm}:${ss}`;
        clockDate.textContent = `${DAYS[now.getDay()]}, ${now.getDate()} ${MONTHS[now.getMonth()]} ${now.getFullYear()}`;
    }

    updateClock();
    setInterval(updateClock, 1000);
}
