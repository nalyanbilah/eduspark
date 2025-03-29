<?php
session_start();
include 'config/database.php';
include 'prevent_resubmission.php';

// Function to process the form
function processYourForm() {
    global $conn;
    $email = $_POST['email'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate input
    if (empty($email) || empty($new_password) || empty($confirm_password)) {
        return "Please fill in all fields";
    }
    
    if ($new_password !== $confirm_password) {
        return "Passwords do not match";
    }
    
    if (strlen($new_password) < 8 || !preg_match('/[^a-zA-Z0-9]/', $new_password)) {
        return "Password must be at least 8 characters long and contain at least one special character";
    }

    // Determine the user type and corresponding table
    $user_types = [
        'student' => 'students',
        'teacher' => 'teachers',
        'parent' => 'parents',
        'admin' => 'admins'
    ];

    foreach ($user_types as $table) {
        $stmt = $conn->prepare("SELECT id FROM $table WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // Update password (consider hashing in production)
            $update_stmt = $conn->prepare("UPDATE $table SET password = ? WHERE email = ?");
            $update_stmt->bind_param("ss", $new_password, $email);
            
            if ($update_stmt->execute()) {
                $_SESSION['success'] = "Password reset successfully. Please log in with your new password.";
                header("Location: reset_password.php");
                exit();
            } else {
                return "Error updating password. Please try again.";
            }

        }
    }

    return "Email not found";
}

// Use the prevention function
$messages = preventFormResubmission('processYourForm');
$error = $messages['error'];
$success = $messages['success'];
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
    <link rel="stylesheet" href="stylesheets/reset_password.css">
    <link rel="stylesheet" href="stylesheets/transition.css">
</head>
<body>
    <div class="page-transition-overlay"></div>

    <div class="reset-password-container">
        <div class="reset-password-wrapper">

            <div class="reset-password-header">
                <img src="https://images.vexels.com/media/users/3/224233/isolated/preview/d5ee0e9c87bb54cf867d7fb89c4570b8-online-education-logo.png" alt="EduSpark Logo" class="logo">
                <h1>Reset Password</h1>
            </div>

            <?php if(!empty($error)): ?>
                <div class="error-message">
                    <i class="fas fa-exclamation-circle"></i>
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <?php if(!empty($success)): ?>
                <div class="success-message">
                    <i class="fas fa-check-circle"></i>
                    <?php echo htmlspecialchars($success); ?>
                </div>
            <?php endif; ?>

            <form method="post" class="reset-password-form">
                <div class="input-group">
                    <div class="input-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <input type="email" name="email" placeholder="Email" required autocomplete="email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                </div>

                <div class="input-group">
                    <div class="input-icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <input type="password" name="new_password" placeholder="New Password" required autocomplete="new-password">
                </div>

                <div class="input-group">
                    <div class="input-icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <input type="password" name="confirm_password" placeholder="Confirm New Password" required autocomplete="new-password">
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-reset">
                        <i class="fas fa-key"></i> Reset Password
                    </button>
                </div>
            </form>

            <div class="reset-password-footer">
                <p class="login-link">Remember your password? 
                    <a href="javascript:history.back()">Back to login Page</a>
                </p>
            </div>
        </div>

        <div class="login-background">
            <div class="background-overlay"></div>
            <div class="login-illustration">
                <img src="https://parentandteen.com/wp-content/uploads/show-teens-love.jpg" alt="Parent Monitoring Child's Education">
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const overlay = document.querySelector('.page-transition-overlay');
            
            // Remove overlay on page load
            setTimeout(() => {
                overlay.classList.remove('active');
            }, 500);

            // Back to roles transition
            const backBtn = document.querySelector('.back-to-roles-btn');
            backBtn.addEventListener('click', (e) => {
                e.preventDefault();
                overlay.classList.add('active');
                
                setTimeout(() => {
                    window.location.href = 'index.html';
                }, 500);
            });
        });
    </script>

    <script src="js/reset_password.js"></script>
    <?php echo preventResubmissionScript(); ?>
</body>
</html>
