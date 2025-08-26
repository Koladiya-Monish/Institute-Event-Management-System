<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $connect = mysqli_connect("localhost", "root", "", "Project");
        if (!$connect) {
            die("Error on Connection<br>");
        }
        // put your code here
        ?>
    </body>
</html>
