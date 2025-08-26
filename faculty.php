<!DOCTYPE html><?php require_once 'config.php';?>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f2f2f2;
                margin: 0;
                padding: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
            }

            form {
                background-color: #ffffff;
                padding: 30px;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
                padding: 10px 15px;
                border-radius: 4px;
                cursor: pointer;
                margin-right: 10px;
            }

            input[type="submit"]:hover {
                background-color: #0056b3;
            }

            h2 {
                text-align: center;
                margin-bottom: 20px;
                color: #333;
            }
        </style>
    </head>

    <body><?php
        session_start();
        if (empty($_SESSION["user"])) {
            header('location:login.php');
        }
        
        $query = "select*from tbldepartment";
        $q = mysqli_query($connect, $query);
        if (isset($_POST["logout"])) {

            header("location:dashboard.php");
            exit();
        }
        ?>
        <form method="post">
            <table>
                <tr>
                    <td>Name</td>
                    <td><input type="text" name="name" pattern="[A-Za-z ]+"></td>
                </tr>
                 <tr>
                    <td>Gender</td>
                    <td><input type="radio" name="gender" value="male">Male
                        <input type="radio" name="gender" value="female">Female</td>
                </tr>
                <tr>
                    <td>Date of birth</td>
                    <td><input type='date' name="dob"></td>
                </tr>
                <tr>
                    <td>Emaiid</td>
                    <td><input type="email" name="email"></td>
                </tr>
                <tr>
                    <td>Contact</td>
                    <td><input type="number" name="contact"></td>
                </tr>
                <tr>
                    <td>address</td>
                    <td><input type="textbox" name="address"></td>
                </tr>
                <tr>
                    <td>city</td>
                    <td><select name="city">
                            <?php
                            $query = "select*from tblcity";
                            $qu = mysqli_query($connect, $query);
                            while ($a = mysqli_fetch_row($qu)) {
                                echo "<option value='$a[0]'>$a[1]</option>";
                            }
                            ?>
                        </select></td>
                </tr>
                <tr>
                    <td>department</td>
                    <td><select name="dept">
                            <?php
                            while ($a = mysqli_fetch_row($q)) {
                                echo "<option value='$a[0]'>$a[1]</option>";
                            }
                            ?>
                        </select></td>
                </tr>
                <tr>
                    <td>Designation</td>
                    <td><input type='text' name="des" pattern="[A-Za-z ]+"</td>
                </tr>
                <tr>
                    <td>Date of Joining</td>
                    <td><input type="date" name="doj"</td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="pass"></td>
                </tr>
                <tr>
                    <td><input type="submit" name="insert" value="insert">
                        <input type="submit" name="view" value="view" formaction="viewfaculty.php">
                        <input type="submit" name="logout" value="Home"></td>
                </tr>
            </table>
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
            $doj = $_POST['doj'];
            $des = $_POST['des'];
            $query = " INSERT INTO `tbluser`(`departmentid`, `name`, `address`, `cityid`, `gender`, `dob`, `contact`, `emailid`, `password`) VALUES
        ('$dept','$name','$address','$city','$gender','$dob','$contact','$email','$pass')";                    //echo "$query";
            $q = mysqli_query($connect, $query);
            if ($q) {
                echo '<br>Query inserted<br>';
            } else {
                echo 'Error on query<br>';
            }
            $query = "select * from tbluser where emailid='$email'";
            $q = mysqli_query($connect, $query);
            while ($r = mysqli_fetch_row($q)) {
                $id = $r[0];
            }
            $query = "INSERT INTO tblfaculty(`userid`, `dateofjoining`, `designation`) VALUES ('$id','$doj','$des')";
            $q= mysqli_query($connect, $query);
        }
        // put your code here
        ?>
    </body>
</html>
