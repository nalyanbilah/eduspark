<?php
session_start();
require_once 'config/database.php';

$error = '';
$success = '';
$token = $_GET['token'] ?? '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password !== $confirm_password) {
        $error = "Passwords do not match";
    } else {
        try {
            // Verify token and check expiry
            $stmt = $pdo->prepare("SELECT * FROM users WHERE reset_token = ? AND reset_expires > NOW()");
            $stmt->execute([$token]);
            $user = $stmt->fetch();

            if ($user) {
                // Hash new password
                $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

                // Update password and clear reset token
                $stmt = $pdo->prepare("UPDATE users SET password = ?, reset_token = NULL, reset_expires = NULL WHERE id = ?");
                $stmt->execute([$hashed_password, $user['id']]);

                $success = "Password reset successfully. You can now login.";
            } else {
                $error = "Invalid or expired reset token.";
            }
        } catch (Exception $e) {
            $error = "Error: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - EduSpark</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" type="image/png" href="assets/icon.ico">
    <link rel="stylesheet" href="stylesheets/login.css">
    <link rel="stylesheet" href="stylesheets/transition.css">
</head>
<body>
    <div class="page-transition-overlay"></div>

    <div class="login-container">
        <div class="login-wrapper">
            <div class="login-header">
                <img src="https://images.vexels.com/media/users/3/224233/isolated/preview/d5ee0e9c87bb54cf867d7fb89c4570b8-online-education-logo.png" alt="EduSpark Logo" class="logo">
                <h1>Reset Password</h1>
                <p class="tagline">Create a new password</p>
            </div>

            <?php if(!empty($error)): ?>
                <div class="error-message">
                    <i class="fas fa-exclamation-circle"></i>
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <?php if(!empty($success)): ?>
                <div class="success-message">
                    <i class="fas fa-check-circle"></i>
                    <?php echo $success; ?>
                    <a href="student_login.php">Go to Login</a>
                </div>
            <?php endif; ?>

            <?php if(empty($success)): ?>
            <form method="post" class="login-form">
                <div class="input-group">
                    <div class="input-icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <input 
                        type="password" 
                        name="new_password" 
                        placeholder="New Password" 
                        required 
                        autocomplete="new-password"
                    >
                </div>

                <div class="input-group">
                    <div class="input-icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <input 
                        type="password" 
                        name="confirm_password" 
                        placeholder="Confirm New Password" 
                        required 
                        autocomplete="new-password"
                    >
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-login">
                        <i class="fas fa-redo"></i> Reset Password
                    </button>
                </div>
            </form>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>