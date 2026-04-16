/**
 * Settings Page Logic
 */
export function initSettings() {
    const logoInput = document.getElementById('logo-input');
    const fileName = document.getElementById('file-name');
    
    if (logoInput && fileName) {
        logoInput.addEventListener('change', function(e) {
            const name = e.target.files[0] ? e.target.files[0].name : 'Selecciona un archivo...';
            fileName.textContent = name;
        });
    }

    // Color picker logic (if exists)
    const colorInputs = document.querySelectorAll('input[type="color"]');
    colorInputs.forEach(input => {
        input.addEventListener('change', function() {
            console.log('Color changed:', this.value);
        });
    });
}
