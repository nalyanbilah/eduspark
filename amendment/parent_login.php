<?php
session_start();
include 'config/database.php';

$error = '';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(!empty($username) && !empty($password)){
        $stmt = $conn->prepare("SELECT id FROM parents WHERE username = ? AND password = ?"); 
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $stmt->store_result();

            //if matching user is found
            if($stmt-> num_rows > 0){
                $stmt->bind_result($id);
                $stmt->fetch();
                
                if (password_verify($password, $hashed_password)){
                    
                }
                //save user login session
                $_SESSION['student_logged_in'] = true;
                $_SESSION['student_id'] = $id;

                header("location: parent_dashboard.php"); //navigate file
                exit();
            } else {
                //if user not found
                $error = "Invalid username or password";
            }

        $stmt->close(); // Close the prepared statement

    } else {
        //if user not insert username and password 
        $error = "Please enter both username and password";
    } 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parent Login - EduSpark</title>
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
            <!-- Back button added here, inside the wrapper -->
            <a href="index.html" class="back-to-roles-btn">
                <i class="fas fa-arrow-left"></i>
            </a>
            
            <div class="login-header">
                <img src="https://images.vexels.com/media/users/3/224233/isolated/preview/d5ee0e9c87bb54cf867d7fb89c4570b8-online-education-logo.png" alt="EduSpark Logo" class="logo">
                <h1>Parent Portal Login</h1>
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
                        <i class="fas fa-user-friends"></i>
                    </div>
                    <input 
                        type="text" 
                        name="username" 
                        placeholder="Parent Username" 
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
                        placeholder="Password" 
                        required 
                        autocomplete="current-password"
                    >
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-login">
                        <i class="fas fa-sign-in-alt"></i> Access Parent Portal
                    </button>
                </div>
            </form>

            <div class="login-footer">
                <a href="forgot_password.php" class="forgot-password">
                    <i class="fas fa-question-circle"></i> Forgot Password?
                </a>
                <p class="signup-link">
                    New to Parent Portal? 
                    <a href="register.php">Create an Account</a>
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

    <script src="js/login.js"></script>
</body>
</html>