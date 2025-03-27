<?php
session_start();

// Ensure only logged-in teachers can access
/*if (!isset($_SESSION['teacher_logged_in']) || $_SESSION['teacher_logged_in'] !== true) {
    header("Location: teacher_login.php");
    exit();
}*/

// Simulate teacher data (replace with actual database queries)
$teacher = [
    'name' => 'Mr. David Thompson',
    'avatar' => 'https://ui-avatars.com/api/?name=David+Thompson',
    'subject' => 'Mathematics',
    'classes' => [
        [
            'name' => '10th Grade Math',
            'students_count' => 25,
            'average_performance' => 78,
            'color' => '#3498db'
        ],
        [
            'name' => '11th Grade Advanced Math',
            'students_count' => 18,
            'average_performance' => 85,
            'color' => '#2ecc71'
        ]
    ],
    'recent_lessons' => [
        [
            'title' => 'Algebra Fundamentals',
            'class' => '10th Grade Math',
            'date' => '2024-02-20',
            'status' => 'Completed'
        ],
        [
            'title' => 'Trigonometry',
            'class' => '11th Grade Advanced Math',
            'date' => '2024-02-22',
            'status' => 'In Progress'
        ]
    ],
    'student_performance' => [
        [
            'name' => 'Emily Johnson',
            'class' => '10th Grade Math',
            'grade' => 'A',
            'progress' => 90
        ],
        [
            'name' => 'Michael Chen',
            'class' => '11th Grade Advanced Math',
            'grade' => 'B+',
            'progress' => 75
        ]
    ],
    'upcoming_tasks' => [
        [
            'title' => 'Midterm Exam Preparation',
            'deadline' => '2024-03-15',
            'priority' => 'high'
        ],
        [
            'title' => 'Student Performance Reports',
            'deadline' => '2024-03-10',
            'priority' => 'medium'
        ]
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard - EduSpark</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" type="image/png" href="assets/icon.ico">
    <link rel="stylesheet" href="stylesheets/teacher_dashboard.css">
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
                        <i class="fas fa-book"></i> Lessons
                    </li>
                    <li>
                        <i class="fas fa-users"></i> Classes
                    </li>
                    <li>
                        <i class="fas fa-chart-line"></i> Performance
                    </li>
                    <li>
                        <i class="fas fa-comments"></i> Feedback
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
                    <img src="<?php echo $teacher['avatar']; ?>" alt="Teacher Avatar" class="profile-avatar">
                    <div class="profile-info">
                        <h1>Welcome, <?php echo $teacher['name']; ?></h1>
                        <p><?php echo $teacher['subject']; ?> Department</p>
                    </div>
                </div>
                <div class="quick-actions">
                    <button class="btn btn-primary">
                        <i class="fas fa-plus"></i> Create Lesson
                    </button>
                    <button class="btn btn-secondary">
                        <i class="fas fa-file-alt"></i> Generate Report
                    </button>
                </div>
            </div>

            <div class="dashboard-grid">
                <div class="classes-section">
                    <div class="section-card">
                        <div class="section-header">
                            <h2>My Classes</h2>
                            <a href="#" class="view-all">View All</a>
                        </div>
                        <?php foreach($teacher['classes'] as $class): ?>
                            <div class="class-item">
                                <div class="class-info">
                                    <h3><?php echo $class['name']; ?></h3>
                                    <div class="class-stats">
                                        <span>
                                            <i class="fas fa-users"></i> 
                                            <?php echo $class['students_count']; ?> Students 
                                        </span>
                                        <span>&nbsp;&nbsp;&nbsp;
                                            <i class="fas fa-chart-bar"></i> 
                                            <?php echo $class['average_performance']; ?>% Avg. Performance 
                                        </span>
                                    </div>
                                </div>
                                <div class="class-progress">
                                    <div 
                                        class="progress-bar" 
                                        style="background-color: <?php echo $class['color']; ?>; width: <?php echo $class['average_performance']; ?>%"
                                    ></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="performance-section">
                    <div class="section-card">
                        <div class="section-header">
                            <h2>Student Performance</h2>
                            <a href="#" class="view-all">Detailed View</a>
                        </div>
                        <?php foreach($teacher['student_performance'] as $student): ?>
                            <div class="student-performance-item">
                                <div class="student-info">
                                    <h3><?php echo $student['name']; ?></h3>
                                    <p><?php echo $student['class']; ?></p>
                                </div>
                                <div class="student-grade">
                                    <span class="grade"><?php echo $student['grade']; ?></span>
                                    <div class="progress-bar">
                                        <div 
                                            class="progress-fill" 
                                            style="width: <?php echo $student['progress']; ?>%"
                                        ></div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="additional-sections">
                <div class="recent-lessons section-card">
                    <div class="section-header">
                        <h2>Recent Lessons</h2>
                        <a href="#" class="view-all">All Lessons</a>
                    </div>
                    <?php foreach($teacher['recent_lessons'] as $lesson): ?>
                        <div class="lesson-item">
                            <div class="lesson-info">
                                <h3><?php echo $lesson['title']; ?></h3>
                                <p><?php echo $lesson['class']; ?></p>
                            </div>
                            <div class="lesson-meta">
                                <span class="lesson-date"><?php echo $lesson['date']; ?></span>
                                <span class="lesson-status"><?php echo $lesson['status']; ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="upcoming-tasks section-card">
                    <div class="section-header">
                        <h2>Upcoming Tasks</h2>
                    </div>
                    <?php foreach($teacher['upcoming_tasks'] as $task): ?>
                        <div class="task-item priority-<?php echo $task['priority']; ?>">
                            <div class="task-info">
                                <h3><?php echo $task['title']; ?></h3>
                                <span class="task-deadline"><?php echo $task['deadline']; ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="js/teacher_dashboard.js"></script>
</body>
</html>