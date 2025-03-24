<?php
session_start();

// Ensure only logged-in students can access
/*if (!isset($_SESSION['student_logged_in']) || $_SESSION['student_logged_in'] !== true) {
    header("Location: student_login.php");
    exit();
}*/

// Simulate student data (replace with actual database queries)
$student = [
    'name' => 'John Doe',
    'role' => 'Student',
    'grade' => '10th Grade',
    'avatar' => 'https://ui-avatars.com/api/?name=John+Doe',
    'courses' => [
        [
            'name' => 'Mathematics',
            'progress' => 75,
            'instructor' => 'Mr. Smith',
            'color' => '#3498db',
            'icon' => 'fas fa-calculator'
        ],
        [
            'name' => 'Science',
            'progress' => 60,
            'instructor' => 'Ms. Johnson',
            'color' => '#2ecc71',
            'icon' => 'fas fa-flask'
        ],
        [
            'name' => 'English',
            'progress' => 90,
            'instructor' => 'Mrs. Williams',
            'color' => '#e74c3c',
            'icon' => 'fas fa-book'
        ]
    ],
    'achievements' => [
        [
            'title' => 'Perfect Attendance', 
            'icon' => '🏆',
            'description' => 'Attended all classes this semester',
            'date' => 'Jan 2024'
        ],
        [
            'title' => 'Math Champion', 
            'icon' => '🥇',
            'description' => 'Highest score in mathematics',
            'date' => 'Feb 2024'
        ]
    ],
    'upcoming_events' => [
        [
            'title' => 'Math Olympiad',
            'date' => 'March 15, 2024',
            'time' => '10:00 AM'
        ],
        [
            'title' => 'Science Fair',
            'date' => 'April 20, 2024',
            'time' => '2:00 PM'
        ]
    ],
    'stats' => [
        'total_courses' => 3,
        'completed_courses' => 1,
        'average_grade' => 85
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - EduSpark</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" type="image/png" href="assets/icon.ico">
    <link rel="stylesheet" href="stylesheets/dashboard.css">
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
                        <i class="fas fa-book"></i> Courses
                    </li>
                    <li>
                        <i class="fas fa-trophy"></i> Achievements
                    </li>
                    <li>
                        <i class="fas fa-comment"></i> Feedback
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
                <img src="<?php echo $student['avatar']; ?>" alt="Student Avatar" class="profile-avatar">
                <div>
                    <h1>Welcome, <?php echo $student['name']; ?></h1>
                    <p><?php echo $student['grade']; ?> | Total Courses: <?php echo $student['stats']['total_courses']; ?></p>
                </div>
            </div>

            <div class="dashboard-grid">
                <div class="courses-section">
                    <div class="course-card">
                        <h2>Your Courses</h2>
                        <?php foreach($student['courses'] as $course): ?>
                            <div class="course-item">
                                <div 
                                    class="course-icon" 
                                    style="background-color: <?php echo $course['color']; ?>; color: white;"
                                >
                                    <i class="<?php echo $course['icon']; ?>"></i>
                                </div>
                                <div style="flex-grow: 1;">
                                    <h3><?php echo $course['name']; ?></h3>
                                    <p>Instructor: <?php echo $course['instructor']; ?></p>
                                    <div class="progress-bar">
                                        <div 
                                            class="progress-fill" 
                                            style="width: <?php echo $course['progress']; ?>%; background-color: <?php echo $course['color']; ?>"
                                        ></div>
                                    </div>
                                    <small><?php echo $course['progress']; ?>% Complete</small>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="events-section">
                    <div class="events-card">
                        <h2>Upcoming Events</h2>
                        <?php foreach($student['upcoming_events'] as $event): ?>
                            <div class="event-item">
                                <div>
                                    <h3><?php echo $event['title']; ?></h3>
                                    <small><?php echo $event['date']; ?></small>
                                </div>
                                <span><?php echo $event['time']; ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/dashboard.js"></script>
</body>
</html>