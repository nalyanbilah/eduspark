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

    // Message interaction
    const messages = document.querySelectorAll('.message-item');
    messages.forEach(message => {
        message.addEventListener('click', function() {
            // Toggle read/unread status
            this.classList.toggle('unread');
        });
    });
});