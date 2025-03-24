document.addEventListener('DOMContentLoaded', () => {
    const roleCards = document.querySelectorAll('.role-card');

    roleCards.forEach(card => {
        card.addEventListener('click', () => {
            const role = card.getAttribute('data-role');
            
            // Redirect based on role
            switch(role) {
                case 'student':
                    window.location.href = 'student_login.php';
                    break;
                case 'parent':
                    window.location.href = 'parent_login.php';
                    break;
                case 'teacher':
                    window.location.href = 'teacher_login.php';
                    break;
                case 'admin':
                    window.location.href = 'admin_login.php';
                    break;
            }
        });
    });
});

function navigateToLogin(role) {
    const overlay = document.querySelector('.page-transition-overlay');
    
    // Add active class to trigger transition
    overlay.classList.add('active');
    
    // Navigate after transition
    setTimeout(() => {
        switch(role) {
            case 'student':
                window.location.href = 'student/login.php';
                break;
            case 'parent':
                window.location.href = 'parent/login.php';
                break;
            case 'teacher':
                window.location.href = 'teacher/login.php';
                break;
            case 'admin':
                window.location.href = 'admin/login.php';
                break;
        }
    }, 500); // Match this with CSS transition time
}

// Optional: Add page load transition
document.addEventListener('DOMContentLoaded', () => {
    const overlay = document.querySelector('.page-transition-overlay');
    
    // Remove overlay on page load
    setTimeout(() => {
        overlay.classList.remove('active');
    }, 500);
});