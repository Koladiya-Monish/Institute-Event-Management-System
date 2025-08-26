<!DOCTYPE html><?php require_once 'config.php';?>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
         <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f2f2f2;
                margin: 0;
                padding: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
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
    <script type="text/javascript">
        function preventBack() {
            window.history.forward(); 
        }
        
        setTimeout("preventBack()", 0);
        
        window.onunload = function () { null };
    </script>
    </head>
    <body><?php session_start() ?>
        <form method="post">
            
            <table>
                
                <tr>
                    <td><label> Username: </label></td>
                    <td><input type="text" id="name" placeholder="Enter Username" name="name"></td>                    
                </tr>
                <tr>
                    <td><label> password: </label></td>
                    <td><input type="text" id="name" placeholder="Enter password" name="pass"></td>                    
                </tr>
                <tr>
                    <td><input type="submit" name="login" value="submit "/></td>
                    <td><input type="submit" name="forgot" value="forgot">
                    <input type="submit" name="home" value="Home"</td>
                </tr>
                
            </table>
            
        </form>
        <?php
        $username='Admin';
        $password='Admin123';
        if(isset($_SESSION["user"]))
        {
            header("location:Adminpage.php");
        }
        if (isset($_POST['home'])) {
            header("location:dashboard.php");
    
}
//        echo "Welcome to home page";       }
        if(isset($_POST['login']))
        {
            $user=$_POST['name'];
            $pass=$_POST['pass'];
            if($user==$username && $pass==$password)
            {
                $_SESSION["user"]="Admin";
                
                header("location:Adminpage.php");
            }
             else {
                echo 'Username and Password is invalid';
             }
        }
        // put your code here
        ?>
    </body>
</html>