<!DOCTYPE html><?php require_once 'config.php';?>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body><?php session_start() ?>

        <?php
        if (empty($_SESSION["user"])) {
            header("location:login.php");
        }
        $id = $_GET['id'];
        echo "$id";
        
        $qu = "select * from tblstudent where enro=$id";
        echo "$qu";
        $query = "delete from tblstudent where enro=$id";
        //
        $q = mysqli_query($connect, $qu);
        while ($r = mysqli_fetch_row($q)) {
            $id = $r[1];
        }
        $q = mysqli_query($connect, $query);
        echo "$id";


             $query="delete from tbluser where id=$id";
             $q = mysqli_query($connect, $query);
             header("location:view.php");
        // put your code here
        ?>
    </body>
</html>
