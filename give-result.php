<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Give Result - IEMS</title>
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
            <h1>Publish Results</h1>
            
            <div class="card">
                <h3>Select Event</h3>
                <select id="eventSelect" class="form-control" style="width: 300px;" onchange="loadResults()">
                    <option value="">Select Event</option>
                    <option value="1">Code Marathon</option>
                    <option value="4">Classical Dance Competition</option>
                </select>
            </div>

            <div id="resultsSection" style="display: none;">
                <div class="card">
                    <h3 id="eventTitle">Event Results</h3>
                    
                    <div class="card" style="background: #f8f9fa;">
                        <h4>Winners Selection</h4>
                        <form id="winnersForm">
                            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 2rem;">
                                <div class="form-group">
                                    <label for="firstPlace">🥇 First Place</label>
                                    <select id="firstPlace" class="form-control" required>
                                        <option value="">Select Winner</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="secondPlace">🥈 Second Place</label>
                                    <select id="secondPlace" class="form-control" required>
                                        <option value="">Select Runner-up</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="thirdPlace">🥉 Third Place</label>
                                    <select id="thirdPlace" class="form-control" required>
                                        <option value="">Select Second Runner-up</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                    <div class="card">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                            <h4>Participant Scores</h4>
                            <button class="btn" onclick="editScores()">Edit Score</button>
                        </div>
                        <div class="table-container">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Rank</th>
                                        <th>Participant</th>
                                        <th>Enrollment</th>
                                        <th>Total Score</th>
                                        <th>Percentage</th>
                                        <th>Position</th>
                                    </tr>
                                </thead>
                                <tbody id="scoresTable">
                                    <!-- Scores will be loaded here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div class="text-center">
                        <button class="btn" onclick="publishResults()">Publish Results</button>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        const eventResults = {
            1: {
                name: "Code Marathon",
                maxScore: 100,
                participants: [
                    { id: 1, name: "John Smith", enrollment: "2023CS001", score: 95 },
                    { id: 2, name: "Sarah Johnson", enrollment: "2023CS002", score: 88 },
                    { id: 3, name: "Mike Davis", enrollment: "2023IT003", score: 82 },
                    { id: 4, name: "Emily Wilson", enrollment: "2023CS004", score: 78 },
                    { id: 5, name: "David Brown", enrollment: "2023IT005", score: 75 }
                ]
            },
            4: {
                name: "Classical Dance Competition",
                maxScore: 100,
                participants: [
                    { id: 1, name: "John Smith", enrollment: "2023CS001", score: 95 },
                    { id: 2, name: "Sarah Johnson", enrollment: "2023CS002", score: 88 },
                    { id: 3, name: "Mike Davis", enrollment: "2023IT003", score: 82 },
                    { id: 4, name: "Emily Wilson", enrollment: "2023CS004", score: 78 },
                    { id: 5, name: "David Brown", enrollment: "2023IT005", score: 75 }
                ]
            }
        };
        
        function loadResults() {
            const eventId = document.getElementById('eventSelect').value;
            const resultsSection = document.getElementById('resultsSection');
            
            if (!eventId) {
                resultsSection.style.display = 'none';
                return;
            }
            
            const event = eventResults[eventId];
            document.getElementById('eventTitle').textContent = event.name + ' - Results';
            
            // Sort participants by score (descending)
            const sortedParticipants = [...event.participants].sort((a, b) => b.score - a.score);
            
            // Populate winner dropdowns
            const firstPlace = document.getElementById('firstPlace');
            const secondPlace = document.getElementById('secondPlace');
            const thirdPlace = document.getElementById('thirdPlace');
            
            [firstPlace, secondPlace, thirdPlace].forEach(select => {
                select.innerHTML = '<option value="">Select</option>' + 
                    sortedParticipants.map(p => `<option value="${p.id}">${p.name} (${p.score})</option>`).join('');
            });
            
            // Auto-select top 3
            if (sortedParticipants.length >= 1) firstPlace.value = sortedParticipants[0].id;
            if (sortedParticipants.length >= 2) secondPlace.value = sortedParticipants[1].id;
            if (sortedParticipants.length >= 3) thirdPlace.value = sortedParticipants[2].id;
            
            // Populate scores table
            const scoresTable = document.getElementById('scoresTable');
            scoresTable.innerHTML = sortedParticipants.map((p, index) => {
                const percentage = ((p.score / event.maxScore) * 100).toFixed(1);
                let position = 'Participant';
                if (index === 0) position = 'Winner';
                else if (index === 1) position = 'Runner-up';
                else if (index === 2) position = 'Second Runner-up';
                
                return `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${p.name}</td>
                        <td>${p.enrollment}</td>
                        <td>${p.score}/${event.maxScore}</td>
                        <td>${percentage}%</td>
                        <td><span class="badge ${index < 3 ? 'badge-success' : 'badge-info'}">${position}</span></td>
                    </tr>
                `;
            }).join('');
            
            resultsSection.style.display = 'block';
        }
        
        function publishResults() {
            const eventId = document.getElementById('eventSelect').value;
            if (!eventId) {
                alert('Please select an event first.');
                return;
            }
            
            if (confirm('Are you sure you want to publish the results? Students will be able to view them immediately.')) {
                alert('Results published successfully! Students can now view the results.');
                window.location.href = 'faculty-myevents.php';
            }
        }
        
        function previewResults() {
            const eventId = document.getElementById('eventSelect').value;
            if (eventId) {
                window.open(`view-result.php?eventId=${eventId}`, '_blank');
            }
        }
        
        function editScores() {
            const eventId = document.getElementById('eventSelect').value;
            if (!eventId) {
                alert('Please select an event first.');
                return;
            }
            window.location.href = 'evaluation.php';
        }
        
        function logout() {
            localStorage.removeItem('userLoggedIn');
            localStorage.removeItem('userRole');
            window.location.href = 'home.php';
        }
    </script>
</body>
</html>
