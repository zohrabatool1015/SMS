<?php include('../includes/config.php') ?>
<?php include('header.php') ?>
<?php include('sidebar.php') ?>

<?php
// $servername = "localhost";
// $username = "root";  // Database username
// $password = "";  // Database password
// $dbname = "sms-database";  // Database name

// // Create connection
// $conn = new mysqli($servername, $username, $password, $dbname);

// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

// $class = $_POST['class'];
// $section = $_POST['section'];

// // Fetch students based on class and section
// $sql = "SELECT * FROM students WHERE class = '$class' AND section = '$section'";
// $result = $conn->query($sql);

// $students = [];
// while ($row = $result->fetch_assoc()) {
//     $students[] = $row;
// }

// echo json_encode($students);  // Return the students as JSON

// $conn->close();

// // Get student ID, status, and date from POST request
// $studentId = $_POST['studentId'];
// $status = $_POST['status'];
// $date = $_POST['date'];

// // Insert attendance record into the 'attendance' table
// $sql = "INSERT INTO attendance (student_id, date, status) VALUES ('$studentId', '$date', '$status')";

// if ($conn->query($sql) === TRUE) {
//     echo "Attendance marked successfully!";
// } else {
//     echo "Error: " . $sql . "<br>" . $conn->error;
// }

// $conn->close();
?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Attendance</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Teachers</a></li>
                    <li class="breadcrumb-item active">Attendance</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>


    <h1>Students Attendance System</h1>

    <!-- Class and Section Selection -->
    <select id="classSelect" onchange="fetchStudents()">
        <option value="">Select Class</option>
        <option value="Class 1">Class 1</option>
        <option value="Class 2">Class 2</option>
        <option value="Class 3">Class 3</option>
    </select>

    <select id="sectionSelect" onchange="fetchStudents()">
        <option value="">Select Section</option>
        <option value="Section A">Section A</option>
        <option value="Section B">Section B</option>
        <option value="Section C">Section C</option>
    </select>

    <button onclick="fetchStudents()">Fetch Students</button>

    <!-- Display Students -->
    <table id="studentsTable">
        <!-- Students and buttons will be populated here -->
    </table>

    <script>
        // Function to fetch students based on class and section
        function fetchStudents() {
            const className = document.getElementById('classSelect').value;
            const sectionName = document.getElementById('sectionSelect').value;

            if (className && sectionName) {
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'fetch_students.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        const students = JSON.parse(xhr.responseText);
                        displayStudents(students);
                    }
                };
                xhr.send('class=' + className + '&section=' + sectionName);
            }
        }

        // Function to display the students and attendance buttons
        function displayStudents(students) {
            const table = document.getElementById('studentsTable');
            table.innerHTML = ""; // Clear the table first

            students.forEach(student => {
                const row = document.createElement("tr");
                row.innerHTML = `
                    <td>${student.name}</td>
                    <td><button onclick="markAttendance(${student.id}, 'present')">Present</button></td>
                    <td><button onclick="markAttendance(${student.id}, 'absent')">Absent</button></td>
                `;
                table.appendChild(row);
            });
        }

        // Function to mark attendance for a student
        function markAttendance(studentId, status) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'mark_attendance.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    alert(xhr.responseText); // Show success message
                }
            };
            const date = new Date().toISOString().split('T')[0]; // Get today's date
            xhr.send('studentId=' + studentId + '&status=' + status + '&date=' + date);
        }
    </script>

<?php include('footer.php') ?>
