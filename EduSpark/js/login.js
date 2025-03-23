document.addEventListener('DOMContentLoaded', () => {
    const inputs = document.querySelectorAll('.login-form input');
    
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.querySelector('.input-icon i').style.color = '#3498db';
        });

        input.addEventListener('blur', function() {
            this.parentElement.querySelector('.input-icon i').style.color = '#bdc3c7';
        });
    });
});