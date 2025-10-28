<?php
session_start();
include 'config.php';
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
                header("Location: change-password.php?from=forgot");
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - IEMS</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
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
                <?php if(!empty($errorMsg)) echo "<p style='color:red;'>$errorMsg</p>"; ?>
                <?php if(!empty($successMsg)) echo "<p style='color:green;'>$successMsg</p>"; ?>
                
                <form method="post">
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" class="form-control" 
                               value="<?php echo isset($_SESSION['otp_email']) ? $_SESSION['otp_email'] : ''; ?>" 
                               <?php echo $showOtpField ? "readonly" : "required"; ?>>
                    </div>

                    <?php if($showOtpField) { ?>
                    <div class="form-group">
                        <label for="otp">Enter OTP</label>
                        <input type="text" id="otp" name="otp" class="form-control" placeholder="Enter 6-digit OTP" maxlength="6" required>
                    </div>
                    <?php } ?>

                    <div class="form-group">
                        <button type="submit" name="sendotp" class="btn" style="width: 100%;">
                            <?php echo $showOtpField ? "Verify OTP" : "Send OTP"; ?>
                        </button>
                    </div>

                    <div class="text-center">
                        <a href="login.php" style="color: #667eea; text-decoration: none;">Back to Login</a>
                    </div>
                </form>
            </div>
        </section>
    </main>

    <footer class="footer">
        <p>&copy; 2025 Institute Event Management System. All rights reserved.</p>
    </footer>
</body>
</html>