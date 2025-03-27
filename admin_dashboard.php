<?php
session_start();

// Ensure only logged-in admins can access
/*if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}*/

// Simulate admin data (replace with actual database queries)
$admin = [
    'name' => 'Sarah Williams',
    'avatar' => 'https://ui-avatars.com/api/?name=Sarah+Williams',
    'role' => 'System Administrator',
    'system_stats' => [
        'total_users' => 1500,
        'active_users' => 1200,
        'pending_issues' => 7,
        'recent_registrations' => 45
    ],
    'recent_users' => [
        [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'role' => 'Student',
            'status' => 'Active',
            'registration_date' => '2024-02-20'
        ],
        [
            'name' => 'Emily Smith',
            'email' => 'emily.smith@example.com',
            'role' => 'Teacher',
            'status' => 'Pending',
            'registration_date' => '2024-02-22'
        ]
    ],
    'system_issues' => [
        [
            'title' => 'Login Page Error',
            'priority' => 'high',
            'reported_date' => '2024-02-18',
            'status' => 'In Progress'
        ],
        [
            'title' => 'Dashboard Performance',
            'priority' => 'medium',
            'reported_date' => '2024-02-20',
            'status' => 'Pending'
        ]
    ],
    'recent_activities' => [
        [
            'action' => 'User Profile Updated',
            'details' => 'Modified profile for John Doe',
            'timestamp' => '2024-02-21 10:30:45'
        ],
        [
            'action' => 'System Backup',
            'details' => 'Completed full system backup',
            'timestamp' => '2024-02-22 09:15:22'
        ]
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - EduSpark</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" type="image/png" href="assets/icon.ico">
    <link rel="stylesheet" href="stylesheets/admin_dashboard.css">
</head>
<body>
    <div class="dashboard-container">
        <div class="sidebar">
            <div class="sidebar-header">
            <img src="https://images.vexels.com/media/users/3/224233/isolated/preview/d5ee0e9c87bb54cf867d7fb89c4570b8-online-education-logo.png" alt="EduSpark Logo" class="logo">
                <h2>EduSpark</h2>
            </div>
            <nav class="sidebar-nav">
                <ul>
                    <li class="active">
                        <i class="fas fa-home"></i> Dashboard
                    </li>
                    <li>
                        <i class="fas fa-users"></i> User Management
                    </li>
                    <li>
                        <i class="fas fa-server"></i> System Health
                    </li>
                    <li>
                        <i class="fas fa-shield-alt"></i> Security
                    </li>
                    <li>
                        <i class="fas fa-chart-bar"></i> Reports
                    </li>
                    <li>
                        <i class="fas fa-cog"></i> Settings
                    </li>
                    <li>
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </li>
                </ul>
            </nav>
        </div>

        <div class="main-content">
            <div class="dashboard-header">
                <div class="profile-section">
                    <img src="<?php echo $admin['avatar']; ?>" alt="Admin Avatar" class="profile-avatar">
                    <div class="profile-info">
                        <h1>Welcome, <?php echo $admin['name']; ?></h1>
                        <p><?php echo $admin['role']; ?></p>
                    </div>
                </div>
                <div class="quick-actions">
                    <button class="btn btn-primary">
                        <i class="fas fa-user-plus"></i> Create User
                    </button>
                    <button class="btn btn-secondary">
                        <i class="fas fa-tools"></i> System Maintenance
                    </button>
                </div>
            </div>

            <div class="dashboard-grid">
                <div class="system-stats-section">
                    <div class="section-card">
                        <div class="section-header">
                            <h2>System Statistics</h2>
                        </div>
                        <div class="stats-grid">
                            <div class="stat-item">
                                <i class="fas fa-users"></i>
                                <div class="stat-content">
                                    <h3><?php echo $admin['system_stats']['total_users']; ?></h3>
                                    <p>Total Users</p>
                                </div>
                            </div>
                            <div class="stat-item">
                                <i class="fas fa-user-check"></i>
                                <div class="stat-content">
                                    <h3><?php echo $admin['system_stats']['active_users']; ?></h3>
                                    <p>Active Users</p>
                                </div>
                            </div>
                            <div class="stat-item">
                                <i class="fas fa-exclamation-triangle"></i>
                                <div class="stat-content">
                                    <h3><?php echo $admin['system_stats']['pending_issues']; ?></h3>
                                    <p>Pending Issues</p>
                                </div>
                            </div>
                            <div class="stat-item">
                                <i class="fas fa-user-plus"></i>
                                <div class="stat-content">
                                    <h3><?php echo $admin['system_stats']['recent_registrations']; ?></h3>
                                    <p>Recent Registrations</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="recent-users-section">
                    <div class="section-card">
                        <div class="section-header">
                            <h2>Recent Users</h2>
                            <a href="#" class="view-all">Manage Users</a>
                        </div>
                        <?php foreach($admin['recent_users'] as $user): ?>
                            <div class="user-item">
                                <div class="user-info">
                                    <h3><?php echo $user['name']; ?></h3>
                                    <p><?php echo $user['email']; ?></p>
                                </div>
                                <div class="user-details">
                                    <span class="user-role"><?php echo $user['role']; ?></span>
                                    <span class="user-status <?php echo strtolower($user['status']); ?>">
                                        <?php echo $user['status']; ?>
                                    </span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="additional-sections">
                <div class="system-issues section-card">
                    <div class="section-header">
                        <h2>System Issues</h2>
                        <a href="#" class="view-all">All Issues</a>
                    </div>
                    <?php foreach($admin['system_issues'] as $issue): ?>
                        <div class="issue-item priority-<?php echo $issue['priority']; ?>">
                            <div class="issue-info">
                                <h3><?php echo $issue['title']; ?></h3>
                                <span class="issue-status"><?php echo $issue['status']; ?></span>
                            </div>
                            <div class="issue-meta">
                                <span class="issue-date"><?php echo $issue['reported_date']; ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="recent-activities section-card">
                    <div class="section-header">
                        <h2>Recent Activities</h2>
                    </div>
                    <?php foreach($admin['recent_activities'] as $activity): ?>
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-history"></i>
                            </div>
                            <div class="activity-details">
                                <h3><?php echo $activity['action']; ?></h3>
                                <p><?php echo $activity['details']; ?></p>
                                <span class="activity-time"><?php echo $activity['timestamp']; ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="js/admin_dashboard.js"></script>
</body>
</html>