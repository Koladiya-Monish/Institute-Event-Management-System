<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluate Participants - IEMS</title>
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
                <li><a href="evaluation.php" class="active">Evaluate Participants</a></li>
                <li><a href="reports.php">Reports</a></li>
                <li><a href="home.php" onclick="logout()">Logout</a></li>
            </ul>
        </nav>

        <main class="dashboard-content">
            <h1>Evaluate Participants</h1>
            
            <div class="card">
                <h3>Select Event for Evaluation</h3>
                <div style="margin-bottom: 2rem;">
                    <select id="eventSelect" class="form-control" style="width: 300px; display: inline-block;" onchange="loadParticipants()">
                        <option value="">Select Event</option>
                        <option value="1">Code Marathon</option>
                        <option value="4">Classical Dance Competition</option>
                    </select>
                </div>
            </div>

            <div id="evaluationSection" style="display: none;">
                <div class="card">
                    <h3 id="eventTitle">Event Evaluation</h3>
                    <div id="criteriaInfo" style="margin-bottom: 2rem; padding: 1rem; background: #f8f9fa; border-radius: 5px;">
                        <!-- Criteria will be loaded here -->
                    </div>
                    
                    <div class="table-container">
                        <table class="table">
                            <thead id="tableHeader">
                                <!-- Dynamic header will be generated -->
                            </thead>
                            <tbody id="participantsList">
                                <!-- Participants will be loaded here -->
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="text-center mt-2">
                        <button class="btn" onclick="saveEvaluations()">Save All Evaluations</button>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        const eventData = {
            1: {
                name: "Code Marathon",
                criteria: [
                    { name: "Algorithm Efficiency", maxMarks: 30 },
                    { name: "Code Quality", maxMarks: 25 },
                    { name: "Problem Solving", maxMarks: 25 },
                    { name: "Time Management", maxMarks: 20 }
                ],
                participants: [
                    { id: 1, name: "John Smith", enrollment: "2023CS001" },
                    { id: 2, name: "Sarah Johnson", enrollment: "2023CS002" },
                    { id: 3, name: "Mike Davis", enrollment: "2023IT003" }
                ]
            },
            4: {
                name: "Classical Dance Competition",
                criteria: [
                    { name: "Technique", maxMarks: 40 },
                    { name: "Expression", maxMarks: 35 },
                    { name: "Costume & Presentation", maxMarks: 25 }
                ],
                participants: [
                    { id: 4, name: "Emily Wilson", enrollment: "2023CS004" },
                    { id: 5, name: "David Brown", enrollment: "2023IT005" },
                    { id: 6, name: "Lisa Garcia", enrollment: "2023CS006" }
                ]
            }
        };
        
        function loadParticipants() {
            const eventId = document.getElementById('eventSelect').value;
            const evaluationSection = document.getElementById('evaluationSection');
            
            if (!eventId) {
                evaluationSection.style.display = 'none';
                return;
            }
            
            const event = eventData[eventId];
            document.getElementById('eventTitle').textContent = event.name + ' - Evaluation';
            
            // Load criteria info
            const criteriaInfo = document.getElementById('criteriaInfo');
            criteriaInfo.innerHTML = `
                <h4>Evaluation Criteria:</h4>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                    ${event.criteria.map(c => `
                        <div style="background: white; padding: 1rem; border-radius: 5px;">
                            <strong>${c.name}</strong><br>
                            <span style="color: #666;">Max: ${c.maxMarks} marks</span>
                        </div>
                    `).join('')}
                </div>
                <p style="margin-top: 1rem; color: #666;">
                    <strong>Total Maximum Marks: ${event.criteria.reduce((sum, c) => sum + c.maxMarks, 0)}</strong>
                </p>
            `;
            
            // Generate table header
            const tableHeader = document.getElementById('tableHeader');
            tableHeader.innerHTML = `
                <tr>
                    <th>Participant</th>
                    <th>Enrollment</th>
                    ${event.criteria.map(c => `<th>${c.name}<br><small>(Max: ${c.maxMarks})</small></th>`).join('')}
                    <th>Total</th>
                </tr>
            `;
            
            // Generate participants rows
            const participantsList = document.getElementById('participantsList');
            participantsList.innerHTML = event.participants.map(p => `
                <tr id="participant-${p.id}">
                    <td>${p.name}</td>
                    <td>${p.enrollment}</td>
                    ${event.criteria.map((c, index) => `
                        <td>
                            <input type="number" 
                                   class="form-control" 
                                   style="width: 80px;" 
                                   min="0" 
                                   max="${c.maxMarks}" 
                                   id="marks-${p.id}-${index}"
                                   onchange="calculateTotal(${p.id}, ${event.criteria.length})">
                        </td>
                    `).join('')}
                    <td><strong id="total-${p.id}">0</strong></td>
                </tr>
            `).join('');
            
            evaluationSection.style.display = 'block';
        }
        
        function calculateTotal(participantId, criteriaCount) {
            let total = 0;
            for (let i = 0; i < criteriaCount; i++) {
                const marks = document.getElementById(`marks-${participantId}-${i}`).value;
                total += parseInt(marks) || 0;
            }
            document.getElementById(`total-${participantId}`).textContent = total;
        }
        
        function saveParticipantEvaluation(participantId) {
            alert(`Evaluation saved for participant ${participantId}`);
        }
        
        function saveEvaluations() {
            alert('All evaluations saved successfully!');
        }
        
        function publishResults() {
            if (confirm('Are you sure you want to publish the results? This action cannot be undone.')) {
                alert('Results published successfully!');
                window.location.href = 'give-result.php';
            }
        }
        
        function logout() {
            localStorage.removeItem('userLoggedIn');
            localStorage.removeItem('userRole');
            window.location.href = 'home.php';
        }
    </script>
</body>
</html>
