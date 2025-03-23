<?php
session_start();

$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username && $password) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin_dashboard.php");
        exit();
    } else {
        $error = "Invalid administrator credentials";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator Login - EduConnect</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="stylesheets/login.css">
</head>
<body>
    <div class="login-container">
        <div class="login-wrapper">
            <div class="login-header">
            <img src="https://images.vexels.com/media/users/3/224233/isolated/preview/d5ee0e9c87bb54cf867d7fb89c4570b8-online-education-logo.png" alt="EduSpark Logo" class="logo">
                <h1>Administrator Login</h1>
            </div>

            <?php if(!empty($error)): ?>
                <div class="error-message">
                    <i class="fas fa-exclamation-circle"></i>
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <form method="post" class="login-form">
                <div class="input-group">
                    <div class="input-icon">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <input 
                        type="text" 
                        name="username" 
                        placeholder="Admin Username" 
                        required 
                        autocomplete="username"
                    >
                </div>

                <div class="input-group">
                    <div class="input-icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <input 
                        type="password" 
                        name="password" 
                        placeholder="Admin Password" 
                        required 
                        autocomplete="current-password"
                    >
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-login">
                        <i class="fas fa-sign-in-alt"></i> System Access
                    </button>
                </div>
            </form>

            <div class="login-footer">
                <a href="forgot-password.php" class="forgot-password">
                    <i class="fas fa-question-circle"></i> Forgot Password?
                </a>
            </div>
        </div>

        <div class="login-background">
            <div class="background-overlay"></div>
            <div class="login-illustration">
                <img src="https://majikan.b-cdn.net/wp-content/uploads/2023/12/tugas-skop-kerja-admin.png" alt="System Administration">
            </div>
        </div>
    </div>

    <script src="js/login.js"></script>
</body>
</html>