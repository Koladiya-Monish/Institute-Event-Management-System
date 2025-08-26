<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Institute Event Management System</title>
        <style>
            body {
                margin: 0;
                font-family: Arial, sans-serif;
                background: #f4f6f8;
            }

            /* Header */
            .header {
                background-color: #2c3e50;
                color: white;
                padding: 20px 40px;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .header h1 {
                margin: 0;
                font-size: 26px;
                letter-spacing: 1px;
            }

            .header a {
                background-color: #2980b9;
                color: white;
                text-decoration: none;
                padding: 10px 18px;
                border-radius: 4px;
                font-weight: bold;
            }

            .header a:hover {
                background-color: #1abc9c;
            }

            /* Welcome section */
            .welcome {
                padding: 50px 40px;
                background-color: white;
                text-align: center;
                box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            }

            .welcome h2 {
                font-size: 32px;
                color: #2c3e50;
                margin-bottom: 10px;
            }

            .welcome p {
                font-size: 18px;
                color: #555;
            }

            /* Events section */
            .events {
                padding: 40px;
            }

            .events h3 {
                font-size: 24px;
                color: #333;
                margin-bottom: 20px;
                border-left: 6px solid #2980b9;
                padding-left: 10px;
            }

            .event-card {
                background-color: white;
                border-left: 5px solid #3498db;
                padding: 20px;
                margin-bottom: 20px;
                border-radius: 6px;
                box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            }

            .event-card h4 {
                margin: 0;
                color: #2c3e50;
            }

            .event-card p {
                margin-top: 6px;
                color: #555;
            }

            .footer {
                text-align: center;
                padding: 20px;
                color: #777;
                font-size: 14px;
            }

        </style>
    </head>
    <body>

        <div class="header">
            <h1>Institute Event Management</h1>
            <?php
            if (isset($_SESSION['user'])) {
                //$a=$_SESSION['user'];
                //echo "<a href=''> $a</a>";
                echo "<a href='logout.php'>Sign Out</a>";
            } else {
                echo "<a href='login.php'>Login</a>";
            }
            ?>
        </div>

        <div class="welcome">
            <h2>Welcome to the Dashboard</h2>
            <p>Manage, track, and participate in institutional events all in one place.</p>
        </div>

        <div class="events">
            <h2>Add Users</h2>
            <div class="event-card">
                <h3>Add Student</h3><a href="index.php">Click here</a>
                <h3>Add Faculty</h3><a href="faculty.php">Click here</a>
            </div>
            <h2>Event</h2>
                <div class="event-card">
                    <h3>Add Event</h3><a href="index.php">Click here</a>
                </div>
            <div class="events">
                
                <h2>Upcoming Events</h2>

                <div class="event-card">
                    <h3>Annual Tech Fest 2025</h3>
                    <p>Date: September 15, 2025 | Venue: Auditorium Hall</p>
                </div>

                <div class="event-card">
                    <h3>Student Entrepreneurship Workshop</h3>
                    <p>Date: October 5, 2025 | Venue: Seminar Room B</p>
                </div>

                <div class="event-card">
                    <h3>Cultural Night</h3>
                    <p>Date: November 20, 2025 | Venue: Open Grounds</p>
                </div>
            </div>

            <div class="footer">
                &copy; 2025. All Rights Reserved.
            </div>

    </body>
</html>