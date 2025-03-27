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
        window.location.href = 'logout.php';
    });

    // Quick action buttons
    const createLessonBtn = document.querySelector('.btn-primary');
    const generateReportBtn = document.querySelector('.btn-secondary');

    createLessonBtn.addEventListener('click', () => {
        alert('Create Lesson functionality to be implemented');
    });

    generateReportBtn.addEventListener('click', () => {
        alert('Generate Report functionality to be implemented');
    });
});