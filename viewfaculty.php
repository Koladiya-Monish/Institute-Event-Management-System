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
                background-color: #f4f4f4;
                padding: 20px;
            }

            h2 {
                text-align: center;
                margin-bottom: 20px;
            }

            table {
                border-collapse: collapse;
                width: 100%;
                background-color: #fff;
                box-shadow: 0 0 10px rgba(0,0,0,0.1);
            }

            th, td {
                border: 1px solid #ddd;
                padding: 10px;
                text-align: left;
            }

            th {
                background-color: #007bff;
                color: white;
            }

            tr:nth-child(even) {
                background-color: #f9f9f9;
            }

            a {
                color: red;
                text-decoration: none;
            }

            input[type="submit"] {
                margin-top: 20px;
                padding: 10px 20px;
                background-color: #007bff;
                color: white;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }

            input[type="submit"]:hover {
                background-color: #0056b3;
            }
        </style>
    </head>
    <body><?php session_start() ?>
        <?php
        if(empty($_SESSION["user"]))
        {
            header("location:login.php");
        }
       
             
             $query="SELECT 
    tblfaculty.id,tbluser.name,tbluser.gender,tbluser.dob,tbldepartment.name,tblfaculty.dateofjoining,
    tblfaculty.designation,tbluser.contact,tbluser.emailid,tbluser.address,tblcity.city
FROM 
    tblfaculty
JOIN 
    tbluser ON tblfaculty.userid = tbluser.id  
JOIN 
    tblcity ON tbluser.cityid = tblcity.id 
JOIN 
    tbldepartment ON tbluser.departmentid = tbldepartment.id;
";
             $q= mysqli_query($connect, $query);
//             echo "<table><tr><td>Enrollment</td>"
//             . "<td>Name</td>"
//                     . "<td>Address</td>"
//                     . "<td>Gender</td>"
//                     . "<td>Date Of Birth</td>"
//                     . "<td>Contact No.</td>"
//                     . "<td>EmailId</td>"
//                     . "<td>Password</td>"
//                     . "<td>Department</td>"
//                     . "<td>City</td>"
//                     . "<td>Deletion</td></tr></table>";
             while ($r = mysqli_fetch_row($q))
             {
                 echo "<table border><tr><td>$r[0]</td>"
                     . "<td>$r[1]</td>"
                     . "<td>$r[2]</td>"
                     . "<td>$r[3]</td>"
                     . "<td>$r[4]</td>"
                     . "<td>$r[5]</td>"
                     . "<td>$r[6]</td>"
                     . "<td>$r[7]</td>"
                     . "<td>$r[8]</td>"
                     . "<td>$r[9]</td>"
                     . "<td>$r[10]</td>"
                     . "<td><a href='deletefaculty.php?id=$r[0]'>delete</a></td></tr></table>";
             }
        // put your code here
        ?>
        <form action="Adminpage.php">
            <input type="submit" value="Home">
        </form>
    </body>
</html>
