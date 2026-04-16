/**
 * Staff Administration Logic
 */
export function initStaffAbsence() {
    const select = document.getElementById('staffSelect');
    const widget = document.getElementById('staffInfoWidget');
    const dispSalary = document.getElementById('displaySalary');
    const dispAdvance = document.getElementById('displayAdvance');
    const dispDaily = document.getElementById('displayDailyWage');

    if (!select || !widget) return;

    function updateWidget() {
        const option = select.options[select.selectedIndex];
        const salary = parseFloat(option.getAttribute('data-salary') || 0);
        const advance = parseFloat(option.getAttribute('data-advance') || 0);

        if (salary > 0 || advance > 0 || select.value !== "") {
            widget.classList.remove('hidden');
            if (dispSalary) dispSalary.textContent = salary.toFixed(2);
            if (dispAdvance) dispAdvance.textContent = advance.toFixed(2);
            if (dispDaily) dispDaily.textContent = (salary / 30).toFixed(2);
        } else {
            widget.classList.add('hidden');
        }
    }

    select.addEventListener('change', updateWidget);
    updateWidget(); // Run on load in case of old input
}
