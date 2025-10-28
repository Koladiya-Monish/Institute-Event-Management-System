<?php require_once 'config.php'; ?>

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

$showOtpField = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Step 1: Sending OTP
    if (isset($_POST['sendotp']) && !isset($_POST['otp'])) {
        $email = $_POST['email'];
        
        // Check if user exists
        $sql = "SELECT * FROM tbluser WHERE emailid='$email'";
        $query = mysqli_query($connect, $sql);
        $user = mysqli_fetch_assoc($query);

        if ($user) {
            $otp = rand(100000, 999999);
            $otp_expiry = date("Y-m-d H:i:s", strtotime("+3 minutes"));

            // Save OTP in DB
            mysqli_query($connect, "UPDATE tbluser SET otp='$otp', otp_expiry='$otp_expiry' WHERE id=".$user['id']);

            // Send OTP via email
            try {
                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = '23bmiit044@gmail.com'; // your email
                $mail->Password = 'xyoh bzxz rvkr zrpx'; // app password
                $mail->Port = 465;
                $mail->SMTPSecure = 'ssl';
                $mail->isHTML(true);
                $mail->setFrom('23bmiit044@gmail.com', 'IEMS System');
                $mail->addAddress($email, $user['fname']); 
                $mail->Subject = "OTP for Password Reset";
                $mail->Body = "Your OTP for password reset is: <b>$otp</b>";
                $mail->send();

                $_SESSION['otp_email'] = $email;
                $showOtpField = true;
                $successMsg = "OTP has been sent to $email.";
            } catch (Exception $e) {
                $errorMsg = "Could not send OTP. Mailer Error: " . $mail->ErrorInfo;
            }

        } else {
            $errorMsg = "Email not found in our system.";
        }
    }

    // Step 2: Verify OTP
    if (isset($_POST['sendotp']) && isset($_POST['otp'])) {
        $email = $_SESSION['otp_email'];
        $enteredOtp = $_POST['otp'];

        $sql = "SELECT * FROM tbluser WHERE emailid='$email' AND otp='$enteredOtp'";
        $query = mysqli_query($connect, $sql);
        $user = mysqli_fetch_assoc($query);

        if ($user) {
            if (strtotime($user['otp_expiry']) >= time()) {
                $_SESSION['reset_user'] = $user['id'];
                // Clear OTP after successful verification
                mysqli_query($connect, "UPDATE tbluser SET otp=NULL, otp_expiry=NULL WHERE id=".$user['id']);
                header("Location: change-password.php");
                exit();
            } else {
                $errorMsg = "OTP has expired. Please try again.";
                $showOtpField = true;
            }
        } else {
            $errorMsg = "Invalid OTP. Please try again.";
            $showOtpField = true;
        }
    }
}
?>

<?php
//use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\Exception;
//
//require './PHPMailer/src/Exception.php';
//require './PHPMailer/src/PHPMailer.php';
//require './PHPMailer/src/SMTP.php';
//
//// --- Handle form submission ---
//if ($_SERVER["REQUEST_METHOD"] == "POST") {
//    $email = trim($_POST['email']);
//    $otp = trim($_POST['otp'] ?? '');
//
//    // Step 1: Send OTP
//    if (isset($_POST['sendotp']) && empty($otp)) {
//        $sql = "SELECT * FROM tbluser WHERE emailid='$email'";
//        $result = mysqli_query($connect, $sql);
//        $data = mysqli_fetch_assoc($result);
//
//        if ($data) {
//            $otp_code = rand(100000, 999999);
//            $otp_expiry = date("Y-m-d H:i:s", strtotime("+3 minute"));
//
//            // Save OTP in DB
//            $update = "UPDATE tbluser SET otp='$otp_code', otp_expiry='$otp_expiry' WHERE id=".$data['id'];
//            mysqli_query($connect, $update);
//
//            // Send email
//            $mail = new PHPMailer(true);
//            try {
//                $mail->isSMTP();
//                $mail->Host = 'smtp.gmail.com';
//                $mail->SMTPAuth = true;
//                $mail->Username = '23bmiit044@gmail.com'; // Your Gmail
//                $mail->Password = 'xyohbzxzrvkrzrpx'; // Gmail App Password
//                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
//                $mail->Port = 465;
//                $mail->isHTML(true);
//                $mail->setFrom('23bmiit044@gmail.com', 'Institute Event Management System');
//                $mail->addAddress($email, $data['fname'] . ' ' . $data['lname']);
//                $mail->Subject = 'Password Reset OTP';
//                $mail->Body = "<p>Your OTP for password reset is <b>$otp_code</b>. It will expire in 3 minutes.</p>";
//                $mail->send();
//
//                $_SESSION['otp_email'] = $email;
//                $_SESSION['otp_sent'] = true;
//
//                echo "<script>alert('OTP sent to $email. Please check your inbox.'); window.location.href='forgot-password.php';</script>";
//                exit;
//            } catch (Exception $e) {
//                echo "<script>alert('Email not sent. Error: {$mail->ErrorInfo}');</script>";
//            }
//        } else {
//            echo "<script>alert('Email not found in system.');</script>";
//        }
//    }
//
//    // Step 2: Verify OTP
//    elseif (!empty($otp)) {
//        $email = $_SESSION['otp_email'] ?? '';
//        $sql = "SELECT * FROM tbluser WHERE emailid='$email' AND otp='$otp'";
//        $result = mysqli_query($connect, $sql);
//        $data = mysqli_fetch_assoc($result);
//
//        if ($data) {
//            $current_time = date("Y-m-d H:i:s");
//            if ($current_time <= $data['otp_expiry']) {
//                $_SESSION['reset_user'] = $data['id'];
//                echo "<script>alert('OTP verified successfully! You can now reset your password.'); window.location.href='change-password.php';</script>";
//                exit;
//            } else {
//                echo "<script>alert('OTP expired. Please request a new one.'); window.location.href='forgot-password.php';</script>";
//            }
//        } else {
//            echo "<script>alert('Invalid OTP. Please try again.');</script>";
//        }
//    }
//}
//?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - IEMS</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="home.php" class="logo">IEMS</a>
            <ul class="nav-menu">
                <li><a href="home.php" class="nav-link">Home</a></li>
                <li><a href="home.php#about" class="nav-link">About Us</a></li>
                <li><a href="event-category.php" class="nav-link">Events</a></li>
                <li><a href="login.php" class="nav-link">Login</a></li>
            </ul>
        </div>
    </nav>

    <main class="main-content">
        <section class="section">
            <div class="form-container">
                <h2 class="text-center mb-2">Reset Password</h2>
                <p class="text-center mb-2" style="color: #666;">Enter your email address to receive password reset instructions</p>
                
                <form id="forgotPasswordForm" method="post">
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>
                    
                    <!-- OTP Input Field (initially hidden) -->
                    <div class="form-group" id="otpSection" style="display: none;">
                        <label for="otp">Enter OTP</label>
                        <input type="text" id="otp" name="otp" class="form-control" placeholder="Enter 6-digit OTP" maxlength="6">
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" name="sendotp" class="btn" id="submitBtn" onclick="sendotp()" style="width: 100%;">Send OTP</button>
                    </div>
                    
                    <div class="text-center">
                        <a href="login.php" style="color: #667eea; text-decoration: none;">Back to Login</a>
                    </div>
                </form>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2025 Institute Event Management System. All rights reserved.</p>
    </footer>

    <script>
        let otpSent = false;
        
        document.getElementById('forgotPasswordForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const email = document.getElementById('email').value;
            const otp = document.getElementById('otp').value;
            const submitBtn = document.getElementById('submitBtn');
            const otpSection = document.getElementById('otpSection');
            
            if (!otpSent) {
                // First click - send OTP
                if (email) {    
                    // Show OTP input field
                    otpSection.style.display = 'block';
                    
                    // Change button text
                    submitBtn.textContent = 'Verify OTP';
                    
                    // Show success message
                    alert('OTP has been sent to ' + email + '. Please check your email and enter the OTP below.');
                    
                    // Mark OTP as sent
                    otpSent = true;
                    
                    // Make OTP field required
                    document.getElementById('otp').required = true;
                }
            } else {
                // Second click - verify OTP
                if (otp) {
                    // Here you would normally verify the OTP with your backend
                    // For demo purposes, we'll accept any 6-digit number
                    if (otp.length === 6 && /^\d+$/.test(otp)) {
                        alert('OTP verified successfully! You can now reset your password.');
                        window.location.href = 'change-password.php';
                    } else {
                        alert('Please enter a valid 6-digit OTP.');
                    }
                } else {
                    alert('Please enter the OTP sent to your email.');
                }
            }
        });
    </script>
</body>
</html>
