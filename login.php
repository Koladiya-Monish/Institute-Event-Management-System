<?php require_once 'config.php'; ?>
<?php session_start(); ?>

<?php 
if(isset($_SESSION['user'])){
    if($_SESSION['user'] == 'Admin'){
        header('Location: admin-dashboard.php');
    } else {
        header('Location: home.php');
    }
}
?>

<?php
$error = "";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === 'Admin' && $password === 'Admin123') {
        $_SESSION['user'] = 'Admin';
        header('Location: admin-dashboard.php');
        exit();
    }

    $query1 = "SELECT s.enro, u.password FROM tbluser u JOIN tblstudent s ON u.id = s.userid WHERE s.enro = '$username' AND u.password = '$password';";
    $r1 = mysqli_query($connect, $query1);

    if (mysqli_num_rows($r1) > 0) {
        $_SESSION['user'] = 'Student';
        $_SESSION['username'] = $username;
        header('Location: home.php');
        exit();
    } else {
        $error = "Invalid Username or Password";
    }
    
    
    $query2 = "SELECT f.id, u.password FROM tbluser u JOIN tblfaculty f ON u.id = f.userid WHERE f.id = '$username' AND u.password = '$password';";
    $r2 = mysqli_query($connect, $query2);

    if (mysqli_num_rows($r2) > 0) {
        $_SESSION['user'] = 'Faculty';
        $_SESSION['username'] = $username;
        header('Location: home.php');
        exit();
    } else {
        $error = "Invalid Username or Password...";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login - IEMS</title>
        <link rel="stylesheet" href="styles.css">
        
        <!-- Font Awesome (for eye icons) -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        <style>
            .password-wrapper {
                position: relative;
                width: 100%;
            }

            .password-wrapper input {
                width: 100%;
                padding-right: 40px; /* space for the eye icon */
            }

            .password-wrapper i {
                position: absolute;
                right: 10px;
                top: 50%;
                transform: translateY(-50%);
                cursor: pointer;
                color: #666;
            }
        </style>
        
        <script type="text/javascript">
            function preventBack() {
                window.history.forward();
            }

            setTimeout("preventBack()", 0);

            window.onunload = function () {
                null
            };
        </script>
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
                    <h2 class="text-center mb-2">Login to IEMS</h2>
                    <p class="text-center mb-2" style="color: #666;">Enter your credentials to access your account</p>

                    <form id="loginForm" method="POST">                        
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <div class="password-wrapper">
                                <input type="password" id="password" name="password" class="form-control" value="<?php echo $editpassword ?? ''; ?>" required>
                                <i id="eyeIcon" class="fa fa-eye" onclick="togglePassword()"></i>
                            </div>
                        </div>

                        <?php if (!empty($error)): ?>
                            <div class="error-message" style="color: red; text-align: center; margin-bottom: 10px;">
                                <?= $error ?>
                            </div>
                        <?php endif; ?>

                        <div class="form-group">
                            <button type="submit" name="login" class="btn" style="width: 100%;">Login</button>
                        </div>

                        <div class="text-center">
                            <a href="forgot-password.php" style="color: #667eea; text-decoration: none;">Forgot Password?</a>
                        </div>
                    </form>
                </div>
            </section>
        </main>

        <!-- Footer -->
        <footer class="footer">
            <p>&copy; 2025 Institute Event Management System. All rights reserved.</p>
        </footer>

    <!--    <script>
            document.getElementById('loginForm').addEventListener('submit', function(e) {
                e.preventDefault();

                const username = document.getElementById('username').value;
                const password = document.getElementById('password').value;

                // Simple demo authentication logic
                if (username === 'admin' && password === 'admin123') {
                    localStorage.setItem('userLoggedIn', 'true');
                    localStorage.setItem('userRole', 'admin');
                    alert('Login successful! Redirecting to Admin Dashboard...');
                    window.location.href = 'admin-dashboard.php';
                } else if (username === 'faculty' && password === 'faculty123') {
                    localStorage.setItem('userLoggedIn', 'true');
                    localStorage.setItem('userRole', 'faculty');
                    alert('Login successful! Redirecting to Faculty Dashboard...');
                    window.location.href = 'faculty-dashboard.php';
                } else if (username === 'student' && password === 'student123') {
                    localStorage.setItem('userLoggedIn', 'true');
                    localStorage.setItem('userRole', 'student');
                    alert('Login successful! Redirecting to Student Dashboard...');
                    window.location.href = 'student-dashboard.php';
                } else {
                    alert('Invalid credentials. Please try again.');
                }
            });
        </script>-->
        
        //This code is for password eye icon.
        <script>
            function togglePassword() {
                const passwordField = document.getElementById("password");
                const eyeIcon = document.getElementById("eyeIcon");

                if (passwordField.type === "password") {
                    passwordField.type = "text";
                    eyeIcon.classList.remove("fa-eye");
                    eyeIcon.classList.add("fa-eye-slash");
                } else {
                    passwordField.type = "password";
                    eyeIcon.classList.remove("fa-eye-slash");
                    eyeIcon.classList.add("fa-eye");
                }
            }
        </script>
    </body>
</html>
