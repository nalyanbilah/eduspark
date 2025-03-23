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
                    window.location.href = 'parents_login.php';
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