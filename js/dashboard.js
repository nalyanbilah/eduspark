document.addEventListener('DOMContentLoaded', () => {
    // Sidebar navigation
    const sidebarItems = document.querySelectorAll('.sidebar-nav ul li');
    sidebarItems.forEach(item => {
        item.addEventListener('click', function() {
            // Remove active class from all items
            sidebarItems.forEach(i => i.classList.remove('active'));
            
            // Add active class to clicked item
            this.classList.add('active');
        });
    });

    // Logout functionality
    const logoutItem = document.querySelector('.sidebar-nav ul li:last-child');
    logoutItem.addEventListener('click', () => {
        // Redirect to logout page
        window.location.href = '../logout.php';
    });

    // Optional: Hover effects for course items
    const courseItems = document.querySelectorAll('.course-item');
    courseItems.forEach(item => {
        item.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.02)';
            this.style.transition = 'transform 0.3s ease';
        });

        item.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    });
});