<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Evaluation Criteria - IEMS</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="dashboard-container">
        <nav class="sidebar">
            <h3>Faculty Portal</h3>
            <ul class="sidebar-menu">
                <li><a href="faculty-dashboard.php">Dashboard</a></li>
                <li><a href="faculty-profile.php">Profile</a></li>
                <li><a href="faculty-myevents.php">My Events</a></li>
                <li><a href="evaluation-criteria.php">Evaluation Criteria</a></li>
                <li><a href="evaluation.php">Evaluate Participants</a></li>
                <li><a href="reports.php">Reports</a></li>
                <li><a href="home.php" onclick="logout()">Logout</a></li>
            </ul>
        </nav>

        <main class="dashboard-content">
            <h1 id="pageTitle">Add Evaluation Criteria</h1>
            
            <div class="card">
                <h3 id="formTitle">Add New Criteria</h3>
                <form id="criteriaForm">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                        <div class="form-group">
                            <label for="event">Select Event</label>
                            <select id="event" name="event" class="form-control" required>
                                <option value="">Select Event</option>
                                <option value="1">Code Marathon</option>
                                <option value="2">Web Development Challenge</option>
                                <option value="4">Classical Dance Competition</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="criteriaName">Enter Criteria Name</label>
                            <input type="text" id="criteriaName" name="criteriaName" class="form-control" required>
                        </div>
                    </div>
                    <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 2rem;">
                        <div class="form-group">
                            <label for="maxMarks">Maximum Marks</label>
                            <input type="number" id="maxMarks" name="maxMarks" class="form-control" min="1" max="100" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea id="description" name="description" class="form-control" rows="3" placeholder="Brief description of this criteria..."></textarea>
                        </div>
                    </div>
                    <div style="margin-top: 2rem;">
                        <button type="submit" class="btn" id="submitBtn">Add Criteria</button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script>
        let isEditMode = false;
        let criteriaId = null;

        // Check if editing existing criteria
        window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            criteriaId = urlParams.get('id');
            
            if (criteriaId) {
                isEditMode = true;
                document.getElementById('pageTitle').textContent = 'Edit Evaluation Criteria';
                document.getElementById('formTitle').textContent = 'Edit Criteria';
                document.getElementById('submitBtn').textContent = 'Update Criteria';
                loadCriteriaData(criteriaId);
            }
        };

        function loadCriteriaData(id) {
            // Mock data - in real application, this would fetch from database
            const criteriaData = {
                '1': {
                    event: '1',
                    criteriaName: 'Algorithm Efficiency',
                    maxMarks: 30,
                    description: 'Quality and efficiency of algorithms used'
                },
                '2': {
                    event: '1',
                    criteriaName: 'Code Quality',
                    maxMarks: 25,
                    description: 'Code readability and best practices'
                },
                '3': {
                    event: '1',
                    criteriaName: 'Problem Solving',
                    maxMarks: 25,
                    description: 'Approach to solving complex problems'
                },
                '4': {
                    event: '1',
                    criteriaName: 'Time Management',
                    maxMarks: 20,
                    description: 'Completion within time constraints'
                },
                '5': {
                    event: '4',
                    criteriaName: 'Technique',
                    maxMarks: 40,
                    description: 'Technical accuracy and skill level'
                },
                '6': {
                    event: '4',
                    criteriaName: 'Expression',
                    maxMarks: 35,
                    description: 'Emotional expression and storytelling'
                },
                '7': {
                    event: '4',
                    criteriaName: 'Costume & Presentation',
                    maxMarks: 25,
                    description: 'Overall presentation and costume appropriateness'
                }
            };

            const criteria = criteriaData[id];
            if (criteria) {
                document.getElementById('event').value = criteria.event;
                document.getElementById('criteriaName').value = criteria.criteriaName;
                document.getElementById('maxMarks').value = criteria.maxMarks;
                document.getElementById('description').value = criteria.description;
            }
        }

        document.getElementById('criteriaForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (isEditMode) {
                alert('Evaluation criteria updated successfully!');
            } else {
                alert('Evaluation criteria added successfully!');
            }
            
            // Redirect back to evaluation criteria page
            window.location.href = 'evaluation-criteria.php';
        });

        function logout() {
            localStorage.removeItem('userLoggedIn');
            localStorage.removeItem('userRole');
            window.location.href = 'home.php';
        }
    </script>
</body>
</html>
