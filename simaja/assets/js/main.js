document.addEventListener('DOMContentLoaded', function () {
    console.log('SIMAJA JS Loaded');
    
    // Contoh interaksi sederhana
    const alertBoxes = document.querySelectorAll('.alert');
    alertBoxes.forEach(alert => {
        setTimeout(() => {
            alert.style.display = 'none';
        }, 3000); // Auto-hide after 3 sec
    });
});
