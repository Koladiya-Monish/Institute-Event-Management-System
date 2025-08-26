<!DOCTYPE html><?php require_once 'config.php';?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Student Registration</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f2f2f2;
                margin: 0;
                padding: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
                height: 100vh;
            }

            form {
                background-color: #ffffff;
                padding: 30px;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                margin-bottom: 20px;
            }

            table {
                width: 100%;
            }

            td {
                padding: 10px;
                vertical-align: top;
            }

            input[type="text"],
            input[type="number"],
            input[type="email"],
            input[type="date"],
            select,
            input[type="password"],
            input[type="textbox"] {
                width: 100%;
                padding: 8px;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
            }

            input[type="radio"] {
                margin-right: 5px;
            }

            input[type="submit"] {
                background-color: #007bff;
                color: white;
                border: none;
                padding: 10px 20px;
                border-radius: 4px;
                cursor: pointer;
                margin: 5px;
            }

            input[type="submit"]:hover {
                background-color: #0056b3;
            }

            h2 {
                text-align: center;
                margin-bottom: 20px;
                color: #333;
            }

            .button-group {
                text-align: center;
            }
        </style>
    </head>
    <body>

        <?php
        session_start();
        if (empty($_SESSION["user"])) {
            header('location:login.php');
        }

        

        $query = "SELECT * FROM tbldepartment";
        $q = mysqli_query($connect, $query);

        if (isset($_POST["home"])) {
            header("location:Adminpage.php");
            exit();
        }
        ?>

        <form method="post">
            <h2>Student Registration</h2>
            <table>


                <tr>
                    <td>Name</td>
                    <td><input type="text" name="name" pattern="[A-Za-z]+" required></td>
                </tr>
                <tr>
                    <td>Gender</td>
                    <td>
                        <input type="radio" name="gender" value="male" required>Male
                        <input type="radio" name="gender" value="female" required>Female
                    </td>
                </tr>
                <tr>
                    <td>Date of Birth</td>
                    <td><input type="date" name="dob" required></td>
                </tr>
                <tr>
                    <td>Email ID</td>
                    <td><input type="email" name="email" required></td>
                </tr>
                <tr>
                    <td>Contact</td>
                    <td><input type="number" name="contact" pattern="[0-9]{10}" required></td>
                </tr>

                <tr>
                    <td>Address</td>
                    <td><input type="textbox" name="address" required></td>
                </tr>
                <tr>
                    <td>City</td>
                    <td>
                        <select name="city">
                            <?php
                            $query = "SELECT * FROM tblcity";
                            $qu = mysqli_query($connect, $query);
                            while ($a = mysqli_fetch_row($qu)) {
                                echo "<option value='$a[0]'>$a[1]</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Department</td>
                    <td>
                        <select name="dept">
                            <?php
                            while ($a = mysqli_fetch_row($q)) {
                                echo "<option value='$a[0]'>$a[1]</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Semester</td>
                    <td>
                        <select name="sem">
                            <?php
                            $query = "SELECT * FROM tblsemester";
                            $qu = mysqli_query($connect, $query);
                            while ($a = mysqli_fetch_row($qu)) {
                                echo "<option value='$a[0]'>$a[1]</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Division</td>
                    <td>
                        <select name="div">
                            <?php
                            $query = "SELECT * FROM tbldivision";
                            $qu = mysqli_query($connect, $query);
                            while ($a = mysqli_fetch_row($qu)) {
                                echo "<option value='$a[0]'>$a[1]</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="text" name="pass" required></td>
                </tr>
                <tr>
                    <td>Registration for Faculty</td>
                    <td><a href='faculty.php'>Click Here</a></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:center;">
                        <input type="submit" name="insert" value="Insert">
                    </td>
                </tr>
            </table>
        </form>

        <!-- Merged View + Logout buttons -->
        <form method="post" style="text-align: center;">
            <input type="submit" name="view" value="View Students" formaction="view.php">
            <input type="submit" name="home" value="Home">
        </form>

        <?php
        if (isset($_POST['insert'])) {

            $name = $_POST['name'];
            $dept = $_POST['dept'];
            $address = $_POST['address'];
            $city = $_POST['city'];
            $gender = $_POST['gender'];
            $dob = $_POST['dob'];
            $contact = $_POST['contact'];
            $email = $_POST['email'];
            $pass = $_POST['pass'];
            $sem = $_POST['sem'];
            $div = $_POST['div'];

            $query = " INSERT INTO `tbluser`(`departmentid`, `name`, `address`, `cityid`, `gender`, `dob`, `contact`, `emailid`, `password`) VALUES
        ('$dept','$name','$address','$city','$gender','$dob','$contact','$email','$pass')";
            $q = mysqli_query($connect, $query);
            if ($q) {
                echo '<br>User data inserted successfully.<br>';
            } else {
                echo 'Error inserting user data.<br>';
            }
            $query = "select * from tbluser where emailid='$email'";
            $q = mysqli_query($connect, $query);
            while ($r = mysqli_fetch_row($q)) {
                $id = $r[0];
            }
            $query = "INSERT INTO `tblstudent`(`userid`, `semesterid`, `divisionid`) VALUES ('$id','$sem','$div')";
            $q = mysqli_query($connect, $query);
        }
        ?>

    </body>
</html>
