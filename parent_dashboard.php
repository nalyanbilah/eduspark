<?php
session_start();

// Ensure only logged-in parents can access
/*if (!isset($_SESSION['parent_logged_in']) || $_SESSION['parent_logged_in'] !== true) {
    header("Location: parent_login.php");
    exit();
}*/

// Simulate parent and student data (replace with actual database queries)
$parent = [
    'name' => 'Sarah Johnson',
    'avatar' => 'https://ui-avatars.com/api/?name=Sarah+Johnson',
    'children' => [
        [
            'name' => 'Emily Johnson',
            'grade' => '8th Grade',
            'avatar' => 'https://ui-avatars.com/api/?name=Emily+Johnson',
            'courses' => [
                [
                    'name' => 'Mathematics',
                    'progress' => 85,
                    'grade' => 'A',
                    'instructor' => 'Mr. Smith',
                    'color' => '#3498db'
                ],
                [
                    'name' => 'Science',
                    'progress' => 75,
                    'grade' => 'B+',
                    'instructor' => 'Ms. Johnson',
                    'color' => '#2ecc71'
                ]
            ],
            'recent_activities' => [
                [
                    'type' => 'assignment',
                    'subject' => 'Mathematics',
                    'title' => 'Algebra Homework',
                    'date' => '2024-02-15',
                    'status' => 'Submitted'
                ],
                [
                    'type' => 'quiz',
                    'subject' => 'Science',
                    'title' => 'Biology Quiz',
                    'date' => '2024-02-10',
                    'status' => 'Completed'
                ]
            ]
        ]
    ],
    'messages' => [
        [
            'sender' => 'Mr. Smith',
            'subject' => 'Emily\'s Performance',
            'excerpt' => 'Emily is doing great in mathematics...',
            'date' => '2024-02-20',
            'read' => false
        ],
        [
            'sender' => 'School Administration',
            'subject' => 'Upcoming Parent-Teacher Meeting',
            'excerpt' => 'The annual parent-teacher meeting is scheduled...',
            'date' => '2024-02-18',
            'read' => true
        ]
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parent Dashboard - EduSpark</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" type="image/png" href="assets/icon.ico">
    <link rel="stylesheet" href="stylesheets/dashboard.css">
    <link rel="stylesheet" href="stylesheets/parent_dashboard.css">
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
                        <i class="fas fa-child"></i> My Children
                    </li>
                    <li>
                        <i class="fas fa-envelope"></i> Messages
                    </li>
                    <li>
                        <i class="fas fa-calendar-alt"></i> School Events
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
            <div class="profile-header">
                <img src="<?php echo $parent['avatar']; ?>" alt="Parent Avatar" class="profile-avatar">
                <div>
                    <h1>Welcome, <?php echo $parent['name']; ?></h1>
                    <p>Parent Dashboard</p>
                </div>
            </div>

            <div class="dashboard-grid">
                <div class="children-section">
                    <?php foreach($parent['children'] as $child): ?>
                        <div class="child-card">
                            <div class="child-header">
                                <img src="<?php echo $child['avatar']; ?>" alt="<?php echo $child['name']; ?>" class="child-avatar">
                                <div>
                                    <h2><?php echo $child['name']; ?></h2>
                                    <p><?php echo $child['grade']; ?></p>
                                </div>
                            </div>

                            <div class="child-courses">
                                <h3>Course Progress</h3>
                                <?php foreach($child['courses'] as $course): ?>
                                    <div class="course-item">
                                        <div class="course-info">
                                            <h4><?php echo $course['name']; ?></h4>
                                            <span class="course-grade"><?php echo $course['grade']; ?></span>
                                        </div>
                                        <div class="progress-bar">
                                            <div 
                                                class="progress-fill" 
                                                style="width: <?php echo $course['progress']; ?>%; background-color: <?php echo $course['color']; ?>"
                                            ></div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="activities-section">
                    <div class="recent-activities card">
                        <h2>Recent Activities</h2>
                        <?php foreach($parent['children'][0]['recent_activities'] as $activity): ?>
                            <div class="activity-item">
                                <div class="activity-icon">
                                    <i class="<?php 
                                        echo $activity['type'] === 'assignment' 
                                            ? 'fas fa-file-alt' 
                                            : 'fas fa-clipboard-check'; 
                                    ?>"></i>
                                </div>
                                <div class="activity-details">
                                    <h3><?php echo $activity['title']; ?></h3>
                                    <p><?php echo $activity['subject']; ?> | <?php echo $activity['date']; ?></p>
                                    <span class="activity-status"><?php echo $activity['status']; ?></span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="messages card">
                        <h2>Messages 
                            <span class="unread-count">
                                <?php 
                                echo count(array_filter($parent['messages'], function($msg) {
                                    return !$msg['read'];
                                })); 
                                ?> Unread
                            </span>
                        </h2>
                        <?php foreach($parent['messages'] as $message): ?>
                            <div class="message-item <?php echo $message['read'] ? 'read' : 'unread'; ?>">
                                <div class="message-sender"><?php echo $message['sender']; ?></div>
                                <div class="message-content">
                                    <h3><?php echo $message['subject']; ?></h3>
                                    <p><?php echo $message['excerpt']; ?></p>
                                </div>
                                <div class="message-date"><?php echo $message['date']; ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/parent_dashboard.js"></script>
</body>
</html>