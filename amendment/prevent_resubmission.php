<?php
// this file for prevent re-submit submission

/**
 * Prevents form resubmission and manages session-based messages
 * 
 * @param callable $processFormFunction Function to process form submission
 * @return array Containing 'error' and 'success' messages
 */
function preventFormResubmission($processFormFunction) {
    // Start session if not already started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $error = '';
    $success = '';

    // Retrieve and clear any existing session messages
    if (isset($_SESSION['error'])) {
        $error = $_SESSION['error'];
        unset($_SESSION['error']);
    }

    if (isset($_SESSION['success'])) {
        $success = $_SESSION['success'];
        unset($_SESSION['success']);
    }

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        try {
            // Call the provided processing function
            $result = $processFormFunction();

            // Handle the result
            if ($result === true) {
                // Success case
                $_SESSION['success'] = "Operation completed successfully.";
                header("Location: " . $_SERVER['PHP_SELF']);
                exit();
            } elseif (is_string($result)) {
                // Error case with message
                $_SESSION['error'] = $result;
                header("Location: " . $_SERVER['PHP_SELF']);
                exit();
            }
        } catch (Exception $e) {
            // Unexpected error
            $_SESSION['error'] = "An unexpected error occurred: " . $e->getMessage();
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }
    }

    // Return messages for display
    return [
        'error' => $error,
        'success' => $success
    ];
}

/**
 * JavaScript to prevent form resubmission on page reload
 * 
 * @return string HTML script tag
 */
function preventResubmissionScript() {
    return <<<HTML
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Prevent form resubmission
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }
        });
    </script>
HTML;
}
?>